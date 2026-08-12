<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Entities\UnidadMedida;
use stdClass;

class UnidadMedidaRepository extends BaseRepository
{
    protected string $table = 'unidad_medida';

    /**
     * Get all measurement units.
     *
     * @return UnidadMedida[]
     */
    public function findAll(): array
    {
        $sql = "
            SELECT
                id,
                nombre,
                id_unidad_basica,
                cantidad_medida
            FROM {$this->table}
            ORDER BY nombre ASC
        ";

        $statement = $this->pdo->prepare($sql);
        $statement->execute();

           $out = [];

    while ($row = $statement->fetch()) {
           
            $newClass = new stdClass();
            $newClass->id = (int)$row['id'];
            $newClass->nombre = (string)$row['nombre'];
            $newClass->id_unidad_basica = (int)$row['id_unidad_basica'];
            $newClass->cantidad_medida = (int)$row['cantidad_medida'];

            $out[] = $newClass;
       }
     
        return $out;


       // $rows = $statement->fetchAll(\PDO::FETCH_ASSOC);

        //$result = [];

        //foreach ($rows as $row) {
        //    $result[] = $this->mapToEntity($row);
        //}

        //return $result;
    }

    /**
     * Find a measurement unit by ID.
     */
    public function findById(int $id): ?UnidadMedida
    {
        $sql = "
            SELECT
                id,
                nombre,
                id_unidad_basica,
                cantidad_medida
            FROM {$this->table}
            WHERE id = :id
            LIMIT 1
        ";

        $statement = $this->pdo->prepare($sql);

        $statement->bindValue(
            ':id',
            $id,
            \PDO::PARAM_INT
        );

        $statement->execute();

        $row = $statement->fetch(\PDO::FETCH_ASSOC);

        if ($row === false) {
            return null;
        }

        return $this->mapToEntity($row);
    }

    /**
     * Find all measurement units belonging to a basic unit.
     *
     * @return UnidadMedida[]
     */
    public function findByUnidadBasica(int $idUnidadBasica): array
    {
        $sql = "
            SELECT
                id,
                nombre,
                id_unidad_basica,
                cantidad_medida
            FROM {$this->table}
            WHERE id_unidad_basica = :id_unidad_basica
            ORDER BY nombre ASC
        ";

        $statement = $this->pdo->prepare($sql);

        $statement->bindValue(
            ':id_unidad_basica',
            $idUnidadBasica,
            \PDO::PARAM_INT
        );

        $statement->execute();

        $rows = $statement->fetchAll(\PDO::FETCH_ASSOC);

        $result = [];

        foreach ($rows as $row) {
            $result[] = $this->mapToEntity($row);
        }

        return $result;
    }

    /**
     * Insert a new measurement unit.
     */
    public function save(UnidadMedida $unidadMedida): int
    {
        $sql = "
            INSERT INTO {$this->table}
            (
                nombre,
                id_unidad_basica,
                cantidad_medida
            )
            VALUES
            (
                :nombre,
                :id_unidad_basica,
                :cantidad_medida
            )
        ";

        $statement = $this->pdo->prepare($sql);

        $statement->bindValue(
            ':nombre',
            $unidadMedida->getNombreMedida(),
            $unidadMedida->getNombreMedida() === null
                ? \PDO::PARAM_NULL
                : \PDO::PARAM_STR
        );

        $statement->bindValue(
            ':id_unidad_basica',
            $unidadMedida->getid_unidad_basica(),
            \PDO::PARAM_INT
        );

        $statement->bindValue(
            ':cantidad_medida',
            $unidadMedida->getcantidad_medida()
        );

        $statement->execute();

        $unidadMedida->setId(
            (int) $this->pdo->lastInsertId()
        );

        return $unidadMedida->getId();
    }

    /**
     * Update an existing measurement unit.
     */
    public function update(UnidadMedida $unidadMedida): bool
    {
        if ($unidadMedida->getId() === null) {
            throw new \InvalidArgumentException(
                'Cannot update a UnidadMedida without an ID.'
            );
        }

        $sql = "
            UPDATE {$this->table}
            SET
                nombre = :nombre,
                id_unidad_basica = :id_unidad_basica,
                cantidad_medida = :cantidad_medida
            WHERE id = :id
        ";

        $statement = $this->pdo->prepare($sql);

        $statement->bindValue(
            ':id',
            $unidadMedida->getId(),
            \PDO::PARAM_INT
        );

        $statement->bindValue(
            ':nombre',
            $unidadMedida->getNombreMedida(),
            $unidadMedida->getNombreMedida() === null
                ? \PDO::PARAM_NULL
                : \PDO::PARAM_STR
        );

        $statement->bindValue(
            ':id_unidad_basica',
            $unidadMedida->getid_unidad_basica(),
            \PDO::PARAM_INT
        );

        $statement->bindValue(
            ':cantidad_medida',
            $unidadMedida->getcantidad_medida()
        );

        $statement->execute();

        return $statement->rowCount() > 0;
    }

    /**
     * Delete a measurement unit.
     */
    public function delete(int $id): bool
    {
        $sql = "
            DELETE FROM {$this->table}
            WHERE id = :id
        ";

        $statement = $this->pdo->prepare($sql);

        $statement->bindValue(
            ':id',
            $id,
            \PDO::PARAM_INT
        );

        $statement->execute();

        return $statement->rowCount() > 0;
    }

    /**
     * Convert a database row into an entity.
     */
    private function mapToEntity(array $row): UnidadMedida
    {
        return new UnidadMedida(
            isset($row['id'])
                ? (int) $row['id']
                : null,

            $row['nombre'] ?? null,

            isset($row['id_unidad_basica'])
                ? (int) $row['id_unidad_basica']
                : 1,

            isset($row['cantidad_medida'])
                ? (float) $row['cantidad_medida']
                : 0.0
        );
    }
}