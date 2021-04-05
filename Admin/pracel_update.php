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

<!DOCTYPE html>
<html>
<head>
 <title></title>
 <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
</head>
<body>
	<center>
<h1 class="text-warning text-center" > Insert Pracel ID </h1>

 <br>
 <br>    
<?php 
 include "connect_database.php";
 $id=$_GET['id'];
 

?>
<form  method="POST">
 <table border="1">
 <tr>
    <th >หมายเลขติดตามพัสดุ</th>
    <td><input type="text" name="pracel_id" value="" required ></td>
    </tr>
  
  </table>
  <br>
  <button type="submit" name="done"> Submit </button><br>
</form>
<?php
if(isset($_POST['done'])){
	echo "chaichan zaza";
	$pracel_id = $_POST['pracel_id'];
	
	$sql="UPDATE transection set pracel_id = '$pracel_id', transection_status='delivered' where sell_id = $id";
	$query=mysqli_query($conn,$sql);
	
	header('location:pracel.php');
	
}

?><br><br>
<button class="btn"><a href="pracel.php">กลับไปหน้ารายการรอจัดส่ง</a></button> 
</center>
</body>
</html>
