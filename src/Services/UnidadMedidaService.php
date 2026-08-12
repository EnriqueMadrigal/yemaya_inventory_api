<?php

namespace App\Services;

use App\Repositories\UnidadMedidaRepository;
use App\Entities\UnidadMedida;

class UnidadMedidaService {

private UnidadMedidaRepository $unidadMedidaRepository;

public function __construct(UnidadMedidaRepository $unidadMedidaRepository)
{
    $this->unidadMedidaRepository = $unidadMedidaRepository;
}

public function insert(Array $data) {
$newUnidadMedida = new UnidadMedida();
$newUnidadMedida->setNombreMedida($data['nombre']);
$newUnidadMedida->setid_unidad_basica($data['id_unidad_basica']);
$newUnidadMedida->setcantidad_medida($data['cantidad_medida']);

return $this->unidadMedidaRepository->save($newUnidadMedida);

}

public function update(Array $data) {

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

        $newUnidadMedida = new UnidadMedida();
        $newUnidadMedida->setNombreMedida($data['nombre']);
        $newUnidadMedida->setid_unidad_basica($data['id_unidad_basica']);
        $newUnidadMedida->setcantidad_medida($data['cantidad_medida']);
        $newUnidadMedida->setId($id);

        return $this->unidadMedidaRepository->update($newUnidadMedida);

}

public function getById(string $id): UnidadMedida {

$curUnidad = $this->unidadMedidaRepository->findById((int)$id);
return $curUnidad;

}

public function getAll(): Array {
return $this->unidadMedidaRepository->findAll();

}




}