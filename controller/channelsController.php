<?php
require_once __DIR__ . '/../model/chatservice.class.php';

class ChannelsController{
    //funkcija koja ispisuje sve kanale trenutnog korisnika
    public function index(){
        $cs = new ChatService;
        $channelList = $cs->getChannelsByUser();
        $title = 'List of @' . $_SESSION['username'] . '`s channels'; 
        require_once __DIR__ . '/../view/channels_index.php';
    }

    //funkcija koja ispisuje sve postojeće kanale
    public function allChannels(){
        $cs = new ChatService;
        $channelList = $cs->getAllChannels();
        $title = 'All channels';
        require_once __DIR__ . '/../view/channels_index.php';
    }

    //funkcija koja ovisno o statusu kreiranja kanala vraća poruku ili samo view
    public function createChannel(){
        if(isset($_GET['success'])){
            if((int)$_GET['success'] === 1){
                $message = 'You have successfully created a new channel! Feel free to create another one!';
            }
            else if((int)$_GET['success'] === 0){
                $message = 'Error! Enter the channel name in the correct form.';
            } 
        }
        else{
            $message = 'Here you can create a new channel!';
        }
        require_once __DIR__ . '/../view/channels_createChannel.php';
    }

    //funkcija koja obrađuje zahtjev kreiranja novog kanala
    public function createChannelResults(){
        $cs = new ChatService;
        if( isset( $_POST['name'] ) && preg_match('/^[A-ža-ž0-9 -]+$/', $_POST['name']) && !($cs->isChannelInBase( $_POST["name"] ))){
            $cs->createNewChannel( $_POST["name"] );
            header('Location: chat.php?rt=channels/createChannel&success=1');
        }
        else{
            $message = 'Error! Enter the channel name in the correct form.';
            header('Location: chat.php?rt=channels/createChannel&success=0');
        }
    }
}

?>