<?php

include_once('model/match.php');

if($pageTitle == ' - ') {
  header('HTTP/1.0 404 Not Found');
  exit;
}

$currentDateTime = new DateTime();
$gameOver = ($currentDateTime > $gameDateTime) ? true : false;

if(!$gameOver && $_SESSION['logged']) {
  $hasVoted = false;

  include_once('model/votes.php');

  $selUserVote->bind_param('sd', $bet['id'], $_SESSION['userid']);
  $selUserVote->execute();

  if($selUserVote->get_result()->num_rows !== 0) $hasVoted = true;

  $isVoteValid = ($_GET['vote'] && abs(intval($_GET['vote'])) <= 3 && abs(intval($_GET['vote'])) >= 1) ? true : false;

  if($isVoteValid && !$hasVoted) {
    $insertVote->bind_param('dds', $_SESSION['userid'], $_GET['vote'], $bet['id']);
    $insertVote->execute();

    header('Location: match-' . $bet['id']);
  }

  elseif($hasVoted) {
    $selGameVotes->bind_param('s', $bet['id']);
    $selGameVotes->execute();
    $gameVotes = $selGameVotes->get_result()->fetch_all(dbres);

    //print_r($gameVotes);

    $votesForHome = 0;
    $votesForDraw = 0;
    $votesForAway = 0;

    foreach($gameVotes as $vote) {
      if($vote['value'] == 1) $votesForHome++;
      elseif($vote['value'] == 2) $votesForDraw++;
      elseif($vote['value'] == 3) $votesForAway++;
    }

    $percentages['home'] = ($votesForHome / ($votesForHome + $votesForDraw + $votesForAway)) * 100;
    $percentages['draw'] = ($votesForDraw / ($votesForHome + $votesForDraw + $votesForAway)) * 100;
    $percentages['away'] = ($votesForAway / ($votesForHome + $votesForDraw + $votesForAway)) * 100;
  }
}

include_once('view/header.php');
include_once('view/match.php');
include_once('view/footer.php');

?>