<?php
class MyContents extends Ab_BasicType{
	function getCateList($id){
			$dbobj=$this->dbobj;
			
			if($id!=NULL){
			$sql="select * from contents_cate where parents_id = ".$id." order by turn";
			$list=$dbobj->GetList($sql);
			return $list;
			}
	}
	function getCateData($id){
		$dbobj=$this->dbobj;
		if($id!=NULL){
				$sql="select * from contents_cate where cate_id =".$id;
				return $dbobj->GetData($sql);
		}
	}
	
	function getCateSetting($id){
		$dbobj=$this->dbobj;
		if($id!=NULL){
				$sql="select * from contents_cate_set where cate_id =".$id." order by c_turn";
				
				return $dbobj->GetList($sql);
		}
	}
	function getDataList($id){
			$dbobj=$this->dbobj;
			
			if($id!=NULL){
			$sql="select * from contents_data where cate_id = ".$id."  order by turn";
			$list=$dbobj->GetList($sql);
			return $list;
			}
	}
	
		function getDataSetting($id){
		$dbobj=$this->dbobj;
		if($id!=NULL){
				$sql="select * from contents_data_set where cate_id =".$id." order by c_turn";
				return $dbobj->GetList($sql);
		}
	}
		function getDetailsData($id){
		$dbobj=$this->dbobj;
		if($id!=NULL){
				$sql="select * from contents_data where cate_id =".$id;
				return $dbobj->GetData($sql);
		}
	}
		function getDataData($id){
		$dbobj=$this->dbobj;
		if($id!=NULL){
				$sql="select * from contents_data where data_id =".$id;
				return $dbobj->GetData($sql);
		}
	}
		function getDataSetting2($id){
		$dbobj=$this->dbobj;
		if($id!=NULL){
				$sql="select * from contents_data_set where data_id =".$id." order by c_turn";
				return $dbobj->GetList($sql);
		}
	}

}

$tenpodata=$dbobj->GetData("select * from tenpo_data");
$ad_contents=new MyContents($dbobj);
//$catesettinglist=$ad_contents->getCateSetting($_REQUEST["cate_id"]);

if($_POST["pmodes"]=="regist") {
/*
画像加工
*/
$maxsql="select max(data_id) as maxid  from contents_data";
$maxdata=$dbobj->GetData($maxsql);
$maxid=$maxdata["maxid"]+1;
$maxturnsql="select max(turn) as maxturn  from contents_data where cate_id = ".$_REQUEST["cate_id"];
$maxturndata=$dbobj->GetData($maxturnsql);
$maxturn=$maxturndata["maxturn"]+1;

	@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/contents_data/");
	@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/contents_data/".$maxid."/");
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/contents_data/".$maxid,0777);
	@system("chmod -Rf 0777 ".$_SERVER['DOCUMENT_ROOT']."/tmp/contents_data");
	if($_FILES["image1"]["error"]==0) {
	$imgobj=new Upload();
	$imgobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/contents_data/".$maxid."/";
	$imgobj->rpath="/tmp/contents_data/".$maxid."/";
	$imagefile1=$imgobj->UpImgAndResize("image1",$_REQUEST["image1_width_l"],$_REQUEST["image1_height_l"]);	
	
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/contents_data/".$maxid."/".$imagefile1["name"])&&$imagefile1["name"]!=NULL) {
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/contents_data/".$maxid."/".$imagefile1["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"s_".$fdata["basename"],$fdata["dirname"]."/",$_REQUEST["image1_width_s"],$_REQUEST["image1_height_s"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/contents_data/".$maxid."/".$imagefile1["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"m_".$fdata["basename"],$fdata["dirname"]."/",$_REQUEST["image1_width_m"],$_REQUEST["image1_height_m"]);
	}
				@chmod($imagefile1["filepath"],0777);
				@chmod(str_replace("image1","s_image1",$imagefile1["filepath"]),0777);
				@chmod(str_replace("image1","m_image1",$imagefile1["filepath"]),0777);
				$_REQUEST["image1_s"]=str_replace("image1","s_image1",$imagefile1["filepath"]);
				$_REQUEST["image1_m"]=str_replace("image1","m_image1",$imagefile1["filepath"]);
				$_REQUEST["image1_l"]=$imagefile1["filepath"];
					}		
			else if($_REQUEST["image1_del"]==1){
				$_REQUEST["image1_s"]="";
				$_REQUEST["image1_m"]="";
				$_REQUEST["image1_l"]="";
			}
			else {
				$_REQUEST["image1_s"]=$_REQUEST["image1_old_s"];
				$_REQUEST["image1_m"]=$_REQUEST["image1_old_m"];
				$_REQUEST["image1_l"]=$_REQUEST["image1_old_l"];
			}

	if($_FILES["image2"]["error"]==0) {
	$imgobj=new Upload();
	$imgobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/contents_data/".$maxid."/";
	$imgobj->rpath="/tmp/contents_data/".$maxid."/";
	$imagefile1=$imgobj->UpImgAndResize("image2",$_REQUEST["image2_width_l"],$_REQUEST["image2_height_l"]);	
	
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/contents_data/".$maxid."/".$imagefile1["name"])&&$imagefile1["name"]!=NULL) {
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/contents_data/".$maxid."/".$imagefile1["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"s_".$fdata["basename"],$fdata["dirname"]."/",$_REQUEST["image2_width_s"],$_REQUEST["image2_height_s"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/contents_data/".$maxid."/".$imagefile1["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"m_".$fdata["basename"],$fdata["dirname"]."/",$_REQUEST["image2_width_m"],$_REQUEST["image2_height_m"]);
	}
				@chmod($imagefile1["filepath"],0777);
				@chmod(str_replace("image2","s_image2",$imagefile1["filepath"]),0777);
				@chmod(str_replace("image2","m_image2",$imagefile1["filepath"]),0777);
				$_REQUEST["image2_s"]=str_replace("image2","s_image2",$imagefile1["filepath"]);
				$_REQUEST["image2_m"]=str_replace("image2","m_image2",$imagefile1["filepath"]);
				$_REQUEST["image2_l"]=$imagefile1["filepath"];
					}		
			else if($_REQUEST["image2_del"]==1){
				$_REQUEST["image2_s"]="";
				$_REQUEST["image2_m"]="";
				$_REQUEST["image2_l"]="";
			}
			else {
				$_REQUEST["image2_s"]=$_REQUEST["image2_old_s"];
				$_REQUEST["image2_m"]=$_REQUEST["image2_old_m"];
				$_REQUEST["image2_l"]=$_REQUEST["image2_old_l"];
			}

	if($_FILES["image3"]["error"]==0) {
	$imgobj=new Upload();
	$imgobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/contents_data/".$maxid."/";
	$imgobj->rpath="/tmp/contents_data/".$maxid."/";
	$imagefile1=$imgobj->UpImgAndResize("image3",$_REQUEST["image3_width_l"],$_REQUEST["image3_height_l"]);	
	
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/contents_data/".$maxid."/".$imagefile1["name"])&&$imagefile1["name"]!=NULL) {
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/contents_data/".$maxid."/".$imagefile1["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"s_".$fdata["basename"],$fdata["dirname"]."/",$_REQUEST["image3_width_s"],$_REQUEST["image3_height_s"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/contents_data/".$maxid."/".$imagefile1["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"m_".$fdata["basename"],$fdata["dirname"]."/",$_REQUEST["image3_width_m"],$_REQUEST["image3_height_m"]);
	}
				@chmod($imagefile1["filepath"],0777);
				@chmod(str_replace("image3","s_image3",$imagefile1["filepath"]),0777);
				@chmod(str_replace("image3","m_image3",$imagefile1["filepath"]),0777);
				$_REQUEST["image3_s"]=str_replace("image3","s_image3",$imagefile1["filepath"]);
				$_REQUEST["image3_m"]=str_replace("image3","m_image3",$imagefile1["filepath"]);
				$_REQUEST["image3_l"]=$imagefile1["filepath"];
					}		
			else if($_REQUEST["image3_del"]==1){
				$_REQUEST["image3_s"]="";
				$_REQUEST["image3_m"]="";
				$_REQUEST["image3_l"]="";
			}
			else {
				$_REQUEST["image3_s"]=$_REQUEST["image3_old_s"];
				$_REQUEST["image3_m"]=$_REQUEST["image3_old_m"];
				$_REQUEST["image3_l"]=$_REQUEST["image3_old_l"];
			}

if($_FILES["image4"]["error"]==0) {
	$imgobj=new Upload();
	$imgobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/contents_data/".$maxid."/";
	$imgobj->rpath="/tmp/contents_data/".$maxid."/";
	$imagefile1=$imgobj->UpImgAndResize("image4",$_REQUEST["image4_width_l"],$_REQUEST["image4_height_l"]);	
	
if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/contents_data/".$maxid."/".$imagefile1["name"])&&$imagefile1["name"]!=NULL) {
	$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/contents_data/".$maxid."/".$imagefile1["name"]));
	ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"s_".$fdata["basename"],$fdata["dirname"]."/",$_REQUEST["image4_width_s"],$_REQUEST["image4_height_s"]);
	$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/contents_data/".$maxid."/".$imagefile1["name"]));
	ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"m_".$fdata["basename"],$fdata["dirname"]."/",$_REQUEST["image4_width_m"],$_REQUEST["image4_height_m"]);
}
	@chmod($imagefile1["filepath"],0777);
	@chmod(str_replace("image4","s_image4",$imagefile1["filepath"]),0777);
	@chmod(str_replace("image4","m_image4",$imagefile1["filepath"]),0777);
	$_REQUEST["image4_s"]=str_replace("image4","s_image4",$imagefile1["filepath"]);
	$_REQUEST["image4_m"]=str_replace("image4","m_image4",$imagefile1["filepath"]);
	$_REQUEST["image4_l"]=$imagefile1["filepath"];
}		
else if($_REQUEST["image4_del"]==1){
	$_REQUEST["image4_s"]="";
	$_REQUEST["image4_m"]="";
	$_REQUEST["image4_l"]="";
}
else {
	$_REQUEST["image4_s"]=$_REQUEST["image4_old_s"];
	$_REQUEST["image4_m"]=$_REQUEST["image4_old_m"];
	$_REQUEST["image4_l"]=$_REQUEST["image4_old_l"];
}
if($_FILES["image5"]["error"]==0) {
	$imgobj=new Upload();
	$imgobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/contents_data/".$maxid."/";
	$imgobj->rpath="/tmp/contents_data/".$maxid."/";
	$imagefile1=$imgobj->UpImgAndResize("image5",$_REQUEST["image5_width_l"],$_REQUEST["image5_height_l"]);	
	
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/contents_data/".$maxid."/".$imagefile1["name"])&&$imagefile1["name"]!=NULL) {
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/contents_data/".$maxid."/".$imagefile1["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"s_".$fdata["basename"],$fdata["dirname"]."/",$_REQUEST["image5_width_s"],$_REQUEST["image5_height_s"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/contents_data/".$maxid."/".$imagefile1["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"m_".$fdata["basename"],$fdata["dirname"]."/",$_REQUEST["image5_width_m"],$_REQUEST["image5_height_m"]);
	}
	@chmod($imagefile1["filepath"],0777);
	@chmod(str_replace("image5","s_image5",$imagefile1["filepath"]),0777);
	@chmod(str_replace("image5","m_image5",$imagefile1["filepath"]),0777);
	$_REQUEST["image5_s"]=str_replace("image5","s_image5",$imagefile1["filepath"]);
	$_REQUEST["image5_m"]=str_replace("image5","m_image5",$imagefile1["filepath"]);
	$_REQUEST["image5_l"]=$imagefile1["filepath"];
}		
else if($_REQUEST["image5_del"]==1){
	$_REQUEST["image5_s"]="";
	$_REQUEST["image5_m"]="";
	$_REQUEST["image5_l"]="";
}
else {
	$_REQUEST["image5_s"]=$_REQUEST["image5_old_s"];
	$_REQUEST["image5_m"]=$_REQUEST["image5_old_m"];
	$_REQUEST["image5_l"]=$_REQUEST["image5_old_l"];
}


$dbobj->Query("insert into contents_data(data_id,cate_id,name) ".
														" values (".$maxid.",".$_REQUEST["cate_id"].",'".$_REQUEST["name"]."')");
$_REQUEST["data_id"]=$maxid;


$insql="update contents_data set ".
"name ='".$_REQUEST["name"]."',".     
"title1='".$_REQUEST["title1"]."',".     
"title2 ='".$_REQUEST["title2"]."',".     
"title3 ='".$_REQUEST["title3"]."',".     
"title4 ='".$_REQUEST["title4"]."',".     
"title5 ='".$_REQUEST["title5"]."',".     
"image1_s ='".$_REQUEST["image1_s"]."',".     
"image1_m ='".$_REQUEST["image1_m"]."',".     
"image1_l ='".$_REQUEST["image1_l"]."',".     
"image2_s ='".$_REQUEST["image2_s"]."',".     
"image2_m ='".$_REQUEST["image2_m"]."',".     
"image2_l ='".$_REQUEST["image2_l"]."',".     
"image3_s ='".$_REQUEST["image3_s"]."',".     
"image3_m ='".$_REQUEST["image3_m"]."',".     
"image3_l ='".$_REQUEST["image3_l"]."',".     
"image4_s ='".$_REQUEST["image4_s"]."',".     
"image4_m ='".$_REQUEST["image4_m"]."',".     
"image4_l='".$_REQUEST["image4_l"]."',".
"image5_s ='".$_REQUEST["image5_s"]."',".     
"image5_m='".$_REQUEST["image5_m"]."',".     
"image5_l='".$_REQUEST["image5_l"]."',".     
"comm1='".$_REQUEST["comm1"]."',".
"comm2='".$_REQUEST["comm2"]."',".
"comm3='".$_REQUEST["comm3"]."',".
"comm4='".$_REQUEST["comm4"]."',".
"comm5 ='".$_REQUEST["comm5"]."',".  
"designtype='".$_REQUEST["pattern"]."',".   
"turn='".$maxturn."',".
"view_chk='".$_REQUEST["view_chk"]."' ".
" where  data_id = ".$_REQUEST["data_id"];

$dbobj->Query($insql);

switch($_REQUEST["pattern"]){
case "DesignA":

/*
$catesettinglist[0]["set_id"]=1;
$catesettinglist[0]["c_use"]=1;
$catesettinglist[0]["c_type"]="コメント2";
$catesettinglist[0]["c_name"]="タイトル2";

$catesettinglist[1]["set_id"]=2;
$catesettinglist[1]["c_use"]=1;
$catesettinglist[1]["c_type"]="画像1";
$catesettinglist[1]["c_name"]="写真";
$catesettinglist[1]["c_width_s"]="150";
$catesettinglist[1]["c_height_s"]="";
$catesettinglist[1]["c_width_m"]="250";
$catesettinglist[1]["c_height_m"]="";
$catesettinglist[1]["c_width_l"]="0";
$catesettinglist[1]["c_height_l"]="0";

$catesettinglist[2]["set_id"]=3;
$catesettinglist[2]["c_use"]=1;
$catesettinglist[2]["c_type"]="画像2";
$catesettinglist[2]["c_name"]="写真２";
$catesettinglist[2]["c_width_s"]="150";
$catesettinglist[2]["c_height_s"]="";
$catesettinglist[2]["c_width_m"]="250";
$catesettinglist[2]["c_height_m"]="";
$catesettinglist[2]["c_width_l"]="0";
$catesettinglist[2]["c_height_l"]="0";

$catesettinglist[3]["set_id"]=5;
$catesettinglist[3]["c_use"]=1;
$catesettinglist[3]["c_type"]="コメント1";
$catesettinglist[3]["c_name"]="コメント";

$catesettinglist[4]["set_id"]=4;
$catesettinglist[4]["c_use"]=1;
$catesettinglist[4]["c_type"]="テキスト1";
$catesettinglist[4]["c_name"]="メーカー詳細ページ";

*/

		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'コメント2','タイトル2',null,null,null,null,null,null,1,1,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'画像1','画像1',150,null,250,null,0,0,1,2,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'画像2','画像2',150,null,250,null,0,0,1,3,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'コメント1','コメント',null,null,null,null,null,null,1,4,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'テキスト1','メーカー詳細ページ',null,null,null,null,null,null,1,5,".$_REQUEST["cate_id"].")");	
		
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'テキスト2','テキスト2',null,null,null,null,null,null,null,99,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'テキスト3','テキスト3',null,null,null,null,null,null,null,99,".$_REQUEST["cate_id"].")");		
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'テキスト4','テキスト4',null,null,null,null,null,null,null,99,".$_REQUEST["cate_id"].")");	
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'テキスト5','テキスト5',null,null,null,null,null,null,null,99,".$_REQUEST["cate_id"].")");		
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'コメント3','コメント3',null,null,null,null,null,null,null,99,".$_REQUEST["cate_id"].")");	
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'コメント4','コメント4',null,null,null,null,null,null,null,99,".$_REQUEST["cate_id"].")");		
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'コメント5','コメント5',null,null,null,null,null,null,null,99,".$_REQUEST["cate_id"].")");
		
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'画像3','画像3',120,85,620,433,1024,721,null,99,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'画像4','画像4',120,85,620,433,1024,721,null,99,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'画像5','画像5',120,85,620,433,1024,721,null,99,".$_REQUEST["cate_id"].")");
		
	break;
case "DesignB":

		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'コメント2','タイトル2',null,null,null,null,null,null,1,1,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'画像1','画像1',150,null,250,null,0,0,1,2,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'画像2','画像2',150,null,250,null,0,0,1,3,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'コメント1','コメント',null,null,null,null,null,null,1,4,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'テキスト1','メーカー詳細ページ',null,null,null,null,null,null,1,5,".$_REQUEST["cate_id"].")");	

		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'テキスト2','テキスト2',null,null,null,null,null,null,null,99,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'テキスト3','テキスト3',null,null,null,null,null,null,null,99,".$_REQUEST["cate_id"].")");		
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'テキスト4','テキスト4',null,null,null,null,null,null,null,99,".$_REQUEST["cate_id"].")");	
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'テキスト5','テキスト5',null,null,null,null,null,null,null,99,".$_REQUEST["cate_id"].")");		
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'コメント3','コメント3',null,null,null,null,null,null,null,99,".$_REQUEST["cate_id"].")");	
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'コメント4','コメント4',null,null,null,null,null,null,null,99,".$_REQUEST["cate_id"].")");		
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'コメント5','コメント5',null,null,null,null,null,null,null,99,".$_REQUEST["cate_id"].")");
		
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'画像3','画像3',120,85,620,433,1024,721,null,99,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'画像4','画像4',120,85,620,433,1024,721,null,99,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'画像5','画像5',120,85,620,433,1024,721,null,99,".$_REQUEST["cate_id"].")");


	break;
case "DesignC":

		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'テキスト1','テキスト1',null,null,null,null,null,null,null,1,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'テキスト2','テキスト2',null,null,null,null,null,null,null,2,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'テキスト3','テキスト3',null,null,null,null,null,null,null,3,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'テキスト4','テキスト4',null,null,null,null,null,null,null,4,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'テキスト5','テキスト5',null,null,null,null,null,null,null,5,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'コメント1','コメント1',null,null,null,null,null,null,1,6,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'コメント2','コメント2',null,null,null,null,null,null,null,7,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'コメント3','コメント3',null,null,null,null,null,null,null,8,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'コメント4','コメント4',null,null,null,null,null,null,null,9,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'コメント5','コメント5',null,null,null,null,null,null,null,10,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'画像1','画像1',250,178,610,429,610,429,1,11,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'画像2','画像2',250,178,250,178,250,178,null,12,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'画像3','画像3',120,85,620,433,1024,721,null,13,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'画像4','画像4',120,85,620,433,1024,721,null,14,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
									" values (".$maxid.",'画像5','画像5',120,85,620,433,1024,721,null,15,".$_REQUEST["cate_id"].")");
		
break;
case "DesignD":

		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'テキスト1','テキスト1',null,null,null,null,null,null,null,1,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'テキスト2','テキスト2',null,null,null,null,null,null,null,2,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'テキスト3','テキスト3',null,null,null,null,null,null,null,3,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'テキスト4','テキスト4',null,null,null,null,null,null,null,4,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'テキスト5','テキスト5',null,null,null,null,null,null,null,5,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'コメント1','コメント1',null,null,null,null,null,null,1,6,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'コメント2','コメント2',null,null,null,null,null,null,null,7,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'コメント3','コメント3',null,null,null,null,null,null,null,8,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'コメント4','コメント4',null,null,null,null,null,null,null,9,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'コメント5','コメント5',null,null,null,null,null,null,null,10,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'画像1','画像1',250,178,250,178,250,178,null,11,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'画像2','画像2',250,178,250,178,250,178,null,12,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'画像3','画像3',120,85,620,433,1024,721,null,13,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
																" values (".$maxid.",'画像4','画像4',120,85,620,433,1024,721,null,14,".$_REQUEST["cate_id"].")");
		$dbobj->Query("insert into contents_data_set(data_id,c_type,c_name,c_width_s,c_height_s,c_width_m,c_height_m,c_width_l,c_height_l,c_use,c_turn,cate_id) ".
									" values (".$maxid.",'画像5','画像5',120,85,620,433,1024,721,null,15,".$_REQUEST["cate_id"].")");
		
break;
}
?>
<script language="javascript">
location.replace("?PID=plist&cate_id=<?php echo $_REQUEST["cate_id"];?>&pattern=plist");
</script>
<?php

}
$catedata=$ad_contents->getCateData($_REQUEST["cate_id"]);


//$catemydata=$ad_contents->getDetailsData($_REQUEST["cate_id"]);
//$catesettinglist=$ad_contents->getDataSetting($_REQUEST["cate_id"]);
?>
<script type="text/javascript" src="/fckeditor/fckeditor.js"></script>
<script language="javascript">
function datachk() {

if(document.form1.name.value==""){
alert("コンテンツ名は必ず入力してください。");
}
else {
	res=confirm("この内容で登録してもよろしいですか?");
	
	if(res) {
	document.form1.pmodes.value="regist";
		document.form1.submit();
	}
	}
}
</script>
<?php
	$infocatedata=$dbobj->GetData("select * from info1_cate where cate_id = ".$_REQUEST["cate_id"]);
	$infocatetitledata=$dbobj->GetData("select * from menu_data where data_code = 'contents' and data_comm='".$infocatedata["parents_id"]."'");

?>
<?php
																		
																		if($_REQUEST["cate_id"]!=NULL) {
																		$infodata=$dbobj->GetData("select * from info1_data where cate_id =".$_REQUEST["cate_id"]." order by turn");
																		if($infodata["cate_id"]==NULL) {
																			$dbobj->GetData("insert into info1_data (data_id,cate_id,view_chk) values (".$_REQUEST["cate_id"].",".$_REQUEST["cate_id"].",1)");
																		$infodata=$dbobj->GetData("select * from info1_data where cate_id =".$_REQUEST["cate_id"]." order by turn");
																			
																		}
																		}
																		?>

<a name="top" id="top"></a>
<table border="0" align="left" cellpadding="0" cellspacing="0">
		<tr>
				<td colspan="3" valign="top"><table width="700" border="0" align="left">
						<tr>
								<td width="278"><img src="./img/siteadmin/edit_menu.gif" alt="編集中のエリア" width="278" height="18" /></td>
								<td width="412" align="left"><p><strong>　<?php echo $menudata[6]["data_name"]; ?>　&gt;&gt;　詳細データ一覧</strong></p></td>
						</tr>
				</table></td>
		</tr>
		<tr>
				<td valign="top">&nbsp;</td>
				<td width="10" valign="top">&nbsp;</td>
				<td width="500" valign="top">&nbsp;</td>
		</tr>
		<tr>
				<td width="200" valign="top"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCFF">
						<tr>
								<th width="58%" align="left" bgcolor="#ECECFF"><strong>ｶﾃｺﾞﾘ名</strong></th>
								<th width="42%" align="left" valign="top" bgcolor="#ECECFF"> <input type="button" name="Submit" value="カテゴリ管理" onclick="location.href='?PID=info1_category'" /></th>
						</tr>
						<?php
$ad_info1=new Admin_Info1($dbobj);
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　情報１カテゴリ一覧開始　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;*/
$info1catedata=$ad_info1->GetCateList($_GET["info1_id"],$lim,$setnum,$orderby);
for($info1row=0;$info1catedata[$info1row];$info1row++){ 
$info1cate=new Ary_Viewer($info1catedata[$info1row]);
?>
						<tr>
								<td colspan="2" align="left" valign="top" bgcolor="#FFFFFF"><?php
					if($info1catedata[$info1row][0]==5){
					?>
										<a href='index.php?PID=plist&amp;cate_id=<?php echo $info1catedata[$info1row]["cate_id"]; ?>'>
												<?php $info1cate->Moji("cate_name"); ?>
												</a>
										<?php
					}
					else{
						?>
										<a href='index.php?PID=info1_details&amp;cate_id=<?php echo $info1catedata[$info1row]["cate_id"]; ?>'>
												<?php $info1cate->Moji("cate_name"); ?>
												</a>
										<?php
					}
					?>
										<input name="cate_id[<?php echo $info1row; ?>]" type="hidden" id="cate_id[<?php echo $info1row; ?>]" value="<?php echo $info1catedata[$info1row]["cate_id"];?>" /></td>
						</tr>
						<?php 
				}
				/*&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;*/
				/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
				/*　　　　　　　　　情報１カテゴリ一覧終了　　　　　　　　　　*/
				/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
				/****************************************************************/
				?>
				</table></td>
				<td valign="top">&nbsp;</td>
				<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
						<td valign="top"><table border="0" align="left" cellpadding="0" cellspacing="0">
								<tr>
										<td width="640" align="left" valign="top"><table width="640" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
												<tr>
														<td width="640" align="left" valign="middle" bgcolor="#ECECEC"><table width="99%" border="0" cellspacing="0" cellpadding="0">
																<tr>
																		<td width="15">&nbsp;</td>
																		<td width="622"><?php echo $catedata["name"] ?>新規登録</td>
																		</tr>
																</table></td>
														</tr>
												<tr>
														<td align="left" valign="top" background="http://siteadmin.itcube.ne.jp/sm2/hpdata/newbasic/img/main/sideline.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
																<tr>
																		<td align="left" valign="top"><table width="97%" border="0" cellspacing="0" cellpadding="0">
																				<tr>
																						<td class="texttitle_1">&nbsp;</td>
																						</tr>
																				</table>
																				<table width="100%" border="0" align="center">
																						<tr>
																								<td><?php
																																												if($_REQUEST["step"]==2){
																																												?>
																										<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
																												<tr>
																														<th align="left" bgcolor="#ECECEC">タイトル</th>
																														<td align="left" bgcolor="#FFFFFF"><input name="name" type="text" id="name" value="<?php echo $_REQUEST["name"];?>" size="50" /></td>
																														</tr>
																												<?php
									switch($_POST["pattern"]){
										case "DesignA":
										$catesettinglist[0]["set_id"]=1;
										$catesettinglist[0]["c_use"]=1;
										$catesettinglist[0]["c_type"]="コメント2";
										$catesettinglist[0]["c_name"]="タイトル2";
										
										$catesettinglist[1]["set_id"]=2;
										$catesettinglist[1]["c_use"]=1;
										$catesettinglist[1]["c_type"]="画像1";
										$catesettinglist[1]["c_name"]="写真";
										$catesettinglist[1]["c_width_s"]="150";
										$catesettinglist[1]["c_height_s"]="";
										$catesettinglist[1]["c_width_m"]="250";
										$catesettinglist[1]["c_height_m"]="";
										$catesettinglist[1]["c_width_l"]="0";
										$catesettinglist[1]["c_height_l"]="0";
										
										$catesettinglist[2]["set_id"]=3;
										$catesettinglist[2]["c_use"]=1;
										$catesettinglist[2]["c_type"]="画像2";
										$catesettinglist[2]["c_name"]="写真２";
										$catesettinglist[2]["c_width_s"]="150";
										$catesettinglist[2]["c_height_s"]="";
										$catesettinglist[2]["c_width_m"]="250";
										$catesettinglist[2]["c_height_m"]="";
										$catesettinglist[2]["c_width_l"]="0";
										$catesettinglist[2]["c_height_l"]="0";
										
										$catesettinglist[3]["set_id"]=5;
										$catesettinglist[3]["c_use"]=1;
										$catesettinglist[3]["c_type"]="コメント1";
										$catesettinglist[3]["c_name"]="コメント";
										
										$catesettinglist[4]["set_id"]=4;
										$catesettinglist[4]["c_use"]=1;
										$catesettinglist[4]["c_type"]="テキスト1";
										$catesettinglist[4]["c_name"]="メーカー詳細ページ";
										
										

										break;
										case "DesignB":
										
										$catesettinglist[0]["set_id"]=1;
										$catesettinglist[0]["c_use"]=1;
										$catesettinglist[0]["c_type"]="コメント2";
										$catesettinglist[0]["c_name"]="タイトル2";
										
										$catesettinglist[1]["set_id"]=2;
										$catesettinglist[1]["c_use"]=1;
										$catesettinglist[1]["c_type"]="画像1";
										$catesettinglist[1]["c_name"]="写真";
										$catesettinglist[1]["c_width_s"]="150";
										$catesettinglist[1]["c_height_s"]="";
										$catesettinglist[1]["c_width_m"]="250";
										$catesettinglist[1]["c_height_m"]="";
										$catesettinglist[1]["c_width_l"]="0";
										$catesettinglist[1]["c_height_l"]="0";
										
										$catesettinglist[2]["set_id"]=3;
										$catesettinglist[2]["c_use"]=1;
										$catesettinglist[2]["c_type"]="画像2";
										$catesettinglist[2]["c_name"]="写真２";
										$catesettinglist[2]["c_width_s"]="150";
										$catesettinglist[2]["c_height_s"]="";
										$catesettinglist[2]["c_width_m"]="250";
										$catesettinglist[2]["c_height_m"]="";
										$catesettinglist[2]["c_width_l"]="0";
										$catesettinglist[2]["c_height_l"]="0";
										
										$catesettinglist[4]["set_id"]=4;
										$catesettinglist[4]["c_use"]=1;
										$catesettinglist[4]["c_type"]="テキスト1";
										$catesettinglist[4]["c_name"]="メーカー詳細ページ";
										
										$catesettinglist[3]["set_id"]=5;
										$catesettinglist[3]["c_use"]=1;
										$catesettinglist[3]["c_type"]="コメント1";
										$catesettinglist[3]["c_name"]="コメント";

										break;
										case "DesignC":
										
										$catesettinglist[0]["set_id"]=1;
										$catesettinglist[0]["c_use"]=1;
										$catesettinglist[0]["c_type"]="コメント1";
										$catesettinglist[0]["c_name"]="コメント";
										$catesettinglist[1]["set_id"]=2;
										$catesettinglist[1]["c_use"]=1;
										$catesettinglist[1]["c_type"]="画像1";
										$catesettinglist[1]["c_name"]="写真";
										$catesettinglist[1]["c_width_s"]="250";
										$catesettinglist[1]["c_height_s"]="178";
										$catesettinglist[1]["c_width_m"]="517";
										$catesettinglist[1]["c_height_m"]="";
										$catesettinglist[1]["c_width_l"]="0";
										$catesettinglist[1]["c_height_l"]="0";

										break;
										
										case "DesignD":
										$catesettinglist[0]["set_id"]=1;
										$catesettinglist[0]["c_use"]=1;
										$catesettinglist[0]["c_type"]="コメント1";
										$catesettinglist[0]["c_name"]="コメント";
										break;
								}
										
										for($i=0;$catesettinglist[$i]["set_id"]!=NULL;$i++) {
										if($catesettinglist[$i]["c_use"]==1){
										switch($catesettinglist[$i]["c_type"]) {

										case "テキスト1":
										?>
																												<tr>
																														<th width="20%" align="left" bgcolor="#ECECEC"><strong><?php echo $catesettinglist[$i]["c_name"] ?></strong></th>
																														<td width="80%" align="left" bgcolor="#FFFFFF"><input name="title1" type="text" id="title1" value="<?php echo $_REQUEST["title1"];?>" size="50" /></td>
																														</tr>
																												<?php
										break;
										
										?>
																												<?php
										case "テキスト2":
										?>
																												<tr>
																														<th width="20%" align="left" bgcolor="#ECECEC"><strong><?php echo $catesettinglist[$i]["c_name"] ?></strong></th>
																														<td width="80%" align="left" bgcolor="#FFFFFF"><input name="title2" type="text" id="title2"  value="<?php echo $_REQUEST["title2"];?>" size="50" /></td>
																														</tr>
																												<?php
										break;
										
										?>
																												<?php
										case "テキスト3":
										?>
																												<tr>
																														<th width="20%" align="left" bgcolor="#ECECEC"><strong><?php echo $catesettinglist[$i]["c_name"] ?></strong></th>
																														<td width="80%" align="left" bgcolor="#FFFFFF"><input name="title3" type="text" id="title3" value="<?php echo $_REQUEST["title3"];?>" size="50" /></td>
																														</tr>
																												<?php
										break;
										
										?>
																												<?php
										case "テキスト4":
										?>
																												<tr>
																														<th width="20%" align="left" bgcolor="#ECECEC"><strong><?php echo $catesettinglist[$i]["c_name"] ?></strong></th>
																														<td width="80%" align="left" bgcolor="#FFFFFF"><input name="title4" type="text" id="title4"  value="<?php echo $_REQUEST["title4"];?>" size="50" /></td>
																														</tr>
																												<?php
										break;
										
										?>
																												<?php
										case "テキスト5":
										?>
																												<tr>
																														<th width="20%" align="left" bgcolor="#ECECEC"><strong><?php echo $catesettinglist[$i]["c_name"] ?></strong></th>
																														<td width="80%" align="left" bgcolor="#FFFFFF"><input name="title5" type="text" id="title5"  value="<?php echo $_REQUEST["title5"];?>" size="50" /></td>
																														</tr>
																												<?php
										break;
										
										?>
																												<?php
										case "コメント1":
										?>
																												<tr>
																														<th align="left" valign="top" bgcolor="#ECECEC"><strong><?php echo $catesettinglist[$i]["c_name"] ?></strong></th>
																														<td align="left" valign="top" bgcolor="#FFFFFF"><textarea name="comm1" cols="50" id="comm1"><?php echo $_REQUEST["comm1"];?></textarea>
																																<script type="text/javascript">
<!--

    //==================================================================
    // FCK Editor
    
    var oFCKeditor = new FCKeditor( 'comm1' );
    
    oFCKeditor.BasePath = '/fckeditor/';
				<?php
				if($catesettinglist[$i]["c_width"]!=NULL) {
				?>
    oFCKeditor.Width = '<?php echo $catesettinglist[$i]["c_width"] ?>';
    
				<?php
				}
				?><?php
				if($catesettinglist[$i]["c_height"]!=NULL) {
				?>
				oFCKeditor.Height = '<?php echo $catesettinglist[$i]["c_height"] ?>';
    <?php
				}
				?>oFCKeditor.ToolbarSet = 'Mymenu4';
    
    oFCKeditor.ReplaceTextarea();    

// -->

                                                </script></td>
																														</tr>
																												<?php
										break;
										
										?>
																												<?php
										case "コメント2":
										?>
																												<tr>
																														<th align="left" valign="top" bgcolor="#ECECEC"><strong><?php echo $catesettinglist[$i]["c_name"] ?></strong></th>
																														<td align="left" valign="top" bgcolor="#FFFFFF"><textarea name="comm2" cols="50" id="comm2"><?php echo $_REQUEST["comm2"];?></textarea>
																																<script type="text/javascript">
<!--

    //==================================================================
    // FCK Editor
    
    var oFCKeditor2 = new FCKeditor( 'comm2' );
    
    oFCKeditor2.BasePath = '/fckeditor/';
				<?php
				if($catesettinglist[$i]["c_width"]!=NULL) {
				?>
    oFCKeditor2.Width = '<?php echo $catesettinglist[$i]["c_width"] ?>';
    
				<?php
				}
				?><?php
				if($catesettinglist[$i]["c_height"]!=NULL) {
				?>
				oFCKeditor2.Height = '<?php echo $catesettinglist[$i]["c_height"] ?>';
    <?php
				}
				?>oFCKeditor2.ToolbarSet = 'Mymenu4';
    
    oFCKeditor2.ReplaceTextarea();    

// -->

                                                </script></td>
																														</tr>
																												<?php
										break;
										
										?>
																												<?php
										case "コメント3":
										?>
																												<tr>
																														<th align="left" valign="top" bgcolor="#ECECEC"><strong><?php echo $catesettinglist[$i]["c_name"] ?></strong></th>
																														<td align="left" valign="top" bgcolor="#FFFFFF"><textarea name="comm3" cols="50" id="comm3"><?php echo $_REQUEST["comm3"];?></textarea>
																																<script type="text/javascript">
<!--

    //==================================================================
    // FCK Editor
    
    var oFCKeditor3 = new FCKeditor( 'comm3' );
    
    oFCKeditor3.BasePath = '/fckeditor/';
				<?php
				if($catesettinglist[$i]["c_width"]!=NULL) {
				?>
    oFCKeditor3.Width = '<?php echo $catesettinglist[$i]["c_width"] ?>';
    
				<?php
				}
				?><?php
				if($catesettinglist[$i]["c_height"]!=NULL) {
				?>
				oFCKeditor3.Height = '<?php echo $catesettinglist[$i]["c_height"] ?>';
    <?php
				}
				?>oFCKeditor3.ToolbarSet = 'Mymenu4';
    
    oFCKeditor3.ReplaceTextarea();    

// -->

                                                </script></td>
																														</tr>
																												<?php
										break;
										
										?>
																												<?php
										case "コメント4":
										?>
																												<tr>
																														<th align="left" valign="top" bgcolor="#ECECEC"><strong><?php echo $catesettinglist[$i]["c_name"] ?></strong></th>
																														<td align="left" valign="top" bgcolor="#FFFFFF"><textarea name="comm4" cols="50" id="comm4"><?php echo $_REQUEST["comm4"];?></textarea>
																																<script type="text/javascript">
<!--

    //==================================================================
    // FCK Editor
    
    var oFCKeditor4 = new FCKeditor( 'comm4' );
    
    oFCKeditor4.BasePath = '/fckeditor/';
				<?php
				if($catesettinglist[$i]["c_width"]!=NULL) {
				?>
    oFCKeditor4.Width = '<?php echo $catesettinglist[$i]["c_width"] ?>';
    
				<?php
				}
				?><?php
				if($catesettinglist[$i]["c_height"]!=NULL) {
				?>
				oFCKeditor4.Height = '<?php echo $catesettinglist[$i]["c_height"] ?>';
    <?php
				}
				?>oFCKeditor4.ToolbarSet = 'Mymenu4';
    
    oFCKeditor4.ReplaceTextarea();    

// -->

                                                </script></td>
																														</tr>
																												<?php
										break;
										
										?>
																												<?php
										case "コメント5":
										?>
																												<tr>
																														<th align="left" valign="top" bgcolor="#ECECEC"><strong><?php echo $catesettinglist[$i]["c_name"] ?></strong></th>
																														<td align="left" valign="top" bgcolor="#FFFFFF"><textarea name="comm5" cols="50" id="comm5"><?php echo $_REQUEST["comm5"];?></textarea>
																																<script type="text/javascript">
<!--

    //==================================================================
    // FCK Editor
    
    var oFCKeditor5 = new FCKeditor( 'comm5' );
    
    oFCKeditor5.BasePath = '/fckeditor/';
				<?php
				if($catesettinglist[$i]["c_width"]!=NULL) {
				?>
    oFCKeditor5.Width = '<?php echo $catesettinglist[$i]["c_width"] ?>';
    
				<?php
				}
				?><?php
				if($catesettinglist[$i]["c_height"]!=NULL) {
				?>
				oFCKeditor5.Height = '<?php echo $catesettinglist[$i]["c_height"] ?>';
    <?php
				}
				?>oFCKeditor5.ToolbarSet = 'Mymenu4';
    
    oFCKeditor5.ReplaceTextarea();    

// -->

                                                </script></td>
																														</tr>
																												<?php
										break;
										
										?>
																												<?php
										case "画像1":
										?>
																												<tr>
																														<th align="left" valign="top" bgcolor="#ECECEC"><strong><?php echo $catesettinglist[$i]["c_name"] ?></strong></th>
																														<td align="left" valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
																																<?php if($catemydata["image1_s"]!=NULL){?>
																																<tr>
																																		<td><img src="<?php echo $catemydata["image1_s"]?>" alt="" /><br />
																																				<label>
																																						<input type="checkbox" name="image1_del" value="1" />
																																						この画像を削除する</label></td>
																																		</tr>
																																<?php
																						}
																						?>
																																<tr>
																																		<td><input type="file" name="image1" />
																																				<input name="image1_width_s" type="hidden" id="image1_width_s" value="<?php echo $catesettinglist[$i]["c_width_s"] ?>" />
																																				<input name="image1_height_s" type="hidden" id="image1_height_s" value="<?php echo $catesettinglist[$i]["c_height_s"] ?>" />
																																				<input name="image1_width_m" type="hidden" id="image1_width_m" value="<?php echo $catesettinglist[$i]["c_width_m"] ?>" />
																																				<input name="image1_height_m" type="hidden" id="image1_height_m" value="<?php echo $catesettinglist[$i]["c_height_m"] ?>" />
																																				<input name="image1_width_l" type="hidden" id="image1_width_l" value="<?php echo $catesettinglist[$i]["c_width_l"] ?>" />
																																				<input name="image1_height_l" type="hidden" id="image1_height_l" value="<?php echo $catesettinglist[$i]["c_height_l"] ?>" />
																																				<input name="image1_old_s" type="hidden" id="image1_old_s" value="<?php echo $catemydata["image1_s"] ?>" />
																																				<input name="image1_old_m" type="hidden" id="image1_old_m" value="<?php echo $catemydata["image1_m"] ?>" />
																																				<input name="image1_old_l" type="hidden" id="image1_old_l" value="<?php echo $catemydata["image1_l"] ?>" /></td>
																																		</tr>
																																</table></td>
																														</tr>
																												<?php
										break;
										?>
																												<?php
										case "画像2":
										?>
																												<tr>
																														<th align="left" valign="top" bgcolor="#ECECEC"><strong><?php echo $catesettinglist[$i]["c_name"] ?></strong></th>
																														<td align="left" valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
																																<?php if($catemydata["image2_s"]!=NULL){?>
																																<tr>
																																		<td><img src="<?php echo $catemydata["image2_s"]?>" alt="" /><br />
																																				<label>
																																						<input type="checkbox" name="image2_del" value="1" />
																																						この画像を削除する</label></td>
																																		</tr>
																																<?php
																						}
																						?>
																																<tr>
																																		<td><input type="file" name="image2" />
																																				<input name="image2_width_s" type="hidden" id="image2_width_s" value="<?php echo $catesettinglist[$i]["c_width_s"] ?>" />
																																				<input name="image2_height_s" type="hidden" id="image2_height_s" value="<?php echo $catesettinglist[$i]["c_height_s"] ?>" />
																																				<input name="image2_width_m" type="hidden" id="image2_width_m" value="<?php echo $catesettinglist[$i]["c_width_m"] ?>" />
																																				<input name="image2_height_m" type="hidden" id="image2_height_m" value="<?php echo $catesettinglist[$i]["c_height_m"] ?>" />
																																				<input name="image2_width_l" type="hidden" id="image2_width_l" value="<?php echo $catesettinglist[$i]["c_width_l"] ?>" />
																																				<input name="image2_height_l" type="hidden" id="image2_height_l" value="<?php echo $catesettinglist[$i]["c_height_l"] ?>" />
																																				<input name="image2_old_s" type="hidden" id="image2_old_s" value="<?php echo $catemydata["image2_s"] ?>" />
																																				<input name="image2_old_m" type="hidden" id="image2_old_m" value="<?php echo $catemydata["image2_m"] ?>" />
																																				<input name="image2_old_l" type="hidden" id="image2_old_l" value="<?php echo $catemydata["image2_l"] ?>" /></td>
																																		</tr>
																																</table></td>
																														</tr>
																												<?php
										break;
										?>
																												<?php
										case "画像3":
										?>
																												<tr>
																														<th align="left" valign="top" bgcolor="#ECECEC"><strong><?php echo $catesettinglist[$i]["c_name"] ?></strong></th>
																														<td align="left" valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
																																<?php if($catemydata["image3_s"]!=NULL){?>
																																<tr>
																																		<td><img src="<?php echo $catemydata["image3_s"]?>" alt="" /><br />
																																				<label>
																																						<input type="checkbox" name="image3_del" value="1" />
																																						この画像を削除する</label></td>
																																		</tr>
																																<?php
																						}
																						?>
																																<tr>
																																		<td><input type="file" name="image3" />
																																				<input name="image3_width_s" type="hidden" id="image3_width_s" value="<?php echo $catesettinglist[$i]["c_width_s"] ?>" />
																																				<input name="image3_height_s" type="hidden" id="image3_height_s" value="<?php echo $catesettinglist[$i]["c_height_s"] ?>" />
																																				<input name="image3_width_m" type="hidden" id="image3_width_m" value="<?php echo $catesettinglist[$i]["c_width_m"] ?>" />
																																				<input name="image3_height_m" type="hidden" id="image3_height_m" value="<?php echo $catesettinglist[$i]["c_height_m"] ?>" />
																																				<input name="image3_width_l" type="hidden" id="image3_width_l" value="<?php echo $catesettinglist[$i]["c_width_l"] ?>" />
																																				<input name="image3_height_l" type="hidden" id="image3_height_l" value="<?php echo $catesettinglist[$i]["c_height_l"] ?>" />
																																				<input name="image3_old_s" type="hidden" id="image3_old_s" value="<?php echo $catemydata["image3_s"] ?>" />
																																				<input name="image3_old_m" type="hidden" id="image3_old_m" value="<?php echo $catemydata["image3_m"] ?>" />
																																				<input name="image3_old_l" type="hidden" id="image3_old_l" value="<?php echo $catemydata["image3_l"] ?>" /></td>
																																		</tr>
																																</table></td>
																														</tr>
																												<?php
										break;
										?>
																												<?php
										case "画像4":
										?>
																												<tr>
																														<th align="left" valign="top" bgcolor="#ECECEC"><strong><?php echo $catesettinglist[$i]["c_name"] ?></strong></th>
																														<td align="left" valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
																																<?php if($catemydata["image4_s"]!=NULL){?>
																																<tr>
																																		<td><img src="<?php echo $catemydata["image4_s"]?>" alt="" /><br />
																																				<label>
																																						<input type="checkbox" name="image4_del" value="1" />
																																						この画像を削除する</label></td>
																																		</tr>
																																<?php
																						}
																						?>
																																<tr>
																																		<td><input type="file" name="image4" />
																																				<input name="image4_width_s" type="hidden" id="image4_width_s" value="<?php echo $catesettinglist[$i]["c_width_s"] ?>" />
																																				<input name="image4_height_s" type="hidden" id="image4_height_s" value="<?php echo $catesettinglist[$i]["c_height_s"] ?>" />
																																				<input name="image4_width_m" type="hidden" id="image4_width_m" value="<?php echo $catesettinglist[$i]["c_width_m"] ?>" />
																																				<input name="image4_height_m" type="hidden" id="image4_height_m" value="<?php echo $catesettinglist[$i]["c_height_m"] ?>" />
																																				<input name="image4_width_l" type="hidden" id="image4_width_l" value="<?php echo $catesettinglist[$i]["c_width_l"] ?>" />
																																				<input name="image4_height_l" type="hidden" id="image4_height_l" value="<?php echo $catesettinglist[$i]["c_height_l"] ?>" />
																																				<input name="image4_old_s" type="hidden" id="image4_old_s" value="<?php echo $catemydata["image4_s"] ?>" />
																																				<input name="image4_old_m" type="hidden" id="image4_old_m" value="<?php echo $catemydata["image4_m"] ?>" />
																																				<input name="image4_old_l" type="hidden" id="image4_old_l" value="<?php echo $catemydata["image4_l"] ?>" /></td>
																																		</tr>
																																</table></td>
																														</tr>
																												<?php
										break;
										?>
																												<?php
										case "画像5":
										?>
																												<tr>
																														<th align="left" valign="top" bgcolor="#ECECEC"><strong><?php echo $catesettinglist[$i]["c_name"] ?></strong></th>
																														<td align="left" valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
																																<?php if($catemydata["image5_s"]!=NULL){?>
																																<tr>
																																		<td><img src="<?php echo $catemydata["image5_s"]?>" alt="" /><br />
																																				<label>
																																						<input type="checkbox" name="image5_del" value="1" />
																																						この画像を削除する</label></td>
																																		</tr>
																																<?php
																						}
																						?>
																																<tr>
																																		<td><input type="file" name="image5" />
																																				<input name="image5_width_s" type="hidden" id="image5_width_s" value="<?php echo $catesettinglist[$i]["c_width_s"] ?>" />
																																				<input name="image5_height_s" type="hidden" id="image5_height_s" value="<?php echo $catesettinglist[$i]["c_height_s"] ?>" />
																																				<input name="image5_width_m" type="hidden" id="image5_width_m" value="<?php echo $catesettinglist[$i]["c_width_m"] ?>" />
																																				<input name="image5_height_m" type="hidden" id="image5_height_m" value="<?php echo $catesettinglist[$i]["c_height_m"] ?>" />
																																				<input name="image5_width_l" type="hidden" id="image5_width_l" value="<?php echo $catesettinglist[$i]["c_width_l"] ?>" />
																																				<input name="image5_height_l" type="hidden" id="image5_height_l" value="<?php echo $catesettinglist[$i]["c_height_l"] ?>" />
																																				<input name="image5_old_s" type="hidden" id="image5_old_s" value="<?php echo $catemydata["image5_s"] ?>" />
																																				<input name="image5_old_m" type="hidden" id="image5_old_m" value="<?php echo $catemydata["image5_m"] ?>" />
																																				<input name="image5_old_l" type="hidden" id="image5_old_l" value="<?php echo $catemydata["image5_l"] ?>" /></td>
																																		</tr>
																																</table></td>
																														</tr>
																												<?php
										break;
										?>
																												<?php
										}
										}
										}
										?>
																												<tr>
																														<th width="20%" align="left" valign="top" bgcolor="#ECECEC">公開</th>
																														<td align="left" valign="top" bgcolor="#FFFFFF"><select name="view_chk" id="view_chk">
																																<option value="1" selected="selected">公開する</option>
																																<option value="0">公開しない</option>
																																</select></td>
																														</tr>
																												<tr>
																														<td align="left" valign="top" bgcolor="#ECECEC">&nbsp;</td>
																														<td align="left" valign="top" bgcolor="#FFFFFF"><input name="bbtm_regist" type="button" id="bbtm_regist" value="更新する" onclick="datachk()" />
																																<input name="pmodes" type="hidden" id="pmodes" value="" />
																																<input name="cate_id" type="hidden" id="cate_id" value="<?php echo $_REQUEST["cate_id"];?>" />
																																<input name="bbtm_regist" type="submit" id="bbtm_regist" value="もどる" />
																																<input name="cid" type="hidden" id="cid" value="<?php echo $_REQUEST["cid"];?>" />
																																<input name="data_id" type="hidden" id="data_id" value="<?php echo $catemydata["data_id"];?>" />
																																<input name="pattern" type="hidden" id="pattern" value="<?php echo $_REQUEST["pattern"];?>" /></td>
																														</tr>
																												</table>
																										<?php
																																																}
																																																else {
																																																?>
																										<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
																												<tr>
																														<th width="20%" align="left" valign="top" bgcolor="#ECECEC">デザイン選択</th>
																														<td align="left" valign="top" bgcolor="#FFFFFF"><table>
																																<tr>
																																		<td><label>
																																				<input name="pattern" type="radio" value="DesignA"<?php if($_POST["pattern"]=="DesignA"||$_REQUEST["pattern"]==NULL){ echo " checked";}?> id="designa" />
																																				デザインA</label></td>
																																		<td rowspan="2">&nbsp;</td>
																																		<td rowspan="2"><label for="designa"><img src="http://siteadmin.itcube.ne.jp/sm2/img/pattern/designa.jpg" alt="" width="94" height="64" /></label></td>
																																		</tr>
																																<tr>
																																		<td>&nbsp;</td>
																																		</tr>
																																<tr>
																																		<td><label>
																																				<input type="radio" name="pattern" value="DesignB"<?php if($_POST["pattern"]=="DesignB"){ echo " checked";}?> id="designb" />
																																				</label>
																																				デザインB </td>
																																		<td rowspan="2">&nbsp;</td>
																																		<td rowspan="2"><label for="designb"><img src="http://siteadmin.itcube.ne.jp/sm2/img/pattern/designb.jpg" alt="" width="94" height="64" /></label></td>
																																		</tr>
																																<tr>
																																		<td>&nbsp;</td>
																																		</tr>
																																<tr>
																																		<td><label>
																																				<input name="pattern" type="radio" value="DesignC"<?php if($_POST["pattern"]=="DesignC"){ echo " checked";}?> id="designc" />
																																				デザインC</label></td>
																																		<td rowspan="2">&nbsp;</td>
																																		<td rowspan="2"><label for="designc"><img src="http://siteadmin.itcube.ne.jp/sm2/img/pattern/designc.jpg" alt="" width="94" height="64" /></label></td>
																																		</tr>
																																<tr>
																																		<td>&nbsp;</td>
																																		</tr>
																																<tr>
																																		<td><label>
																																				<input name="pattern" type="radio" value="DesignD"<?php if($_POST["pattern"]=="DesignD"){ echo " checked";}?> id="designd" />
																																				デザインD</label></td>
																																		<td rowspan="2">&nbsp;</td>
																																		<td rowspan="2"><label for="designd"><img src="http://siteadmin.itcube.ne.jp/sm2/img/pattern/designd.jpg" alt="" width="94" height="64" /></label></td>
																																		</tr>
																																<tr>
																																		<td>&nbsp;</td>
																																		</tr>
																																</table></td>
																														</tr>
																												<tr>
																														<td align="left" valign="top" bgcolor="#ECECEC">&nbsp;</td>
																														<td align="left" valign="top" bgcolor="#FFFFFF"><input name="bbtm_regist" type="submit" id="bbtm_regist" value="次へ" />
																																<input name="step" type="hidden" id="step" value="2" />
																																<input name="cate_id" type="hidden" id="cate_id" value="<?php echo $_REQUEST["cate_id"];?>" />
																																<input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onclick="location.replace('?PID=plist&amp;cate_id=<?php echo $_REQUEST["cate_id"];?>&amp;pattern=plist')" />
																																<input name="cid" type="hidden" id="cid" value="<?php echo $_REQUEST["cid"];?>" />
																																<input name="data_id" type="hidden" id="data_id" value="<?php echo $catemydata["data_id"];?>" />
																																<input name="name" type="hidden" id="name" value="<?php echo $_REQUEST["name"];?>" />
																																<input name="title1" type="hidden" id="title1" value="<?php echo $_REQUEST["title1"];?>" />
																																<input name="title2" type="hidden" id="title2" value="<?php echo $_REQUEST["title2"];?>" />
																																<input name="title3" type="hidden" id="title3" value="<?php echo $_REQUEST["title3"];?>" />
																																<input name="title4" type="hidden" id="title4" value="<?php echo $_REQUEST["title4"];?>" />
																																<input name="title5" type="hidden" id="title5" value="<?php echo $_REQUEST["title5"];?>" />
																																<input name="comm1" type="hidden" id="comm1" value="<?php echo $_REQUEST["comm1"];?>" />
																																<input name="comm2" type="hidden" id="comm2" value="<?php echo $_REQUEST["comm2"];?>" />
																																<input name="comm3" type="hidden" id="comm3" value="<?php echo $_REQUEST["comm3"];?>" />
																																<input name="comm4" type="hidden" id="comm4" value="<?php echo $_REQUEST["comm4"];?>" />
																																<input name="comm5" type="hidden" id="comm5" value="<?php echo $_REQUEST["comm5"];?>" /></td>
																														</tr>
																												</table>
																										<?php
																																																}
																																																?></td>
																								</tr>
																						</table></td>
																		</tr>
																<tr>
																		<td align="center" valign="top"><img src="http://siteadmin.itcube.ne.jp/sm2/hpdata/newbasic/img/sp/7_7.jpg" alt="" width="7" height="7" /></td>
																		</tr>
																</table></td>
														</tr>
										</table></td>
								</tr>
						</table></td>
				</form>
		</tr>
</table>
