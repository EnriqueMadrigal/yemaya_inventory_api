<?php
namespace App\Controllers;

use App\Services\UnidadBasicaService;


class UnidadBasicaController {

private UnidadBasicaService $unidadBasicaService;

public function __construct(UnidadBasicaService $unidadBasicaService){

    $this->unidadBasicaService = $unidadBasicaService;
}

 private function sendResponse(int $status, array $data) {
          http_response_code($status);
          header('Content-Type: application/json');
          echo json_encode($data);
      }

 private function sendError(int $status, string $message) {
          $this->sendResponse($status, ['error' => $message]);
      }


private function getRequestData(): array {
          $input = file_get_contents('php://input');
          return json_decode($input, true) ?? [];
      }

public function insert() {
        http_response_code(200);
        header('Content-Type: application/json');
          $data = $this->getRequestData();

          $return = $this->unidadBasicaService->createUnidaBasica($data);
          
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
        
       
    }
      

    public function getAll() {

    try {
        $unidades = $this->unidadBasicaService->getAll();

        if (is_array($unidades)) {
            $this->sendResponse(200,$unidades);
        }
        
        } catch (\Exception $e) {
              $this->sendError(400, $e->getMessage());
          }

    }


    public function update() {

   http_response_code(200);
        header('Content-Type: application/json');
          $data = $this->getRequestData();

          $return = $this->unidadBasicaService->updateUnidaBasica($data);

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

    public function getById(string $id) {
        try{

        $unidad = $this->unidadBasicaService->getById($id);
        $this->sendResponse(200,$unidad->toArray());

          } catch (\Exception $e) {
              $this->sendError(400, $e->getMessage());
          }


    }


}