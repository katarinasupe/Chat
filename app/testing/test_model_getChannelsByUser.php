<?php

require_once __DIR__ . '/../../model/chatservice.class.php';
require_once __DIR__ . '/../../model/channel.class.php';

//da je getAllUsers static, onda ide LibraryService::getAllUsers();
$cs = new ChatService();
$channels = $cs->getChannelsByUser( 'mirko' );

echo '<pre>';
print_r( $channels );
echo '</pre>';

?>