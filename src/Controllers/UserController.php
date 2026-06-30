<?php
namespace App\Controllers;

//use App\Services\TaskService;

use App\Entities\User;
use App\Services\UserService;


class UserController { 

private $userService;

public function __construct(UserService $userService) {
        $this->userService = $userService;
    }


public function getById(int $userId) {
          try {
              $user = $this->userService->getById($userId);
                if ($user != null) {
              $this->sendResponse(200, $user->toArray());
                }

          } catch (\Exception $e) {
              $this->sendError(400, $e->getMessage());
          }
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
