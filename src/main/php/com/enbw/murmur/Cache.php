<?php namespace com\enbw\murmur;

/** Memory-based cache */
class Cache {
  private $buckets= [];

  public function __construct(private int $limit= 100) { }

  public function add(string $user, string $key, mixed $value): self {
    while (sizeof($this->buckets) > $this->limit) {
      unset($this->buckets[key($this->buckets)]);
    }

    $this->buckets[$user][$key]= $value;
    return $this;
  }

  public function lookup(string $user, string $key, mixed $default= null): mixed {
    return $this->buckets[$user][$key] ??= is_callable($default) ? $default() : $default;
  }

  public function clear(string $user) {
    unset($this->buckets[$user]);
  }
}