<?php namespace com\enbw\murmur;

use com\enbw\murmur\yammer\Endpoints;
use lang\IllegalArgumentException;

/**
 * Yammer API
 *
 * @see  https://developer.yammer.com/docs/rest-api-rate-limits
 * @see  https://techcommunity.microsoft.com/t5/yammer-blog/yammer-api-with-aad-tokens-postman-collection/ba-p/857923
 * @see  https://techcommunity.microsoft.com/t5/yammer-blog/using-yammer-rest-api-with-the-new-yammer/ba-p/1625691
 */
class YammerAPI {
  public const PUBLIC = 'https://www.yammer.com/';

  public function __construct(private string $base= self::PUBLIC) { }

  /** Returns a composite Yammer ID from either a numeric or composite identifier */
  public function id(string $type, string $identifier): string {
    if (is_numeric($identifier)) {
      $id= $identifier;
    } else {
      $composite= json_decode(base64_decode($identifier), true);
      $composite['_type'] === $type || throw new IllegalArgumentException(sprintf(
        'Type encoded in given identifier (%s) does not match given type %s',
        $composite['_type'],
        $type
      ));
      $id= $composite['id'];
    }
    return rtrim(base64_encode(json_encode(['_type' => $type, 'id' => $id])), '=');
  }

  /** Returns and endpoint authenticated against a given token */
  public function as(string $token): Endpoints { return new Endpoints($this->base, $token); }
}
