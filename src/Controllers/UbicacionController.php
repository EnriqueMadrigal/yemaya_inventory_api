<?php
namespace App\Controllers;

use App\Services\UbicacionService;


class UbicacionController extends BaseController{

private UbicacionService $UbicacionService;

public function __construct(UbicacionService $UbicacionService){

    $this->UbicacionService = $UbicacionService;
}
 
public function insert() {
        http_response_code(200);
        header('Content-Type: application/json');
          $data = $this->getRequestData();

          $return = $this->UbicacionService->createUbicacion($data);
          
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
        $unidades = $this->UbicacionService->getAll();
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

          $return = $this->UbicacionService->updateUbicacion($data);

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

        $unidad = $this->UbicacionService->getById($id);
        $this->sendResponse(200,$unidad->toArray());

          } catch (\Exception $e) {
              $this->sendError(400, $e->getMessage());
          }


    }


}