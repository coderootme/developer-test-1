<?php

error_reporting(E_ALL);

require_once(__DIR__.'/../classes/Menu.php');
require_once(__DIR__.'/../classes/Form.php');
require_once(__DIR__.'/../classes/People.php');

$menu = new Menu;
$menu->getMenuItems();
$menu->createHtml();

$form = new Form('/submit.php', 'post');
$form->addElement('First name', 'firstName');
$form->addElement('Surname',    'surname');
$form->addElement('Locations',  'location[]', 'select');

$people = new People;

echo'

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8" />
      <title>Developer Programming Test</title>
      <link rel="stylesheet" href="/style.css" />
      <link rel="icon" href="data:;base64,iVBORw0KGgo=" />
   </head>
   <body>
      <div id="app">
         <div id="menu">
            '.$menu->render().'
         </div>
         <div id="content">
            <h2>Insert person</h2>
            '.$form->render().'
            <div id="errorList" class="error">

            </div>

            <h2>Current data</h2>
            <div id="peopleList">
               '.$people->list().'
            </div>
         </div>
      </div>
      <script type="text/javascript" src="/custom.js"></script>
   </body>
</html>

';

?>
