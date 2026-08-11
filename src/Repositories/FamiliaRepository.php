<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Entities\Familia;
use stdClass;

class FamiliaRepository extends BaseRepository
{
    protected string $table = 'familia';

    /**
     * Get all measurement units.
     *
     * @return Familia[]
     */
    public function findAll(): array
    {
        $sql = "
            SELECT
                id,
                nombre
            FROM {$this->table}
            ORDER BY nombre ASC
        ";

       
        $statement = $this->pdo->prepare($sql);
        $statement->execute();

        //$rows = $statement->fetchAll(\PDO::FETCH_ASSOC);



        $out = [];

    while ($row = $statement->fetch()) {
           
            $newClass = new stdClass();
            $newClass->id = (int)$row['id'];
            $newClass->nombre = (string)$row['nombre'];
            $out[] = $newClass;
       }
     
        return $out;
    }

    /**
     * Find a measurement unit by ID.
     */
    public function findById(int $id): ?Familia
    {
        $sql = "
            SELECT
                id,
                nombre
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
     * Insert a new measurement unit.
     */
    public function save(Familia $familia): int
    {
        $sql = "
            INSERT INTO {$this->table}
            (
                nombre
            )
            VALUES
            (
                :nombre
            )
        ";

        $statement = $this->pdo->prepare($sql);

        $statement->bindValue(
            ':nombre',
            $familia->getNombre(),
            $familia->getNombre() === null
                ? \PDO::PARAM_NULL
                : \PDO::PARAM_STR
        );

        
        $statement->execute();

        $familia->setId(
            (int) $this->pdo->lastInsertId()
        );

        return $familia->getId();
    }

    /**
     * Update an existing measurement unit.
     */
    public function update(Familia $familia): bool
    {
        if ($familia->getId() === null) {
            throw new \InvalidArgumentException(
                'Cannot update a UnidadMedida without an ID.'
            );
        }

        $sql = "
            UPDATE {$this->table}
            SET
                nombre = :nombre
                
            WHERE id = :id
        ";

        $statement = $this->pdo->prepare($sql);

        $statement->bindValue(
            ':id',
            $familia->getId(),
            \PDO::PARAM_INT
        );

        $statement->bindValue(
            ':nombre',
            $familia->getNombre(),
            $familia->getNombre() === null
                ? \PDO::PARAM_NULL
                : \PDO::PARAM_STR
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
    private function mapToEntity(array $row): Familia
    {
        return new Familia(
            isset($row['id'])
                ? (int) $row['id']
                : null,
            $row['nombre'] ?? null
        );
    }
}