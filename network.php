<?php
session_start();
//$name = $_POST['name']; // Assigning post variable 'name.' to login

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['usrname'])) {
header('Location: index.php');
}
?>

<?php 
//$net = [];
//exec('bash scripts/net.sh', $net);
include('currentip.php');
include('navbar.php');
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
$sql4 = "SELECT ip FROM currentiptable ORDER BY id DESC LIMIT 1;";
$sql5 = "SELECT ip FROM currentiptable WHERE ip IN (SELECT ip FROM knowiptable);";
$sql6 = "SELECT ip FROM knowiptable WHERE ip NOT IN (SELECT ip FROM currentiptable);";

$result = $connection->query($sql);
$result1 = $connection->query($sql1);
$result2 = $connection->query($sql2);
$result3 = $connection->query($sql3);
$result4 = $connection->query($sql4);
$result5 = $connection->query($sql5);
$result6 = $connection->query($sql6);


$row = mysqli_fetch_row($result);
$row1 = mysqli_fetch_row($result1);
$row2 = mysqli_fetch_row($result2);
$row3 = mysqli_fetch_row($result3);
$row4 = mysqli_fetch_row($result4);
$row5 = mysqli_fetch_row($result5);
$row6 = mysqli_fetch_row($result6);


if (!$result) {
  die("Invalid query: " . $connection->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/network.css">
    <link rel="stylesheet" href="css/modal.css">

    <title>Document</title>
</head>
<body>
  <div class="item box-big">
  <p class="grid-item">NETWORK</p>
  </div>
  <div class="container">
  <div class="item box-big1">
    <?php
    $nmap = [];
    exec('nmap localhost | grep open ',$nmap);
    $i=count($nmap);

            while ($i >= 0)
            {
                echo $nmap[$i] ."<br />";
                $i--;
            }
    ?>
    <p class="footer">Open Port</p>
  </div>
  <div class="item">
  <?php if ($row[0] == 1) 
    {
      echo '<button class="modal-button" href="#myModal1" >';
      echo $row[0];
      echo ' Connected Device';
      echo '</button>';
      //echo "<p>";
      //echo $row[0];
      //echo "<span style='font-size: 1.5rem' 'text-align: center'> Connected Device</span></p>";
    }
    else 
    {
      echo '<button class="modal-button" href="#myModal1" >';
      echo $row[0];
      echo ' Connected Devices';
      echo '</button>';
      //echo "<p>";
      //echo $row[0];
      //echo "<span style='font-size: 1.5rem' 'text-align: center'> Connected Devices</span></p>";
    }
    ?>
  </div>
  <div class="item">
  <?php if ($row[0] == 1) 
    {
      //echo "<p>";
      //echo $row1[0];
      //echo "<span style='font-size: 1.5rem' 'text-align: center'> Known Device</span></p>";
      echo '<button class="modal-button" href="#myModal2" >';
      echo $row1[0];
      echo ' Known Device';
      echo '</button>';
    }
    else 
    {
      echo '<button class="modal-button" href="#myModal2" >';
      echo $row1[0];
      echo ' Known Devices';
      echo '</button>';
      //echo "<p>";
      //echo $row1[0];
      //echo "<span style='font-size: 1.5rem' 'text-align: center'> Known Devices</span></p>";
    }?>
  </div>
  <div class="itemD">
  <div class="online">
  <?php
    $od=$row2[0];
    if ($od == 1) 
    {
      echo '<button class="modal-button" href="#myModal4" >';
      echo $od;
      echo ' Device Online';
      echo '</button>';

      //echo "<p>";
      //echo $od;
      //echo "<span style='font-size: 1.5rem' 'text-align: center'> Device Online</span></p>";
    }
    else 
    {
      echo '<button class="modal-button" href="#myModal4" >';
      echo $od;
      echo ' Devices Online';
      echo '</button>';

      //echo "<p>";
      //echo $od;
      //echo "<span style='font-size: 1.5rem' 'text-align: center'> Devices Online</span></p>";
    }
  ?>
  </div>
  <div class="offline">
  <?php
    $ofd=$row3[0];
    if ($ofd == 1) 
    {
      echo '<button class="modal-button" href="#myModal5" >';
      echo $ofd;
      echo ' Device Offline';
      echo '</button>';

      //echo "<p>";
      //echo $ofd;
      //echo "<span style='font-size: 1.5rem' 'text-align: center'> Device Offline</span></p>";
    }
    else 
    {
      echo '<button class="modal-button" href="#myModal5" >';
      echo $ofd;
      echo ' Devices Offline ';
      echo '</button>';
      //echo "<p>";
      //echo $ofd;
      //echo "<span style='font-size: 1.5rem' 'text-align: center'> Devices Offline</span></p>";
    }
    ?>
  </div>
  </div>
  <div class="item">
  <?php
      $ukndev=($row[0] - $row1[0]);
      ?>
    </p>
    <?php if ($ukndev == 1) 
    {
      echo '<button class="modal-button" href="#myModal3" >';
      echo $ukndev;
      echo ' Unknown Device';
      echo '</button>';

      //echo "<p>";
      //echo $ukndev;
      //echo "<span style='font-size: 1.5rem' 'text-align: center'> Unknown Device</span></p>";
    }
    else 
    {
      echo '<button class="modal-button" href="#myModal3" >';
      echo $ukndev;
      echo ' Unknown Device';
      echo '</button>';
      //echo "<p>";
      //echo $ukndev;
      //echo "<span style='font-size: 1.5rem' 'text-align: center'> Unknown Devices</span></p>";
    }?>
  </div>
  <div class="item box-big2">
    <div class="ip">
    <?php
    echo "<p>";
    echo "$row4[0]\n";
    echo "</p>";
    ?>
    </div>
    <div class="text">
    <p> <span style='font-size: 1rem' 'text-align: center'> Latest Device On Network</span></p>
  </div>
  </div>
  <div class="item box-big3">
    <div>
    <p>Upload: 2 Mbps</p>
    </div>
    <div>
    <p> Download: 5 Mbps</p>
    </div>
  </div>
  <div class="item">
    <?php
    echo '<a class="hyperlink" href="http://localhost/dump/dump.pcap">';
    echo ' Download Network Dump ';
    echo '</a>';
    ?>
  </div>
</div>


<!-- Modal -->
<div id="myModal1" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
      <span class="close">×</span>
    <div class="modal-body">
    <p style="text-align: center" class="gridtableheader"> Connected Devices</p>
    <br>
    <table style="  text-align: center  "class="table">
        <thead>
			<tr>
				<th>Hostname</th>
				<th>IP Address</th>
				<th>Mac Address</th>
			</tr>
		</thead>

        <tbody>
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
			$sql = "SELECT * FROM currentiptable";
			$result = $connection->query($sql);

            if (!$result) {
				die("Invalid query: " . $connection->error);
			}

            // read data of each row
			while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . $row["hname"] . "</td>
                    <td>" . $row["ip"] . "</td>
                    <td>" . $row["mac"] . "</td>
                </tr>";
            }

            $connection->close();
            ?>
        </tbody>
    </table>
    </div>
  </div>
</div>

<!-- The CPU TEMP Modal -->
<div id="myModal2" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
      <span class="close">×</span>
    <div class="modal-body">
    <p style="  text-align: center  " class="gridtableheader"> Known Devices</p>
    <br>
    <table style="  text-align: center  "class="table">
        <thead>
			<tr>
				<th>Hostname</th>
				<th>IP Address</th>
				<th>Mac Address</th>
        <th>Action</th>
			</tr>
		</thead>

        <tbody>
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
			$sql = "SELECT * FROM knowiptable";
			$result = $connection->query($sql);

            if (!$result) {
				die("Invalid query: " . $connection->error);
			}

            // read data of each row
			while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . $row["hname"] . "</td>
                    <td>" . $row["ip"] . "</td>
                    <td>" . $row["mac"] . "</td>
                    <td>
                    <a class='btn btn-danger btn-sm' id='myBtn' href='delete.php?ip=$row[ip]'>Remove</a>
                    </td>
                </tr>";
            }

            $connection->close();
            ?>
        </tbody>
    </table>
    </div>
  </div>
</div>
    
<!-- The CPU TEMP Modal -->
<div id="myModal3" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
      <span class="close">×</span>
    <div class="modal-body">
    <p style="  text-align: center  " class="gridtableheader"> Unknown Devices</p>
    <br>
    <table style="  text-align: center  "class="table">
        <thead>
			<tr>
				<th>Hostname</th>
				<th>IP Address</th>
				<th>Mac Address</th>
				<th>Action</th>
			</tr>
		</thead>

        <tbody>
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
                echo "<tr>
                    <td>" . $row["hname"] . "</td>
                    <td>" . $row["ip"] . "</td>
                    <td>" . $row["mac"] . "</td>
                    <td>
                    <a class='btn btn-primary btn-sm' href='known.php?ip=$row[ip]&mac=$row[mac]&hname=$row[hname]'>Add as Known Device</a>
                    <a class='btn btn-danger btn-sm' id='myBtn' href='dump.php?ip=$row[ip]'>Monitor Traffic</a>
                    </td>
                </tr>";
            }


            $connection->close();
            ?>
        </tbody>
    </table>
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

<!-- The Connected Devices Modal -->
<div id="myModal4" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <?php
    $k=count($row5);
    $i=$k-1;
            while ($i >=0)
            {
                echo '<p>';
                echo $row5[$i];
                echo '<span style="color: green"> is Online</span></p>';
                $i--;
            }
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
