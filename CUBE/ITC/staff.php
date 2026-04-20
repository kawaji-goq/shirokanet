<?php
class Site_Staff extends Ab_NormalPageType{
	function Site_Staff($dbobj) {
		$this->dbobj=$dbobj;
		$this->bname="staff";
	}
}
class Admin_Staff extends Ab_AdminBasicType{
	function Admin_Staff($dbobj) {
		$this->dbobj=$dbobj;
		$this->bname="staff";
	}
	function AdditionData($data) {
		$db=$this->dbobj;
		$bname=$this->bname;
		if($data["new_data_name"]!=NULL||$data["new_data_comm"]!=NULL) {
			$db=$this->dbobj;
			$bname=$this->bname;
			$maxid=$db->GetMaxId($bname."_data","data_id");
			unset($field,$tdata);
			
			if($data["new_view_chk"]==NULL){
				$data["new_view_chk"]=0;
			}
			
			$setdata=$this->LoadSet();
			$imgobj=new Upload();
			@mkdir($_SERVER["DOCUMENT_ROOT"]."/tmp/");
			@mkdir($_SERVER["DOCUMENT_ROOT"]."/tmp/".$bname."_data");
			@mkdir($_SERVER["DOCUMENT_ROOT"]."/tmp/".$bname."_data/".$maxid);
			$imgobj->path=$_SERVER["DOCUMENT_ROOT"]."/tmp/".$bname."_data/".$maxid."/";
			$imgobj->rpath="/tmp/".$bname."_data/".$maxid."/";
			$imagefile=$imgobj->UpImgAndResize("imagefile",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);
			
			$field[]="data_id";
			$field[]="data_title";
			$field[]="data_name";
			$field[]="data_kana";
			$field[]="data_post";
			$field[]="data_comm";
			$field[]="cate_id";
			$field[]=" view_chk ";
			$tdata[]=$maxid;
			$tdata[]="'".$data["new_data_title"]."'";			
			$tdata[]="'".$data["new_data_name"]."'";
			$tdata[]="'".$data["new_data_kana"]."'";
			$tdata[]="'".$data["new_data_post"]."'";
			$tdata[]="'".$data["new_data_comm"]."'";
			$tdata[]=$data["cate_id"];
			$tdata[]=$data["new_view_chk"];
			$field[]="turn";
			$tdata[]=$maxid;
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
			
			if($imagefile["filepath"]!=NULL) {
				$field[]="data_image";
				$tdata[]="'".$imagefile["filepath"]."'";
				@chmod($imagefile1["filepath"],0777);
			if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
			
				$ftp->MkDir("tmp",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$maxid);
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/",$imagefile["name"],$_SERVER["DOCUMENT_ROOT"]."/tmp/".$bname."_data/".$maxid."/".$imagefile["name"],"b");
				}
			}
			else if($setdata["detailsimg_defalt"]!=NULL){
				$field[]="data_image";
				$tdata[]="'".$setdata["detailsimg_defalt"]."'";
			}
				
			$db->Insert($bname."_data",$field,$tdata);
			$data["data_id"]=$maxid;

			//$this->AdditionSubData($data);
		}
		return $maxid;
	}
	
	function UpdateOneData($data) {
		$db=$this->dbobj;
		$bname=$this->bname;
		
		@mkdir($_SERVER["DOCUMENT_ROOT"]."/tmp/");
		@mkdir($_SERVER["DOCUMENT_ROOT"]."/tmp/".$bname."_data/");
		@mkdir($_SERVER["DOCUMENT_ROOT"]."/tmp/".$bname."_data/".$data["data_id"]);
		
		$setdata=$this->LoadSet();
		$imgobj=new Upload();
		$imgobj->path=$_SERVER["DOCUMENT_ROOT"]."/tmp/".$bname."_data/".$data["data_id"]."/";
		$imgobj->rpath="/tmp/".$bname."_data/".$data["data_id"]."/";
		$imagefile=$imgobj->UpImgAndResize("imagefile",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);	
		$field[]="data_title";
		$field[]="data_name";
		$field[]="data_comm";
		$field[]="data_kana";
		$field[]="data_post";
		$field[]="view_chk";
		$tdata[]="'".$data["data_title"]."'";
		$tdata[]="'".$data["data_name"]."'";
		$tdata[]="'".$data["data_comm"]."'";
		$tdata[]="'".$data["data_kana"]."'";
		$tdata[]="'".$data["data_post"]."'";
		$tdata[]="'".$data["view_chk"]."'";
		
		if($imagefile["filepath"]!=NULL) {
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
			$field[]="data_image";
			$tdata[]="'".$imagefile["filepath"]."'";
			@chmod($imagefile1["filepath"],0777);
		if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
			
			$ftp->MkDir("tmp",$bname."_data");
			$ftp->MkDir("tmp/".$bname."_data",$data["data_id"]);
			$ftp->UpData("tmp/".$bname."_data/".$data["data_id"]."/",$imagefile["name"],$_SERVER["DOCUMENT_ROOT"]."/tmp/".$bname."_data/".$data["data_id"]."/".$imagefile["name"],"b");
				}
		}
		else if($data["delimage"]==1){
			if($setdata["detailsimg_defalt"]!=NULL){
				$field[]="data_image";
				$tdata[]="'".$setdata["detailsimg_defalt"]."'";
			}
			else {
				$field[]="data_image";
				$tdata[]="''";
			}
		}
		else if($data["oldphoto"]!=NULL) {
			
		}
		else if($setdata["detailsimg_defalt"]!=NULL){
			$field[]="data_image";
			$tdata[]="'".$setdata["detailsimg_defalt"]."'";
		}
			
		$db->Update($bname."_data",$field,$tdata," where data_id = ".$data["data_id"]);
		//$this->AdditionSubData($data);
	}
	
}

/*
?><meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php
*/
?>