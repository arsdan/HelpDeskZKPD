<?php
Class Connection{
	private $connect_str = 'host=localhost port=5432 dbname=postgres user=postgres';
	private $connect_db;
	public function open(){
			$this->connect_db = pg_connect($this->connect_str) or die('connection failed');
			return $this->connect_db;
	}

}
?>