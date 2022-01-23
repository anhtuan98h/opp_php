<?php
function inc()
{
  include "../incs/class_db.php";
  include "../incs/class_admin.php";
}
inc();

$adminlib = new adminlib();

$category_id = (int)$_GET["category_id"];
$sql = "
SELECT name FROM categories
WHERE category_id = $category_id";
$data = $adminlib->get_row($sql);

// $sql = "SELECT * FROM categories";
$list_category = $adminlib->get_list($sql);

if (isset($_POST["update_category"])) {
  $message = $adminlib->update_category($category_id);
  $error = $message[0];
  $data = $message[1];
}

?>
<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<div id="page-wrapper">
  <div id="page-inner">
    <div class="row">
      <div class="col-md-12">
        <h2>Update_category</h2>
      </div>
    </div>
    <!-- /. ROW  -->
    <hr />

    <p style="color: red;"><?php echo isset($error['note']) ? $error['note'] : ''; ?></p>
    <form action=" update_category.php?category_id=<?php echo $category_id ?>" method="post" enctype="multipart/form-data">

      Tên thể loại:<?php echo isset($error['name']) ? $error['name'] : ''; ?><br>
      <input type="text" name="name" value="<?php echo isset($data['name']) ? $data['name'] : ''; ?>" class="form-control"><br>




      <input type="submit" name="update_category" value="Update" class="btn btn-success">
    </form>

    <!-- /. ROW  -->
  </div>
  <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
</div>
<?php include 'footer.php'; ?>