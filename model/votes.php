<?php

$selGameVotes = $db->prepare('SELECT * FROM votes WHERE game = ?');
$selUserVote = $db->prepare('SELECT * FROM votes WHERE game = ? AND user = ?');

$insertVote = $db->prepare('INSERT INTO votes VALUES(0, ?, ?, ?)');

?>