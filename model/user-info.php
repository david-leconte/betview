<?php

$getUserInfo = $db->prepare("SELECT * FROM users WHERE upper(username) = ?");

$insertUser = $db->prepare("INSERT INTO users VALUES(0, ?, ?, ?, ?)");

$updatePassword = $db->prepare("UPDATE users SET password = ? WHERE upper(username) = ?");

$updateMail = $db->prepare("UPDATE users SET mail = ? WHERE upper(username) = ?");

?>