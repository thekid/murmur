<?php namespace com\enbw\murmur\unittest;

use io\streams\MemoryInputStream;
use peer\http\{HttpConnection, HttpOutputStream, HttpRequest, HttpResponse};
use util\URI;

class EchoingConnection extends HttpConnection {

  /** Creates a new instance using a URI and a given function */
  public function __construct(URI $uri, private function(HttpRequest): mixed $function) {
    parent::__construct($uri);
  }

  /** Returns a response echoing the request message */
  private function response($status, $payload): HttpResponse {
    $bytes= json_encode($payload);
    return new HttpResponse(new MemoryInputStream(sprintf(
      "HTTP/1.1 %d ...\r\nContent-Type: application/json\r\nContent-Length: %d\r\n\r\n%s",
      $status,
      strlen($bytes),
      $bytes
    )));
  }

  /** Opens a request for writing */
  public function open(HttpRequest $request): HttpOutputStream {
    return new class($request) extends HttpOutputStream {
      public function __construct(public HttpRequest $request, public string $payload= '') { }
      public function write($bytes): void { $this->payload.= $bytes; }
    };
  }

  /** Sends a request */
  public function send(HttpRequest $request): HttpResponse {
    return $this->response(...($this->function)($request, null));
  }

  /** Finishes writing a reqiest */
  public function finish(HttpOutputStream $stream): HttpResponse {
    return $this->response(...($this->function)($stream->request, $stream->payload));
  }
}