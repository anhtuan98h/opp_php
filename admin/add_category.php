<?php
function inc()
{
  include "../incs/class_db.php";
  include "../incs/class_admin.php";
}
inc();

$adminlib = new adminlib();

if (isset($_POST["add_action"])) {
  $message = $adminlib->add_category();
  $error = $message[0];
  $data = $message[1];
}

$sql = "SELECT * FROM categories";
$list_category = $adminlib->get_list($sql);

?>

<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<!-- /. NAV SIDE  -->
<div id="page-wrapper">
  <div id="page-inner">
    <div class="row">
      <div class="col-lg-12">
        <h2>Add_category</h2>
      </div>
    </div>
    <!-- /. ROW  -->
    <hr />
    <?php echo isset($error['note']) ? $error['note'] : ''; ?>
    <form action="add_category.php" method="post" enctype="multipart/form-data">


      Thể loại:<?php echo isset($error['name']) ? $error['name'] : ''; ?><br>
      <input type="text" name="name" value="<?php echo isset($data['name']) ? $data['name'] : ''; ?>" class="form-control"><br>



      <input type="submit" name="add_action" value="ADD Category" class="btn btn-success">
    </form>

  </div>
  <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
</div>
<?php include 'footer.php'; ?>