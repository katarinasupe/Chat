<?php
require_once __DIR__ . '/../model/chatservice.class.php';
require_once __DIR__ . '/channelsController.php';

class UsersController{
    //funkcija koja daje login screen
    public function login(){
        require_once __DIR__ . '/../view/login.php';
    }
    
    //funkcija koja obrađuje prijavu korisnika
    public function handleLogin(){
        if( isset( $_POST['username'] ) && preg_match('/^[A-ža-ž0-9_-]+$/', $_POST['username']) && isset( $_POST['password'] ) ){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $cs = new ChatService;
            if( $cs->isUserInBase( $username, $password ) ){
                $_SESSION['username'] = $_POST['username'];
                $cs->setUserId( $username ); 
                header('Location: chat.php?rt=channels/index');
            }
            else{
                require_once __DIR__ . '/../view/login.php';
                echo '<br>';
                echo '<span style = "font-family: Verdana, Geneva, sans-serif; color: #FA7268;">' . 'Unesite ispravne podatke za prijavu.' . '</span>'; 
            } 
        }
    }

    //funkcija koja odjavljuje korisnika te unistava sesiju
    public function logout(){
        session_unset();
        session_destroy();
        require_once __DIR__ . '/../view/login.php';
    }
}

?>