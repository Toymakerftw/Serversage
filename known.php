<?php
    $ip = "";
    $mac = "";
    $hname = "";
    $ip = $_GET['ip']; // Assigning GET variable 'ip.'
    $mac = $_GET['mac']; // Assigning GET variable 'mac.'
    $hname = $_GET['hname']; // Assigning GET variable 'hname.'


    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $servername = "localhost";
    $username = "root";
    $password = "root@passwd";
    $dbname = "serversage";
    echo $ip;
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    if (!$conn) {
      die('Could not connect: ' . mysql_error());
    }
    $sql="INSERT INTO knowiptable (ip,mac,hname) VALUES ('$ip','$mac','$hname')";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
        die('Invalid query: ' . mysql_error());
    }
?>