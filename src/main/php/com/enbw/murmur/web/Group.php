<?php namespace com\enbw\murmur\web;

use com\enbw\murmur\{YammerAPI, Cache};
use web\Error;
use web\frontend\{Handler, Get, Value, View};

#[Handler('/group')]
class Group {

  public function __construct(private YammerAPI $yammer, private Cache $cache) { }

  #[Get('/{id}')]
  public function index(#[Value] $user, int $id) {
    $groups= $this->cache->lookup($user['identity']['id'], 'groups', fn() => $this->yammer
      ->as($user['token'])
      ->api('groups/for_user/{id}', $user['identity'])
      ->get()
      ->value()
    );
    foreach ($groups as $group) {
      if ($group['id'] === $id) return View::named('group')->with(['group' => $group]);
    }

    throw new Error(404, 'No such group #'.$id);
  }
}