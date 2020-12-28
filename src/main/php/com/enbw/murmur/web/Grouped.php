<?php namespace com\enbw\murmur\web;

use com\enbw\murmur\YammerAPI;
use web\frontend\{Handler, Get, Value};

#[Handler('/grouped')]
class Grouped {

  public function __construct(private YammerAPI $yammer) { }

  #[Get]
  public function index(#[Value] $user) {
    return ['groups' => $this->yammer->as($user['token'])->api('groups/for_user/{id}n', $user['identity'])->get()->value()];
  }
}