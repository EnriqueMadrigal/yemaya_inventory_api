<?php
namespace App\Repositories;

  use App\Config\Database;

  abstract class BaseRepository {
      protected $pdo;

      public function __construct() {
          $this->pdo = Database::getInstance();
          $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
          $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
      
      }

      /*
      public function findById($table, $id) {
          $stmt = $this->pdo->prepare("SELECT * FROM $table WHERE id = :id");
          $stmt->execute(['id' => $id]);
          return $stmt->fetch();
      }

      public function findAll($table) {
          $stmt = $this->pdo->query("SELECT * FROM $table");
          return $stmt->fetchAll();
      }

      public function delete($table, $id) {
          $stmt = $this->pdo->prepare("DELETE FROM $table WHERE id = :id");
          return $stmt->execute(['id' => $id]);
      }

      */
  }