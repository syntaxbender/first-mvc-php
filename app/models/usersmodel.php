<?php
class usersModel extends model{
	public function createUser($username,$pwdhash){
		return $this->query('insert into users set username = ?, pwdhash = ?',[$username,$pwdhash]);
	}
	public function getAll($colonums){
		return $this->fetchAll('select '.$colonums.' from users');
	}
	public function getbyUsername($colonums,$username){
		return $this->fetch('select '.$colonums.' from users where username=?',[$username]);
	}
}
?>