<?php

class Site_News extends Ab_News{

	function Site_News($dbobj) {
		$this->dbobj=$dbobj;
		$this->bname="news";
	}
	function GetDetailsData($id) {
		$db=$this->dbobj;
		$bname=$this->bname;
		if($id) {
			$data=$db->SelectData($bname."_data","where view_chk <> 0 and news_id = ".$id);
			return $data;
		}
	}
	
	function GetNewsData($id,$type,$lim,$setnum,$orderby) {
		$db=$this->dbobj;
		$bname=$this->bname;
		switch($type) {
			case "news":
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
		$sql="select distinct(ryear) from news_data where view_chk <> 0 and view_type=0 order by ryear desc";
		$data=$db->GetList($sql);
		return $data;
	}
	function RMonthList($year) {		
		$db=$this->dbobj;
		$bname=$this->bname;
		if(is_null($year)||$year=="") {
			$year=date("Y");
		}
		$sql="select distinct ryear,rmonth from news_data where view_chk <> 0 and view_type=0 and ryear=".$year." order by rmonth desc";
		$data=$db->GetList($sql);
		return $data;
	}
	function YearData($year) {
		$db=$this->dbobj;
		$bname=$this->bname;
		if(is_null($year)||$year=="") {
			$year=date("Y");
		}
		$data=$db->GetList("select * from news_data where view_chk <> 0 and view_type=0 and ryear = ".$year." order by rdate desc");
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
		$data=$db->GetList("select * from news_data where view_chk <> 0 and view_type=0 and rmonth=".$month." and ryear=".$year." order by rdate desc");
		return $data;
	}
}
class Admin_News extends Ab_AdminBasicType{

	function Admin_News($dbobj) {
		$this->dbobj=$dbobj;
		$this->bname="news";
	}
	function GetDetailsData($id) {
		$db=$this->dbobj;
		$bname=$this->bname;
		if($id) {
			$data=$db->SelectData($bname."_data","where news_id = ".$id);
			return $data;
		}
	}
		
	function AdditionData($data) {
	if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
		$db=$this->dbobj;
		$bname=$this->bname;
		if($data["new_data_title"]!=NULL||$data["new_data_comm"]!=NULL) {
			$db=$this->dbobj;
			$bname=$this->bname;
			$maxid=$db->GetMaxId($bname."_data","news_id");
			unset($field,$tdata);
			
			if($data["new_view_chk"]==NULL){
				$data["new_view_chk"]=0;
			}
			
			if($data["new_view_type"]==NULL){
				$data["new_view_type"]=0;
			}
			
			$setdata=$this->LoadSet();
			
			$imgobj=new Upload();
			//echo $_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"];
			@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]);
			@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data");
			@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$maxid);
			$imgobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$maxid."/";
			$imgobj->rpath="/tmp/".$bname."_data/".$maxid."/";
			$imagefile=$imgobj->UpImgAndResize("imagefile",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);
			@copy($_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$maxid."/".$imagefile["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$maxid."/imagefile2.jpg");
			$imgobj=new ImgMagic();
			
			if($db->name=="atom"){
			if($data["new_view_type"]==0){
						$imgobj->cpandconv_Size($_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$maxid."/imagefile1.jpg","imagefile2.jpg",$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$maxid."/",350,0);
			}
			else{
						$imgobj->cpandconv_Size($_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$maxid."/imagefile1.jpg","imagefile2.jpg",$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$maxid."/",517,0);
						}
		}
		else{
			$imgobj->cpandconv_Size($_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$maxid."/imagefile1.jpg","imagefile2.jpg",$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$maxid."/",$setdata["listimg_w"],$setdata["listimg_h"]);
			}
			
		if($data["day_view"]!=1) {
			$field[]="rdate";
			$tdata[]="'".$data["ryear"]."-".$data["rmonth"]."-".$data["rday"]."'";
		}
		else {
			$field[]="rdate";
			$tdata[]="null";
		}
		
			$field[]="news_id";
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
			
		if($data["day_view"]!=1) {
 		$field[]="rmonth";
 			$tdata[]=$data["rmonth"];
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
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/",$imagefile["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/"."/".$maxid."/".$imagefile["name"],"b");
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
			$ftp->UpData("tmp/".$bname."_data/".$maxid."/","imagefile2.jpg",$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$maxid."/imagefile2.jpg","b");
		}
		else if($setdata["listimg_defalt"]!=NULL){
			$field[]="image2";
			$tdata[]="'".$setdata["listimg_defalt"]."'";
		}
			$db->Insert($bname."_data",$field,$tdata);
			$data["news_id"]=$maxid;
			//$this->AdditionSubData($data);
		}
		$db->Query("update lastupdate set lastupdate=".time()."");
		return $maxid;
		}
		else{
		
		
		$db=$this->dbobj;
		$bname=$this->bname;
		if($data["new_data_title"]!=NULL||$data["new_data_comm"]!=NULL) {
			$db=$this->dbobj;
			$bname=$this->bname;
			$maxid=$db->GetMaxId($bname."_data","news_id");
			unset($field,$tdata);
			
			if($data["new_view_chk"]==NULL){
				$data["new_view_chk"]=0;
			}
			
			if($data["new_view_type"]==NULL){
				$data["new_view_type"]=0;
			}
			
			$setdata=$this->LoadSet();
			
			$imgobj=new Upload();
			@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp");
			@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data");
			@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid);
			$imgobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/";
			$imgobj->rpath="/tmp/".$bname."_data/".$maxid."/";
			
			if($db->name=="atom"){
			if($data["new_view_type"]==0){
			$imagefile=$imgobj->UpImgAndResize("imagefile",350,0);
			}
			else {
			$imagefile=$imgobj->UpImgAndResize("imagefile",517,0);
			}
			}
			else{
			$imagefile=$imgobj->UpImgAndResize("imagefile",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);
			}
			@copy($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/".$imagefile["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/imagefile2.jpg");
			$imgobj=new ImgMagic();
			
			if($db->name=="atom"){
			
						$imgobj->cpandconv_Size($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/imagefile2.jpg","imagefile2.jpg",$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/",517,0);

		}
		else{
			$imgobj->cpandconv_Size($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/imagefile2.jpg","imagefile2.jpg",$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/",$setdata["listimg_w"],$setdata["listimg_h"]);
			}
			
		if($data["day_view"]!=1) {
			$field[]="rdate";
			$tdata[]="'".$data["ryear"]."-".$data["rmonth"]."-".$data["rday"]."'";
		}
		else {
			$field[]="rdate";
			$tdata[]="null";
		}
		
			$field[]="news_id";
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
			
		if($data["day_view"]!=1) {
 		$field[]="rmonth";
 			$tdata[]=$data["rmonth"];
 			$field[]="ryear";
			$tdata[]=$data["ryear"];
		}
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);

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
			$db->Insert($bname."_data",$field,$tdata);
			$data["news_id"]=$maxid;
			//$this->AdditionSubData($data);
		}
		$db->Query("update lastupdate set lastupdate=".time()."");
		return $maxid;		}
	}
	
	function UpdateOneData($data) {
		if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){

		$db=$this->dbobj;
		$bname=$this->bname;
		
		@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]);
		@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data");
		@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$data["news_id"]);
		
		$setdata=$this->LoadSet();
		$imgobj=new Upload();
		$imgobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$data["news_id"]."/";
		$imgobj->rpath="/tmp/".$bname."_data/".$data["news_id"]."/";
		if($db->name=="atom"){
			
			if($data["view_type"]==0) {
				$imagefile=$imgobj->UpImgAndResize("imagefile",350 ,0);
			}
			else {
				$imagefile=$imgobj->UpImgAndResize("imagefile",517,0);
			}
		}
		else{
			if($data["view_type"]==0) {
				$imagefile=$imgobj->UpImgAndResize("imagefile",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);
			}
			else {
				$imagefile=$imgobj->UpImgAndResize("imagefile",$setdata["listimg_w"],$setdata["listimg_h"]);
			}
			}
			
			@copy($_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$data["news_id"]."/".$imagefile["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$data["news_id"]."/imagefile2.jpg");
			$imgobj=new ImgMagic();
		
			$imgobj->cpandconv_Size($_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$data["news_id"]."/imagefile2.jpg","imagefile2.jpg",$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$data["news_id"]."/",$setdata["listimg_w"],$setdata["listimg_h"]);
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
		
		if($data["day_view"]!=1) {
 		$field[]="rmonth";
 			$tdata[]=$data["rmonth"];
 			$field[]="ryear";
			$tdata[]=$data["ryear"];
		}
		else {
  		$field[]="rmonth";
 			$tdata[]="null";
 			$field[]="ryear";
			$tdata[]="null";
		}
		if($imagefile["filepath"]!=NULL) {
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
			$field[]="image";
			$tdata[]="'".$imagefile["filepath"]."'";
			@chmod($imagefile1["filepath"],0777);
			$ftp->MkDir("tmp",$bname."_data");
			$ftp->MkDir("tmp/".$bname."_data",$data["news_id"]);
			$ftp->UpData("tmp/".$bname."_data/".$data["news_id"]."/",$imagefile["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$data["news_id"]."/".$imagefile["name"],"b");
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
			$tdata[]="'/tmp/".$bname."_data/".$data["news_id"]."/imagefile2.jpg'";
			@chmod("/tmp/".$bname."_data/".$data["news_id"]."/imagefile2.jpg",0777);
			$ftp->UpData("tmp/".$bname."_data/".$data["news_id"]."/","imagefile2.jpg",$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$data["news_id"]."/imagefile2.jpg","b");
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
		$db->Update($bname."_data",$field,$tdata," where news_id = ".$data["news_id"]);
		//$this->AdditionSubData($data);
				$db->Query("update lastupdate set lastupdate=".time()."");
				}
				else {
				////////////////////////////////////////////////////////////////////
						$db=$this->dbobj;
		$bname=$this->bname;
		
		@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp");
		@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data");
		@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$data["news_id"]);
		
		$setdata=$this->LoadSet();
		$imgobj=new Upload();
		$imgobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$data["news_id"]."/";
		$imgobj->rpath="/tmp/".$bname."_data/".$data["news_id"]."/";
		if($db->name=="atom"){
			
			if($data["view_type"]==0) {
			
				$imagefile=$imgobj->UpImgAndResize("imagefile",350 ,0);
			}
			else {
				$imagefile=$imgobj->UpImgAndResize("imagefile",517,0);
			}
		}
		else{
			if($data["view_type"]==0) {
				$imagefile=$imgobj->UpImgAndResize("imagefile",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);
			}
			else {
				$imagefile=$imgobj->UpImgAndResize("imagefile",$setdata["listimg_w"],$setdata["listimg_h"]);
			}
			}
			
			@copy($_SERVER['DOCUMENT_ROOT']."/tmp//".$bname."_data/".$data["news_id"]."/".$imagefile["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$data["news_id"]."/imagefile2.jpg");
			$imgobj=new ImgMagic();
		
			$imgobj->cpandconv_Size($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$data["news_id"]."/imagefile2.jpg","imagefile2.jpg",$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$data["news_id"]."/",$setdata["listimg_w"],$setdata["listimg_h"]);
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
		
		if($data["day_view"]!=1) {
 		$field[]="rmonth";
 			$tdata[]=$data["rmonth"];
 			$field[]="ryear";
			$tdata[]=$data["ryear"];
		}
		else {
  		$field[]="rmonth";
 			$tdata[]="null";
 			$field[]="ryear";
			$tdata[]="null";
		}
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
			$field[]="image2";
			$tdata[]="'/tmp/".$bname."_data/".$data["news_id"]."/imagefile2.jpg'";
			@chmod("/tmp/".$bname."_data/".$data["news_id"]."/imagefile2.jpg",0777);
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
		$db->Update($bname."_data",$field,$tdata," where news_id = ".$data["news_id"]);
		//$this->AdditionSubData($data);
				$db->Query("update lastupdate set lastupdate=".time()."");
								}
	}
	function DeleteData($data){
		$db=$this->dbobj;
		$bname=$this->bname;
		
		//print_r($data);
		for($i=0;$data["delchk"][$i]!=NULL;$i++) {
			// echo $data["delchk"][$i];
			$db->Delete($bname."_data"," where news_id= ".$data["delchk"][$i]);
			//$db->Delete($bname."_subdata"," where news_id= ".$data["delchk"][$i]);
		}
	}
	
	function UpdateDataList($data) {
		$db=$this->dbobj;
		$bname=$this->bname;
	
		for($i=0;$data["news_id"][$i]!=NULL;$i++) {
			if($data["turn"][$i]==NULL) {
				$data["turn"][$i]=0;
			}
			$field[]="turn";
			$tdata[]=$data["turn"][$i];
			$field[]="view_chk";
			$tdata[]=$data["view_chk"][$i];
			$db->Update($bname."_data",$field,$tdata," where news_id = ".$data["news_id"][$i]);
			unset($field,$tdata);
		} 
	}
	function DeleteOneData($id){
		$db=$this->dbobj;
		$bname=$this->bname;
		// echo $data["delchk"][$i];
		$db->Delete($bname."_data"," where news_id= ".$id);
		//$db->Delete($bname."_subdata"," where news_id= ".$id);
				$db->Query("update lastupdate set lastupdate=".time()."");
	}
	
}


/*
?><meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php
*/
?>