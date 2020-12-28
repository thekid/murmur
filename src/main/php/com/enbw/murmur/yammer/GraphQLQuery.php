<?php namespace com\enbw\murmur\yammer;

use util\Objects;
use webservices\rest\{RestResource, RestException};

class GraphQLQuery {
  private const JSON = 'application/json';

  /** Creates a new GraphQL query instance */
  public function __construct(
    private RestResource $resource,
    private ?string $query,
    private string $operation,
    private array $extensions= []
  ) { }

  /**
   * Executes a GraphQL query and returns the results
   *
   * @throws webservices.rest.RestException
   */
  public function execute(array $variables): mixed {
    $payload= [
      'query'         => $this->query,
      'operationName' => $this->operation,
      'variables'     => $variables,
      'extensions'    => $this->extensions,
    ];

    $response= $this->resource->accepting(self::JSON)->post($payload, self::JSON);
    if (200 !== $response->status()) {
      throw new RestException('HTTP/'.$response->status().': '.$response->message());
    }

    $result= $response->value();
    if (isset($result['errors'])) {
      throw new RestException(Objects::stringOf($result['errors']));
    }

    return $result['data'];
  }
}