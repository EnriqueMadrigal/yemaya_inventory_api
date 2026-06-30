<?php
namespace App\Controllers;

//use App\Services\TaskService;
use Firebase\JWT\JWT;
use App\Entities\User;
use App\Services\UserService;


class LoginController {
   

private  $userService;

public function __construct(UserService $userService) {
        //$this->taskService = $taskService;
        $this->userService = $userService;
    }


    public function Login() {
           http_response_code(200);
        header('Content-Type: application/json');
          $data = $this->getRequestData();
$key = "1234567890123456789012345678901234567890"; // Keep this very secure!

$payload = [
    'iss' => 'http://example.org', // Issuer
    'aud' => 'http://example.com', // Audience
    'iat' => time(),               // Issued at
    'nbf' => time(),               // Not before
    'exp' => time() + 3600,        // Expiration (1 hour)
    'data' => [
        'userId' => 123,
        'email' => 'user@example.com'
    ]
];


          $jwt = JWT::encode($payload, $key, 'HS256');

        echo json_encode(['access_token' => $jwt]);
    }


 public function register() {
           http_response_code(200);
        header('Content-Type: application/json');
          $data = $this->getRequestData();

          $return = $this->userService->createUser($data);
            
        echo json_encode($return);
          //echo json_encode($data);
    }


 private function getRequestData(): array {
          $input = file_get_contents('php://input');
          return json_decode($input, true) ?? [];
      }


}
