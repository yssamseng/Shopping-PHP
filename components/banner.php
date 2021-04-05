<!DOCTYPE html>
<html>

<head>
    <!-- Load Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
    </script>
</head>

<style>
// Customizing the carousel for white background 
.carousel-indicators .active {
    background-color: green;
}

.carousel-indicators li {
    background-color: burlywood;
}

.containers {
    max-width: 960px;
    margin: 0 auto;
}

.bg {
    background-color: #999;
}

.carousel-item img {
    width: 100%;
    height: 350px;
    object-fit: cover;
}
</style>
<?php 
    $sql = "SELECT * from promotion";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $i = 0;
        while($res = $result->fetch_assoc()){
            if($i == 0){
                $img1 = $res['promotion_pic'];
            }else if($i == 1){
                $img2 = $res['promotion_pic'];
            }else if($i == 2){
                $img3 = $res['promotion_pic'];
            }
            $i++;
        }
    }
?>

<body>
    <div class="containers mt-3">
        <div id="GFG" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="#GFG" data-slide-to="0" class="active"></li>
                <li data-target="#GFG" data-slide-to="1"></li>
                <li data-target="#GFG" data-slide-to="2"></li>
            </ul>

            <!-- The slideshow -->
            <div class="carousel-inner bg">


                <div class="carousel-item  active">
                    <img src="data:image;base64,<?php echo base64_encode($img1); ?>" alt="GFG1" />
                </div>
                <div class="carousel-item">
                    <img src="data:image;base64,<?php echo base64_encode($img2); ?>" alt="GFG2" />
                </div>
                <div class="carousel-item">
                    <img src="data:image;base64,<?php echo base64_encode($img3); ?>" alt="GFG3" />
                </div>
            </div>

            <a class="carousel-control-prev" href="#GFG" data-slide="prev">
                <span class="carousel-control-prev-icon">
                </span>
            </a>
            <a class="carousel-control-next" href="#GFG" data-slide="next">
                <span class="carousel-control-next-icon">
                </span>
            </a>
        </div>
    </div>
</body>

</html>