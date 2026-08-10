<?php

declare(strict_types=1);

namespace App\Entities;

class UnidadMedida
{
    private ?int $id;
    private ?string $nombreMedida;
    private int $idUnidadBasica;
    private float $cantidadMedida;

    public function __construct(
        ?int $id = null,
        ?string $nombreMedida = null,
        int $idUnidadBasica = 1,
        float $cantidadMedida = 0.0
    ) {
        $this->id = $id;
        $this->nombreMedida = $nombreMedida;
        $this->idUnidadBasica = $idUnidadBasica;
        $this->cantidadMedida = $cantidadMedida;
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

    public function getIdUnidadBasica(): int
    {
        return $this->idUnidadBasica;
    }

    public function setIdUnidadBasica(int $idUnidadBasica): void
    {
        $this->idUnidadBasica = $idUnidadBasica;
    }

    public function getCantidadMedida(): float
    {
        return $this->cantidadMedida;
    }

    public function setCantidadMedida(float $cantidadMedida): void
    {
        $this->cantidadMedida = $cantidadMedida;
    }

 public function toArray(): array
    {
    return [
        'id'        => $this->id,
        'nombre'    => $this->nombreMedida,
        'idUnidadBasica'    => $this->idUnidadBasica,
        'cantidad'  => $this->cantidadMedida
    ];
    }

}