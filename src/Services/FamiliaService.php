<?php

namespace App\Services;

use App\Repositories\FamiliaRepository;
use App\Entities\Familia;


class FamiliaService {

private FamiliaRepository $FamiliaRepository;

public function __construct(FamiliaRepository $FamiliaRepository)
{
    $this->FamiliaRepository = $FamiliaRepository;
}

public function createFamilia(Array $data) {

$newFamilia = new Familia();
$newFamilia->setNombre($data['nombre']);
return $this->FamiliaRepository->save($newFamilia);

}


public function updateFamilia(Array $data) {

  if (
            !isset($data['id']) ||
            !is_numeric($data['id']) ||
            (int) $data['id'] <= 0
        ) {
            throw new \InvalidArgumentException(
                'The measurement unit ID is required.'
            );
        }

$id = (int) $data['id'];

$updateFamilia = new Familia();
$updateFamilia->setId($id);
$updateFamilia->setNombre($data['nombre']);

return $this->FamiliaRepository->update($updateFamilia);

        
}

public function getById(string $id): Familia {

$curFamilia = $this->FamiliaRepository->findById((int)$id);
return $curFamilia;

}

public function getAll() :Array {
    return $this->FamiliaRepository->findAll();

}

}



