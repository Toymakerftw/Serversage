<?php
    $ip = "";
    $ip = $_GET['ip']; // Assigning GET variable 'ip.'

    //ini_set('display_errors', 1);
    //ini_set('display_startup_errors', 1);
    //error_reporting(E_ALL);
    $servername = "localhost";
    $username = "root";
    $password = "root@passwd";
    $dbname = "serversage";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    if (!$conn) {
      die('Could not connect: ' . mysql_error());
    }
    $sql="DELETE FROM knowiptable WHERE ip='$ip'";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
        die('Invalid query: ' . mysql_error());
    }
    else {
      header("Location:network.php");
    }
?>