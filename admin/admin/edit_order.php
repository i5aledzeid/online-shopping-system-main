<?php
session_start();
include("../../db.php");

$order_id = $_REQUEST['order_id'];

$result = mysqli_query($con, "SELECT `order_id`, `user_id`, `f_name`, `email`, `address`, `city`, `state`, `zip`, `status`, `cardname`, `cardnumber`, `expdate`, `prod_count`, `total_amt`, `cvv` from orders_info  where order_id='$order_id'") or die("query 1 incorrect.......");

list($order_id, $product_type, $brand, $product_name, $price, $details, $state, $zip, $status, $cardname, $cardnumber, $expdate, $prod_count, $total_amt, $cvv) = mysqli_fetch_array($result);

if (isset($_POST['btn_save'])) {
  $status = $_POST['status'];
  mysqli_query($con, "UPDATE `orders_info` SET `status`='$status' WHERE `order_id` = '$order_id'") or die("Query 2 is inncorrect..........");
  header("location: salesofday.php");
  mysqli_close($con);
}
include "sidenav.php";
include "topheader.php";
?>

<!-- End Navbar -->
<div class="content">
  <div class="container-fluid">
    <form action="" method="post" type="form" name="form" enctype="multipart/form-data">
      <div class="row">

        <div class="col-md-5">
          <div class="card">
            <div class="card-header card-header-primary">
              <h5 class="title" style="text-align: right;">
                <?php echo '(' . $order_id . ')'; ?>
                تعديل الطلب برقم
              </h5>
            </div>
            <div class="card-body">

              <div class="row">

                <div class="col-md-12">
                  <div class="form-group">
                    <label>User Email / UID
                      <?php echo '[' . $product_type . ']'; ?>
                    </label>
                    <input type="text" id="product_name" required name="product_name"
                      value="<?php echo $product_name; ?>" class="form-control">
                  </div>
                </div>

                <!--<div class="col-md-4">
                  <img src='<?php echo "../../product_images/" . $pic_name ?>'
                    style='width:50px; height:50px; border:groove #000'>
                  <div class="">
                    <label for="">Add Image</label>
                    <input type="file" name="picture" class="btn btn-fill btn-success"
                      value="<?php echo "../../product_images/" . $pic_name ?>" id="picture">
                  </div>
                </div>-->

                <!--<div class="col-md-12">
                  <div class="form-group">
                    <label>Description</label>
                    <textarea rows="4" cols="80" id="details" required name="details"
                      class="form-control"><?php echo $details; ?></textarea>
                  </div>
                </div>-->

                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Address</label>
                      <input type="text" id="price" name="price" value="<?php echo $price ?>" required
                        class="form-control">
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label>City</label>
                      <input type="text" id="details" name="details" value="<?php echo $details ?>" required
                        class="form-control">
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label>State</label>
                      <input type="text" id="state" name="state" value="<?php echo $state ?>" required
                        class="form-control">
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Zip</label>
                      <input type="text" id="zip" name="zip" value="<?php echo $zip ?>" required class="form-control">
                    </div>
                  </div>

                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label>Card Name</label>
                    <input type="text" id="cardname" required name="cardname" value="<?php echo $cardname; ?>"
                      class="form-control">
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label>Card Number</label>
                    <input type="text" id="cardnumber" required name="cardnumber" value="<?php echo $cardnumber; ?>"
                      class="form-control">
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label>Expdate</label>
                    <input type="text" id="expdate" required name="expdate" value="<?php echo $expdate; ?>"
                      class="form-control">
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label>CVV</label>
                    <input type="text" id="cvv" required name="cvv" value="<?php echo $cvv; ?>" class="form-control">
                  </div>
                </div>

              </div>

            </div>

          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <div class="card-header card-header-primary">
              <h5 class="title" style="text-align: right;">التفاصيل الإضافية</h5>
            </div>
            <div class="card-body">

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">Status</label>
                    <select id="status" name="status" required class="form-control">
                      <option value="" style="color:black;">select Status</option>
                      <?php
                      //$result1 = mysqli_query($con, "SELECT * FROM `categories` ORDER BY `cat_id` ASC") or die("query 1 incorrect.....");
                      //while (list($cat_id, $cat_title) = mysqli_fetch_array($result1)) {
                      //if ($cat_id == $product_type) {
                      if ($status == 0) {
                        echo '<option value='.$status.' style="color:black;" selected>تم التأكيد</option>';
                        echo '<option value="1" style="color:black;">تم الشحن</option>';
                        echo '<option value="2" style="color:black;">تم الإلغاء</option>';
                        echo '<option value="3" style="color:black;">مكتمل</option>';
                      }
                      else if ($status == 1) {
                        echo '<option value='.$status.' style="color:black;" selected>تم الشحن</option>';
                        echo '<option value="0" style="color:black;">تم التأكيد</option>';
                        echo '<option value="2" style="color:black;">تم الإلغاء</option>';
                        echo '<option value="3" style="color:black;">مكتمل</option>';
                      }
                      else if ($status == 2) {
                        echo '<option value='.$status.' style="color:black;" selected>تم الإلغاء</option>';
                        echo '<option value="0" style="color:black;">تم التأكيد</option>';
                        echo '<option value="1" style="color:black;">تم الشحن</option>';
                        echo '<option value="3" style="color:black;">مكتمل</option>';
                      }
                      else if ($status == 3) {
                        echo '<option value='.$status.' style="color:black;" selected>مكتمل</option>';
                        echo '<option value="0" style="color:black;">تم التأكيد</option>';
                        echo '<option value="1" style="color:black;">تم الشحن</option>';
                        echo '<option value="2" style="color:black;">تم الإلغاء</option>';
                      }
                      //} else {
                      //echo "<option value='$status' style='color:black;'>$status</option>";
                      //}
                      //}
                      ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label>Product Count</label>
                    <input type="text" id="prod_count" required name="prod_count" value="<?php echo $prod_count; ?>"
                      class="form-control">
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label>Total Amount</label>
                    <input type="text" id="total_amt" required name="total_amt" value="<?php echo $total_amt; ?>"
                      class="form-control">
                  </div>
                </div>
                <!--<div class="col-md-12">
                  <div class="form-group">
                    <label for="">Product Category</label>
                    <select id="product_type" name="product_type" required class="form-control">
                      <option value="" style="color:black;">select Category</option>
                      <?php

                      $result1 = mysqli_query($con, "SELECT * FROM `categories` ORDER BY `cat_id` ASC") or die("query 1 incorrect.....");

                      while (list($cat_id, $cat_title) = mysqli_fetch_array($result1)) {

                        if ($cat_id == $product_type) {
                          echo "<option value='$cat_id' style='color:black;' selected>$cat_title</option>";
                        } else {
                          echo "<option value='$cat_id' style='color:black;'>$cat_title</option>";
                        }
                      }

                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">Product Type</label>
                    <select id="brand" name="brand" required class="form-control">
                      <option value="" style="color:black;">select Type</option>
                      <?php
                      $result2 = mysqli_query($con, "SELECT * FROM `brands`") or die("query 1 incorrect.....");

                      while (list($brand_id, $brand_title) = mysqli_fetch_array($result2)) {
                        if ($brand_id == $brand) {
                          echo "<option value='$brand_id' style='color:black;' selected>$brand_title</option>";
                        } else {
                          echo "<option value='$brand_id' style='color:black;'>$brand_title</option>";
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Product Keywords</label>
                    <input type="text" id="tags" name="tags" value="<?php echo $tags; ?>" required class="form-control">
                  </div>
                </div>-->
              </div>

            </div>
            <div class="card-footer">
              <button type="submit" id="btn_save" name="btn_save" required class="btn btn-fill btn-primary">Update
                Product</button>
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="card">
            <div class="card-header card-header-primary">
              <h5 class="title" style="text-align: right;">
                صور المنتجات / العدد
                <?php
                $order_id = $_REQUEST['order_id'];
                $sqli = "SELECT `product_id` FROM `order_products` WHERE order_id='$order_id'";
                $queryi = mysqli_query($con, $sqli);
                if (mysqli_num_rows($queryi) > 0) {
                  echo '(' . $numRowsi = mysqli_num_rows($queryi) . ')';
                }
                ?>
              </h5>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <?php
                    $order_id = $_REQUEST['order_id'];
                    $sqli = "SELECT `product_id` FROM `order_products` WHERE order_id='$order_id'";
                    $queryi = mysqli_query($con, $sqli);
                    if (mysqli_num_rows($queryi) > 0) {
                      $numRowsi = mysqli_num_rows($queryi);
                      while ($rowi = mysqli_fetch_array($queryi)) {
                        //echo $rowi['product_id'] . ' <br><br><br><br>';
                        //$sql="SELECT * FROM products";
                        /*$rowi['product_id'];
                        $sql="SELECT * FROM `products` WHERE product_id='$rowi'";
                        $query = mysqli_query($con, $sql);
                        if (mysqli_num_rows($query) > 0) {
                          $numRows = mysqli_num_rows($query);
                          while ($row=mysqli_fetch_array($query)) {
                            $product_image = $row["product_image"];
                            echo '
                              <img src="../../product_images/'.$product_image.'" style="width: 200px; height: 120px;" alt="photo">
                            ';
                            echo $order_id;
                          }
                        }*/
                      }
                    }
                    ?>

                    <?php
                    /*$query1 = "SELECT * FROM order_products where order_id = $order_id";
                    $run1 = mysqli_query($con, $query1);
                    while ($row1 = mysqli_fetch_array($run1)) {
                      $product_id = $row1['product_id'];
                      $query2 = "SELECT * FROM products where product_id = $product_id";
                      $run2 = mysqli_query($con, $query2);
                      while ($row2 = mysqli_fetch_array($run2)) {
                        $product_image = $row2['product_image'];
                        echo '
                        <img class="d-block w-100" src="../../product_images/' . $product_image . '" alt="Third slide">
                        ';
                      }
                    }*/
                    ?>


                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                      <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <?php
                          //$i = 1;
                          /*$order_id = $_REQUEST['order_id'];
                          $sqli = "SELECT `product_id` FROM `order_products` WHERE order_id='$order_id'";
                          $queryi = mysqli_query($con, $sqli);
                          if (mysqli_num_rows($queryi) > 0) {*/
                            // echo '(' . $numRowsi = mysqli_num_rows($queryi) . ')';
                            /*$numRowsi = mysqli_num_rows($queryi);
                            for ($i = 0; $i > $numRowsi; $i++) {
                              echo '<script>alert("hello")</script>';
                            }
                            echo '
                              <li data-target="#carouselExampleIndicators" data-slide-to="'.$i.'"></li>
                            ';
                          }*/
                        ?>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                      </ol>
                      <div class="carousel-inner">
                        <div class="carousel-item active">
                        <?php
                          $query1 = "SELECT * FROM order_products where order_id = $order_id LIMIT 1";
                          $run1 = mysqli_query($con, $query1);
                          while ($row1 = mysqli_fetch_array($run1)) {
                            $product_id = $row1['product_id'];
                            $query2 = "SELECT * FROM products where product_id = $product_id";
                            $run2 = mysqli_query($con, $query2);
                            while ($row2 = mysqli_fetch_array($run2)) {
                              $product_image = $row2['product_image'];
                              echo '
                                <img class="d-block w-100" src="../../product_images/products.jpg" alt="First slide">
                                <div class="carousel-caption d-none d-md-block">
                                  <!--<h5>Title 1</h5>
                                  <p>Subtitle</p>-->
                                </div>
                              ';
                            }
                          }
                        ?>
                        </div>
                          <?php
                          $query1 = "SELECT * FROM order_products where order_id = $order_id";
                          $run1 = mysqli_query($con, $query1);
                          $i = 1;
                          while ($row1 = mysqli_fetch_array($run1)) {
                            $product_id = $row1['product_id'];
                            $query2 = "SELECT * FROM products where product_id = $product_id";
                            $run2 = mysqli_query($con, $query2);
                            while ($row2 = mysqli_fetch_array($run2)) {
                              $product_image = $row2['product_image'];
                              $product_title = $row2['product_title'];
                              $product_price = $row2['product_price'];
                              echo '
                                <div class="carousel-item">
                                  <img class="d-block w-100" src="../../product_images/' . $product_image . '" alt="Third slide">
                                  <div class="carousel-caption d-none d-md-block">
                                    <h5 style="background: black; position: absolute; top: -16px; font-size: 12px;">' . $product_title . ' ' . $i++ . '</h5>
                                    <p style="background: black;">$'. $product_price .'</p>
                                  </div>
                                </div>
                              ';
                            }
                          }
                          ?>
                      </div>
                      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                        data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                        data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>


                    <!--<img src="assets/img/sidebar-3.jpg" style="width: 200px; height: 220px;" alt="photo">-->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </form>

  </div>
</div>
<?php
include "footer.php";
?>