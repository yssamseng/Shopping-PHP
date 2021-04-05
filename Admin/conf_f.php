<?php 
  session_start();
  //Check login 
  if(!isset($_SESSION["_role"]) && isset($_SESSION["_role"]) != "Admin"){
      header("location: ../index.php");
  }else if($_SESSION["_role"] == "User"){
    echo '<script language="javascript">';
    echo "window.location.href = '../index.php';";
    echo '</script>';
}
?>
<?php
include "connect_database.php";
$id = $_GET['id'];
$sql = "update transection set transection_status = 'cancel' where sell_id = $id" ; 

mysqli_query($conn,$sql);


header('location:conf_order.php');
?>
