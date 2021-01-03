<?php namespace com\enbw\murmur\web;

use com\enbw\murmur\YammerAPI;
use web\frontend\{Handler, Get, Value, View};

#[Handler('/grouped')]
class Grouped {

  public function __construct(private YammerAPI $yammer) { }

  #[Get('/{kind}')]
  public function index(#[Value] $user) {
    return View::named('grouped')->with(['groups' => $user['groups']]);
  }
}