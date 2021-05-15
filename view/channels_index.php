<?php require_once __DIR__ . '/_header.php';?>
<body>
<h2><?php echo $title ;?></h2>
<br>
    <?php
    if(empty($channelList)){?>
    <span style="color: #FA7268;"><p><?php echo 'User @' . $_SESSION['username'] . ' hasn`t created any channel.';?></p></span>
<?php
    }
        foreach( $channelList as $channel ){?>
            <div class="messagecont">
            <?php echo $channel->name;?>
            <span class="messagebtn">
            <form action="chat.php?rt=messages/channel&channel_id=<?php echo $channel->id;?>" method="post">
                <button type='submit' name ='btn' value='btn'>Messages</button>
            </form>
            </span>    
            </div>
<?php
        }

require_once __DIR__ . '/_footer.php';?>