<?php
namespace App\Middleware;

  class ApiKeyMiddleware {
      public function handle(callable $next) {
            $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
         if (!preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
              http_response_code(401);
              header('Content-Type: application/json');
              echo json_encode(['error' => 'Missing or invalid Authorization header']);
              return;
          }

          return $next();
      }
  }