<?php

class Site_Contents extends Ab_NormalPageType{
	function Site_Contents($dbobj) {
		$this->dbobj=$dbobj;
		$this->bname="contents";
	}
	
	function GetSelCateList($cate_id,$sort) {
	if($cate_id!=NULL){
	if($sort==NULL){
	$sort="turn";
	}
		$list=$this->dbobj->GetList("select * from contents_cate where parents_id = ".$cate_id." order by ".$sort);
		
		}
		return $list;
	}
}

class Admin_Contents extends Ab_AdminBasicType{
	function Admin_Contents($dbobj) {
		$this->dbobj=$dbobj;
		$this->bname="contents";
	}
	function GetSelCateList($cate_id) {
		$list=$this->dbobj->GetList("select * from contents_cate where parents_id = ".$cate_id);
		return $list;
	}
	
	function AdditionData($data) {
		$db=$this->dbobj;
		$bname=$this->bname;
		if($data["new_data_name"]!=NULL||$data["new_data_comm"]!=NULL) {
			$db=$this->dbobj;
			$bname=$this->bname;
			$maxid=$db->GetMaxId($bname."_data","data_id");
			unset($field,$tdata);
			
			if($data["new_view_chk"]!=NULL){
				$data["view_chk"]="";
				$data["view_chk"]=$data["new_view_chk"];
			
			}
			else if($data["view_chk"]==NULL){
				
				$data["view_chk"]=1;
				
			}
			
			if($data["maker_price"]==NULL){
				$data["maker_price"]=0;
			}
			
			if($data["price"]==NULL){
				$data["price"]=0;
			}
			
			//echo $data["new_view_chk"];
			$setdata=$this->LoadSet();
			$imgobj=new Upload();
			@mkdir("../tmp/".$_SESSION["DomainData"]["dbname"]);
			@mkdir("../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data");
			@mkdir("../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$maxid);
			
			$imgobj->path="../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/";
			$imgobj->rpath="/tmp/".$bname."_data/".$maxid."/";
			$imagefile=$imgobj->UpImgAndResize("imagefile",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);
			
			$imgobj2=new Upload();
			$imgobj2->path="../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/";
			$imgobj2->rpath="/tmp/".$bname."_data/".$maxid."/";
			$imagefile2=$imgobj2->UpImgAndResize("imagefile2",$setdata["detailsimg2_w"],$setdata["detailsimg2_h"]);

			$imgobj3=new Upload();
			$imgobj3->path="../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/";
			$imgobj3->rpath="/tmp/".$bname."_data/".$maxid."/";
			$imagefile3=$imgobj3->UpImgAndResize("imagefile3",$setdata["detailsimg3_w"],$setdata["detailsimg3_h"]);	

			$imgobj0=new Upload();
			$imgobj0->path="../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/";
			$imgobj0->rpath="/tmp/".$bname."_data/".$maxid."/";
			$imagefile0=$imgobj0->UpImgAndResize("maker_logo",$setdata["makerlogo_w"],$setdata["makerlogo_h"]);	

		
			$field[]="data_id";
			$field[]="data_name";
			$field[]="data_comm";
			$field[]="cate_id";
			$field[]=" view_chk ";
			$tdata[]=$maxid;
			$tdata[]="'".$data["new_data_name"]."'";
			$tdata[]="'".$data["new_data_comm"]."'";
			$tdata[]=$data["cate_id"];
			$tdata[]=$data["view_chk"];
			$field[]="turn";
			$tdata[]=$maxid;
			$field[]="maker";
			$tdata[]="'".$data["maker"]."'";
			$field[]="item_name";
			$tdata[]="'".$data["item_name"]."'";
			$field[]="item_code";
			$tdata[]="'".$data["item_code"]."'";
			$field[]="maker_price";
			$field[]="maker_price_sub";
		if(is_numeric($data["maker_price"])) {
			$tdata[]="".$data["maker_price"]."";
			$tdata[]="''";
			
		}
		else {
			$tdata[]=0;
			$tdata[]="'".$data["maker_price"]."'";
		}
			
			$field[]="price";	
			$field[]="price_sub";	
		if(is_numeric($data["price"])) {
			$tdata[]="".$data["price"]."";
			$tdata[]="''";
			
		}
		else {
			$tdata[]=0;
			$tdata[]="'".$data["price"]."'";
		}
		
			$field[]="option";	
			$tdata[]="'".$data["option"]."'";
			
			if($data["url"]!=NULL&&$data["url"]!="") {
				$field[]="url";
				$tdata[]="'".$data["url"]."'";
			}
			
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
			
			if($imagefile["filepath"]!=NULL) {
				$field[]="data_image";
				$tdata[]="'".$imagefile["filepath"]."'";
				@chmod($imagefile1["filepath"],0777);
				$ftp->MkDir("tmp",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$maxid);
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/",$imagefile["name"],"../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$imagefile["name"],"b");
			}
			else if($setdata["detailsimg_defalt"]!=NULL){
				$field[]="data_image";
				$tdata[]="'".$setdata["detailsimg_defalt"]."'";
			}
			
			if($imagefile2["filepath"]!=NULL) {
				$field[]="data_image2";
				$tdata[]="'".$imagefile2["filepath"]."'";
				@chmod($imagefile2["filepath"],0777);
				$ftp->MkDir("tmp",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$maxid);
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/",$imagefile2["name"],"../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$imagefile2["name"],"b");
			}
			else if($setdata["detailsimg2_defalt"]!=NULL){
				$field[]="data_image2";
				$tdata[]="'".$setdata["detailsimg2_defalt"]."'";
			}
			
			if($imagefile3["filepath"]!=NULL) {
				$field[]="data_image3";
				$tdata[]="'".$imagefile3["filepath"]."'";
				@chmod($imagefile3["filepath"],0777);
				$ftp->MkDir("tmp",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$maxid);
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/",$imagefile3["name"],"../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$imagefile3["name"],"b");
			}
			else if($setdata["detailsimg3_default"]!=NULL){
				$field[]="data_image3";
				$tdata[]="'".$setdata["detailsimg3_default"]."'";
			}			

			if($imagefile0["filepath"]!=NULL) {
				$field[]="maker_logo";
				$tdata[]="'".$imagefile0["filepath"]."'";
				@chmod($imagefile3["filepath"],0777);
				$ftp->MkDir("tmp",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$maxid);
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/",$imagefile0["name"],"../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$imagefile0["name"],"b");
			}

			if($data["osusume_chk"]==1){
				$field[]="osusume_chk";
				$tdata[]="1";
			}
		
			$db->Insert($bname."_data",$field,$tdata);
			$data["data_id"]=$maxid;
			$this->AdditionSubData($data);

		}
		return $maxid;
	}
	
	function UpdateOneData($data) {
		$db=$this->dbobj;
		$bname=$this->bname;
			
			if($data["maker_price"]==NULL){
				$data["maker_price"]=0;
			}
			
			if($data["price"]==NULL){
				$data["price"]=0;
			}
		@mkdir("../tmp/".$_SESSION["DomainData"]["dbname"]);
		@mkdir("../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data");
		@mkdir("../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$data["data_id"]);
		
		$setdata=$this->LoadSet();
		$imgobj=new Upload();
		$imgobj->path="../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/";
		$imgobj->rpath="/tmp/".$bname."_data/".$data["data_id"]."/";
		$imagefile=$imgobj->UpImgAndResize("imagefile",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);	
		
		$imgobj2=new Upload();
		$imgobj2->path="../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/";
		$imgobj2->rpath="/tmp/".$bname."_data/".$data["data_id"]."/";
		$imagefile2=$imgobj2->UpImgAndResize("imagefile2",$setdata["detailsimg2_w"],$setdata["detailsimg2_h"]);	

		$imgobj3=new Upload();
		$imgobj3->path="../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/";
		$imgobj3->rpath="/tmp/".$bname."_data/".$data["data_id"]."/";
		$imagefile3=$imgobj3->UpImgAndResize("imagefile3",$setdata["detailsimg3_w"],$setdata["detailsimg3_h"]);	

		$imgobj0=new Upload();
		$imgobj0->path="../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/";
		$imgobj0->rpath="/tmp/".$bname."_data/".$data["data_id"]."/";
		$imagefile0=$imgobj0->UpImgAndResize("maker_logo",$setdata["makerlogo_w"],$setdata["makerlogo_h"]);	


		$field[]="data_name";
		$field[]="data_comm";
		$field[]="view_chk";
		$field[]="maker";
		$field[]="item_name";
		$field[]="item_code";
		$field[]="maker_price";
		$field[]="maker_price_sub";
		$field[]="price";
		$field[]="price_sub";
		$field[]="option";
			
		$tdata[]="'".$data["data_name"]."'";
		$tdata[]="'".$data["data_comm"]."'";
		$tdata[]="'".$data["view_chk"]."'";
		$tdata[]="'".$data["maker"]."'";
		$tdata[]="'".$data["item_name"]."'";
		$tdata[]="'".$data["item_code"]."'";
		
		if(is_numeric($data["maker_price"])) {
			$tdata[]="".$data["maker_price"]."";
			$tdata[]="''";
			
		}
		else {
			$tdata[]=0;
			$tdata[]="'".$data["maker_price"]."'";
		}
		
		if(is_numeric($data["price"])) {
			$tdata[]="".$data["price"]."";
			$tdata[]="''";
			
		}
		else {
			$tdata[]=0;
			$tdata[]="'".$data["price"]."'";
		}
		
		$tdata[]="'".$data["option"]."'";
		
		if($data["url"]!=NULL&&$data["url"]!="") {
			$field[]="url";
			$tdata[]="'".$data["url"]."'";
		}
		
		if($imagefile["filepath"]!=NULL) {
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
			$field[]="data_image";
			$tdata[]="'".$imagefile["filepath"]."'";
			@chmod($imagefile1["filepath"],0777);
			$ftp->MkDir("tmp",$bname."_data");
			$ftp->MkDir("tmp/".$bname."_data",$data["data_id"]);
			$ftp->UpData("tmp/".$bname."_data/".$data["data_id"]."/",$imagefile["name"],"../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$imagefile["name"],"b");
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

		if($imagefile2["filepath"]!=NULL) {
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
			$field[]="data_image2";
			$tdata[]="'".$imagefile2["filepath"]."'";
			@chmod($imagefile2["filepath"],0777);
			$ftp->MkDir("tmp",$bname."_data");
			$ftp->MkDir("tmp/".$bname."_data",$data["data_id"]);
			$ftp->UpData("tmp/".$bname."_data/".$data["data_id"]."/",$imagefile2["name"],"../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$imagefile2["name"],"b");
		}
		else if($data["delimage2"]==1){
			if($setdata["detailsimg2_defalt"]!=NULL){
				$field[]="data_image2";
				$tdata[]="'".$setdata["detailsimg2_defalt"]."'";
			}
			else {
				$field[]="data_image2";
				$tdata[]="''";
			}
		}
		else if($data["oldphoto2"]!=NULL) {
			
		}
		else if($setdata["detailsimg2_defalt"]!=NULL){
			$field[]="data_image2";
			$tdata[]="'".$setdata["detailsimg2_defalt"]."'";
		}
		
		if($imagefile3["filepath"]!=NULL) {
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
			$field[]="data_image3";
			$tdata[]="'".$imagefile3["filepath"]."'";
			@chmod($imagefile3["filepath"],0777);
			$ftp->MkDir("tmp",$bname."_data");
			$ftp->MkDir("tmp/".$bname."_data",$data["data_id"]);
			$ftp->UpData("tmp/".$bname."_data/".$data["data_id"]."/",$imagefile3["name"],"../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$imagefile3["name"],"b");
		}
		else if($data["delimage3"]==1){
			if($setdata["detailsimg3_defalt"]!=NULL){
				$field[]="data_image3";
				$tdata[]="'".$setdata["detailsimg3_defalt"]."'";
			}
			else {
				$field[]="data_image3";
				$tdata[]="''";
			}
		}
		else if($data["oldphoto3"]!=NULL) {
			
		}
		else if($setdata["detailsimg3_defalt"]!=NULL){
			$field[]="data_image3";
			$tdata[]="'".$setdata["detailsimg3_defalt"]."'";
		}
			
		if($imagefile0["filepath"]!=NULL) {
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
			$field[]="maker_logo";
			$tdata[]="'".$imagefile0["filepath"]."'";
			@chmod($imagefile0["filepath"],0777);
			$ftp->MkDir("tmp",$bname."_data");
			$ftp->MkDir("tmp/".$bname."_data",$data["data_id"]);
			$ftp->UpData("tmp/".$bname."_data/".$data["data_id"]."/",$imagefile0["name"],"../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$imagefile0["name"],"b");
		}
		else if($data["delmakerlogo"]==1){
				$field[]="maker_logo";
				$tdata[]="''";
		}
	
			
		if($data["osusume_chk"]==1){
			$field[]="osusume_chk";
			$tdata[]="1";
			
		}
		else {
			$field[]="osusume_chk";
			$tdata[]="0";
		
		}
		$db->Update($bname."_data",$field,$tdata," where data_id = ".$data["data_id"]);
		$this->AdditionSubData($data);
		
	}
	function UpdateDataList($data) {
		$db=$this->dbobj;
		$bname=$this->bname;
	
		for($i=0;$data["data_id"][$i]!=NULL;$i++) {
			if($data["turn"][$i]==NULL) {
				$data["turn"][$i]=0;
			}
			$field[]="turn";
			$tdata[]=$data["turn"][$i];
			$field[]="view_chk";
			$tdata[]=$data["view_chk"][$i];
			
			if($data["data_osusume_chk"][$i]==1) {
				$field[]="osusume_chk";
				$tdata[]=1;
			}
			else {
				$field[]="osusume_chk";
				$tdata[]=0;
			}

			
			$db->Update($bname."_data",$field,$tdata," where data_id = ".$data["data_id"][$i]);
			unset($field,$tdata);
		} 
	}
	
	function CopyData($id) {
		$db=$this->dbobj;
		$bname=$this->bname;
		$origindata=$db->GetData("select * from ".$bname."_data where data_id = ".$id);
		$field[]="data_id";
		$maxid=$db->GetMaxId($bname."_data","data_id");
		$tdata[]=$maxid;
		$field[]="data_name";
		$tdata[]="'".$origindata["data_name"]."'";
		$field[]="data_comm";
		$tdata[]="'".$origindata["data_comm"]."'";
		$field[]="data_image";
		$tdata[]="'".$origindata["data_image"]."'";
		$field[]="data_head_image";
		$tdata[]="'".$origindata["data_head_image"]."'";
		$field[]="data_foot_image";
		$tdata[]="'".$origindata["data_foot_image"]."'";
		$field[]="turn";
		if($origindata["turn"]==NULL) {
			$origindata["turn"]=0;
		}
		$tdata[]=$origindata["turn"];
		$field[]="view_chk";
		$tdata[]=0;
		$field[]="cate_id";
		if($origindata["cate_id"]==NULL) {
			$origindata["cate_id"]=0;
		}
		$tdata[]=$origindata["cate_id"];
		$field[]="url";
		$tdata[]="'".$origindata["url"]."'";
		$field[]="data_image2";
		$tdata[]="'".$origindata["data_image2"]."'";
		$field[]="osusume_chk";
		if($origindata["osusume_chk"]==NULL) {
			$origindata["osusume_chk"]=0;
		}
		$tdata[]=0;
		$field[]="data_image3";
		$tdata[]="'".$origindata["data_image3"]."'";
		$field[]="maker";
		$tdata[]="'".$origindata["maker"]."'";
		$field[]="item_name";
		$tdata[]="'".$origindata["item_name"]."'";
		$field[]="item_code";
		$tdata[]="'".$origindata["item_code"]."'";
		$field[]="maker_price";
		
		if($origindata["maker_price"]==NULL) {
			$origindata["maker_price"]=0;
		}
		
		$tdata[]=$origindata["maker_price"];
		
		$field[]="price";
		
		if($origindata["price"]==NULL) {
			$origindata["price"]=0;
		}
		$tdata[]=$origindata["price"];
		
		$field[]="maker_price_sub";
		$tdata[]="'".$origindata["maker_price_sub"]."'";
		$field[]="price_sub";
		$tdata[]="'".$origindata["price_sub"]."'";
		
		$field[]="option";
		$tdata[]="'".$origindata["option"]."'";
		$field[]="maker_logo ";
		$tdata[]="'".$origindata["maker_logo"]."'";
		
		$db->Insert($bname."_data",$field,$tdata);

		$contentssubdatalist=$this->GetSubDataList($id);
		$origindata["data_id"]=$maxid;
		for($contentssubrow=0;$contentssubdatalist[$contentssubrow];$contentssubrow++){ 
			$origindata["sub_title"][$contentssubrow]=$contentssubdatalist[$contentssubrow]["data_name"];
			$origindata["sub_comm"][$contentssubrow]=$contentssubdatalist[$contentssubrow]["data_comm"];
			$origindata["sub_num"][$contentssubrow]=$contentssubdatalist[$contentssubrow]["data_id"];
		}
		$this->AdditionSubData($origindata);
	}
	
}

/*
?><meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php
*/
?>