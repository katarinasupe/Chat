<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>

    <style>
        .topnav {
            background-color: #FA7268;
            overflow: hidden;
        }
        .topnav a {
            float: left;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }
        .topnav a:hover {
            background-color: white;
            color: #FA7268;
        }
        h2{
            color:#FA7268;
        }
        table, tr, td{
            border-collapse: collapse;
            color:#FA7268;
        }
        button {
            background-color: #FA7268; 
            border: none;
            color: white;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }
        button:hover {
            background-color: #aaf0d1;
            color: #FA7268;
        }
        input[type=text]{
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #FA7268;
            box-sizing: border-box;
        }
        .messagecont {
            border: 2px solid #dedede;
            background-color: #f1f1f1;
            border-radius: 5px;
            padding: 10px;
            margin: 10px 0;
            color: #FA7268;
        }
        .time {
            float: right;
            color: #aaa;
        }
        .timeleft {
            float: left;
            color: #aaa;
        }
        .name{
            color: #FA7268;
            font-weight: bold;
        }
        .messagecont::after {
            content: "";
            clear: both;
            display: table;
        }
        .messagebtn{
            float: right;
        }
    </style>
</head>
    <div class="topnav">
        <span 
            style="float: right; color: white; text-align: center;padding: 14px 16px;text-decoration: none;font-size: 17px;">
            Chat @<?php echo $_SESSION['username']; ?>
        </span>
        <a href="chat.php?rt=channels/index">My Channels</a>
        <a href="chat.php?rt=channels/allChannels">All Channels</a>
        <a href="chat.php?rt=channels/createChannel">Create New Channel</a>
        <a href="chat.php?rt=messages/index">My Messages</a>
        <a href="chat.php?rt=users/logout">Logout</a>
    </div> 
