<?php
namespace App\Controllers;

//use App\Services\TaskService;

use App\Entities\Paciente;
use App\Services\PacienteService;


class PacienteController { 

private PacienteService $pacienteService;


public function __construct(PacienteService $pacienteService) {
        $this->pacienteService = $pacienteService;
    }

 private function sendResponse(int $status, array $data) {
          http_response_code($status);
          header('Content-Type: application/json');
          echo json_encode($data);
      }

      private function sendError(int $status, string $message) {
          $this->sendResponse($status, ['error' => $message]);
      }


public function insert() {
        http_response_code(200);
        header('Content-Type: application/json');
          $data = $this->getRequestData();

          $return = $this->pacienteService->createPaciente($data);
        
          if (is_numeric($return))
            {
            echo json_encode([
        'error' => false,
        'message' => $return
        ]);

            }

            else {
            echo json_encode([
            'error' => true,
            'message' => $return
        ]);

            }
        
        //echo json_encode($return);
          //echo json_encode($data);
    }

 private function getRequestData(): array {
          $input = file_get_contents('php://input');
          return json_decode($input, true) ?? [];
      }


public function getPacientes() {
          try {
              $user = $this->pacienteService->ReadAllByIdPersona(3);
                if (is_array($user)) {
                  //  echo json_encode($user);
              //$this->sendResponse(200, $user);
                $this->sendResponse(200, $user);
                }

          } catch (\Exception $e) {
              $this->sendError(400, $e->getMessage());
          }
      }

public function getPaciente(int $id) {
          try {
              $user = $this->pacienteService->ReadIdPersona($id);
              
                if (($user) != null) {
               
              //$this->sendResponse(200, $user);
                $this->sendResponse(200, $user->toArray());
                }

          } catch (\Exception $e) {
              $this->sendError(400, $e->getMessage());
          }
      }


public function update() {
        http_response_code(200);
        header('Content-Type: application/json');
          $data = $this->getRequestData();

          $return = $this->pacienteService->UpdatePaciente($data);
        
          if ($return)
            {
            echo json_encode([
        'error' => false,
        'message' => "sucess"
        ]);

            }

            else {
            echo json_encode([
            'error' => true,
            'message' => $return
        ]);

            }
        
        //echo json_encode($return);
          //echo json_encode($data);
    }


    public function delete(int $id) {

      http_response_code(200);
        header('Content-Type: application/json');
          $data = $this->getRequestData();

          $return = $this->pacienteService->DeletePaciente($id);
        
          if ($return)
            {
            echo json_encode([
        'error' => false,
        'message' => "sucess"
        ]);
            }
            else {
            echo json_encode([
            'error' => true,
            'message' => $return
        ]);
            }
    }

}