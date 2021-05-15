<?php
session_start();
require_once __DIR__ . '/../app/database/db.class.php';
require_once __DIR__ . '/channel.class.php';
require_once __DIR__ . '/message.class.php';


class ChatService{
    //popis svih kanala koji postoje
    public function getAllChannels(){
        $channels = [];
        $db = DB::getConnection();
        $st = $db->prepare( 'SELECT * FROM dz2_channels' );
        $st->execute();

        while( $row = $st->fetch() ){
            $channels[] = new Channel( $row['id'], $row['id_user'], $row['name'] );
        }
        return $channels;
    }
    //popis svih kanala koje je pokrenuo user s imenom $username
    public function getChannelsByUser(){
        $channels = [];
        $db = DB::getConnection();
        $st = $db->prepare( 'SELECT id FROM dz2_users WHERE username=:username' );
        $st->execute( ['username' => $_SESSION['username']] );
        $id_user = $st->fetch()['id'];
        $st = $db->prepare( 'SELECT * FROM dz2_channels WHERE id_user=:id_user' );
        $st->execute(['id_user' => $id_user]);

        while( $row = $st->fetch() ){
            $channels[] = new Channel( $row['id'], $row['id_user'], $row['name'] );
        }
        return $channels;
    }
    //kreiraj novu poruku sadrzaja $content od strane korisnika s id-em $id_user na kanalu s id-em $id_channel
    public function createNewMessage( $content, $id_user, $id_channel ){
        $db = DB::getConnection();
        $st = $db->prepare( "INSERT INTO dz2_messages (id, id_user, id_channel, content, thumbs_up, date) 
                                VALUES (NULL, :id_user, :id_channel, :content, :thumbs_up, :date)" );
        $thumbs_up = 0;
        $st->bindParam(':id_user', $id_user);
        $st->bindParam(':id_channel', $id_channel);
        $st->bindParam(':content', $content);
        $st->bindParam(':thumbs_up', $thumbs_up);
        $st->bindParam('date', date( 'Y-m-d H:i:s',strtotime("now")));
        $st->execute();
    }

    //stvaranje novog kanala imena $name od strane korisnika s id-em pospremljenim u SESSION['id_user'] (trenutno ulogirani)
    public function createNewChannel( $name ){
        $db = DB::getConnection();
        $st = $db->prepare( "INSERT INTO dz2_channels (id, id_user, name) VALUES (NULL, :id_user, :name)" );
        $st->bindParam(':id_user', $_SESSION['id_user']);
        $st->bindParam(':name', $name);
        $st->execute();
    }

    //popis svih poruka unutar pripadnog kanala
    public function getMessagesFromChannel( $name ){
        $messages = [];
        $db = DB::getConnection();
        $st = $db->prepare('SELECT id FROM dz2_channels WHERE name=:name');
        $st->execute( ['name' => $name] );
        $id_channel = $st->fetch()['id']; //ovo je sad string, treba li cast u int? sad radi, ali ako ne bude, siti se tog!
        $st = $db->prepare( 'SELECT * FROM dz2_messages WHERE id_channel=:id_channel ORDER BY date' );
        $st->execute( ['id_channel' => $id_channel] );

        while( $row = $st->fetch() ){
            $messages[] = new Message( $row['id'], $row['id_user'], $row['id_channel'], $row['content'], $row['thumbs_up'], $row['date'] );
        }
        return $messages;
    }

    //popis svih poruka koje je korisnik s id-jem pospremljenim u $_SESSION['id_user'] objavio u bilo kojem kanalu
    public function getMessagesByUser(){
        $messages = [];
        $db = DB::getConnection();
        $st = $db->prepare( 'SELECT * FROM dz2_messages WHERE id_user=:id_user ORDER BY date DESC' );
        $st->execute( ['id_user' => $_SESSION['id_user']] );

        while( $row = $st->fetch() ){
            $messages[] = new Message( $row['id'], $row['id_user'], $row['id_channel'], $row['content'], $row['thumbs_up'], $row['date'] );
        }
        return $messages;
    }

    //funkcija koja provjerava je li user imena $username s lozinkom $password u bazi
    public function isUserInBase( $username, $password ){
        $db = DB::getConnection();
        try{
            $st = $db->prepare( 'SELECT password_hash FROM dz2_users WHERE username=:username' );
            $st->execute( ['username' => $username] );
        }catch( PDOException $e ){echo $e->getMessage();}
        $row = $st->fetch();
        if( $row === false ){
            return false;
        }
        else{
            $hash = $row['password_hash'];
            if( password_verify( $_POST['password'], $hash ) ){
                return true;
            }
            else return false;
        }

    }
/*
    public function isChannelInBase( $name ){
        $db = DB::getConnection();
        try{
            $st = $db->prepare( 'SELECT * FROM dz2_channels WHERE name=:name' );
            $st->execute( ['name' => $name] );
        }catch( PDOException $e ){echo $e->getMessage();}
        $row = $st->fetch();
        if( $row === false ){
            //channel ne postoji
            return false;
        }
        else return true;
    }
*/
    //funkcija koja provjerava postoji li kanal u bazi na temelju $id-a kanala
    public function isChannelInBase( $id ){
        $db = DB::getConnection();
        try{
            $st = $db->prepare( 'SELECT * FROM dz2_channels WHERE id=:id' );
            $st->execute( ['id' => $id] );
        }catch( PDOException $e ){echo $e->getMessage();}
        $row = $st->fetch();
        if( $row === false ){
            return false;
        }
        else return true;
    }

    //funkcija koja provjerava postoji li poruka u bazi na temelju $id-a poruke
    public function isMessageInBase( $id ){
        $db = DB::getConnection();
        try{
            $st = $db->prepare( 'SELECT * FROM dz2_messages WHERE id=:id' );
            $st->execute( ['id' => $id] );
        }catch( PDOException $e ){echo $e->getMessage();}
        $row = $st->fetch();
        if( $row === false ){
            //channel ne postoji
            return false;
        }
        else return true;
    }

    //funkcija koja postavlja $_SESSION
    public function setUserId( $username ){
        $db = DB::getConnection();
        $st = $db->prepare( 'SELECT id FROM dz2_users WHERE username=:username' );
        $st->execute( ['username' => $username] );
        $id_user = $st->fetch()['id'];
        $_SESSION['id_user'] = $id_user; 
    }

    //funkcija koja vraća username korisnika na temelju njegovog $id-a
    public function getUserUsername( $id ){
        $db = DB::getConnection();
        $st = $db->prepare( 'SELECT username FROM dz2_users WHERE id=:id' );
        $st->execute( ['id' => $id] );
        $username = $st->fetch()['username'];
        return $username;
    }

    //funkcija koja vraća ime kanala na temelju njegovog $id-a
    public function getChannelName( $id ){
        $db = DB::getConnection();
        $st = $db->prepare( 'SELECT name FROM dz2_channels WHERE id=:id' );
        $st->execute( ['id' => $id] );
        $name = $st->fetch()['name'];
        return $name;
    }

    //funkcija koja vraća broj palaca gore poruke čiji je id $id
    public function getMessageThumbsUp( $id ){
        $db = DB::getConnection();
        $st = $db->prepare( 'SELECT thumbs_up FROM dz2_messages WHERE id=:id' );
        $st->execute( ['id' => $id] );
        $thumbs_up = $st->fetch()['thumbs_up'];
        return $thumbs_up;
    }

    //funkcija koja update-a broj palaca gore poruci čiji je id $id
    public function updateMessageThumbsUp( $thumbs_up, $id ){
        $db = DB::getConnection();
        $st = $db->prepare( 'UPDATE dz2_messages SET thumbs_up=:thumbs_up WHERE id=:id' );
        $st->execute( ['thumbs_up' => $thumbs_up, 'id' => $id] );
    }

}
?>