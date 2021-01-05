<?php namespace com\enbw\murmur\api;

use com\enbw\murmur\YammerAPI;
use web\rest\{Get, Resource, Param, Value};

#[Resource('/api/feed')]
class Feed {
  private const HOME_TYPES = [
    'all'       => 'ALL_PUBLIC_GROUPS',
    'discovery' => 'DISCOVERY',
    'following' => 'FOLLOWING_AND_ALLCOMPANY',
  ];
  private const TOPIC_TYPES = [
    'all'       => 'ALL',
    'questions' => 'QUESTIONS',
  ];

  public function __construct(private YammerAPI $yammer) { }

  #[Get('/{type}')]
  public function all(#[Value] $user, string $type, #[Param] int $limit= 10) {
    return $this->yammer->as($user['token'])
      ->query('FeedHomeClients', '7807875433b9a6621e71bbe5937236b7464feef1dbcf56b415d93fa3e68a44a7')
      ->execute(['feedType' => self::HOME_TYPES[$type], 'threadCount' => $limit, 'replyCount' => 0])
    ;
  }

  #[Get('/topics/{id}/{type}')]
  public function topics(#[Value] $user, string $id, string $type, #[Param] int $limit= 10) {
    return $this->yammer->as($user['token'])
      ->query('FeedTopicClients', '4a07da296057c6960cc400d9299a769eeeda99781553483fb06b6437906e6df9')
      ->execute(['topicId' => $id, 'topicFeedType' => self::TOPIC_TYPES[$type], 'threadCount' => $limit, 'replyCount' => 0])
    ;
  }
}