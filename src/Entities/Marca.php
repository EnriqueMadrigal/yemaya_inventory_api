<?php

declare(strict_types=1);
namespace App\Entities;


class Marca
{
    private ?int $id;
    private ?string $nombre;

    public function __construct(
        ?int $id = null,
        ?string $nombre = null
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function toArray(): array
    {
    return [
        'id'              => $this->id,
        'nombre'         => $this->nombre,
    ];
    }
    
}