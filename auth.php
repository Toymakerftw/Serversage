<?php
session_start();
$name = $_POST['name']; // Assigning post variable 'name.' to login
$pass = $_POST['pwd']; //Assigning post variable 'pwd' to password

$connection = ssh2_connect('localhost', 22);

if (ssh2_auth_password($connection, $name, $pass)) {
    $_SESSION['usrname'] = $_POST['name'];//saving session
    $_SESSION['pwd'] = $_POST['pwd'];//saving session - needed for terminal
    header('Location: dashboard.php');//redirecting to secure page
} else {
      echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Facebook-Login or Sign up</title>
        <link rel="stylesheet" href="css/test.css">
    </head>
    <body>
        <main>
            <div class="row">
                <div class="colm-form">
                    <div class="form-container">
                    <form name="form1" action="auth.php" onsubmit="return vmf();" method="post">
                        <input type="text" name="name" placeholder="Username">
                        <input type="password" name="pwd" placeholder="Password">
                        <button class="btn-login">Login</button>
                        <a href="#">Authentication Failed ! Check Username and Password.</a>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </body>
    </html>';
}
?>
