<?php namespace com\enbw\murmur\web;

use com\enbw\murmur\YammerAPI;
use util\profiling\Timer;
use web\frontend\{Handler, Get, Post, View, Value};

#[Handler('/following')]
class Following {
  private const CACHED = 100;
  private const EXPIRE = 600;
  private static $cache= [];

  public function __construct(private YammerAPI $api) { }

  #[Post]
  public function refresh(#[Value] $user) {
    unset(self::$cache[$user['identity']['id']]);
    return View::redirect('/following');
  }

  #[Get]
  public function index(#[Value] $user) {
    $measure= new Timer()->start();
    $id= $user['identity']['id'];
    $time= time();

    if (!isset(self::$cache[$id]) || $time - self::$cache[$id]['time'] > self::EXPIRE) {
      while (sizeof(self::$cache) > self::CACHED) {
        unset(self::$cache[key(self::$cache)]);
      }

      $res= $this->api
        ->as($user['token'])
        ->resource('messages/following.json')
        ->get(['threaded' => 'extended', 'limit' => 10])
      ;
      self::$cache[$id]= ['time' => $time, 'value' => $res->value()];
      $cached= false;
    } else {
      $cached= true;
    }

    return [
      'feed'     => new Referenced(self::$cache[$id]['value']),
      'cached'   => $cached,
      'until'    => self::$cache[$id]['time'] + self::EXPIRE,
      'duration' => sprintf('%.3f', $measure->elapsedTime())
    ];
  }
}