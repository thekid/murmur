<?php namespace com\enbw\murmur\api;

use com\enbw\murmur\YammerAPI;
use web\rest\{Get, Resource, Param, Value};

#[Resource('/api/grouped')]
class Groups {
  private const TYPES = [
    'all'       => 'ALL',
    'questions' => 'QUESTIONS',
  ];

  public function __construct(private YammerAPI $yammer) { }

  #[Get('/{type}/{id}')]
  public function all(#[Value] $user, string $type, string $id, #[Param] int $limit= 10) {
    return $this->yammer->as($user['token'])
      ->query('FeedGroupClients', '0079bf67919fe5d57572a9144e3eb6efc3354a7da8713a68c1e804061f928fed')
      ->execute([
        'groupId'       => $this->yammer->id('Group', $id),
        'threadCount'   => $limit,
        'replyCount'    => 0,
        'groupFeedType' => self::TYPES[$type]
      ])
    ;
  }
}