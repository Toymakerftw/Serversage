<?php
    $output = [];
    $ip = "";
    $ip = $_GET['ip']; // Assigning GET variable 'ip.'
    exec("bash scripts/dump.sh $ip 2>&1",$output);
    $i=count($output);
    if ($i >= 0) {
        header("Location: network.php");
        die();    }
    else {
        echo "failed";
    }
    /*while ($i >= 0)
    {
        echo $output[$i];
        $i--;
    }*/
?>
