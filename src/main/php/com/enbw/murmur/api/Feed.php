<?php namespace com\enbw\murmur\api;

use com\enbw\murmur\YammerAPI;
use web\rest\{Get, Resource, Param, Value};

#[Resource('/api/feed')]
class Feed {
  private const FEEDHOME  = '7807875433b9a6621e71bbe5937236b7464feef1dbcf56b415d93fa3e68a44a7';
  private const FEEDGROUP = '0079bf67919fe5d57572a9144e3eb6efc3354a7da8713a68c1e804061f928fed';

  public function __construct(private YammerAPI $yammer) { }

  #[Get('/all')]
  public function all(#[Value] $user, #[Param] int $limit= 10) {
    return $this->yammer->as($user['token'])
      ->query('FeedHomeClients', hash: self::FEEDHOME)
      ->execute(['feedType' => 'ALL_PUBLIC_GROUPS', 'threadCount' => $limit, 'replyCount' => 0])
    ;
  }

  #[Get('/discovery')]
  public function discovery(#[Value] $user, #[Param] int $limit= 10) {
    return $this->yammer->as($user['token'])
      ->query('FeedHomeClients', hash: self::FEEDHOME)
      ->execute(['feedType' => 'DISCOVERY', 'threadCount' => $limit, 'replyCount' => 0])
    ;
  }

  #[Get('/following')]
  public function following(#[Value] $user, #[Param] int $limit= 10) {
    return $this->yammer->as($user['token'])
      ->query('FeedHomeClients', hash: self::FEEDHOME)
      ->execute(['feedType' => 'FOLLOWING_AND_ALLCOMPANY', 'threadCount' => $limit, 'replyCount' => 0])
    ;
  }

  #[Get('/group/{id}')]
  public function group(#[Value] $user, $id, #[Param] int $limit= 10) {
    return $this->yammer->as($user['token'])
      ->query('FeedGroupClients', hash: self::FEEDGROUP)
      ->execute([
        'groupId'     => base64_encode(json_encode(['_type' => 'Group', 'id' => $id])),
        'threadCount' => $limit,
        'replyCount'  => 0
      ])
    ;
  }
}