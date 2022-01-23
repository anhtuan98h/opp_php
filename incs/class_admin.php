<?php
class adminlib extends dblib
{

	function get_dropdown_category($list, $value)
	{
		$info = '<option value="0">Select Category</option>';
		for ($i = 0; $i < count($list); $i++) {

			$selected = $list[$i]["category_id"] == $value ? 'selected' : '';
			$info .= '<option value="' . $list[$i]["category_id"] . '" ' . $selected . ' >' . $list[$i]["name"] . '</option>';
		}
		return $info;
	}


	function add_book()
	{
		$error = array();
		$data = array();


		$data['name_book'] = isset($_POST['name_book']) ? $_POST['name_book'] : '';
		$data['authors'] = isset($_POST['authors']) ? $_POST['authors'] : '';
		$data['cost'] = isset($_POST['cost']) ? $_POST['cost'] : '';
		$data['category_id'] = isset($_POST['category_id']) && $_POST['category_id'] != 0 ? $_POST['category_id'] : '';


		if (empty($data['name_book'])) {
			$error['name_book'] = "You didn't enter name";
		}

		if (empty($data['authors'])) {
			$error['authors'] = "You didn't enter author";
		}

		if (empty($data['cost'])) {
			$error['cost'] = "You didn't enter price";
		}


		if (empty($data['category_id'])) {
			$error['category_id'] = "You didn't selected category";
		}

		$target_dir = "../images/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);


		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if ($check !== false) {
			$uploadOk = 1;
		} else {
			$error["image"] = "File not is image.";
			$uploadOk = 0;
		}

		if (file_exists($target_file)) {
			$error["image"] = "Erorr, Files already exists";
			$uploadOk = 0;
		}

		if ($_FILES["fileToUpload"]["size"] > 500000) {
			$error["image"] = "Erorr, files is too big ";
			$uploadOk = 0;
		}

		if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
			$error["image"] = "ERORR, files must have the extensions JPG, JPEG, PNG & GIF.";
			$uploadOk = 0;
		}


		if ($uploadOk != 0) {
			if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				$error["image"] = "Error! An error occurred while uploading the images.";
			} else {
				$data['image'] = basename($_FILES["fileToUpload"]["name"]);
			}
		}


		if (!$error) {
			$data["created_at"] = date("Y-m-d H:i:s");
			$data["updated_at"] = date("Y-m-d H:i:s");
			$this->insert("books", $data);
			$error["note"] = "Add sucsess";
			header('Location:book.php');
			die();
		} else {
			$error["note"] = "ADD Fail";
		}

		$message[0] = $error;
		$message[1] = $data;

		return $message;
	}



	function add_category()
	{
		$error = array();
		$data = array();
		$data['name'] = isset($_POST['name']) ? $_POST['name'] : '';
		if (empty($data['name'])) {
			$error['name'] = "You didn't enter name category";
		}


		if (!$error) {
			$data["created_at"] = date("Y-m-d H:i:s");
			$data["updated_at"] = date("Y-m-d H:i:s");
			$this->insert("categories", $data);
			$error["note"] = "Add category sucsess";
			header('Location:category.php');
			die();
		} else {
			$error["note"] = "Add fail";
		}

		$message[0] = $error;
		$message[1] = $data;

		return $message;
	}


	function update_book($id)
	{
		$error = array();
		$data = array();
		$data['category_id'] = isset($_POST['category_id']) && $_POST['category_id'] != 0 ? $_POST['category_id'] : '';
		$data['name_book'] = isset($_POST['name_book']) ? $_POST['name_book'] : '';
		$data['authors'] = isset($_POST['authors']) ? $_POST['authors'] : '';
		$data['cost'] = isset($_POST['cost']) ? $_POST['cost'] : '';

		if (empty($data['name_book'])) {
			$error['name_book'] = "You didn't enter name";
		}

		if (empty($data['authors'])) {
			$error['authors'] = "You didn't enter author";
		}

		if (empty($data['cost'])) {
			$error['cost'] = "You didn't enter price";
		}

		if (empty($data['category_id'])) {
			$error['category_id'] = "You didn't selected category";
		}


		if ($_FILES["fileToUpload"]["tmp_name"] != '') {

			$target_dir = "../images/";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);


			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if ($check !== false) {
				$uploadOk = 1;
			} else {
				$error["image"] = "File not is image.";
				$uploadOk = 0;
			}


			if ($_FILES["fileToUpload"]["size"] > 500000) {
				$error["image"] = "Erorr, files is too big";
				$uploadOk = 0;
			}

			if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
				$error["image"] = "ERORR, files must have the extensions JPG, JPEG, PNG & GIF.";
				$uploadOk = 0;
			}


			if ($uploadOk != 0) {
				if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					$error["image"] = "Error! An error occurred while uploading the images.";
				} else {
					$data['image'] = basename($_FILES["fileToUpload"]["name"]);
				}
			}
		}


		if (!$error) {

			$this->update("books", $data, "id = $id");
			$error["note"] = "Update sucsess";
		} else {
			$error["note"] = "Update fail";
		}

		$message[0] = $error;
		$message[1] = $data;

		return $message;
	}

	function update_category($category_id)
	{
		$error = array();
		$data = array();
		$data['name'] = isset($_POST['name']) ? $_POST['name'] : '';

		if (empty($data['name'])) {
			$error['name'] = "You didn't enter name_category";
		}

		if (!$error) {

			$this->update("categories", $data, "category_id =$category_id");
			$error["note"] = "Update sucsess";
		} else {
			$error["note"] = "Update fail";
		}

		$message[0] = $error;
		$message[1] = $data;
		return $message;
	}

	function remove_book($id)
	{
		$sql = "SELECT image FROM books WHERE id = $id";
		$link = $this->get_row($sql);
		unlink('../images/' . $link['image']);
		$this->remove("books", "id = $id");
		header('Location:book.php');
		die();
	}

	function remove_category($category_id)
	{
		$this->remove("categories", "category_id = $category_id ");
		header('Location:category.php');
		die();
	}

	function currency_format($number, $unit = " " . 'VNĐ')
	{
		return number_format($number) . $unit;
	}
}
