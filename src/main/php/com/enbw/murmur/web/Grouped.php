<?php namespace com\enbw\murmur\web;

use com\enbw\murmur\{YammerAPI, Cache};
use web\frontend\{Handler, Get, Value, View};

#[Handler('/grouped')]
class Grouped {

  public function __construct(private YammerAPI $yammer, private Cache $cache) { }

  #[Get('/{kind}')]
  public function index(#[Value] $user) {
    return View::named('grouped')->with([
      'groups' => $this->cache->lookup(
        $user['identity']['id'],
        'groups',
        fn() => $this->yammer->as($user['token'])->api('groups/for_user/{id}', $user['identity'])->get()->value()
      )
    ]);
  }
}