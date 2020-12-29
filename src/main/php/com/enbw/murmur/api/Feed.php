<?php namespace com\enbw\murmur\api;

use com\enbw\murmur\YammerAPI;
use web\rest\{Get, Resource, Param, Value};

#[Resource('/api/feed')]
class Feed {
  private const TYPES = [
    'all'       => 'ALL_PUBLIC_GROUPS',
    'discovery' => 'DISCOVERY',
    'following' => 'FOLLOWING_AND_ALLCOMPANY'
  ];

  public function __construct(private YammerAPI $yammer) { }

  #[Get('/{type}')]
  public function all(#[Value] $user, string $type, #[Param] int $limit= 10) {
    return $this->yammer->as($user['token'])
      ->query('FeedHomeClients', '7807875433b9a6621e71bbe5937236b7464feef1dbcf56b415d93fa3e68a44a7')
      ->execute(['feedType' => self::TYPES[$type], 'threadCount' => $limit, 'replyCount' => 0])
    ;
  }
}