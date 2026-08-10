<?php

namespace App\Services;

use App\Repositories\ArticuloRepository;
use App\Entities\Articulo;


class ArticuloService {

private ArticuloRepository $articuloRepository;

public function __construct(ArticuloRepository $articuloRepository)
{
    $this->articuloRepository = $articuloRepository;
}

public function insert(Array $data) {

 $user_id = (int)$_SERVER['USER_ID'];

$articulo = new Articulo();
$articulo->setIdFamilia($data['idFamilia']);
$articulo->setIdUbicacion($data['idUbicacion']);
$articulo->setNombreProducto($data['nombre']);
$articulo->setIdUnidad($data['idUnidad']);
$articulo->setCantidad($data['cantidad']);
$articulo->setCosto($data['costo']);
$articulo->setValorInventario($data['valor_inventario']);
$articulo->setMinimaCantidad($data['minima_cantidad']);
$articulo->setCantidadAnterior($data['cantidad_anterior']);
$articulo->setUpdatedBy($user_id);

return $this->articuloRepository->save($articulo);


}


public function update($data) {

 $user_id = (int)$_SERVER['USER_ID'];

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


$articulo = new Articulo();
$articulo->setIdFamilia($data['idFamilia']);
$articulo->setIdUbicacion($data['idUbicacion']);
$articulo->setNombreProducto($data['nombre']);
$articulo->setIdUnidad($data['idUnidad']);
$articulo->setCantidad($data['cantidad']);
$articulo->setCosto($data['costo']);
$articulo->setValorInventario($data['valor_inventario']);
$articulo->setMinimaCantidad($data['minima_cantidad']);
$articulo->setCantidadAnterior($data['cantidad_anterior']);
$articulo->setUpdatedBy($user_id);
$articulo->setId($id);

return $this->articuloRepository->update($articulo);



}

public function getById(string $id) : Articulo{

$curArticulo = $this->articuloRepository->findById($id);
return $curArticulo;
}

public function getAll() :Array {
return $this->articuloRepository->findAll();

}



}