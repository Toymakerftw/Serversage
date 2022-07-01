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

<div class="grrid">
  <div>
  <p style="  text-align: center  " class="gridheader">
   Connected Devices
<br>
<?php 
$ip = exec('bash scripts/ip.sh');
exec('nmap -sP "$ip" | grep -o "$ip"',$output);
$n=count($output);
$k=$n-1;
echo '<div style="text-align: right;">Number of PC(s)';echo '<h1>';echo $k; echo '</h1>';echo '</div>'; 
echo '<div class="CSSTableGenerator" ><table style="text-align: center; width: 451px; height: 172px;" border="1"
cellpadding="2" cellspacing="2"   margin-left: auto; margin-right: auto; <tr><td>active ip address</td></tr>';
for ($i=0;$i<=$n;$i++)
{
echo  "<tr><td>";
print $output[$i];

echo "</td></tr>";
}
echo "</div></table></body></html>";
?>
    </p>

    </p>
    <p class="footer">Network Scan</p>
  </div>
</div>
</body>
</html>
