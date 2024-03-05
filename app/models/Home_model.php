<?php 


class Home_model {

	private $db;

	public function __construct() {
		$this->db = new Database();
	}

	public function updateStatus($id) {
		$this->db->query("UPDATE users SET status = 'offline' WHERE id_user = :id");
		$this->db->bind('id',$id);
		$this->db->execute();
	}

	public function getUserById($id) {
		$this->db->query('SELECT * FROM users WHERE id_user = :id');
		$this->db->bind('id',$id);
		$this->db->execute();

		return $this->db->single();
	}
}