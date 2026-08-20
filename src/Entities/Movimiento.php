<?php

namespace App\Entities;

class Movimiento
{
    private int $id;
    private int $id_articulo;
    private int $id_medida;
    private float $cantidad;
    private int $tipo;
    private int $updated_by;
    private string $created_at;
    private ?string $observaciones;

    public function __construct(
        int $id = 0,
        int $id_articulo = 0,
        int $id_medida = 1,
        float $cantidad = 0,
        int $tipo = 1,
        int $updated_by = 0,
        string $created_at = '',
        ?string $observaciones = null
    ) {
        $this->id = $id;
        $this->id_articulo = $id_articulo;
        $this->id_medida = $id_medida;
        $this->cantidad = $cantidad;
        $this->tipo = $tipo;
        $this->updated_by = $updated_by;
        $this->created_at = $created_at;
        $this->observaciones = $observaciones;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getIdArticulo(): int
    {
        return $this->id_articulo;
    }

    public function setIdArticulo(int $id_articulo): void
    {
        $this->id_articulo = $id_articulo;
    }

    public function getIdMedida(): int
    {
        return $this->id_medida;
    }

    public function setIdMedida(int $id_medida): void
    {
        $this->id_medida = $id_medida;
    }

    public function getCantidad(): float
    {
        return $this->cantidad;
    }

    public function setCantidad(float $cantidad): void
    {
        $this->cantidad = $cantidad;
    }

    public function getTipo(): int
    {
        return $this->tipo;
    }

    public function setTipo(int $tipo): void
    {
        $this->tipo = $tipo;
    }

    public function getUpdatedBy(): int
    {
        return $this->updated_by;
    }

    public function setUpdatedBy(int $updated_by): void
    {
        $this->updated_by = $updated_by;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function setCreatedAt(string $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function setObservaciones(?string $observaciones): void
    {
        $this->observaciones = $observaciones;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'id_articulo' => $this->id_articulo,
            'id_medida' => $this->id_medida,
            'cantidad' => $this->cantidad,
            'tipo' => $this->tipo,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'observaciones' => $this->observaciones
        ];
    }
}
