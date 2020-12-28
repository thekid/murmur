<?php namespace com\enbw\murmur;

use com\enbw\murmur\yammer\Endpoints;

/**
 * Yammer API
 *
 * @see  https://developer.yammer.com/docs/rest-api-rate-limits
 * @see  https://techcommunity.microsoft.com/t5/yammer-blog/yammer-api-with-aad-tokens-postman-collection/ba-p/857923
 */
class YammerAPI {
  public const PUBLIC = 'https://www.yammer.com/';

  public function __construct(private string $base= self::PUBLIC) { }

  /** Returns and endpoint authenticated against a given token */
  public function as(string $token): Endpoints { return new Endpoints($this->base, $token); }
}
