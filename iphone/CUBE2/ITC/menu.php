<?php

class Site_Menu extends Ab_NormalPageType{
	function Site_Menu($dbobj) {
		$this->dbobj=$dbobj;
		$this->bname="menu";
	}
	function E_DataList() {
		$db=$this->dbobj;
		//$sql="select * from menu_data where data_id <> 1 and  data_id <> 11 ";
		$data=$db->SelectList("menu_data"," ",10,0,"data_id");
		$this->numrows=$db->numrows;
		return $data;
	}
	function GetSelDataList() {
		$db=$this->dbobj;
		$bname=$this->bname;		
		$data=$db->GetList("select * from menu_data order by data_id");
		$this->numrows=$db->numrows;
		return $data;
		
	}
	function Update($pdata) {
		global $DomainData;
		for($i=0;!is_null($pdata["d_data_id"][$i]);$i++) {
			$field[]="data_name";
			$tdata[]="'".$pdata["menu_name"][$i]."'";
			$field[]="use_chk";
			$tdata[]=$pdata["use_chk"][$i];
			$imgobj=new Upload();
			$imgobj->path="./tmp/".$DomainData["dbname"]."/menu_ic/";
			$imgobj->rpath="/tmp/".$DomainData["dbname"]."/menu_ic/";
			@mkdir("./tmp/".$DomainData["dbname"]."/menu_ic/");		
			$imagefile=$imgobj->UpImgAndResize("icon".$i,74,62);
			
			if($imagefile["filepath"]!=NULL) {
				$field[]="icon";
				$tdata[]="'".$imagefile["filepath"]."'";		
			}
			
			$this->dbobj->Update("menu_data",$field,$tdata," where data_id = ".$pdata["d_data_id"][$i]);
			unset($field,$tdata);		
		}
	}
}

class Admin_Menu extends Ab_AdminBasicType{
	function Admin_Menu($dbobj) {
		$this->dbobj=$dbobj;
		$this->bname="menu";
	}
	function GetSelDataList() {
		$db=$this->dbobj;
		$bname=$this->bname;		
		$data=$db->GetList("select * from menu_data order by data_id");
		$this->numrows=$db->numrows;
		return $data;
		
	}
	function E_DataList() {
		//$sql="select * from menu_data where data_id <> 1 and  data_id <> 11 ";
		$data=$db->SelectList("menu_data","","","data_id");
		$this->numrows=$db->numrows;
	}
	function Update($pdata) {
		for($i=0;!is_null($pdata["d_data_id"][$i]);$i++) {
			$field[]="data_name";
			$tdata[]="'".$pdata["menu_name"][$i]."'";
				
			$imgobj=new Upload();
			$imgobj->path="./tmp/".$DomainData["dbname"]."/menu_ic/";
			$imgobj->rpath="/tmp/".$DomainData["dbname"]."/menu_ic/";
			
			mkdir("./tmp/".$DomainData["dbname"]."/menu_ic/");		
			$imagefile=$imgobj->UpImgAndResize2("icon",$i,$setdata["listimg_w"],$setdata["listimg_h"]);
			
			if($imagefile["file_path"]!=NULL) {
				$field[]="icon";
				$tdata[]="'".$imagefile["file_path"]."'";		
			}
			
			$this->dbobj->Update("menu_data",$field,$tdata," where data_id = ".$pdata["d_data_id"][$i]);
			unset($field,$tdata);		
		}
	}
}

/*
?><meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php
*/
?>