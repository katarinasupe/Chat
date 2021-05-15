<?php require_once __DIR__ . '/_header.php';?>
<body>
<h2><?php echo $message; ?></h2>
<form action="chat.php?rt=channels/createChannelResults" method="post">
    <input type="text" placeholder="Enter Channel Name" name="name" required>
    <br>
    <button type="submit">Create New Channel!</button>
</form> 
<br>
<?php require_once __DIR__ . '/_footer.php';?> 