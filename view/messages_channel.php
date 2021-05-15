<?php require_once __DIR__ . '/_header.php';?>
<body>
<h2><?php echo $title ;?></h2>
<br>

    <?php
        foreach( $messageList as $message ){?>
            <div class="messagecont">
            <span class="name"><?php echo $cs->getUserUsername($message->id_user); ?></span>
            <p><?php echo $message->content;?></p>
            <span class="time"><?php echo $message->date; ?></span>
            <form action="chat.php?rt=messages/thumbsUp&message_id=<?php echo $message->id ?>" method="post">
                    <button type='submit' name ='thumbs' value='thumbs'><i class="fa fa-thumbs-up"></i>
                    <sub><?php echo $message->thumbs_up; ?></sub>
                    </button>
            </form> 
            </div>
            <?php
            //<textarea id="message" rows="4" cols="50" name="message"></textarea>
            //
        }
    ?>

<form action="chat.php?rt=messages/createMessage" method="post">
<input type="text" placeholder="Write your message..." name="message" required>
<button type="submit">Send Message!</button>
</form>

<?php require_once __DIR__ . '/_footer.php';?>