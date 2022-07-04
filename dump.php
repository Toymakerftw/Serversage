<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $output = [];
    $ip = "";
    $ip = $_GET['ip']; // Assigning GET variable 'ip.'
    echo $ip;
    exec('sudo tcpdump -i wlo1 host 192.168.80.225 -c 5',$output);
    $i=count($output);
    while ($i >= 0)
    {
        echo $output[$i];
        $i--;
    }
?>