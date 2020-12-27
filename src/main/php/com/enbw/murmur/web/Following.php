<?php namespace com\enbw\murmur\web;

use com\enbw\murmur\YammerAPI;
use web\frontend\{Handler, Get, Value};

#[Handler('/following')]
class Following {
  public function __construct(private YammerAPI $api) { }

  #[Get]
  public function index(#[Value] $user) {
    return [];
  }
}