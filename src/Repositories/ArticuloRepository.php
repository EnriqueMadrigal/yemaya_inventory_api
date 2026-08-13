<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Entities\Articulo;

class ArticuloRepository extends BaseRepository
{
    protected string $table = 'articulo';

    /**
     * Get all articles.
     *
     * @return Articulo[]
     */
    public function findAll(): array
    {
        $sql = "
            SELECT
                id,
                id_familia,
                id_ubicacion,
                nombre_producto,
                id_unidad,
                id_marca,
                cantidad,
                costo,
                valor_inventario,
                minima_cantidad,
                cantidad_anterior,
                updated_by,
                created_at,
                updated_at
            FROM {$this->table}
            ORDER BY nombre_producto ASC
        ";

        $statement = $this->pdo->prepare($sql);
        $statement->execute();

        $rows = $statement->fetchAll(\PDO::FETCH_ASSOC);

        $result = [];

        foreach ($rows as $row) {
            $result[] = $this->mapToEntity($row);
        }

        return $result;
    }

    /**
     * Find an article by ID.
     */
    public function findById(int $id): ?Articulo
    {
        $sql = "
            SELECT
                id,
                id_familia,
                id_ubicacion,
                nombre_producto,
                id_unidad,
                id_marca,
                cantidad,
                costo,
                valor_inventario,
                minima_cantidad,
                cantidad_anterior,
                updated_by,
                created_at,
                updated_at
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
     * Find articles by family.
     *
     * @return Articulo[]
     */
    public function findByFamilia(int $idFamilia): array
    {
        $sql = "
            SELECT
                id,
                id_familia,
                id_ubicacion,
                nombre_producto,
                id_unidad,
                id_marca,
                cantidad,
                costo,
                valor_inventario,
                minima_cantidad,
                cantidad_anterior,
                updated_by,
                created_at,
                updated_at
            FROM {$this->table}
            WHERE id_familia = :id_familia
            ORDER BY nombre_producto ASC
        ";

        $statement = $this->pdo->prepare($sql);

        $statement->bindValue(
            ':id_familia',
            $idFamilia,
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
     * Find articles by location.
     *
     * @return Articulo[]
     */
    public function findByUbicacion(int $idUbicacion): array
    {
        $sql = "
            SELECT
                id,
                id_familia,
                id_ubicacion,
                nombre_producto,
                id_unidad,
                id_marca,
                cantidad,
                costo,
                valor_inventario,
                minima_cantidad,
                cantidad_anterior,
                updated_by,
                created_at,
                updated_at
            FROM {$this->table}
            WHERE id_ubicacion = :id_ubicacion
            ORDER BY nombre_producto ASC
        ";

        $statement = $this->pdo->prepare($sql);

        $statement->bindValue(
            ':id_ubicacion',
            $idUbicacion,
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
     * Insert a new article.
     */
    public function save(Articulo $articulo): int
    {
        $sql = "
            INSERT INTO {$this->table}
            (
                id_familia,
                id_ubicacion,
                nombre_producto,
                id_unidad,
                id_marca,
                cantidad,
                costo,
                valor_inventario,
                minima_cantidad,
                cantidad_anterior,
                updated_by,
                created_at,
                updated_at
            )
            VALUES
            (
                :id_familia,
                :id_ubicacion,
                :nombre_producto,
                :id_unidad,
                :id_marca,
                :cantidad,
                :costo,
                :valor_inventario,
                :minima_cantidad,
                :cantidad_anterior,
                :updated_by,
                NOW(),
                :updated_at
            )
        ";

        $statement = $this->pdo->prepare($sql);

        $statement->bindValue(
            ':id_familia',
            $articulo->getIdFamilia(),
            \PDO::PARAM_INT
        );

        $statement->bindValue(
            ':id_ubicacion',
            $articulo->getIdUbicacion(),
            \PDO::PARAM_INT
        );

        $this->bindNullableString(
            $statement,
            ':nombre_producto',
            $articulo->getNombreProducto()
        );

        $statement->bindValue(
            ':id_unidad',
            $articulo->getIdUnidad(),
            \PDO::PARAM_INT
        );

         $statement->bindValue(
            ':id_marca',
            $articulo->getIdMarca(),
            \PDO::PARAM_INT
        );

        $statement->bindValue(
            ':cantidad',
            $articulo->getCantidad()
        );

        $statement->bindValue(
            ':costo',
            $articulo->getCosto()
        );

        $statement->bindValue(
            ':valor_inventario',
            $articulo->getValorInventario()
        );

        $statement->bindValue(
            ':minima_cantidad',
            $articulo->getMinimaCantidad()
        );

        $statement->bindValue(
            ':cantidad_anterior',
            $articulo->getCantidadAnterior()
        );

        $statement->bindValue(
            ':updated_by',
            $articulo->getUpdatedBy(),
            \PDO::PARAM_INT
        );

       

        $this->bindNullableString(
            $statement,
            ':updated_at',
            $articulo->getUpdatedAt()
        );

        $statement->execute();

        $articulo->setId(
            (int) $this->pdo->lastInsertId()
        );

        return $articulo->getId();
    }

    /**
     * Update an existing article.
     */
    public function update(Articulo $articulo): bool
    {
        if ($articulo->getId() === null) {
            throw new \InvalidArgumentException(
                'Cannot update an article without an ID.'
            );
        }

        $sql = "
            UPDATE {$this->table}
            SET
                id_familia = :id_familia,
                id_ubicacion = :id_ubicacion,
                nombre_producto = :nombre_producto,
                id_unidad = :id_unidad,
                id_marca = :id_marca,
                cantidad = :cantidad,
                costo = :costo,
                valor_inventario = :valor_inventario,
                minima_cantidad = :minima_cantidad,
                cantidad_anterior = :cantidad_anterior,
                updated_by = :updated_by,
                updated_at = NOW()
            WHERE id = :id
        ";

        $statement = $this->pdo->prepare($sql);

        $statement->bindValue(
            ':id',
            $articulo->getId(),
            \PDO::PARAM_INT
        );

        $statement->bindValue(
            ':id_familia',
            $articulo->getIdFamilia(),
            \PDO::PARAM_INT
        );

        $statement->bindValue(
            ':id_ubicacion',
            $articulo->getIdUbicacion(),
            \PDO::PARAM_INT
        );

        $this->bindNullableString(
            $statement,
            ':nombre_producto',
            $articulo->getNombreProducto()
        );

        $statement->bindValue(
            ':id_unidad',
            $articulo->getIdUnidad(),
            \PDO::PARAM_INT
        );

          $statement->bindValue(
            ':id_marca',
            $articulo->getIdMarca(),
            \PDO::PARAM_INT
        );

        $statement->bindValue(
            ':cantidad',
            $articulo->getCantidad()
        );

        $statement->bindValue(
            ':costo',
            $articulo->getCosto()
        );

        $statement->bindValue(
            ':valor_inventario',
            $articulo->getValorInventario()
        );

        $statement->bindValue(
            ':minima_cantidad',
            $articulo->getMinimaCantidad()
        );

        $statement->bindValue(
            ':cantidad_anterior',
            $articulo->getCantidadAnterior()
        );

        $statement->bindValue(
            ':updated_by',
            $articulo->getUpdatedBy(),
            \PDO::PARAM_INT
        );

      

        $statement->execute();

        return $statement->rowCount() > 0;
    }

    /**
     * Delete an article.
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
     * Convert an Articulo entity to an associative array.
     */
    public function toArray(Articulo $articulo): array
    {
        return [
            'id' => $articulo->getId(),
            'id_familia' => $articulo->getIdFamilia(),
            'id_ubicacion' => $articulo->getIdUbicacion(),
            'nombre_producto' => $articulo->getNombreProducto(),
            'id_unidad' => $articulo->getIdUnidad(),
            'id_marca' => $articulo->getIdMarca(),
            'cantidad' => $articulo->getCantidad(),
            'costo' => $articulo->getCosto(),
            'valor_inventario' => $articulo->getValorInventario(),
            'minima_cantidad' => $articulo->getMinimaCantidad(),
            'cantidad_anterior' => $articulo->getCantidadAnterior(),
            'updated_by' => $articulo->getUpdatedBy(),
            'created_at' => $articulo->getCreatedAt(),
            'updated_at' => $articulo->getUpdatedAt()
        ];
    }

    /**
     * Convert a database row to an Articulo entity.
     */
    private function mapToEntity(array $row): Articulo
    {
        return new Articulo(
            isset($row['id'])
                ? (int) $row['id']
                : null,

            isset($row['id_familia'])
                ? (int) $row['id_familia']
                : 1,

            isset($row['id_ubicacion'])
                ? (int) $row['id_ubicacion']
                : 1,

            $row['nombre_producto'] ?? null,

            isset($row['id_unidad'])
                ? (int) $row['id_unidad']
                : 1,
            
            isset($row['id_marca'])
                ? (int) $row['id_marca']
                : 1,

            isset($row['cantidad'])
                ? (float) $row['cantidad']
                : 0.0,

            isset($row['costo'])
                ? (float) $row['costo']
                : 0.0,

            isset($row['valor_inventario'])
                ? (float) $row['valor_inventario']
                : 0.0,

            isset($row['minima_cantidad'])
                ? (float) $row['minima_cantidad']
                : 0.0,

            isset($row['cantidad_anterior'])
                ? (float) $row['cantidad_anterior']
                : 0.0,

            isset($row['updated_by'])
                ? (int) $row['updated_by']
                : 0,

            $row['created_at'] ?? null,

            $row['updated_at'] ?? null
        );
    }

    /**
     * Bind a nullable string value.
     */
    private function bindNullableString(
        \PDOStatement $statement,
        string $parameter,
        ?string $value
    ): void {
        if ($value === null) {
            $statement->bindValue(
                $parameter,
                null,
                \PDO::PARAM_NULL
            );

            return;
        }

        $statement->bindValue(
            $parameter,
            $value,
            \PDO::PARAM_STR
        );
    }
}