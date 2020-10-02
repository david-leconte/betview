<?php

$detailedBets = 1;
include('model/get-bets.php');
$bigBets = $bets;

$detailedBets = 0;
include('model/get-bets.php');
$simpBets = $bets;

include_once('model/admin/del-bet.php');

$hidePastBets = false;

$change = 0;

if(isset($_POST['toggle_big'])) {
  foreach($_POST['toggle_big'] as $betID) {
    $selBigReq->bind_param('s', $betID);
    $selBigReq->execute();

    $visible = $selBigReq->get_result()->fetch_array()['visible'];

    if($visible == 0) {
      $showBigReq->bind_param('s', $betID);
      $showBigReq->execute();
    }

    elseif($visible == 1) {
      $hideBigReq->bind_param('s', $betID);
      $hideBigReq->execute();
    }
  }

  $change = 1;
}

elseif(isset($_POST['toggle_simp'])) {
  foreach($_POST['toggle_simp'] as $betID) {
    $selSimpReq->bind_param('s', $betID);
    $selSimpReq->execute();

    $visible = $selSimpReq->get_result()->fetch_array()['visible'];

    if($visible == 0) {
      $showSimpReq->bind_param('s', $betID);
      $showSimpReq->execute();
    }

    elseif($visible == 1) {
      $hideSimpReq->bind_param('s', $betID);
      $hideSimpReq->execute();
    }
  }

  $change = 1;
}

if(isset($_POST['delete_big'])) {
  foreach($_POST['delete_big'] as $betID) {
    $delBigBetReq->bind_param('s', $betID);
    $delBigBetReq->execute();

    $delAdviceReq->bind_param('s', $betID);
    $delAdviceReq->execute();
  }

  $change = 1;
}

elseif(isset($_POST['delete_simp'])) {
  foreach($_POST['delete_simp'] as $betID) {
    $delSimpBetReq->bind_param('s', $betID);
    $delSimpBetReq->execute();
  }

  $change = 1;
}

if($change == 1) header('Location: ' . $_SERVER['PHP_SELF'] . '?admin&page=del-bet');

include_once('view/admin/del-bet.php');

?>