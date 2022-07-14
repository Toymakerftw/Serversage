<?php
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
$ip = [];
$mac = [];
$hostname = [];
exec('bash scripts/arpip.sh',$ip);
exec('bash scripts/arpmac.sh',$mac);
exec('bash scripts/arphname.sh',$hostname);
$k=count($ip);
$n=$k-1;
$sql1="TRUNCATE TABLE currentiptable";
mysqli_query($conn,$sql1);
for($i = 0; $i<=$n; $i++) {
    $sql="INSERT INTO currentiptable (ip,mac,hname) VALUES ('".$ip[$i]."','".$mac[$i]."','".$hostname[$i]."')";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
     die('Invalid query: ' . mysql_error());
    }
}
?>
