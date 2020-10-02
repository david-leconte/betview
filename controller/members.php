<?php
include_once('view/header.php');

if(!isset($_SESSION['logged'])) {
  if(isset($_POST['login']) xor isset($_POST['register'])) {
    include_once('controller/process-log.php');
  }

  else include_once('view/login.php');
}

else {
  if(isset($_GET['logout'])) {
    echo 'looooo';
    session_destroy();
    header('Location: index');
  }

  elseif(isset($_POST['passchange'])) {

    if(isset($_POST['oldpassword']) && isset($_POST['newpassword']) && isset($_POST['confpassword'])) {

      include_once('model/user-info.php');

      $getUserInfo->bind_param('s', strtoupper($_SESSION['username']));
      $getUserInfo->execute();
      $userInfo = $getUserInfo->get_result();

      if(password_verify($_POST['oldpassword'], $userInfo->fetch_array()['password'])) {
        
        if($_POST['newpassword'] == $_POST['confpassword']) {

          $passHash = password_hash($_POST['newpassword'], PASSWORD_BCRYPT);

          $updatePassword->bind_param('ss', $passHash, $_SESSION['username']);
          $updatePassword->execute();

          $good = true;
        }

        else $err = "Confirmation du mot de passe erronée !";
      }

      else $err = "L'ancien mot de passe ne correspond pas !";
    }

    else $err = "Vous n'avez pas rempli tous les champs correctement !";
  }

  else if(isset($_POST['emailchange'])) {
    if(isset($_POST['password']) && isset($_POST['email'])) {

      include_once('model/user-info.php');

      $getUserInfo->bind_param('s', strtoupper($_SESSION['username']));
      $getUserInfo->execute();
      $userInfo = $getUserInfo->get_result();

      if(password_verify($_POST['password'], $userInfo->fetch_array()['password'])) {
        
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

          $updateMail->bind_param('ss', $_POST['email'], $_SESSION['username']);
          $updateMail->execute();

          $good = true;
        }

        else $err = "Email invalide !";
      }

      else $err = "Mauvais mot de passe !";
    }

    else $err = "Vous n'avez pas rempli tous les champs correctement !";
  }

  include_once('view/member-space.php');
}

include_once('view/footer.php');
?>