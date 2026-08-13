<?php

namespace App\Services;

use App\Repositories\MarcaRepository;
use App\Entities\Marca;


class MarcaService {

private MarcaRepository $MarcaRepository;

public function __construct(MarcaRepository $MarcaRepository)
{
    $this->MarcaRepository = $MarcaRepository;
}

public function createUnidaBasica(Array $data) {

$newMarca = new Marca();
$newMarca->setNombre($data['nombre']);
return $this->MarcaRepository->save($newMarca);

}


public function updateUnidaBasica(Array $data) {

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

$updateUnidaBasica = new Marca();
$updateUnidaBasica->setId($id);
$updateUnidaBasica->setNombre($data['nombre']);

return $this->MarcaRepository->update($updateUnidaBasica);

        
}

public function getById(string $id): Marca {

$curMarca = $this->MarcaRepository->findById((int)$id);
return $curMarca;

}

public function getAll() :Array {
    return $this->MarcaRepository->findAll();

}

}



