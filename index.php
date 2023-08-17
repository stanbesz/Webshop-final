<?php
include_once 'header.php';
//session_start();
if (isset($_GET["purchase"])) {
  if ($_GET["purchase"] == "success") {
    echo '<div class="container text-center">';
    echo '<div class="row">';
    echo '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">';
    echo "<strong>Purchase completed! </strong> Thank you for your purchase!";
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
  }
}
if (isset($_GET["login"])) {
  if ($_GET["login"] == "checkUser") {
    echo '<div class="container text-center">';
    echo '<div class="row">';
    echo '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">';
    echo "<strong>Login successful! </strong> Logged in as a user!";
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
  }
  if ($_GET["login"] == "checkManu") {
    echo '<div class="container text-center">';
    echo '<div class="row">';
    echo '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">';
    echo "<strong>Login successful! </strong> Logged in as a manufacturer!";
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
  }
}
include_once "include/cart.php";
?>
<script></script>
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet">

<link rel="stylesheet" href="fonts/icomoon/style.css">

<link rel="stylesheet" href="css/owl.carousel.min.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/image_style.css">
<h2 class="display-1 text-center pb-2 mx-5" style="box-shadow: 0 6px 2px -2px rgb(211, 207, 207);">Welcome to Stan's webshop!</h2>
<body class="bg-light" style="margin-top:80px;">
<div class="container">
  <div id="carouselExampleIndicators" class="carousel slide py-2" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <a href="#Chairs"><img src="images/resized_gaming_chairs.jpeg" class="d-block w-100 h-100 img-fluid" alt="Old chairs"></a>
        <div class="carousel-caption d-none d-md-block">
        <h5 class= "display-3" style="font-size:32px; color:#fafcff;"><strong>Chairs</strong></h5>
        <p class= "text-light" >Click here to see all chairs on sale!</p>
      </div>
      </div>
      <div class="carousel-item">
        <a href="#Video Cards"><img src="images/computer.jpg" class="d-block w-100 h-100 img-fluid" alt="Video Cards"></a>
        <div class="carousel-caption d-none d-md-block">
        <h5 class= "display-3" style="font-size:32px; color:#fafcff;"><strong>Video cards</strong></h5>
        <p class= "text-light" >Click here to see all video cards on sale!</p>
      </div>
      </div>
      <div class="carousel-item">
        <a href="#Drinking Cups"><img src="images/resized_cups.jpeg" class="d-block w-100 h-100 img-fluid" alt="Cups"></a>
        <div class="carousel-caption d-none d-md-block">
        <h5 class= "display-3" style="font-size:32px; color:#fafcff;"><strong>Drinking Cups</strong></h5>
        <p class= "text-light" >Click here to see all drinking cups on sale!</p>
      </div>
      </div>
      <div class="carousel-item">
        <a href="#Stuffed Animals"><img src="images/resized_stuffed_animals.jpeg" class="d-block w-100 h-100 img-fluid" alt="Stuffed Animals"></a>
        <div class="carousel-caption d-none d-md-block">
        <h5 class= "display-3" style="font-size:32px; color:#fafcff;"><strong>Stuffed animals</strong></h5>
        <p class= "text-dark" >Click here to see all stuffed animals on sale!</p>
      </div>
      </div>
      <div class="carousel-item">
        <a href="#Beauty Products"> <img src="images/beauty_products.jpg" class="d-block w-100 h-100 img-fluid" alt="Beauty Products"></a>
        <div class="carousel-caption d-none d-md-block">
        <h5 class= "display-3" style="font-size:32px; color:#edc98c;"><strong>Beauty products</strong></h5>
        <p class= "text-light" >Click here to see all beauty products on sale!</p>
      </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>
<h3 class="display-6 left-aligned ps-5 ms-5 me-5 mx-auto pb-1 border-bottom border-3 ">Browse items on sale!</h3>
<div class="container">
<?php
  include_once "include/print_in_home.php";
  print_items_index();
  ?>
</div>
</body>
<script src="https://unpkg.com/@popperjs/core@2.4.0/dist/umd/popper.min.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>
<?php
include_once 'footer.php';
