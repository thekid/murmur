<?php namespace com\enbw\murmur\web;

use com\enbw\murmur\YammerAPI;
use web\frontend\{Handler, Get, Post, Value, View, Request};
use web\session\Sessions;

#[Handler('/')]
class Home {

  public function __construct(private YammerAPI $yammer, private Sessions $sessions) { }

  #[Post]
  public function refresh(#[Request] $request) {
    using ($session= $this->sessions->locate($request)) {
      $user= $session->value('user');

      // Refresh user and groups
      $endpoints= $this->yammer->as($user['token']);
      $user['user']= $endpoints->api('users/current')->get()->value();
      $user['groups']= $endpoints->api('groups/for_user/{id}', $user['identity'])->get()->value();

      $session->register('user', $user);
    }

    return View::redirect('/');
  }

  #[Get]
  public function index(#[Value] $user) {
    usort($user['groups'], fn($a, $b) => $b['stats']['last_message_id'] <=> $a['stats']['last_message_id']);
    return ['user' => $user['identity'], 'groups' => $user['groups']];
  }
}