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

    include("connect_database.php");
    include("components\bootsrap5.php");

?>


<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>BoomBoom</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="stylesheet" href="css/index.css">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
    </script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
    <!-- Bootstrap CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css'>
    <!-- Font Awesome CSS -->
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/all.css'>
    <!-- Style CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Demo CSS -->
    <link rel="stylesheet" href="css/demo.css">

</head>

<body>
    <?php


    $login = false;
    if (isset($_SESSION["_role"])) {
        $login = true;
    }
    if ($login) {
        include("Components/navbarLogin.php");
    } else {
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
                <a class="nav-link  active" href="form_add_slip.php">แจ้งชำระ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="con_delivered.php">สินค้าที่กำลังจัดส่ง</a>
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

        <?php
        //1. เชื่อมต่อ database:
        include('connect_database.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
        //2. query ข้อมูลจากตาราง tb_member:
        $username =  $_SESSION["_name"];
        $query = "SELECT * FROM transection as T,book as B where B.book_id=T.book_id And transection_status='pending' And username = '$username'";
        //3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result .
        $result = $conn->query($query);
        //4 . แสดงข้อมูลที่ query ออกมา โดยใช้ตารางในการจัดข้อมูล:
        echo "<div class='container'>";
        echo "<div class='row'>";
        echo "<div class='col-md-8'>";
        echo '<h4 align="center"> ตารางแสดงคำสั่งซื้อ *ทั้งหมดในดาต้าเบส*</h4>';
        echo "<table border='1' align='center' class='table table-hover'>";
        echo "
            <tr align='center' bgcolor='#CCCCCC'>
                <td>หมายเลขคำสั่งซื้อ</td>
                <td>ผู้ส่ง</td>
                <td>วันเวลา</td>
                <td>ไอดีหนังสือ</td>
                <td>ชื่อคนสั่ง</td>
                <td>รูปสลิป</td>
                <td>การสั่งซื่อ</td>
            </tr>";
        if ($result->num_rows > 0) {
            while ($value = $result->fetch_assoc()) {
                $id = $value['sell_id'];
                echo "<tr>";
                echo "<td>" . $value["sell_id"] .  "</td> ";
                echo "<td>" . $value["sender"] .  "</td> ";
                echo "<td>" . $value["date_time"] .  "</td> ";
                echo "<td>" . $value["book_name"] .  "</td> ";
                echo "<td>" . $value["username"] .  "</td> ";
                if($value["transection_slip"] == ""){
                    echo "<td>กรุณาอัปโหลดสลิป</td>";
                    echo "<td><a class='nav-link' href='cancelOrder.php?sell_id=$id'>ยกเลิกการคำสั่งซื้อ</a></td>";
                }
                else{
                    echo '<td><img src="data:image;base64,' . base64_encode($value["transection_slip"]) . '" width="70"/></td>';
                }
                
                echo "</tr>";
            }
        }
        echo "</table>";
        //5. close connection
        echo '<hr>';

        ?>


        <head class="intro">
            <h1>แจ้งชำระเงิน</h1>

        </head>


        <div>
            <form method="POST" action="upload_slip.php" enctype="multipart/form-data" name="upfile" id="upfile">
                <div class="form-group">
                    <div class="col-md-5  control-label">
                        เลือกหมายเลขคำสั่งซื้อ เพื่ออัปโหลดสลิป
                    </div>
                    <div class="col-md-4">
                        <select name="selected_sell_id" class="form-control" required>
                            <option value="">-เลือกรายการ-</option>
                            <?php foreach ($result as $results) { ?>
                            <option value="<?php echo $results["sell_id"]; ?>">
                                <?php echo $results["sell_id"]; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <p>&nbsp;</p>
                <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td height="40" colspan="2" align="center" bgcolor="#D6D6D6">แนบสลิปการโอนเงิน</td>
                    </tr <tr>
                    <td width="126" bgcolor="#EDEDED">&nbsp;</td>
                    <td width="574" bgcolor="#EDEDED">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="center" bgcolor="#EDEDED">เลือกรูปภาพสลิป&nbsp;&nbsp;</td>
                        <td bgcolor="#EDEDED"><label>
                                <input type="file" name="slipImage" id="slipImage" required="required" />
                            </label></td>
                    </tr>
                    <tr>
                        <td bgcolor="#EDEDED">&nbsp;</td>
                        <td bgcolor="#EDEDED">&nbsp;</td>
                    </tr>
                    <tr>
                        <td bgcolor="#EDEDED">
                            <div class="form-group">
                                <div class="col-md-10">
                                    <button type="submit" class="btn btn-info btn-round" name="Upload"
                                        value="Upload">ยืนยันชำระเงิน</button>
                                </div>
                            </div>
                        </td>
                        <td bgcolor="#EDEDED">&nbsp;</td>
                    </tr>
                </table>

            </form>
        </div>



        </form>
    </div>
</body>

</html>