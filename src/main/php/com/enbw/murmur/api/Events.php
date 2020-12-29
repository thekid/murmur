<?php namespace com\enbw\murmur\api;

use com\enbw\murmur\YammerAPI;
use util\Date;
use web\rest\{Get, Resource, Param, Value};

#[Resource('/api/events')]
class Events {

  public function __construct(private YammerAPI $yammer) { }

  #[Get]
  public function all(#[Value] $user, #[Param] int $limit= 10) {
    return $this->yammer->as($user['token'])
      ->query('NetworkLiveEventsClients', hash: 'd0e0c0055f8df84dbd9fb54b8f03c8cf6efc0e9175c8a967ca344e422fa2608f')
      ->execute(['first' => $limit])
    ;
  }

  #[Get('/group/{id}')]
  public function group(#[Value] $user, string $id, #[Param] string $start= null) {
    return $this->yammer->as($user['token'])
      ->query('GroupLiveEventsClients', hash: '698feacf237f30b87f7ff1caf4b1133a9385607e6e8704ccc7b8035801c45149')
      ->execute([
        'groupId'    => $this->yammer->id('Group', $id),
        'startAfter' => new Date($start)->toString('c')
      ])
    ;
  }
}