<?php namespace com\enbw\murmur\web;

use com\enbw\murmur\YammerAPI;
use web\frontend\{Handler, Get, Value, View};

#[Handler('/')]
class Feeds {

  public function __construct(private YammerAPI $api) { }

  #[Get('/all')]
  public function all(#[Value] $user) {
    return View::named('feeds')->with(['kind' => 'all']);
  }

  #[Get('/following')]
  public function following(#[Value] $user) {
    return View::named('feeds')->with(['kind' => 'following']);
  }
}