<?php
// Execute Bash scripts and save values to variables
$cpu = exec('bash scripts/cpu.sh');
$temp = exec('bash scripts/temp.sh');
$disk = [];
exec('bash scripts/disk.sh', $disk);
$mem = [];
exec('bash scripts/mem.sh', $mem);

// Get current time
date_default_timezone_set("Asia/Kolkata");
$time = date("G:i:s");
$date = date("M/d/Y");

$servername = "localhost";
$username = "root";
$password = "root@passwd";
$dbname = "serversage";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "insert into stats (cpu_load,cpu_temp,disk_used,disk_total,memory_used,memory_total,date,time) values ('$cpu','$temp','$disk[0]','$disk[1]','$mem[0]','$mem[1]','$date','$time')";
 if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
