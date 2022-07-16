<?php
    $output = [];
    $ip = "";
    $ip = $_GET['ip']; // Assigning GET variable 'ip.'
    exec("bash scripts/dump.sh $ip 2>&1",$output);
    $i=count($output);
    while ($i >= 0)
    {
        echo $output[$i];
        $i--;
    }
?>
