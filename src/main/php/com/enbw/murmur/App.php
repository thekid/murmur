<?php namespace com\enbw\murmur;

use inject\{Injector, Bindings};
use io\Path;
use lang\Environment;
use security\credentials\{Credentials, FromEnvironment, FromFile};
use web\frontend\{Frontend, HandlersIn, Templates};
use web\handler\FilesFrom;
use web\rest\{RestApi, ResourcesIn};
use web\session\{Sessions, InFileSystem, Cookies};
use web\{Application, Filters};

/** Murmur web application */
class App extends Application {

  /** Returns routing for this web application */
  public function routes() {
    $webroot= $this->environment->webroot();
    $credentials= new Credentials(new FromEnvironment(), new FromFile(new Path($webroot, 'credentials')));

    $inject= new Injector(Bindings::using()
      ->properties($credentials->expanding($this->environment->properties('inject')))
      ->singleton(Templates::class, TemplateEngine::class)
      ->singleton(YammerAPI::class)
      ->singleton(Cache::class)
      ->named('templates', new Path($webroot, 'src/main/handlebars'))
      ->named('service', (string)getenv('SERVICE_URL'))
    );

    // Allow insecure session cookies in "dev" environment
    $sessions= new InFileSystem(Environment::tempDir());
    if ('dev' === $this->environment->profile()) {
      $sessions->via(new Cookies()->insecure(true));
    }
    $inject->bind(Sessions::class, $sessions);

    $auth= $inject->get(Office365Integration::class)->using($sessions);
    $files= new FilesFrom(new Path($webroot, 'src/main/webapp'));
    return [
      '/favicon.ico' => $files,
      '/static'      => $files,
      '/api'         => $auth->required(new RestApi(
        new ResourcesIn('com.enbw.murmur.api', [$inject, 'get'])
      )),
      '/'            => $auth->required(new Frontend(
        new HandlersIn('com.enbw.murmur.web', [$inject, 'get']),
        $inject->get(Templates::class),
        '/'
      ))
    ];
  }
}