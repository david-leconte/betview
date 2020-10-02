<?php

$teams = $db->query('SELECT * FROM teams ORDER BY teamname')->fetch_all(dbres);

$acrFromName = $db->prepare('SELECT acronym FROM teams WHERE teamname LIKE ?');
$teamByAcr = $db->prepare('SELECT teamname FROM teams WHERE acronym = ?');

$insertTeamReq = $db->prepare('INSERT INTO teams VALUES (0, ?, ?)');
$delTeamReq = $db->prepare('DELETE FROM teams WHERE acronym = ?');

$insertSimpBetReq = $db->prepare('INSERT INTO simplebets VALUES (0, ?, ?, ?, ?, 1)');

$insertBigBetReq = $db->prepare('INSERT INTO bets VALUES (?, ?, ?, ?, 1, ?)');
$insertDetailReq = $db->prepare('INSERT INTO detailedadvices VALUES (0, ?, ?, ?)');

$hideDelTeamBet = $db->prepare('UPDATE bets SET visible = 0 WHERE id LIKE ?');

?>