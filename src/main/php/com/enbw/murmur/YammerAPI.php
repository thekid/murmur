<?php namespace com\enbw\murmur;

use webservices\rest\Endpoint;

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
