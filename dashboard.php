<?php
session_start();
//$name = $_POST['name']; // Assigning post variable 'name.' to login

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['usrname'])) {
header('Location: index.php');
}
$up = exec('bash scripts/uptime.sh');
$os = exec('lsb_release -ds');
$pro = exec('bash scripts/pro.sh');
//$net = [];
//  exec('bash net.sh', $net);
$net = [];
//exec('bash scripts/net.sh', $net);
?>
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
$result = $connection->query($sql);
$row = mysqli_fetch_row($result);

if (!$result) {
  die("Invalid query: " . $connection->error);
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
  <script>
  function get_data() {
  const xmlhttp = new XMLHttpRequest();
  xmlhttp.onload = function() {
    const myObj = JSON.parse(this.responseText);
    document.getElementById("cpu_load").innerHTML = myObj[0];
    document.getElementById("cpu_temp").innerHTML = myObj[1];
    document.getElementById("disk_usd").innerHTML = myObj[2];
    document.getElementById("disk_tlt").innerHTML = myObj[3];
    document.getElementById("mem_usd").innerHTML = myObj[4];
    document.getElementById("mem_tlt").innerHTML = myObj[5];
  }
  xmlhttp.open("GET", "datajson.php");
  xmlhttp.send();
}
get_data();
setInterval(get_data, 500);
  </script>


<div class="header">
  <div>
  <p>
  <?php
    //echo'<p class="sheader">Currently logged in as : ', $_SESSION['usrname'],'</p>';
    echo'<p class="sheader">Currently logged in as : ','<span style="color: black">',$_SESSION['usrname'],'</span>','</p>';
    ?>
    </p>
  </div>
</div>

<div id="grid" class="grid">
  <div>
  <p id="cpu_temp" class="gridheader">
    <?php
    echo $temp ;
    //echo $_SESSION['usrname'];
    ?>
    </p>
  <p class="footer">Cpu Temprature</p>
  </div>
  <div>
  <p  id="cpu_load" class="gridheader">
    <?php
    echo "$load\n";
    ?>
    </p>
    <p class="footer">CPU Usage</p>
    </div>

  <div>
  <p id="mem_usd"  class="gridheader"></p>
  <p id="mem_tlt" class="gridheader2"></p>
  <p class="footer">Memory Usage</p>
  </div>
  <div>
  <p  class="gridheader">
    <?php
    echo $up;
    ?>
    </p>
    <p class="footer">System Uptime</p>
  </div>
  <div>
  <p  id="disk_usd" class="gridheader">
  <p   class="gridsubheader"> Used of</p>
  <p  id="disk_tlt" class="gridheader2">
    <?php
    echo "$disk_used\n";
    echo "of \n";
    echo "$disk_total\n";
    ?>
    </p>
    <p class="footer">Disk Usage</p>
    </div>
    <div>
    <p  class="gridheader">
    <?php
    echo "$net[0]\n";
    echo "$net[1]\n";
    ?>
    </p>
    <p class="footer">Network Speed</p>
    </div>
  <div>
  <p  class="gridheader">
    <?php
    echo $os ;
    ?>
    </p>
    <p class="footer">Operating System</p>
  </div>
  <div>
  <p  class="gridheader">
    <?php
    echo $pro;
    ?>
    </p>
    <p class="footer">Cpu</p>
  </div>
  <div>
  <p  class="gridheader">
    <?php
    echo $row[0];
    ?>
    </p>
    <?php if ($row[0] = "1") 
    {
      echo '<p class="footer">Connected Device</p>';
    }
    else 
    {
      echo '<p class="footer">Connected Devices</p>';
    }?>
    </div>
</div>
</body>
</html>
