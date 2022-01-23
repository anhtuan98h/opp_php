<?php
class dblib
{
	private $db_connection;
	function connect()
	{
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "book_news";
		if (!$this->db_connection) {

			try {
				$this->db_connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$this->db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
				echo "Error: " . $e->getMessage();
				die();
			}
		}
	}


	function dis_connect()
	{
		if ($this->db_connection) {
			$this->db_connection = null;
		}
	}
	function insert($table, $data)
	{
		$this->connect();
		$field_list = '';  // Lưu trữ danh sách file
		$value_list = '';  // Lưu trữ danh sách giá trị tương ứng với  field
		foreach ($data as $key => $value) {
			$field_list .= ",$key";
			$value_list .= ",'" . $value . "'";
		}
		$sql = 'INSERT INTO ' . $table . '(' . trim($field_list, ',') . ') VALUES (' . trim($value_list, ',') . ')';
		$statement = $this->db_connection->prepare($sql);
		return $statement->execute();
	}

	function update($table, $data, $where)
	{
		$this->connect();
		$sql = '';
		foreach ($data as $key => $value) {
			$sql .= "$key = '" . $value . "',";
		}
		$sql = 'UPDATE ' . $table . ' SET ' . trim($sql, ',') . ' WHERE ' . $where;
		$statement = $this->db_connection->prepare($sql);
		return $statement->execute();
	}

	function remove($table, $where)
	{
		$this->connect();
		$sql = "DELETE FROM $table WHERE $where";
		$statement = $this->db_connection->prepare($sql);
		return $statement->execute();
	}


	function get_list($sql)
	{
		$this->connect();
		$statement = $this->db_connection->prepare($sql);
		$statement->execute();
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		return $statement->fetchALL();
	}


	function get_row($sql)
	{
		$this->connect();
		$statement = $this->db_connection->prepare($sql);
		$statement->execute();
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		return $statement->fetch();
	}

	function get_row_number($sql)
	{
		$this->connect();
		$statement = $this->db_connection->prepare($sql);
		$statement->execute();
		return $statement->fetchColumn();
	}
}
