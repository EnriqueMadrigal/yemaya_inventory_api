<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Entities\Ubicacion;
use stdClass;

class UbicacionRepository extends BaseRepository
{
    protected string $table = 'ubicacion';

    /**
     * Get all measurement units.
     *
     * @return Ubicacion[]
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
    public function findById(int $id): ?Ubicacion
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
    public function save(Ubicacion $Ubicacion): int
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
            $Ubicacion->getNombre(),
            $Ubicacion->getNombre() === null
                ? \PDO::PARAM_NULL
                : \PDO::PARAM_STR
        );

        
        $statement->execute();

        $Ubicacion->setId(
            (int) $this->pdo->lastInsertId()
        );

        return $Ubicacion->getId();
    }

    /**
     * Update an existing measurement unit.
     */
    public function update(Ubicacion $Ubicacion): bool
    {
        if ($Ubicacion->getId() === null) {
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
            $Ubicacion->getId(),
            \PDO::PARAM_INT
        );

        $statement->bindValue(
            ':nombre',
            $Ubicacion->getNombre(),
            $Ubicacion->getNombre() === null
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
    private function mapToEntity(array $row): Ubicacion
    {
        $e = new Ubicacion();
        $e->setId(isset($row['id']) ? (int)$row['id'] : null);
        $e->setNombre((string)$row['nombre']);
        return $e;
    }
}