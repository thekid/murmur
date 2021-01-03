<?php namespace com\enbw\murmur\web;

use com\enbw\murmur\YammerAPI;
use web\Error;
use web\frontend\{Handler, Get, Value, View};

#[Handler('/group')]
class Group {

  public function __construct(private YammerAPI $yammer) { }

  #[Get('/{id}')]
  public function index(#[Value] $user, int $id) {
    foreach ($user['groups'] as $group) {
      if ($group['id'] === $id) {
        $identifier= $this->yammer->id('Group', $id);
        $activity= $this->yammer->as($user['token'])
          ->query('GroupActivitySummaryClients', 'ad34e6417baf4057bc4a03f0e47b4761bd4c48c7e254cee70b7622e685429ed1')
          ->execute(['groupId' => $identifier])
        ;
        return View::named('group')->with(['group' => $group, 'activity' => $activity, 'identifier' => $identifier]);
      }
    }

    throw new Error(404, 'No such group #'.$id);
  }
}