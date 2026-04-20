<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<?php
if($_REQUEST["upimg"]=="更新する"){
	

		$imagesize["big"]["w"]="580";
		$imagesize["big"]["h"]="230";
		
		@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/flash_data");
		
		$imgobj=new Upload();
	$imgobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/flash_data/";
	$imgobj->rpath="/tmp/flash_data/";
	$imagefile1=$imgobj->UpImgAndResize("image1",$imagesize["big"]["w"],$imagesize["big"]["h"]);

	if($imagefile1["error"]==0&&$imagefile1["name"]!=""){
	
	 $sql="update contents_data set image1_s='".$imagefile1["filepath"]."',".
		" image1_m='".$imagefile1["filepath"]."',".
		" image1_l='".$imagefile1["filepath"]."' where data_id=0"	;
		$dbobj->Query($sql);
	}
	else if($_REQUEST["image1del"]==1){
				 $sql="update contents_data set image1_s='',".
		" image1_m='',".
		" image1_l='' where data_id=0"	;
		$dbobj->Query($sql);

	}
	
	$imgobj2=new Upload();
	$imgobj2->path=$_SERVER['DOCUMENT_ROOT']."/tmp/flash_data/";
	$imgobj2->rpath="/tmp/flash_data/";
	
	$imagefile2=$imgobj2->UpImgAndResize("image2",$imagesize["big"]["w"],$imagesize["big"]["h"]);



	if($imagefile2["error"]==0&&$imagefile2["name"]!=""){
	
	 $sql="update contents_data set image2_s='".$imagefile2["filepath"]."',".
		" image2_m='".$imagefile2["filepath"]."',".
		" image2_l='".$imagefile2["filepath"]."' where data_id=0"	;
		$dbobj->Query($sql);
	}
	else if($_REQUEST["image2del"]==1){
				 $sql="update contents_data set image2_s='',".
		" image2_m='',".
		" image2_l='' where data_id=0"	;
		$dbobj->Query($sql);

	}

		$imgobj3=new Upload();
	$imgobj3->path=$_SERVER['DOCUMENT_ROOT']."/tmp/flash_data/";
	$imgobj3->rpath="/tmp/flash_data/";
	
	$imagefile3=$imgobj3->UpImgAndResize("image3",$imagesize["big"]["w"],$imagesize["big"]["h"]);



	if($imagefile3["error"]==0&&$imagefile3["name"]!=""){
	
	 $sql="update contents_data set image3_s='".$imagefile3["filepath"]."',".
		" image3_m='".$imagefile3["filepath"]."',".
		" image3_l='".$imagefile3["filepath"]."' where data_id=0"	;
		$dbobj->Query($sql);
	}
	else if($_REQUEST["image3del"]==1){
				 $sql="update contents_data set image3_s='',".
		" image3_m='',".
		" image3_l='' where data_id=0"	;
		$dbobj->Query($sql);

	}

		$imgobj=new Upload();
	$imgobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/flash_data/";
	$imgobj->rpath="/tmp/flash_data/";
	
	$imagefile4=$imgobj->UpImgAndResize("image4",$imagesize["big"]["w"],$imagesize["big"]["h"]);



	if($imagefile4["error"]==0&&$imagefile4["name"]!=""){
	
 	$sql="update contents_data set image4_s='".$imagefile4["filepath"]."',".
		" image4_m='".$imagefile4["filepath"]."',".
		" image4_l='".$imagefile4["filepath"]."' where data_id=0"	;
		$dbobj->Query($sql);
	}	else if($_REQUEST["image4del"]==1){
				 $sql="update contents_data set image4_s='',".
		" image4_m='',".
		" image4_l='' where data_id=0"	;
		$dbobj->Query($sql);
	}


$imgobj=new Upload();
	$imgobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/flash_data/";
	$imgobj->rpath="/tmp/flash_data/";
	
	$imagefile5=$imgobj->UpImgAndResize("image5",$imagesize["big"]["w"],$imagesize["big"]["h"]);



	if($imagefile5["error"]==0&&$imagefile5["name"]!=""){
	
 	$sql="update contents_data set image5_s='".$imagefile5["filepath"]."',".
		" image5_m='".$imagefile5["filepath"]."',".
		" image5_l='".$imagefile5["filepath"]."' where data_id=0"	;
		$dbobj->Query($sql);
	}else if($_REQUEST["image5del"]==1){
				 $sql="update contents_data set image5_s='',".
		" image5_m='',".
		" image5_l='' where data_id=0"	;
		$dbobj->Query($sql);
	}

	
	
	
}
$fladata=$dbobj->GetData("select * from contents_data where data_id =0");


?>
<form action="" method="post" enctype="multipart/form-data" name="form1">
				<table width="600" border="0" cellpadding="2" cellspacing="1">
								<tr>
												<td><strong>TOPページフラッシュ画像変更</strong></td>
								</tr>
								<tr>
												<td>&nbsp;</td>
								</tr>
								<tr>
												<td bgcolor="#FFFFFF">
																<table width="594" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
																				<tr>
																								<td width="100" bgcolor="#ECECEC"><strong>1枚目<br>
																								（580×230）</strong></td>
																								<td width="483" bgcolor="#FFFFFF">
																												<table width="100%" border="0" cellpadding="2" cellspacing="1">
																																<?php
																								if($fladata["image1_m"]!=""){
																								?>
																																<tr>
																																				<td><img src="<?php echo $fladata["image1_m"];?>?<?php echo time();?>" width="290" height="115"><br>
																																												<br>
																																												<label>
																																																<input type="checkbox" name="image1del" value="1">
																																																この画像を削除する</label>
																																				</td>
																																</tr>
																																<?php
																												}
																												?>
																																<tr>
																																				<td width="434">
																																								<input name="image1" type="file" id="image1">
																																				</td>
																																</tr>
																												</table>
																								</td>
																				</tr>
																				<tr>
																								<td bgcolor="#ECECEC"><strong>2枚目<br>
																								（580×230）</strong></td>
																								<td bgcolor="#FFFFFF">
																												<table width="100%" border="0" cellpadding="2" cellspacing="1">
																															<?php
																								if($fladata["image2_m"]!=""){
																								?>
																																<tr>
																																				<td><img src="<?php echo $fladata["image2_m"];?>?<?php echo time();?>" width="290" height="115"><br>
																																												<br>
																																												<label>
																																																<input type="checkbox" name="image2del" value="1">
																																																この画像を削除する</label>
																																				</td>
																																</tr>
																																<?php
																												}
																												?>
																																<tr>
																																				<td width="434">
																																								<input name="image2" type="file" id="image2">
																																				</td>
																																</tr>
																												</table>
																								</td>
																				</tr>
																				<tr>
																								<td bgcolor="#ECECEC"><strong>3枚目<br>
																								（580×230）</strong></td>
																								<td bgcolor="#FFFFFF">
																												<table width="100%" border="0" cellpadding="2" cellspacing="1">
																															<?php
																								if($fladata["image3_m"]!=""){
																								?>
																																<tr>
																																				<td><img src="<?php echo $fladata["image3_m"];?>?<?php echo time();?>" width="290" height="115"><br>
																																												<br>
																																												<label>
																																																<input type="checkbox" name="image3del" value="1">
																																																この画像を削除する</label>
																																				</td>
																																</tr>
																																<?php
																												}
																												?>
																																<tr>
																																				<td width="434">
																																								<input name="image3" type="file" id="image3">
																																				</td>
																																</tr>
																												</table>
																								</td>
																				</tr>
																				<tr>
																								<td bgcolor="#ECECEC"><strong>4枚目<br>
																								（580×230）</strong></td>
																								<td bgcolor="#FFFFFF">
																												<table width="100%" border="0" cellpadding="2" cellspacing="1">
																														<?php
																								if($fladata["image4_m"]!=""){
																								?>
																																<tr>
																																				<td><img src="<?php echo $fladata["image4_m"];?>?<?php echo time();?>" width="290" height="115"><br>
																																												<br>
																																												<label>
																																																<input type="checkbox" name="image4del" value="1">
																																																この画像を削除する</label>
																																				</td>
																																</tr>
																																<?php
																												}
																												?>
																																<tr>
																																				<td width="434">
																																								<input name="image4" type="file" id="image4">
																																				</td>
																																</tr>
																												</table>
																								</td>
																				</tr>
																				<tr>
																								<td bgcolor="#ECECEC"><strong>5枚目<br>
																								（580×230）</strong></td>
																								<td bgcolor="#FFFFFF">
																												<table width="100%" border="0" cellpadding="2" cellspacing="1">
																															<?php
																								if($fladata["image5_m"]!=""){
																								?>
																																<tr>
																																				<td><img src="<?php echo $fladata["image5_m"];?>?<?php echo time();?>" width="290" height="115"><br>
																																												<br>
																																												<label>
																																																<input type="checkbox" name="image5del" value="1">
																																																この画像を削除する</label>
																																				</td>
																																</tr>
																																<?php
																												}
																												?>
																																<tr>
																																				<td width="434">
																																								<input name="image5" type="file" id="image5">
																																				</td>
																																</tr>
																												</table>
																								</td>
																				</tr>
																</table>
												</td>
								</tr>
								<tr>
												<td bgcolor="#FFFFFF">&nbsp;</td>
								</tr>
								<tr>
												<td bgcolor="#FFFFFF">
																<table width="594" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
																				<tr>
																								<td width="100" bgcolor="#ECECEC">&nbsp;</td>
																								<td width="483" bgcolor="#FFFFFF">
																												<input name="upimg" type="submit" id="upimg" value="更新する">
																								</td>
																				</tr>
																</table>
												</td>
								</tr>
				</table>
</form>
