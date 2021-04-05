<meta charset="UTF-8">


<?php
    session_start();
    //Check login 
    if (!isset($_SESSION["_role"])) {
        echo '<script language="javascript">';
        echo "alert('กรุณาเข้าสู่ระบบ')";  //not showing an alert box.
        echo '</script>';
        
        echo '<script language="javascript">';
        echo "window.location.href = 'index.php';";
        echo '</script>';
    }else if($_SESSION["_role"] == "Admin"){
        echo '<script language="javascript">';
        echo "window.location.href = 'Admin';";
        echo '</script>';
    }
//1. เชื่อมต่อ database: 
	include('connect_database.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
	if(isset($_POST["Upload"])){
		$sell_id = $_POST['selected_sell_id'];
		//*** Read file BINARY ***'
		$fp = fopen($_FILES["slipImage"]["tmp_name"],"r");
		$ReadBinary = fread($fp,filesize($_FILES["slipImage"]["tmp_name"]));
		fclose($fp);
		$FileData_pic = addslashes($ReadBinary);

		//*** Insert Record ***//
		$sql = "UPDATE transection SET transection_slip =  '$FileData_pic' , transection_status ='payment' WHERE sell_id = '$sell_id'";
		$result = mysqli_query($conn, $sql);
		

		mysqli_close($conn);
		// javascript แสดงการ upload file
		
		if($result){
		echo "<script type='text/javascript'>";
		echo "alert('Upload File Succesfuly');";
		echo "window.location = 'form_add_slip.php'; ";
		echo "</script>";
		}
		else{
		echo "<script type='text/javascript'>";
		echo "alert('.$sell_id.');";
		echo "</script>";
		}
	}
?>