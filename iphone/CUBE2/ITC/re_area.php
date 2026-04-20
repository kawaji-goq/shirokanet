<?php

class Site_RE_Area extends Ab_SimpleType{
	function Site_RA_Area($dbobj) {
		$this->dbobj=$dbobj;
		$this->bname="re_area";
	}
	function GetCateList() {
		$db=$this->dbobj;
		$list=$db->GetList("select * from re_area order by turn");
		return $list;
	}
	
	function GetCateData($id) {
		$db=$this->dbobj;
		$data=$db->GetData("select * from re_area where area_id = ".$id);
		return $data;
	}
}

class Admin_RE_Area extends Ab_SimpleType{
	function Admin_RA_Area($dbobj) {
		$this->dbobj=$dbobj;
		$this->bname="re_area";
	}
	function GetCateList() {
		$db=$this->dbobj;
		$list=$db->GetList("select * from re_area order by turn");
		return $list;
	}
	
	function GetCateData($id) {
		$db=$this->dbobj;
		$data=$db->GetData("select * from re_area where area_id = ".$id);
		return $data;
	}
	
	function GetDataList($id) {
	
		$db=$this->dbobj;
		$data=$db->GetList("select * from re_area_master inner join re_area on re_area_master.area_id= re_area.area_id where re_area.area_id =".$id);
		return $data;
		
	}
}

/*
?><meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php
*/
?>