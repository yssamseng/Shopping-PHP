<head>
    <meta charset="UTF-8">
</head>
<?php
	
	date_default_timezone_set("Asia/Bangkok");
	require 'connect_database.php';
	session_start();

	$login = $_POST["Username"];
	$pwd = $_POST["Password"];

	$sql = "select * FROM account where username='".$login."' and password='".$pwd."' ";

	$result = mysqli_query($conn, $sql);
	$numrow = mysqli_num_rows($result);

	if ($numrow > 0)
	{ 
	  $row = mysqli_fetch_array($result);
	  $_SESSION["_name"]=$row['username'];
	  
	  if ($row['account_role'] == '1'){
		$_SESSION["_role"] = "User";
	  	echo "<script>alert('user');window.open('index.php','_self');</script>";
		header("location: index.php");
	  }
	  else{
		$_SESSION["_role"] = "Admin";
		echo "<script>alert('admin');window.open('index.php','_self');</script>";
		header("location: Admin/index.php");
      }
	}
	else	
	{
		echo "<script>alert('รหัสบัญชี หรือรหัสผ่านผิด กรุณาลองใหม่อีกครั้ง');window.open('index.php','_self');</script>";
	}

 ?>