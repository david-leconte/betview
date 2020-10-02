<?php

include_once('config.php');

session_start();

try {
  $db = new mysqli($config['dbhost'], $config['dbuser'], $config['dbpass'], $config['dbname']);
}

catch(Exception $e) {
  exit('Erreur connexion à la base de données' . $e);
}

if(!isset($_SESSION['level'])) $_SESSION['level'] = 0;

if(isset($_GET['admin']) && $_SESSION['level'] > 0) {

  if(isset($_GET['page']) AND file_exists('controller/admin/' . $_GET['page'] . '.php')) {
    include_once('controller/admin/' . $_GET['page'] . '.php');
  }
  
  else include_once('controller/admin/index.php');

}

elseif(!isset($_GET['page']) OR !file_exists('controller/' . $_GET['page'] . '.php') OR $_GET['page'] == 'index') {
  include_once('controller/index.php');
}

else {
	include_once('controller/' . $_GET['page'] . '.php');
}

?>