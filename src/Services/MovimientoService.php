<?php

namespace App\Services;

use App\Repositories\MovimientoRepository;
use App\Entities\Movimiento;


class MovimientoService {

private MovimientoRepository $MovimientoRepository;

public function __construct(MovimientoRepository $MovimientoRepository)
{
    $this->MovimientoRepository = $MovimientoRepository;
}

public function insert(Array $data) {

 $user_id = (int)$_SERVER['USER_ID'];

$movimiento = new Movimiento();

$movimiento->setIdArticulo($data['id_articulo']);
$movimiento->setIdMedida($data['id_medida']);
$movimiento->setCantidad($data['cantidad']);
$movimiento->setTipo($data['tipo']);
$movimiento->setObservaciones($data['observaciones']);
return $this->MovimientoRepository->save($movimiento);

}


public function getById(string $id) : Movimiento{

$curMovimiento = $this->MovimientoRepository->findById($id);
return $curMovimiento;
}

public function getAll() :Array {
return $this->MovimientoRepository->findAll();

}



}