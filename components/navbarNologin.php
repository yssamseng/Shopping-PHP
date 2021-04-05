<?php include("bootsrap5.php"); ?>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-md mt-1 p-1">
        <a class="navbar-brand" href="index.php" style="font-weight:bold; color: #555555">
            <img src="http://boomboom.in/wp-content/uploads/2020/08/boom-boom-logo4-2-e1596259389789.png" alt="" width="35" height="28"
                class="d-inline-block align-top">
            BoomBoom
        </a>
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link" href ="" data-toggle="modal" data-target="#loginModal">เข้าสู่ระบบ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="form_register.php">สมัครสมาชิก</a>
            </li>
        </ul>
    </div>
</nav>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>หน้าล็อกอิน</title>
    
    <!-- Bootstrap CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css'>
    <!-- Font Awesome CSS -->
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/all.css'>
    <!-- Style CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Demo CSS -->
    <link rel="stylesheet" href="css/demo.css">

</head>

<body>

    <main>

        <!-- partial:index.partial.html -->

        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-title text-center">
                            <h4>ลงชื่อเข้าใช้</h4>
                        </div>
                        <div class="d-flex flex-column text-center">
                            <form method="POST" action="login.php">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="Username" required name="Username"
                                        placeholder="ชื่อผู้ใช้...">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="Password" required name="Password"
                                        placeholder="รหัสผ่าน...">
                                </div>
                                <button type="submit" class="btn btn-info btn-block btn-round">ลงชื่อเข้าใช้</button>
                                &nbsp;&nbsp;
                            </form>

                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <div class="signup-section">ยังไม่เป็นสมาชิก? <a href="form_register.php" class="text-info">
                                สมัครสมาชิก</a>.</div>
                    </div>
                </div>
            </div>
            <!-- partial -->
        </div>
    </main>

    <!-- jQuery -->
    <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js'></script>
    <!-- Popper JS -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'></script>
    <!-- Bootstrap JS -->
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
    <!-- Custom Script -->
    <script src="js/script.js"></script>

</body>

</html>

            