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
$sql1 = "SELECT COUNT(*) FROM knowiptable";
$result = $connection->query($sql);
$result1 = $connection->query($sql1);

$row = mysqli_fetch_row($result);
$row1 = mysqli_fetch_row($result1);

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
    <link rel='stylesheet' type='text/css' media='screen' href='css/modal.css'>

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
 <div id="subgrid" class="subgrid">
  <p>
  <?php
    //echo'<p class="sheader">Currently logged in as : ', $_SESSION['usrname'],'</p>';
    echo'<p class="sheader">Currently logged in as : ','<span style="color: black">',$_SESSION['usrname'],'</span>','</p>';
    ?>
    </p>
  </div>
</div>

<div id="grid" class="grid">
 <div id="subgrid" class="subgrid">
  <p id="cpu_temp" class="gridheader">
    <?php
    echo $temp ;
    //echo $_SESSION['usrname'];
    ?>
    </p>
  <p class="footer">Cpu Temprature</p>
  <div id="footerbutton" class="footerbutton">
  <button class="modal-button" href="#myModal1">Show Graph</button>
  </div>

  </div>
 <div id="subgrid" class="subgrid">
  <p  id="cpu_load" class="gridheader">
    <?php
    echo "$load\n";
    ?>
    </p>
    <p class="footer">CPU Usage</p>
    <div id="footerbutton" class="footerbutton">
    <button class="modal-button" href="#myModal2">Show Graph</button>
    </div> 
    </div>

 <div id="subgrid" class="subgrid">
  <p id="mem_usd"  class="gridheader"></p>
  <p id="mem_tlt" class="gridheader2"></p>
  <p class="footer">Memory Usage</p>
  </div>
 <div id="subgrid" class="subgrid">
  <p  class="gridheader">
    <?php
    echo $up;
    ?>
    </p>
    <p class="footer">System Uptime</p>
  </div>
 <div id="subgrid" class="subgrid">
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
   <div id="subgrid" class="subgrid">
    <p  class="gridheader">
    <?php
    echo "$net[0]\n";
    echo "$net[1]\n";
    ?>
    </p>
    <p class="footer">Network Speed</p>
    </div>
 <div id="subgrid" class="subgrid">
  <p  class="gridheader">
    <?php
    echo $os ;
    ?>
    </p>
    <p class="footer">Operating System</p>
  </div>
 <div id="subgrid" class="subgrid">
  <p  class="gridheader">
    <?php
    echo $pro;
    ?>
    </p>
    <p class="footer">Cpu</p>
  </div>
 <div id="subgrid" class="subgrid">
  <p  class="gridheader">
    <?php
    echo $row[0];
    ?>
    </p>
    <?php if ($row[0] == 1) 
    {
      echo "<p class='footer'>Connected Device</p>";
    }
    else 
    {
      echo "<p class='footer'>Connected Devices</p>";
    }?>
    <div id="footerbutton" class="footerbutton">
    <button class="modal-button" href="#myModal3">Show More</button>
    </div>
    </div>
</div>
</div>

<!-- The CPU TEMP Modal -->
<div id="myModal1" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
      <span class="close">×</span>
    <div class="modal-body">
      <p>Some text in the Modal 1</p>
      <p>Some other text...</p>
    </div>
  </div>
</div>

<!-- The CPU USAGE Modal -->
<div id="myModal2" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
      <span class="close">×</span>
    <div class="modal-body">
      <p>Some text in the Modal 2</p>
      <p>Some other text...</p>
    </div>
  </div>

</div>

<!-- The Connected Devices Modal -->
<div id="myModal3" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <?php 
        $ukndev=($row[0] - $row1[0]);

    echo '
    <div id="gridModal" class="gridModal">  
   <div id="subgrid" class="subgrid">
    <p  class="gridheader">';
    echo $ukndev ;
    echo '  
    </p>';
    if ($ukndev[0] == 1) 
    {
      echo '<p class="footer">Unknown Device</p>';
    }
    else 
    {
      echo '<p class="footer">Unknown Devices</p>';
    }
    echo '</div>';

    echo '  
   <div id="subgrid" class="subgrid">
    <p  class="gridheader">';
    echo $row1[0] ;
    echo '  
    </p>';
    if ($row1[0] == 1) 
    {
      echo '<p class="footer">Known Device</p>';
    }
    else 
    {
      echo '<p class="footer">Known Devices</p>';
    }
    echo '</div> </div>';
    ?>
  </div>
</div>

<script>

// Get the modal
// Get the button that opens the modal
var btn = document.querySelectorAll("button.modal-button");

// All page modals
var modals = document.querySelectorAll('.modal');

// Get the <span> element that closes the modal
var spans = document.getElementsByClassName("close");

// When the user clicks the button, open the modal
for (var i = 0; i < btn.length; i++) {
 btn[i].onclick = function(e) {
    e.preventDefault();
    modal = document.querySelector(e.target.getAttribute("href"));
    modal.style.display = "block";
 }
}

// When the user clicks on <span> (x), close the modal
for (var i = 0; i < spans.length; i++) {
 spans[i].onclick = function() {
    for (var index in modals) {
      if (typeof modals[index].style !== 'undefined') modals[index].style.display = "none";    
    }
 }
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
     for (var index in modals) {
      if (typeof modals[index].style !== 'undefined') modals[index].style.display = "none";    
     }
    }
}

</script>
</body>
</html>
