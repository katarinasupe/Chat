<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Login</title>
    <style>

    body {
        text-align: center;
    }
    form {
        display: inline-block;
        background-color: white;
    }
    input[type=text], input[type=password] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #FA7268;
        box-sizing: border-box;
    }
    button {
        background-color: #FA7268;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        font-family: Verdana, Geneva, sans-serif;
    }
    button:hover {
        background-color: #aaf0d1;
        color: #FA7268;
    }
    .container {
        padding: 16px;
        color: #FA7268;
    }
    .header {
        padding: 16px;
        text-align: center;
        background:#aaf0d1;
        color: #FA7268;
        font-family: Verdana, Geneva, sans-serif;
    }
    </style>
</head>
<body>
<form action="chat.php?rt=users/handleLogin" method="post">
    <div class="container">
        <span style="font-size: 25px;">Chat</span>
        <br>
        <input type="text" placeholder="Enter Username" name="username" required>
        <br>
        <input type="password" placeholder="Enter Password" name="password" required>
        <br>
        <button type="submit">Login</button>
    </div>
</form> 
</body>
</html>
