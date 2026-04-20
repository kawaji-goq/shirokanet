<?php
class Ab_SimpleType {
	var $dbobj;
	var $bname;
	var $lim;
	var $numrows;
	var $maxrows;

	function Ab_SimpleType($dbobj) {
		$this->dbobj=$dbobj;
		//$this->bname=$bname;
	}
	
}
class Ab_BasicType {
	var $dbobj;
	var $bname;
	var $lim;
	var $numrows;
	var $maxrows;

	function Ab_BasicType($dbobj) {
		$this->dbobj=$dbobj;
		//$this->bname=$bname;
	}
	
	function GetCateList($id,$lim,$setnum,$orderby) {
		$db=$this->dbobj;
		$bname=$this->bname;
		
		if($lim==NULL) {
			$lim=$this->lim;
		}
		
		if($setnum==NULL) {
			$setnum=1;
		}
		
		$setnum=$lim*($setnum-1);
		
		if($id!=NULL) {			
			$data=$db->SelectList($bname."_cate","where view_chk <> 0 and parents_id = ".$id,$lim,$setnum,$orderby);
			$this->numrows=$db->numrows;
		}
		else {
			$data=$db->SelectList($bname."_cate"," where view_chk <> 0",$lim,$setnum,$orderby);
			$this->numrows=$db->numrows;
		}
		
		return $data;
		
	}
	
	function GetSelDataList() {
		$db=$this->dbobj;
		$bname=$this->bname;		
		$data=$db->SelectSimpleList($bname."_data","");
		$this->numrows=$db->numrows;
	
		return $data;
	}
	
	function GetDataList($id,$lim,$setnum,$orderby) {
		$db=$this->dbobj;
		$bname=$this->bname;
		
		if($setnum==NULL) {
			$setnum=1;
		}
		if($lim!=NULL) {
			$setnum=$lim*($setnum-1);
		}
		else {
			$setnum=($setnum-1);
		}
		
		if($id!=NULL) {			
			$data=$db->SelectList($bname."_data","where view_chk <> 0 and cate_id = ".$id,"",0,$orderby);
			$this->maxrows=$db->numrows;
			$data=$db->SelectList($bname."_data","where view_chk <> 0 and cate_id = ".$id,$lim,$setnum,$orderby);
			$this->numrows=$db->numrows;
		}
		else {
			$catedata=$this->GetSelectDataNum(1," turn ");
			if(!is_null($catedata["id"])) {
				$data=$db->SelectList($bname."_data"," where view_chk <> 0 and cate_id = ".$catedata["cate_id"],"",0,$orderby);
				$this->maxrows=$db->numrows;
				$data=$db->SelectList($bname."_data"," where view_chk <> 0 and cate_id = ".$catedata["cate_id"],$lim,$setnum,$orderby);
				$this->numrows=$db->numrows;
			}
		}
		
		return $data;
		
	}
	
	function GetDataIdList($id,$orderby) {
	
		$db=$this->dbobj;
		$bname=$this->bname;
		
		if($lim==NULL) {
			$lim=$this->lim;
		}
		
		if($setnum==NULL) {
			$setnum=1;
		}
		
		$setnum=$lim*($setnum-1);
		
		if($id!=NULL) {			
			$data=$db->SelectList($bname."_data","where view_chk <> 0 and cate_id = ".$id,$lim,$setnum,$orderby);
			$this->numrows=$db->numrows;
		}
		
		return $data;
		
	}
	
	function GetDataListAll($orderby,$lim,$setnum) {
	
		$db=$this->dbobj;
		$bname=$this->bname;
		
		if($lim==NULL) {
			$lim=$this->lim;
		}
		
		if($setnum==NULL) {
			$setnum=1;
		}
		
		$setnum=$lim*($setnum-1);
		$db->SelectList($bname."_data"," where view_chk <> 0 ",$this->lim,0,$orderby);
		$this->maxrows=$db->numrows;
		$data=$db->SelectList($bname."_data"," where view_chk <> 0 ",$lim,$setnum,$orderby);
		$this->numrows=$db->numrows;
		return $data;
		
	}

	function GetDetailsData($id) {
		$db=$this->dbobj;
		$bname=$this->bname;
		if($id) {
			$data=$db->SelectData($bname."_data","where data_id = ".$id);
			return $data;
		}
		
	}
	function GetSelectDataNum($num,$orderby) {
		$db=$this->dbobj;
		$bname=$this->bname;
		if(is_null($orderby)){
			$orderby="turn";
		}
		if($num) {
			$data=$db->SelectData($bname."_data"," order by ".$orderby." ".$db->CreateLimitSql("",1,$num-1));
			return $data;
		}
		
	}	

	function GetSubDataList($id) {
		$db=$this->dbobj;
		$bname=$this->bname;
				
		if($id!=NULL) {			
			$data=$db->SelectSimpleList($bname."_subdata","where view_chk <> 0 and data_id = ".$id);
			$this->numrows=$db->numrows;
		}
		return $data;
	}
	
	function ChangeLay($ary,$num) {
		for($i=0;$ary[$i]!=NULL;$i++) {
			$newary[(int)($i/$num)][(int)($i%$num)]=$ary[$i];
		}
		return $newary;
	}
	
	function LoadSet() {
		$db=$this->dbobj;
		$bname=$this->bname;
		$data=$db->SelectData($bname."_set","where set_id = 1");
		return $data;
	}
	
	function AdditionCate($data) {
		$db=$this->dbobj;
		$bname=$this->bname;
		if(is_null($data["html_chk"])){
			$data["html_chk"]=0;
		}
		
		if($data["new_cate_name"]!=NULL||$data["new_cate_comm"]!=NULL) {
			$db=$this->dbobj;
			$bname=$this->bname;
			$maxid=$db->GetMaxId($bname."_cate","cate_id");
			unset($field,$tdata);
			
			if($data["new_view_chk"]==NULL){
				$data["new_view_chk"]=0;
			}
			
			$field[]="cate_id";
			$field[]="cate_name";
			$field[]="cate_comm";
			$field[]="cate_id";
			$field[]="view_chk";
			$field[]="html_chk";
			$tdata[]=$maxid;
			$tdata[]="'".$data["new_cate_name"]."'";
			$tdata[]="'".$data["new_cate_comm"]."'";
			$tdata[]="'".$_REQUEST["cate_id"]."'";
			$tdata[]=$data["new_view_chk"];
			$tdata[]=$data["html_chk"];
			$db->Insert($bname."_cate",$field,$tdata);
		}
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
			
			$field[]="data_id";
			$field[]="turn";
			$field[]="data_name";
			$field[]="data_comm";
			$field[]="cate_id";
			$field[]="view_chk ";
			$tdata[]=$maxid;
			$tdata[]=$maxid;
			$tdata[]="'".$data["new_data_name"]."'";
			$tdata[]="'".$data["new_data_comm"]."'";
			$tdata[]="'".$_REQUEST["cate_id"]."'";
			$tdata[]=$data["new_view_chk"];
			$db->Insert($bname."_data",$field,$tdata);
		}
	}
	
	function UpdateData($data) {
		$db=$this->dbobj;
		$bname=$this->bname;
		
  		for($i=0;$data["data_id"][$i]!=NULL;$i++){
			$field[]="data_name";
			$field[]="data_comm";
			$field[]="view_chk";
			$tdata[]="'".$data["data_name"][$i]."'";
			$tdata[]="'".$data["data_comm"][$i]."'";
			$tdata[]="'".$data["view_chk"][$i]."'";
			print_r($tdata);
			$db->Update($bname."_data",$field,$tdata," where data_id = ".$data["data_id"][$i]);
			unset($field,$tdata);
			
		}
		
	}
	
	function UpdateSet() {
		global $DomainData;
		$db=$this->dbobj;
		$bname=$this->bname;
		$setdata=$this->LoadSet();
		
		$imgobj=new Upload();
		$imgobj->path="./tmp/".$DomainData["dbname"]."/".$bname."/";
		$imgobj->rpath="/tmp/".$bname."_cate/";
		@mkdir("../tmp/".$DomainData["dbname"]."/".$bname."_cate/");		
		$imagefile1=$imgobj->UpImgAndResize("listimg_defalt",$setdata["listimg_w"],$setdata["listimg_h"]);	
		
		for($i=0;!file_exists($imagefile1["filepath"]);$i++) {
			if($i>100) {
				break;
			}
		}
		
		$imgobj=new Upload();
		$imgobj->path="./tmp/".$DomainData["dbname"]."/".$bname."/";
		$imgobj->rpath="/tmp/".$bname."_data/";
		@mkdir("../tmp/".$DomainData["dbname"]."/".$bname."_data/");
		
		$imagefile2=$imgobj->UpImgAndResize("detailsimg_defalt",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);
		
		$field[]="listpath";
		$data[]="'".$_POST["listpath"]."'";
		$field[]="listimg_w";
		$data[]="'".$_POST["listimg_w"]."'";
		$field[]="listimg_h";
		$data[]="'".$_POST["listimg_h"]."'";
		$field[]="detailsimg_w";
		$data[]="'".$_POST["detailsimg_w"]."'";
		$field[]="detailsimg_h";
		$data[]="'".$_POST["detailsimg_h"]."'";
		$field[]="detailspath";
		$data[]="'".$_POST["detailspath"]."'";
				
		$ftp=new Cube_FTP();
		$ftp->Connect($DomainData["id"],$DomainData["pass"]);
		
		if($imagefile1["filepath"]!=NULL||$_POST["del_listimg"]==1) {
			$field[]="listimg_defalt";
			$data[]="'".$imagefile1["filepath"]."'";
			@chmod($imagefile1["filepath"],0777);
			if($imagefile1["filepath"]!=NULL) {
				$ftp->UpData("tmp/".$bname."_cate/",$imagefile1["name"],"./tmp/".$DomainData["dbname"]."/".$bname."/".$imagefile1["name"],"b");
			}
		}
		if($imagefile2["filepath"]!=NULL||$_POST["del_detailsimg"]==1) {
			$field[]="detailsimg_defalt";
			$data[]="'".$imagefile2["filepath"]."'";
			@chmod($imagefile2["filepath"],0777);
			if($imagefile2["filepath"]!=NULL) {
				$ftp->UpData("tmp/".$bname."_data/",$imagefile2["name"],"./tmp/".$DomainData["dbname"]."/".$bname."/".$imagefile2["name"],"b");
			}
		}
		
		$db->Update($bname."_set",$field,$data," where set_id = 1");
		
	}
	
	function DeleteCate($data){
		$db=$this->dbobj;
		$bname=$this->bname;
		
		for($i=0;$data["delchk"][$i]!=NULL;$i++) {
			$db->Delete($bname."_cate"," where cate_id= ".$data["delchk"][$i]);
		}
	}
	
	function DeleteData($data){
		$db=$this->dbobj;
		$bname=$this->bname;
		
		for($i=0;$data["delchk"][$i]!=NULL;$i++) {
				$db->Delete($bname."_data"," where data_id= ".$data["delchk"][$i]);
				
		}
	}
	function DeleteDataId($data_id){
		$db=$this->dbobj;
		$bname=$this->bname;
		$db->Delete($bname."_data"," where data_id= ".$data_id);
		$db->Delete($bname."_subdata"," where data_id= ".$data_id);		
	}

	function GetDetailsCate($id) {
		$db=$this->dbobj;
		$bname=$this->bname;
		if($id) {
			$data=$db->SelectData($bname."_cate","where cate_id = ".$id);
			return $data;
		}
	}
}

class Ab_AdminBasicType extends Ab_BasicType{

	var $dbobj;
	var $bname;
	var $lim;
	var $numrows;
	
	function Ab_BasicType($dbobj) {
		$this->dbobj=$dbobj;
		//$this->bname=$bname;
	}
	
	function GetCateList($id,$lim,$setnum,$orderby) {
		$db=$this->dbobj;
		$bname=$this->bname;
		
		if($lim==NULL) {
			$lim=$this->lim;
		}
		
		if($setnum==NULL) {
			$setnum=1;
		}
		
		$setnum=$lim*($setnum-1);
		
		if($id!=NULL) {			
			$data=$db->SelectList($bname."_cate"," where parents_id = ".$id,$lim,$setnum,$orderby);
			$this->numrows=$db->numrows;
		}
		else {
			$data=$db->SelectList($bname."_cate"," ",$lim,$setnum,$orderby);
			$this->numrows=$db->numrows;
		}
		
		return $data;
		
	}
	
	function GetDetailsCate($id) {
		$db=$this->dbobj;
		$bname=$this->bname;
		
		if($id) {
			$data=$db->SelectData($bname."_cate","where cate_id = ".$id);
			return $data;
		}
		
	}
	
	function GetDataList($id,$lim,$setnum,$orderby) {
		$db=$this->dbobj;
		$bname=$this->bname;
		
		if($lim==NULL) {
			$lim=$this->lim;
		}
		
		if($setnum==NULL) {
			$setnum=1;
		}
		
		$setnum=$lim*($setnum-1);
		
		if($id!=NULL) {			
			$data=$db->SelectList($bname."_data"," where  cate_id = ".$id,$lim,$setnum,$orderby);
			$this->numrows=$db->numrows;
		}
		else {
			$data=$db->SelectList($bname."_data"," ",$lim,$setnum,$orderby);
			$this->numrows=$db->numrows;
		}
		
		return $data;
		
	}
	
	function GetDataIdList($id,$orderby) {
	
		$db=$this->dbobj;
		$bname=$this->bname;
		
		if($lim==NULL) {
			$lim=$this->lim;
		}
		
		if($setnum==NULL) {
			$setnum=1;
		}
		
		$setnum=$lim*($setnum-1);
		
		if($id!=NULL) {			
			$data=$db->SelectList($bname."_data","where  cate_id = ".$id,$lim,$setnum,$orderby);
			$this->numrows=$db->numrows;
		}
		
		return $data;
		
	}
	
	function GetDetailsData($id) {
		$db=$this->dbobj;
		$bname=$this->bname;
		if($id) {
			$data=$db->SelectData($bname."_data","where data_id = ".$id);
			return $data;
		}
		
	}
	
	function GetSubDataList($id) {
		$db=$this->dbobj;
		$bname=$this->bname;
				
		if($id!=NULL) {			
			$data=$db->SelectSimpleList($bname."_subdata","where data_id = ".$id);
			$this->numrows=$db->numrows;
		}
		return $data;
	}
	
	function ChangeLay($ary,$num) {
		for($i=0;$ary[$i]!=NULL;$i++) {
			$newary[(int)($i/$num)][(int)($i%$num)]=$ary[$i];
		}
		return $newary;
	}
	
	function LoadSet() {
		$db=$this->dbobj;
		$bname=$this->bname;
		$data=$db->SelectData($bname."_set","where set_id = 1");
		return $data;
	}
	
	function LoadSetting() {
		$db=$this->dbobj;
		$bname=$this->bname;
		$data=$db->SelectData($bname."_setting","where set_id = 1");
		return $data;
	}
	
	function AdditionCate($data) {
		$db=$this->dbobj;
		$bname=$this->bname;
			if(is_null($data["html_chk"])){
				$data["html_chk"]=0;
			}
		if($data["new_cate_name"]!=NULL||$data["new_cate_comm"]!=NULL) {
			$db=$this->dbobj;
			$bname=$this->bname;
			$maxid=$db->GetMaxId($bname."_cate","cate_id");
			unset($field,$tdata);
			if($data["view_chk"]==NULL){
				$data["view_chk"]=0;
			}
			
			$setdata=$this->LoadSet();
			$imgobj=new Upload();
			@mkdir("../tmp/".$_SESSION["DomainData"]["dbname"]);
			@mkdir("../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname);
			
			$imgobj->path="../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."/";
			$imgobj->rpath="/tmp/".$bname."_cate/".$maxid."/";
			$imagefile=$imgobj->UpImgAndResize("imagefile",$setdata["listimg_w"],$setdata["listimg_h"]);	

			$imgobj2=new Upload();
			$imgobj2->path="../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."/";
			$imgobj2->rpath="/tmp/".$bname."_cate/".$maxid."/";
			$imagefile2=$imgobj2->UpImgAndResize("imagefile2",$setdata["listimg2_w"],$setdata["listimg2_h"]);	

			$field[]="cate_id";
			$field[]="cate_name";
			$field[]="cate_comm";
			$field[]="parents_id";
			$field[]="view_chk";
			$tdata[]=$maxid;
			$tdata[]="'".$data["new_cate_name"]."'";
			$tdata[]="'".$data["new_cate_comm"]."'";
			$tdata[]=$data["cate_id"];
			$tdata[]=$data["view_chk"];
			$field[]="turn";
			$tdata[]=$maxid;
			$field[]="html_chk";
			$tdata[]=$data["html_chk"];
			
			$field[]="url";
			$tdata[]="'".$data["url"]."'";
			
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
			
				if($imagefile["filepath"]!=NULL) {
					$field[]="cate_image";
					$tdata[]="'".$imagefile["filepath"]."'";
					@chmod($imagefile["filepath"],0777);
					$ftp->MkDir("tmp/".$bname."_cate",$maxid);
					$ftp->UpData("tmp/".$bname."_cate/".$maxid."/",$imagefile["name"],"../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."/".$imagefile["name"],"b");
				}
				else if($setdata["listimg_defalt"]!=NULL){
					$field[]="cate_image";
					$tdata[]="'".$setdata["listimg_defalt"]."'";
				}
				
				if($imagefile2["filepath"]!=NULL) {
					$field[]="image2";
					$tdata[]="'".$imagefile2["filepath"]."'";
					@chmod($imagefile2["filepath"],0777);
					$ftp->MkDir("tmp/".$bname."_cate",$maxid);
					$ftp->UpData("tmp/".$bname."_cate/".$maxid."/",$imagefile2["name"],"../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."/".$imagefile2["name"],"b");
				}
				else if($setdata["listimg2_defalt"]!=NULL){
					$field[]="image2";
					$tdata[]="'".$setdata["listimg2_defalt"]."'";
				}
				
				$db->Insert($bname."_cate",$field,$tdata);
			
				$db->Query("update lastupdate set lastupdate=".time()."");
			
			return $maxid;
		}
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
		if($data["osusume_chk"]==1){
			$field[]="osusume_chk";
			$tdata[]="1";
		}
			$db->Insert($bname."_data",$field,$tdata);
			$data["data_id"]=$maxid;
			//print_r($tdata);
			$this->AdditionSubData($data);
				$db->Query("update lastupdate set lastupdate=".time()."");
		}
		return $maxid;
	}
	
	function AdditionSubData($data) {
		$db=$this->dbobj;
		$bname=$this->bname;
		$db->Delete($bname."_subdata"," where data_id= ".$data["data_id"]);
		for($i=0;$data["sub_num"][$i]!=NULL;$i++){
			if($data["sub_title"][$i]!=NULL||$data["sub_comm"][$i]!=NULL) {
				$db=$this->dbobj;
				$bname=$this->bname;
				$maxid=$db->GetMaxId($bname."_subdata","sub_id");
				unset($field,$tdata);
				if($data["view_chk"]==NULL){
					$data["view_chk"]=1;
				}
				$field[]="sub_id";
				$field[]="data_name";
				$field[]="data_comm";
				$field[]="data_id";
				$field[]="view_chk";
				$tdata[]=$maxid;
				$tdata[]="'".$data["sub_title"][$i]."'";
				$tdata[]="'".$data["sub_comm"][$i]."'";
				$tdata[]=$data["data_id"];
				$tdata[]=$data["view_chk"];
				$db->Insert($bname."_subdata",$field,$tdata);
				unset($field,$tdata);
			}
		}
	}
	
	function UpdateCate($data) {
		$db=$this->dbobj;
		$bname=$this->bname;
		
		//	$field[]=$data["data_id"];
		//	$field[]="turn";
		//	$field[]="view_chk";
		//$field[]="cate_id";
 		for($i=0;$data["cate_id"][$i]!=NULL;$i++){
			$field[]="cate_name";
			$field[]="cate_comm";
			$field[]="view_chk";
			$tdata[]="'".$data["cate_name"][$i]."'";
			$tdata[]="'".$data["cate_comm"][$i]."'";
			$tdata[]=$data["view_chk"][$i];
			$db->Update($bname."_cate",$field,$tdata," where cate_id = ".$data["cate_id"][$i]);
			unset($field,$tdata);
				$db->Query("update lastupdate set lastupdate=".time()."");
		}
	}
	
	function UpdateCateList($data) {
		$db=$this->dbobj;
		$bname=$this->bname;
	
		for($i=0;$data["cate_id"][$i]!=NULL;$i++) {
			if($data["turn"][$i]==NULL) {
				$data["turn"][$i]=0;
			}
			$field[]="turn";
			$tdata[]=$data["turn"][$i];
			$field[]="view_chk";
			$tdata[]=$data["view_chk"][$i];
			$db->Update($bname."_cate",$field,$tdata," where cate_id = ".$data["cate_id"][$i]);
			unset($field,$tdata);
				$db->Query("update lastupdate set lastupdate=".time()."");
		} 
	}
	
	function UpdateData($data) {
		$db=$this->dbobj;
		$bname=$this->bname;
		
  		for($i=0;$data["data_id"][$i]!=NULL;$i++){
			$field[]="data_name";
			$field[]="data_comm";
			$field[]="view_chk";
			$tdata[]="'".$data["data_name"][$i]."'";
			$tdata[]="'".$data["data_comm"][$i]."'";
			$tdata[]=$data["view_chk"][$i];
			$db->Update($bname."_data",$field,$tdata," where data_id = ".$data["data_id"][$i]);
			unset($field,$tdata);
				$db->Query("update lastupdate set lastupdate=".time()."");
		}
		
	}
	
	function UpdateOneCate($data) {
		$db=$this->dbobj;
		$bname=$this->bname;
		$setdata=$this->LoadSet();
		if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
		@mkdir("../tmp/".$_SESSION["DomainData"]["dbname"]);
		@mkdir("../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_cate");
		@mkdir("../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_cate/".$data["cate_id"]);
	
		$imgobj=new Upload();
		$imgobj->path="../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."/";
		$imgobj->rpath="/tmp/".$bname."_cate/".$data["cate_id"]."/";
		$imagefile=$imgobj->UpImgAndResize("imagefile",$setdata["listimg_w"],$setdata["listimg_h"]);	

		$imgobj2=new Upload();
		$imgobj2->path="../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."/";
		$imgobj2->rpath="/tmp/".$bname."_cate/".$data["cate_id"]."/";
		$imagefile2=$imgobj2->UpImgAndResize("imagefile2",$setdata["listimg2_w"],$setdata["listimg2_h"]);	


		if(is_null($data["html_chk"])){
			$data["html_chk"]=0;
		}

		$field[]="cate_name";
		$field[]="cate_comm";
		$field[]="view_chk";
		$tdata[]="'".$data["cate_name"]."'";
		$tdata[]="'".$data["cate_comm"]."'";
		$tdata[]=$data["view_chk"];
		$field[]="html_chk";
		$tdata[]=$data["html_chk"];
		$field[]="url";
		$tdata[]="'".$data["url"]."'";
		
		
		if($imagefile["filepath"]!=NULL||$data["delimage"]==1){
			
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
			
				if($imagefile["filepath"]!=NULL) {
					$field[]="cate_image";
					$tdata[]="'".$imagefile["filepath"]."'";
					@chmod($imagefile["filepath"],0777);
					$ftp->MkDir("tmp",$bname."_cate");
					$ftp->MkDir("tmp/".$bname."_cate",$data["cate_id"]);
					$ftp->UpData("tmp/".$bname."_cate/".$data["cate_id"]."/",$imagefile["name"],"../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."/".$imagefile["name"],"b");
				}
				else if($setdata["listimg_defalt"]!=NULL){
					if($data["delimage"]==1) {
						$field[]="cate_image";
						$tdata[]="'".$setdata["listimg_defalt"]."'";
					}
				}
				else if($data["delimage"]==1) {
					$field[]="cate_image";
					$tdata[]="''";
				}

		}

		if($imagefile2["filepath"]!=NULL||$data["delimage2"]==1){
			
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
			
				if($imagefile2["filepath"]!=NULL) {
					$field[]="image2";
					$tdata[]="'".$imagefile2["filepath"]."'";
					@chmod($imagefile2["filepath"],0777);
					$ftp->MkDir("tmp",$bname."_cate");
					$ftp->MkDir("tmp/".$bname."_cate",$data["cate_id"]);
					$ftp->UpData("tmp/".$bname."_cate/".$data["cate_id"]."/",$imagefile2["name"],"../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."/".$imagefile2["name"],"b");
				}
				else if($setdata["listimg2_defalt"]!=NULL){
					if($data["delimage2"]==1) {
						$field[]="image2";
						$tdata[]="'".$setdata["listimg2_defalt"]."'";
					}
				}
				else if($data["delimage2"]==1) {
					$field[]="image2";
					$tdata[]="''";
				}
		}

		
		$db->Update($bname."_cate",$field,$tdata," where cate_id = ".$data["cate_id"]);
		unset($field,$tdata);
				$db->Query("update lastupdate set lastupdate=".time()."");
				}
				else{
				//
		@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp");
		@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_cate");
		@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_cate/".$data["cate_id"]);
	
		$imgobj=new Upload();
		$imgobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_cate/";
		$imgobj->rpath="/tmp/".$bname."_cate/".$data["cate_id"]."/";
		$imagefile=$imgobj->UpImgAndResize("imagefile",$setdata["listimg_w"],$setdata["listimg_h"]);	

		$imgobj2=new Upload();
		$imgobj2->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_cate/";
		$imgobj2->rpath="/tmp/".$bname."_cate/".$data["cate_id"]."/";
		$imagefile2=$imgobj2->UpImgAndResize("imagefile2",$setdata["listimg2_w"],$setdata["listimg2_h"]);	

		if(is_null($data["html_chk"])){
			$data["html_chk"]=0;
		}

		$field[]="cate_name";
		$field[]="cate_comm";
		$field[]="view_chk";
		$tdata[]="'".$data["cate_name"]."'";
		$tdata[]="'".$data["cate_comm"]."'";
		$tdata[]=$data["view_chk"];
		$field[]="html_chk";
		$tdata[]=$data["html_chk"];
		$field[]="url";
		$tdata[]="'".$data["url"]."'";
		
		
		if($imagefile["filepath"]!=NULL||$data["delimage"]==1){
			
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
			
				if($imagefile["filepath"]!=NULL) {
					$field[]="cate_image";
					$tdata[]="'".$imagefile["filepath"]."'";
					@chmod($imagefile["filepath"],0777);
					$ftp->MkDir("tmp",$bname."_cate");
					$ftp->MkDir("tmp/".$bname."_cate",$data["cate_id"]);
					$ftp->UpData("tmp/".$bname."_cate/".$data["cate_id"]."/",$imagefile["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_cate/".$imagefile["name"],"b");
				}
				else if($setdata["listimg_defalt"]!=NULL){
					if($data["delimage"]==1) {
						$field[]="cate_image";
						$tdata[]="'".$setdata["listimg_defalt"]."'";
					}
				}
				else if($data["delimage"]==1) {
					$field[]="cate_image";
					$tdata[]="''";
				}

		}

		if($imagefile2["filepath"]!=NULL||$data["delimage2"]==1){
			
			$ftp=new Cube_FTP();
			$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
			
				if($imagefile2["filepath"]!=NULL) {
					$field[]="image2";
					$tdata[]="'".$imagefile2["filepath"]."'";
					@chmod($imagefile2["filepath"],0777);
					$ftp->MkDir("tmp",$bname."_cate");
					$ftp->MkDir("tmp/".$bname."_cate",$data["cate_id"]);
					$ftp->UpData("tmp/".$bname."_cate/".$data["cate_id"]."/",$imagefile2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_cate/".$imagefile2["name"],"b");
				}
				else if($setdata["listimg2_defalt"]!=NULL){
					if($data["delimage2"]==1) {
						$field[]="image2";
						$tdata[]="'".$setdata["listimg2_defalt"]."'";
					}
				}
				else if($data["delimage2"]==1) {
					$field[]="image2";
					$tdata[]="''";
				}
		}

		
		$db->Update($bname."_cate",$field,$tdata," where cate_id = ".$data["cate_id"]);
		unset($field,$tdata);
				$db->Query("update lastupdate set lastupdate=".time()."");
				}
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
			
			$db->Update($bname."_data",$field,$tdata," where data_id = ".$data["data_id"][$i]);
			unset($field,$tdata);
		} 
	}
	
	function UpdateOneData($data) {
		$db=$this->dbobj;
		$bname=$this->bname;
			if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
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



		$field[]="data_name";
		$field[]="data_comm";
		$field[]="view_chk";
		$tdata[]="'".$data["data_name"]."'";
		$tdata[]="'".$data["data_comm"]."'";
		$tdata[]="'".$data["view_chk"]."'";
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
				$db->Query("update lastupdate set lastupdate=".time()."");
				}
				else{
	@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp");
	@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data");
	@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$data["data_id"]);
	
	$setdata=$this->LoadSet();
	$imgobj=new Upload();
	$imgobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/";
	$imgobj->rpath="/tmp/".$bname."_data/".$data["data_id"]."/";
	$imagefile=$imgobj->UpImgAndResize("imagefile",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);	
	
	$imgobj2=new Upload();
	$imgobj2->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/";
	$imgobj2->rpath="/tmp/".$bname."_data/".$data["data_id"]."/";
	$imagefile2=$imgobj2->UpImgAndResize("imagefile2",$setdata["detailsimg2_w"],$setdata["detailsimg2_h"]);	
	
	
	
	$field[]="data_name";
	$field[]="data_comm";
	$field[]="view_chk";
	$tdata[]="'".$data["data_name"]."'";
	$tdata[]="'".$data["data_comm"]."'";
	$tdata[]="'".$data["view_chk"]."'";
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
	$ftp->UpData("tmp/".$bname."_data/".$data["data_id"]."/",$imagefile["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$imagefile["name"],"b");
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
	$ftp->UpData("tmp/".$bname."_data/".$data["data_id"]."/",$imagefile2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$imagefile2["name"],"b");
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
	$db->Query("update lastupdate set lastupdate=".time()."");
	}			

				///////////////////////////////////////////////
	}
	
	function NonUpdateOneData($data) {
		$db=$this->dbobj;
		$bname=$this->bname;
		
		@mkdir("../tmp/".$_SESSION["DomainData"]["dbname"]);
		@mkdir("../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data");
		@mkdir("../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$data["data_id"]);
		
		$setdata=$this->LoadSet();
		$imgobj=new Upload();
		$imgobj->path="../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/";
		$imgobj->rpath="/tmp/".$bname."_data/".$data["data_id"]."/";
		$imagefile=$imgobj->UpImgAndResize("draftimage",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);	
		
		$field[]="draft_name";
		$field[]="draft_comm";
		$field[]="view_chk";
		$tdata[]="'".$data["data_name"]."'";
		$tdata[]="'".$data["data_comm"]."'";
		$tdata[]="'".$data["view_chk"]."'";
		
		if($imagefile["filepath"]!=NULL) {
			@chmod($imagefile1["filepath"],0777);
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
		
		$this->AdditionSubData($data);
				$db->Query("update lastupdate set lastupdate=".time()."");
	}

	function DeleteCate($id){
		$db=$this->dbobj;
		$bname=$this->bname;
		// echo $data["delchk"][$i];
		$db->Delete($bname."_cate"," where cate_id= ".$id);
		//$db->Delete($bname."_data"," where cate_id= ".$id);
	}
	
	function DeleteData($data){
		$db=$this->dbobj;
		$bname=$this->bname;
		
		//print_r($data);
		for($i=0;$data["delchk"][$i]!=NULL;$i++) {
			// echo $data["delchk"][$i];
			$db->Delete($bname."_data"," where data_id= ".$data["delchk"][$i]);
			$db->Delete($bname."_subdata"," where data_id= ".$data["delchk"][$i]);
				$db->Query("update lastupdate set lastupdate=".time()."");
		}
	}
	
	function DeleteOneData($id){
		$db=$this->dbobj;
		$bname=$this->bname;
		// echo $data["delchk"][$i];
		$db->Delete($bname."_data"," where data_id= ".$id);
		$db->Delete($bname."_subdata"," where data_id= ".$id);
				$db->Query("update lastupdate set lastupdate=".time()."");
	}
}

class Ab_NormalPageType extends Ab_BasicType{
	
}

class Ab_AdditionPageType extends Ab_BasicType{
	
}

class Ab_NoCatePageType extends Ab_BasicType{
	
	function GetCateList($id,$lim,$setnum,$orderby) {
		return false;
	}
	
	function GetDataList($id,$lim,$setnum,$orderby) {
		$db=$this->dbobj;
		$bname=$this->bname;
		
		if($lim==NULL) {
			$lim=$this->lim;
		}
		
		if($setnum==NULL) {
			$setnum=1;
		}
		
		$setnum=$lim*($setnum-1);
		
		$data=$db->SelectList($bname."_data"," where view_chk <> 0",$lim,$setnum,$orderby);
		$this->numrows=$db->numrows;
	
		return $data;
		
	}
}
class Ab_News extends Ab_NoCatePageType{
	
}

class Ab_LinkPageType extends Ab_BasicType{
	function GetSubDataList($id) {
		$db=$this->dbobj;
		$bname=$this->bname;
				
		if($id!=NULL) {			
			$data=$db->SelectSimpleList($bname."_data","where view_chk <> 0 and cate_id = ".$id);
			$this->numrows=$db->numrows;
		}
		else {
			echo "nothing";
		}
		return $data;
	}
}

class Ab_AdminLinkPageType extends Ab_AdminBasicType{
	function GetSubDataList($id) {
		$db=$this->dbobj;
		$bname=$this->bname;
				
		if($id!=NULL) {			
			$data=$db->SelectSimpleList($bname."_data","where view_chk <> 0 and cate_id = ".$id);
			$this->numrows=$db->numrows;
		}
		else {
			echo "nothing";
		}
		return $data;
	}
	
	function AdditionCate($data) {
		$db=$this->dbobj;
		$bname=$this->bname;
		
		if($data["new_cate_name"]!=NULL||$data["new_cate_comm"]!=NULL) {
			$db=$this->dbobj;
			$bname=$this->bname;
			$maxid=$db->GetMaxId($bname."_cate","cate_id");
			unset($field,$tdata);
			if($data["new_view_chk"]==NULL){
				$data["new_view_chk"]=0;
			}
			if(is_null($data["html_chk"])){
				$data["html_chk"]=0;
			}
			$field[]="cate_id";
			$field[]="cate_name";
			$field[]="cate_comm";
			$field[]="parents_id";
			$field[]="view_chk";
			$tdata[]=$maxid;
			$tdata[]="'".$data["new_cate_name"]."'";
			$tdata[]="'".$data["new_cate_comm"]."'";
			$tdata[]=0;
			$tdata[]=$data["new_view_chk"];
			$field[]="turn";
			$tdata[]=$maxid;
			$field[]="html_chk";
			$tdata[]=$data["html_chk"];
			
			$db->Insert($bname."_cate",$field,$tdata);
			
				
			
			return $maxid;
		}
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
						if($data["new_link_type"]==NULL){
				$data["new_link_type"]=0;
			}

			if(is_null($data["html_chk"])){
				$data["html_chk"]=0;
			}
			$setdata=$this->LoadSet();
			$imgobj=new Upload();
			@mkdir("../tmp/".$_SESSION["DomainData"]["dbname"]);
			@mkdir("../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data");
			$imgobj->path="../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/";
			$imgobj->rpath="/tmp/".$bname."_data/".$maxid."/";
			$imagefile=$imgobj->UpImgAndResize("imagefile",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);
			
			$field[]="data_id";
			$field[]="data_name";
			$field[]="url";
			$field[]="data_comm";
			$field[]="cate_id";
			$field[]="view_chk ";
			$tdata[]=$maxid;
			$tdata[]="'".$data["new_data_name"]."'";
			$tdata[]="'".$data["new_data_url"]."'";
			$tdata[]="'".$data["new_data_comm"]."'";
			$tdata[]=$data["cate_id"];
			$tdata[]=$data["new_view_chk"];
			$field[]="turn";
			$tdata[]=$maxid;
			$field[]="link_type";
			$tdata[]=$data["new_link_type"];
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
			$db->Insert($bname."_data",$field,$tdata);
			$data["data_id"]=$maxid;
			
			//$this->AdditionSubData($data);


		}
		return $maxid;
	}
	
	function DeleteOneData($id){
		$db=$this->dbobj;
		$bname=$this->bname;
		// echo $data["delchk"][$i];
		$db->Delete($bname."_data"," where data_id= ".$id);
	}
	function UpdateOneData($data) {
		$db=$this->dbobj;
		$bname=$this->bname;
		
		$setdata=$this->LoadSet();
		$imgobj=new Upload();
		$imgobj->path="../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$data["data_id"]."/";
		$imgobj->rpath="/tmp/".$bname."_data/".$data["data_id"]."/";
		$imagefile=$imgobj->UpImgAndResize("imagefile",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);	
		
		$field[]="data_name";
		$field[]="data_comm";
		$field[]="view_chk";
		$field[]="url";
		
		$tdata[]="'".$data["data_name"]."'";
		$tdata[]="'".$data["data_comm"]."'";
		$tdata[]="'".$data["view_chk"]."'";
		$tdata[]="'".$data["data_url"]."'";
		
			if($imagefile["filepath"]!=NULL) {
				$ftp=new Cube_FTP();
				$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
				$field[]="data_image";
				$tdata[]="'".$imagefile["filepath"]."'";
				@chmod($imagefile1["filepath"],0777);
				$ftp->MkDir("tmp/".$bname."_data",$data["data_id"]);
				$ftp->UpData("tmp/".$bname."_data/".$data["data_id"]."/",$imagefile["name"],"../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."_data/".$imagefile["name"],"b");
			}
			else if($setdata["detailsimg_defalt"]!=NULL){
				$field[]="data_image";
				$tdata[]="'".$setdata["detailsimg_defalt"]."'";
			}else if($data["delimage"]==1) {
					$field[]="data_image";
					$tdata[]="''";
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