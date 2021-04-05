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
    include('connect_database.php');

    $id = $_GET['sell_id'];
    $sql = "UPDATE transection set transection_status = 'cancel' WHERE sell_id = '$id' ";
    
    $result = $conn->query($sql);


    if($result){
        echo '<script>';
        echo 'alert("ยกเลิกคำสั่งซื้อสำเร็จ");';
        echo 'window.history.back()';
        echo '</script>';
    }else{
        echo '<script>';
        echo 'alert("ยกเลิกคำสั่งซื้อ ไม่สำเร็จ");';
        echo 'window.history.back()';
        echo '</script>';
    }

?>