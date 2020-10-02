<?php 

$detailedBets = 1; // 1 si oui 0 sinon

$pageTitle = $config['sitename'] . " - les choix de la team !";

include_once('model/get-bets.php');
include_once('model/admin/admin-info.php');

$getAdminsNames->execute();
$adminNames = $getAdminsNames->get_result()->fetch_all(dbres);
$authorsList = [];

foreach($adminNames as $admin) {
  array_push($authorsList, $admin['username']);
}

include_once('view/header.php');
include_once('view/index.php');
include_once('view/footer.php'); 

?>