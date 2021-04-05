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
                <a class="nav-link " aria-current="page" href="index.php">หน้าแรก</a>
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
                <a class="nav-link active" href="contact.php">ติดต่อเรา</a>
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
                        <li class="breadcrumb-item"><a href="index.php" style="text-decoration:none;">หน้าแรก</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> <?php echo $res_category_name[0]; ?> </li>
                    </ol>

                    <?php 
                }else if(isset($_GET['search'])){ 
                    $search = $_GET['search'];
                ?>

                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php" style="text-decoration:none;">หน้าแรก</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> ค้นหา : <?php echo $search ?></li>
                </ol>

                <?php }else{ ?>

                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page"><a>หน้าแรก</a></li>
                    
                </ol>

                <?php 
            }
            ?>
            </nav>

            <br>
            <h3><strong>ติดต่อ: นักศึกษาสาขาวิทยาการคอมพิวเตอร์ </strong></h3><br>
            <p><h5>1.นายเจฟฟี่ ดาโต๊ะ 6110210071<br>
               2.นายชัยชาญ เทพพรหม 6110210093<br>
               3.นางสาวนูรูลมุมีนะห์ เจ๊ะเด็ง 6110210235<br>
               4.นายวิทูร ลีลาสวัสดิ์สุข 6110210384<br>
               5.นายสหศาสตร์ คำอ่าง 6110210428<br>
               6.นางสาวอาศิมน สงสุวรรณ 6110210532<br>
               7.นายยูโซะ ซำเซ็ง 6110210612<br>
            </h5></p>




</body>

</html>