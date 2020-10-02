<?php

$betReq = $db->prepare('SELECT * FROM bets WHERE id = ?');
$betReq->bind_param('s', $_GET['id']);
$betReq->execute();

$bet = $betReq->get_result()->fetch_array(dbres);

$homeAcronym = substr($bet['id'], 0, 3);
$awayAcronym = substr($bet['id'], 4, 3);

$bet['home'] = $db->query('SELECT teamname FROM teams WHERE acronym = "' . $homeAcronym . '"')->fetch_array(dbres);
$bet['away'] = $db->query('SELECT teamname FROM teams WHERE acronym = "' . $awayAcronym . '"')->fetch_array(dbres);

$gameDateTime = new DateTime($bet['date']);
$bet['date'] = $gameDateTime->format("d/m/Y - H:i");

$adviceReq = $db->prepare('SELECT * FROM detailedadvices WHERE awayteam = ? AND gameid = ? ORDER BY id');

$adviceReq->bind_param('ds', $away = 0, $_GET['id']);
$adviceReq->execute();
$bet['homeadvices'] = $adviceReq->get_result()->fetch_all(dbres);

$adviceReq->bind_param('ds', $away = 1, $_GET['id']);
$adviceReq->execute();
$bet['awayadvices'] = $adviceReq->get_result()->fetch_all(dbres);

$pageTitle = $bet['home']['teamname'] . ' - ' . $bet['away']['teamname'];

?>