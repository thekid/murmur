<?php namespace com\enbw\murmur\web;

use com\enbw\murmur\{YammerAPI, Cache};
use web\frontend\{Handler, Get, Value, View};

#[Handler('/feed')]
class Feeds {

  public function __construct(private YammerAPI $yammer, private Cache $cache) { }

  #[Get('/{kind}')]
  public function all(#[Value] $user) {

    // Populate group IDs
    $groups= $this->cache->lookup($user['identity']['id'], 'groups', fn() => $this->yammer->as($user['token'])
      ->api('groups/for_user/{id}', $user['identity'])
      ->get()
      ->value()
    );
    $map= [];
    foreach ($groups as $group) {
      $map[$group['id']]= true;
    }

    return View::named('feeds')->with(['following' => json_encode($map)]);
  }
}