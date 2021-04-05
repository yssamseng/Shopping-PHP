<head>
	<meta charset="UTF-8">
</head>
<?php
session_start();
date_default_timezone_set("Asia/Bangkok");
if ($_POST['password'] != $_POST['repassword'])
	echo "<script>alert('ยืนยันรหัสผ่านผิด กรุณาลองใหม่อีกครั้ง');window.open('form_register.php','_self');</script>";

require 'connect_database.php';
$sql = "select * FROM account where username='" . $_POST['username'] . "'";
$test = mysqli_query($conn, $sql);
$numrow = mysqli_num_rows($test);
if ($numrow > 0)
	echo "<script>alert('ชื่อผู้ใช้ซ้ำ กรุณาใช้ชื่ออื่น');window.open('form_register.php','_self');</script>";
	
if (isset($_POST['done'])) {
	$uname = $_POST['username'];
	$pwd = $_POST['password'];
	$tel = $_POST['tel'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$address = $_POST['address'];
	$q = " INSERT INTO account(username, password, account_fname, account_lname,
                    account_address, account_phone, account_role) 
VALUES ('$uname','$pwd','$fname','$lname','$address','$tel','1')";

	$query = mysqli_query($conn, $q);

	$_SESSION["_role"] = "User";
	$_SESSION["_name"]= $uname;

	echo "<script>alert('สมัครสมาชิกสำเร็จ');window.open('index.php','_self');</script>";
}
?>