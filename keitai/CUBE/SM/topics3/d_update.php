<?php 
class My_Blog extends Admin_Blog{

	function My_Blog($dbobj) {
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
			$imagefile=$imgobj->UpImgAndResize("imagefile",679,"");
			if($imagefile["filepath"]!=NULL) {
			@copy($_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/imagefile.jpg",$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/imagefile2.jpg");
			$imgobj=new ImgMagic();
			$imgobj->cpandconv_Size($_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/imagefile2.jpg","imagefile2.jpg",$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/",$setdata["listimg_w"],$setdata["listimg_h"]);
			}
			
			$imgobj2=new Upload();
			$imgobj2->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/";
			$imgobj2->rpath="/tmp/".$bname."_data/".$maxid."/";
			$image_file2=$imgobj2->UpImgAndResize("image_file2",679,"");
			
			$imgobj3=new Upload();
			$imgobj3->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/";
			$imgobj3->rpath="/tmp/".$bname."_data/".$maxid."/";
			$image_file3=$imgobj3->UpImgAndResize("imagefile3",679,"");

			$imgobj4=new Upload();
			$imgobj4->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/";
			$imgobj4->rpath="/tmp/".$bname."_data/".$maxid."/";
			$image_file4=$imgobj4->UpImgAndResize("imagefile4",679,"");


			$imgobj5=new Upload();
			$imgobj5->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/";
			$imgobj5->rpath="/tmp/".$bname."_data/".$maxid."/";
			$image_file5=$imgobj5->UpImgAndResize("image_file5",679,"");


			$imgobj6=new Upload();
			$imgobj6->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/";
			$imgobj6->rpath="/tmp/".$bname."_data/".$maxid."/";
			$image_file6=$imgobj6->UpImgAndResize("image_file6",679,"");


			
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
			$field[]="text4";
			$tdata[]="'".$data["text4"]."'";
			$field[]="text5";
			$tdata[]="'".$data["text5"]."'";
			$field[]="text6";
			$tdata[]="'".$data["text6"]."'";

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
			else if($_REQUEST["delimage"]==1){
				$field[]="image";
				$tdata[]="''";
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
		else if($_REQUEST["delimage"]==1){
				$field[]="image2";
				$tdata[]="''";
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
			else if($_REQUEST["delimage"]==1){
				$field[]="data_image2";
				$tdata[]="''";
			}
			else if($setdata["detailsimg_defalt"]!=NULL){
				$field[]="data_image2";
				$tdata[]="'".$setdata["detailsimg_defalt"]."'";
			}
			
			
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
	
			if($image_file3["filepath"]!=NULL) {
				$field[]="image3";
				$tdata[]="'".$image_file3["filepath"]."'";
				@chmod($image_file3["filepath"],0777);
				$ftp->MkDir("tmp",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$maxid);
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/",$image_file3["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$image_file3["name"],"b");
			}
			else if($_REQUEST["delimage3"]==1){
				$field[]="image3";
				$tdata[]="''";
			}
			else if($setdata["detailsimg_defalt"]!=NULL){
				$field[]="image3";
				$tdata[]="'".$setdata["detailsimg_defalt"]."'";
			}
		
					$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
	
			if($image_file4["filepath"]!=NULL) {
				$field[]="image4";
				$tdata[]="'".$image_file4["filepath"]."'";
				@chmod($image_file4["filepath"],0777);
				$ftp->MkDir("tmp",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$maxid);
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/",$image_file4["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$image_file4["name"],"b");
			}
			else if($_REQUEST["delimage4"]==1){
				$field[]="image4";
				$tdata[]="''";
			}
			else if($setdata["detailsimg_defalt"]!=NULL){
				$field[]="data_image4";
				$tdata[]="'".$setdata["detailsimg_defalt"]."'";
			}
		
					$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
	
			if($image_file5["filepath"]!=NULL) {
				$field[]="image5";
				$tdata[]="'".$image_file5["filepath"]."'";
				@chmod($image_file5["filepath"],0777);
				$ftp->MkDir("tmp",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$maxid);
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/",$image_file5["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$image_file5["name"],"b");
			}
			else if($_REQUEST["delimage5"]==1){
				$field[]="image5";
				$tdata[]="''";
			}
			else if($setdata["detailsimg_defalt"]!=NULL){
				$field[]="data_image5";
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
				$imagefile=$imgobj->UpImgAndResize("imagefile",679,"");
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
		$image_file2=$imgobj2->UpImgAndResize("image_file2",679,"");
			
		if($data["view_type"]==NULL) {
			$data["view_type"]=0;
		}
		
		$imgobj3=new Upload();
		$imgobj3->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/";
		$imgobj3->rpath="/tmp/".$bname."_data/".$data["blog_id"]."/";
		$image_file3=$imgobj3->UpImgAndResize("imagefile3",679,"");
	

		$imgobj4=new Upload();
		$imgobj4->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/";
		$imgobj4->rpath="/tmp/".$bname."_data/".$data["blog_id"]."/";
		$image_file4=$imgobj4->UpImgAndResize("imagefile4",679,"");

		$imgobj5=new Upload();
		$imgobj5->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/";
		$imgobj5->rpath="/tmp/".$bname."_data/".$data["blog_id"]."/";
		$image_file5=$imgobj5->UpImgAndResize("imagefile5",679,"");

		$imgobj6=new Upload();
		$imgobj6->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/";
		$imgobj6->rpath="/tmp/".$bname."_data/".$data["blog_id"]."/";
		$image_file6=$imgobj6->UpImgAndResize("imagefile6",679,"");




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
		$field[]="text2";
		$tdata[]="'".$data["text2"]."'";
		$field[]="text3";
		$tdata[]="'".$data["text3"]."'";
		$field[]="text4";
		$tdata[]="'".$data["text4"]."'";
		$field[]="text5";
		$tdata[]="'".$data["text5"]."'";
		$field[]="text6";
		$tdata[]="'".$data["text6"]."'";

		
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



		if($image_file3["filepath"]!=NULL) {
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
			$field[]="image3";
			$tdata[]="'".$image_file3["filepath"]."'";
			@chmod($image_file3["filepath"],0777);
			$ftp->MkDir("tmp",$bname."_data");
			$ftp->MkDir("tmp/".$bname."_data",$data["blog_id"]);
			$ftp->UpData("tmp/".$bname."_data/".$data["blog_id"]."/",$image_file3["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$image_file3["name"],"b");
		}
		else if($data["delimage3"]==1){
			if($setdata["detailsimg_defalt"]!=NULL){
				$field[]="image3";
				$tdata[]="'".$setdata["detailsimg_defalt"]."'";
			}
			else {
				$field[]="image3";
				$tdata[]="''";
			}
		}
		else if($data["oldphoto"]!=NULL) {
			
		}
		else if($setdata["detailsimg_defalt"]!=NULL){
			$field[]="image3";
			$tdata[]="'".$setdata["detailsimg_defalt"]."'";
		}


		if($image_file4["filepath"]!=NULL) {
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
			$field[]="image4";
			$tdata[]="'".$image_file4["filepath"]."'";
			@chmod($image_file4["filepath"],0777);
			$ftp->MkDir("tmp",$bname."_data");
			$ftp->MkDir("tmp/".$bname."_data",$data["blog_id"]);
			$ftp->UpData("tmp/".$bname."_data/".$data["blog_id"]."/",$image_file4["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$image_file4["name"],"b");
		}
		else if($data["delimage4"]==1){
			if($setdata["detailsimg_defalt"]!=NULL){
				$field[]="image4";
				$tdata[]="'".$setdata["detailsimg_defalt"]."'";
			}
			else {
				$field[]="image4";
				$tdata[]="''";
			}
		}
		else if($data["oldphoto"]!=NULL) {
			
		}
		else if($setdata["detailsimg_defalt"]!=NULL){
			$field[]="image4";
			$tdata[]="'".$setdata["detailsimg_defalt"]."'";
		}

			if($image_file5["filepath"]!=NULL) {
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
			$field[]="image5";
			$tdata[]="'".$image_file5["filepath"]."'";
			@chmod($image_file5["filepath"],0777);
			$ftp->MkDir("tmp",$bname."_data");
			$ftp->MkDir("tmp/".$bname."_data",$data["blog_id"]);
			$ftp->UpData("tmp/".$bname."_data/".$data["blog_id"]."/",$image_file5["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$image_file5["name"],"b");
		}
		else if($data["delimage5"]==1){
			if($setdata["detailsimg_defalt"]!=NULL){
				$field[]="image5";
				$tdata[]="'".$setdata["detailsimg_defalt"]."'";
			}
			else {
				$field[]="image5";
				$tdata[]="''";
			}
		}
		else if($data["oldphoto"]!=NULL) {
			
		}
		else if($setdata["detailsimg_defalt"]!=NULL){
			$field[]="image5";
			$tdata[]="'".$setdata["detailsimg_defalt"]."'";
		}
	
	
		if($image_file6["filepath"]!=NULL) {
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
			$field[]="image6";
			$tdata[]="'".$image_file6["filepath"]."'";
			@chmod($image_file6["filepath"],0777);
			$ftp->MkDir("tmp",$bname."_data");
			$ftp->MkDir("tmp/".$bname."_data",$data["blog_id"]);
			$ftp->UpData("tmp/".$bname."_data/".$data["blog_id"]."/",$image_file6["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$image_file6["name"],"b");
		}
		else if($data["delimage6"]==1){
			if($setdata["detailsimg_defalt"]!=NULL){
				$field[]="image6";
				$tdata[]="'".$setdata["detailsimg_defalt"]."'";
			}
			else {
				$field[]="image6";
				$tdata[]="''";
			}
		}
		else if($data["oldphoto"]!=NULL) {
			
		}
		else if($setdata["detailsimg_defalt"]!=NULL){
			$field[]="image6";
			$tdata[]="'".$setdata["detailsimg_defalt"]."'";
		}
	
		
		$field[]="text1";
		$tdata[]="'".$data["text1"]."'";
			
		
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

$ad_blog=new My_Blog($dbobj);
$blogsetting=$ad_blog->LoadSetting();
if($_GET["blog_id"]!=NULL) {
	$topicsdata=$dbobj->GetData("select * from blog_data where blog_id= ".$_GET["blog_id"]."");
		$_GET["year"]=$topicsdata["ryear"];
		$_GET["month"]=$topicsdata["rmonth"];
}
else if($_GET["year"]!=NULL&&$_GET["month"]!=NULL){
	$topicsdata=$dbobj->GetData("select * from blog_data where ryear=".$_GET["year"]." and rmonth=".$_GET["month"]." order by rdate desc, blog_id desc");
		$_GET["year"]=$topicsdata["ryear"];
		$_GET["month"]=$topicsdata["rmonth"];
	$_GET["blog_id"]=$topicsdata["blog_id"];
}
else if($_GET["year"]!=NULL){
	$topicsdata=$dbobj->GetData("select * from blog_data where ryear=".$_GET["year"]." order by rdate desc, blog_id desc");
	$_GET["blog_id"]=$topicsdata["blog_id"];
		$_GET["year"]=$topicsdata["ryear"];
		$_GET["month"]=$topicsdata["rmonth"];
}
else if($_GET["month"]!=NULL) {
$_GET["year"]=date("Y");
	$topicsdata=$dbobj->GetData("select * from blog_data where ryear=".$_GET["year"]." and rmonth=".$_GET["month"]." order by rdate desc, blog_id desc");
	$_GET["blog_id"]=$topicsdata["blog_id"];
		$_GET["year"]=$topicsdata["ryear"];
		$_GET["month"]=$topicsdata["rmonth"];
}
else {
	$topicsdata=$dbobj->GetData("select * from blog_data order by rdate desc, blog_id desc");
	$_GET["blog_id"]=$topicsdata["blog_id"];
		$_GET["year"]=$topicsdata["ryear"];
		$_GET["month"]=$topicsdata["rmonth"];
}

$topicsnxdata=$dbobj->GetData("select * from blog_data where blog_id > ".$_GET["blog_id"]."  order by blog_id");
$topicsbfdata=$dbobj->GetData("select * from blog_data where blog_id < ".$_GET["blog_id"]."  order by blog_id desc");

if($_GET["year"]==NULL&&$_GET["month"]==NULL) {
	$newbloglistdata=$dbobj->GetData("select * from blog_data  order by rdate desc, blog_id desc");
	$_GET["year"]=$newbloglistdata["ryear"];
	$_GET["month"]=$newbloglistdata["rmonth"];
}
else if($_GET["year"]==NULL&&$_GET["month"]==NULL) {
	$newbloglistdata=$dbobj->GetData("select * from blog_data  order by rdate desc, blog_id desc");
	$_GET["year"]=$newbloglistdata["ryear"];
	$_GET["month"]=$newbloglistdata["rmonth"];
}
else if($_GET["year"]==NULL) {
	$newbloglistdata=$dbobj->GetData("select * from blog_data where rmonth=".$_GET["month"]."  order by rdate desc, blog_id desc");
	$_GET["year"]=$newbloglistdata["ryear"];
}else if($_GET["year"]==NULL) {
	$newbloglistdata=$dbobj->GetData("select * from blog_data where rmonth=".$_GET["month"]."  order by rdate desc, blog_id desc");
	$_GET["year"]=$newbloglistdata["ryear"];
}
else if($_GET["month"]==NULL) {
	$newbloglistdata=$dbobj->GetData("select * from blog_data where  ryear = ".$_GET["year"]."  order by rdate desc, blog_id desc");
	$_GET["month"]=date("m");
}
else if($_GET["month"]==NULL) {
	$newbloglistdata=$dbobj->GetData("select * from blog_data where  ryear = ".$_GET["year"]."  order by rdate desc, blog_id desc");
	$_GET["month"]=date("m");
}

$newblogsql="select * from blog_data where rmonth=".$_GET["month"]." and ryear = ".$_GET["year"]."  order by rdate desc, blog_id desc";
$newblogdata=$dbobj->GetList($newblogsql);
$yearlist=$dbobj->GetList("select distinct ryear from blog_data  order by ryear desc");
$monthlist=$dbobj->GetList("select distinct rmonth from blog_data where  ryear = ".$_GET["year"]." order by rmonth desc");
$catelist=$dbobj->GetList("select * from blog_cate  order by turn");

if($blogdata["rdate"]!=NULL) {
	$exday=explode("-",$blogdata["rdate"]);
}
else {
	$exday=explode("-",date("Y-m-d"));
}

$RDATE=date("Ymd",mktime(0,0,0,$exday[1],$exday[2],$exday[0])); 
$year=$exday[0];
$month=$exday[1];
$day=$exday[2];

?>
<script type="text/javascript" src="/fckeditor/fckeditor.js"></script>
<script language="javascript">
function datachk() {
	res=confirm("この内容で更新してもよろしいですか?");
	if(res) {
		document.update_form.submit();
	}
}

function view_change(num) {
	switch(num) {	
		case 0:
			document.all.type_link.style.display="none";
			document.all.type_text.style.display="block";
			break;
		case 1:
			document.all.type_link.style.display="block";
			document.all.type_text.style.display="none";
			break;
	}		
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<style type="text/css">
<!--
.text {
	font-family: "ＭＳ Ｐゴシック", Osaka, "ヒラギノ角ゴ Pro W3";
	font-size: 12px;
	line-height: 18px;
	color: #333333;
}
-->
</style>
<form action="" method="post" enctype="multipart/form-data" name="update_form" id="update_form">
		<table border="0" align="left" cellpadding="0" cellspacing="0">
				<tr>
						<td width="200" valign="top">&nbsp;</td>
						<td valign="top">&nbsp;</td>
				</tr>
				<tr>
						<td colspan="2" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
												<td width="2%"><img src="img/topics_icon.jpg" width="37" height="37"></td>
												<td width="98%" class="title"><p><strong>トピックの</strong><strong>編集</strong></p></td>
										</tr>
								</table></td>
				</tr>
				<tr>
						<td valign="top">&nbsp;</td>
						<td valign="top">&nbsp;</td>
				</tr>
				<tr>
						<td colspan="2" valign="top"><table border="0" cellspacing="0" cellpadding="0">
										<tr>
												<td valign="top"><table width="700" border="0" cellpadding="0" cellspacing="0">
																<tr>
																		<td width="10" background="img/topics/TopicsLeft.jpg">&nbsp;</td>
																		<td width="679" valign="top"><?php 
if($_REQUEST["pmode"]=="update") {
	$ad_blog->UpdateOneData($_POST);
	$blogdata=$ad_blog->GetDetailsData($_POST["blog_id"]);
	
	//print_r($_POST);
?>
																				<script language="javascript">
location.replace('?PID=topics_list&year=<?php echo $_REQUEST["ryear"];?>&month=<?php echo $_REQUEST["rmonth"];?>');
                            </script>
																				<?php

		}
		else {
		
			$blogdata=$ad_blog->GetDetailsData($_GET["blog_id"]);
			$blogcdata=$ad_blog->GetDetailsCate($blogdata["cate_id"]);
		?>
																				<script type="text/javascript"><!--
function on_load() {
    //==================================================================
    // FCK Editor    
    var oFCKeditor = new FCKeditor( 'comm' );  
    oFCKeditor.BasePath = '/fckeditor/';
    oFCKeditor.Width = '690';
    oFCKeditor.Height = '400';
    oFCKeditor.ToolbarSet = 'Mymenu4';
    oFCKeditor.ReplaceTextarea();
}

// -->
<!--
//****月によって、日付のselect.optionを変更****
function check3(){
	year=document.update_form.ryear.value;
	month=document.update_form.rmonth.value;
	day=document.update_form.rday.value;
	day_cnt=31;
	if(month=="02"){
		if((year % 4 )!=0){day_cnt=28}	else{day_cnt=29}}
	if((month=="04")|(month=="06")|(month=="09")|(month=="11")){day_cnt=30}

//		前のSELECTをクリアー
			obj=eval("document.update_form.rday") 
			del_cnt=document.update_form.rday.length;
		for(i=0;i<del_cnt;i++){
			obj.options.remove(0);
		}
//		新しいSELECTを組立
		for(i=1;i<=day_cnt;i++){
			new_option=document.createElement("option");
				if(i<10){date="0" +i;} else {date=""+i;}
			new_option.value=date
			new_option.text=date
			obj=eval("document.update_form.rday") 
			obj.options.add(new_option,eval(obj.length));
		}
}
//****月によって、日付のselect.optionを変更****
function set_date_dft(){
		dft_date=document.all.dft_dat.value;
		document.update_form.ryear.value=dft_date.substr(0,4);
		document.update_form.rmonth.value=dft_date.substr(4,2);
		document.update_form.rday.value=dft_date.substr(6,2);
}
function day_chk() {
		set_date_dft();
}
//-->
</script>
																				<table width="100%" border="0" cellpadding="0" cellspacing="0">
																						<tr>
																								<td width="100%"><table width="511" border="0" cellspacing="0" cellpadding="0">
																												<tr>
																														<td><strong><span class="yearmonth"><?php echo $topicsdata["ryear"];?>年<?php echo $topicsdata["rmonth"];?>月 </span></strong></td>
																												</tr>
																										</table></td>
																						</tr>
																						<tr>
																								<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
																												<tr>
																														<td><strong>
																																<input name="cate_id" type="hidden" id="cate_id" value="1">
																																</strong></td>
																												</tr>
																												<tr>
																														<td>&nbsp;</td>
																												</tr>
																												<tr>
																														<td><strong>記入日</strong></td>
																												</tr>
																												<tr>
																														<td><span class="date">
																																<select name="ryear" id="ryear" onChange="check3()">
																																		<option value="">--</option>
																																		<?php
			for($yi=-1;$yi<2;$yi++) {
				?>
																																		<option value="<?php echo $year+$yi;?>" <?php if($yi==0) {echo " selected";}?>><?php echo $year+$yi;?></option>
																																		<?php
			}
			?>
																																</select>
																																年
																																<select name="rmonth" id="rmonth" onChange="check3()">
																																		<option value="">--</option>
																																		<?php
			for($mi=1;$mi<13;$mi++) {
				?>
																																		<option value="<?php if($mi<10) {echo "0";}echo $mi;?>"<?php if($mi==$month){echo " selected";}?>>
																																		<?php if($mi<10) {echo "0";}echo $mi;?>
																																		</option>
																																		<?php
			}

			?>
																																</select>
																																月
																																<select name="rday" id="rday">
																																		<option value="">--</option>
																																		<?php
			$mday=date("t",mktime(0,0,0,$month,$day,$year));
			for($di=1;$di<=$mday;$di++) {
				?>
																																		<option value="<?php if($di<10) {echo "0";}echo $di;?>"<?php if($di==$day){echo " selected";}?>>
																																		<?php if($di<10) {echo "0";}echo $di;?>
																																		</option>
																																		<?php
			}

			?>
																																</select>
																																日 </span></td>
																												</tr>
																										</table></td>
																						</tr>
																						<tr>
																								<td height="14">&nbsp;</td>
																						</tr>
																						<tr>
																								<td height="14"><strong>タイトル</strong></td>
																						</tr>
																						<tr>
																								<td class="title"><table width="100%" border="0" cellspacing="0" cellpadding="0">
																												<tr>
																														<td width="3%">■</td>
																														<td width="97%"><input name="title" type="text" id="title" value="<?php echo $blogdata["title"];?>" size="50" style="width:98%;"></td>
																												</tr>
																										</table></td>
																						</tr>
																						<tr>
																								<td valign="top" class="text">&nbsp;</td>
																						</tr>
																						<tr>
																								<td valign="top" class="text"><strong>本文1</strong></td>
																						</tr>
																						<tr>
																								<td valign="top" class="text"><span>
																										<textarea name="comm" cols="50" rows="10" id="comm" style="width:98%;"><?php echo $blogdata["comm"];?></textarea>
																										</span></td>
																						</tr>
																						<tr>
																								<td valign="top" class="text"><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
																												<?php
		?>
																												<!--<tr>
            <td align="left"><input name="day_txt" type="text" id="day_txt" size="40" value="<?php echo $blogdata["day_txt"];?>"></td>
          </tr>-->
																												<?php if($blogsetting["image_chk"]==1) {?>
																												<tr>
																														<td align="left" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
																												</tr>
																												<tr>
																														<td align="left" valign="top" bgcolor="#FFFFFF" class="text"><strong>画像登録1</strong></td>
																												</tr>
																												<tr>
																														<td align="left" valign="top" bgcolor="#FFFFFF"><?php if($blogdata["image"]!=NULL){
								$pdata=(@getimagesize($_SERVER['DOCUMENT_ROOT']."/".$blogdata["image"]));
							if($pdata[0]>400) {
								 $pdata[0]=400;
							}
					 
						 ?>
																																<img src="<?php echo $blogdata["image"];?>?<?php echo time();?>" alt="image" width="<?php echo $pdata[0];?>px"/><br />
																																<label>
																																		<input name="delimage" type="checkbox" id="delimage" value="1" />
																																		<span class="text">画像削除</span></label>
																																<?php }?></td>
																												</tr>
																												<tr>
																														<td align="left" valign="top" bgcolor="#FFFFFF"><input name="imagefile" type="file" id="imagefile"></td>
																												</tr>
																												<?php
					}
				 ?>
																										</table>
																										<br /></td>
																						</tr>
																						<tr>
																								<td>&nbsp;</td>
																						</tr>
																						<tr>
																								<td valign="top" class="text"><strong>本文2</strong></td>
																						</tr>
																						<tr>
																								<td valign="top" class="text"><span>
																										<textarea name="text3" cols="50" rows="10" id="text3" style="width:98%;"><?php echo $blogdata["text3"];?></textarea>
																								</span></td>
																						</tr>
																						<tr>
																								<td valign="top" class="text"><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
																										<?php
		?>
																										<!--<tr>
            <td align="left"><input name="day_txt" type="text" id="day_txt" size="40" value="<?php echo $blogdata["day_txt"];?>"></td>
          </tr>-->
																										<?php if($blogsetting["image_chk"]==1) {?>
																										<tr>
																												<td align="left" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
																										</tr>
																										<tr>
																												<td align="left" valign="top" bgcolor="#FFFFFF" class="text"><strong>画像登録2</strong></td>
																										</tr>
																										<tr>
																												<td align="left" valign="top" bgcolor="#FFFFFF"><?php if($blogdata["image3"]!=NULL){
								$pdata=(@getimagesize($_SERVER['DOCUMENT_ROOT']."/".$blogdata["image3"]));
							if($pdata[0]>400) {
								 $pdata[0]=400;
							}
					 
						 ?>
																														<img src="<?php echo $blogdata["image3"];?>?<?php echo time();?>" alt="image" width="<?php echo $pdata[0];?>px"/><br />
																														<label>
																																<input name="delimage3" type="checkbox" id="delimage3" value="1" />
																																<span class="text">画像削除</span></label>
																														<?php }?></td>
																										</tr>
																										<tr>
																												<td align="left" valign="top" bgcolor="#FFFFFF"><input name="imagefile3" type="file" id="imagefile3" /></td>
																										</tr>
																										<?php
					}
				 ?>
																								</table>
																										<br /></td>
																						</tr>
																						<tr>
																								<td>&nbsp;</td>
																						</tr>
																						<tr>
																								<td valign="top" class="text"><strong>本文3</strong></td>
																						</tr>
																						<tr>
																								<td valign="top" class="text"><span>
																										<textarea name="text4" cols="50" rows="10" id="comm" style="width:98%;"><?php echo $blogdata["text4"];?></textarea>
																								</span></td>
																						</tr>
																						<tr>
																								<td valign="top" class="text"><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
																										<?php
		?>
																										<!--<tr>
            <td align="left"><input name="day_txt" type="text" id="day_txt" size="40" value="<?php echo $blogdata["day_txt"];?>"></td>
          </tr>-->
																										<?php if($blogsetting["image_chk"]==1) {?>
																										<tr>
																												<td align="left" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
																										</tr>
																										<tr>
																												<td align="left" valign="top" bgcolor="#FFFFFF" class="text"><strong>画像登録3</strong></td>
																										</tr>
																										<tr>
																												<td align="left" valign="top" bgcolor="#FFFFFF"><?php if($blogdata["image4"]!=NULL){
								$pdata=(@getimagesize($_SERVER['DOCUMENT_ROOT']."/".$blogdata["image4"]));
							if($pdata[0]>400) {
								 $pdata[0]=400;
							}
					 
						 ?>
																														<img src="<?php echo $blogdata["image4"];?>?<?php echo time();?>" alt="image" width="<?php echo $pdata[0];?>px"/><br />
																														<label>
																																<input name="delimage4" type="checkbox" id="delimage4" value="1" />
																																<span class="text">画像削除</span></label>
																														<?php }?></td>
																										</tr>
																										<tr>
																												<td align="left" valign="top" bgcolor="#FFFFFF"><input name="imagefile4" type="file" id="imagefile4" /></td>
																										</tr>
																										<?php
					}
				 ?>
																								</table>
																										<br /></td>
																						</tr>
																						<tr>
																								<td>&nbsp;</td>
																						</tr>
																						<tr>
																								<td valign="top" class="text"><strong>本文4</strong></td>
																						</tr>
																						<tr>
																								<td valign="top" class="text"><span>
																										<textarea name="text5" cols="50" rows="10" id="comm" style="width:98%;"><?php echo $blogdata["text5"];?></textarea>
																								</span></td>
																						</tr>
																						<tr>
																								<td valign="top" class="text"><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
																										<?php
		?>
																										<!--<tr>
            <td align="left"><input name="day_txt" type="text" id="day_txt" size="40" value="<?php echo $blogdata["day_txt"];?>"></td>
          </tr>-->
																										<?php if($blogsetting["image_chk"]==1) {?>
																										<tr>
																												<td align="left" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
																										</tr>
																										<tr>
																												<td align="left" valign="top" bgcolor="#FFFFFF" class="text"><strong>画像登録4</strong></td>
																										</tr>
																										<tr>
																												<td align="left" valign="top" bgcolor="#FFFFFF"><?php if($blogdata["image5"]!=NULL){
								$pdata=(@getimagesize($_SERVER['DOCUMENT_ROOT']."/".$blogdata["image5"]));
							if($pdata[0]>400) {
								 $pdata[0]=400;
							}
					 
						 ?>
																														<img src="<?php echo $blogdata["image5"];?>?<?php echo time();?>" alt="image" width="<?php echo $pdata[0];?>px"/><br />
																														<label>
																																<input name="delimage5" type="checkbox" id="delimage5" value="1" />
																																<span class="text">画像削除</span></label>
																														<?php }?></td>
																										</tr>
																										<tr>
																												<td align="left" valign="top" bgcolor="#FFFFFF"><input name="imagefile5" type="file" id="imagefile5" /></td>
																										</tr>
																										<?php
					}
				 ?>
																								</table>
																										<br /></td>
																						</tr>
																						<tr>
																								<td>&nbsp;</td>
																						</tr>
																						<tr>
																								<td valign="top" class="text"><strong>本文5</strong></td>
																						</tr>
																						<tr>
																								<td valign="top" class="text"><span>
																										<textarea name="text6" cols="50" rows="10" id="comm" style="width:98%;"><?php echo $blogdata["text6"];?></textarea>
																								</span></td>
																						</tr>
																						<tr>
																								<td valign="top" class="text"><table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
																										<?php
		?>
																										<!--<tr>
            <td align="left"><input name="day_txt" type="text" id="day_txt" size="40" value="<?php echo $blogdata["day_txt"];?>"></td>
          </tr>-->
																										<?php if($blogsetting["image_chk"]==1) {?>
																										<tr>
																												<td align="left" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
																										</tr>
																										<tr>
																												<td align="left" valign="top" bgcolor="#FFFFFF" class="text"><strong>画像登録5</strong></td>
																										</tr>
																										<tr>
																												<td align="left" valign="top" bgcolor="#FFFFFF"><?php if($blogdata["image6"]!=NULL){
								$pdata=(@getimagesize($_SERVER['DOCUMENT_ROOT']."/".$blogdata["image6"]));
							if($pdata[0]>400) {
								 $pdata[0]=400;
							}
					 
						 ?>
																														<img src="<?php echo $blogdata["image6"];?>?<?php echo time();?>" alt="image" width="<?php echo $pdata[0];?>px"/><br />
																														<label>
																																<input name="delimage6" type="checkbox" id="delimage6" value="1" />
																																<span class="text">画像削除</span></label>
																														<?php }?></td>
																										</tr>
																										<tr>
																												<td align="left" valign="top" bgcolor="#FFFFFF"><input name="imagefile6" type="file" id="imagefile6" /></td>
																										</tr>
																										<?php
					}
				 ?>
																								</table>
																										<br /></td>
																						</tr>
																						<tr>
																								<td><div align="center">
																												<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1">
																														<?php
		if($blogdata["rdate"]!=NULL) {
			$exday=explode("-",$blogdata["rdate"]);
		}
		else {
			$exday=explode("-",date("Y-m-d"));
		}
		
		$RDATE=date("Ymd",mktime(0,0,0,$exday[1],$exday[2],$exday[0])); 
		$year=$exday[0];
		$month=$exday[1];
		$day=$exday[2];
		?>
																														<!--<tr>
            <td align="left"><input name="day_txt" type="text" id="day_txt" size="40" value="<?php echo $blogdata["day_txt"];?>"></td>
          </tr>-->
																														<?php if($blogsetting["image_chk"]==1) {?>
																														<tr>
																																<td align="left" valign="top" bgcolor="#FFFFFF"><select name="view_chk" id="view_chk">
																																				<option value="1"<?php if($blogdata["view_chk"]==1){echo " selected";}?>>公開する</option>
																																				<option value="0"<?php if($blogdata["view_chk"]==0){echo " selected";}?> >公開しない</option>
																																		</select></td>
																														</tr>
																														<tr>
																																<td align="left" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
																														</tr>
																														<tr>
																																<td align="left" valign="top" bgcolor="#FFFFFF"><table width="173" border="0" cellpadding="0" cellspacing="0">
																																				<tr>
																																						<td width="76"><a href="#" onClick="datachk()"><img src="img/topics/reg.gif" width="76" height="23" border="0"></a></td>
																																						<td width="21"><input name="pmode" type="hidden" id="pmode" value="update" />
																																								<input name="blog_id" type="hidden" id="blog_id" value="<?php echo $_REQUEST["blog_id"];?>" />
																																								<input name="dft_dat" type="hidden" id="dft_dat" value="<?php echo $RDATE;?>"></td>
																																						<td width="76"><a href="#"onclick="location.replace('?PID=topics_list&cate_id=<?php echo $_GET["cate_id"];?>')"><img src="img/topics/list.gif" width="76" height="23" border="0"></a></td>
																																				</tr>
																																		</table></td>
																														</tr>
																														<?php
					}
				 ?>
																												</table>
																										</div></td>
																						</tr>
																				</table>
																				<script>
day_chk();
</script>
																				<?php 
		}
		?></td>
																		<td width="11" background="img/topics/TopicsRight.jpg">&nbsp;</td>
																</tr>
																<tr>
																		<td colspan="3">&nbsp;</td>
																</tr>
														</table></td>
												<td valign="top"><table width="200" border="0" cellpadding="0" cellspacing="0">
																<tr>
																		<td colspan="3"><img src="img/topics/TopicsList.jpg" width="210" height="41" /></td>
																</tr>
																<tr>
																		<td width="19" background="img/topics/TopicsMenuLeft.jpg"><img src="img/topics/TopicsMenuLeft.jpg" width="19" height="20" /></td>
																		<td width="163" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
																						<?php
												for($mi=0;$newblogdata[$mi]["blog_id"]!=NULL;$mi++) {
												?>
																						<tr>
																								<td width="14" height="20" valign="top"><img src="img/topics/icon1.jpg" width="14" height="20" /></td>
																								<td width="95%" height="20" align="left" valign="middle" class="cate"><a href="?PID=topics_dup&blog_id=<?php echo $newblogdata[$mi]["blog_id"];?>"><?php echo $newblogdata[$mi]["title"];?></a></td>
																						</tr>
																						<tr>
																								<td height="5" colspan="2" valign="top"></td>
																						</tr>
																						<?php
														}
														?>
																				</table></td>
																		<td width="28" align="right" background="img/topics/TopicsMenuRight.jpg"><img src="img/topics/TopicsMenuRight.jpg" width="28" height="20" /></td>
																</tr>
																<tr>
																		<td colspan="3"><img src="img/topics/TopicsMenuFoot.jpg" width="210" height="21" /></td>
																</tr>
														</table>
														<table width="200" border="0" cellpadding="0" cellspacing="0">
																<tr>
																		<td colspan="3"><img src="img/topics/TopicsMonthlyHeader.jpg" width="210" height="43" /></td>
																</tr>
																<tr>
																		<td width="16" background="img/topics/TopicsMenuLeft.jpg"><img src="img/topics/TopicsMenuLeft.jpg" width="19" height="20" /></td>
																		<td width="163" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
																						<?php
												for($mi=0;$monthlist[$mi]["rmonth"]!=NULL;$mi++) {
												?>
																						<tr>
																								<td width="14" height="20" valign="top"><img src="img/topics/icon2.jpg" width="14" height="20" /></td>
																								<td width="95%" height="20" align="left" valign="middle" class="cate"><a href="?PID=topics_list&year=<?php echo $_GET["year"];?>&amp;month=<?php echo $monthlist[$mi]["rmonth"];?>"><?php echo $_GET["year"] ?>年<?php echo $monthlist[$mi]["rmonth"] ?>月 (
																										<?php
																$numdata=$dbobj->GetData("select count(rmonth) as monthnum from blog_data where ryear = ".$_GET["year"]." and rmonth=".$monthlist[$mi]["rmonth"]."");
																echo $numdata["monthnum"];
																?>
																										)</a></td>
																						</tr>
																						<?php
														}
														?>
																				</table></td>
																		<td width="8" background="img/topics/TopicsMenuRight.jpg"><img src="img/topics/TopicsMenuRight.jpg" width="28" height="20" /></td>
																</tr>
																<tr>
																		<td colspan="3"><img src="img/topics/TopicsMenuFoot.jpg" width="210" height="21" /></td>
																</tr>
														</table>
														<table width="200" border="0" cellpadding="0" cellspacing="0">
																<tr>
																		<td colspan="3"><img src="img/topics/TopicsYearHeader.jpg" width="210" height="46" /></td>
																</tr>
																<tr>
																		<td width="19" background="img/topics/TopicsMenuLeft.jpg"><img src="img/topics/TopicsMenuLeft.jpg" width="19" height="20" /></td>
																		<td width="163" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
																						<?php
												for($yi=0;$yearlist[$yi]["ryear"]!=NULL;$yi++) {
												?>
																						<tr>
																								<td width="14" height="20" valign="top"><img src="img/topics/icon3.jpg" width="14" height="20" /></td>
																								<td width="163" height="20" align="left" valign="middle" class="cate"><a href="?PID=topics_list&year=<?php echo $yearlist[$yi]["ryear"]; ?>"><?php echo $yearlist[$yi]["ryear"]; ?>年</a></td>
																						</tr>
																						<?php
														}
														?>
																				</table></td>
																		<td width="28" background="img/topics/TopicsMenuRight.jpg"><img src="img/topics/TopicsMenuRight.jpg" width="28" height="20" /></td>
																</tr>
																<tr>
																		<td colspan="3"><img src="img/topics/TopicsMenuFoot.jpg" width="210" height="21" /></td>
																</tr>
														</table></td>
										</tr>
								</table></td>
				</tr>
		</table>
		<script type="text/javascript"><!--

function on_load() {
    //==================================================================
    // FCK Editor
    
    var oFCKeditor = new FCKeditor( 'comm' );
    
    oFCKeditor.BasePath = '/fckeditor/';
    oFCKeditor.Width = '690';
    oFCKeditor.Height = '400';
    oFCKeditor.ToolbarSet = 'Mymenu4';
    
    oFCKeditor.ReplaceTextarea();
		
		var oFCKeditor3 = new FCKeditor( 'text3' );
    
    oFCKeditor3.BasePath = '/fckeditor/';
    oFCKeditor3.Width = '690';
    oFCKeditor3.Height = '400';
    oFCKeditor3.ToolbarSet = 'Mymenu4';
    
    oFCKeditor3.ReplaceTextarea();

		var oFCKeditor4 = new FCKeditor( 'text4' );
    
    oFCKeditor4.BasePath = '/fckeditor/';
    oFCKeditor4.Width = '690';
    oFCKeditor4.Height = '400';
    oFCKeditor4.ToolbarSet = 'Mymenu4';
    
    oFCKeditor4.ReplaceTextarea();
		
		var oFCKeditor5 = new FCKeditor( 'text5' );
    
    oFCKeditor5.BasePath = '/fckeditor/';
    oFCKeditor5.Width = '690';
    oFCKeditor5.Height = '400';
    oFCKeditor5.ToolbarSet = 'Mymenu4';
    
    oFCKeditor5.ReplaceTextarea();

		var oFCKeditor6 = new FCKeditor( 'text6' );
    
    oFCKeditor6.BasePath = '/fckeditor/';
    oFCKeditor6.Width = '690';
    oFCKeditor6.Height = '400';
    oFCKeditor6.ToolbarSet = 'Mymenu4';
    
    oFCKeditor6.ReplaceTextarea();

}
// -->
on_load();
    </script>
</form>
