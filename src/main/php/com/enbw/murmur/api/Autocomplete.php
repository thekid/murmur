<?php namespace com\enbw\murmur\api;

use com\enbw\murmur\YammerAPI;
use web\rest\{Get, Resource, Param, Value};

#[Resource('/api/autocomplete')]
class Autocomplete {
  private const HASH = '0055d09b4b7f917e812e9947d84227b1dd209f2cad8e39fa61b860affc2e1509';

  public function __construct(private YammerAPI $yammer) { }

  #[Get]
  public function all(#[Value] $user, #[Param] string $q) {
    if (strlen($q) < 1) return [];

    $result= $this->yammer->as($user['token'])
      ->query('AutocompleteClients', self::HASH)
      ->execute([
        'text'          => $q,
        'countEach'     => 10,
        'includeGroups' => true,
        'includeUsers'  => true,
        'includeTopics' => false,
      ])
    ;

    $r= [
      'results' => [
        'users'  => ['name' => 'Users', 'results' => []],
        'groups' => ['name' => 'Groups', 'results' => []],
      ]
    ];
    foreach ($result['autocompleteSuggestions']['users']['edges'] as $edge) {
      $r['results']['users']['results'][]= [
        'title'       => $edge['node']['displayName'],
        'url'         => '/user/'.$edge['node']['databaseId'],
        'description' => $edge['node']['email'],
      ];
    }
    foreach ($result['autocompleteSuggestions']['groups']['edges'] as $edge) {
      $r['results']['groups']['results'][]= [
        'title'       => $edge['node']['displayName'],
        'url'         => '/group/'.$edge['node']['databaseId'],
        'description' => $edge['node']['description'],
      ];
    }
    return $r;
  }

  #[Get('/topics')]
  public function topics(#[Value] $user, #[Param] string $q) {
    if (strlen($q) < 1) return [];

    $result= $this->yammer->as($user['token'])
      ->query('AutocompleteClients', self::HASH)
      ->execute([
        'text'          => $q,
        'includeGroups' => false,
        'includeUsers'  => false,
        'includeTopics' => true,
      ])
    ;

    $r= ['success' => true, 'results' => []];
    foreach ($result['autocompleteSuggestions']['topics']['edges'] as $edge) {
      $r['results'][]= ['name' => $edge['node']['displayName'], 'value' => $edge['node']['id']];
    }
    return $r;
  }
}