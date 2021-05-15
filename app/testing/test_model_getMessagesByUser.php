<?php

require_once __DIR__ . '/../../model/chatservice.class.php';
require_once __DIR__ . '/../../model/message.class.php';

session_start();
$_SESSION['id_user'] = 1;
//da je getAllUsers static, onda ide LibraryService::getAllUsers();
$cs = new ChatService();
$messages = $cs->getMessagesByUser();

echo '<pre>';
print_r( $messages );
echo '</pre>';

?>