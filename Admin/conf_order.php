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
    <title>รายการสั่งซื้อ</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
    </script>
    <style>
    *{
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }
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

    <div class="p-2">
        <ul>
            <li><a href="index.php">สต๊อกหนังสือ</a></li>
            <li><a class="active" href="conf_order.php">รายการคำสั่งซื้อ</a></li>
            <li><a href="pracel.php">รายการรอจัดส่ง</a></li>
            <li><a href="delivered.php">รายการจัดส่งแล้ว</a></li>
            <li><a href="success.php">คำสั่งซื้อเสร็จสิ้น</a></li>
            <li><a href="promo.php">จัดการโปรโมชั่น</a></li>
            <li><a href="sarup.php">สรุปยอดขาย</a></li>
            <li style="float:right"><a href="../logout.php">ออกจากระบบ</a></li>
        </ul>
    </div>


    <br>
    <h1 class="text-warning text-center"> รายการสั่งซื้อ </h1>
    <br>
    <br>
    <br>
    <div class="row m-2">
        <div class="col-6">
            <div class="p-2" style="border: 4px solid #123;">
                <h2>ลูกค้าอัพโหลดสลิปแล้ว รอตรวจสอบ </h2>
                <?php
                include "connect_database.php";
                $sql = "SELECT * from transection,account,book where book.book_id=transection.book_id and account.username = transection.username and transection.transection_status = 'payment'";
                $query = mysqli_query($conn, $sql);
                while ($res = mysqli_fetch_array($query)) {
                ?>
                <div class="p-2"style="border: 2px solid #AAA;">
                    <tr class="text-center">
                        <td> <?php echo 'หมายเลขคำสั่งซื้อ : ' . $res['sell_id']; ?></td><br>

                        <td> <?php echo 'ชื่อลูกค้า : ' . $res['account_fname']; ?></td><br>
                        <td> <?php echo 'ชื่อหนังสือ : ' . $res['book_name']; ?></td><br>
                        <td> <?php echo 'วันที่สั่งซื้อ : ' . $res['date_time']; ?></td><br><br>
                        <td class="m-1"> สลิป: </td>
                        <td> <img src="data:image;base64,<?php echo base64_encode($res['transection_slip']); ?>"
                                width="300px" />
                        </td><br>
                        <td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
                        <td>
                            <button class="btn-danger btn m-3">
                                <a href="conf_f.php?id=<?php echo $res['sell_id']; ?>" style="text-decoration:none;"
                                    onclick="return confirm('ต้องการยกเลิก?');" class="text-white">
                                    ยกเลิกคำสั่งซื้อ
                                </a>
                            </button>
                        </td>
                        <td>
                            <button class="btn-primary btn ml-3" ">
                                <a href=" conf_t.php?id=<?php echo $res['sell_id']; ?>" style="text-decoration:none;"
                                onclick="return confirm('ต้องการยืนยันคำสั่งซื้อ?');" class="text-white">
                                ยืนยันสลิปถูกต้อง
                                </a>
                            </button>
                        </td>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="col-6">
            <div class="p-2" style="border: 4px solid #123;">
                <h2>ลูกค้าสั่งซื้อแล้ว ยังไม่ได้อัพโหลดสลิป </h2>
                <?php
                include "connect_database.php";
                $sql = "SELECT * from transection,account,book where book.book_id=transection.book_id and account.username = transection.username and transection.transection_status = 'pending'";
                $query = mysqli_query($conn, $sql);
                while ($res = mysqli_fetch_array($query)) {
                ?>
                <div class="p-2" style="border: 2px solid #AAA;">
                    <tr class="text-center">
                        <td> <?php echo 'หมายเลขคำสั่งซื้อ : ' . $res['sell_id']; ?></td><br>

                        <td> <?php echo 'ชื่อลูกค้า : ' . $res['account_fname']; ?></td><br>
                        <td> <?php echo 'ชื่อหนังสือ : ' . $res['book_name']; ?></td><br>
                        <td> <?php echo 'วันที่สั่งซื้อ : ' . $res['date_time']; ?></td><br>
                        <td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
                        <td>
                            <button class="btn-danger btn m-3">
                                <a href="conf_f.php?id=<?php echo $res['sell_id']; ?>" style="text-decoration:none;"
                                    onclick="return confirm('ต้องการยกเลิก?');" class="text-white">
                                    ยกเลิกคำสั่งซื้อ
                                </a>
                            </button>
                        </td>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>




</body>

</html>