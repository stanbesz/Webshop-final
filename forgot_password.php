<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Stanimir Aleksandrov">
        <meta http-equiv="" content="30">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Stan's Company</title>
        <link rel="stylesheet" href="styles_boot/css/bootstrap.css" type="text/css" charset="utf-8">
        <link rel="shortcut icon" href="images/shop.svg">
        <link rel="stylesheet" href="css/bg_image.css" type="text/css" charset="utf-8">
    </head>
    <body class="bg-image">  
    <div class="container">
        <div class="container position-absolute top-50 start-50 p-5 translate-middle text-center bg-dark text-light min-vh-20 col-4" style="border-radius: 25px;">
                <svg xmlns="http://www.w3.org/2000/svg" height="170" style="color:#EB984E" fill="currentColor" class="bi bi-people img-fluid" viewBox="0 0 16 16">
                    <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                  </svg>
                <h1 class="h4 my-2 pt-2 font-weight-normal text-center border-top"> Enter email</h1>
            <form style="max-width:600" action="include/forgot_password_inc.php" method="post">
                <input type="email" id="emailAddress" name="emailAddress" class="form-control my-2" placeholder="Email Address" required autofocus>
                <hr />
                <button type="submit" name="reset_submit" class="btn btn-lg btn-primary btn-block mt-2 col-12" >Send link</button>
            </form>
            <p></p>
            <small class="mt-3" style="font-size: 15px; color:#C3C2C1">@Stan's Webshop</small>
        </div>
    </div>
        
        <script src="https://unpkg.com/@popperjs/core@2.4.0/dist/umd/popper.min.js"></script>
        <script src="styles_boot/js/bootstrap.js"></script>
        <script src="onClick_signup.js"></script>
      
    </body>
</html>