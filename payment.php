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
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>แจ้งชำระ</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/index.css">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
    </script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>


</head>

<body>

    <?php
    $username =  $_SESSION["_name"];

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

    

    $sql = "SELECT * FROM account WHERE username = '$username' ";
    $query = mysqli_query($conn, $sql);
    $res2 = mysqli_fetch_array($query);
    ?>

    <div class="container mt-3">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">หน้าแรก</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="form_add_slip.php">แจ้งชำระ</a>
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
        
        <br>
        <h1>&nbsp;&nbsp; จุดชำระเงิน</h1>

        <?php
            $id = $_GET['id'];
            $sql = "SELECT * FROM book WHERE book_id = '$id' ";
            $query = mysqli_query($conn, $sql);
            $res = mysqli_fetch_array($query);

        ?>

        <div class="container">
            <div class="row mt-3">
                <div class="col-4">
                    <image src="data:image;base64,<?php echo base64_encode($res['book_pic']); ?>" width="250px" height="250px">
                </div>
                <div class="col-8">
                    <div class="col-sm-6">
                        <b style="font-size:18px;">ชื่อหนังสือ</b><br>
                        <p class="fs-1"><?php echo $res['book_name']; ?></p>

                        <b style="font-size:18px;">ชื่อผู้แต่ง</b><br>
                        <p class="fs-1"><?php echo $res['book_author']; ?></p>

                        <b style="font-size:18px;">ราคา : </b>
                        <p class="fs-1"><?php echo $res['book_price']; ?> บาท</p><br><br>
                    </div>
                </div>
            </div>
            <form method ="POST">
                <div class="row mt-3">
                    <div class="col-6">
                        <p class="fs-1">ที่อยู่</p>
                        <p style="font-size:16px;"><?php echo $res2['account_address']; ?></p>
                    </div>
                    <div class="col-6">
                        <p class="fs-1">ตัวเลือกการจัดส่ง</p>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="parcel" id="EMS" value="EMS">
                            <label class="form-check-label" for="EMS">
                                EMS
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="parcel" id="Kerry" value="Kerry">
                            <label class="form-check-label" for="Kerry">
                                Kerry
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="parcel" id="Flash" value="Flash">
                            <label class="form-check-label" for="Flash">
                                Flash
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">

                    </div>
                    <div class="col-6">
                        <p class="fs-1">สรุป</p>
                        <button type="submit" class="btn btn-info btn-round" name="Done" value="Done">สั่งซื้อ</button>
                    </div>
                </div>
            </form>
        </div>
        <br>
        <br>
        <br>
</body>

<?php
if (isset($_POST["Done"])) {
    $id = $_GET['id'];
    $username =  $_SESSION["_name"];
    $sender = $_POST['parcel'];
    $time = date("Y/m/d");
    $sql = "INSERT INTO transection (sender,transection_status,date_time,book_id,username) VALUES ('$sender','pending','$time','$id','$username')";
    $result = mysqli_query($conn, $sql);

    
    mysqli_close($conn);
    // javascript แสดงการ upload file
    echo '<script language="javascript">';
    echo "alert('คำสั่งซื้อสำเร็จ')";  //not showing an alert box.
    echo '</script>';

    echo '<script language="javascript">';
    echo "window.location.href = 'index.php';";
    echo '</script>';

}
?>

</html>