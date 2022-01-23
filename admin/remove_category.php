<?php
function inc()
{
  include "../incs/class_db.php";
  include "../incs/class_admin.php";
}
inc();

$adminlib = new adminlib();
$category_id = intval($_GET["category_id"]);
if (isset($_POST["remove_action"])) {
  $adminlib->remove_category($category_id);
}

?>
<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<div id="page-wrapper">
  <div id="page-inner">
    <div class="row">
      <div class="col-md-12">
        <h2>Delete_category</h2>
      </div>
    </div>
    <!-- /. ROW  -->
    <hr />

    <form action="remove_category.php?category_id=<?php echo $category_id ?>" method="post">
      You may want to deleted?<br>
      <input type="submit" name="remove_action" value="Delete" class="btn btn-success">
    </form>

    <!-- /. ROW  -->
  </div>
  <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
</div>
<?php include 'footer.php'; ?>