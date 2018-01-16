<?php
	require('database/database.php');
	require('users/user.php');
	require('blogs/blog.php');
	
	class Api {
		private $db;
		use Database, Users, Blogs;
		public function __construct() {
			$dbCon = $this->dbConnect();
            if($dbCon !== null) {
                echo $dbCon;
            }
		}
	}	
	$api = new Api();	
?>