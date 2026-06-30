<?php
namespace App\Middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

  class AuthMiddleware {
    
      public function __construct() {
          
      }

      public function handle(callable $next) {
          $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
          if (!preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
              http_response_code(401);
              header('Content-Type: application/json');
              echo json_encode(['error' => 'Missing or invalid Authorization header']);
              return;
          }

          try {
              $token = $matches[1];
              $payload = $this->validateToken($token);
              $_SERVER['USER_ID'] = $payload['user_id']; // Store user ID for controllers
              return $next();
          } catch (\Exception $e) {
              http_response_code(401);
              header('Content-Type: application/json');
              echo json_encode(['error' => $e->getMessage()]);
              return;
          }
      }

  public function validateToken(string $token): array {
          try {
              $decoded = JWT::decode($token, new Key($_ENV['JWT_SECRET'], 'HS256'));
              return (array)$decoded;
          } catch (\Exception $e) {
              throw new \RuntimeException('Invalid or expired token');
          }
      }

  }