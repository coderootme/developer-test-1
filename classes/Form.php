<?php

require_once(__DIR__.'/Database.php');

class Form {
   private ?string $action;
   private  string $method;
   private  array  $elements = array();

   public function __construct($action = null, $method = 'get'){
      $this->action = $action;
      $this->method = $method;
   }

   public function addElement($label, $name, $type='text'){
      $this->elements[] = array(
         'label'=>$label,
         'name' =>$name,
         'type' =>$type
      );
   }

   private function renderInput($element){
      return '
         <tr>
            <td>'.$element['label'].'</td>
            <td><input
               name="'.$element['name'].'"
               type="'.$element['type'].'"
            /></td>
         </tr>
      ';
   }

   private function renderSelect($element, $options){
      return '
         <tr>
            <td>'.$element['label'].'</td>
            <td>
               <select name="'.$element['name'].'">
                  <option></option>
               </select>
            </td>
         </tr>
      ';
   }

   private function renderSubmitButton(){
      return '<input type="submit" value="submit" name="submit" />';
   }

   public function render(){
      $html = '<form
         action="'.$this->action.'"
         method="'.$this->method.'"
         onsubmit="send(event,this)"
      >';
         $html .= '<table>';
            foreach($this->elements as $element){
               if ($element['type']=='text'){
                  $html .= $this->renderInput($element);
               }
               else if ($element['type']=='select'){
                  $html .= $this->renderSelect($element, '');
               }
            }
         $html .= '</table>';
         $html .= $this->renderSubmitButton();
      $html .= '</form>';

      return $html;
   }
}

?>
