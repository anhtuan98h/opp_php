<?php
function inc()
{
    include "../incs/class_db.php";
    include "../incs/class_admin.php";
}
inc();

$adminlib = new adminlib();

if (isset($_POST["add_action"])) {
    $message = $adminlib->add_book();
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
                <h2>ADD BOOK</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <?php echo isset($error['note']) ? $error['note'] : ''; ?>
        <form action="book_add.php" method="post" enctype="multipart/form-data">


            Book_name:<?php echo isset($error['name_book']) ? $error['name_book'] : ''; ?><br>
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



            <input type="submit" name="add_action" value="ADD" class="btn btn-success">
        </form>

    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
</div>
<?php include 'footer.php'; ?>