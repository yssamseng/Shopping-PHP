<?php
session_start();
//Check login 
if (!isset($_SESSION["_role"]) && isset($_SESSION["_role"]) != "Admin") {
  header("location: ../index.php");
}else if($_SESSION["_role"] == "User"){
    echo '<script language="javascript">';
    echo "window.location.href = '../index.php';";
    echo '</script>';
}
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>จัดการโปรโมชั่น</title>
    <style>
    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #333;
    }

    li {
        float: left;
        border-right: 1px solid #bbb;
    }

    li:last-child {
        border-right: none;
    }

    li a {
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    li a:hover:not(.active) {
        background-color: #111;
    }

    .active {
        background-color: #4CAF50;
    }
    </style>


</head>

<body>

    <div class="p-2"></div>
        <ul>
            <li><a href="index.php">สต๊อกหนังสือ</a></li>
            <li><a href="conf_order.php">รายการคำสั่งซื้อ</a></li>
            <li><a href="pracel.php">รายการรอจัดส่ง</a></li>
            <li><a href="delivered.php">รายการจัดส่งแล้ว</a></li>
            <li><a href="success.php">คำสั่งซื้อเสร็จสิ้น</a></li>
            <li><a class="active" href="promo.php">จัดการโปรโมชั่น</a></li>
            <li><a href="sarup.php">สรุปยอดขาย</a></li>
            <li style="float:right"><a href="../logout.php">ออกจากระบบ</a></li>
        </ul>
    </div>


    <h1>จัดการโปรโมชั่น</h1>
    <?php

  include('connect_database.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี

  ?>
    <br />
    <form action="promo_add_file.php" method="post" enctype="multipart/form-data" name="upfile" id="upfile">
        <p>&nbsp;</p>
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
                <td height="40" colspan="2" align="center" bgcolor="#D6D6D6">Upload&nbsp;Promotion</td>
            </tr>
            <tr>
                <td width="126" bgcolor="#EDEDED">&nbsp;</td>
                <td width="574" bgcolor="#EDEDED">&nbsp;</td>
            </tr>
            <tr>
                <td align="center" bgcolor="#EDEDED">File Browser</td>
                <td bgcolor="#EDEDED"><label>
                        <input type="file" name="promotion" id="promotion" required="required" />
                    </label></td>
            </tr>
            <tr>
                <td bgcolor="#EDEDED">&nbsp;</td>
                <td bgcolor="#EDEDED">&nbsp;</td>
            </tr>
            <tr>
                <td bgcolor="#EDEDED">&nbsp;</td>
                <td bgcolor="#EDEDED"><input type="submit" name="Upload" id="button" value="Upload" /></td>
            </tr>
            <tr>
                <td bgcolor="#EDEDED">&nbsp;</td>
                <td bgcolor="#EDEDED">&nbsp;</td>
            </tr>
        </table>

        <hr>
        <h2>รายการรูปภาพที่แสดง</h2>
    </form>
    <?php
  $query = "SELECT * FROM promotion";

  $result = mysqli_query($conn, $query);



  while ($row = mysqli_fetch_array($result)) {

    echo '<center><td><img src="data:image;base64,' . base64_encode($row['promotion_pic']) . '" width="200"/></td>';
  ?>
    <td> <button class="btn-danger btn"> <a href="promo_delete.php?id= <?php echo $row['promotion_id']; ?>"
                onclick="return confirm('Are you sure you want to delete ?');" class="text-white">
                Delete </a> </button> </td><br>
    <?php
    echo "</tr></center>";
  }



  mysqli_close($conn);

  ?>
</body>

</html>