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

<!DOCTYPE html>
<html>

<head>
    <title>รายการรอจัดส่ง</title>
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
            <li><a class="active" href="pracel.php">รายการรอจัดส่ง</a></li>
            <li><a href="delivered.php">รายการจัดส่งแล้ว</a></li>
            <li><a href="success.php">คำสั่งซื้อเสร็จสิ้น</a></li>
            <li><a href="promo.php">จัดการโปรโมชั่น</a></li>
            <li><a href="sarup.php">สรุปยอดขาย</a></li>
            <li style="float:right"><a href="../logout.php">ออกจากระบบ</a></li>
        </ul>
    </div>




    <br>
    <h1 class="text-warning text-center"> รายการรอจัดส่ง </h1>
    <br>
    <br>
    <br>
    <div class="row">
        <div class="col-6">

        </div>
        <div class="col-6">

        </div>
    </div>
    <div style="border: 4px solid #123; padding:5px;">
        <h2>การสั่งซื้อ</h2>
        <?php

    include "connect_database.php";
    $sql = "SELECT * from transection,account,book where book.book_id=transection.book_id and account.username = transection.username and transection_status='confirm' ";
    $query = mysqli_query($conn, $sql);
    while ($res = mysqli_fetch_array($query)) {
    ?>
        <div style="border: 3px solid #aaa;">
            <tr class="text-center">
                <td> <?php echo 'หมายเลขคำสั่งซื้อ : ' . $res['sell_id']; ?></td><br>

                <?php if ($res['pracel_id'] == '') { ?>
                <?php echo '--ยังไม่มีข้อมูล-- : '; ?>
                <td> <button class="btn-primary btn"> <a href="pracel_update.php?id=<?php echo $res['sell_id']; ?>"
                            class="text-white"> แจ้งเลขติดตามพัสดุ </a> </button> </td>
            </tr> <br>
            <?php  } else { 
                echo 'หมายเลขพัสดุ : ' . $res['pracel_id'] . '  '; 
            ?>
            </td>
            <td> <button class="btn-danger btn"> <a href="pracel_delete.php?id=<?php echo $res['sell_id']; ?>"
                        onclick="return confirm('ต้องการเปลี่ยนหมายเลขพัสดุ?');" class="text-white">
                        เปลี่ยนหมายเลข </a> </button> </td><br>
            <?php } ?>

            <td> <?php echo 'ชื่อลูกค้า : ' . $res['account_fname']; ?><br>


            <td> <?php echo 'หนังสือที่ส่ง : ' . $res['book_name']; ?></td><br>
            <td> <?php echo 'วันที่สั่งซื้อ : ' . $res['date_time']; ?></td>

        </div>
        <br>
        <?php
    }
    ?>
    </div>

</body>

</html>