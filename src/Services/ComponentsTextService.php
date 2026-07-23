<?php
namespace App\Services;

use App\Entities\ComponentsText;
use App\Repositories\ComponentsTextRepository;


class ComponentsTextService {
    private $componentsTextRepository;

    public function __construct(ComponentsTextRepository $componentTextRepository) {
        $this->componentsTextRepository = $componentTextRepository;
    }


public function ReadAllByIdProject(int $id) {
        try {
            return $this->componentsTextRepository->findByProject($id);
              //return (int)$decoded->user_id;
          } catch (\Exception $e) {
            return $e->getMessage();
              //throw new \RuntimeException('Invalid or expired token');
          }

}





}