<?php
class listsModel extends model{
	public function getAll($userid){
		return $this->fetchAll('select * from lists where userid=?',[$userid]);
	}
	public function getById($listid){
		return $this->fetch('select title,content,userid from lists where id=?',[$listid]);
	}
	public function listAdd($title,$content,$userid){
		return $this->query('insert into lists set title = ?, content = ?, userid = ?',[$title,$content,$userid]);
	}
	public function listDelete($listId){
		return $this->query('delete from lists where id = ?',[$listId]);
	}
}
?>