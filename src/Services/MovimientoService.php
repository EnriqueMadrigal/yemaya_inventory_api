<?php

namespace App\Services;

use App\Repositories\MovimientoRepository;
use App\Entities\Movimiento;
use App\Repositories\ArticuloRepository;
use App\Repositories\UnidadMedidaRepository; 
use App\Entities\UnidadMedida; 



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
$movimiento->setUpdatedBy($data['updated_by']);
$movimiento->setObservaciones($data['observaciones']);




$idArticulo = (int)$data['id_articulo'];
$tipoMov = (int)$data['tipo'];
$idUnidad = (int)$data['id_medida'];
$cantidad = (float)$data['cantidad'];

if ($cantidad <= 0) {
    return ("La cantidad del movimiento debe ser mayor a cero.");
}   




$articuloRepository = new ArticuloRepository();
$unidadMedidaRepository = new UnidadMedidaRepository();

$articulo = $articuloRepository->findById($idArticulo);

$unidadMedidaArticulo = $articulo->getIdUnidad();

$unidadMedida = $unidadMedidaRepository->findById($idUnidad);
$idUnidadBasica = $unidadMedida->getid_unidad_basica();




if ($unidadMedidaArticulo !== $idUnidadBasica) {
    return ("La unidad de medida del artículo no coincide con la unidad de medida del movimiento.");
}


$cantidadTotal = $cantidad * (float)$unidadMedida->getcantidad_medida();

$idMov = $this->MovimientoRepository->save($movimiento); 


if ($tipoMov == 1) {
    $articuloRepository->addCantidad($idArticulo, $cantidadTotal);
} elseif ($tipoMov == 2) {
    $articuloRepository->substractCantidad($idArticulo, $cantidadTotal);
}


return $idMov;
}


public function getById(string $id) : Movimiento{

$curMovimiento = $this->MovimientoRepository->findById($id);
return $curMovimiento;
}

public function getAll() :Array {
return $this->MovimientoRepository->findAll();

}

public function getByTipo(string $id) :Array {
return $this->MovimientoRepository->findByTipo((int) $id);
}



}