<?php
if(isset($_GET["error"])){
                        if($_GET["error"]=="empty"){
                            echo'<div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">';
                            echo'<strong>Empty textfield!</strong> Fill all the text fields!';
                            echo'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                            echo'</div>';
                        }
                        if($_GET["error"]=="noUser"){
                            echo'<div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">';
                            echo"<strong>No such user!</strong> This user does not exist!";
                            echo'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                            echo'</div>';
                        }
                        if($_GET["error"]=="wrongPass"){
                            echo'<div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">';
                            echo"<strong>Wrong password!</strong> Missmatching password and username!";
                            echo'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                            echo'</div>';
                        }
                        if($_GET["error"]=="none"){
                            echo "<script>alert('Successfull login!');";
                            echo "window.location.href='index.php';</script>";
                        }
                    }
                    if(isset($_GET["newPass"])){
                        if($_GET["newPass"]=="passUpdated"){
                            echo'<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">';
                            echo"<strong>Password changed! </strong>New password has been changed!";
                            echo'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                            echo'</div>';
                        }
                    }
                    if(isset($_GET["reset"])){
                        if($_GET["reset"]=="success"){
                            echo'<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">';
                            echo"<strong>Email sent</strong> Reset link has been sent to email!";
                            echo'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                            echo'</div>';
                        }
                        if($_GET["reset"]=="noemail"){
                            echo'<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">';
                            echo"<strong>No email!</strong> No such email found!";
                            echo'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                            echo'</div>';
                        }
                    }
                    if(isset($_GET["signup"])){
                        if($_GET["signup"]=="success"){
                            echo'<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">';
                            echo"<strong>Signup successful!</strong> Successfully created user profile!";
                            echo'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                            echo'</div>';
                        }
                    }