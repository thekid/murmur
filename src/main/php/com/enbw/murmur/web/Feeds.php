<?php namespace com\enbw\murmur\web;

use web\frontend\{Handler, Get, Value, View};

#[Handler('/feed')]
class Feeds {

  #[Get('/{kind}')]
  public function all(#[Value] $user) {
    return View::named('feeds');
  }
}