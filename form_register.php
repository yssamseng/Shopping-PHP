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
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>สมัครสมาชิก</title>

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/all.css'>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/demo.css">

</head>

<body>
    <main>

        <head class="intro">
            <h1>Register page </h1>
            <button type="button" class="btn btn-info btn-round"
                onclick="location.href='index.php'">ย้อนกลับ</button>
        </head>


        <div style="max-width: 500px;">
            <form method="POST" action="register.php">
                <div class="form-group">
                    <label class="col-form-label d-flex">ชื่อผู้ใช้ <p style="color:red; padding-left:5px;">*</p> </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" required name="username">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-form-label d-flex">รหัสผ่าน <p style="color:red; padding-left:5px;">*</p> </label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" required name="password">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-form-label d-flex">ยืนยันรหัสผ่าน <p style="color:red; padding-left:5px;">*</p> </label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" required name="repassword">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-form-label d-flex">เบอร์โทรศัพท์ <p style="color:red; padding-left:5px;">*</p> </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" required name="tel">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-form-label d-flex">ชื่อจริง <p style="color:red; padding-left:5px;">*</p> </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" required name="fname">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-form-label d-flex">นามสกุล <p style="color:red; padding-left:5px;">*</p> </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" required name="lname">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-form-label d-flex">ที่อยู่ <p style="color:red; padding-left:5px;">*</p> </label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="3" required name="address"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-info btn-round" name="done">สมัครสมาชิก</button>
                    </div>
                </div>
            </form>
        </div>


    </main>

</body>

</html>