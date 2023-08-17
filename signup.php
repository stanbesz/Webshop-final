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
    <body>
        <body class="bg-image">  
        <div class="container">
            <div class="container position-absolute top-50 start-50 p-5 translate-middle text-center bg-dark text-light col-4" style="border-radius: 25px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="170" height="170" style="color:#EB984E" fill="currentColor" class="mb-2 bi bi-person-square" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                    <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z"/>
                  </svg>
                <h1 class="h4 my-2 py-2 font-weight-normal text-center border-top "> Please Sign Up!</h1>


                <form style="max-width:600" action="include/signup.inc.php" method="post">
                   <div id="manuShow" style="display: none">
                        <input type="text" id="manufacturerName" name="manufacturerName" class="form-control my-2" placeholder="Manufacturer Name"/>
                    </div>
                    <input type="text" id="userName" name="userName" class="form-control my-2" placeholder="User Name" required autofocus>
                    <input type="email" id="emailAddress"  name="emailAddress" class="form-control my-2" placeholder="Email Address" required>
                    <input type="password" id="password" name="password" class="form-control my-2" placeholder="Password" required>
                    <input type="password" id="confirmPassword" name="confirmPassword" class="form-control my-2" placeholder="Confirm Password" required>
                    <label for="chkYes">
                        <input type="radio" id="chkManu" class="form-check-input" name="chkType" value="manufacturer" onclick="ShowHideDiv()" />
                        Manufacturer
                    </label>
                    <label for="chkNo">
                        <input type="radio" id="chkUser" class="form-check-input" name="chkType" value="user" onclick="ShowHideDiv()" checked/>
                        User
                    </label>
                    <hr />
                    <button type="submit" name="submit" class="btn btn-lg btn-danger btn-block col-12">Sign up</button>
                </form>
                <?php
                    if(isset($_GET["error"])){
                        if($_GET["error"]=="empty"){
                            echo'<div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">';
                            echo'<strong>Empty textfield!</strong> Fill all the text fields!';
                            echo'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                            echo'</div>';
                        }
                        else if($_GET["error"]=="invalidUsername"){
                            echo'<div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">';
                            echo'<strong>Invalid Username!</strong> The username can only contain numbers and letters.';
                            echo'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                            echo'</div>';
                            
                        }
                        else if($_GET["error"]=="userExists"){
                            echo'<div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">';
                            echo'<strong>Username/Email taken!</strong> Please choose another username/email!';
                            echo'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                            echo'</div>';
                        }
                        else if($_GET["error"]=="invalidEmail"){
                            echo'<div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">';
                            echo'<strong>Invalid Email!</strong> Please enter a valid email!';
                            echo'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                            echo'</div>';
                        }
                        
                    }
                ?>

                <h6 class="font-weight-normal mt-1" style="font-size:12px">Already registered? <a href="login.php">Click here!</a></h6>
                <p></p>
                <small class="mt-3" style="font-size: 15px; color:#C3C2C1">@Stan's Webshop</small>
            </div>
        </div>

        <script type="text/javascript">
            function checkMatch(){
               var pass = document.getElementById('password');
               var confPass = document.getElementById('confirmPassword');
               if(pass.value != confPass.value){
                   alert("Confirm Password and Password don't match!");
               }
            }
        </script>

        <script src="https://unpkg.com/@popperjs/core@2.4.0/dist/umd/popper.min.js"></script>
        <script src="styles_boot/js/bootstrap.js"></script>
        <script src="js/onClick_signup.js"></script>
        
    </div>
    </body>
</html>