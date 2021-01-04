<?php namespace com\enbw\murmur\api;

use com\enbw\murmur\YammerAPI;
use web\rest\{Get, Resource, Param, Value};

#[Resource('/api/autocomplete')]
class Autocomplete {

  public function __construct(private YammerAPI $yammer) { }

  #[Get('/topics')]
  public function topics(#[Value] $user, #[Param] string $q) {
    if (strlen($q) < 1) return [];

    $result= $this->yammer->as($user['token'])
      ->query('AutocompleteClients', '0055d09b4b7f917e812e9947d84227b1dd209f2cad8e39fa61b860affc2e1509')
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