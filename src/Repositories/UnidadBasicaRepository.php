<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Entities\UnidadBasica;
use PDO;

class UnidadBasicaRepository extends BaseRepository
{
    private string $table = 'unida_basica';  

    /**
     * @return UnidadBasica[]
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

        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

        $result = [];

        foreach ($rows as $row) {
            $result[] = $this->mapToEntity($row);
        }

        return $result;
    }

    public function findById(int $id): ?UnidadBasica
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

    public function save(UnidadBasica $unidadBasica): int
    {
        $sql = "
            INSERT INTO  {$this->table} (nombre)
            VALUES (:nombre)
        ";

        $statement = $this->pdo->prepare($sql);

        $nombre = $unidadBasica->getNombre();

        if ($nombre === null) {
            $statement->bindValue(':nombre', null, PDO::PARAM_NULL);
        } else {
            $statement->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        }

        $statement->execute();

        $unidadBasica->setId(
            (int) $this->pdo->lastInsertId()
        );

        return $unidadBasica->getId();
    }

    public function update(UnidadBasica $unidadBasica): bool
    {
        if ($unidadBasica->getId() === null) {
            throw new \InvalidArgumentException(
                'Cannot update a UnidadBasica without an ID.'
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
            $unidadBasica->getId(),
            PDO::PARAM_INT
        );

        $nombre = $unidadBasica->getNombre();

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
     * Converts a database row into a UnidadBasica entity.
     */
    private function mapToEntity(array $row): UnidadBasica
    {
        return new UnidadBasica(
            isset($row['id']) ? (int) $row['id'] : null,
            $row['nombre'] ?? null
        );
    }
}