<?php namespace com\enbw\murmur;

use com\github\mustache\InMemory;
use com\handlebarsjs\{HandlebarsEngine, FilesIn};
use io\Path;
use util\Date;
use util\log\Logging;
use web\frontend\Templates;

/** Template engine implementation using handlebars */
class TemplateEngine implements Templates {
  private $backing;

  public function __construct(#[Inject('templates')] Path $templates= null) {
    $this->backing= new HandlebarsEngine()
      ->withHelper('date', fn($in, $context, $options) => new Date($options[0])->toString($options[1] ?? 'd.m.Y'))
      ->withHelper('size', fn($in, $context, $options) => sizeof($options[0]))
      ->withHelper('encode', fn($in, $context, $options) => rawurlencode($options[0]))
      ->withHelper('equals', fn($in, $context, $options) => ($options[0] ?? '') === ($options[1] ?? ''))
      ->withHelper('declare', fn($in, $context, $options) => {
        $context->variables[$options[0]]= array_slice($options, 1);
        return null;
      })
      ->withHelper('source', fn($in, $context, $options) => {
        $source= $this->backing->templates()->source($options[0]);
        return str_replace('{{', '\\{{', $source->code());
      })
      ->withHelper('sub', fn($in, $context, $options) => {
        return preg_replace_callback('/\{([a-z]+)\}/', fn($matches) => $options[$matches[1]], $options[0]);
      })
    ;
    $this->backing->withLogger(Logging::named('trace')->toConsole());
    $templates && $this->backing->withTemplates(new FilesIn($templates));
  }

  /**
   * Exchanges templates
   *
   * @param  io.Path|[:string] $templates
   * @return self
   */
  public function using($templates) {
    $this->backing->withTemplates($templates instanceof Path ? new FilesIn($templates) : new InMemory($templates));
    return $this;
  }

  /**
   * Transforms a named partial
   *
   * @param  string $name Template name
   * @param  [:var] $context
   */
  public function partial($name, $context= []) {
    return $this->backing->transform('partials/'.$name, $context + ['scope' => $name]);
  }

  /**
   * Transforms a named template
   *
   * @param  string $name Template name
   * @param  [:var] $context
   * @param  io.streams.OutputStream $out
   */
  public function write($name, $context, $out) {
    $this->backing->write($this->backing->load($name), $context + ['scope' => $name], $out);
  }
}
