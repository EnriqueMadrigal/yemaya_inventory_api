<?php
namespace App\Controllers;

use App\Services\AuthService;

class AuthController {
      private $authService;

      public function __construct(AuthService $authService) {
          $this->authService = $authService;
      }

      public function login() {
          try {
              $data = $this->getRequestData();
              $email = $data['email'] ?? throw new \InvalidArgumentException('Email is required');
              $password = $data['password'] ?? throw new \InvalidArgumentException('Password is required');
              $result = $this->authService->login($email, $password);
              $this->sendResponse(200, ['data' => $result, 'message' => 'Login successful']);
          } catch (\Exception $e) {
              $this->sendError(401, $e->getMessage());
          }
      }

      private function getRequestData(): array {
          $input = file_get_contents('php://input');
          return json_decode($input, true) ?? [];
      }

      private function sendResponse(int $status, array $data) {
          http_response_code($status);
          header('Content-Type: application/json');
          echo json_encode($data);
      }

      private function sendError(int $status, string $message) {
          $this->sendResponse($status, ['error' => $message]);
      }
}
