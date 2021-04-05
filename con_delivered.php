<?php
    include("connect_database.php");
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
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>BoomBoom</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/index.css">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
    </script>
</head>

<body>

    <?php 
        $login = false;
        $username =  $_SESSION["_name"];
        if(isset($_SESSION["_role"])){
            $login = true;
        }
        if($login){
            include("Components/navbarLogin.php");
        }else{
            include("Components/navbarNologin.php");
        }
        
        include("Components/banner.php");
    ?>

    <div class="container mt-3">

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="index.php">หน้าแรก</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="form_add_slip.php">แจ้งชำระ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="con_delivered.php">สินค้าที่กำลังจัดส่ง</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="order_list.php">ประวัติการซื้อ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="aboutme.php">เกี่ยวกับเรา</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.php">ติดต่อเรา</a>
            </li>
        </ul>
        <br>
        <div class="row m-10">
            <div style="border: 4px solid #123; padding:5px;">
                <h2>ได้รับสินค้าหรือยัง</h2>
                <?php

                $sql = "SELECT * from transection,book where book.book_id=transection.book_id and transection.username='$username' and transection_status='delivered' ";
                $query = mysqli_query($conn, $sql);
                while ($res = mysqli_fetch_array($query)) {
                ?>
                <div style="border: 3px solid #aaa;">
                    <tr class="text-center">
                        <td> <?php echo 'หมายเลขคำสั่งซื้อ : ' . $res['sell_id']; ?></td><br>
                        <td> <?php echo 'หนังสือที่ส่ง : ' . $res['book_name']; ?></td><br>
                        <td> <?php echo 'หมายเลขพัสดุ : ' . $res['pracel_id']; ?></td><br>
                        <td> <?php echo 'วันที่สั่งซื้อ : ' . $res['date_time']; ?></td><br>
                        <td>
                            <button class="btn-primary btn ml-3" ">
                                <a href="conf_deliverred.php?id=<?php echo $res['sell_id']; ?>" style="text-decoration:none;"
                                onclick="return confirm('ยืนยันได้รับสินค้าแล้ว?');" class="text-white">
                                ได้รับสินค้าแล้ว
                                </a>
                            </button>
                        </td>
                    </tr>
                </div>
                <br>
                <?php } ?>
            </div>
        </div>
        
    </div>
    <br />
</body>

</html>