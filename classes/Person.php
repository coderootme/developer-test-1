<?php

require_once(__DIR__.'/Database.php');

class Person extends Database{
   private ?string $firstname;
   private ?string $surname;
   private array   $errors = array();

   public function __construct($firstname, $surname){
      parent::__construct();
      $this->firstname = $firstname;
      $this->surname   = $surname;
   }

   public function isValid(){
      if (mb_strlen($this->firstname) < 3){
         $this->errors[] = 'First name is not valid.';
      }
      if (mb_strlen($this->surname) < 3){
         $this->errors[] = 'Surname is not valid.';
      }
      if ($this->errors){ return false; }
      return true;
   }

   public function getErrors(){
      return $this->errors;
   }

   public function save(){
      $stmt = $this->connection->prepare("
         INSERT INTO `person` (`firstname`, `surname`) VALUES (?, ?)
      ");
      $stmt->bind_param("ss", $this->firstname, $this->surname);
      $stmt->execute();
   }
}

?>
