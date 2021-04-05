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
<meta charset="UTF-8">
<?php
	//1. เชื่อมต่อ database: 
	include('../connect_database.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี

	if(isset($_POST["Upload"])){
		//$promotion_name = $_POST["promotion_name"]; //ตัดชื่อออก
		//*** Read file BINARY ***'
		$fp = fopen($_FILES["promotion"]["tmp_name"],"r");
		$ReadBinary = fread($fp,filesize($_FILES["promotion"]["tmp_name"]));
		fclose($fp);
		$FileData_pic = addslashes($ReadBinary);

		//*** Insert Record ***//
		$sql = "INSERT INTO promotion (promotion_pic,promotion_name) VALUES ('$FileData_pic','$promotion_name')";
		
		$result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
		
		mysqli_close($conn);
		// javascript แสดงการ upload file
		
		if($result){
		echo "<script type='text/javascript'>";
		echo "alert('Upload File Succesfuly');";
		echo "window.location = 'promo.php'; ";
		echo "</script>";
		}
		else{
		echo "<script type='text/javascript'>";
		echo "alert('Error back to upload again');";
		echo "</script>";
		}
}
?>