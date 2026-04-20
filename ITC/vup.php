<?php

class Site_Vup extends Site_Blog{

	function Site_Vup($dbobj) {
		$this->dbobj=$dbobj;
		$this->bname="vup";
	}
	function GetDetailsData($id) {
		$db=$this->dbobj;
		$bname=$this->bname;
		if($id) {
			$data=$db->SelectData($bname."_data","where view_chk <> 0 and vup_id = ".$id);
			return $data;
		}
	}
	
	function GetVupData($id,$type,$lim,$setnum,$orderby) {
		$db=$this->dbobj;
		$bname=$this->bname;
		switch($type) {
			case "vup":
				$type=0;
				break;
			case "link":
				$type=1;
				break;
			default:
				$type=0;
				break;
		}
		if($setnum==NULL) {
			$setnum=1;
		}
		if($lim!=NULL) {
			$setnum=$lim*($setnum-1);
		}
		else {
			$setnum=($setnum-1);
		}
//		echo "where view_chk <> 0 and view_type=$type and cate_id = ".$id;
		if($id!=NULL||$id==0) {			
			$data=$db->SelectList($bname."_data","where view_chk <> 0 and view_type=$type and cate_id = ".$id,$lim,$setnum,$orderby);
			$this->numrows=$db->numrows;
		}
		else {
			$catedata=$this->GetSelectDataNum(0," turn ");
			if(!is_null($catedata["id"])) {
				$data=$db->SelectList($bname."_data"," where view_chk <> 0 and view_type=$type and cate_id = ".$catedata["cate_id"],$lim,$setnum,$orderby);
				$this->numrows=$db->numrows;
			}
		}
		return $data;
	}	

	
	function RYearList() {		
		$db=$this->dbobj;
		$bname=$this->bname;
		$sql="select distinct(ryear) from vup_data where view_chk <> 0 and view_type=0 order by ryear desc";
		$data=$db->GetList($sql);
		return $data;
	}
	function RMonthList($year) {		
		$db=$this->dbobj;
		$bname=$this->bname;
		if(is_null($year)||$year=="") {
			$year=date("Y");
		}
		$sql="select distinct ryear,rmonth from vup_data where view_chk <> 0 and view_type=0 and ryear=".$year." order by rmonth desc";
		$data=$db->GetList($sql);
		return $data;
	}
	function YearData($year) {
		$db=$this->dbobj;
		$bname=$this->bname;
		if(is_null($year)||$year=="") {
			$year=date("Y");
		}
		$data=$db->GetList("select * from vup_data where view_chk <> 0 and view_type=0 and ryear = ".$year." order by rdate desc");
		return $data;
	}
	
	function MonthData($year,$month) {
		$db=$this->dbobj;
		$bname=$this->bname;
		if(is_null($year)||$year=="") {
			$year=date("Y");
		}
		if(is_null($month)||$month==""){
			$month=date("m");
		}
		$data=$db->GetList("select * from vup_data where view_chk <> 0 and view_type=0 and rmonth=".$month." and ryear=".$year." order by rdate desc");
		return $data;
	}
}
class Admin_Vup extends Admin_Blog{

	function Admin_Vup($dbobj) {
		$this->dbobj=$dbobj;
		$this->bname="vup";
	}
	function GetDetailsData($id) {
		$db=$this->dbobj;
		$bname=$this->bname;
		if($id) {
			$data=$db->SelectData($bname."_data","where vup_id = ".$id);
			return $data;
		}
	}
		
	function AdditionData($data) {
		$db=$this->dbobj;
		$bname=$this->bname;
		if($data["new_data_title"]!=NULL||$data["new_data_comm"]!=NULL) {
			$db=$this->dbobj;
			$bname=$this->bname;
			$maxid=$db->GetMaxId($bname."_data","vup_id");
			unset($field,$tdata);
			
			if($data["new_view_chk"]==NULL){
				$data["new_view_chk"]=0;
			}
			
			if($data["new_view_type"]==NULL){
				$data["new_view_type"]=0;
			}
			$setdata=$this->LoadSet();
			
			$imgobj=new Upload();
			@mkdir("../tmp/".$_SESSION["DomainData"]["dbname"]);
			@mkdir("../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data");
			@mkdir("../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$maxid);
			$imgobj->path="../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/";
			$imgobj->rpath="http://itcube.jp/tmp/".$bname."_data/".$maxid."/";
			$imagefile=$imgobj->UpImgAndResize("imagefile",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);
			if($imagefile["filepath"]!=NULL) {
			@copy("../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/imagefile.jpg","../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/imagefile2.jpg");
			$imgobj=new ImgMagic();
			$imgobj->cpandconv_Size("../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/imagefile2.jpg","imagefile2.jpg","../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/",$setdata["listimg_w"],$setdata["listimg_h"]);
			}
					
		if($data["day_view"]!=1) {
			$field[]="rdate";
			$tdata[]="'".$data["ryear"]."-".$data["rmonth"]."-".$data["rday"]."'";
		}
		else {
			$field[]="rdate";
			$tdata[]="null";
		}
		
			$field[]="vup_id";
			$tdata[]=$maxid;
			$field[]="title";
			$tdata[]="'".$data["new_data_title"]."'";
			$field[]="comm";
			$tdata[]="'".$data["new_data_comm"]."'";
			$field[]="link";
			$tdata[]="'".$data["new_link"]."'";
			$field[]="linktarget";
			$tdata[]="'".$data["new_linktarget"]."'";
			$field[]="view_type";
			$tdata[]="".$data["new_view_type"]."";
			$field[]="turn";
			$tdata[]=$maxid;
  		$field[]="cate_id";
			$tdata[]=$data["cate_id"];
			$field[]="view_chk";
			$tdata[]="".$data["new_view_chk"]."";
			$field[]="text2";
			$tdata[]="'".$data["text2"]."'";
			$field[]="text3";
			$tdata[]="'".$data["text3"]."'";
			
			if($data["rmonth"]!=NULL) {
  			$field[]="rmonth";
 				$tdata[]=$data["rmonth"];
			}
			if($data["ryear"]!=NULL) {
 				$field[]="ryear";
				$tdata[]=$data["ryear"];
			}
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);

			if($imagefile["filepath"]!=NULL) {
				$field[]="image";
				$tdata[]="'".$imagefile["filepath"]."'";
				@chmod($imagefile["filepath"],0777);
				$ftp->MkDir("tmp",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$maxid);
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/",$imagefile["name"],"../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$imagefile["name"],"b");
			}
			else if($setdata["detailsimg_defalt"]!=NULL){
				$field[]="image";
				$tdata[]="'".$setdata["detailsimg_defalt"]."'";
			}
			
			$db->Insert($bname."_data",$field,$tdata);
			$data["vup_id"]=$maxid;
			//$this->AdditionSubData($data);
		}
		$db->Query("update lastupdate set lastupdate=".time()."");
		
				
		return $maxid;
	}
	
	function UpdateOneData($data) {
		$db=$this->dbobj;
		$bname=$this->bname;
		
		@mkdir("../tmp/".$_SESSION["DomainData"]["dbname"]);
		@mkdir("../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data");
		@mkdir("../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$data["vup_id"]);
		
		$setdata=$this->LoadSet();
		$imgobj=new Upload();
		$imgobj->path="../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/";
		$imgobj->rpath="http://itcube.jp/tmp/".$bname."_data/".$data["vup_id"]."/";
			if($data["view_type"]==0) {
				$imagefile=$imgobj->UpImgAndResize("imagefile",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);
			}
			else {
				$imagefile=$imgobj->UpImgAndResize("imagefile",$setdata["listimg_w"],$setdata["listimg_h"]);
			}
			if($imagefile["filepath"]!=NULL) {
			@copy("../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/imagefile.jpg","../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/imagefile2.jpg");
			$imgobj=new ImgMagic();
			$imgobj->cpandconv_Size("../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/imagefile2.jpg","imagefile2.jpg","../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/",$setdata["listimg_w"],$setdata["listimg_h"]);
			}
			
		$imgobj2=new Upload();
		$imgobj2->path="../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/";
		$imgobj2->rpath="/tmp/".$bname."_data/".$data["vup_id"]."/";
		$image_file2=$imgobj2->UpImgAndResize("image_file2",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);
			
		if($data["view_type"]==NULL) {
			$data["view_type"]=0;
		}
		
		$imgobj3=new Upload();
		$imgobj3->path="../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/";
		$imgobj3->rpath="/tmp/".$bname."_data/".$data["vup_id"]."/";
		$image_file3=$imgobj3->UpImgAndResize("image_file3",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);
			
		if($data["view_type"]==NULL) {
			$data["view_type"]=0;
		}
		
		if($data["day_view"]!=1) {
			$field[]="rdate";
			$tdata[]="'".$data["ryear"]."-".$data["rmonth"]."-".$data["rday"]."'";
		}
		else {
			$field[]="rdate";
			$tdata[]="null";
		}
		$field[]="view_chk";
		$tdata[]="'".$data["view_chk"]."'";
		$field[]="title";
		$tdata[]="'".$data["title"]."'";
		$field[]="comm";
		$tdata[]="'".$data["comm"]."'";
		$field[]="link";
		$tdata[]="'".$data["link"]."'";
		$field[]="linktarget";
		$tdata[]="'".$data["linktarget"]."'";
		$field[]="view_type";
		$tdata[]="".$data["view_type"]."";
			if($data["rmonth"]!=NULL) {
  			$field[]="rmonth";
 				$tdata[]=$data["rmonth"];
			}
			if($data["ryear"]!=NULL) {
 				$field[]="ryear";
				$tdata[]=$data["ryear"];
			}
  		$field[]="cate_id";
			$tdata[]=$data["cate_id"];
		if($imagefile["filepath"]!=NULL) {
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
			$field[]="image";
			$tdata[]="'".$imagefile["filepath"]."'";
			@chmod($imagefile1["filepath"],0777);
			$ftp->MkDir("tmp",$bname."_data");
			$ftp->MkDir("tmp/".$bname."_data",$data["vup_id"]);
			$ftp->UpData("tmp/".$bname."_data/".$data["vup_id"]."/",$imagefile["name"],"../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$imagefile["name"],"b");
		}
		else if($data["delimage"]==1){
			if($setdata["detailsimg_defalt"]!=NULL){
				$field[]="image";
				$tdata[]="'".$setdata["detailsimg_defalt"]."'";
			}
			else {
				$field[]="image";
				$tdata[]="''";
			}
		}
		else if($data["oldphoto"]!=NULL) {
			
		}
		else if($setdata["detailsimg_defalt"]!=NULL){
			$field[]="image";
			$tdata[]="'".$setdata["detailsimg_defalt"]."'";
		}		
		
		$field[]="text1";
		$tdata[]="'".$data["text1"]."'";
		$field[]="text2";
		$tdata[]="'".$data["text2"]."'";
		$field[]="text3";
		$tdata[]="'".$data["text3"]."'";
			
		
		$db->Update($bname."_data",$field,$tdata," where vup_id = ".$data["vup_id"]);
		//$this->AdditionSubData($data);
				$db->Query("update lastupdate set lastupdate=".time()."");
	}
	function DeleteData($data){
		$db=$this->dbobj;
		$bname=$this->bname;
		
		//print_r($data);
		for($i=0;$data["delchk"][$i]!=NULL;$i++) {
			// echo $data["delchk"][$i];
			$db->Delete($bname."_data"," where vup_id= ".$data["delchk"][$i]);
			//$db->Delete($bname."_subdata"," where vup_id= ".$data["delchk"][$i]);
		}
	}
	
	function UpdateDataList($data) {
		$db=$this->dbobj;
		$bname=$this->bname;
	
		for($i=0;$data["vup_id"][$i]!=NULL;$i++) {
			if($data["turn"][$i]==NULL) {
				$data["turn"][$i]=0;
			}
			$field[]="turn";
			$tdata[]=$data["turn"][$i];
			$field[]="view_chk";
			$tdata[]=$data["view_chk"][$i];
			$db->Update($bname."_data",$field,$tdata," where vup_id = ".$data["vup_id"][$i]);
			unset($field,$tdata);
		}
		for($i=0;$data["vup_id1"][$i]!=NULL;$i++) {
			if($data["turn1"][$i]==NULL) {
				$data["turn1"][$i]=0;
			}
			$field[]="turn";
			$tdata[]=$data["turn1"][$i];
			$field[]="view_chk";
			$tdata[]=$data["view_chk1"][$i];
			$db->Update($bname."_data",$field,$tdata," where vup_id = ".$data["vup_id1"][$i]);
			unset($field,$tdata);
		} 
	}
	function DeleteOneData($id){
		$db=$this->dbobj;
		$bname=$this->bname;
		// echo $data["delchk"][$i];
		$db->Delete($bname."_data"," where vup_id= ".$id);
		//$db->Delete($bname."_subdata"," where vup_id= ".$id);
				$db->Query("update lastupdate set lastupdate=".time()."");
	}
	
}


/*
?><meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php
*/
?>