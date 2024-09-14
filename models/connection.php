<?php 

class Connection{

	static public function Connect(){

		$link = new PDO("mysql:host=localhost;dbname=sportscentercrm",
						"root",
						"",
						array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		                      PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
						);

		return $link;

	}

}

?>