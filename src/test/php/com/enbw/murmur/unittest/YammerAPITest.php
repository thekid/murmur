<?php namespace com\enbw\murmur\unittest;

use com\enbw\murmur\YammerAPI;
use com\enbw\murmur\yammer\Endpoints;
use lang\IllegalArgumentException;
use unittest\{Test, Assert};

class YammerAPITest {
  private const ID = 'eyJfdHlwZSI6Ikdyb3VwIiwiaWQiOiI1MDE4NjkxOTkzNiJ9';

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
    Assert::instance(Endpoints::class, new YammerAPI()->as('174967-nr5Y0xAluWmiNnvtUQNNfg'));
  }
}