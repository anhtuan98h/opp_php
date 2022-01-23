<?php
function inc()
{
	include "../incs/class_db.php";
	include "../incs/class_admin.php";
}
inc();

$adminlib = new adminlib();

$id = intval($_GET["id"]);
$sql = "
SELECT name_book, authors, category_id,cost
FROM books
WHERE id = $id";
$data = $adminlib->get_row($sql);

$sql = "SELECT * FROM categories";
$list_category = $adminlib->get_list($sql);

if (isset($_POST["update_action"])) {
	$message = $adminlib->update_book($id);
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
				<h2>Updated BOOK</h2>
			</div>
		</div>
		<!-- /. ROW  -->
		<hr />

		<p style="color: red;"><?php echo isset($error['note']) ? $error['note'] : ''; ?></p>
		<form action="book_update.php?id=<?php echo $id ?>" method="post" enctype="multipart/form-data">

			Book_Name:<?php echo isset($error['name_book']) ? $error['name_book'] : ''; ?><br>
			<input type="text" name="name_book" value="<?php echo isset($data['name_book']) ? $data['name_book'] : ''; ?>" class="form-control"><br>

			Author:<?php echo isset($error['authors']) ? $error['authors'] : ''; ?><br>
			<input type="text" name="authors" value="<?php echo isset($data['authors']) ? $data['authors'] : ''; ?>" class="form-control"><br>
			<br>

			Category:<?php echo isset($error['category_id']) ? $error['category_id'] : ''; ?><br>
			<select name="category_id">
				<?php echo $adminlib->get_dropdown_category($list_category, $data["category_id"]); ?>
			</select><br><br>


			Price:<?php echo isset($error['cost']) ? $error['cost'] : ''; ?><br>
			<input type="text" name="cost" value="<?php echo isset($data['cost']) ? $data['cost'] : ''; ?>" class="form-control"><br>

			Image:<?php echo isset($error['image']) ? $error['image'] : ''; ?><br>
			<input name="fileToUpload" type="file"><br>



			<input type="submit" name="update_action" value="Update" class="btn btn-success">
		</form>

		<!-- /. ROW  -->
	</div>
	<!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
</div>
<?php include 'footer.php'; ?>