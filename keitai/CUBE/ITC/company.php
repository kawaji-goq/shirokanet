<?php

class Site_Company extends Ab_NormalPageType{
	function Site_Company($dbobj) {
		$this->dbobj=$dbobj;
		$this->bname="company";
	}
}

class Admin_Company  extends Ab_AdminBasicType{
	function Admin_Company($dbobj) {
		$this->dbobj=$dbobj;
		$this->bname="company";
	}
}

class Company extends Ab_NoCatePageType{
	function Company($dbobj) {
		$this->dbobj=$dbobj;
		$this->bname="company";
	}
}

class Ad_Company extends Ab_AdminBasicType{
	function Ad_Company($dbobj) {
		$this->dbobj=$dbobj;
		$this->bname="company";
	}
}

/*
?><meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php
*/
?>