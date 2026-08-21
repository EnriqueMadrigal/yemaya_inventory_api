<?php

namespace App\Controllers;

use App\Services\MovimientoService;


class MovimientoController extends BaseController {

private MovimientoService $movimientoService;

public function __construct(MovimientoService $movimientoService)
{
    $this->movimientoService = $movimientoService;
}


public function insert() {

http_response_code(200);


 header('Content-Type: application/json');
          $data = $this->getRequestData();

          $return = $this->movimientoService->insert($data);
          
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
        $unidades = $this->movimientoService->getAll();

        if (is_array($unidades)) {
            $this->sendResponse(200, $unidades);
        }
        
        } catch (\Exception $e) {
              $this->sendError(400, $e->getMessage());
          }

    }


public function getById(string $id) {
        try{

        $unidad = $this->movimientoService->getById($id);
        $this->sendResponse(200,$unidad->toArray());

          } catch (\Exception $e) {
              $this->sendError(400, $e->getMessage());
          }


    }



}