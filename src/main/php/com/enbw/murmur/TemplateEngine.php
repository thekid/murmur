<?php namespace com\enbw\murmur;

use com\github\mustache\InMemory;
use com\handlebarsjs\{HandlebarsEngine, FilesIn};
use io\Path;
use util\Date;
use web\frontend\Templates;

class TemplateEngine implements Templates {
  private $backing;

  public function __construct(#[Inject('templates')] Path $templates= null) {
    $this->backing= new HandlebarsEngine()
      ->withHelper('date', fn($in, $context, $options) => new Date($options[0])->toString($options[1] ?? 'd.m.Y'))
      ->withHelper('size', fn($in, $context, $options) => sizeof($options[0]))
      ->withHelper('encode', fn($in, $context, $options) => rawurlencode($options[0]))
      ->withHelper('equals', fn($in, $context, $options) => ($options[0] ?? '') === ($options[1] ?? ''))
      ->withHelper('sub', fn($in, $context, $options) => {
        parse_str($options[1], $params);
        return preg_replace_callback('/\{([a-z]+)\}/', fn($matches) => $params[$matches[1]], $options[0]);
      })
    ;
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
