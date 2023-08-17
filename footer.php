<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <form  method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Shopping cart</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="container border border-3 p-3">
            <div class="table-responsive border border-2">
              <table class="table table-striped table-hover">
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
                    <th scope="col" width="10%">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $total = 0;
                  if (!empty($_SESSION['shopping_cart'])) {
                    $i = 0;
                    foreach ($_SESSION['shopping_cart'] as $key => $product) {
                      $i++;
                        
                  ?>

                      <tr>

                        <td class="align-middle"><?= $i; ?></td>
                        <td class="align-middle"><img><img src="<?= $product['image']; ?>" class="img-thumbnail" style="width:100px; height:60px;" alt="User Photo"></img></td>
                        <td class="align-middle"><?= $product['name']; ?></td>
                        <td class="align-middle"><?= $product['company_name']; ?></td>
                        <td class="align-middle"><?= date("Y-m-d");; ?></td>
                        <td class="align-middle"><?= number_format((float)$product['price'], 2, '.', '') . ' лв.'; ?></td>
                        <td class="align-middle text-center"><?= $product['item_amount']; ?></td>
                        <td class="align-middle"><?= number_format((float)($product['price'] * $product['item_amount']), 2, '.', '') . ' лв.'; ?></td>
                        <td class="align-middle"><button class="btn btn-danger p-1" name="remove_item" value="<?= $product['id']; ?>"> Remove</button></td>
                        <input type="hidden" name="image[]" value="<?php echo $product["name"];?>">
                        <input type="hidden" name="company_name[]" value="<?php $product["company_name"];?>">
                        <input type="hidden" name="product_price[]" value="<?php echo $product["price"];?>">
                        <input type="hidden" name="products_amount[]" value="<?php echo $product["item_amount"];?>">

                      </tr>
                  <?php
                      $total = $total + ($product["item_amount"] * $product["price"]);
                    }
                   
                  }
                  $_SESSION['total_sum']=$total;
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
                  <td></td>
                  <input type="hidden" name="total_sum" value="<?php echo $total;?>">
                </tfoot>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="checkout_cart" formaction="/try_stripe/create-checkout-session.php" class="btn btn-success" style="font-size:22px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-cart-check" viewBox="0 0 20 20">
              <path d="M11.354 6.354a.5.5 0 0 0-.708-.708L8 8.293 6.854 7.146a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z" />
              <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
            </svg>Checkout</button>
        </div>
      </div>
    </form>
  </div>
</div>
<footer class="text-center text-lg-start bg-light text-muted">
  <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
    <div class="mx-5 ps-5 d-none d-lg-block">
      <span>Get connected with me on social networks:</span>
    </div>
    <div>
      <a href="https://www.facebook.com/stanimir.alexandrov" class="me-4 text-reset" id="link_group">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
          <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
        </svg>
      </a>
      <a href="https://www.linkedin.com/in/stanimir-aleksandrov-2aa7a51b7/" class="me-4 text-reset" id="link_group">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
          <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z" />
        </svg>
      </a>
      <a href="https://github.com/stanbesz" class="me-4 text-reset" id="link_group">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
          <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z" />
        </svg>
      </a>
      <a href="https://www.twitch.tv/stane_sz" class="me-4 text-reset" id="link_group">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitch" viewBox="0 0 16 16">
          <path d="M3.857 0 1 2.857v10.286h3.429V16l2.857-2.857H9.57L14.714 8V0H3.857zm9.714 7.429-2.285 2.285H9l-2 2v-2H4.429V1.143h9.142v6.286z" />
          <path d="M11.857 3.143h-1.143V6.57h1.143V3.143zm-3.143 0H7.571V6.57h1.143V3.143z" />
        </svg>
      </a>
      <style>
        #link_group {
          text-decoration: none;
        }
      </style>
    </div>
  </section>
  <section class="">
    <div class="container text-center text-md-start mt-5">

      <div class="row mt-3">

        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">

          <h6 class="text-uppercase fw-bold mb-4">
            <i class="fas fa-gem me-3"></i>Company name
          </h6>
          <p>
            This website is done as a final project from a university student.
          </p>
        </div>



        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

          <h6 class="text-uppercase fw-bold mb-4">
            Useful links
          </h6>
          <p>
            <a href="#!" class="text-reset">About us</a>
          </p>
          <p>
            <a href="#!" class="text-reset"></a>
          </p>
        </div>



        <div class="col-md-3 col-lg-2 col-xl-3 mx-auto mb-md-0 mb-4">

          <h6 class="text-uppercase fw-bold ms-3 mb-4">
            Contact
          </h6>
          <p><i class="fas fa-home me-3"></i> Sofia, Bulgaria</p>
          <p>
            <i class="fas fa-envelope me-3"></i>
            201217054@fdiba.tu-sofia.bg
          </p>
          <p><i class="fas fa-phone me-3"></i> +359 89 54 11 678</p>
        </div>

      </div>

    </div>
  </section>



  <div class="text-center text-light bg-dark p-4">
    Author Stanimir Aleksandrov
    <a class="text-reset fw-bold" href="https://www.linkedin.com/in/stanimir-aleksandrov-2aa7a51b7/">Check me out</a>
  </div>
  <script src="https://unpkg.com/@popperjs/core@2.4.0/dist/umd/popper.min.js"></script>
  <script src="styles_boot/js/bootstrap.min.js"></script>

</footer>

</html>