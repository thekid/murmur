<?php namespace com\enbw\murmur\web;

use com\enbw\murmur\YammerAPI;
use web\frontend\{Handler, Get, Value};

#[Handler('/')]
class Home {
  private static $groups= [];

  public function __construct(private YammerAPI $yammer) { }

  #[Get]
  public function index(#[Value] $user) {
    $endpoints= $this->yammer->as($user['token']);

    // Cache groups
    $id= $user['identity']['id'];
    if (!isset(self::$groups[$id])) {
      while (sizeof(self::$groups) > 100) {
        unset(self::$groups[key(self::$groups)]);
      }
      self::$groups[$id]= $endpoints->api('groups/for_user/{id}', $user['identity'])->get()->value();
    }

    return ['user' => $user['identity'], 'groups' => self::$groups[$id]];
  }
}