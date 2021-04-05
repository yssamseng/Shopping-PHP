<?php

$servername = "127.0.0.1";
$username = "root";
$pass = "";
$dbname = "sellbook";

$conn = new mysqli($servername,$username,$pass,$dbname);

mysqli_query($conn,"SET NAMES UTF8");


?>