<?php require_once __DIR__ . '/_header.php';?>
<body>
<h2><?php echo $title ;?></h2>
<br>

    <?php
        foreach( $messageList as $message ){?>
            <div class="messagecont">
            <?php echo $message->content;?>
            <br>
            <span class="timeleft"><?php echo $message->date;?></span>
            
            <span class="messagebtn">
            <form action="chat.php?rt=messages/channel&channel_id=<?php echo $message->id_channel?>" method="post">
                    <button type='submit' name ='btn' value='btn'><?php echo $cs->getChannelName($message->id_channel); ?></button>
                </form>   
                </span>
            </div>
<?php
        }

require_once __DIR__ . '/_footer.php';?>