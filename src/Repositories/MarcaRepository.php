<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Entities\Marca;
use PDO;
use stdClass;

class MarcaRepository extends BaseRepository
{
    private string $table = 'marca';  

    /**
     * @return Marca[]
     */
    public function findAll(): array
    {
        $sql = "
            SELECT
                id,
                nombre
            FROM  {$this->table}
            ORDER BY nombre ASC
        ";

        $statement = $this->pdo->prepare($sql);
        $statement->execute();

        //$rows = $statement->fetchAll(PDO::FETCH_ASSOC);

        $out = [];

    while ($row = $statement->fetch()) {
           
            $newClass = new stdClass();
            $newClass->id = (int)$row['id'];
            $newClass->nombre = (string)$row['nombre'];
            $out[] = $newClass;
       }
     
        return $out;
    }

    public function findById(int $id): ?Marca
    {
        $sql = "
            SELECT
                id,
                nombre
            FROM  {$this->table}
            WHERE id = :id
            LIMIT 1
        ";

        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if ($row === false) {
            return null;
        }

        return $this->mapToEntity($row);
    }

    public function save(Marca $Marca): int
    {
        $sql = "
            INSERT INTO  {$this->table} (nombre)
            VALUES (:nombre)
        ";

        $statement = $this->pdo->prepare($sql);

        $nombre = $Marca->getNombre();

        if ($nombre === null) {
            $statement->bindValue(':nombre', null, PDO::PARAM_NULL);
        } else {
            $statement->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        }

        $statement->execute();

        $Marca->setId(
            (int) $this->pdo->lastInsertId()
        );

        return $Marca->getId();
    }

    public function update(Marca $Marca): bool
    {
        if ($Marca->getId() === null) {
            throw new \InvalidArgumentException(
                'Cannot update a Marca without an ID.'
            );
        }

        $sql = "
            UPDATE  {$this->table}
            SET nombre = :nombre
            WHERE id = :id
        ";

        $statement = $this->pdo->prepare($sql);

        $statement->bindValue(
            ':id',
            $Marca->getId(),
            PDO::PARAM_INT
        );

        $nombre = $Marca->getNombre();

        if ($nombre === null) {
            $statement->bindValue(':nombre', null, PDO::PARAM_NULL);
        } else {
            $statement->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        }

        $statement->execute();

        return $statement->rowCount() > 0;
    }

    public function delete(int $id): bool
    {
        $sql = "
            DELETE FROM  {$this->table}
            WHERE id = :id
        ";

        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->rowCount() > 0;
    }

    /**
     * Converts a database row into a Marca entity.
     */
    private function mapToEntity(array $row): Marca
    {
        return new Marca(
            isset($row['id']) ? (int) $row['id'] : null,
            $row['nombre'] ?? null
        );
    }
}