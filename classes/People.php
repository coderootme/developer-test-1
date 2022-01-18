<?php

require_once(__DIR__.'/Database.php');

class People extends Database{
   private array $people;

   public function __construct(){
      parent::__construct();
      $result = $this->connection->query("
         SELECT
            `id`,
            `firstname`,
            `surname`
         FROM `person`
         ORDER BY `id` ASC
      ");
      while($r = $result->fetch_assoc()){
         $this->people[(int)$r['id']] = array(
            'firstname' => (string)$r['firstname'],
            'surname' => (string)$r['surname']
         );
      }
   }

   public function list(){
      $html = '<table>';
      $html .= '<thead>
         <tr>
            <th>ID</th>
            <th>First name</th>
            <th>Surname</th>
            <th>Locations</th>
         </tr>
      </thead>';
         foreach($this->people as $id=>$attrs){
            $html .= '
               <tr>
                  <td>'.$id.'</td>
                  <td>'.$attrs['firstname'].'</td>
                  <td>'.$attrs['surname'].'</td>
                  <td></td>
               </tr>
            ';
         }
      $html .= '</table>';
      return $html;
   }
}

?>
