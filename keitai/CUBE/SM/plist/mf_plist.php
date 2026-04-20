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
$catesettinglist=$ad_contents->getCateSetting($_REQUEST["cate_id"]);


if($_POST["btm_up_data"]=="更新する") {
for($i=0;$_REQUEST["data_id"][$i]!=NULL;$i++){
	if($_REQUEST["turn"][$i]==NULL) {		
			$_REQUEST["turn"][$i]=0;
	}
	$upsql="update contents_data set turn =".$_REQUEST["turn"][$i]." , name = '".$_REQUEST["name"][$i]."',view_chk = ".$_REQUEST["view_chk"][$i]." where data_id = ".$_REQUEST["data_id"][$i];
	$dbobj->Query($upsql);

	}
	
	
	/*
	 三晃データ作成
	*/
			if($_SERVER['HTTP_HOST']=="stk.itcube.ne.jp"){

	$catecdata=$dbobj->GetData("select *  from contents_cate where cate_id = ".$_REQUEST["cate_id"]);
		@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/webpage");
	if($catecdata["page_url"]!=NULL&&file_exists($_SERVER['DOCUMENT_ROOT']."/".$catecdata["page_url"])){
		
				$list=file("http://stk.itcube.ne.jp/".$catecdata["page_url"]);
				$fp=fopen($_SERVER['DOCUMENT_ROOT']."/tmp/webpage/".$catecdata["page_url"],"w+");
				for($i=0;$list[$i]!=NULL;$i++) {
					fputs($fp,converttxt($list[$i]),10000);
			}
			fclose($fp);
					$ftp=new Cube_FTP();
							$ftp->host="sanko-sp.co.jp";
							$ftp->useport=21;
							$ftp->ddir="/usr/local/apache/htdocs/";
							$ftp->Connect("c10cqw95","vuqp2799");
							$ftp->MkDir("","tmp");
							$ftp->MkDir("tmp/","webpage");
							$ftp->UpData("./",$catecdata["page_url"],$_SERVER['DOCUMENT_ROOT']."/tmp/webpage/".$catecdata["page_url"],"b");
							
							$ftp=new Cube_FTP();
							$ftp->host="www.sanko-sp.co.jp";
							$ftp->useport=21;
							$ftp->ddir="/httpdocs/";
							$ftp->Connect("sanko-spcojp","itc7310");
							$ftp->MkDir("","tmp");
							$ftp->MkDir("tmp/","webpage");
							$ftp->UpData("./",$catecdata["page_url"],$_SERVER['DOCUMENT_ROOT']."/tmp/webpage/".$catecdata["page_url"],"b");
	
	
	
	}	

}


	}	


if($_REQUEST["pmode"]=="delete") {
	$catecdata=$dbobj->GetData("select *  from contents_cate where cate_id = ".$_REQUEST["delid"]);
	$dbobj->Query("delete from contents_data where data_id = ".$_REQUEST["delid"]);	
	$dbobj->Query("delete from contents_data_set where data_id = ".$_REQUEST["delid"]);	
	// "delete from contents_data where data_id = ".$_REQUEST["delid"];
	/*
	 三晃データ作成
	*/
			if($_SERVER['HTTP_HOST']=="stk.itcube.ne.jp"){

		@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/webpage");
	if($catecdata["page_url"]!=NULL&&file_exists($_SERVER['DOCUMENT_ROOT']."/".$catecdata["page_url"])){
		
				$list=file("http://stk.itcube.ne.jp/".$catecdata["page_url"]);
				$fp=fopen($_SERVER['DOCUMENT_ROOT']."/tmp/webpage/".$catecdata["page_url"],"w+");
				for($i=0;$list[$i]!=NULL;$i++) {
					fputs($fp,converttxt($list[$i]),10000);
			}
			fclose($fp);
	$ftp=new Cube_FTP();
	$ftp->host="sanko-sp.co.jp";
	$ftp->useport=21;
	$ftp->ddir="/usr/local/apache/htdocs/";
	$ftp->Connect("c10cqw95","vuqp2799");
	$ftp->MkDir("","tmp");
	$ftp->MkDir("tmp/","webpage");
	$ftp->UpData("./",$catecdata["page_url"],$_SERVER['DOCUMENT_ROOT']."/tmp/webpage/".$catecdata["page_url"],"b");
	
	
	$ftp=new Cube_FTP();
	$ftp->host="www.sanko-sp.co.jp";
	$ftp->useport=21;
	$ftp->ddir="/httpdocs/";
	$ftp->Connect("sanko-spcojp","itc7310");
	$ftp->MkDir("","tmp");
	$ftp->MkDir("tmp/","webpage");
	$ftp->UpData("./",$catecdata["page_url"],$_SERVER['DOCUMENT_ROOT']."/tmp/webpage/".$catecdata["page_url"],"b");
	
	
	}	

}

?>
<script language="javascript">
location.replace('?PID=plist&cate_id=<?php echo $_REQUEST["cate_id"];?>&pattern=plist');
</script>
<?php
}
$catedata=$ad_contents->getCateData($_REQUEST["cate_id"]);
$catemydata=$ad_contents->getDetailsData($_REQUEST["cate_id"]);
$catesettinglist=$ad_contents->getDataSetting($_REQUEST["cate_id"]);
?><script language="javascript">
function delchk(name,id) {
	var res=confirm(name+"を削除してもよろしいですか？");
	
	if(res) {
		location.href="?PID=plist&cate_id=<?php echo $_REQUEST["cate_id"];?>&pattern=plist&pmode=delete&delid="+id;
	}
	
}
</script>

<script type="text/javascript" src="/fckeditor/fckeditor.js"></script><script language="javascript">
function datachk() {

if(document.form1.name.value==""){
alert("コンテンツ名は必ず入力してください。");
}
else {
	res=confirm("この内容で登録してもよろしいですか?");
	
	if(res) {
		document.form1.submit();
	}
	}
}
</script>

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
				<form id="form2" name="form1" method="post" action="">
						<td valign="top"><table border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
								<tr>
										<td align="left" valign="middle" bgcolor="#ECECEC"><table border="0" cellspacing="0" cellpadding="0">
												<tr>
														<td width="15">&nbsp;</td>
														<td width="622"><?php 
																				$catedata=$dbobj->GetData("select * from contents_cate where cate_id = 4");
																				echo $catedata["name"];
																				?>
																編集</td>
												</tr>
										</table></td>
								</tr>
								<tr>
										<td align="left" valign="top" background="http://siteadmin.itcube.ne.jp/sm2/hpdata/newbasic/img/main/sideline.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
												<tr>
														<td align="left" valign="top"><table width="97%" border="0" cellspacing="0" cellpadding="0">
																<tr>
																		<td class="texttitle_1"></td>
																</tr>
														</table>
																<table width="100%" border="0" align="center">
																		<tr>
																				<td><table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
																						<tr>
																								<th width="62" align="center" bgcolor="#ECECEC">表示順</th>
																								<th width="336" align="left" bgcolor="#ECECEC"><strong>商品名</strong></th>
																								<?php
										if($basic2==1){?>
																								<?php }?>
																								<th width="89" align="left" bgcolor="#ECECEC">公開設定</th>
																								<th align="left" bgcolor="#ECECEC"> <div align="center">編集</div>
																								</th>
																								<th align="left" bgcolor="#ECECEC"> <div align="center">削除</div>
																								</th>
																						</tr>
																						<?php
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　情報２カテゴリ一覧開始　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;*/
$contentscatedata=$ad_contents->getDataList(4);
for($contentsrow=0;$contentscatedata[$contentsrow];$contentsrow++){ 
$contentscate=new Ary_Viewer($contentscatedata[$contentsrow]);
?>
																						<tr>
																								<td width="62" align="center" valign="top" bgcolor="#FFFFFF"><input name="turn[<?php echo $contentsrow; ?>]" type="text" id="turn[<?php echo $contentsrow; ?>]" value="<?php $contentscate->Moji("turn"); ?>" size="6" /></td>
																								<td align="left" valign="top" bgcolor="#FFFFFF"><input name="name[<?php echo $contentsrow; ?>]" type="text" id="name[<?php echo $contentsrow; ?>]" value="<?php $contentscate->Moji("name"); ?>" size="40" />
																										<input name="data_id[<?php echo $contentsrow; ?>]" type="hidden" id="data_id[<?php echo $contentsrow; ?>]" value="<?php echo $contentscatedata[$contentsrow]["data_id"];?>" />
																										<input name="cate_id" type="hidden" id="cate_id" value="<?php echo $_REQUEST["cate_id"];?>" /></td>
																								<?php
										if($basic2==1){?>
																								<?php
														}
														?>
																								<td align="left" valign="top" bgcolor="#FFFFFF"><select name="view_chk[<?php echo $contentsrow; ?>]">
																										<option value="1"<?php if($contentscatedata[$contentsrow]["view_chk"]==1) {echo " selected";}?>>公開する</option>
																										<option value="0"<?php if($contentscatedata[$contentsrow]["view_chk"]==0) {echo " selected";}?>>公開しない</option>
																								</select></td>
																								<td width="46" align="left" valign="top" bgcolor="#FFFFFF"><div align="center">
																										<input type="button" name="Submit" value="編集" onclick="location.href='?PID=plist_up&amp;cate_id=<?php echo $contentscatedata[$contentsrow]["cate_id"];?>&amp;data_id=<?php echo $contentscatedata[$contentsrow]["data_id"];?>'" />
																								</div></td>
																								<td width="53" align="left" valign="top" bgcolor="#FFFFFF"><div align="center">
																										<input type="button" name="Submit" value="削除" onclick="delchk('<?php $contentscate->LMoji("name"); ?>','<?php echo $contentscatedata[$contentsrow]["data_id"];?>&amp;cate_id=<?php echo $_REQUEST["cate_id"];?>')" />
																								</div></td>
																						</tr>
																						<?php 
				}
				/*&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;*/
				/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
				/*　　　　　　　　　情報２カテゴリ一覧終了　　　　　　　　　　*/
				/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
				/****************************************************************/
				?>
																				</table>
																						<table width="100%" border="0" cellpadding="2" cellspacing="1">
																								<tr>
																										<td width="80%">&nbsp;</td>
																										<td width="20%">&nbsp;</td>
																								</tr>
																								<tr>
																										<td align="left"><input name="btm_up_data" type="submit" id="btm_up_data" value="更新する" />
																												<input type="button" name="Submit" value="新規登録" onclick="location.href='?PID=plist_reg&amp;cate_id=4'" /></td>
																										<td>&nbsp;</td>
																								</tr>
																						</table></td>
																		</tr>
																</table></td>
												</tr>
												<tr>
														<td align="center" valign="top"><img src="http://siteadmin.itcube.ne.jp/sm2/hpdata/newbasic/img/sp/7_7.jpg" alt="" width="7" height="7" /></td>
												</tr>
										</table></td>
								</tr>
						</table></td>
				</form>
		</tr>
</table>
