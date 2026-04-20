<?php 
class MyQa_Admin extends Admin_QA{
	function UpdateOneData($data) {
		$db=$this->dbobj;
		$bname=$this->bname;
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
	
	
		$field[]="cate_id";
	$tdata[]="'".$data["cate_id"]."'";

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

}
$ad_qanda=new MyQa_Admin($dbobj);
$qandasetting=$ad_qanda->LoadSetting();
?>

<script language="javascript">
function datachk() {

	res=confirm("この内容で更新してもよろしいですか?");
	
	if(res) {
		document.update_form.submit();
	}
	
}
</script>
<script type="text/javascript" src="/FCK/fckeditor.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<table width="900" border="0" align="left" cellpadding="0" cellspacing="0">
				<tr>
								<td colspan="3" align="left" valign="top">
												<table width="700" border="0" align="left">
																<tr>
																				<td width="278"><img src="./img/siteadmin/edit_menu.gif" alt="編集中のエリア" width="278" height="18" /></td>
																				<td width="412" align="left">
																								<p><strong>　<?php echo $menudata[8]["data_name"]; ?>　&gt;&gt;　詳細データ更新</strong></p>
																				</td>
																</tr>
												</table>
								</td>
				</tr>
				<tr>
								<td width="200" valign="top">
												<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCFF">
																<tr>
																				<th align="left" bgcolor="#ECECFF"><strong>ｶﾃｺﾞﾘ名</strong></th>
																</tr>
																<?php
$qandadata=$dbobj->GetList("select * from qanda_cate where parents_id = ".$_GET["cid"]." order by turn");
for($qandarow=0;$qandadata[$qandarow];$qandarow++){ 
?>
																<tr>
																				<td align="left" valign="top" bgcolor="#FFFFFF"> <a href="index.php?PID=al_qa_details&cid=<?php echo $_REQUEST["cid"]."&cate_id=".$qandadata[$qandarow]["cate_id"] ?>"> <?php echo $qandadata[$qandarow]["cate_name"]; ?> </a></td>
																</tr>
																<?php 
				}
				/*↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑*/
				/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
				/*　　　　　　　　　情報２カテゴリ一覧終了　　　　　　　　　　*/
				/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
				/****************************************************************/
				?>
												</table>
								</td>
								<td width="10" valign="top">&nbsp;</td>
								<td valign="top">
												<table border="0" align="left" cellpadding="0" cellspacing="0">
																<tr>
																				<td><form action="" method="post" enctype="multipart/form-data" name="update_form" id="update_form">
<?php 
if($_REQUEST["pmode"]=="update") {
	$ad_qanda->UpdateOneData($_POST);
	$qandadata=$ad_qanda->GetDetailsData($_GET["data_id"]);
	$qandacdata=$ad_qanda->GetDetailsCate($qandadata["cate_id"]);
}
$qandadata=$ad_qanda->GetDetailsData($_GET["data_id"]);
$qandacdata=$ad_qanda->GetDetailsCate($qandadata["cate_id"]);

?>
<script type="text/javascript">
<!--

function on_load() {
    //==================================================================
    // FCK Editor
    
    var oFCKeditor = new FCKeditor( 'data_comm' );
    
    oFCKeditor.BasePath = '/FCK/';
    oFCKeditor.Width = '400';
    oFCKeditor.Height = '400';
    oFCKeditor.ToolbarSet = 'Mymenu';
    
    oFCKeditor.ReplaceTextarea();
}

// -->

</script>
		<table width="700" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
          <!--<tr>
            <th align="left" bgcolor="#ECECEC">カテゴリ名</th>
            <td align="left" bgcolor="#FFFFFF"><?php echo $qandacdata["cate_name"];?></td>
          </tr>-->
          <tr>
          				<th align="left" bgcolor="#ECECEC">カテゴリ</th>
          				<td align="left" bgcolor="#FFFFFF">
          								<select name="cate_id" id="cate_id">
																		<?php
																		$qalist=$dbobj->GetList("select * from qanda_cate where parents_id = ".$_REQUEST["cid"]);
																		for($qai=0;$qalist[$qai]["cate_id"]!=NULL;$qai++){
																		?>
          												<option value="<?php echo $qalist[$qai]["cate_id"] ?>"<?php if($qalist[$qai]["cate_id"]==$_REQUEST["cate_id"]){ echo " selected";}?>><?php echo $qalist[$qai]["cate_name"] ?></option>
          										<?php
																				}
																				?>
																						</select>
          								</td>
          				</tr>
          <tr>
            <th width="138" align="left" bgcolor="#ECECEC"><strong>タイトル</strong></th>
            <td width="547" align="left" bgcolor="#FFFFFF">
              	<textarea name="data_name" cols="60" id="data_name" style="width:98%;"><?php echo $qandadata["data_name"];?></textarea>
            </td>
          </tr>
         <?php 
		 if($qandasetting["data_image_chk"]==1) {
		 ?>
         <tr>
           <th rowspan="2" align="left" valign="top" bgcolor="#ECECEC">イメージ画像</th>
           <td align="left" valign="top" bgcolor="#FFFFFF">
             <?php if($qandadata["data_image"]!=NULL){
							$pdata=(@getimagesize($_SERVER['DOCUMENT_ROOT'].$qandadata["data_image"]));
							if($pdata[0]>400) {
								 $pdata[0]=400;
							}
						 ?>
             <img src="<?php echo "http://".$_SESSION["DomainData"]["domain_name"].$qandadata["data_image"];?>" alt="image"  width="<?php echo $pdata[0];?>px"/>
             <input name="oldphoto" type="hidden" id="oldphoto" value="<?php echo $qandadata["data_image"] ?>" />
             <br />
               <label>
               <input name="delimage" type="checkbox" id="delimage" value="1" />
               写真削除</label> <?php }?>
</td>
         </tr>
         <tr>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <input name="imagefile" type="file" id="imagefile">
            </td>
          </tr>
          <?php
		  }
		  ?><?php 
		 if($qandasetting["data_comm_chk"]==1) {
		 ?>
          <tr>
            <th width="138" align="left" valign="top" bgcolor="#ECECEC"><strong>内容</strong></th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <textarea name="data_comm" cols="50" rows="15" id="data_comm" style="width:98%;"><?php echo $qandadata["data_comm"];?></textarea>
            </td>
          <script language="javascript">
					on_load();

					</script></tr>
					<?php
		  }
		  ?><?php 
		 if($qandasetting["data_additional_chk"]==1) {
		 ?>
          <?php
		  }
		  ?>
          <tr>
            <th width="138" align="left" valign="top" bgcolor="#ECECEC">公開</th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <select name="view_chk" id="view_chk">
                <option value="1"<?php if($qandadata["view_chk"]==1){echo " selected";}?>>公開する</option>
                <option value="0"<?php if($qandadata["view_chk"]==0){echo " selected";}?> >公開しない</option>
              </select>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top" bgcolor="#ECECEC">&nbsp;</td>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="更新する" onClick="datachk()">
              <input name="pmode" type="hidden" id="pmode" value="update">
              <input name="data_id" type="hidden" id="data_id" value="<?php echo $_REQUEST["data_id"];?>">
              <input name="cid" type="hidden" id="cid" value="<?php echo $_REQUEST["cid"];?>" />
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onclick="location.replace('?PID=al_qa_details&cid=<?php echo $_REQUEST["cid"];?>&cate_id=<?php echo $qandadata["cate_id"];?>')" />
            </td>
          </tr>
        </table>
      </form></td>
																</tr>
												</table>
								</td>
				</tr>
</table>
<p>&nbsp;</p>
