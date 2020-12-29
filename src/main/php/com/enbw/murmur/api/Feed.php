<?php namespace com\enbw\murmur\api;

use com\enbw\murmur\YammerAPI;
use web\rest\{Get, Resource, Param, Value};

#[Resource('/api/feed')]
class Feed {
  private const HASH = '7807875433b9a6621e71bbe5937236b7464feef1dbcf56b415d93fa3e68a44a7';

  public function __construct(private YammerAPI $yammer) { }

  #[Get('/all')]
  public function all(#[Value] $user, #[Param] int $limit= 10) {
    return $this->yammer->as($user['token'])
      ->query('FeedHomeClients', self::HASH)
      ->execute(['feedType' => 'ALL_PUBLIC_GROUPS', 'threadCount' => $limit, 'replyCount' => 0])
    ;
  }

  #[Get('/discovery')]
  public function discovery(#[Value] $user, #[Param] int $limit= 10) {
    return $this->yammer->as($user['token'])
      ->query('FeedHomeClients', self::HASH)
      ->execute(['feedType' => 'DISCOVERY', 'threadCount' => $limit, 'replyCount' => 0])
    ;
  }

  #[Get('/following')]
  public function following(#[Value] $user, #[Param] int $limit= 10) {
    return $this->yammer->as($user['token'])
      ->query('FeedHomeClients', self::HASH)
      ->execute(['feedType' => 'FOLLOWING_AND_ALLCOMPANY', 'threadCount' => $limit, 'replyCount' => 0])
    ;
  }
}