<?php namespace com\enbw\murmur;

use io\streams\Streams;
use lang\IllegalAccessException;
use web\auth\oauth\OAuth2Flow;
use web\auth\{Authentication, SessionBased, UseURL, UseRequest};
use web\session\Sessions;

/**
 * Integrates platform with Office 365 OAuth and Microsoft Graph,
 * using the well-known endpoints for these services
 *
 * @see  https://developer.microsoft.com/en-us/graph/graph-explorer
 */
class Office365Integration {
  private const LOGIN_URL  = 'https://login.microsoftonline.com';
  private const GRAPH_API  = 'https://graph.microsoft.com';
  private const YAMMER_API = 'https://www.yammer.com/api';
  private $flow;

  /**
   * Instantiate integration with a given oauth URI, which is of the form:
   *
   * `oauth2://${oauth_clientid}:${oauth_secret}@{oauth_appid}?{scopes}`
   */
  public function __construct(string $oauth, string $service) {
    $uri= parse_url($oauth);
    $this->flow= new OAuth2Flow(
      self::LOGIN_URL.'/'.$uri['host'].'/oauth2/v2.0/authorize',
      self::LOGIN_URL.'/'.$uri['host'].'/oauth2/v2.0/token',
      [$uri['user'], $uri['pass']],
      callback: '/',
      scopes: isset($uri['query']) ? explode(',', $uri['query']) : ['User.Read'],
    );
    $this->flow->target($service ? new UseURL($service) : new UseRequest());
  }

  /**
   * Returns an authentication instance using the given sessions factory. Once
   * authentication via Office 365 SSO has completed, store user and access token
   * in the session for later 
   */
  public function using(Sessions $sessions): Authentication {
    return new SessionBased($this->flow, $sessions, fn($session) => {
      $response= $session->fetch(self::YAMMER_API.'/v1/oauth/tokens.json');
      if (200 !== $response->status()) {
        throw new IllegalAccessException(Streams::readAll($response->stream()));
      }

      $token= $response->value()[0]['token'];
      $identity= $session->fetch(self::YAMMER_API.'/v1/users/current.json')->value();
      $groups= $session->fetch(self::YAMMER_API.'/v1/groups/for_user/'.$identity['id'].'.json')->value();
      return ['identity' => $identity, 'token' => $token, 'groups' => $groups];
    });
  }
}