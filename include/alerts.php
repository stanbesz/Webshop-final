<?php

if (isset($_GET["upload"])) {
    if ($_GET["upload"] == "success") {
        echo '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">';
        echo "<strong>Item Uploaded! </strong>New item has been successfully uploaded!";
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    }
}
if (isset($_GET["success"])) {
    if ($_GET["success"] == "noImage") {
        echo '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">';
        echo "<strong>Item Uploaded! </strong> New item has been successfully uploaded with no picture!";
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    }
    if ($_GET["success"] == "promoSet") {
        echo '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">';
        echo "<strong>Discount Set! </strong> A discount has been set for an item with id=".$_GET['id']." !";
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    }
    if ($_GET["success"] == "promoUnset") {
        echo '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">';
        echo "<strong>Discount Unset! </strong> A discount has been removed for an item with id=".$_GET['id']." !";
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    }
}
if (isset($_GET['deleted'])) {
    if ($_GET["deleted"] == "amountReduced") {
        echo '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">';
        echo "<strong>Amount reduced! </strong>An item with id:" . $_GET['id'] . " has it's amount reduced!";
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    }
    if ($_GET["deleted"] == "itemsDeleted") {
        echo '<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">';
        echo "<strong>Item Deleted! </strong>An item with id:" . $_GET['id'] . " has been successfully deleted!";
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    }
}
if (isset($_GET["error"])) {
    if ($_GET["error"] == "emptyInputItem") {
        echo '<div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">';
        echo "<strong>Empty input! </strong>All text fields should be filled!";
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    }
    if ($_GET["error"] == "emptyInput") {
        echo '<div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">';
        echo "<strong>Empty input! </strong>Empty text field in remove amount!";
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    }
    if ($_GET["error"] == "emptyInputPromo") {
        echo '<div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">';
        echo "<strong>Empty percentage input! </strong>No percantage in percent field!";
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    }

    
}
