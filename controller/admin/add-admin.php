<?php
include_once('model/admin/admin-info.php');
include_once('model/user-info.php');

if(isset($_POST['addadmin']) && isset($_POST['admtoadd'])) {
  $getUserInfo->bind_param('s', strtoupper($_POST['admtoadd']));
  $getUserInfo->execute();

  $userInfo = $getUserInfo->get_result();

  if($userInfo->num_rows === 0) {
    $msg = "L'utilisateur n'existe pas !";
  }

  else {
    $addAdmin->bind_param('s', $_POST['admtoadd']);
    $addAdmin->execute();
    $msg = "Opération réussie !";
  }
}

elseif(isset($_POST['deladmin']) && isset($_POST['admtodel'])) {
  $getAdminsNames->execute();
  $adminNames = $getAdminsNames->get_result()->fetch_all(dbres);
  $adminsList = [];

  foreach($adminNames as $admin) {
    array_push($adminsList, $admin['username']);
  }

  if(count($adminsList) == 1) $msg = "Vous ne pouvez pas supprimer le dernier admin !";

  else {
    $delAdmin->bind_param('s', $_POST['admtodel']);
    
    $delAdmin->execute();
    $msg = "Opération réussie !";
  }
}

$getAdminsNames->execute();
$adminNames = $getAdminsNames->get_result()->fetch_all(dbres);
$adminsList = [];

foreach($adminNames as $admin) {
  array_push($adminsList, $admin['username']);
}

include_once('view/admin/add-admin.php');

?>