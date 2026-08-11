<?php

namespace App\Services;

use App\Repositories\UbicacionRepository;
use App\Entities\Ubicacion;


class UbicacionService {

private UbicacionRepository $UbicacionRepository;

public function __construct(UbicacionRepository $UbicacionRepository)
{
    $this->UbicacionRepository = $UbicacionRepository;
}

public function createUbicacion(Array $data) {

$newUbicacion = new Ubicacion();
$newUbicacion->setNombre($data['nombre']);
return $this->UbicacionRepository->save($newUbicacion);

}


public function updateUbicacion(Array $data) {

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

$updateUbicacion = new Ubicacion();
$updateUbicacion->setId($id);
$updateUbicacion->setNombre($data['nombre']);

return $this->UbicacionRepository->update($updateUbicacion);

        
}

public function getById(string $id): Ubicacion {

$curUbicacion = $this->UbicacionRepository->findById((int)$id);
return $curUbicacion;

}

public function getAll() :Array {
    return $this->UbicacionRepository->findAll();

}

}



