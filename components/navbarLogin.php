<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
    integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
</script>

<?php
    include("bootsrap5.php");

    $username = $_SESSION["_name"];

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-md mt-1 p-1">
        <a class="navbar-brand" href="index.php" style="font-weight:bold; color: #555555">
            <img src="http://boomboom.in/wp-content/uploads/2020/08/boom-boom-logo4-2-e1596259389789.png" alt=""
                width="35" height="28" class="d-inline-block align-top">
            BoomBoom
        </a>
        <ul class="nav justify-content-end">
            <div class="dropdown">
                <button type="button" class="bg-light nav justify-content-end" data-toggle="dropdown" style="border: none;">
                    <li class="nav-item">
                        <img src="img/user.png" width="35">
                    </li>
                    <li class="nav-item mt-1">
                        <a style="text-decoration: none; margin-left: 5px;"><?php echo $username; ?> </a>
                    </li>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">รายละเอียดบัญชี</a>
                    <a class="dropdown-item" href="#">เปลี่ยนรหัสผ่าน</a>
                    <li><hr class="dropdown-divider"></li>
                    <a class="dropdown-item" href="logout.php">ออกจากระบบ</a>
                </div>
            </div>
        </ul>
    </div>
    </div>
</nav>
