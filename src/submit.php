<?php

require_once(__DIR__.'/../classes/Person.php');
require_once(__DIR__.'/../classes/People.php');

foreach(array('firstName', 'surname') as $item){
   $post[$item] = (isset($_POST[$item])?trim($_POST[$item]):null);
}

$person = new Person(
   $post['firstName'],
   $post['surname']
);

if ($person->isValid()){
   $person->save();
   $people = new People;
   echo json_encode(array('success', $people->list()));
}
else{
   echo json_encode(array('error', $person->getErrors()));
}

?>
