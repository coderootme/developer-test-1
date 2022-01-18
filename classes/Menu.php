<?php

require_once(__DIR__.'/Database.php');

class Menu extends Database{
   public ?array  $menuItems = array();
   public ?string $html = null;

   public function getMenuItems(){
      $result = $this->connection->query("
         SELECT
            `id`,
            `name`,
            `childOfId`,
            `sortOrder`
         FROM `menu`
         ORDER BY `childOfId` ASC, `sortOrder` ASC
      ");
      while($r = $result->fetch_assoc()){
         $this->menuItems[(int)$r['childOfId']][] = array(
            'id' => (int)$r['id'],
            'name' => (string)$r['name'],
            'sortOrder' => (int)$r['sortOrder']
         );
      }
   }

   public function createHtml(){
      $this->html = $this->recurseItems();
   }

   private function recurseItems($parent = 0){
      if (!isset($this->menuItems[$parent])){
         return null;
      }
      $html = '<ul>';
      foreach($this->menuItems[$parent] as $item){
         $html .= '<li>'.$item['name']
            .($this->recurseItems($item['id'])).
         '</li>';
      }
      $html .= '</ul>';
      return $html;
   }

   public function render(){
      return $this->html;
   }
}

?>
