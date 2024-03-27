<?php
include_once('../../../other/non_git_conn_str.php');
Class Connection{
	private $connect_str = $non_git_conn_str;
	private $connect_db;
	public function open(){
			$this->connect_db = pg_connect($this->connect_str) or die('connection failed');
			return $this->connect_db;
	}

}
?>