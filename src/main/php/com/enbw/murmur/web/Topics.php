<?php namespace com\enbw\murmur\web;

use com\enbw\murmur\YammerAPI;
use web\frontend\{Handler, Get, Value, View};

#[Handler('/topics')]
class Topics {

  public function __construct(private YammerAPI $yammer) { }

  #[Get]
  public function all(#[Value] $user) {

    // Populate group IDs
    $map= [];
    foreach ($user['groups'] as $group) {
      $map[$group['id']]= true;
    }

    return View::named('topics')->with(['following' => json_encode($map)]);
  }
}