<?php
function inc()
{
	include "../incs/class_db.php";
	include "../incs/class_admin.php";
}
inc();

$adminlib = new adminlib();
$id = intval($_GET["id"]);
if (isset($_POST["remove_action"])) {
	$adminlib->remove_book($id);
}

?>
<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<div id="page-wrapper">
	<div id="page-inner">
		<div class="row">
			<div class="col-md-12">
				<h2>Delete</h2>
			</div>
		</div>
		<!-- /. ROW  -->
		<hr />

		<form action="book_remove.php?id=<?php echo $id ?>" method="post">
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