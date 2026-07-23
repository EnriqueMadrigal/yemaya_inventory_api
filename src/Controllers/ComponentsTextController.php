<?php
namespace App\Controllers;

//use App\Services\TaskService;

use App\Entities\ComponentsText;
use App\Services\ComponentsTextService;


class ComponentsTextController { 

private ComponentsTextService $componentsTextService;



public function __construct(ComponentsTextService $componentsTextService) {
        $this->componentsTextService = $componentsTextService;
    }

 private function sendResponse(int $status, array $data) {
          http_response_code($status);
          header('Content-Type: application/json');
          echo json_encode($data);
      }

      private function sendError(int $status, string $message) {
          $this->sendResponse($status, ['error' => $message]);
      }


public function getByIdProject(int $id) {
          try {
               $user = $this->componentsTextService->ReadAllByIdProject($id);
              
                if (($user) != null) {
               
              //$this->sendResponse(200, $user);
                $this->sendResponse(200, $user);
                }

          } catch (\Exception $e) {
              $this->sendError(400, $e->getMessage());
          }
      }


}