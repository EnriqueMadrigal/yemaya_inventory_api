<?php
namespace App\Routing;

  class Router {
      private $routes = [];
      private $middleware = [];
      


        /*
      public function get(string $path, callable $callback) {
          $this->routes['GET'][$path] = $callback;
      }
*/
      public function get(string $path, callable $callback, array $middleware = []) {
          $this->routes['GET'][$path] = ['callback' => $callback, 'middleware' => $middleware];
      }

     public function post(string $path, callable $callback, array $middleware = []) {
          $this->routes['POST'][$path] = ['callback' => $callback, 'middleware' => $middleware];
      }

     public function put(string $path, callable $callback, array $middleware = []) {
          $this->routes['PUT'][$path] = ['callback' => $callback, 'middleware' => $middleware];
      }

      public function delete(string $path, callable $callback, array $middleware = []) {
          $this->routes['DELETE'][$path] = ['callback' => $callback, 'middleware' => $middleware];
      }


      public function dispatch() {
          $method = $_SERVER['REQUEST_METHOD'];
          $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

          // Remove base path if API is not at root
          //$basePath = '/api';
          $basePath = '';
          if (strpos($uri, $basePath) === 0) {
              $uri = substr($uri, strlen($basePath));
          }

          
           foreach ($this->routes[$method] ?? [] as $route => $handler) {
              $pattern = preg_replace('#\{([\w]+)\}#', '([^/]+)', $route);
              $pattern = "#^$pattern$#";
              if (preg_match($pattern, $uri, $matches)) {
                  array_shift($matches);
                  $callback = $handler['callback'];
                  $middleware = $handler['middleware'];

                  // Run middleware
                  $next = fn() => call_user_func_array($callback, $matches);
                  foreach (array_reverse($middleware) as $mwClass) {
                      $mw = new $mwClass();
                      $next = fn() => $mw->handle($next);
                  }
                  return $next();
              }
          }

          http_response_code(404);
          header('Content-Type: application/json');
          echo json_encode(['error' => 'Route not found']);
      }
  }