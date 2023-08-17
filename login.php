<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Stanimir Aleksandrov">
        <meta http-equiv="" content="30">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Stan's Company</title>
        <link rel="stylesheet" href="styles_boot/css/bootstrap.css" type="text/css" charset="utf-8">
        <link rel="stylesheet" href="css/bg_image.css" type="text/css" charset="utf-8">
        <link rel="shortcut icon" href="images/shop.svg">
    </head>
    <body class="bg-image">  
    <div class="container">
        <div class="container position-absolute top-50 start-50 p-5 translate-middle text-center bg-dark text-light col-4" style="border-radius: 25px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="170" height="170" fill="currentColor" style="color:#EB984E" class="bi bi-shop pb-2 img-fluid" viewBox="0 0 16 16">
                <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z"/>
            </svg>
            <h1 class="h4 my-2 pt-2 font-weight-normal text-center border-top"> Please Log in!</h1>
            <form style="max-width:600" action="include/login.inc.php" method="post">
                <input type="text" id="user" name="user" class="form-control my-2" placeholder="Email Address/Username" required autofocus>
                <input type="password" id="password" name="password" class="form-control my-2" placeholder="Password" required>
                <hr>
                <button type="submit" name="submit" class="btn btn-lg btn-primary btn-block col-12">Log in</button>
            </form>
            <?php
            include_once "include/alerts_login.php";
                ?>
            <div class="row my-3">
                <div class="col-6" style="font-size: 12px;"><a href="forgot_password.php">Forgot your password?</a></div>
                <div class="col-6 text-right" style="font-size: 12px;" ><a href="signup.php">Don't have an account?</a></div>
            </div>
            <small class="mt-3" style="font-size: 15px; color:#C3C2C1">@Stan's Webshop</small>
        </div>
    </div>

        <script src="https://unpkg.com/@popperjs/core@2.4.0/dist/umd/popper.min.js"></script>
        <script src="styles_boot/js/bootstrap.js"></script>
      
    </body>
</html>