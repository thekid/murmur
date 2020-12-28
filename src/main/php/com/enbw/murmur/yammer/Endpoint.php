<?php namespace com\enbw\murmur\yammer;

use util\Secret;
use webservices\rest\Endpoint as RestEndpoint;

class Endpoint {

  public function __construct(private Secret $token) 
}