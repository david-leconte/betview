<?php

include_once('model/admin/add-bet-teams.php');

// Ajouter un pari

if(isset($_POST['teams'], $_POST['odds'], $_POST['author'], $_POST['date'], $_POST['advice'], $_POST['homeadvice'], $_POST['awayadvice'])) {
  $acronyms = [];

  foreach($_POST['teams'] as $team) {
    if(strlen($team) > 3) {
      $acrFromName->bind_param('s', $searchTeam = '%' . $team . '%');
      $acrFromName->execute();
      $teamAcr = $acrFromName->get_result()->fetch_array(dbres)['acronym'];
      echo $teamAcr;

      if(empty($teamAcr)) {
        $simpBet = true;
      }

      else array_push($acronyms, $teamAcr);
    }

    else {
      $teamByAcr->bind_param('s', $team);
      $teamByAcr->execute();
      $teamName = $teamByAcr->get_result()->fetch_array(dbres)['teamname'];

      if(empty($teamName)) {
        $simpBet = true;
      }

      else array_push($acronyms, $team);
    }
  }

  //if(!isset($formError)) {
    $dateInput = DateTime::createFromFormat('Y-m-d', $_POST['date']);
    $betID = $acronyms[0] . '-' . $acronyms[1] . '-' . $dateInput->format('dmy');

    $datetime = $_POST['date'] . ' ' . $_POST['time'] . ':00';

    if((empty($_POST['homeadvice']) AND empty($_POST['homeadvice'])) OR $simpBet) {
      $title = implode(" - ", $_POST['teams']);
      $insertSimpBetReq->bind_param('sssd', $title, $datetime, $_POST['advice'], $_POST['odds']);
      $insertSimpBetReq->execute();
    }

    else {
      $splitHomeAdvices = preg_split("/\r\n|\n|\r/", $_POST['homeadvice']);
      $splitAwayAdvices = preg_split("/\r\n|\n|\r/", $_POST['awayadvice']);

      foreach($splitHomeAdvices as $homeAdvice) {
        if(!empty($homeAdvice)) {
          $insertDetailReq->bind_param('sds', $betID, $away = 0, $homeAdvice);
          $insertDetailReq->execute();
        }
      }

      foreach($splitAwayAdvices as $awayAdvice) {
        if(!empty($awayAdvice)) {
          $insertDetailReq->bind_param('sds', $betID, $away = 1, $awayAdvice);
          $insertDetailReq->execute();
        }
      }

      $insertBigBetReq->bind_param('sssds', $betID, $datetime, $_POST['advice'], $_POST['odds'], $_POST['author']);
      $insertBigBetReq->execute();
    }

    header('Location: ' . $_SERVER['PHP_SELF'] . '?admin&page=add-bet-teams');
  //}
}

// Ajouter une équipe

if(isset($_POST['newname'], $_POST['newacronym'], $_FILES['newlogo'])) {
  if($_FILES['newlogo']['size'] > 800000 OR pathinfo($_FILES['newlogo']['name'])['extension'] != "png") {
    $_FILES['newlogo']['error'] = 1;
  }

  if($_POST['newname'] != "" AND strlen($_POST['newacronym']) == 3 AND $_FILES['newlogo']['error'] == 0) {
    $insertTeamReq->execute(array($_POST['newname'], $_POST['newacronym']));

    move_uploaded_file($_FILES['newlogo']['tmp_name'], 'res/logo/' . $_POST['newacronym'] . '.png');

    header('Location: ' . $_SERVER['PHP_SELF'] . '?admin&page=add-bet-teams');
  }

  else $formError = "Erreur format de l'envoi";
}

// Supprimer une équipe

if(isset($_POST['delteam'])) {
  foreach($_POST['delteam'] as $acronym) {
    $delTeamReq->execute(array($acronym));

    $hideDelTeamBet->execute(array('%' . $acronym . '%'));

    header('Location: ' . $_SERVER['PHP_SELF'] . '?admin&page=add-bet-teams');
  }
}

include_once('view/admin/add-bet-teams.php');

?>