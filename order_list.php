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
                <a class="nav-link " aria-current="page" href="index.php">หน้าแรก</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="form_add_slip.php">แจ้งชำระ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="con_delivered.php">สินค้าที่กำลังจัดส่ง</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="order_list.php">ประวัติการซื้อ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="aboutme.php">เกี่ยวกับเรา</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.php">ติดต่อเรา</a>
            </li>
        </ul>

        <!-- breadcrumb & Search -->
        <div class="row">
            <!-- breadcrumb -->
            <nav class="pl-5 pt-3 col-8" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <?php 
                if(isset($_GET['search'])){ 
                    $search = $_GET['search'];
                ?>

                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="order_list.php"
                            style="text-decoration:none;">ประวัติการสั่งซื้อทั้งหมด</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> ค้นหา : <?php echo $search ?></li>
                </ol>

                <?php }else{ ?>

                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page"><a>ประวัติการสั่ง</a></li>

                </ol>

                <?php 
            }
            ?>
            </nav>

            <!-- Search -->
            <ul class="mt-3 col-4">
                <div class="d-flex gx-1">
                    <input class="form-control me-2" type="search" placeholder="ค้นหาหมายเลขการสั่งซื้อ"
                        aria-label="Search" id="Search" onchange="search_input()">
                    <button class=" btn btn-outline-success" type="submit" onclick='search()'>ค้นหา</button>
                </div>
            </ul>
        </div>

        <script>
            function search_input() {
                var search = document.getElementById("Search").value;
                return search;
            }
            function search() {
                location.href = "order_list.php?search=" + search_input();
            }
        </script>

        <p style="font-size:30px;">&nbsp; ประวัติการสั่งซื้อหนังสือ</h3>

        <div class="container mt-3">

            <div class="book">
                <table class="table table-striped table-bordered table-hover">
                    <tr>
                        <th class="text-center">หมายเลขสั่งซื้อ</th>
                        <th class="text-center">หมายเลขพัสดุ</th>
                        <th class="text-center">ประเภทการจัดส่ง</th>
                        <th class="text-center">ชื่อหนังสือ</th>
                        <th class="text-center">ราคา</th>
                        <th class="text-center">สถานะ</th>
                    </tr>
                    <?php
                        $username = $_SESSION['_name'];
                        $sql = "SELECT * FROM book as B,transection as T where T.book_id=B.book_id and T.username = '$username'";

                        //
                        if(isset($_GET['search'])){ 
                            $search = $_GET['search'];
                            $sql = "SELECT * from book as B,transection as T where T.book_id=B.book_id And sell_id LIKE '%" . $search . "%' ";
                        }

                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($res = $result->fetch_assoc()) {
                            $sellID = $res['sell_id'];
                            $pracelID = $res['pracel_id'];
                            $sender = $res['sender'];
                            $bookname = $res['book_name'];
                            $price = $res['book_price'];
                            $status = $res['transection_status'];
                    ?>


                    <tr>
                        <td class="text-center">
                            <p class="text-center"><?php echo $sellID; ?></p>
                        </td>
                        <td>
                            <p class="text-center"><?php echo $pracelID; ?></p>
                        </td>
                        <td>
                            <p class="text-center"><?php echo $sender; ?></p>
                        </td>
                        <td>
                            <p class="text-center"><?php echo $bookname; ?></p>
                        </td>
                        <td>
                            <p class="text-center"><?php echo $price; ?>฿</p>
                        </td>

                        <td>
                            <?php 
                                if($status == 'pending'){
                                    echo "<p class='text-center' style='background-color:#CFCFCF; padding:3px;'>ยังไม่อัพโหลดสลิป</p>";
                                }else if($status == 'payment'){
                                    echo "<p class='text-center' style='background-color:#2574F9; padding:3px;'>จ่ายเงินแล้ว</p>";
                                }else if($status == 'confirm'){
                                    echo "<p class='text-center' style='background-color:#25F9F4; padding:3px;'>คำสั่งซื้อได้รับการยืนยันแล้ว</p>";
                                }else if($status == 'delivered'){
                                    echo "<p class='text-center' style='background-color:#EFF23B; padding:3px;'>สินค้าถูกจัดส่งแล้ว</p>";
                                }else if($status == 'success'){
                                    echo "<p class='text-center' style='background-color:#0DEE3C; padding:3px;'>ได้รับสินค้าแล้ว</p>";
                                }else if($status == 'cancel'){
                                    echo "<p class='text-center' style='background-color:#F92528; padding:3px;'>สินค้าถูกยกเลิก</p>";
                                }
                            ?>
                        </td>
                    </tr><?php }}
                    else{

                    }
                    $conn->close();
                    ?>

                </table>
            </div>
        </div>






</body>

</html>