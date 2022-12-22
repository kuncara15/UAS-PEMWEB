<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../controller.php";
    $sql = "SELECT * FROM admin WHERE username='$_POST[username]' AND password='" . md5($_POST['password']) . "'";
    if ($query = $connection->query($sql)) {
        if ($query->num_rows) {
            session_start();
            while ($data = $query->fetch_array()) {
              $_SESSION["admin"]["is_logged"] = true;
              $_SESSION["admin"]["username"] = $data["username"];
            }
            header('location: index.php');
        } else {
            echo alert("Username / Password tidak sesuai!", "login.php");
        }
    } else {
        echo "Query error!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SEPEDA</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
</head>
<body>
    <img class="wave" src="assets/img/wave.png">
    <div class="container">
        <div class="img">
            <img src="assets/img/bg.png" style="width: 100% !important; margin-right: 0;">
        </div>
        <div class="login-content">
            <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
                <img src="assets/img/avatar.png">
                <h2 class="title">ADMINISTRATOR</h2>
                <div class="input-div one">
                   <div class="i">
                        <i class="fas fa-user"></i>
                   </div>
                   <div class="div">
                        <label for="username"><h5></h5></label>
                        <input type="text" name="username" class="input" id="username" placeholder="username" autofocus="on">
                   </div>
                </div>
                <div class="input-div pass">
                   <div class="i"> 
                        <i class="fas fa-lock"></i>
                   </div>
                   <div class="div">
                        <label for="password"><h5></h5></label>
                         <input type="password" name="password" class="input" id="password" placeholder="Password">
                   </div>
                </div>
                <input type="submit" class="btn" value="Login">
            </form>      
        </div>
    </div>
    <script type="text/javascript" src="assetsjs/main.js"></script>
</body>
</html>
