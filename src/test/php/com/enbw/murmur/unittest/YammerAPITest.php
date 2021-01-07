<?php namespace com\enbw\murmur\unittest;

use com\enbw\murmur\YammerAPI;
use com\enbw\murmur\yammer\Endpoints;
use lang\IllegalArgumentException;
use unittest\{Test, Assert, Expect};
use webservices\rest\RestException;

class YammerAPITest {
  private const ID = 'eyJfdHlwZSI6Ikdyb3VwIiwiaWQiOiI1MDE4NjkxOTkzNiJ9';
  private const TOKEN = '174967-nr5Y0xAluWmiNnvtUQNNfg';
  private const HASH = '0055d09b4b7f917e812e9947d84227b1dd209f2cad8e39fa61b860affc2e1509';

  /** Returns an Endpoints instance which echoes HTTP requests */
  private function echoing($func): Endpoints {
    $fixture= new YammerAPI()->as(self::TOKEN);
    $fixture->endpoint->connecting(fn($uri) => new EchoingConnection($uri, $func));
    return $fixture;
  }

  #[Test]
  public function can_create() {
    new YammerAPI();
  }

  #[Test]
  public function can_create_with_endpoint() {
    new YammerAPI('https://develop.yammer.local/');
  }

  #[Test]
  public function transform_database_id_to_id() {
    Assert::equals(self::ID, new YammerAPI()->id('Group', 50186919936));
  }

  #[Test]
  public function transform_id_to_id() {
    Assert::equals(self::ID, new YammerAPI()->id('Group', self::ID));
  }

  #[Test, Expect(IllegalArgumentException::class)]
  public function transforming_group_id_to_user_type_raises_exception() {
    new YammerAPI()->id('User', self::ID);
  }

  #[Test]
  public function as_returns_authenticated_endpoints() {
    Assert::instance(Endpoints::class, new YammerAPI()->as(self::TOKEN));
  }

  #[Test]
  public function rest_api_request() {
    $res= $this->echoing(fn($req, $payload) => [200, $req->method.' '.$req->target()])
      ->api('users/current')
      ->get()
      ->value()
    ;

    Assert::equals('GET /api/v1/users/current.json', $res);
  }

  #[Test]
  public function graphql_query() {
    $res= $this->echoing(fn($req, $payload) => [200, ['data' => [$req->method.' '.$req->target(), $payload]]])
      ->query('AutocompleteClients', self::HASH)
      ->execute(['text' => 'Test'])
    ;

    Assert::equals(
      ['POST /graphql', json_encode([
        'query'         => null,
        'operationName' => 'AutocompleteClients',
        'variables'     => ['text' => 'Test'],
        'extensions'    => ['persistedQuery' => ['version' => 1, 'sha256Hash' => self::HASH]]
      ])],
      $res
    );
  }

  #[Test, Expect(RestException::class)]
  public function graphql_query_raising_error() {
    $this->echoing(fn($req, $payload) => [200, ['errors' => ['Incorrect hash']]])
      ->query('AutocompleteClients', 'incorrect-hash')
      ->execute(['text' => 'Test'])
    ;
  }
}