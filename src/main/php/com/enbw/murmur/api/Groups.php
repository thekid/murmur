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
      ->query('FeedGroupClients', '0d280e317d30a254a2578eb4ed0d4c83ffda40a7c317605cd92c69b08cb6f4ea')
      ->execute([
        'groupId'       => $this->yammer->id('Group', $id),
        'threadCount'   => $limit,
        'replyCount'    => 0,
        'groupFeedType' => self::TYPES[$type]
      ])
    ;
  }
}