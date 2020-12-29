<?php namespace com\enbw\murmur\api;

use com\enbw\murmur\YammerAPI;
use web\rest\{Get, Resource, Param, Value};

#[Resource('/api/grouped')]
class Groups {
  private const HASH = '0079bf67919fe5d57572a9144e3eb6efc3354a7da8713a68c1e804061f928fed';

  public function __construct(private YammerAPI $yammer) { }

  #[Get('/all/{id}')]
  public function all(#[Value] $user, $id, #[Param] int $limit= 10) {
    return $this->yammer->as($user['token'])
      ->query('FeedGroupClients', self::HASH)
      ->execute([
        'groupId'       => base64_encode(json_encode(['_type' => 'Group', 'id' => $id])),
        'threadCount'   => $limit,
        'replyCount'    => 0,
        'groupFeedType' => 'ALL'
      ])
    ;
  }

  #[Get('/questions/{id}')]
  public function questions(#[Value] $user, $id, #[Param] int $limit= 10) {
    return $this->yammer->as($user['token'])
      ->query('FeedGroupClients', self::HASH)
      ->execute([
        'groupId'       => base64_encode(json_encode(['_type' => 'Group', 'id' => $id])),
        'threadCount'   => $limit,
        'replyCount'    => 0,
        'groupFeedType' => 'QUESTIONS'
      ])
    ;
  }
}