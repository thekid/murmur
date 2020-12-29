<?php namespace com\enbw\murmur\web;

use com\enbw\murmur\{YammerAPI, Cache};
use web\frontend\{Handler, Get, Value};

#[Handler('/')]
class Home {

  public function __construct(private YammerAPI $yammer, private Cache $cache) { }

  #[Get]
  public function index(#[Value] $user) {
    $groups= $this->cache->lookup($user['identity']['id'], 'groups', fn() => $this->yammer
      ->as($user['token'])
      ->api('groups/for_user/{id}', $user['identity'])
      ->get()
      ->value()
    );

    // Sort groups by most recently updated
    usort($groups, fn($a, $b) => $b['stats']['last_message_id'] <=> $a['stats']['last_message_id']);
    return ['user' => $user['identity'], 'groups' => $groups];
  }
}