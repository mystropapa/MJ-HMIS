<?php
session_start();
require("vars.inc.php");

 // connecting to mysql
    $con = mysqli_connect($hst,$usr, $pwd,$dbname);
   
  if (!$con) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
  


   
require("func.inc.php");
?>