<?php 
  session_start();
  //Check login 


    include "connect_database.php";
    $id = $_GET['id'];
    $sql = "update transection set transection_status = 'success' where sell_id = $id" ; 

    mysqli_query($conn,$sql);

    header('location: con_delivered.php');
?>
