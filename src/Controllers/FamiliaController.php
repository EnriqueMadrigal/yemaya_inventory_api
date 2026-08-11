<?php
namespace App\Controllers;

use App\Services\FamiliaService;


class FamiliaController extends BaseController{

private FamiliaService $FamiliaService;

public function __construct(FamiliaService $FamiliaService){

    $this->FamiliaService = $FamiliaService;
}

 
public function insert() {
        http_response_code(200);
        header('Content-Type: application/json');
          $data = $this->getRequestData();

          $return = $this->FamiliaService->createFamilia($data);
          
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
        $unidades = $this->FamiliaService->getAll();

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

          $return = $this->FamiliaService->updateFamilia($data);

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

        $unidad = $this->FamiliaService->getById($id);
        $this->sendResponse(200,$unidad->toArray());

          } catch (\Exception $e) {
              $this->sendError(400, $e->getMessage());
          }


    }


}