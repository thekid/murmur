<?php namespace com\enbw\murmur\api;

use com\enbw\murmur\YammerAPI;
use web\rest\{Get, Resource, Param, Value};

#[Resource('/api/feed')]
class Feed {

  public function __construct(private YammerAPI $yammer) { }

  #[Get('/group/{id}')]
  public function ofGroup($id, #[Param] $limit= 10, #[Value] $user) {
    return $this->yammer->as($user['token'])
      ->resource('messages/in_group/{0}.json', [$id])
      ->get(['limit' => $limit])
      ->value()
    ;
  }
}