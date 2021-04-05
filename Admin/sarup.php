<?php 
  session_start();
  //Check login 
  if(!isset($_SESSION["_role"]) && isset($_SESSION["_role"]) != "Admin"){
      header("location: ../index.php");
  }else if($_SESSION["_role"] == "User"){
    echo '<script language="javascript">';
    echo "window.location.href = '../index.php';";
    echo '</script>';
}

  include("connect_database.php");
  $sql = "select count(*) as dodo from transection,book where book.book_id = transection.book_id and book_type =1 and transection_status = 'success'";
  $query = mysqli_query($conn, $sql);
  $res = mysqli_fetch_array($query);
  
  $cartoon = $res['dodo'];
  
  
  $sql = "select count(*) as dodo from transection,book where book.book_id = transection.book_id and book_type =2 and transection_status = 'success'";
  $query = mysqli_query($conn, $sql);
  $res = mysqli_fetch_array($query);
  $bun = $res['dodo'];
  
  $sql = "select count(*) as dodo from transection,book where book.book_id = transection.book_id and book_type =3 and transection_status = 'success'";
  $query = mysqli_query($conn, $sql);
  $res = mysqli_fetch_array($query);
  $yay = $res['dodo'];
  
  $sql = "select count(*) as dodo from transection,book where book.book_id = transection.book_id and book_type =4 and transection_status = 'success'";
  $query = mysqli_query($conn, $sql);
  $res = mysqli_fetch_array($query);
  $gogo = $res['dodo'];
  
  
  //echo '$res' ;
   //echo "หมายเลขคำสั่งซื้อ :".$res['count(*)']; 
  
  
   
  $dataPoints = array( 
      array("y" => $cartoon, "label" => "การ์ตูน" ),
      array("y" => $bun, "label" => "บันเทิง" ),
      array("y" => $yay, "label" => "นิยาย" ),
      array("y" => $gogo, "label" => "แรงบันดาลใจ" ),
  
  );
  ?>

<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <title>จัดการโปรโมชั่น</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
    </script>

    <script>
    window.onload = function() {

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "ยอดการขายตลอดการเปิดร้าน"
            },
            axisY: {
                title: "จำนวนหนังสือ (เล่ม)"
            },
            data: [{
                type: "column",
                yValueFormatString: "#,##0.## tonnes",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();

    }
    </script>


</head>

<body>
    <!-- Navbar -->
    <div class="p-2">
        <ul>
            <li><a href="index.php">สต๊อกหนังสือ</a></li>
            <li><a href="conf_order.php">รายการคำสั่งซื้อ</a></li>
            <li><a href="pracel.php">รายการรอจัดส่ง</a></li>
            <li><a href="delivered.php">รายการจัดส่งแล้ว</a></li>
            <li><a href="success.php">คำสั่งซื้อเสร็จสิ้น</a></li>
            <li><a href="promo.php">จัดการโปรโมชั่น</a></li>
            <li><a class="active" href="sarup.php">สรุปยอดขาย</a></li>
            <li style="float:right"><a href="../logout.php">ออกจากระบบ</a></li>
        </ul>
    </div>
    <?php 
        include("connect_database.php");
        $sql = "SELECT *,COUNT(sell_id) as Numbook, SUM(book_price) as Bookprice  FROM transection as T,book as B WHERE transection_status = 'success' AND T.book_id=B.book_id  GROUP BY month(date_time)";
        $result = $conn->query($sql);
    ?>
    <div class="container">
        <h1>ตารางสรุปยอดขาย</h1>

        <table class="table table-striped">
            <tr class="table-info">
                <th>ปี</th>
                <th>เดือน</th>
                <th>หมวดหมู่</th>
                <th>จำนวนเล่ม</th>
                <th>ยอดขาย(บาท)</th>
            </tr>

            <?php 
                if ($result->num_rows > 0) {
                    while ($res = $result->fetch_assoc()) { ?>
            <tr>
                <td> <?php echo date('Y', strtotime($res['date_time'])); ?> </td>
                <td> <?php echo date('M', strtotime($res['date_time'])); ?> </td>
                <td> <?php echo $res['book_id']; ?> </td>
                <td> <?php echo $res['Numbook']; ?> </td>
                <td> <?php echo $res['Bookprice']; ?> </td>
            </tr>
            <?php 
                    }
                }
            ?>

        </table>

        <br><br>



        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        <br>
    </div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</body>

</html>

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