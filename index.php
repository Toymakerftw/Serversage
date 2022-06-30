<?php
// Inialize session
session_start();

// Check, if user is already login, then jump to secured page
if (isset($_SESSION['usrname'])) {
header('Location: dashboard.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ServerSage Login</title>
    <link rel="stylesheet" href="css/login.css">
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
                    <a href="#">Forgotten password?</a>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
