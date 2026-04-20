<?php
	$tenpodata=$dbobj->GetData("select * from tenpo_data");
	$newsobj=new Site_News($dbobj);
	$nblim=4;											
	$tenpodata=$dbobj->GetData("select * from tenpo_data");
	
	if($_REQUEST["cate_id"]!=NULL) {
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<style type="text/css">
<!--
body {
	background-color:white;
	margin:0px;
	padding:0px;
}
-->
</style>
<link href="/afiss.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
a:link {
	color:#0000CC;
}
a:visited {
	color:#000099;
}
a:hover {
	color: #0066FF;
}
a:active {
	color: #000099;
}
.style5 {color: #666666}
-->
</style>
<script type="text/javascript" src="/fckeditor/fckeditor.js"></script>

<script language="javascript">
function datachk() {
	res=confirm("この内容で更新してもよろしいですか?");
	
	if(res) {
		document.update_form.submit();
	}
}
</script>
<?php 
if($_REQUEST["pmode"]=="update") {

class Admin_MyInfo1 extends Admin_Info1{
	
	function UpdateOneData($data) {
		$db=$this->dbobj;
		$bname=$this->bname;
			
			if($data["maker_price"]==NULL){
				$data["maker_price"]=0;
			}
			
			if($data["price"]==NULL){
				$data["price"]=0;
			}
		@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/");
		@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data");
		@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$data["data_id"]);
		@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/",0755);
		@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data",0755);
		@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$data["data_id"],0755);
		$setdata=$this->LoadSet();
			$setdata["detailsimg_w"]=250;
			$setdata["detailsimg_h"]=178;
			$setdata["detailsimg2_w"]=250;
			$setdata["detailsimg2_h"]=178;
		$imgobj=new Upload();
		
		$imgobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$data["data_id"]."/";
		$imgobj->rpath="/tmp/".$bname."_data/".$data["data_id"]."/";
		$imagefile=$imgobj->UpImgAndResize2("imagefile",$setdata["detailsimg_w"],$setdata["detailsimg_h"]);	
		
		$imgobj2=new Upload();
		$imgobj2->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$data["data_id"]."/";
		$imgobj2->rpath="/tmp/".$bname."_data/".$data["data_id"]."/";
		$imagefile2=$imgobj2->UpImgAndResize2("imagefile2",$setdata["detailsimg2_w"],$setdata["detailsimg2_h"]);	

		$imgobj3=new Upload();
		$imgobj3->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$data["data_id"]."/";
		$imgobj3->rpath="/tmp/".$bname."_data/".$data["data_id"]."/";
		$imagefile3=$imgobj3->UpImgAndResize("imagefile3",$setdata["detailsimg3_w"],$setdata["detailsimg3_h"]);	

		$imgobj0=new Upload();
		$imgobj0->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$data["data_id"]."/";
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
		$field[]="data_head_image";
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
		$tdata[]="'".$data["data_head_image"]."'";

		if($data["url"]!=NULL&&$data["url"]!="") {
			$field[]="url";
			$tdata[]="'".$data["url"]."'";
		}
		
		if($imagefile["filepath"]!=NULL) {
			$field[]="data_image";
			$tdata[]="'".$imagefile["filepath"]."'";
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

		if($imagefile2["filepath"]!=NULL) {
			$field[]="data_image2";
			$tdata[]="'".$imagefile2["filepath"]."'";
			@chmod($imagefile2["filepath"],0777);
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
			$field[]="data_image3";
			$tdata[]="'".$imagefile3["filepath"]."'";
			@chmod($imagefile3["filepath"],0777);
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
			$field[]="maker_logo";
			$tdata[]="'".$imagefile0["filepath"]."'";
			@chmod($imagefile0["filepath"],0777);
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
}
$ad_contents=new Admin_MyInfo1($dbobj);
$contentssetting=$ad_contents->LoadSetting();
$ad_contents->UpdateOneData($_POST);
$dbobj->Query("update info1_data set options ='".date("Y.m.d")."' where data_id = ".$_REQUEST["data_id"]);
$contentsdata=$ad_contents->GetDetailsData($_GET["data_id"]);
$contentscdata=$ad_contents->GetDetailsCate($contentsdata["cate_id"]);
?>
<?php
}
?><script type="text/javascript">
<!--

function on_load() {
    //==================================================================
    // FCK Editor
    
    var oFCKeditor = new FCKeditor( 'data_comm' );
    
    oFCKeditor.BasePath = '/fckeditor/';
    oFCKeditor.Width = '500';
    oFCKeditor.Height = '600';
    oFCKeditor.ToolbarSet = 'Mymenu4';
    
    oFCKeditor.ReplaceTextarea();
    
				var oFCKeditorheaderimage = new FCKeditor( 'data_head_image' );
    
    oFCKeditorheaderimage.BasePath = '/fckeditor/';
    oFCKeditorheaderimage.Width = '500';
    oFCKeditorheaderimage.Height = '400';
    oFCKeditorheaderimage.ToolbarSet = 'Mymenu4';
    oFCKeditorheaderimage.ReplaceTextarea();
}

// -->

</script>
<?php
	$infocatedata=$dbobj->GetData("select * from info1_cate where cate_id = ".$_REQUEST["cate_id"]);
	$infocatetitledata=$dbobj->GetData("select * from menu_data where data_code = 'contents' and data_comm='".$infocatedata["parents_id"]."'");
	if($_REQUEST["cate_id"]!=NULL) {
		$infodata=$dbobj->GetData("select * from info1_data where cate_id =".$_REQUEST["cate_id"]." order by turn");
		if($infodata["cate_id"]==NULL) {
			$dbobj->GetData("insert into info1_data (data_id,cate_id,view_chk) values (".$_REQUEST["cate_id"].",".$_REQUEST["cate_id"].",1)");
			$infodata=$dbobj->GetData("select * from info1_data where cate_id =".$_REQUEST["cate_id"]." order by turn");
		}
	}
																		?>
<a name="top" id="top"></a>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="640" height="35" align="left" valign="middle" background="/img/main/title_bg.jpg">
            <table width="99%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="14">&nbsp;</td>
                    <td width="497" class="text2">
                        <p><?php echo $infocatetitledata["data_name"];?></p>
                    </td>
                    <td width="123" class="text1">&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td align="left" valign="top" background="/img/main/sideline.jpg">
            <form action="" method="post" enctype="multipart/form-data" name="update_form" id="update_form">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="2%" align="left" valign="top">&nbsp;</td>
                        <td align="left" valign="top" class="text2">
                            <table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
                                <tr>
                                    <td height="20" valign="top" bgcolor="#ECECEC"><strong>コンテンツ名</strong></td>
                                    <td bgcolor="#FFFFFF"><span class="texttitle_16"><?php echo $infocatedata["cate_name"];?></span></td>
                                </tr>
                                <tr>
                                    <td width="19%" height="20" valign="top" bgcolor="#ECECEC"><strong>ヘッダーテキスト</strong></td>
                                    <td width="81%" bgcolor="#FFFFFF">
                                        <textarea name="data_head_image" id="data_header_image"><?php echo $infodata["data_head_image"] ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="20" valign="top" bgcolor="#ECECEC"><strong>タイトル</strong></td>
                                    <td bgcolor="#FFFFFF">
                                        <input name="data_name" type="text" id="data_name" size="60" value="<?php echo $infodata["data_name"];?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td height="20" valign="top" bgcolor="#ECECEC"><strong>イメージ写真1</strong></td>
                                    <td bgcolor="#FFFFFF">
                                        <?php if($infodata["data_image"]!=NULL) { ?>
                                        <img src="<?php echo $infodata["data_image"] ?>"><br>
                                        <label><input name="delimage1" type="checkbox" id="delimage1" value="1">この写真を削除する<br>
                                        </label>
                                        <?php } ?><input name="imagefile" type="file" id="imagefile">
                                    </td>
                                </tr>
                                <tr>
                                    <td height="20" valign="top" bgcolor="#ECECEC"><strong>イメージ写真2</strong></td>
                                    <td bgcolor="#FFFFFF">
                                        
                                        <?php if($infodata["data_image2"]!=NULL) { ?>
                                        <img src="<?php echo $infodata["data_image2"] ?>"><br>
                                        <label>
                                        <input name="delimage2" type="checkbox" id="delimage2" value="1">
                                        この写真を削除する<br>
                                        </label>
                                        <?php } ?>
                                        <input name="imagefile2" type="file" id="imagefile2">
                                    </td>
                                </tr>
                                <tr>
                                    <td height="20" valign="top" bgcolor="#ECECEC"><strong>コメント</strong></td>
                                    <td bgcolor="#FFFFFF">
                                        <textarea name="data_comm"><?php echo $infodata["data_comm"] ?></textarea>
                                        <input name="data_id" type="hidden" id="data_id" value="<?php echo $_REQUEST["cate_id"];?>">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">&nbsp;</td>
                        <td align="center" valign="top">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">&nbsp;</td>
                        <td align="center" valign="top">
                            <div align="left">
                                <select name="view_chk" id="view_chk">
                                    <option value="1"<?php if($infodata["view_chk"]!=0){echo " selected";}?>>公開する</option>
                                    <option value="0"<?php if($infodata["view_chk"]==0){echo " selected";}?> >公開しない</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">&nbsp;</td>
                        <td align="center" valign="top">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">
                            <div align="left"></div>
                        </td>
                        <td align="center" valign="top">
                            <div align="left">
                                <input name="bbtm_regist" type="button" id="bbtm_regist" value="更新する" onClick="datachk()">
                                <input name="pmode" type="hidden" id="pmode" value="update">
                                <input name="data_id" type="hidden" id="data_id" value="<?php echo $infodata["cate_id"];?>">
                                <input name="cate_id" type="hidden" id="cate_id" value="<?php echo $infodata["cate_id"];?>" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="left" valign="top" class="text2">
                            <table width="99%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td>&nbsp;</td>
                                    <td class="text2">&nbsp;</td>
                                </tr>
                                <?php
																																		if($_SERVER['HTTP_HOST']=="re.332049.com") {
																																		?>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td class="text2">下のソースをページの一番上に貼り付けてください。</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td class="text2"><font color="#FF0000">
                                        <?php 
																																						echo htmlspecialchars('<?php');
																																						echo "\n<br>"; 
																																						echo htmlspecialchars('include $_SERVER["DOCUMENT_ROOT"]."/config/config.php";');
																																						echo "\n<br>"; 
																																						echo htmlspecialchars('																																						?>');
?>
                                    </font></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td class="text2">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td class="text2">
                                        <p>下のソースを表示したい場所に貼り付けてください。</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td class="text2">
                                        <pre><font color="#0000FF"><?php 
																																						echo htmlspecialchars('<?php');
																																						
																																												echo "\n<br>";
																																echo htmlspecialchars('$'.'infodata=$'.'dbobj->GetData("select * from info1_data where cate_id ='.$_REQUEST["cate_id"].' order by turn");');
																																						echo "\n<br>";
																																						echo htmlspecialchars('ec'.'ho '.'$'.'infodata'.'["data_comm"];');
																																												echo "\n<br>";
																																						echo htmlspecialchars('?>');?></font></pre>
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td class="text2">&nbsp;</td>
                                </tr>
                                <?php
																																		}
																																		?>
                                <tr>
                                    <td width="14">&nbsp;</td>
                                    <td class="text2">
                                        <p>▲<a href="#top">ページTOP</a></p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </form>
        </td>
    </tr>
    <tr>
        <td align="left" valign="top"><img src="/img/main/title_lower.jpg" width="640" height="12" /></td>
    </tr>
</table>
<?php
}?>