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
      ->query('FeedHomeClients', '1c2d15e105e964304db9941123e7ff4af0c3e6c44afda63c17fdc4c6f91ccb5e')
      ->execute(['feedType' => self::HOME_TYPES[$type], 'threadCount' => $limit, 'replyCount' => 0])
    ;
  }

  #[Get('/topics/{id}/{type}')]
  public function topics(#[Value] $user, string $id, string $type, #[Param] int $limit= 10) {
    return $this->yammer->as($user['token'])
      ->query('FeedTopicClients', '9e942eee31fb1cd16f58bcf1a28c258482cd071fafbad722d3cfdd45a69260ac')
      ->execute(['topicId' => $id, 'topicFeedType' => self::TOPIC_TYPES[$type], 'threadCount' => $limit, 'replyCount' => 0])
    ;
  }

  #[Get('/users/{id}')]
  public function user(#[Value] $user, string $id, #[Param] int $limit= 10) {
    return $this->yammer->as($user['token'])
      ->query('FeedUserClients', 'd5c3c13c4e643c36e936f4345e916e17cca7a6947980eaed04ba7d55ec20cd11')
      ->execute(['userId' => $id, 'threadCount' => $limit, 'replyCount' => 0])
    ;
  }
}