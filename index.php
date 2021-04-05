<?php
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
        session_start();

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


        <!-- breadcrumb & Search -->
        <div class="row">
            <!-- breadcrumb -->
            <nav class="pl-5 pt-3 col-8" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">

                <?php if(isset($_GET['category_id'])){
                    $sql = "SELECT category_name FROM category where category_id=".$_GET['category_id'];
                    $result = $conn->query($sql);
                    $res_category_name = $result->fetch_array(); ?>

                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php" style="text-decoration:none;">หมวดหมู่ทั้งหมด</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> <?php echo $res_category_name[0]; ?> </li>
                </ol>

                <?php 
                }else if(isset($_GET['search'])){ 
                    $search = $_GET['search'];
                ?>

                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php" style="text-decoration:none;">ดูทั้งหมด</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> ค้นหา : <?php echo $search ?></li>
                </ol>

                <?php }else{ ?>

                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page"><a>หมวดหมู่ทั้งหมด</a></li>
                    <!-- <li class="breadcrumb-item active" aria-current="page"><a>สินค้าทั้งหมด</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a>โปรโมชั่น</a></li> -->
                </ol>

                <?php 
            }
            ?>
            </nav>

            <!-- Search -->
            <ul class="mt-3 col-4">
                <div class="d-flex gx-1">
                    <input class="form-control me-2" type="search" placeholder="ค้นหาหนังสือ" aria-label="Search"
                        id="Search" onchange="search_input()">
                    <button class=" btn btn-outline-success" type="submit" onclick='search()'>ค้นหา</button>
                </div>
            </ul>
        </div>

        <!-- ไอนี่ส่วน search ต้องใส่ ไม่ใส่แล้วดึงข้อมูลไม่ได้ แต่ซ่อน tag p ไว้ 😎😎 -->
        <script>
        function search_input() {
            var search = document.getElementById("Search").value;
            return search;
        }

        function search() {
            location.href = "index.php?search=" + search_input();
        }
        </script>



        <div class="row gx-3 mt-3">
            <!-- Category -->
            <div class="col-2">
                <p style="font-weight:bold">หมวดหมู่หนังสือ</p>
                <?php 
                    $sql = "SELECT * FROM category";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($res = $result->fetch_assoc()) {?>
                <a class="nav-link" href="index.php?category_id=<?php echo $res['category_id'];?>">
                    <?php echo $res['category_name'];?> </a>
                <?php } 
                    }
                ?>
            </div>

            <!-- Book -->
            <div class="col-10">
                <div class="book">
                    <div class="row gy-4">
                        <?php       
                            $sql = "SELECT * FROM book";

                            //if choose category
                            if(isset($_GET['category_id'])){
                                $sql = "SELECT * FROM book where book_type=".$_GET['category_id'];
                            }
                            else if(isset($_GET['search'])){ 
                                $search = $_GET['search'];
                                $sql = "SELECT * FROM book where book_name LIKE '%" . $search . "%' ";
                            }

                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($res = $result->fetch_assoc()) {
                                $imagePath = "data:image;base64,".base64_encode($res['book_pic']);
                                $bookName = $res['book_name'];
                                $owner = $res['book_author'];
                                $price = $res['book_price'];
                                $stock = 3;

                                $id = $res['book_id'];

                                $urlDetail = "book_detail.php?id=".$id;
                        ?>

                        <!-- Column-->
                        <div class='col-12 col-sm-6 col-md-3  '>
                            <!-- card-->
                            <div class='card' style='width: 15rem;'>
                                <!-- image -->
                                <a href='<?php echo $urlDetail; ?>'>
                                    <img src='<?php echo $imagePath; ?>' class='card-img-top' alt='bookImage'>
                                </a>
                                <!-- content -->
                                <div class='card-body'>
                                    <a href='<?php echo $urlDetail; ?>'>
                                        <h5 class='card-title'><?php echo $bookName; ?></h5>
                                    </a>

                                    <p1 class='card-owner'>โดย <?php echo $owner; ?></p1>
                                    <p class='card-price'>฿<?php echo $price; ?></p>
                                    <?php if($stock > 0 ){ ?>
                                    <center>
                                        <a class='btn btn-primary' href="payment.php?id=<?php echo $id; ?>" style="color:#fff;">สั่งซื้อ</a>
                                    </center>
                                    <?php } else { ?>
                                    <center>
                                        <button class='btn btn-secondary' disabled>ไม่มีสินค้า</button>
                                    </center>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>

                        <?php }
                        } else {
                            if(isset($_GET['category_id'])){
                                echo "<div class='cardl'> ไม่มีหนังสือในหมวดที่เลือกค้าบบ</div>";
                            }
                            else if(isset($_GET['search'])){ 
                                echo "<div class='cardl'> ไม่มีหนังสือที่ค้นหาค้าบบ</div>";
                            }else{
                                echo "<div class='cardl'> ไม่มีหนังสือให้ขายอะค้าบบ</div>";
                            }
                            
                        }
                        $conn->close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <br />
        <br />
        <br />
        <br />
</body>

</html>