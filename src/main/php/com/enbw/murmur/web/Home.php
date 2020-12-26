<?php namespace com\enbw\murmur\web;

use com\enbw\murmur\YammerAPI;
use web\frontend\{Handler, Get, Value};

#[Handler('/')]
class Home {

  public function __construct(private YammerAPI $yammer) { }

  #[Get]
  public function index(#[Value] $user) {
    $api= $this->yammer->as($user['token']);
    return [
      'user'   => $user['identity'],
      'groups' => $api->resource('groups/for_user/{id}.json', $user['identity'])->get()->value()
    ];
  }
}