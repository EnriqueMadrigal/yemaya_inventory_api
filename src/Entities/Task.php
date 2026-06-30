<?php
namespace App\Entities;

  class Task {
      private $id;
      private $title;
      private $dueDate;

      public function __construct($id, $title, $dueDate) {
          $this->id = $id;
          $this->title = $title;
          $this->dueDate = $dueDate;
      }

      public function getTitle() {
          return $this->title;
      }
  }
  
