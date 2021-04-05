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

</head>

<body>
    <div class="p-2">
        <ul>
            <li><a class="active" href="index.php">สต๊อกหนังสือ</a></li>
            <li><a href="conf_order.php">รายการคำสั่งซื้อ</a></li>
            <li><a href="pracel.php">รายการรอจัดส่ง</a></li>
            <li><a href="delivered.php">รายการจัดส่งแล้ว</a></li>
            <li><a href="success.php">คำสั่งซื้อเสร็จสิ้น</a></li>
            <li><a href="promo.php">จัดการโปรโมชั่น</a></li>
            <li><a href="sarup.php">สรุปยอดขาย</a></li>
            <li style="float:right"><a href="../logout.php">ออกจากระบบ</a></li>
        </ul>
    </div>


    <?php

    include('../connect_database.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
    ?>

    <br>
    <br>


    <div class="container mt-3">
        <p style="font-size:30px;">สต็อกหนังสือ</h3><br>

            <!-- Search -->
        <div class="mt-3 col-4">
            <div class="d-flex gx-1">
                <input class="form-control me-2" type="search" placeholder="ค้นหาชื่อหนังสือ" aria-label="Search"
                    id="Search" onchange="search_input()">
                <button class=" btn btn-outline-success" type="submit" onclick='search()'>ค้นหา</button>
            </div>
        </div>

        <script>
        function search_input() {
            var search = document.getElementById("Search").value;
            return search;
        }
        function search() {
            location.href = "index.php?search=" + search_input();
        }
        </script>

        <div class="dd-grid gap-2 d-md-flex justify-content-md-end">
            <!--   ใส่ลิงค์ไปหน้าเพิ่มหนังสือ -->
            <button class="btn btn-success" style="position: absolute;"><a href="book_insert.php"
                    class="text-white">เพิ่ม</a></button><br><br>
        </div><br>

        <!-- Book -->
        <div class="book">
            <table class="table table-striped table-bordered table-hover">
                <tr>
                    <th class="text-center">ปกหนังสือ</th>
                    <th class="text-center">หมวดหมู่หนังสือ</th>
                    <th class="text-center">ชื่อหนังสือ</th>
                    <th class="text-center">ผู้เขียน</th>
                    <th class="text-center">ราคา</th>
                    <th class="text-center">แก้ไข<i class="fa fa-gear"></i></th>
                </tr>
                <?php
                $sql = "SELECT * FROM book,category WHERE book_type = category_id";

                //if choose category
                if (isset($_GET['search'])) {
                    $search = $_GET['search'];
                    $sql = "SELECT * FROM book,category where book_type = category_id And book_name LIKE '%" . $search . "%' ";
                }

                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($res = $result->fetch_assoc()) {
                        $imagePath = "data:image;base64," . base64_encode($res['book_pic']);
                        $bookName = $res['book_name'];
                        $booktype = $res['category_name'];
                        $owner = $res['book_author'];
                        $price = $res['book_price'];
                        $stock = 3;

                        $urlDetail = "book_detail.php?id=" . $res['book_id'];
                ?>


                <tr>
                    <td class="text-center">
                        <!-- image -->
                        <a href='<?php echo $urlDetail; ?>'>
                            <img src='<?php echo $imagePath; ?>' width="100px" height="100px"></a>
                    </td>
                    <td>
                        <p class="text-center"><?php echo $booktype; ?></p>
                    </td>
                    <td>
                        <p class="text-center"><?php echo $bookName; ?></p>
                    </td>
                    <td>
                        <p class="text-center">โดย <?php echo $owner; ?></p>
                    </td>
                    <td>
                        <p class="text-center"><?php echo $price; ?>฿</p>
                    </td>


                    <!-- ใส่ลิงค์ไปหน้าแก้ไข  -->
                    <td>
                        <p class="text-center"> <a href="book_update.php?id=<?php echo $res['book_id']; ?>"> Update </a>
                        </p>
                    </td>

                </tr><?php }
                        } else {
                        }
                        $conn->close();
                                ?>
            </table>
        </div>
    </div>

</body>

</html>