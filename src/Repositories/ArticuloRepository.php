<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Entities\Articulo;
use stdClass;

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
        $articulo = new Articulo();

        $articulo->setId((int)($row['id'] ?? null));
        $articulo->setIdFamilia((int)($row['id_familia'] ?? 1));
        $articulo->setIdUbicacion((int)($row['id_ubicacion'] ?? 1));
        $articulo->setNombreProducto($row['nombre_producto'] ?? '');
        $articulo->setIdUnidad((int)($row['id_unidad'] ?? 1));
        $articulo->setIdMarca((int)($row['id_marca'] ?? 1));
        $articulo->setCantidad((float)($row['cantidad'] ?? 0.0));
        $articulo->setCosto((float)($row['costo'] ?? 0.0));
        $articulo->setValorInventario((float)($row['valor_inventario'] ?? 0.0));
        $articulo->setMinimaCantidad((float)($row['minima_cantidad'] ?? 0.0));
        $articulo->setCantidadAnterior((float)($row['cantidad_anterior'] ?? 0.0));
        $articulo->setUpdatedBy((int)($row['updated_by'] ?? 0));
        $articulo->setCreatedAt($row['created_at'] ?? null);
        $articulo->setUpdatedAt($row['updated_at'] ?? null);

        return $articulo;


    /*       return new Articulo(
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
        */

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

        //Inventario


public function listInventario(): array
    {
        $sql = "SELECT a.id,
                a.id_familia,
                a.id_ubicacion,
                a.id_unidad,
                a.id_marca,
                a.cantidad,
                a.costo,
                a.minima_cantidad,
                a.updated_at,
                a.nombre_producto,
                b.nombre as 'nombre_familia',
                c.nombre as 'nombre_ubicacion',
                u.nombre as 'nombre_medida',
                m.nombre as 'nombre_marca'
                
                FROM {$this->table} a
                left join familia b on b.id = a.id_familia
                left join ubicacion c on c.id = a.id_ubicacion
                left join unidad_basica u on u.id = a.id_unidad
                left join marca m on m.id = a.id_marca
                ORDER BY a.nombre_producto ASC";
           // echo ($sql);
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $entities = [];

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $newClass = new stdClass();
            $newClass->id = (int)$row['id_familia'];
            $newClass->id_familia = (int)$row['id_ubicacion'];
            $newClass->id_unidad = (int)$row['id_unidad'];
            $newClass->id_marca = (int)$row['id_marca'];
            $newClass->cantidad = (float)$row['cantidad'];
            $newClass->costo = (float)$row['costo'];
            $newClass->minima_cantidad = (float)$row['minima_cantidad'];
            
            $updated_at =  $this->toDateTime($row['updated_at']);
        
            if ($updated_at === null || $updated_at === '') {
                $newClass->updated_at = '';
            } else {
                $newClass->updated_at = (string) $updated_at->format('Y-m-d H:i:s');
            }

            $newClass->nombre_producto = (string)$row['nombre_producto'];
            $newClass->nombre_familia = (string)$row['nombre_familia'];
            $newClass->nombre_ubicacion = (string)$row['nombre_ubicacion'];
            $newClass->nombre_medida = (string)$row['nombre_medida'];
            $newClass->nombre_marca = (string)$row['nombre_marca'];


            $entities[] = $newClass;


            //$entities[] = $this->mapToEntity($row);
        }

        return $entities;
    }

    public function addCantidad($id, $cantidad)
    {
        $sql = "UPDATE {$this->table} SET cantidad = cantidad + :cantidad WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':cantidad', $cantidad, \PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function substractCantidad($id, $cantidad)
    {
        $sql = "UPDATE {$this->table} SET cantidad = cantidad - :cantidad WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':cantidad', $cantidad, \PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
    }

}