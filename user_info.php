<?php
include_once 'header.php';
?>
<link rel="stylesheet" href="css/change_pic.css" type="text/css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="css/change_filter_row.css" type="text/css">
<link rel="stylesheet" src="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" type="text/css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>


<h6 class="display-6 mt-5 mx-5 ps-3 pt-3 pb-1 border-bottom border-2">Profile Information</h6>
<?php
include_once "include/alerts_user.php";
?>
<div class="container justify-content-center">
  <div class="row ">
    <div class="col-6">
      <?php
      $user_id = $_SESSION['user_id'];
      require_once 'include/connection.php';

      $sql = "SELECT COUNT(trans_id) AS SumTrans FROM transactions WHERE user_id=?";
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_error($stmt);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../user_info.php?error=dbaccessFailed");
        die("mysqli_stmt_prepare() failed:" . mysqli_stmt_error($stmt));
      }

      mysqli_stmt_bind_param($stmt, "i", $user_id);
      mysqli_stmt_execute($stmt);

      $resultData = mysqli_stmt_get_result($stmt);
      $row = mysqli_fetch_assoc($resultData);
      $count_trans = $row['SumTrans'];
      mysqli_stmt_close($stmt);

      $sql = "SELECT SUM(item_price * item_amount) As SumPrice FROM transactions WHERE user_id=?";
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_error($stmt);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../user_info.php?error=dbaccessFailed");
        die("mysqli_stmt_prepare() failed:" . mysqli_stmt_error($stmt));
      }

      mysqli_stmt_bind_param($stmt, "i", $user_id);
      mysqli_stmt_execute($stmt);
      $resultData = mysqli_stmt_get_result($stmt);
      $row = mysqli_fetch_assoc($resultData);
      $sum_user = number_format($row['SumPrice'], 2);
      mysqli_stmt_close($stmt);
      $sql = "SELECT image_path FROM profile_images WHERE user_id=?";
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_error($stmt);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../user_info.php?error=dbaccessFailed");
        die("mysqli_stmt_prepare() failed:" . mysqli_stmt_error($stmt));
      }

      mysqli_stmt_bind_param($stmt, "i", $user_id);
      mysqli_stmt_execute($stmt);
      $resultData = mysqli_stmt_get_result($stmt);

      if ($row = mysqli_fetch_assoc($resultData)) {
        echo ('<img src= ' . $row["image_path"] . ' class="img-thumbnail float-end" style="width:250px; height:250px;" alt="User Photo">');
      } else {
        echo ('<img src="images/profile_images/default_picture.jpg" class="img-thumbnail float-end" style="width:250px; height:250px;" alt="User Photo">');
      }

      mysqli_stmt_close($stmt);
      $sql = "SELECT date FROM users WHERE user_id=?";
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_error($stmt);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../user_info.php?error=dbaccessFailed");
        die("mysqli_stmt_prepare() failed:" . mysqli_stmt_error($stmt));
      }
      mysqli_stmt_bind_param($stmt, "i", $user_id);
      mysqli_stmt_execute($stmt);
      $resultData = mysqli_stmt_get_result($stmt);
      $row = mysqli_fetch_assoc($resultData);
      $date = $row['date'];
      echo ('
      <div class="row col-12 text-end align-text-bottom me-5 pe-5">
      <h6 class="display-6 text-end align-text-bottom mt-1" style="font-size:16px;"><a href="#" data-bs-toggle="modal" data-bs-target="#pictureModal">Change picture  </a></h6>
      </div>
    </div>
    <div class="col-6 justify-start border-3 border-start">
      <div class="row justify-content-center text-start pt-2 ">
        <h6 class="display-6" style="font-size:26px ;">Username: <b>  ' . $_SESSION["username"] . '</b> </h6>
      </div>
      <div class="row justify-content-center text-start ">
        <h6 class="display-6" style="font-size:26px ;">Email: <b>' . $_SESSION['email'] . ' </b> </h6>
      </div>
      <div class="row justify-content-center text-start">
        <h6 class="display-6" style="font-size:26px ;">Joined on: <b>' . $date . '</b> </h6>
      </div>
      <div class="row justify-content-center text-start">
        <h6 class="display-6" style="font-size:26px ;">Profile status: <b>');
      if (empty($_SESSION["manufacturer"])) {
        echo "Users";
      } else {
        echo "Manufacturer";
      }
      echo ('</b> </h6>
      </div>
      <div class="row justify-content-center text-start">
        <h6 class="display-6" style="font-size:26px ;">Transactions count: <b>' . $count_trans . ' </b> </h6>
      </div>
      <div class="row justify-content-center text-start pb-2">
        <label class="display-6" style="font-size:26px ;">Money spent: <b> ' . $sum_user . ' лв.</b></label>
      </div>
    </div>'); ?>
    </div>
  </div>

  <div class="modal fade" id="pictureModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Change Profile Picture</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          <form action="user_info_form.php" method="post" enctype="multipart/form-data">
            <div class="img-thumbnail rounded align-middle justify-content-center text-middle border border-3 mb-3 mx-auto" id="imagePreview">
              <img src="" alt="Image Preview" id="image_preview_image">
              <span class="display-6" id="default_text">Image Preview</span>
            </div>
            <input type="file" class="mb-2" name="imageInp" id="imageInp">
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" id="saveImg" name="submit_image">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <h6 class="display-6 mx-5 my-3 ps-3 pb-1 border-top border-bottom border-2">Transactions</h6>

  <div class="container border border-3 p-3 pb-1 mb-3 table-responsive" >
    <table class="table table-striped table-hover border-top" id="user_table" style="width:100%;">
      <thead>
        <tr>
          <th scope="col" width="5%">№</th>
          <th scope="col" width="10%">Picture</th>
          <th scope="col" width="30%">Product</th>
          <th scope="col" width="15%">Company name</th>
          <th scope="col" width="10%">Date</th>
          <th scope="col" width="10%">Price</th>
          <th scope="col" width="10%">Amount</th>
          <th scope="col" width="15%">Cost</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM transactions AS trans
                    LEFT JOIN items ON trans.item_id=items.item_id
                    LEFT JOIN manufacturers AS man ON man.manu_id=items.manu_id
                    LEFT JOIN item_images ON items.item_id=item_images.item_id
                    Where trans.user_id=?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_error($stmt);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("location: ../user_info.php?error=dbaccessFailed");
          die("mysqli_stmt_prepare() failed:" . mysqli_stmt_error($stmt));
        }
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        $total = 0;
        $i = 0;
        while ($row = mysqli_fetch_assoc($resultData)) {
          $i++;
          $image = 0;
          if (!$row['image_path']) {
            $image = "../images/no_image_found.png";
          } else {
            $image = $row['image_path'];
          }
        ?>
          <tr>
            <td class="align-middle"><?= $i; ?></td>
            <td class="align-middle"><img src="<?= $image; ?>" class="img-thumbnail" 
            style="width:100px; height:60px;" alt="User Photo"></img></td>
            <td class="align-middle"><?= $row['name']; ?></td>
            <td class="align-middle"><?= $row['company_name']; ?></td>
            <td class="align-middle"><?= $row['trans_date']; ?></td>
            <td class="align-middle"><?= number_format((float)$row['item_price'], 2,'.','').' лв.';?></td>
            <td class="align-middle text-center"><?= $row['item_amount']; ?></td>
            <td class="align-middle"><?= number_format((float)($row['item_price']
             * $row['item_amount']),2,'.','').' лв.';?></td>
          </tr>
        <?php
          $total = $total + ($row['item_amount'] * $row['item_price']);
        }


        ?>
      <tfoot>
        <th scope="row"></th>
        <td colspan="5"></td>
        <td>Total:</td>
        <td><?php if (!isset($total)) {
              echo "0.00 лв.";
            } else {
              echo number_format((float)$total, 2, '.', '') . ' лв.';
            } ?></td>
      </tfoot>
      </tbody>
    </table>
  </div>
  <script type="text/javascript" class="init">
    $(document).ready(function() {
      $('#user_table').DataTable();
    });
  </script>

  </body>
  <?php
  include_once 'footer.php';
  ?>
  <script src="js/change_pic.js"></script>