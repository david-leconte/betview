<?php

$addAdmin = $db->prepare("UPDATE users SET level = 1 WHERE username = ?");

$delAdmin = $db->prepare("UPDATE users SET level = 0 WHERE username = ?");

$getAdminsNames = $db->prepare("SELECT username FROM users WHERE level > 0");

?>