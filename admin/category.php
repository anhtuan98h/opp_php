<?php
function inc()
{
  include "../incs/class_db.php";
  include "../incs/class_admin.php";
}
inc();

$adminlib = new adminlib();
$sql = "SELECT * FROM categories";
$data = $adminlib->get_list($sql);

?>
<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<!-- /. NAV SIDE  -->
<div id="page-wrapper">
  <div id="page-inner">
    <div class="row">
      <div class="col-lg-12">
        <style>
          .logo {
            width: 300px;
            height: 100px;
          }
        </style>
        <img class="logo" src="assets/img/logo.png" alt="logo" title="logo">
        <h2 class="text-info text-center">Category Management </h2>
      </div>
    </div>
    <!-- /. ROW  -->
    <hr />
    <a href="add_category.php"><input type="button" class="btn btn-success" value="ADD Category"></a><br><br>
    <style>
      .f-bold {
        font-weight: bold;
      }
    </style>
    <table class="table table table-hover table-striped table-bordered table-hover">
      <thead>
        <tr>
          <td class="f-bold" align="center">Order</td>
          <td class="f-bold" align="center">Category</td>
          <td class="f-bold" align="center">Options</td>
        </tr>
      </thead>
      <tbody>
        <?php
        $temp = 0;

        for ($i = 0; $data != 0 && $i < count($data); $i++) {
          $id = $data[$i]["category_id"];
          $temp++;

        ?>
          <tr>
            <td align="center"><?php echo $temp; ?></td>
            <td align="center"><?php echo $data[$i]["name"]; ?></td>
            <td align="center"><a href="update_category.php?category_id=<?php echo $id; ?>"><i class="far fa-edit"></i></a> | <a href="remove_category.php?category_id=<?php echo $id; ?>"><i class="far fa-trash"></i></a></td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>

  </div>
  <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
</div>
<?php include 'footer.php'; ?>