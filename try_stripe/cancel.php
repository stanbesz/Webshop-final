<html>

<head>
  <meta charset="UTF-8">
  <meta name="author" content="Stanimir Aleksandrov">
  <meta http-equiv="" content="30">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stan's Company</title>
  <link rel="stylesheet" href="../styles_boot/css/bootstrap.css" type="text/css" charset="utf-8">
  <link rel="stylesheet" href="../css/bg_image.css" type="text/css" charset="utf-8">
  <link rel="shortcut icon" href="../images/shop.svg">
</head>

<body class="bg-image">
  <div class="container">
    <?php
    session_start();
    unset($_SESSION['in_checkout']);
    ?>
    <div class="container position-absolute top-50 start-50 p-5 mb-5 translate-middle text-center bg-dark text-light col-4" style="border-radius: 25px;">
      <svg xmlns="http://www.w3.org/2000/svg" width="250" height="250" style="color:#EB984E" fill="currentColor" fill="currentColor" class="bi bi-bag-plus-fill" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zM8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5V8z" />
      </svg>
      <h1 class="h4 my-2 mt-5 pt-2 font-weight-normal text-center border-top"> Need to add more stuff?</h1>
      <div class="row pb-3 mt-3 border-bottom"><button type="button" class="btn btn-primary" onclick="location.href='../index.php';">Back to Start</button></div>
      <small class="mt-5" style="font-size: 15px; color:#C3C2C1">@Stan's Webshop</small>
    </div>
  </div>

  <script src="https://unpkg.com/@popperjs/core@2.4.0/dist/umd/popper.min.js"></script>
  <script src="styles_boot/js/bootstrap.js"></script>

</body>

</html>