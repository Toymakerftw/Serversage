<?php
$servername = "localhost";
$username = "root";
$password = "root@passwd";
$database = "serversage";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
}
// read all row from database table
$sql = "SELECT COUNT(*) FROM currentiptable";
$sql1 = "SELECT COUNT(*) FROM knowiptable";
$sql2 = "SELECT COUNT(*) FROM currentiptable WHERE ip IN (SELECT ip FROM knowiptable);";
$sql3 = "SELECT COUNT(*) FROM knowiptable WHERE ip NOT IN (SELECT ip FROM currentiptable);";


$result = $connection->query($sql);
$result1 = $connection->query($sql1);
$result2 = $connection->query($sql2);
$result3 = $connection->query($sql3);


$row = mysqli_fetch_row($result);
$row1 = mysqli_fetch_row($result1);
$row2 = mysqli_fetch_row($result2);
$row3 = mysqli_fetch_row($result3);
$ukndev = ($row[0] - $row1[0]); 


if (!$result) {
  die("Invalid query: " . $connection->error);
}

if ($row[0]!=$row1[0]) {
// Bot Stuff
include('botconfig.php');
exec("bash telegram -t $token -c $chatid 'Network Scan Initiated ...'");
exec("bash telegram -t $token -c $chatid '$row[0] Device Connected'");
exec("bash telegram -t $token -c $chatid '$row1[0] Known Device'");
exec("bash telegram -t $token -c $chatid '$ukndev Unknown Device'");
}
/*
botconfig.php 
<?php
$chatid = "";
$token = "";
?>
*/

?>