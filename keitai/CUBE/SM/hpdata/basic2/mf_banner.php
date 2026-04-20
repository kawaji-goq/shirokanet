<?php
	$tenpodata=$dbobj->GetData("select * from tenpo_data");
class Ed_Banner extends Admin_Banner {
	
}
$ad_banner=new Admin_Banner($dbobj);
	$newsobj=new Site_News($dbobj);
	$nblim=4;											
	$now=explode("-",date("Y-m-d"));
	$newblogsql="select * from blog_data where view_chk = 1 order by rdate desc limit $nblim ";
	$newblogdata=$dbobj->GetList($newblogsql);
	$bannerdata=$ad_banner->GetDetailsData($_REQUEST["data_id"]);
	if($bannerdata["data_id"]==NULL) {
		$dbobj->Query("insert into banner_data (data_id) values(".$_REQUEST["data_id"].")");
		$bannerdata=$ad_banner->GetDetailsData($_REQUEST["data_id"]);
	}
	$tenpodata=$dbobj->GetData("select * from tenpo_data");

$bannersetting=$ad_banner->LoadSetting();
?>
<script language="javascript">
function datachk() {

	res=confirm("この内容で更新してもよろしいですか?");
	
	if(res) {
		document.update_form.submit();
	}
}
function datachk2() {

	res=confirm("この内容で更新してもよろしいですか?");
	document.update_form.pmode.value="updateandback";
	if(res) {
		document.update_form.submit();
	}
}	
</script><eta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
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
.style6 {color: #999999}
.style7 {
	color: #999999;
	font-size: 12px;
}
-->
</style>
<table width="0" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top"><?php include"tmp_header.html" ?></td>
  </tr>
</table>
<table width="855" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="200" align="left" valign="top"><table width="0" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top"><?php include"tmp_left_main.html" ?></td>
      </tr>
    </table></td>
    <td width="15"><img src="/img/sp/15_15.jpg" width="15" height="15" /></td>
    <td width="640" align="left" valign="top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
        
        <tr>
          <td width="600" height="35" align="left" valign="middle" background="/img/main/title_bg.jpg"><table width="99%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="15">&nbsp;</td>
              <td width="622" class="text2">
                  <p>バナー編集</p>
              </td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="left" valign="top" background="/img/main/sideline.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="2%" align="left" valign="top">&nbsp;</td>
                <td align="left" valign="top"><table width="97%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="texttitle_1">&nbsp;</td>
                  </tr>
                </table>
                    <table width="100%" border="0" align="center">
                        <tr>
                            <td>						<form action="" method="post" enctype="multipart/form-data" name="update_form" id="update_form">
								<?php 
if($_REQUEST["pmode"]=="updateandback") {
	$ad_banner->UpdateOneData2($_POST);
	$bannerdata=$ad_banner->GetDetailsData($_REQUEST["data_id"]);
	$bannercdata=$ad_banner->GetDetailsCate($_REQUEST["cate_id"]);
	?>
	<script type="text/javascript">
	location.replace('?PID=');
	</script>
	<?php
}
else if($_REQUEST["pmode"]=="update") {
	$ad_banner->UpdateOneData2($_POST);
	$bannerdata=$ad_banner->GetDetailsData($_REQUEST["data_id"]);
	$bannercdata=$ad_banner->GetDetailsCate($bannerdata["cate_id"]);
	?>
	<script type="text/javascript">
	location.replace('?PID=');
	</script>
	<?php
}

$bannerdata=$ad_banner->GetDetailsData($_REQUEST["data_id"]);
$bannercdata=$ad_banner->GetDetailsCate($bannerdata["cate_id"]);

?>
								<table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
										
										<tr>
												<th width="20%" align="left" bgcolor="#ECECEC"><strong>タイトル</strong></th>
												<td width="80%" align="left" bgcolor="#FFFFFF">
														<input name="data_name" type="text" id="data_name" value="<?php echo $bannerdata["data_name"];?>" size="50">
												</td>
										</tr>
 <?php 
		 if($bannersetting["option_chk"]==1) {
		 ?>
						<?php
						}
						?>
										
										<tr>
												<th rowspan="2" align="left" valign="top" bgcolor="#ECECEC">イメージ画像</th>
												<td align="left" valign="top" bgcolor="#FFFFFF">
														<?php if($bannerdata["data_image"]!=NULL){
														$pdata1=(getimagesize("http://".$_SESSION["DomainData"]["domain_name"].$bannerdata["data_image"]));
														if($pdata1[0]>400) {
															 $pdata1[0]=400;
														}
														?>
														<img src="<?php echo "http://".$_SESSION["DomainData"]["domain_name"].$bannerdata["data_image"];?>?<?php echo time();?>" alt="image" width="<?php echo $pdata1[0];?>px" />
														<input name="oldphoto" type="hidden" id="oldphoto" value="<?php echo $bannerdata["data_image"] ?>" />
														<br />
														<label>
														<input name="delimage" type="checkbox" id="delimage" value="1" />
														写真削除</label>
														<?php }?>												</td>
										</tr>
										<tr>
												<td align="left" valign="top" bgcolor="#FFFFFF">
														<input name="imagefile" type="file" id="imagefile">
												</td>
										</tr>
		
										           <?php 
		 if($bannersetting["data_image_chk3"]==1) {
		 ?>
<?php
										}
										?>
										<tr>
												<th align="left" valign="top" bgcolor="#ECECEC">リンク先</th>
												<td align="left" valign="top" bgcolor="#FFFFFF">
														<input name="url" type="text" id="url" size="50" value="<?php echo $bannerdata["url"];?>"/>
												</td>
										</tr>
										<?php 
		 if($bannersetting["data_comm_chk"]==1) {
		 ?>
										<?php
		  }
		  ?>
										<?php 
		 if($bannersetting["data_additional_chk"]==1) {
		 ?>
										<?php
		  }
		  ?>
										<?php 
		 if($bannersetting["data_osusume_chk"]==1) {
		 ?>
										<?php
										}
										?>
										<tr>
												<th align="left" valign="top" bgcolor="#ECECEC">ウィンドウ</th>
												<td align="left" valign="top" bgcolor="#FFFFFF">
														<select name="target">
																<option value="_self"<?php if($bannerdata["options"]=="_self") { echo " selected";}?>>現在のウィンドウ</option>
																<option value="_blank"<?php if($bannerdata["options"]=="_blank"||$bannerdata["options"]==NULL) { echo " selected";}?>>新しいウィンドウ</option>
														</select>
												</td>
										</tr>
										<tr>
												<th width="20%" align="left" valign="top" bgcolor="#ECECEC">状態</th>
												<td align="left" valign="top" bgcolor="#FFFFFF">
														<select name="view_chk" id="view_chk">
																<option value="1"<?php if($bannerdata["view_chk"]==1||$bannerdata["view_chk"]==NULL){echo " selected";}?>>公開する</option>
																<option value="0"<?php if($bannerdata["view_chk"]==0){echo " selected";}?> >公開しない</option>
														  <?php 
		 if($bannersetting["option_chk"]==1) {
		 ?>   <option value="2"<?php if($bannerdata["view_chk"]==2) {echo " selected";}?>>販売停止</option>
            <?php
						}
						?></select>
												</td>
										</tr>
										<tr>
												<td align="left" valign="top" bgcolor="#ECECEC">&nbsp;</td>
												<td align="left" valign="top" bgcolor="#FFFFFF">
														<input name="bbtm_regist" type="button" id="bbtm_regist" value="更新する" onClick="datachk()">
														<input name="pmode" type="hidden" id="pmode" value="update">
              <input name="data_id" type="hidden" id="data_id" value="<?php echo $_REQUEST["data_id"];?>">
              <input name="cate_id" type="hidden" id="cate_id" value="<?php echo $bannerdata["cate_id"];?>" />
												</td>
										</tr>
								</table>
								<?php 
		?>
						</form>
</td>
                        </tr>
                    </table>
                </td>
              </tr>
              <tr>
                <td colspan="2" align="center" valign="top"><img src="/img/sp/7_7.jpg" width="7" height="7" /></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td align="left" valign="top"><img src="/img/main/title_lower.jpg" width="640" height="12" /></td>
        </tr>
    </table></td>
  </tr>
</table>
<table width="0" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top"><?php include"tmp_footer.html" ?></td>
  </tr>
</table>
