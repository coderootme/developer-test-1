<?php

class Database{
   private  string $hostname = 'localhost';
   private  string $username = 'visma';
   private ?string $password = 'secret';
   private  string $database = 'visma';
   protected $connection;

   public function __construct(){
      $this->connection = new mysqli(
         $this->hostname,
         $this->username,
         $this->password,
         $this->database
      );
      if ($this->connection){
         $this->connection->set_charset("utf8mb4");
      }
   }

   public function query($query){
      return $this->connection->query($query);
   }
}

?>
