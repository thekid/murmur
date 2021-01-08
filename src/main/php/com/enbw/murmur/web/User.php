<?php namespace com\enbw\murmur\web;

use com\enbw\murmur\YammerAPI;
use web\Error;
use web\frontend\{Handler, Get, Value, View};

#[Handler('/user')]
class User {

  public function __construct(private YammerAPI $yammer) { }

  /** Returns the view for a given authenticated user and id */
  private function view($user, $id) {
    $endpoints= $this->yammer->as($user['token']);
    $res= $endpoints->api('users/{0}', [$id])->get();
    if (200 !== $res->status()) {
      throw new Error(404, 'No such user #'.$id);
    }

    return [
      'user'       => $res->value(),
      'identifier' => $this->yammer->id('User', $id),
      'groups'     => $endpoints->api('groups/for_user/{0}', [$id])->get()->value()
    ];
  }

  #[Get]
  public function self(#[Value] $user) {
    return $this->view($user, $user['identity']['id']);
  }

  #[Get('/{id}')]
  public function index(#[Value] $user, int $id) {
    return $this->view($user, $id);
  }
}