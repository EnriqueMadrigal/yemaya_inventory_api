<?php

namespace App\Controllers;


abstract class BaseController {

public function sendResponse(int $status, array $data) {
          http_response_code($status);
          header('Content-Type: application/json');
          echo json_encode($data);
      }

 public function sendError(int $status, string $message) {
          $this->sendResponse($status, ['error' => $message]);
      }


public function getRequestData(): array {
          $input = file_get_contents('php://input');
          return json_decode($input, true) ?? [];
      }

}