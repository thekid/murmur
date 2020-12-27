<?php namespace com\enbw\murmur;

use webservices\rest\Endpoint;

/**
 * Yammer API
 *
 * @see  https://developer.yammer.com/docs/rest-api-rate-limits
 * @see  https://techcommunity.microsoft.com/t5/yammer-blog/yammer-api-with-aad-tokens-postman-collection/ba-p/857923
 * @see  https://www.apollographql.com/blog/persisted-graphql-queries-with-apollo-client-119fd7e6bba5/
 */
class YammerAPI {

  /** Returns and endpoint authenticated against a given token */
  public function as(string $token): Endpoint {
    return new Endpoint('https://www.yammer.com/api/v1')->with([
      'Authorization' => 'Bearer '.$token,
      'User-Agent'    => 'XP/HTTP',
      'Accept'        => '*/*'
    ]);
  }
}
