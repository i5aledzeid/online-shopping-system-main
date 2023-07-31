<?php
session_start();
include("./includes/db.php");

error_reporting(0);
if (isset($_GET['action']) && $_GET['action'] != "" && $_GET['action'] == 'delete') {
  $order_id = $_GET['order_id'];

  /*this is delet query*/
  mysqli_query($con, "delete from orders where order_id='$order_id'") or die("delete query is incorrect...");
}

///pagination
$page = $_GET['page'];

if ($page == "" || $page == "1") {
  $page1 = 0;
} else {
  $page1 = ($page * 10) - 10;
}

include "sidenav.php";
include "topheader.php";

$query = "SELECT * FROM orders_info";
$run = mysqli_query($con, $query);

$queryi = "SELECT * FROM products";
$runi = mysqli_query($con, $queryi);
?>
<style>
  tr {
    text-align: center;
  }
  td {
    text-align: center;
  }
  option {
    text-align: right;
  }
</style>
<!-- End Navbar -->
<div class="content">
  <div class="container-fluid">
    <!-- your content here -->
    <div class="col-md-14">
      <div class="card ">
        <div class="card-header card-header-primary">
          <h4 class="card-title" style="text-align: right;">
            <a href="index.php" style="font-weight: bold; color: #EE4C16;">
            <i class="fa fa-home" aria-hidden="true"></i>
            الرئيسية</a> / <a href="">المبيعات</a>
            <?php echo $page; ?>
          </h4>
        </div>
        <div class="card-body">
        <?php
          if (mysqli_num_rows($run) > 0) {
          echo '
            <div class="table-responsive ps">
              <table class="table table-hover tablesorter " id="">
                <thead class=" text-primary">
                  <tr>
                    <th>الرقم<br>التسلسلي<br>للطلب</th>
                    <th>المنتجات</th>
                    <th>الصورة</th>
                    <th>اتصال | البريد الإلكتروني</th>
                    <th>العنوان</th>
                    <th>القيمة</th>
                    <th>العدد</th>
                    <th>الحالة</th>
                    <th>العمليات</th>
                  </tr>
                </thead>';
              }
          ?>
              <tbody>
                <?php
                
                if (mysqli_num_rows($run) > 0) {
                  while ($row = mysqli_fetch_array($run)) {
                    $order_id = $row['order_id'];
                    $email = $row['email'];
                    $address = $row['address'];
                    $total_amount = $row['total_amt'];
                    $user_id = $row['user_id'];
                    $qty = $row['prod_count'];
                    $status = $row['status'];

                    ?>
                    <tr>
                      <td><?php echo $order_id ?></td>
                      <td>
                        <?php
                        $query1 = "SELECT * FROM order_products where order_id = $order_id";
                        $run1 = mysqli_query($con, $query1);
                        while ($row1 = mysqli_fetch_array($run1)) {
                          $product_id = $row1['product_id'];

                          $query2 = "SELECT * FROM products where product_id = $product_id";
                          $run2 = mysqli_query($con, $query2);

                          while ($row2 = mysqli_fetch_array($run2)) {
                            $product_title = $row2['product_title'];
                            $product_image = $row2['product_image'];
                            ?>
                            
                            <?php echo $product_title ?><br>
                          <?php }
                        } ?>
                      </td>
                      <td><?php echo '<img style="width: 64px;" src="../../product_images/' . $product_image . '" alt="d">'?></td>
                      <td><?php echo $email ?></td>
                      <td><?php echo $address ?></td>
                      <td><?php echo $total_amount ?></td>
                      <td><?php echo $qty ?></td>
                      <td>
                        <div class="form-group">
                          <select id="product_type" name="product_type" disabled required class="form-control">
                            <option value="" style="color:black;">select Category</option>
                            <?php
                            if ($status == 0) {
                              echo '<option value=' . $cat_id . ' style="color:black;" selected>تم التأكيد</option>';
                            } else if ($status == 1) {
                              echo '<option value=' . $cat_id . ' style="color:black;" selected>تم الشحن</option>';
                            } else if ($status == 2) {
                              echo '<option value=' . $cat_id . ' style="color:black;" selected>تم الإلغاء</option>';
                            } else if ($status == 3) {
                              echo '<option value=' . $cat_id . ' style="color:black;" selected>مكتمل</option>';
                            }
                            ?>
                          </select>
                        </div>
                      </td>
                      <td>
                        <a href="edit_order.php?order_id=<?php echo $order_id ?>">
                          <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>&nbsp;&nbsp;&nbsp;
                        <a>
                          <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                      </td>
                    </tr>
                  <?php } ?>

                </tbody>
              <?php
                } else {
                  //echo "<center><br><br><h2>No users Available</h2><br><hr></center>";
                  echo "<center><br><br><br><br><br><br><h2>لا توجد بيانات متوفرة</h2><br><br><br><br><br><br></center>";
                }
                ?>
            </table>

            <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
              <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
            </div>
            <div class="ps__rail-y" style="top: 0px; right: 0px;">
              <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
<?php
include "footer.php";
?>