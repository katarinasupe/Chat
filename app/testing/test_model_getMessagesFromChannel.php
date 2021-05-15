<?php

require_once __DIR__ . '/../../model/chatservice.class.php';
require_once __DIR__ . '/../../model/message.class.php';

//da je getAllUsers static, onda ide LibraryService::getAllUsers();
$cs = new ChatService();
$messages = $cs->getMessagesFromChannel( 'ODJ - Predavanja u srijedu' );

echo '<pre>';
print_r( $messages );
echo '</pre>';

?>