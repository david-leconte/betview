<?php

$selBigReq  = $db->prepare('SELECT visible FROM bets WHERE id = ?');

$hideBigReq = $db->prepare('UPDATE bets SET visible = 0 WHERE id = ?');
$showBigReq = $db->prepare('UPDATE bets SET visible = 1 WHERE id = ?');

$delBigBetReq = $db->prepare('DELETE FROM bets WHERE id = ?');
$delAdviceReq = $db->prepare('DELETE FROM detailedadvices WHERE gameid = ?');

$selSimpReq  = $db->prepare('SELECT visible FROM simplebets WHERE id = ?');

$hideSimpReq = $db->prepare('UPDATE simplebets SET visible = 0 WHERE id = ?');
$showSimpReq = $db->prepare('UPDATE simplebets SET visible = 1 WHERE id = ?');

$delSimpBetReq = $db->prepare('DELETE FROM simplebets WHERE id = ?');

?>