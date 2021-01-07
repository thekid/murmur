<?php namespace com\enbw\murmur\yammer;

use peer\http\HttpConnection;
use util\URI;
use webservices\rest\{Endpoint, RestResource};

class Endpoints {
  private $endpoint;

  /** Creates an endpoints collection */
  public function __construct(string $base, string $token) {
    $this->endpoint= new Endpoint($base)->with([
      'Authorization' => 'Bearer '.$token,
      'User-Agent'    => 'XP/YammerAPI'
    ]);
  }

  /** Replace connection function */
  public function connecting(function(URI): HttpConnection $connection): self {
    $this->endpoint->connecting($connection);
    return $this;
  }

  /**
   * Returns a v1 API REST resource for a given path
   *
   * @see  https://developer.yammer.com/docs/rest-api-rate-limits
   */
  public function api(string $path, array $segments= []): RestResource {
    return $this->endpoint->resource('/api/v1/'.ltrim($path, '/').'.json', $segments);
  }

  /**
   * Returns a GraphQL persisted query
   *
   * @see  https://www.apollographql.com/blog/persisted-graphql-queries-with-apollo-client-119fd7e6bba5/
   */
  public function query(string $operation, string $hash): GraphQLQuery {
    return new GraphQLQuery($this->endpoint->resource('/graphql'), null, $operation, [
      'persistedQuery' => ['version' => 1, 'sha256Hash' => $hash]
    ]);
  }
}