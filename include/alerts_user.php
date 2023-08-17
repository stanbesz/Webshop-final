<?php
if (isset($_GET["error"])) {
    if ($_GET["error"] == "type") {
        echo '<div class="alert alert-warning alert-dismissible fade text-center show mt-3 mx-5" role="alert">';
        echo '<strong>Wrong type!</strong> User Image has the wrong file extension!';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    }
    if ($_GET["error"] == "error") {
        echo '<div class="alert alert-warning alert-dismissible fade text-center show mt-3 mx-5" role="alert">';
        echo "<strong>Error!</strong> There was an error with the image upload!";
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    }
    if ($_GET["error"] == "size") {
        echo '<div class="alert alert-warning alert-dismissible fade text-center show mt-3 mx-5" role="alert">';
        echo "<strong>Size too big!</strong> The image file size is too big!";
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    }
}
if (isset($_GET["upload"])) {
    if ($_GET["upload"] == "success") {
        echo '<div class="alert alert-success alert-dismissible fade text-center show mt-3 mx-5" role="alert">';
        echo "<strong>Image successfuly changed! </strong>User image has been changed!";
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    }
}
