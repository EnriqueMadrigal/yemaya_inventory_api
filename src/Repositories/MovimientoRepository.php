<?php

namespace App\Repositories;

use App\Entities\Movimiento;

class MovimientoRepository extends BaseRepository
{
    protected string $table = 'movimiento';

    /**
     * Convert a database row into a Movimiento entity.
     */
    private function mapToEntity(array $row): Movimiento
    {
        return new Movimiento(
            (int) $row['id'],
            (int) $row['id_articulo'],
            (int) $row['id_medida'],
            (float) $row['cantidad'],
            (int) $row['tipo'],
            (int) $row['updated_by'],
            $row['created_at'],
            $row['observaciones']
        );
    }

    /**
     * Find a Movimiento by its ID.
     */
    public function findById(int $id): ?Movimiento
    {
        $sql = "SELECT *
                FROM {$this->table}
                WHERE id = :id
                LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'id' => $id
        ]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row === false) {
            return null;
        }

        return $this->mapToEntity($row);
    }

    /**
     * Get all Movimientos.
     *
     * @return Movimiento[]
     */
    public function findAll(): array
    {
        $sql = "SELECT *
                FROM {$this->table}
                ORDER BY id DESC";

        $stmt = $this->pdo->query($sql);

        $entities = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $entities[] = $this->mapToEntity($row);
        }

        return $entities;
    }

    /**
     * Find Movimientos by article.
     *
     * @return Movimiento[]
     */
    public function findByArticulo(int $id_articulo): array
    {
        $sql = "SELECT *
                FROM {$this->table}
                WHERE id_articulo = :id_articulo
                ORDER BY id DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'id_articulo' => $id_articulo
        ]);

        $entities = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $entities[] = $this->mapToEntity($row);
        }

        return $entities;
    }

    /**
     * Insert a new Movimiento.
     */
    public function save(Movimiento $movimiento): Movimiento
    {
        $sql = "INSERT INTO {$this->table} (
                    id_articulo,
                    id_medida,
                    cantidad,
                    tipo,
                    updated_by,
                    created_at,
                    observaciones
                ) VALUES (
                    :id_articulo,
                    :id_medida,
                    :cantidad,
                    :tipo,
                    :updated_by,
                    :created_at,
                    :observaciones
                )";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            'id_articulo' => $movimiento->getIdArticulo(),
            'id_medida' => $movimiento->getIdMedida(),
            'cantidad' => $movimiento->getCantidad(),
            'tipo' => $movimiento->getTipo(),
            'updated_by' => $movimiento->getUpdatedBy(),
            'created_at' => $movimiento->getCreatedAt(),
            'observaciones' => $movimiento->getObservaciones()
        ]);

        $movimiento->setId((int) $this->pdo->lastInsertId());

        return $movimiento;
    }

    /**
     * Update an existing Movimiento.
     */
    public function update(Movimiento $movimiento): bool
    {
        $sql = "UPDATE {$this->table}
                SET
                    id_articulo = :id_articulo,
                    id_medida = :id_medida,
                    cantidad = :cantidad,
                    tipo = :tipo,
                    updated_by = :updated_by,
                    created_at = :created_at,
                    observaciones = :observaciones
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'id' => $movimiento->getId(),
            'id_articulo' => $movimiento->getIdArticulo(),
            'id_medida' => $movimiento->getIdMedida(),
            'cantidad' => $movimiento->getCantidad(),
            'tipo' => $movimiento->getTipo(),
            'updated_by' => $movimiento->getUpdatedBy(),
            'created_at' => $movimiento->getCreatedAt(),
            'observaciones' => $movimiento->getObservaciones()
        ]);
    }

    /**
     * Delete a Movimiento by ID.
     */
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM {$this->table}
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'id' => $id
        ]);
    }

    /**
     * Get Movimientos by type.
     *
     * @return Movimiento[]
     */
    public function findByTipo(int $tipo): array
    {
        $sql = "SELECT *
                FROM {$this->table}
                WHERE tipo = :tipo
                ORDER BY id DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'tipo' => $tipo
        ]);

        $entities = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $entities[] = $this->mapToEntity($row);
        }

        return $entities;
    }
}
