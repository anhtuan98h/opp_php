<?php

use Symfony\Component\VarDumper\Server\Connection;

function inc()
{
	include "../incs/class_db.php";
	include "../incs/class_admin.php";
}
inc();

$adminlib = new adminlib();
$sql = "SELECT count(*) FROM books";
$total_records = $adminlib->get_row_number($sql);

$limit = 3;

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

$total_page = ceil($total_records / $limit);

if ($current_page > $total_page) {
	$current_page = $total_page;
} else if ($current_page < 1) {
	$current_page = 1;
}

$start = ($current_page - 1) * $limit;



$sql = "SELECT * FROM books a JOIN categories b on a.category_id = b.category_id LIMIT $start, $limit";

if (isset($_GET['search'])) {
	$s = $_GET['search'];
	$sql = "SELECT * FROM books a JOIN categories b on a.category_id = b.category_id WHERE name_book LIKE '%$s%' Order By id ASC";
}
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

					.form-control {
						height: 35px;
						border-radius: 5%;
					}

					.form-control:hover {
						background-color: #edf2f5;
						border: 1px solid #f00;
					}

					.form-inline {
						float: right;
					}

					.add {
						float: left;
						margin-top: 52px;
					}
				</style>
				<img class="logo" src="assets/img/logo.png" alt="logo" title="logo">
				<h2 class="text-info text-center">Book Management</h2>
			</div>
		</div>
		<!-- /. ROW  -->
		<hr />

		<div class="content">
			<a href="book_add.php"><input type="button" class="btn btn-success add" value="Add"></a><br><br>
			<form action="" class="form-inline" role="form">
				<div class="form-group">
					<input type="text" class="form-control " name="search" placeholder="Bạn muốn tìm sách gì">
				</div>

				<!-- <input class="btn btn-primary" type="submit" value="Tìm" name="bt_tk"> -->
				<button type="submit" class="btn btn-primary">Tìm kiếm</button>
			</form> <br> <br>
		</div>

		<style>
			.f-bold {
				font-weight: bold;
			}
		</style>



		<table class="table table table-hover table-striped table-bordered table-hover">
			<thead>
				<tr>
					<td class="f-bold" align="center">Order</td>
					<td class="f-bold" align="center">Name</td>
					<td class="f-bold" align="center">Author</td>
					<td class="f-bold" align="center">Category</td>
					<td class="f-bold" align="center">Price</td>
					<td class="f-bold" align="center">Image</td>
					<td class="f-bold" align="center">Options</td>
				</tr>
			</thead>
			<tbody>
				<?php
				$temp = 0;

				for ($i = 0; $data != 0 && $i < count($data); $i++) {
					$id = $data[$i]["id"];
					$temp++;

				?>
					<tr>
						<td align="center"><?php echo $temp; ?></td>
						<td align="center"><?php echo $data[$i]["name_book"]; ?></td>
						<td align="center"><?php echo  $data[$i]["authors"]; ?></td>
						<td align="center"><?php echo  $data[$i]["name"]; ?></td>
						<td align="center"><?php echo $adminlib->currency_format($data[$i]["cost"]); ?></td>
						<td align="center"><img src="../images/<?php echo $data[$i]["image"]; ?>" width="50px" height="50px"></td>

						<td align="center"><a href="book_update.php?id=<?php echo $id; ?>"><i class="far fa-edit"></i></a> | <a href="book_remove.php?id=<?php echo $id; ?>"><i class="far fa-trash"></i></a></td>
					</tr>
				<?php
				}
				?>
			</tbody>
		</table>
		<ul class="pagination">
			<?php
			if ($current_page > 1 && $total_page > 1) {
				echo '<li><a href="book.php?page=' . ($current_page - 1) . '">Trước</a></li>';
			}

			for ($i = 1; $i <= $total_page; $i++) {

				if ($current_page == $i)
					echo '<li class="disabled"><a href="#">' . $i . '</a></li>';
				else
					echo '<li><a href="book.php?page=' . $i . '">' . $i . '</a></li>';
			}

			if ($current_page < $total_page && $total_page > 1) {
				echo '<li><a href="book.php?page=' . ($current_page + 1) . '">Sau</a></li>';
			}

			?>
		</ul>
	</div>
	<!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
</div>
<?php include 'footer.php'; ?>