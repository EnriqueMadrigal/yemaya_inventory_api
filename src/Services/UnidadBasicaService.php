<?php

namespace App\Services;

use App\Repositories\UnidadBasicaRepository;
use App\Entities\UnidadBasica;


class UnidadBasicaService {

private UnidadBasicaRepository $unidadBasicaRepository;

public function __construct(UnidadBasicaRepository $unidadBasicaRepository)
{
    $this->unidadBasicaRepository = $unidadBasicaRepository;
}

public function createUnidaBasica(Array $data) {

$newUnidadBasica = new UnidadBasica();
$newUnidadBasica->setNombre($data['nombre']);
return $this->unidadBasicaRepository->save($newUnidadBasica);

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

$updateUnidaBasica = new UnidadBasica();
$updateUnidaBasica->setId($id);
$updateUnidaBasica->setNombre($data['nombre']);

return $this->unidadBasicaRepository->update($updateUnidaBasica);

        
}

public function getById(string $id): UnidadBasica {

$curUnidadBasica = $this->unidadBasicaRepository->findById((int)$id);
return $curUnidadBasica;

}

public function getAll() :Array {
    return $this->unidadBasicaRepository->findAll();

}

}



