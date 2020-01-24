<?php
class model
{
	public $db;
	public function __construct()
	{
		$this->db = new PDO(DB_DSN, DB_USR, DB_PWD);
	}

	public function fetch($query, $params = [])
	{
		$sth = $this->db->prepare($query);
		$sth->execute($params);
		return $sth->fetch(PDO::FETCH_ASSOC);
	}

	public function fetchAll($query, $params = [])
	{
		$sth = $this->db->prepare($query);
		$sth->execute($params);
		return $sth->fetchAll(PDO::FETCH_ASSOC);
	}

	public function query($query, $params = [])
	{
		$sth = $this->db->prepare($query);
		return $sth->execute($params);
	}
}
?>