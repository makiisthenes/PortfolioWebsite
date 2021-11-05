<?php
	
	// Actual DB;
	function db () {
		$dbhost = getenv("MYSQL_SERVICE_HOST");
		$dbport = getenv("MYSQL_SERVICE_PORT");
		$dbuser = getenv("DATABASE_USER");
		$dbpwd = getenv("DATABASE_PASSWORD");
		$dbname = getenv("DATABASE_NAME");
		static $conn;
		if ($conn===NULL){ 
			$conn = mysqli_connect ($dbhost, $dbuser, $dbpwd, $dbname);
		}
		return $conn;
	}		
	
	/*
	// Local DB
	function db () {
		static $conn;
		if ($conn===NULL){ 
			$conn = mysqli_connect ("localhost", "root", "", "ecs417");
		}
		return $conn;
	}	
	*/
?>