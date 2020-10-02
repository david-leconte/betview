<?php

$id = $_GET["id"];

$detailedBets = 0;
include('model/get-bets.php');
$allBets[0] = $bets;

$detailedBets = 1;
include('model/get-bets.php');
$allBets[1] = $bets;

//print_r($allBets);

foreach($allBets as $halfBets) {
  foreach($halfBets as $betSearch) {
    if($betSearch['id'] == $id) $bet = $betSearch;
  }
}

//print_r($bet);

include_once('view/get-bets-json.php');
?>