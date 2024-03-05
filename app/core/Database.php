<?php 


class Database {
	private $dbName = Constant::DB_NAME,
			$dbPass = Constant::DB_PASS,
			$dbUser = Constant::DB_USER,
			$dbHost = Constant::DB_HOST;

	private $stmt,
			$dbh;

	public function __construct() {
		$dbs = "mysql:host={$this->dbHost};dbname={$this->dbName}";
		$option = [
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		];

		try {
			$this->dbh = new PDO($dbs, $this->dbUser, $this->dbPass, $option);
		} catch (PDOException $e) {
			echo $e->getMessage();
			exit;
		}
	}

	public function query($query) {
		$this->stmt = $this->dbh->prepare($query);
	}

	public function bind($bind, $nilai, $type = null) {
		if ($type == null) {
			switch (true) {
				case is_int($nilai):
					$type = PDO::PARAM_INT;
					break;
				case is_bool($nilai):
					$type = PDO::PARAM_BOOL;
					break;
				case is_null($nilai):
					$type = PDO::PARAM_NULL;
					break;
				default:
					$type = PDO::PARAM_STR;
					break;
			}
			$this->stmt->bindValue($bind, $nilai, $type);
		}
	}

	public function execute() {
		$this->stmt->execute();
	}

	public function resultSet() {
		$this->execute();
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	public function single() {
		$this->execute();
		return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}
	public function rowCount() {
		return $this->stmt->rowCount();
	}

	public function transaction() {
		$this->dbh->beginTransaction();
	}
	public function commit() {
		$this->dbh->commit();
	}
	public function rollBack() {
		$this->dbh->rollBack();
	}
}