<?php

namespace App\Repositories;

use App\Entities\ComponentsText;
use stdClass;

class ComponentsTextRepository extends BaseRepository
{
    //private PDO $pdo;
    private string $table = 'componentsText';

    //public function __construct(PDO $pdo)
    //{
        // Recommended attributes (can also be set by the caller)
    //    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    //    $this->pdo = $pdo;
    //}

    // Create (INSERT) — returns the persisted entity with its new id
    public function create(ComponentsText $e): ComponentsText
    {
        $sql = "INSERT INTO {$this->table} (idProject, valueId, textValue, orderId)
                VALUES (:idProject, :valueId, :textValue, :orderId)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':idProject' => $e->getIdProject(),
            ':valueId'   => $e->getValueId(),
            ':textValue' => $e->getTextValue(),
            ':orderId'   => $e->getOrderId(),
        ]);

        $e->setId((int)$this->pdo->lastInsertId());
        return $e;
    }

    // Read by primary key
    public function find(int $id): ?ComponentsText
    {
        $sql = "SELECT id, idProject, valueId, textValue, orderId
                FROM {$this->table}
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();

        return $row ? $this->hydrate($row) : null;
    }

    // Read all (optionally ordered by orderId then id)
    public function findAll(): array
    {
        $sql = "SELECT id, idProject, valueId, textValue, orderId
                FROM {$this->table}
                ORDER BY orderId ASC, id ASC";
        $stmt = $this->pdo->query($sql);

        $out = [];
        while ($row = $stmt->fetch()) {
            $out[] = $this->hydrate($row);
        }
        return $out;
    }

    // Finder by project
    public function findByProject(int $idProject): array
    {
        $sql = "SELECT valueId, textValue 
                FROM {$this->table}
                WHERE idProject = :idProject
                ORDER BY orderId ASC";
               
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':idProject' => $idProject]);

        $out = [];
        while ($row = $stmt->fetch()) {
           
            $newClass = new stdClass();
            $newClass->valueId = (int)$row['valueId'];
            $newClass->textValue = (string)$row['textValue'];
            $out[] = $newClass;
       }
     
        return $out;
    }

    // Update — returns true if a row was updated
    public function update(ComponentsText $e): bool
    {
       // if ($e->getId() === null) {
       //     throw new InvalidArgumentException('Cannot update entity without id.');
       // }

        $sql = "UPDATE {$this->table}
                   SET idProject = :idProject,
                       valueId   = :valueId,
                       textValue = :textValue,
                       orderId   = :orderId
                 WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':idProject' => $e->getIdProject(),
            ':valueId'   => $e->getValueId(),
            ':textValue' => $e->getTextValue(),
            ':orderId'   => $e->getOrderId(),
            ':id'        => $e->getId(),
        ]);

        return $stmt->rowCount() > 0;
    }

    // Upsert by id (insert if no id, else update) — returns the entity (with id)
    public function save(ComponentsText $e): ComponentsText
    {
        return $e->getId() === null ? $this->create($e) : ($this->update($e) ? $e : $e);
    }

    // Delete by id — returns true if a row was deleted
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->rowCount() > 0;
    }

    // Reorder: set orderId for a specific row
    public function setOrder(int $id, int $orderId): bool
    {
        $sql = "UPDATE {$this->table} SET orderId = :orderId WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':orderId' => $orderId, ':id' => $id]);
        return $stmt->rowCount() > 0;
    }

    // Count rows (optional filter by project)
    public function count(?int $idProject = null): int
    {
        if ($idProject === null) {
            $sql = "SELECT COUNT(*) FROM {$this->table}";
            return (int)$this->pdo->query($sql)->fetchColumn();
        }
        $sql = "SELECT COUNT(*) FROM {$this->table} WHERE idProject = :idProject";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':idProject' => $idProject]);
        return (int)$stmt->fetchColumn();
    }

    // Internal: map DB row to entity
    private function hydrate(array $row): ComponentsText
    {
        $e = new ComponentsText();
        $e->setId(isset($row['id']) ? (int)$row['id'] : null);
        $e->setIdProject((int)$row['idProject']);
        $e->setValueId((int)$row['valueId']);
        $e->setTextValue($row['textValue'] !== null ? (string)$row['textValue'] : null);
        $e->setOrderId((int)$row['orderId']);
        return $e;
    }

 // Internal: map DB row to entity
    private function hydrate2(array $row): ComponentsText
    {
        $e = new ComponentsText();
        $e->setValueId((int)$row['valueId']);
        $e->setTextValue($row['textValue'] !== null ? (string)$row['textValue'] : null);
        return $e;
    }

}
