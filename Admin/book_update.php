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
            <li><a href="#contact">สรุปยอดขาย</a></li>
            <li style="float:right"><a href="../logout.php">ออกจากระบบ</a></li>
        </ul>
    </div>


    <div class="container mt-3">
        <?php
            include "connect_database.php";
            $id = $_GET['id'];
            $sql = "SELECT * FROM book,category WHERE book_type = category_id AND book_id = '$id' ";
            $query = mysqli_query($conn, $sql);
            $res = mysqli_fetch_array($query);

        ?>

        <br>
        <h1>&nbsp;&nbsp; รายละเอียดหนังสือ</h1><br><br><br>



        <div class="container">

            <div class="row">
                <div class="col-sm-4">
                    <!-- Show Image -->
                    <image src="data:image;base64,<?php echo base64_encode($res['book_pic']); ?>" width="250px"
                        height="250px" style="object-fit: cover;"/>

                    <!-- Change Image -->
                    <div class="pt-3 ml-5">
                        <div class="row">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="col-8">
                                    <p style="font-size:18px; font-weight:bold;">เปลี่ยนรูปภาพ:</p>
                                    <div class="input-group">
                                        <input type="file" class="form-control " name="book_img" />
                                    </div>
                                </div>
                                <div class="col-4 mt-2">
                                    <input type="submit" name="Upload" value="อัปโหลด" class="btn btn-primary" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <form method="POST">
                        <b style="font-size:18px;">ชื่อหนังสือ</b><br>
                        <input class="form-control" type="text" value="<?php echo $res['book_name']; ?>"
                            name="book_name" />

                        <b style="font-size:18px;">ชื่อผู้แต่ง</b><br>
                        <input class="form-control" type="text" value="<?php echo $res['book_author']; ?>"
                            name="book_author" />

                        <b style="font-size:18px;">หมวดหมู่หนังสือ</b><br>
                        <select class="form-select" aria-label="Default select example" name="book_type">
                            <option value="<?php echo $res['category_id']; ?>" selected>
                                <?php echo $res['category_name']; ?>
                            </option>

                            <?php
                            $sql2 = "select * from category";
                            $result2 = $conn->query($sql2);
                            while ($res2 = $result2->fetch_assoc()) {
                                if($res2['category_id'] != $res['category_id']){ ?>

                                <option value="<?php echo $res2['category_id']; ?>">
                                    <?php echo $res2['category_name']; ?>
                                </option>

                            <?php } } ?>

                        </select>

                        <b style="font-size:18px;">รายละเอียดหนังสือ</b><br>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                            value="<?php echo $res['book_des']; ?>" name="book_des">
                            <?php echo $res['book_des']; ?>
                        </textarea>

                        <b style="font-size:18px;">ราคา : </b>
                        <input class="form-control" type="text" value="<?php echo $res['book_price']; ?>"
                            name="book_price" />

                        <b style="font-size:18px;">จำนวนหนังสือในสต๊อก : </b>
                        <input class="form-control" type="text" value="<?php echo $res['book_stock']; ?>"
                            name="book_stock" />

                        <br><br><br>
                        <div class="form-group">
                            <center>
                                <button type="button" class="btn btn-secondary btn-lg">
                                    <a onClick="window.history.back()"
                                        style="text-decoration:none; color:#fff">ย้อนกลับ</a>
                                </button>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                <input type="submit" name="Update" value="แก้ไขข้อมูล" class="btn btn-primary btn-lg" />
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <button type="submit" class="btn btn-danger btn-lg" name="Delete" value="Delete"
                                    onclick="return confirm('แน่ใจนะว่าจะลบ ?');">ลบหนังสือ</a></button>
                            </center>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <br>
        <br>
</body>

</html>

<?php 
    if(isset($_POST["Update"])){
        $book_type = $_POST["book_type"];
        $book_name = $_POST["book_name"];
        $book_author = $_POST["book_author"];
        $book_price = $_POST["book_price"];
        $book_des = $_POST["book_des"];
        $book_stock = $_POST["book_stock"];
 
        //*** Insert Record ***/
        $sql = "UPDATE book SET book_type='$book_type', book_name='$book_name', book_author='$book_author', book_price='$book_price', book_des='$book_des', book_stock='$book_stock'  WHERE book_id = '$id'";
        
        $result = mysqli_query($conn, $sql);
        
        mysqli_close($conn);
        // javascript แสดงการ update
        if($result){
            echo "<script type='text/javascript'>";
            echo "alert('Update Succesfuly ');";
            echo "window.history.back();";
            echo "</script>";
        }
        else{
            echo "<script type='text/javascript'>";
            echo "alert('Update Error');";
            echo "</script>";
        }
    }

    if(isset($_POST["Upload"])){
        //convert to base64
        $fp = fopen($_FILES["book_img"]["tmp_name"],"r");
        $ReadBinary = fread($fp,filesize($_FILES["book_img"]["tmp_name"]));
        fclose($fp);
        $FileData_pic = addslashes($ReadBinary);

        //*** Insert Record ***//
        $sql = "UPDATE book SET book_pic='$FileData_pic'  WHERE book_id = '$id'";
        
        $result = mysqli_query($conn, $sql);
        
        mysqli_close($conn);
        // javascript แสดงการ upload file
        
        if($result){
            echo "<script type='text/javascript'>";
            echo "alert('Update Image Successfuly');";
            echo "window.history.back();";
            echo "</script>";
        }
        else{
            echo "<script type='text/javascript'>";
            echo "alert('Error back to upload again');";
            echo "</script>";
        }
    }
    if (isset($_POST['Delete'])){

        $sql = "DELETE FROM book WHERE book_id = $id";
        
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);

        

        if($result){
            echo "<script type='text/javascript'>";
            echo "alert('Delete Successfuly');";
            echo "</script>";

            echo '<script language="javascript">';
            echo "window.location.href = 'index.php';";
            echo '</script>';
        }
        else{
            echo "<script type='text/javascript'>";
            echo "alert('Error');";
            echo "</script>";
        }
        
    }

?>