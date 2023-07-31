<?php
session_start();
include("../../db.php");
if (isset($_GET['action']) && $_GET['action'] != "" && $_GET['action'] == 'delete') {
  $user_id = $_GET['user_id'];

  /*this is delet quer*/
  mysqli_query($con, "delete from stores where id='$user_id'") or die("query is incorrect...");
}

include "sidenav.php";
include "topheader.php";
?>
<!-- End Navbar -->
<div class="content">
  <div class="container-fluid">
    <div class="col-md-14">
      <div class="card ">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Manage Store</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive ps">
            <table class="table tablesorter table-hover" id="">
              <thead class=" text-primary">
                <tr>
                  <th>#</th>
                  <th>العنوان</th>
                  <th>الوصف</th>
                  <th>UID</th>
                  <th>العنوان</th>
                  <th>البريد</th>
                  <th>الحالة</th>
                  <th>إنشئ في تاريخ</th>
                  <th><a href="add_stores.php" class="btn btn-success">إضافة سوق جديد</a></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $result = mysqli_query($con, "SELECT id, title, subtitle, status, created_at FROM stores") or die("query 2 incorrect.......");
                while (list($user_id, $user_name, $user_last, $email, $user_password) = mysqli_fetch_array($result)) {
                  echo "<tr>
                    <td>$user_id</td>
                    <td>$user_name</td>
                    <td>$user_last</td>";
                  echo "<td></td>
                    <td></td>
                    <td></td>";
                    if ($email == 0) {
                      echo "<td>New</td>";
                    }
                    else {
                      echo "<td>Verified</td>";
                    }
                  echo" <td>$user_password</td>";
                  echo "<td>
                    <a class='btn btn-danger' href='managestore.php?user_id=$user_id&action=delete'>حذف<div class='ripple-container'></div></a>
                    </td></tr>";
                }
                mysqli_close($con);
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
include "footer.php";
?>