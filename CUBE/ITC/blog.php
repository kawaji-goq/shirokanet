<?php

class Site_Blog extends Ab_News{

	function Site_Blog($dbobj) {
		$this->dbobj=$dbobj;
		$this->bname="blog";
	}
	function GetDetailsData($id) {
		$db=$this->dbobj;
		$bname=$this->bname;
		if($id) {
			$data=$db->SelectData($bname."_data","where view_chk <> 0 and blog_id = ".$id);
			return $data;
		}
	}
	
	function GetBlogData($id,$type,$lim,$setnum,$orderby) {
		$db=$this->dbobj;
		$bname=$this->bname;
		switch($type) {
			case "blog":
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
		$sql="select distinct(ryear) from blog_data where view_chk <> 0 and view_type=0 order by ryear desc";
		$data=$db->GetList($sql);
		return $data;
	}
	function RMonthList($year) {		
		$db=$this->dbobj;
		$bname=$this->bname;
		if(is_null($year)||$year=="") {
			$year=date("Y");
		}
		$sql="select distinct ryear,rmonth from blog_data where view_chk <> 0 and view_type=0 and ryear=".$year." order by rmonth desc";
		$data=$db->GetList($sql);
		return $data;
	}
	function YearData($year) {
		$db=$this->dbobj;
		$bname=$this->bname;
		if(is_null($year)||$year=="") {
			$year=date("Y");
		}
		$data=$db->GetList("select * from blog_data where view_chk <> 0 and view_type=0 and ryear = ".$year." order by rdate desc");
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
		$data=$db->GetList("select * from blog_data where view_chk <> 0 and view_type=0 and rmonth=".$month." and ryear=".$year." order by rdate desc");
		return $data;
	}
}
class Admin_Blog extends Ab_AdminBasicType{

	function Admin_Blog($dbobj) {
		$this->dbobj=$dbobj;
		$this->bname="blog";
	}
	function GetDetailsData($id) {
		$db=$this->dbobj;
		$bname=$this->bname;
		if($id) {
			$data=$db->SelectData($bname."_data","where blog_id = ".$id);
			return $data;
		}
	}
		
	function AdditionData($data) {
		
		$db=$this->dbobj;
		$bname=$this->bname;
		if($data["new_data_title"]!=NULL||$data["new_data_comm"]!=NULL) {
			$db=$this->dbobj;
			$bname=$this->bname;
			$maxid=$db->GetMaxId($bname."_data","blog_id");
			unset($field,$tdata);
			
			if($data["new_view_chk"]==NULL){
				$data["new_view_chk"]=0;
			}
			
			if($data["new_view_type"]==NULL){
				$data["new_view_type"]=0;
			}
			$setdata=$this->LoadSet();
			
			$imgobj=new Upload();
			@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]);
			@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data");
			@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$maxid);
			$imgobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/";
			$imgobj->rpath="/tmp/".$bname."_data/".$maxid."/";
			$imagefile=$imgobj->UpImgAndResize("imagefile",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);
			if($imagefile["filepath"]!=NULL) {
			@copy($_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/imagefile.jpg",$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/imagefile2.jpg");
			$imgobj=new ImgMagic();
			$imgobj->cpandconv_Size($_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/imagefile2.jpg","imagefile2.jpg",$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/",$setdata["listimg_w"],$setdata["listimg_h"]);
			}
			
			$imgobj2=new Upload();
			$imgobj2->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/";
			$imgobj2->rpath="/tmp/".$bname."_data/".$maxid."/";
			$image_file2=$imgobj2->UpImgAndResize("image_file2",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);
			
			$imgobj3=new Upload();
			$imgobj3->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/";
			$imgobj3->rpath="/tmp/".$bname."_data/".$maxid."/";
			$image_file3=$imgobj3->UpImgAndResize("image_file3",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);

			
		if($data["day_view"]!=1) {
			$field[]="rdate";
			$tdata[]="'".$data["ryear"]."-".$data["rmonth"]."-".$data["rday"]."'";
		}
		else {
			$field[]="rdate";
			$tdata[]="null";
		}
		
			$field[]="blog_id";
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
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/",$imagefile["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$imagefile["name"],"b");
			}
			else if($setdata["detailsimg_defalt"]!=NULL){
				$field[]="image";
				$tdata[]="'".$setdata["detailsimg_defalt"]."'";
			}
			
		if($imagefile["filepath"]!=NULL) {
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
			$field[]="image2";
			$tdata[]="'/tmp/".$bname."_data/".$maxid."/imagefile2.jpg'";
			@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/imagefile2.jpg",0777);
			$ftp->UpData("tmp/".$bname."_data/".$maxid."/","imagefile2.jpg",$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/imagefile2.jpg","b");
		}
		else if($setdata["listimg_defalt"]!=NULL){
			$field[]="image2";
			$tdata[]="'".$setdata["listimg_defalt"]."'";
		}
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
	
			if($image_file2["filepath"]!=NULL) {
				$field[]="data_image2";
				$tdata[]="'".$image_file2["filepath"]."'";
				@chmod($image_file2["filepath"],0777);
				$ftp->MkDir("tmp",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$maxid);
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/",$image_file2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$image_file2["name"],"b");
			}
			else if($setdata["detailsimg_defalt"]!=NULL){
				$field[]="data_image2";
				$tdata[]="'".$setdata["detailsimg_defalt"]."'";
			}
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
	
			if($image_file3["filepath"]!=NULL) {
				$field[]="data_image3";
				$tdata[]="'".$image_file3["filepath"]."'";
				@chmod($image_file3["filepath"],0777);
				$ftp->MkDir("tmp",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$maxid);
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/",$image_file3["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$image_file3["name"],"b");
			}
			else if($setdata["detailsimg_defalt"]!=NULL){
				$field[]="data_image3";
				$tdata[]="'".$setdata["detailsimg_defalt"]."'";
			}
		
			$db->Insert($bname."_data",$field,$tdata);
			$data["blog_id"]=$maxid;
			//$this->AdditionSubData($data);
		}
		$db->Query("update lastupdate set lastupdate=".time()."");
		
				
		return $maxid;
	}
	
	function UpdateOneData($data) {
		$db=$this->dbobj;
		$bname=$this->bname;
		
		@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]);
		@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data");
		@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$data["blog_id"]);
		
		$setdata=$this->LoadSet();
		$imgobj=new Upload();
		$imgobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/";
		$imgobj->rpath="/tmp/".$bname."_data/".$data["blog_id"]."/";
			if($data["view_type"]==0) {
				$imagefile=$imgobj->UpImgAndResize("imagefile",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);
			}
			else {
				$imagefile=$imgobj->UpImgAndResize("imagefile",$setdata["listimg_w"],$setdata["listimg_h"]);
			}
			if($imagefile["filepath"]!=NULL) {
			@copy($_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/imagefile.jpg",$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/imagefile2.jpg");
			$imgobj=new ImgMagic();
			$imgobj->cpandconv_Size($_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/imagefile2.jpg","imagefile2.jpg",$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/",$setdata["listimg_w"],$setdata["listimg_h"]);
			}
			
		$imgobj2=new Upload();
		$imgobj2->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/";
		$imgobj2->rpath="/tmp/".$bname."_data/".$data["blog_id"]."/";
		$image_file2=$imgobj2->UpImgAndResize("image_file2",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);
			
		if($data["view_type"]==NULL) {
			$data["view_type"]=0;
		}
		
		$imgobj3=new Upload();
		$imgobj3->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/";
		$imgobj3->rpath="/tmp/".$bname."_data/".$data["blog_id"]."/";
		$image_file3=$imgobj3->UpImgAndResize("image_file3",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);
			
		if($data["view_type"]==NULL) {
			$data["view_type"]=0;
		}
		
		$field[]="rdate";
		$tdata[]="'".$data["ryear"]."-".$data["rmonth"]."-".$data["rday"]."'";
		
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
			$ftp->MkDir("tmp/".$bname."_data",$data["blog_id"]);
			$ftp->UpData("tmp/".$bname."_data/".$data["blog_id"]."/",$imagefile["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$imagefile["name"],"b");
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
		
		if($imagefile["filepath"]!=NULL) {
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
			$field[]="image2";
			$tdata[]="'/tmp/".$bname."_data/".$data["blog_id"]."/imagefile2.jpg'";
			@chmod("/tmp/".$bname."_data/".$data["blog_id"]."/imagefile2.jpg",0777);
			$ftp->UpData("tmp/".$bname."_data/".$data["blog_id"]."/","imagefile2.jpg",$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/imagefile2.jpg","b");
		}
		else if($data["delimage"]==1){
			if($setdata["listimg_defalt"]!=NULL){
				$field[]="image2";
				$tdata[]="'".$setdata["listimg_defalt"]."'";
			}
			else {
				$field[]="image2";
				$tdata[]="''";
			}
		}
		else if($data["oldphoto"]!=NULL) {
			
		}
		else if($setdata["listimg_defalt"]!=NULL){
			$field[]="image2";
			$tdata[]="'".$setdata["listimg_defalt"]."'";
		}
		
		if($image_file2["filepath"]!=NULL) {
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
			$field[]="data_image2";
			$tdata[]="'".$image_file2["filepath"]."'";
			@chmod($image_file2["filepath"],0777);
			$ftp->MkDir("tmp",$bname."_data");
			$ftp->MkDir("tmp/".$bname."_data",$data["blog_id"]);
			$ftp->UpData("tmp/".$bname."_data/".$data["blog_id"]."/",$image_file2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$image_file2["name"],"b");
		}
		else if($data["delimage2"]==1){
			if($setdata["detailsimg_defalt"]!=NULL){
				$field[]="image";
				$tdata[]="'".$setdata["detailsimg_defalt"]."'";
			}
			else {
				$field[]="data_image2";
				$tdata[]="''";
			}
		}
		else if($data["oldphoto"]!=NULL) {
			
		}
		else if($setdata["detailsimg_defalt"]!=NULL){
			$field[]="data_image2";
			$tdata[]="'".$setdata["detailsimg_defalt"]."'";
		}
		
		if($image_file3["filepath"]!=NULL) {
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
			$field[]="data_image3";
			$tdata[]="'".$image_file3["filepath"]."'";
			@chmod($image_file3["filepath"],0777);
			$ftp->MkDir("tmp",$bname."_data");
			$ftp->MkDir("tmp/".$bname."_data",$data["blog_id"]);
			$ftp->UpData("tmp/".$bname."_data/".$data["blog_id"]."/",$image_file3["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$image_file3["name"],"b");
		}
		else if($data["delimage3"]==1){
			if($setdata["detailsimg_defalt"]!=NULL){
				$field[]="data_image3";
				$tdata[]="'".$setdata["detailsimg_defalt"]."'";
			}
			else {
				$field[]="data_image3";
				$tdata[]="''";
			}
		}
		else if($data["oldphoto"]!=NULL) {
			
		}
		else if($setdata["detailsimg_defalt"]!=NULL){
			$field[]="data_image3";
			$tdata[]="'".$setdata["detailsimg_defalt"]."'";
		}
		
		
		$field[]="text1";
		$tdata[]="'".$data["text1"]."'";
		$field[]="text2";
		$tdata[]="'".$data["text2"]."'";
		$field[]="text3";
		$tdata[]="'".$data["text3"]."'";
			
		
		$db->Update($bname."_data",$field,$tdata," where blog_id = ".$data["blog_id"]);
		//$this->AdditionSubData($data);
				$db->Query("update lastupdate set lastupdate=".time()."");
	}
	function DeleteData($data){
		$db=$this->dbobj;
		$bname=$this->bname;
		
		//print_r($data);
		for($i=0;$data["delchk"][$i]!=NULL;$i++) {
			// echo $data["delchk"][$i];
			$db->Delete($bname."_data"," where blog_id= ".$data["delchk"][$i]);
			//$db->Delete($bname."_subdata"," where blog_id= ".$data["delchk"][$i]);
		}
	}
	
	function UpdateDataList($data) {
		$db=$this->dbobj;
		$bname=$this->bname;
	
		for($i=0;$data["blog_id"][$i]!=NULL;$i++) {
			if($data["turn"][$i]==NULL) {
				$data["turn"][$i]=0;
			}
			$field[]="turn";
			$tdata[]=$data["turn"][$i];
			$field[]="view_chk";
			$tdata[]=$data["view_chk"][$i];
			$db->Update($bname."_data",$field,$tdata," where blog_id = ".$data["blog_id"][$i]);
			unset($field,$tdata);
		} 
	}
	function DeleteOneData($id){
		$db=$this->dbobj;
		$bname=$this->bname;
		// echo $data["delchk"][$i];
		$db->Delete($bname."_data"," where blog_id= ".$id);
		//$db->Delete($bname."_subdata"," where blog_id= ".$id);
				$db->Query("update lastupdate set lastupdate=".time()."");
	}
	
}

class Admin_Blog2 extends Admin_Blog{
	function AdditionData($data) {
		
		$db=$this->dbobj;
		$bname=$this->bname;
		if($data["new_data_title"]!=NULL||$data["new_data_comm"]!=NULL) {
			$db=$this->dbobj;
			$bname=$this->bname;
			$maxid=$db->GetMaxId($bname."_data","blog_id");
			unset($field,$tdata);
			
			if($data["new_view_chk"]==NULL){
				$data["new_view_chk"]=0;
			}
			
			if($data["new_view_type"]==NULL){
				$data["new_view_type"]=0;
			}
			$setdata=$this->LoadSet();
			
			$imgobj=new Upload();
			@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]);
			@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data");
			@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$maxid);
			$imgobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/";
			$imgobj->rpath="/tmp/".$bname."_data/".$maxid."/";
			$imagefile=$imgobj->UpImgAndResize3("imagefile",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);
			if($imagefile["filepath"]!=NULL) {
			@copy($_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/imagefile.jpg",$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/imagefile2.jpg");
			$imgobj=new ImgMagic();
			$imgobj->cpandconv_Size($_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/imagefile2.jpg","imagefile2.jpg",$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/",$setdata["listimg_w"],$setdata["listimg_h"]);
			}
			
			$imgobj2=new Upload();
			$imgobj2->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/";
			$imgobj2->rpath="/tmp/".$bname."_data/".$maxid."/";
			$image_file2=$imgobj2->UpImgAndResize3("image_file2",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);
			
			$imgobj3=new Upload();
			$imgobj3->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/";
			$imgobj3->rpath="/tmp/".$bname."_data/".$maxid."/";
			$image_file3=$imgobj3->UpImgAndResize3("image_file3",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);

			
		if($data["day_view"]!=1) {
			$field[]="rdate";
			$tdata[]="'".$data["ryear"]."-".$data["rmonth"]."-".$data["rday"]."'";
		}
		else {
			$field[]="rdate";
			$tdata[]="null";
		}
		
			$field[]="blog_id";
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
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/",$imagefile["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$imagefile["name"],"b");
			}
			else if($setdata["detailsimg_defalt"]!=NULL){
				$field[]="image";
				$tdata[]="'".$setdata["detailsimg_defalt"]."'";
			}
			
		if($imagefile["filepath"]!=NULL) {
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
			$field[]="image2";
			$tdata[]="'/tmp/".$bname."_data/".$maxid."/imagefile2.jpg'";
			@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/imagefile2.jpg",0777);
			$ftp->UpData("tmp/".$bname."_data/".$maxid."/","imagefile2.jpg",$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/imagefile2.jpg","b");
		}
		else if($setdata["listimg_defalt"]!=NULL){
			$field[]="image2";
			$tdata[]="'".$setdata["listimg_defalt"]."'";
		}
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
	
			if($image_file2["filepath"]!=NULL) {
				$field[]="data_image2";
				$tdata[]="'".$image_file2["filepath"]."'";
				@chmod($image_file2["filepath"],0777);
				$ftp->MkDir("tmp",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$maxid);
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/",$image_file2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$image_file2["name"],"b");
			}
			else if($setdata["detailsimg_defalt"]!=NULL){
				$field[]="data_image2";
				$tdata[]="'".$setdata["detailsimg_defalt"]."'";
			}
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
	
			if($image_file3["filepath"]!=NULL) {
				$field[]="data_image3";
				$tdata[]="'".$image_file3["filepath"]."'";
				@chmod($image_file3["filepath"],0777);
				$ftp->MkDir("tmp",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$maxid);
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/",$image_file3["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$image_file3["name"],"b");
			}
			else if($setdata["detailsimg_defalt"]!=NULL){
				$field[]="data_image3";
				$tdata[]="'".$setdata["detailsimg_defalt"]."'";
			}
		
			$db->Insert($bname."_data",$field,$tdata);
			$data["blog_id"]=$maxid;
			//$this->AdditionSubData($data);
		}
		$db->Query("update lastupdate set lastupdate=".time()."");
		
				
		return $maxid;
	}
	
	function UpdateOneData($data) {
		$db=$this->dbobj;
		$bname=$this->bname;
		
		@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]);
		@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data");
		@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$data["blog_id"]);
		
		$setdata=$this->LoadSet();
		$imgobj=new Upload();
		
		if($_FILES["imagefile"]["error"]==0) {
			@unlink($_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/imagefile.jpg");
		}
		
		$imgobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/";
		$imgobj->rpath="/tmp/".$bname."_data/".$data["blog_id"]."/";
			if($data["view_type"]==0) {
				$imagefile=$imgobj->UpImgAndResize3("imagefile",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);
			}
			else {
				$imagefile=$imgobj->UpImgAndResize3("imagefile",$setdata["listimg_w"],$setdata["listimg_h"]);
			}
			if($imagefile["filepath"]!=NULL) {
			@copy($_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/imagefile.jpg",$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/imagefile2.jpg");
			$imgobj=new ImgMagic();
			$imgobj->cpandconv_Size_Noborder($_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/imagefile2.jpg","imagefile2.jpg",$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/",$setdata["listimg_w"],$setdata["listimg_h"]);
			}
			
		$imgobj2=new Upload();
		$imgobj2->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/";
		$imgobj2->rpath="/tmp/".$bname."_data/".$data["blog_id"]."/";
		$image_file2=$imgobj2->UpImgAndResize3("image_file2",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);
			
		if($data["view_type"]==NULL) {
			$data["view_type"]=0;
		}
		
		$imgobj3=new Upload();
		$imgobj3->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/";
		$imgobj3->rpath="/tmp/".$bname."_data/".$data["blog_id"]."/";
		$image_file3=$imgobj3->UpImgAndResize3("image_file3",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);
			
		if($data["view_type"]==NULL) {
			$data["view_type"]=0;
		}
		
		$field[]="rdate";
		$tdata[]="'".$data["ryear"]."-".$data["rmonth"]."-".$data["rday"]."'";
		
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
			$ftp->MkDir("tmp/".$bname."_data",$data["blog_id"]);
			$ftp->UpData("tmp/".$bname."_data/".$data["blog_id"]."/",$imagefile["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$imagefile["name"],"b");
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
		
		if($imagefile["filepath"]!=NULL) {
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
			$field[]="image2";
			$tdata[]="'/tmp/".$bname."_data/".$data["blog_id"]."/imagefile2.jpg'";
			@chmod("/tmp/".$bname."_data/".$data["blog_id"]."/imagefile2.jpg",0777);
			$ftp->UpData("tmp/".$bname."_data/".$data["blog_id"]."/","imagefile2.jpg",$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/imagefile2.jpg","b");
		}
		else if($data["delimage"]==1){
			if($setdata["listimg_defalt"]!=NULL){
				$field[]="image2";
				$tdata[]="'".$setdata["listimg_defalt"]."'";
			}
			else {
				$field[]="image2";
				$tdata[]="''";
			}
		}
		else if($data["oldphoto"]!=NULL) {
			
		}
		else if($setdata["listimg_defalt"]!=NULL){
			$field[]="image2";
			$tdata[]="'".$setdata["listimg_defalt"]."'";
		}
		
		if($image_file2["filepath"]!=NULL) {
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
			$field[]="data_image2";
			$tdata[]="'".$image_file2["filepath"]."'";
			@chmod($image_file2["filepath"],0777);
			$ftp->MkDir("tmp",$bname."_data");
			$ftp->MkDir("tmp/".$bname."_data",$data["blog_id"]);
			$ftp->UpData("tmp/".$bname."_data/".$data["blog_id"]."/",$image_file2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$image_file2["name"],"b");
		}
		else if($data["delimage2"]==1){
			if($setdata["detailsimg_defalt"]!=NULL){
				$field[]="image";
				$tdata[]="'".$setdata["detailsimg_defalt"]."'";
			}
			else {
				$field[]="data_image2";
				$tdata[]="''";
			}
		}
		else if($data["oldphoto"]!=NULL) {
			
		}
		else if($setdata["detailsimg_defalt"]!=NULL){
			$field[]="data_image2";
			$tdata[]="'".$setdata["detailsimg_defalt"]."'";
		}
		
		if($image_file3["filepath"]!=NULL) {
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
			$field[]="data_image3";
			$tdata[]="'".$image_file3["filepath"]."'";
			@chmod($image_file3["filepath"],0777);
			$ftp->MkDir("tmp",$bname."_data");
			$ftp->MkDir("tmp/".$bname."_data",$data["blog_id"]);
			$ftp->UpData("tmp/".$bname."_data/".$data["blog_id"]."/",$image_file3["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$image_file3["name"],"b");
		}
		else if($data["delimage3"]==1){
			if($setdata["detailsimg_defalt"]!=NULL){
				$field[]="data_image3";
				$tdata[]="'".$setdata["detailsimg_defalt"]."'";
			}
			else {
				$field[]="data_image3";
				$tdata[]="''";
			}
		}
		else if($data["oldphoto"]!=NULL) {
			
		}
		else if($setdata["detailsimg_defalt"]!=NULL){
			$field[]="data_image3";
			$tdata[]="'".$setdata["detailsimg_defalt"]."'";
		}
		
		
		$field[]="text1";
		$tdata[]="'".$data["text1"]."'";
		$field[]="text2";
		$tdata[]="'".$data["text2"]."'";
		$field[]="text3";
		$tdata[]="'".$data["text3"]."'";
			
		
		$db->Update($bname."_data",$field,$tdata," where blog_id = ".$data["blog_id"]);
		//$this->AdditionSubData($data);
				$db->Query("update lastupdate set lastupdate=".time()."");
	}
	function DeleteData($data){
		$db=$this->dbobj;
		$bname=$this->bname;
		
		//print_r($data);
		for($i=0;$data["delchk"][$i]!=NULL;$i++) {
			// echo $data["delchk"][$i];
			$db->Delete($bname."_data"," where blog_id= ".$data["delchk"][$i]);
			//$db->Delete($bname."_subdata"," where blog_id= ".$data["delchk"][$i]);
		}
	}
}
class Admin_Blog3 extends Admin_Blog{
	
	function AdditionData($data) {
		
		$db=$this->dbobj;
		$bname=$this->bname;
		if($data["new_data_title"]!=NULL||$data["new_data_comm"]!=NULL) {
			$db=$this->dbobj;
			$bname=$this->bname;
			 $maxid=$db->GetMaxId($bname."_data","blog_id");
			unset($field,$tdata);
			
			if($data["new_view_chk"]==NULL){
				$data["new_view_chk"]=0;
			}
			
			if($data["new_view_type"]==NULL){
				$data["new_view_type"]=0;
			}
			$setdata=$this->LoadSet();
			
			$imgobj=new Upload();
			@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/");
			@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data");
			@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid);
			$imgobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/";
			$imgobj->rpath="/tmp/".$bname."_data/".$maxid."/";
			$imagefile=$imgobj->UpImgAndResize("imagefile",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);
			if($imagefile["filepath"]!=NULL) {
				@unlink($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/image_file2.jpg");
					@unlink($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/imagefile2.jpg");
					
			@copy($_SERVER['DOCUMENT_ROOT'].$imagefile["filepath"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/image_file2.jpg");
			$imgobj=new ImgMagic();
			$imgobj->cpandconv_Size($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/image_file2.jpg","imagefile2.jpg",$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/",$setdata["listimg_w"],$setdata["listimg_h"]);
			
			}
			

			
		if($data["day_view"]!=1) {
			$field[]="rdate";
			$tdata[]="'".$data["ryear"]."-".$data["rmonth"]."-".$data["rday"]."'";
		}
		else {
			$field[]="rdate";
			$tdata[]="null";
		}
		
			$field[]="blog_id";
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
		
			if($imagefile["filepath"]!=NULL) {
				$field[]="image";
				$tdata[]="'".$imagefile["filepath"]."'";
				@chmod($imagefile["filepath"],0777);
			}
			else if($setdata["detailsimg_defalt"]!=NULL){
				$field[]="image";
				$tdata[]="'".$setdata["detailsimg_defalt"]."'";
			}
			
		if($imagefile["filepath"]!=NULL) {
			$field[]="image2";
			$tdata[]="'/tmp/".$bname."_data/".$maxid."/imagefile2.jpg'";
			@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/imagefile2.jpg",0777);
		}
		else if($setdata["listimg_defalt"]!=NULL){
			$field[]="image2";
			$tdata[]="'".$setdata["listimg_defalt"]."'";
		}
	
			if($image_file2["filepath"]!=NULL) {
				$field[]="data_image2";
				$tdata[]="'".$image_file2["filepath"]."'";
				@chmod($image_file2["filepath"],0777);
			}
			else if($setdata["detailsimg_defalt"]!=NULL){
				$field[]="data_image2";
				$tdata[]="'".$setdata["detailsimg_defalt"]."'";
			}
		
			if($image_file3["filepath"]!=NULL) {
				$field[]="data_image3";
				$tdata[]="'".$image_file3["filepath"]."'";
				@chmod($image_file3["filepath"],0777);
			}
			else if($setdata["detailsimg_defalt"]!=NULL){
				$field[]="data_image3";
				$tdata[]="'".$setdata["detailsimg_defalt"]."'";
			}
		
			$db->Insert($bname."_data",$field,$tdata);
			$data["blog_id"]=$maxid;
			//$this->AdditionSubData($data);
		}
		$db->Query("update lastupdate set lastupdate=".time()."");
		
				
		return $maxid;
	}
	
}
class Admin_Blog4 extends Admin_Blog{
	
	function AdditionData($data) {
		
		$db=$this->dbobj;
		$bname=$this->bname;
		if($data["new_data_title"]!=NULL||$data["new_data_comm"]!=NULL) {
			$db=$this->dbobj;
			$bname=$this->bname;
			 $maxid=$db->GetMaxId($bname."_data","blog_id");
			unset($field,$tdata);
			
			if($data["new_view_chk"]==NULL){
				$data["new_view_chk"]=0;
			}
			
			if($data["new_view_type"]==NULL){
				$data["new_view_type"]=0;
			}
			$setdata=$this->LoadSet();
			
			@unlink($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/imagefile.jpg");

			$imgobj=new Upload();
			@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/");
			@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data");
			@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid);
			$imgobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/";
			$imgobj->rpath="/tmp/".$bname."_data/".$maxid."/";
			$imagefile=$imgobj->UpImgAndResize("imagefile",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);
			if($imagefile["filepath"]!=NULL) {
				@unlink($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/image_file2.jpg");
				@unlink($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/imagefile2.jpg");
					
			@copy($_SERVER['DOCUMENT_ROOT'].$imagefile["filepath"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/image_file2.jpg");
			$imgobj=new ImgMagic();
			$imgobj->cpandconv_Size($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/image_file2.jpg","imagefile2.jpg",$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/",$setdata["listimg_w"],$setdata["listimg_h"]);
			
			}
			

			
		if($data["day_view"]!=1) {
			$field[]="rdate";
			$tdata[]="'".$data["ryear"]."-".$data["rmonth"]."-".$data["rday"]."'";
		}
		else {
			$field[]="rdate";
			$tdata[]="null";
		}
		
			$field[]="blog_id";
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
		
			if($imagefile["filepath"]!=NULL) {
				$field[]="image";
				$tdata[]="'".$imagefile["filepath"]."'";
				@chmod($imagefile["filepath"],0777);
			}
			else if($setdata["detailsimg_defalt"]!=NULL){
				$field[]="image";
				$tdata[]="'".$setdata["detailsimg_defalt"]."'";
			}
			
		if($imagefile["filepath"]!=NULL) {
			$field[]="image2";
			$tdata[]="'/tmp/".$bname."_data/".$maxid."/imagefile2.jpg'";
			@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/imagefile2.jpg",0777);
		}
		else if($setdata["listimg_defalt"]!=NULL){
			$field[]="image2";
			$tdata[]="'".$setdata["listimg_defalt"]."'";
		}
	
			if($image_file2["filepath"]!=NULL) {
				$field[]="data_image2";
				$tdata[]="'".$image_file2["filepath"]."'";
				@chmod($image_file2["filepath"],0777);
			}
			else if($setdata["detailsimg_defalt"]!=NULL){
				$field[]="data_image2";
				$tdata[]="'".$setdata["detailsimg_defalt"]."'";
			}
		
			if($image_file3["filepath"]!=NULL) {
				$field[]="data_image3";
				$tdata[]="'".$image_file3["filepath"]."'";
				@chmod($image_file3["filepath"],0777);
			}
			else if($setdata["detailsimg_defalt"]!=NULL){
				$field[]="data_image3";
				$tdata[]="'".$setdata["detailsimg_defalt"]."'";
			}
		
			$db->Insert($bname."_data",$field,$tdata);
			$data["blog_id"]=$maxid;
			//$this->AdditionSubData($data);
		}
		$db->Query("update lastupdate set lastupdate=".time()."");
		
				
		return $maxid;
	}
		function UpdateOneData($data) {
		$db=$this->dbobj;
		$bname=$this->bname;
		
		@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/");
		@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data");
		@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$data["blog_id"]);
		
		$setdata=$this->LoadSet();
		$imgobj=new Upload();
		
		if($_FILES["imagefile"]["error"]==0) {
			@unlink($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$data["blog_id"]."/imagefile.jpg");
		}
		
		$imgobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$data["blog_id"]."/";
		$imgobj->rpath="/tmp/".$bname."_data/".$data["blog_id"]."/";
			if($data["view_type"]==0) {
				$imagefile=$imgobj->UpImgAndResize("imagefile",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);
			}
			else {
				$imagefile=$imgobj->UpImgAndResize("imagefile",$setdata["listimg_w"],$setdata["listimg_h"]);
			}
			if($imagefile["filepath"]!=NULL) {
			@copy($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$data["blog_id"]."/imagefile.jpg",$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$data["blog_id"]."/imagefile2.jpg");
			$imgobj=new ImgMagic();
			$imgobj->cpandconv_Size_Noborder($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$data["blog_id"]."/imagefile2.jpg","imagefile2.jpg",$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$data["blog_id"]."/",$setdata["listimg_w"],$setdata["listimg_h"]);
			}
			
		$imgobj2=new Upload();
		$imgobj2->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$data["blog_id"]."/";
		$imgobj2->rpath="/tmp/".$bname."_data/".$data["blog_id"]."/";
		$image_file2=$imgobj2->UpImgAndResize("image_file2",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);
			
		if($data["view_type"]==NULL) {
			$data["view_type"]=0;
		}
		
		$imgobj3=new Upload();
		$imgobj3->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$data["blog_id"]."/";
		$imgobj3->rpath="/tmp/".$bname."_data/".$data["blog_id"]."/";
		$image_file3=$imgobj3->UpImgAndResize("image_file3",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);
			
		if($data["view_type"]==NULL) {
			$data["view_type"]=0;
		}
		
		$field[]="rdate";
		$tdata[]="'".$data["ryear"]."-".$data["rmonth"]."-".$data["rday"]."'";
		
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
			$ftp->MkDir("tmp/".$bname."_data",$data["blog_id"]);
			$ftp->UpData("tmp/".$bname."_data/".$data["blog_id"]."/",$imagefile["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$data["blog_id"]."/".$imagefile["name"],"b");
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
		
		if($imagefile["filepath"]!=NULL) {
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
			$field[]="image2";
			$tdata[]="'/tmp/".$bname."_data/".$data["blog_id"]."/imagefile2.jpg'";
			@chmod("/tmp/".$bname."_data/".$data["blog_id"]."/imagefile2.jpg",0777);
			$ftp->UpData("tmp/".$bname."_data/".$data["blog_id"]."/","imagefile2.jpg",$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$data["blog_id"]."/imagefile2.jpg","b");
		}
		else if($data["delimage"]==1){
			if($setdata["listimg_defalt"]!=NULL){
				$field[]="image2";
				$tdata[]="'".$setdata["listimg_defalt"]."'";
			}
			else {
				$field[]="image2";
				$tdata[]="''";
			}
		}
		else if($data["oldphoto"]!=NULL) {
			
		}
		else if($setdata["listimg_defalt"]!=NULL){
			$field[]="image2";
			$tdata[]="'".$setdata["listimg_defalt"]."'";
		}
		
		if($image_file2["filepath"]!=NULL) {
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
			$field[]="data_image2";
			$tdata[]="'".$image_file2["filepath"]."'";
			@chmod($image_file2["filepath"],0777);
			$ftp->MkDir("tmp",$bname."_data");
			$ftp->MkDir("tmp/".$bname."_data",$data["blog_id"]);
			$ftp->UpData("tmp/".$bname."_data/".$data["blog_id"]."/",$image_file2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$data["blog_id"]."/".$image_file2["name"],"b");
		}
		else if($data["delimage2"]==1){
			if($setdata["detailsimg_defalt"]!=NULL){
				$field[]="image";
				$tdata[]="'".$setdata["detailsimg_defalt"]."'";
			}
			else {
				$field[]="data_image2";
				$tdata[]="''";
			}
		}
		else if($data["oldphoto"]!=NULL) {
			
		}
		else if($setdata["detailsimg_defalt"]!=NULL){
			$field[]="data_image2";
			$tdata[]="'".$setdata["detailsimg_defalt"]."'";
		}
		
		if($image_file3["filepath"]!=NULL) {
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
			$field[]="data_image3";
			$tdata[]="'".$image_file3["filepath"]."'";
			@chmod($image_file3["filepath"],0777);
			$ftp->MkDir("tmp",$bname."_data");
			$ftp->MkDir("tmp/".$bname."_data",$data["blog_id"]);
			$ftp->UpData("tmp/".$bname."_data/".$data["blog_id"]."/",$image_file3["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$data["blog_id"]."/".$image_file3["name"],"b");
		}
		else if($data["delimage3"]==1){
			if($setdata["detailsimg_defalt"]!=NULL){
				$field[]="data_image3";
				$tdata[]="'".$setdata["detailsimg_defalt"]."'";
			}
			else {
				$field[]="data_image3";
				$tdata[]="''";
			}
		}
		else if($data["oldphoto"]!=NULL) {
			
		}
		else if($setdata["detailsimg_defalt"]!=NULL){
			$field[]="data_image3";
			$tdata[]="'".$setdata["detailsimg_defalt"]."'";
		}
		
		$field[]="text1";
		$tdata[]="'".$data["text1"]."'";
		$field[]="text2";
		$tdata[]="'".$data["text2"]."'";
		$field[]="text3";
		$tdata[]="'".$data["text3"]."'";
			
		$db->Update($bname."_data",$field,$tdata," where blog_id = ".$data["blog_id"]);
		//$this->AdditionSubData($data);
				$db->Query("update lastupdate set lastupdate=".time()."");
	}

}
class Admin_Blog5 extends Admin_Blog{
	
	function AdditionData($data) {
		
		$db=$this->dbobj;
		$bname=$this->bname;
		if($data["new_data_title"]!=NULL||$data["new_data_comm"]!=NULL) {
			$db=$this->dbobj;
			$bname=$this->bname;
			 $maxid=$db->GetMaxId($bname."_data","blog_id");
			unset($field,$tdata);
			
			if($data["new_view_chk"]==NULL){
				$data["new_view_chk"]=0;
			}
			
			if($data["new_view_type"]==NULL){
				$data["new_view_type"]=0;
			}
			$setdata=$this->LoadSet();
			
			$imgobj=new Upload();
			@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/");
			@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data");
			@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid);
			$imgobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/";
			$imgobj->rpath="/tmp/".$bname."_data/".$maxid."/";
			$imagefile=$imgobj->UpImgAndResize("imagefile",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);
			if($imagefile["filepath"]!=NULL) {
				@unlink($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/image_file.jpg");
				@unlink($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/imagefile2.jpg");
					
			@copy($_SERVER['DOCUMENT_ROOT'].$imagefile["filepath"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/image_file2.jpg");
			$imgobj=new ImgMagic();
			$imgobj->cpandconv_Size($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/image_file2.jpg","imagefile2.jpg",$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/",$setdata["listimg_w"],$setdata["listimg_h"]);
			
			}
			

			
		if($data["day_view"]!=1) {
			$field[]="rdate";
			$tdata[]="'".$data["ryear"]."-".$data["rmonth"]."-".$data["rday"]."'";
		}
		else {
			$field[]="rdate";
			$tdata[]="null";
		}
		
			$field[]="blog_id";
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
		
			if($imagefile["filepath"]!=NULL) {
				$field[]="image";
				$tdata[]="'".$imagefile["filepath"]."'";
				@chmod($imagefile["filepath"],0777);
			}
			else if($setdata["detailsimg_defalt"]!=NULL){
				$field[]="image";
				$tdata[]="'".$setdata["detailsimg_defalt"]."'";
			}
			
		if($imagefile["filepath"]!=NULL) {
			$field[]="image2";
			$tdata[]="'/tmp/".$bname."_data/".$maxid."/imagefile2.jpg'";
			@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/imagefile2.jpg",0777);
		}
		else if($setdata["listimg_defalt"]!=NULL){
			$field[]="image2";
			$tdata[]="'".$setdata["listimg_defalt"]."'";
		}
	
			if($image_file2["filepath"]!=NULL) {
				$field[]="data_image2";
				$tdata[]="'".$image_file2["filepath"]."'";
				@chmod($image_file2["filepath"],0777);
			}
			else if($setdata["detailsimg_defalt"]!=NULL){
				$field[]="data_image2";
				$tdata[]="'".$setdata["detailsimg_defalt"]."'";
			}
		
			if($image_file3["filepath"]!=NULL) {
				$field[]="data_image3";
				$tdata[]="'".$image_file3["filepath"]."'";
				@chmod($image_file3["filepath"],0777);
			}
			else if($setdata["detailsimg_defalt"]!=NULL){
				$field[]="data_image3";
				$tdata[]="'".$setdata["detailsimg_defalt"]."'";
			}
		
			$db->Insert($bname."_data",$field,$tdata);
			$data["blog_id"]=$maxid;
			//$this->AdditionSubData($data);
		}
		$db->Query("update lastupdate set lastupdate=".time()."");

		
				
		return $maxid;
	}
	function UpdateOneData($data) {
		$db=$this->dbobj;
		$bname=$this->bname;
		
		@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data");
		@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$data["blog_id"]);
		
		$setdata=$this->LoadSet();
		$imgobj=new Upload();
		
		if($_FILES["imagefile"]["error"]==0) {
			@unlink($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$data["blog_id"]."/imagefile.jpg");
		}
		//print_r($data);
		 $imgobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$data["blog_id"]."/";
		//exit();
		$imgobj->rpath="/tmp/".$bname."_data/".$data["blog_id"]."/";
			if($data["view_type"]==0) {
				$imagefile=$imgobj->UpImgAndResize("imagefile",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);
			}
			else {
				$imagefile=$imgobj->UpImgAndResize("imagefile",$setdata["listimg_w"],$setdata["listimg_h"]);
			}
			if($imagefile["filepath"]!=NULL) {
			@copy($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/imagefile.jpg",$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$data["blog_id"]."/imagefile2.jpg");
			$imgobj=new ImgMagic();
			$imgobj->cpandconv_Size_Noborder($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$data["blog_id"]."/imagefile2.jpg","imagefile2.jpg",$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$data["blog_id"]."/",$setdata["listimg_w"],$setdata["listimg_h"]);
			}
			
		$imgobj2=new Upload();
		$imgobj2->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/";
		$imgobj2->rpath="/tmp/".$bname."_data/".$data["blog_id"]."/";
		$image_file2=$imgobj2->UpImgAndResize3("image_file2",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);
			
		if($data["view_type"]==NULL) {
			$data["view_type"]=0;
		}
		
		$imgobj3=new Upload();
		$imgobj3->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/";
		$imgobj3->rpath="/tmp/".$bname."_data/".$data["blog_id"]."/";
		$image_file3=$imgobj3->UpImgAndResize3("image_file3",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);
			
		if($data["view_type"]==NULL) {
			$data["view_type"]=0;
		}
		
		$field[]="rdate";
		$tdata[]="'".$data["ryear"]."-".$data["rmonth"]."-".$data["rday"]."'";
		
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
			$field[]="image";
			$tdata[]="'".$imagefile["filepath"]."'";
			@chmod($imagefile1["filepath"],0777);
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
		
		if($imagefile["filepath"]!=NULL) {
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
			$field[]="image2";
			$tdata[]="'/tmp/".$bname."_data/".$data["blog_id"]."/imagefile2.jpg'";
			@chmod("/tmp/".$bname."_data/".$data["blog_id"]."/imagefile2.jpg",0777);
			$ftp->UpData("tmp/".$bname."_data/".$data["blog_id"]."/","imagefile2.jpg",$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/imagefile2.jpg","b");
		}
		else if($data["delimage"]==1){
			if($setdata["listimg_defalt"]!=NULL){
				$field[]="image2";
				$tdata[]="'".$setdata["listimg_defalt"]."'";
			}
			else {
				$field[]="image2";
				$tdata[]="''";
			}
		}
		else if($data["oldphoto"]!=NULL) {
			
		}
		else if($setdata["listimg_defalt"]!=NULL){
			$field[]="image2";
			$tdata[]="'".$setdata["listimg_defalt"]."'";
		}
		
		if($image_file2["filepath"]!=NULL) {
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
			$field[]="data_image2";
			$tdata[]="'".$image_file2["filepath"]."'";
			@chmod($image_file2["filepath"],0777);
			$ftp->MkDir("tmp",$bname."_data");
			$ftp->MkDir("tmp/".$bname."_data",$data["blog_id"]);
			$ftp->UpData("tmp/".$bname."_data/".$data["blog_id"]."/",$image_file2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$image_file2["name"],"b");
		}
		else if($data["delimage2"]==1){
			if($setdata["detailsimg_defalt"]!=NULL){
				$field[]="image";
				$tdata[]="'".$setdata["detailsimg_defalt"]."'";
			}
			else {
				$field[]="data_image2";
				$tdata[]="''";
			}
		}
		else if($data["oldphoto"]!=NULL) {
			
		}
		else if($setdata["detailsimg_defalt"]!=NULL){
			$field[]="data_image2";
			$tdata[]="'".$setdata["detailsimg_defalt"]."'";
		}
		
		if($image_file3["filepath"]!=NULL) {
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
			$field[]="data_image3";
			$tdata[]="'".$image_file3["filepath"]."'";
			@chmod($image_file3["filepath"],0777);
			$ftp->MkDir("tmp",$bname."_data");
			$ftp->MkDir("tmp/".$bname."_data",$data["blog_id"]);
			$ftp->UpData("tmp/".$bname."_data/".$data["blog_id"]."/",$image_file3["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$image_file3["name"],"b");
		}
		else if($data["delimage3"]==1){
			if($setdata["detailsimg_defalt"]!=NULL){
				$field[]="data_image3";
				$tdata[]="'".$setdata["detailsimg_defalt"]."'";
			}
			else {
				$field[]="data_image3";
				$tdata[]="''";
			}
		}
		else if($data["oldphoto"]!=NULL) {
			
		}
		else if($setdata["detailsimg_defalt"]!=NULL){
			$field[]="data_image3";
			$tdata[]="'".$setdata["detailsimg_defalt"]."'";
		}
		
		
		$field[]="text1";
		$tdata[]="'".$data["text1"]."'";
		$field[]="text2";
		$tdata[]="'".$data["text2"]."'";
		$field[]="text3";
		$tdata[]="'".$data["text3"]."'";
			
		
		$db->Update($bname."_data",$field,$tdata," where blog_id = ".$data["blog_id"]);
		//$this->AdditionSubData($data);
				$db->Query("update lastupdate set lastupdate=".time()."");
	}
}

/*
?><meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php
*/
?>