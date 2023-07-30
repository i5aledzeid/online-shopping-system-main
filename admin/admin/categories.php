<?php
  session_start();
  include("../../db.php");

  include "sidenav.php";
  include "topheader.php";
?>

<style>
  table {
    direction: rtl;
  }

  table tbody {
    height: 300px;
    display: block;
    overflow-y: scroll;
  }

  table thead {
    display: block;
  }

  td, th {
    width: 50%;
    text-align: right;
  }
</style>
<!-- End Navbar -->
<div class="content">
  <div class="container-fluid">
    <div class="panel-body">
      <a>
        <?php //success message
        if (isset($_POST['success'])) {
          $success = $_POST["success"];
          echo "<div class='col-md-12 col-xs-12' id='product_msg'>
            <div class='alert alert-success'>
              <a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a>
              <b>Product is Added..!</b>
            </div>
          </div>";
        }
        ?>
      </a>
    </div>
    <div class="col-md-14">

    </div>
    <div class="row">

      <div class="col-md-6">
        <div class="card ">
          <div class="card-header card-header-primary">
            <h4 class="card-title" style="text-align: right;">
              قائمة العلامات التجارية
              <?php
                $sql = "SELECT * FROM `brands`";
                $query = mysqli_query($con, $sql);
                echo '('. $counter = mysqli_num_rows($query) . ')';
              ?>
              &nbsp;
              <i class="fa fa-th-large" aria-hidden="true"></i>
            </h4>
          </div>
          <div class="card-body">
            <div class="table-responsive ps">
              <table class="table table-hover tablesorter " id="">
                <thead class=" text-primary">
                  <tr>
                    <th>الرقم التسلسلي</th>
                    <th>العلامات التجارية</th>
                    <th>العدد</th>
                    <th>-</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $result = mysqli_query($con, "select * from brands") or die("query 1 incorrect.....");
                    $i = 1;
                    while (list($brand_id, $brand_title) = mysqli_fetch_array($result)) {

                      $sql = "SELECT COUNT(*) AS count_items FROM products WHERE product_brand=$i";
                      $query = mysqli_query($con, $sql);
                      $row = mysqli_fetch_array($query);
                      $count = $row["count_items"];
                      $i++;
                      echo "<tr><td>$brand_id</td><td>$brand_title</td><td>$count</td><td></td></tr>";
                    }
                  ?>
                </tbody>
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

      <div class="col-md-6">
        <div class="card ">
          <div class="card-header card-header-primary">
            <h4 class="card-title" style="text-align: right;">
              قائمة التصنيفات
              <?php
                $sql = "SELECT * FROM `categories`";
                $query = mysqli_query($con, $sql);
                echo '('. $counter = mysqli_num_rows($query) . ')';
              ?>
              &nbsp;
              <i class="fa fa-th-large" aria-hidden="true"></i>
            </h4>
          </div>
          <div class="card-body">
            <div class="table-responsive ps">
              <table class="table table-hover tablesorter " style='height:50px;overflow:auto;' id="">
                <thead class=" text-primary">
                  <tr>
                    <th>الرقم التسلسلي</th>
                    <th>التصنيفات</th>
                    <th>العدد</th>
                    <th>-</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $result = mysqli_query($con, "select * from categories") or die("query 1 incorrect.....");
                    $i = 1;
                    while (list($cat_id, $cat_title) = mysqli_fetch_array($result)) {
                      $sql = "SELECT COUNT(*) AS count_items FROM products WHERE product_cat=$i";
                      $query = mysqli_query($con, $sql);
                      $row = mysqli_fetch_array($query);
                      $count = $row["count_items"];
                      $i++;
                      echo "<tr><td>$cat_id</td><td>$cat_title</td><td>$count</td></td></tr></tr>";
                    }
                  ?>
                </tbody>
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
  //include "footer.php";
  ?>