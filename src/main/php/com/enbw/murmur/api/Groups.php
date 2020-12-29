<?php namespace com\enbw\murmur\api;

use com\enbw\murmur\YammerAPI;
use web\rest\{Get, Resource, Param, Value};

#[Resource('/api/grouped')]
class Groups {
  private const FEEDS = [
    'all'       => 'ALL',
    'questions' => 'QUESTIONS',
  ];

  public function __construct(private YammerAPI $yammer) { }

  #[Get('/{kind}/{id}')]
  public function all(#[Value] $user, string $kind, string $id, #[Param] int $limit= 10) {
    return $this->yammer->as($user['token'])
      ->query('FeedGroupClients', '0079bf67919fe5d57572a9144e3eb6efc3354a7da8713a68c1e804061f928fed')
      ->execute([
        'groupId'       => base64_encode(json_encode(['_type' => 'Group', 'id' => $id])),
        'threadCount'   => $limit,
        'replyCount'    => 0,
        'groupFeedType' => self::FEEDS[$kind]
      ])
    ;
  }
}