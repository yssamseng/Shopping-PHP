<?php
    include("connect_database.php");
    session_start();

?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>BoomBoom</title>
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
                <a class="nav-link active" aria-current="page" href="index.php">หน้าแรก</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="form_add_slip.php">แจ้งชำระ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="con_delivered.php">สินค้าที่กำลังจัดส่ง</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">ประวัติการซื้อ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">เกี่ยวกับเรา</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.php">ติดต่อเรา</a>
            </li>

        </ul>




        <?php
        include "connect_database.php";
        $id = $_GET['id'];
        $sql = "SELECT * FROM book WHERE book_id = '$id' ";
        $query = mysqli_query($conn, $sql);
        $res = mysqli_fetch_array($query);
        ?>

        <br>
        <h1>&nbsp;&nbsp; รายละเอียดหนังสือ</h1><br><br><br>

        <!-- <form action='ListRoom.php' method='POST'>
                <div align='center'>ค้นหา &nbsp;&nbsp;
                    <select name='txtfinddorm'>
                    <option value='0'>-- ค้นหานิยาย --</option>
                    <?php
                    require 'connect_database.php';
                    $sql = "select book_id, book_type from book";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<option value='$row[book_id]'>$row[book_type]</option>";
                        if ($row["book_id"] == $txtfinddorm)
                            $txtfindname = $row["book_id"];
                    }
                    ?>     
                    </select>
                    &nbsp;&nbsp;
                    <input class='hi' type='submit' value=' ค้น '>
                </div>	 -->
        </form>

        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <image src="data:image;base64,<?php echo base64_encode($res['book_pic']); ?>" width="250px" height="250px">
                </div>

                <div class="col-sm-6">
                    <b style="font-size:18px;">ชื่อหนังสือ</b><br>
                    <p style="font-size:16px;"><?php echo $res['book_name']; ?></p><br>

                    <b style="font-size:18px;">ชื่อผู้แต่ง</b><br>
                    <p style="font-size:16px;"><?php echo $res['book_author']; ?></p><br>

                    <b style="font-size:18px;">หมวดหมู่หนังสือ</b><br>
                    <p style="font-size:16px;"><?php echo $res['book_type']; ?></p><br>

                    <b style="font-size:18px;">รายละเอียดหนังสือ</b><br>
                    <p style="font-size:16px;"><?php echo $res['book_des']; ?></p><br>

                    <b style="font-size:18px;">ราคา : </b>
                    <p style="font-size:16px;"><?php echo $res['book_price']; ?> บาท</p><br><br>
                </div>
            </div>
        </div>

        <br><br><br>

        <div class="form-group">
            <center>
                <button type="button" class="btn btn-secondary btn-lg"><a href="#" onClick="window.history.back()" value="ย้อนกลับ" class="text-white">ย้อนกลับ</a></button>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn btn-primary btn-lg"><a href="payment.php?id=<?php echo $res['book_id']; ?>" class="text-white">ซื้อหนังสือ</a></button>
        </div>
        </center>
        <br><br>
    </div>
</body>

</html>