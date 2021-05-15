<?php
require_once __DIR__ . '/../model/chatservice.class.php';

class MessagesController{
    //ispis svih poruka trenutnog korisnika
    public function index(){
        $cs = new ChatService;
        $messageList = $cs->getMessagesByUser();
        $title = $_SESSION['username'] . '`s messages';
        require_once __DIR__ . '/../view/messages_index.php';
    }

    //ispis svih poruka unutar nekog kanala
    public function channel(){
        $cs = new ChatService;
        if(isset($_GET['channel_id'])){
            $id_channel = (int)$_GET['channel_id'];
            $_SESSION['channel_id'] = $id_channel;
            if( $cs->isChannelInBase( $id_channel ) ){
                $_SESSION['channel_name'] = $cs->getChannelName($id_channel);
                $messageList = $cs->getMessagesFromChannel( $_SESSION['channel_name'] );
                $title = 'Messages from ' . $_SESSION['channel_name'] . ' channel';
                require_once __DIR__ . '/../view/messages_channel.php';
            }
            else echo 'Pokušavate pristupiti nepostojećem kanalu.';
        }
    }

    //updateanje palceva gore nakon klika
    public function thumbsUp(){
        $cs = new ChatService;
        if(isset($_GET['message_id'])){
            if( $cs->isMessageInBase( (int)$_GET['message_id'] ) ){
                //staro stanje thumbs_up kliknute poruke
                $thumbs_up = $cs->getMessageThumbsUp( (int)$_GET['message_id'] );
                //inkrement thumbs up
                $thumbs_up = $thumbs_up + 1;
                //update stanje thumbs_up kliknute poruke
                $cs->updateMessageThumbsUp( $thumbs_up, (int)$_GET['message_id']);
                
                header('Location: chat.php?rt=messages/channel&channel_id=' . $_SESSION['channel_id']);
            }
        }
    }

    //kreiranje nove poruke 
    public function createMessage(){
        $cs = new ChatService;
        if( isset($_POST['message']) ){
            $id_user = $_SESSION['id_user'];
            $id_channel = $_SESSION['channel_id'];
            $content = $_POST['message'];
            $cs->createNewMessage( $content, $id_user, $id_channel );
            header('Location: chat.php?rt=messages/channel&channel_id=' . $_SESSION['channel_id']);
        }
    }

}

?>