<?php 

class Cube_DB {
	function UseDB($dbtype) {
		switch($dbtype) {
			case "postgresql":
				$dbobj=new Cube_Postgres();
				return $dbobj; 
				break;
			case "mysql":
				$dbobj=new Cube_Mysql();
				return $dbobj; 
				break;
			default:
				break;	
		}
	}
}
/*
?><meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php
*/
?>