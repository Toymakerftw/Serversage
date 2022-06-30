<?php
  $mysqli = new mysqli("localhost","root","root@passwd","serversage");

  if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
  }

  $sql = "select cpu_load, cpu_temp, disk_used, disk_total, memory_used, memory_total, date, time from stats WHERE id=( SELECT max(id) FROM stats )";

  if ($result = $mysqli -> query($sql)) {
    while ($row = $result -> fetch_row()) {
        $myJSON = json_encode($row);
        echo $myJSON;
        }
        } else {
        echo "0 results";
  }

  $mysqli -> close();
?>
