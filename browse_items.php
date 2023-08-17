<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="author" content="Stanimir Aleksandrov">
  <meta http-equiv="" content="5">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stan's Company</title>
  <link rel="stylesheet" href="styles_boot/css/bootstrap.css" type="text/css" charset="utf-8">
  <link rel="stylesheet" href="css/body_style.css" type="text/css" charset="utf-8">
  <link rel="stylesheet" href="css/footer_style.css" type="text/css" charset="utf-8">
  <link rel="shortcut icon" href="images/shop.svg">
  <link rel="stylesheet" href="css/image_style.css">
</head>

<body class="bg-light" id="main">
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
    <div class="container-fluid align-middle">
      <button type="button" class="btn btn-outline-dark text-light border ms-2" onclick="openNav()">
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"></path>
        </svg>
        Menu
      </button>
      <a class="navbar-brand" href="index.php"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-house mx-3" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
          <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
        </svg>Stan's webshop</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav me-auto my-3 my-md-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
          <li class="nav-item me-1">
            <a class="nav-link " href="browse_items.php">Browse</a>
          </li>
          <?php
          if (isset($_SESSION["username"])) {
            echo '
           <li class="nav-item dropdown mb-1">
             <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
               User information
             </a>
             <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
               <li><a class="dropdown-item" href="user_info.php">Profile</a></li>';
            if (isset($_SESSION["manufacturer"])) {
              echo '
               <li><a class="dropdown-item" href="item_control.php">Item Control</a></li>';
            }
            echo '<li><hr class="dropdown-divider"></li>
               <li><a class="dropdown-item" href="logout.php">Logout</a></li>
             </ul>
           </li>';
          }?>
          <li class="nav-item d-flex right-align">
          </li>
        </ul>
        <form class="col me-2 " action="search.php" method="post">
          <div class="input-group mb-1 ">
            <button type="submit"  name="search" class="btn btn-secondary">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
              </svg>
            </button>
        <input type="text" class="form-control" name="text_search" placeholder="Enter item" aria-label="Input group example" aria-describedby="basic-addon1" required>
        </div>
        </form>
        <?php
        if (!isset($_SESSION["username"])) {
          echo ('
          <button type="button" onclick="location.href=\'login.php\'" class="btn btn-outline-success mt-0 me-1 my-1">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"></path>
          <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"></path>
          </svg>
          Login
          </button>
          <button type="button" onclick="location.href=\'signup.php\'"class="btn btn-danger mt-0 mx-1 my-1">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-door-open" viewBox="0 0 16 16">
          <path d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"></path>
          <path d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117zM11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5zM4 1.934V15h6V1.077l-6 .857z"></path>
          </svg>
          Signup
          </button>');}
          else{
            echo('<button type="button" class="btn btn-success mt-0 ms-1 my-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart2" viewBox="0 0 16 16" href="#">
              <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"></path>
            </svg>
            Checkout
          </button>');
          }
         ?>
          
      </div>
    </div>
  </nav>
  <p class="pt-5"></p>
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/navbar_vertical.css" type="text/css">
  <link rel="stylesheet" href="css/footer_style.css" type="text/css" charset="utf-8">
  <?php
  include_once "include/cart.php";
  ?>

  <div id="mySidebar" class="sidebar border-2 border-end" >
    <a href="javascript:void(0)" class="closebtn" style="display:none"></a>


  </div>

  <div class="container-fluid p-4 ps-5 pe-5 me-2 mx-auto">
    <div class="row me-auto">
      <div class="col-10 border-bottom border-3 m-1 display-6">Browse items:</div>

      <div class="col-1 display-6 m-1">

        <div class="btn-group btn-block">
          <button class="btn-block btn btn-lg btn-secondary dropdown-toggle flex-fill align-items-stretch" style="width:100;text-align:left;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Filter by
          </button>
          <style>
            .dropdown-menu li:hover {
              background-color: #e8e8e8;
            }
          </style>
          <ul class="dropdown-menu" style="cursor: pointer;">
            <a>
              <li class="py-1 ps-2 border-bottom" onclick="sortBy('newest');">Date - Newest</li>
            </a>
            <a>
              <li class="mt-1 ps-2 py-1 border-bottom" onclick="sortBy('oldest');">Date - Oldest</li>
            </a>
            <a>
              <li class="mt-1 ps-2 py-1 border-bottom" onclick="sortBy('expensive');">Price - Ascending</li>
            </a>
            <a>
              <li class="mt-1 ps-2 pt-1" onclick="sortBy('cheaper');">Price - Descending</li>
            </a>
          </ul>
          
        </div>

      </div>

    </div>
    <?php
    require_once "include/print_items.php";
    ?>
  </div>
  </div>
  </div>
  </div>
  </div>



</body>

<script src="js/navbar_vertical.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>
<script src="js/sort_method.js"></script>
<script src="js/browse_section.js"></script>
<?php
include_once "footer.php";
?>