<?php

declare(strict_types=1);

namespace App\Entities;

class Articulo
{
    private ?int $id;

    private int $idFamilia;

    private int $idUbicacion;

    private ?string $nombreProducto;

    private int $idUnidad;

    private float $cantidad;

    private float $costo;

    private float $valorInventario;

    private float $minimaCantidad;

    private float $cantidadAnterior;

    private int $updatedBy;

    private int $idMarca;

    private ?string $createdAt;

    private ?string $updatedAt;

    public function __construct(
        ?int $id = null,
        int $idFamilia = 1,
        int $idUbicacion = 1,
        ?string $nombreProducto = null,
        int $idUnidad = 1,
        int $idMarca = 1,
        float $cantidad = 0.0,
        float $costo = 0.0,
        float $valorInventario = 0.0,
        float $minimaCantidad = 0.0,
        float $cantidadAnterior = 0.0,
        int $updatedBy = 0,
        ?string $createdAt = null,
        ?string $updatedAt = null
    ) {
        $this->id = $id;
        $this->idFamilia = $idFamilia;
        $this->idUbicacion = $idUbicacion;
        $this->nombreProducto = $nombreProducto;
        $this->idUnidad = $idUnidad;
        $this->idMarca = $idMarca;
        $this->cantidad = $cantidad;
        $this->costo = $costo;
        $this->valorInventario = $valorInventario;
        $this->minimaCantidad = $minimaCantidad;
        $this->cantidadAnterior = $cantidadAnterior;
        $this->updatedBy = $updatedBy;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getIdFamilia(): int
    {
        return $this->idFamilia;
    }

    public function setIdFamilia(int $idFamilia): void
    {
        $this->idFamilia = $idFamilia;
    }

    public function getIdUbicacion(): int
    {
        return $this->idUbicacion;
    }

    public function setIdUbicacion(int $idUbicacion): void
    {
        $this->idUbicacion = $idUbicacion;
    }

    public function getNombreProducto(): ?string
    {
        return $this->nombreProducto;
    }

    public function setNombreProducto(?string $nombreProducto): void
    {
        $this->nombreProducto = $nombreProducto;
    }

    public function getIdUnidad(): int
    {
        return $this->idUnidad;
    }

    public function setIdUnidad(int $idUnidad): void
    {
        $this->idUnidad = $idUnidad;
    }

    public function getIdMarca(): int
    {
        return $this->idMarca;
    }

    public function setIdMarca(int $idMarca): void
    {
        $this->idMarca = $idMarca;
    }


    public function getCantidad(): float
    {
        return $this->cantidad;
    }

    public function setCantidad(float $cantidad): void
    {
        $this->cantidad = $cantidad;
    }

    public function getCosto(): float
    {
        return $this->costo;
    }

    public function setCosto(float $costo): void
    {
        $this->costo = $costo;
    }

    public function getValorInventario(): float
    {
        return $this->valorInventario;
    }

    public function setValorInventario(float $valorInventario): void
    {
        $this->valorInventario = $valorInventario;
    }

    public function getMinimaCantidad(): float
    {
        return $this->minimaCantidad;
    }

    public function setMinimaCantidad(float $minimaCantidad): void
    {
        $this->minimaCantidad = $minimaCantidad;
    }

    public function getCantidadAnterior(): float
    {
        return $this->cantidadAnterior;
    }

    public function setCantidadAnterior(float $cantidadAnterior): void
    {
        $this->cantidadAnterior = $cantidadAnterior;
    }

    public function getUpdatedBy(): int
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(int $updatedBy): void
    {
        $this->updatedBy = $updatedBy;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }


 public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'id_familia' => $this->getIdFamilia(),
            'id_ubicacion' => $this->getIdUbicacion(),
            'nombre_producto' => $this->getNombreProducto(),
            'id_unidad' => $this->getIdUnidad(),
            'id_marca' => $this->getIdMarca(),
            'cantidad' => $this->getCantidad(),
            'costo' => $this->getCosto(),
            'valor_inventario' => $this->getValorInventario(),
            'minima_cantidad' => $this->getMinimaCantidad(),
            'cantidad_anterior' => $this->getCantidadAnterior(),
            'updated_by' => $this->getUpdatedBy(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt()
        ];
    }

}