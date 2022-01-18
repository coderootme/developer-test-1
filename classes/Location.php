<?php

require_once(__DIR__.'/Database.php');

class Location extends Database{
   public  ?array  $locations;
   public  ?array  $types;

   public function getLocations(){
      $result = $this->connection->query("
         SELECT
            `id`,
            `name`
         FROM `location`
      ");
      while($r = $result->fetch_assoc()){
         $this->locations[(int)$r['id']] = array(
            'name' => (string)$r['name'],
         );
      }
   }

   public function getTypes(){
      $result = $this->connection->query("
         SELECT
            `id`,
            `description`
         FROM `locationType`
      ");
      while($r = $result->fetch_assoc()){
         $this->types[(int)$r['id']] = array(
            'description' => (string)$r['description'],
         );
      }
   }

   public function validateLocation($id){
      return isset($this->locations[$id]);
   }

   public function validateLocationType($id){
      return isset($this->types[$id]);
   }

   public function locationSelector($selected){
      $html = '<option value="0">choose</option>';
      foreach($this->locations as $id=>$attrs){
         $html .= '<option value="'.$id.'" '.
            ($selected===$id?'selected':null)
         .'>'.$attrs['name'].'</option>';
      }
      return $html;
   }

   public function typeSelector($selected){
      $html = '<option value="0">choose</option>';
      foreach($this->types as $id=>$attrs){
         $html .= '<option value="'.$id.'" '.
            ($selected===$id?'selected':null)
         .'>'.$attrs['description'].'</option>';
      }
      return $html;
   }

   public function newLocation($description){
      $statement = $connection->prepare("INSERT IGNORE INTO `location` (`name`) VALUES (?)");
      $statement->bind_param("s", $description);
      $statement->execute();
      if ($connection->insert_id){
         return $connection->insert_id;
      }
      $statement = $connection->prepare("SELECT `id` FROM `location` WHERE `name` = ?");
      $statement->bind_param("s", $description);
      $statement->execute();
      return $statement->get_result()->fetch_assoc()['id'];
   }
}

?>
