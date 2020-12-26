<?php namespace com\enbw\murmur\web;

class Referenced {
  public $reference;

  public function __construct(public array<string, mixed> $data) {
    $lookup= [];
    foreach ($data['references'] as $reference) {
      $lookup[$reference['type']][$reference['id']]= $reference;
    }
    $this->reference= fn($node, $context, $options) => {
      $context->variables[$options[0]]= &$lookup[$options[1]][$options[2]] ?? null;
    };
  }
}