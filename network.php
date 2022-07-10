<?php
session_start();
//$name = $_POST['name']; // Assigning post variable 'name.' to login

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['usrname'])) {
header('Location: index.php');
}
?>
<?php include('navbar.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>ServerSage</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/modal.css'>

    <script src='main.js'></script>
</head>
<body>

<div class="grrid">
  <div>
  <p style="  text-align: center  " class="gridheader">
   Port / Protocol | Status | Service
<br>
    <?php
    $nmap = [];
    exec('nmap localhost | grep open ',$nmap);
    $i=count($nmap);

            while ($i > 0)
            {
                echo $nmap[$i] ."<br />";
                $i--;
            }
    ?>
    </p>

    </p>
  <p class="footer">Open ports</p>
  </div>
</div>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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

<div class="grrid">
  <div>
  <br>
<?php include('table.php'); ?>
<p class="tablefooter">Network Scan</p>

    </p>

    </p>
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
                  $sql = "SELECT * FROM currentiptable WHERE ip NOT IN (SELECT ip FROM knowiptable)";
            $result = $connection->query($sql);
      
                  if (!$result) {
              die("Invalid query: " . $connection->error);
            }
      
                  // read data of each row
            while($row = $result->fetch_assoc()) {
              include('unknowndevice.php');
              echo'<p class="tablefooter">Network Scan</p>';
            }
              ?>
  </div>
  <br>
  <br>
</div>
</body>
</html>
