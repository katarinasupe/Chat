<?php

require_once __DIR__ . '/../../model/chatservice.class.php';
require_once __DIR__ . '/../../model/channel.class.php';

session_start();
$_SESSION['id_user'] = 2;

//da je getAllUsers static, onda ide LibraryService::getAllUsers();
$cs = new ChatService();
$name = 'MA - Vjezbe';
$cs->createNewChannel( $name );

echo 'Created new channel'. $name;

?>