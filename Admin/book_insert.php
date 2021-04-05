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

include('connect_database.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
    </script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>

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

    <br>
    <h1>&nbsp;&nbsp; เพิ่มหนังสือ</h1><br><br><br>


    <form method="POST" enctype="multipart/form-data" name="upfile" id="upfile">

        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <td align="center" bgcolor="#EDEDED">เลือกรูปภาพหนังสือ&nbsp;&nbsp;</td>
                    <td bgcolor="#EDEDED"><label>
                            <input type="file" name="bookimg" id="bookimg" required="required" />
                        </label></td>
                </div>

                <div class="col-sm-6">
                    <b style="font-size:18px;">ชื่อหนังสือ</b><br>
                    <input class="form-control" type="text" name="book_name"><br>
                    <b style="font-size:18px;">ชื่อผู้แต่ง</b><br>
                    <input class="form-control" type="text" name="book_author"><br>
                    <b style="font-size:18px;">หมวดหมู่หนังสือ</b><br>
                    <select id="myselect" name="book_type" required>
                        <option value="">---เลือก---</option>
                        <?php
                            
                            $sql2 = "SELECT * from category";
                            $result2 = $conn->query($sql2);
                            while ($res2 = $result2->fetch_assoc()) { ?>
                                <option value="<?php echo $res2['category_id']; ?>">
                                    <?php echo $res2['category_name']; ?>
                                </option>
                            <?php } ?>
                    </select>
                    <br><br>
                    <b style="font-size:18px;">รายละเอียดหนังสือ</b><br>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="book_des"></textarea><br>

                    <b style="font-size:18px;">ราคา : </b>
                    <input class="form-control" type="text" name="book_price">

                    <b style="font-size:18px;">จำนวน</b><br>
                    <input class="form-control" type="text" name="book_stock"><br>
                </div>
            </div>
        </div>
        <center>
            <div class="form-group">
                <br><br>
                <button type="submit" class="btn btn-primary btn-lg" name="Done" value="Done">เพิ่ม</button><br>
            </div>
        </center>
        </div>
    </form>
    <br>
    <br>

    <?php
    if (isset($_POST['Done'])) {
        $fp = fopen($_FILES["bookimg"]["tmp_name"], "r");
        $ReadBinary = fread($fp, filesize($_FILES["bookimg"]["tmp_name"]));
        fclose($fp);
        $FileData_pic = addslashes($ReadBinary);
        $name = $_POST['book_name'];
        $author = $_POST['book_author'];
        $type = $_POST['book_type'];
        $des = $_POST['book_des'];
        $price = $_POST['book_price'];
        $stock = $_POST['book_stock'];
        $q = "INSERT INTO book (book_pic,book_name, book_author , book_type , book_des , book_price,book_stock ) VALUES ( '$FileData_pic', '$name', '$author' , '$type' , '$des' , '$price','$stock')";

        $query = mysqli_query($conn, $q);
        mysqli_close($conn);
        if($query){
            echo "<script type='text/javascript'>";
            echo "alert('Insert Succesfuly ');";
            echo "location.href = 'index.php';";
            echo "</script>";
        }
        else{
            echo "<script type='text/javascript'>";
            echo "alert('Insert Error');";
            echo "</script>";
        }
        
    }
    ?>

</body>

</html>