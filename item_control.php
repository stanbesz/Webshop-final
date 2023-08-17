<?php
include_once 'header.php';
if (empty($_SESSION["manufacturer"])) {
  header("location: ../index.php");
}
?>
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet">

<link rel="stylesheet" href="fonts/icomoon/style.css">

<link rel="stylesheet" href="css/owl.carousel.min.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/change_pic.css" type="text/css">
<link rel="stylesheet" href="css/footer_style.css" type="text/css" charset="utf-8">
<link rel="stylesheet" href="css/content_style.css" type="text/css" charset="utf-8">-->
<link rel="stylesheet" href="css/image_style.css">


<div class="container mt-5" id="container_switch">
  <div class="row border-bottom border-3 border-dark">
    <div class="col">
      <h6 class="display-6" style="font-size: 36px;">Item Control</h6>
    </div>
    <div class="col-md-auto">
      <div class="btn-group" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-lg btn-primary me-1" style="font-size: 16px;" id="insertionBtn" onclick="showBlock('insert')">Insert Item</button>
        <button type="button" class="btn btn-lg btn-primary me-1" style="font-size: 16px;" id="promotionBtn" onclick=" showBlock('promo')">Set Promotions</button>
        <button type="button" class="btn btn-lg btn-primary" style="font-size: 16px;" id="removeBtn" onclick="showBlock('remove')">Remove Items</button>
      </div>

    </div>
  </div>
  <div class="row text-center mt-3">
    <?php
    include_once "include/alerts.php";

    ?>
  </div>

  <div class="content_items">
    <div id="content_wrap">
      <div class="container" id="insertContainer" style="display: none;">
        <div class="row border-3 pt-3 border-dark text-center justify-content-center">


          <h6 class="display-6 border-bottom border-3" style="font-size: 36px;">Insert Item:</h6>
          <form class="row g-2 justify-content-center align-middle" enctype="multipart/form-data" action="include/insert_item.php" method="post" id="insertForm">

            <div class="col-4">
              <div class="border-3 border-end">
                <div class="img-thumbnail rounded align-middle d-flex justify-content-center text-middle border border-3 mb-3 mx-auto" style="width:360px; height:260px;" id="imagePreview">
                  <img src="" alt="Image Preview" id="image_preview_image" style="width:350px; height:250px;">
                  <span class="display-6" id="default_text">Image Preview</span>
                </div>
                <input type="file" class="ms-5 ps-4" name="imageInp" id="imageInp">
              </div>
            </div>

            <div class="col-6 ps-2 my-auto align-middle">
              <div class="mb-2">
                <input class="form-control" list="datalistOptions" id="typeDataList" name="typeDataList" placeholder="Item type">
                <datalist id="datalistOptions" name="datalistOptions">
                  <option value="Chairs">
                  <option value="Beauty Products">
                  <option value="Video Cards">
                  <option value="Stuffed Animals">
                  <option value="Drinking Cups">
                </datalist>
              </div>

              <div class="mb-2">
                <input type="text" class="form-control" name="item_name" placeholder="Item's name" aria-label="Item's name" aria-describedby="basic-addon2">
              </div>

              <div class="mb-2">
                <input type="number" min="0" class="form-control" name="item_price" step=".01" placeholder="Item's price in BGN" aria-label="Item's price" aria-describedby="basic-addon2">
              </div>

              <div class="mb-2">
                <input type="number" min="0" class="form-control" name="item_amount" placeholder="Amount" aria-label="Item's amount" aria-describedby="basic-addon2">
              </div>
              <div class="d-grid gap-2 col-6 mx-auto">
                <button type="submit" name="insert_item" class="btn btn-outline-primary">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="container" id="promoContainer" style="display: none;">
        <div class="row border-3 pt-3 border-dark text-center justify-content-center">
          <h6 class="display-6 border-bottom border-3 " style="font-size: 36px;">Promotions:</h6>
        </div>
        <div class="row mt-2">
          <?php

          include_once "include/print_promotion_items.php";
          print_promo_items(); ?>
        </div>
      </div>
      <div class="container" id="removeContainer" style="display: none;">
        <div class="row border-3 pt-3 border-dark text-center justify-content-center">
          <h6 class="display-6 border-bottom border-3 " style="font-size: 36px;">Remove Items:</h6>
        </div>

        <div class="row mt-2">
          <?php

          require "include/connection.php";
          include_once "include/print_remove_items.php";

          print_remove_items($conn); ?>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
<?php
include_once 'footer.php';
?>
<script src="https://unpkg.com/@popperjs/core@2.4.0/dist/umd/popper.min.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/main.js"></script>
<script src="js/change_pic.js"></script>
<script src="js/change_controls.js"></script>