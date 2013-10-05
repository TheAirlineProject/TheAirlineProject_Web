<?php

class Connection {
	protected $link;
	private $server, $un, $pw, $db;

	public function __construct($server, $un, $pw, $db)
	  {
	    $this->server = $server;
	    $this->un = $un;
	    $this->pw = $pw;
	    $this->db = $db;
	    $this->connect();

	private function connect()
	  {
	    $this->link = msyqli_connect($this->server, $this->username, $this->password, $this->db);
	  }

	public function __sleep() {
	
	  return array('server','un','pw','db');
	}

	public function __wakeup() {

	  $this->connect();
	}

	public function getDatabaseName(Connection $con) {
	  return $thisj->db;
	}
	
	public function getTables($con) {
	  return mysqli_query($this->link,"SHOW TABLES");
	}

	public function getColumns($con, $table) {
	  return mysqli_query($this->link,"SHOW COLUMNS IN $table");
	}

	public function tableExists($con, $table) {
	  $r = mysqli_query($this->link,"SELECt * FROM $table");
	  if($r != null) { return true; }
	  else return false;
	}

	public function columnExists($con, $table, $col) {
	  $r = mysqli_query($this->link, "SHOW COLUMNS FROM $table LIKE '$col'");
	  if($r != null) { return true; }
	  else return false;
	}
?>
	
