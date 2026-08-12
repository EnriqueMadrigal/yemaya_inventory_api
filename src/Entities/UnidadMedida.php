<?php

declare(strict_types=1);

namespace App\Entities;

class UnidadMedida
{
    private ?int $id;
    private ?string $nombreMedida;
    private int $id_unidad_basica;
    private float $cantidad_medida;

    public function __construct(
        ?int $id = null,
        ?string $nombreMedida = null,
        int $id_unidad_basica = 1,
        float $cantidad_medida = 0.0
    ) {
        $this->id = $id;
        $this->nombreMedida = $nombreMedida;
        $this->id_unidad_basica = $id_unidad_basica;
        $this->cantidad_medida = $cantidad_medida;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getNombreMedida(): ?string
    {
        return $this->nombreMedida;
    }

    public function setNombreMedida(?string $nombreMedida): void
    {
        $this->nombreMedida = $nombreMedida;
    }

    public function getid_unidad_basica(): int
    {
        return $this->id_unidad_basica;
    }

    public function setid_unidad_basica(int $id_unidad_basica): void
    {
        $this->id_unidad_basica = $id_unidad_basica;
    }

    public function getcantidad_medida(): float
    {
        return $this->cantidad_medida;
    }

    public function setcantidad_medida(float $cantidad_medida): void
    {
        $this->cantidad_medida = $cantidad_medida;
    }

 public function toArray(): array
    {
    return [
        'id'        => $this->id,
        'nombre'    => $this->nombreMedida,
        'id_unidad_basica'    => $this->id_unidad_basica,
        'cantidad_medida'  => $this->cantidad_medida
    ];
    }

}