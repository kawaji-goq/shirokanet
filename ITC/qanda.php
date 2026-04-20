<?php

class Site_QA extends Ab_NormalPageType{
	function Site_QA($dbobj) {
		$this->dbobj=$dbobj;
		$this->bname="qanda";
	}
}

class Admin_QA extends Ab_AdminBasicType{
	function Admin_qa($dbobj) {
		$this->dbobj=$dbobj;
		$this->bname="qanda";
	}
}

/*
?><meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php
*/
?>