<?php namespace com\enbw\murmur\web;

use com\enbw\murmur\{YammerAPI, Cache};
use web\Error;
use web\frontend\{Handler, Get, Value, View};

#[Handler('/group')]
class Group {

  public function __construct(private YammerAPI $yammer, private Cache $cache) { }

  #[Get('/{id}')]
  public function index(#[Value] $user, int $id) {
    $endpoints= $this->yammer->as($user['token']);

    $groups= $this->cache->lookup($user['identity']['id'], 'groups', fn() => $endpoints
      ->api('groups/for_user/{id}', $user['identity'])
      ->get()
      ->value()
    );
    foreach ($groups as $group) {
      if ($group['id'] === $id) {
        $identifier= $this->yammer->id('Group', $id);
        $activity= $endpoints
          ->query('GroupActivitySummaryClients', 'ad34e6417baf4057bc4a03f0e47b4761bd4c48c7e254cee70b7622e685429ed1')
          ->execute(['groupId' => $identifier])
        ;
        return View::named('group')->with(['group' => $group, 'activity' => $activity, 'identifier' => $identifier]);
      }
    }

    throw new Error(404, 'No such group #'.$id);
  }
}