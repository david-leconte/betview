<?php

include_once('model/user-info.php');

if(isset($_POST['register'])) {

  if(isset($_POST['regusername']) && strlen($_POST['regusername']) <= 25 && strlen($_POST['regusername']) >= 4) {
    $getUserInfo->bind_param('s', strtoupper($_POST['regusername']));
    $getUserInfo->execute();

    if($getUserInfo->get_result()->num_rows === 0) {

      if(isset($_POST['regpassword']) && isset($_POST['confpassword']) && strlen($_POST['regpassword']) <= 25 && strlen($_POST['regpassword']) >= 5) {

        if($_POST['confpassword'] == $_POST['regpassword']) {

          if(isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            
            if(!empty($_POST['over18'])) {
              $passHash = password_hash($_POST['regpassword'], PASSWORD_BCRYPT);

              $insertUser->bind_param("sssd", $_POST['regusername'], $passHash, $_POST['email'], $level = 0);
              $insertUser->execute();

              $userInfo = $insertUser->get_result()->fetch_array();

              $_SESSION['logged'] = true;
              $_SESSION['username'] = $_POST['regusername'];
              $_SESSION['username'] = $userInfo['id'];
              $_SESSION['level'] = 0;

              header('Location: members');
            }

            else $err = "Veuillez confirmer que vous avez plus de 18 ans pour vous inscrire !";

          }

          else $err = "Votre adresse email n'est pas valide !";

        }

        else $err = "Les deux mots de passe ne correspondent pas !";

      }

      else $err = "Votre mot de passe doit être compris entre 5 et 25 caractères !";
    
    }

    else $err = "Le pseudo choisi est déjà pris !";

  }

  else $err = "Votre pseudo doit être compris entre 4 et 25 caractères ! ";

}

elseif(isset($_POST['login'])) {

  if(isset($_POST['username'])) {

    $getUserInfo->bind_param('s', strtoupper($_POST['username']));
    $getUserInfo->execute();
    $userInfo = $getUserInfo->get_result()->fetch_array();

    if($userInfo->num_rows === 0) $err = "Le pseudo n'existe pas !";

    else {

      if(password_verify($_POST['password'], $userInfo['password'])) {
        $_SESSION['logged'] = true;
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['userid'] = $userInfo['id'];
        $_SESSION['level'] = intval($userInfo['level']);

       header('Location: members');
      }

      else $err = "Mauvais mot de passe !";

    }

  }

  else $err = "Vous n'avez pas entré de pseudo !";

}

if(isset($err)) include_once("view/login.php");

?>