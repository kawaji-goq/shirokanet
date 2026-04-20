<?php 
$ad_link=new Ad_Links($dbobj);
$linksetting=$ad_link->LoadSetting();
?>
<script language="javascript">
function datachk() {

	res=confirm("この内容で更新してもよろしいですか?");
	
	if(res) {
		document.update_form.submit();
	}
	
}
</script>

<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php
if($_SERVER['HTTP_HOST']==""){
?>

<table width="800" border="0" cellpadding="1" cellspacing="1">
    <tr>
        <td colspan="2" align="left">
            <table width="700" border="0" align="left">
                <tr>
                    <td width="278"><img src="./img/siteadmin/edit_menu.gif" alt="編集中のエリア" width="278" height="18" /></td>
                    <td width="412" align="left">
                        <p><strong>　リンク管理　&gt;&gt;　詳細更新</strong></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="left">&nbsp;</td>
    </tr>
    <tr>
        <td width="11" align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top">
            <form action="" method="post" enctype="multipart/form-data" name="update_form" id="update_form">
<?php 
if($_REQUEST["pmode"]=="update") {
	$ad_link->UpdateOneData($_POST);
	$linkdata=$ad_link->GetDetailsData($_POST["data_id"]);
	$linkcdata=$ad_link->GetDetailsCate($linkdata["cate_id"]);
?>
<script language="javascript">
location.replace('?PID=link_details&cate_id=<?php echo $linkcdata["cate_id"];?>');
</script>

                <table width="700" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                    <tr>
                        <th width="123" align="left" bgcolor="#ECECEC"><strong>タイトル</strong></th>
                        <td width="562" align="left" bgcolor="#FFFFFF"> <?php echo $_POST["data_name"];?></td>
                    </tr>
                    <tr>
                        <th align="left" valign="top" bgcolor="#ECECEC">イメージ画像</th>
                        <td align="left" valign="top" bgcolor="#FFFFFF">
                            <?php if($linkdata["data_image"]!=NULL){;?>
                            <img src="<?php echo "http://".$_SESSION["DomainData"]["domain_name"].$linkdata["data_image"];?>" alt="image" />
                            <?php }?>
                        </td>
                    </tr>
                    <tr>
                        <th align="left" valign="top" bgcolor="#ECECEC">URL</th>
                        <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo $_POST["data_url"];?></td>
                    </tr>
<?php 
if($linkinfosetting["data_comm_chk"]==1&&($_SERVER['HTTP_HOST']!="altus.itcube.ne.jp"||str_replace("www.","",$_SERVER["HTTP_HOST"])=="e-altus.com")) {
?>
                    <tr>
                        <th width="123" align="left" valign="top" bgcolor="#ECECEC"><strong>内容</strong></th>
                        <td align="left" valign="top" bgcolor="#FFFFFF"> <?php echo $_POST["data_comm"];?> </td>
                    </tr>
                    <?php
		  }
		  ?>
                    <th width="123" align="left" valign="top" bgcolor="#ECECEC">公開</th>
                <td align="left" valign="top" bgcolor="#FFFFFF">
                    <?php 
			
			switch($_POST["view_chk"]) {
				case 0:
					echo "公開しない";
					break;
				case 1:
					echo "公開する";
					break;
				default:
					break;
			}
			
			?>
                </td>
                    </tr>
                    <tr>
                        <td align="left" valign="top" bgcolor="#ECECEC">&nbsp;</td>
                        <td align="left" valign="top" bgcolor="#FFFFFF">
                            <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onClick="location.replace('?PID=link_details&cate_id=<?php echo $_POST["cate_id"];?>')">
                        </td>
                    </tr>
                </table>
                <?php
		}
		else {
			$linkdata=$ad_link->GetDetailsData($_GET["data_id"]);
			$linkcdata=$ad_link->GetDetailsCate($linkdata["cate_id"]);
		?>
                <table width="700" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                    <tr>
                        <th align="left" bgcolor="#ECECEC">カテゴリ名</th>
                        <td align="left" bgcolor="#FFFFFF"><?php echo $linkcdata["cate_name"];?></td>
                    </tr>
                    <tr>
                        <th width="124" align="left" bgcolor="#ECECEC"><strong>タイトル</strong></th>
                        <td width="561" align="left" bgcolor="#FFFFFF">
                            <textarea name="data_name" cols="60" id="data_name"><?php echo $linkdata["data_name"];?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th width="124" align="left" bgcolor="#ECECEC"><strong>URL</strong></th>
                        <td width="561" align="left" bgcolor="#FFFFFF">
                            <input name="data_url" type="text" id="data_url" value="<?php echo $linkdata["url"];?>" size="60">
                        </td>
                    </tr>
                    <?php 
		 if($linksetting["data_image_chk"]==1) {
		 ?>
                    <tr>
                        <th rowspan="2" align="left" valign="top" bgcolor="#ECECEC">イメージ画像</th>
                        <td align="left" valign="top" bgcolor="#FFFFFF">
                            <?php if($linkdata["data_image"]!=NULL){;?>
                            <img src="<?php echo "http://".$_SESSION["DomainData"]["domain_name"].$linkdata["data_image"];?>" alt="image" /><br />
                            <label>
                            <input name="delimage" type="checkbox" id="delimage" value="1" />
                                写真削除</label>
                            <?php }?>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" valign="top" bgcolor="#FFFFFF">
                            <input name="imagefile" type="file" id="imagefile">
                        </td>
                    </tr>
                    <?php
		  }
		  ?>
				<?php 
		 if($linksetting["data_comm_chk"]==1&&($_SERVER['HTTP_HOST']!="altus.itcube.ne.jp"||str_replace("www.","",$_SERVER["HTTP_HOST"])=="e-altus.com")) {
		 ?>
                    <tr>
                        <th width="124" align="left" valign="top" bgcolor="#ECECEC"><strong>内容</strong></th>
                        <td align="left" valign="top" bgcolor="#FFFFFF">
                            <textarea name="data_comm" cols="50" rows="15" id="data_comm"><?php echo $linkdata["data_comm"];?></textarea>
                        </td>
                    </tr>
                    <?php
		  }
		  ?>
                    <tr>
                        <th width="124" align="left" valign="top" bgcolor="#ECECEC">公開</th>
                        <td align="left" valign="top" bgcolor="#FFFFFF">
                            <select name="view_chk" id="view_chk">
                                <option value="1"<?php if($linkdata["view_chk"]==1){echo " selected";}?>>公開する</option>
                                <option value="0"<?php if($linkdata["view_chk"]==0){echo " selected";}?> >公開しない</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" valign="top" bgcolor="#ECECEC">&nbsp;</td>
                        <td align="left" valign="top" bgcolor="#FFFFFF">
                            <input name="bbtm_regist" type="button" id="bbtm_regist" value="更新する" onClick="datachk()">
                            <input name="pmode" type="hidden" id="pmode" value="update">
                            <input name="data_id" type="hidden" id="data_id" value="<?php echo $_REQUEST["data_id"];?>">
                            <input name="cate_id" type="hidden" id="cate_id" value="<?php echo $_GET["cate_id"];?>" />
                            <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onclick="location.replace('?PID=link_details&cate_id=<?php echo $linkdata["cate_id"];?>')" />
                        </td>
                    </tr>
                </table>
                <?php 
		}
		?>
            </form>
        </td>
    </tr>
</table>
<?php
}
else {
?>
<table width="800" border="0" align="left" cellpadding="1" cellspacing="1">
				<tr>
								<td colspan="3">
												<table width="700" border="0" align="left">
																<tr>
																				<td width="278"><img src="./img/siteadmin/edit_menu.gif" alt="編集中のエリア" width="278" height="18" /></td>
																				<td width="412" align="left">
																								<p><strong>　リンク管理　&gt;&gt;　詳細更新</strong></p>
																				</td>
																</tr>
												</table>
								</td>
				</tr>
				<tr>
								<td colspan="3">&nbsp;</td>
				</tr>
				<tr>
								<td width="200" valign="top">
												<table width="200" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCFF">
																<tr>
																				<th align="left" bgcolor="#ECECFF"><strong>ｶﾃｺﾞﾘ名</strong></th>
																</tr>
																<?php
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　施工実績カテゴリ一覧開始　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/
$linkcatedata=$ad_link->GetCateList($_GET["link_id"],$lim,$setnum,$orderby);
for($linkrow=0;$linkcatedata[$linkrow];$linkrow++){ 
$linkcate=new Ary_Viewer($linkcatedata[$linkrow]);
?>
																<tr>
																				<td align="left" valign="top" bgcolor="#FFFFFF"> ・<a href="?PID=link_details&cate_id=<?php echo $linkcatedata[$linkrow]["cate_id"];?>">
																								<?php $linkcate->Moji("cate_name"); ?>
																								</a>
																												<input name="cate_id[<?php echo $linkrow; ?>]" type="hidden" id="cate_id[<?php echo $linkrow; ?>]" value="<?php echo $linkcatedata[$linkrow]["cate_id"];?>" />
																				</td>
																</tr>
																<?php 
				}
				/*↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑*/
				/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
				/*　　　　　　　　　施工実績カテゴリ一覧終了　　　　　　　　　　*/
				/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
				/****************************************************************/
				?>
																<tr>
																				<td align="left" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
																</tr>
																<tr>
																				<td align="left" valign="top" bgcolor="#FFFFFF"><a href="?PID=link_category">■カテゴリを編集する</a></td>
																</tr>
												</table>
								</td>
								<td width="11" align="left" valign="top">&nbsp;</td>
								<td width="579" align="left" valign="top">
												<form action="" method="post" enctype="multipart/form-data" name="update_form" id="update_form">
																<?php 
if($_REQUEST["pmode"]=="update") {
	$ad_link->UpdateOneData($_POST);
	$linkdata=$ad_link->GetDetailsData($_GET["data_id"]);
	$linkcdata=$ad_link->GetDetailsCate($linkdata["cate_id"]);
?>
																<script language="javascript">
location.replace('?PID=link_details&cate_id=<?php echo $_GET["cate_id"];?>');
</script>
																<table width="579" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
																				<tr>
																								<th width="101" align="left" bgcolor="#ECECEC"><strong>タイトル</strong></th>
																								<td width="463" align="left" bgcolor="#FFFFFF"> <?php echo $_POST["data_name"];?></td>
																				</tr>
																				<tr>
																								<th align="left" valign="top" bgcolor="#ECECEC">イメージ画像</th>
																								<td align="left" valign="top" bgcolor="#FFFFFF">
																												<?php if($linkdata["data_image"]!=NULL){;?>
																												<img src="<?php echo "http://".$_SESSION["DomainData"]["domain_name"].$linkdata["data_image"];?>" alt="image" />
																												<?php }?>
																								</td>
																				</tr>
																				<tr>
																								<th align="left" valign="top" bgcolor="#ECECEC">URL</th>
																								<td align="left" valign="top" bgcolor="#FFFFFF"><?php echo $_POST["data_url"];?></td>
																				</tr>
																				<?php 
		 if($linkinfosetting["data_comm_chk"]==1) {
		 ?>
																				<tr>
																								<th width="101" align="left" valign="top" bgcolor="#ECECEC"><strong>内容</strong></th>
																								<td align="left" valign="top" bgcolor="#FFFFFF"> <?php echo $_POST["data_comm"];?> </td>
																				</tr>
																				<?php
		  }
		  ?>
																				<th width="101" align="left" valign="top" bgcolor="#ECECEC">公開</th>
																												<td align="left" valign="top" bgcolor="#FFFFFF">
																																<?php 
			
			switch($_POST["view_chk"]) {
				case 0:
					echo "公開しない";
					break;
				case 1:
					echo "公開する";
					break;
				default:
					break;
			}
			
			?>
																												</td>
																				</tr>
																				<tr>
																								<td align="left" valign="top" bgcolor="#ECECEC">&nbsp;</td>
																								<td align="left" valign="top" bgcolor="#FFFFFF">
																												<input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onClick="location.replace('?PID=link_details&cate_id=<?php echo $linkdata["cate_id"];?>')">
																								</td>
																				</tr>
																</table>
																<?php
		}
		else {
			$linkdata=$ad_link->GetDetailsData($_GET["data_id"]);
			$linkcdata=$ad_link->GetDetailsCate($linkdata["cate_id"]);
		?>
																<table width="579" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
																				<tr>
																								<th align="left" bgcolor="#ECECEC">カテゴリ名</th>
																								<td align="left" bgcolor="#FFFFFF"><?php echo $linkcdata["cate_name"];?></td>
																				</tr>
																				<tr>
																								<th width="102" align="left" bgcolor="#ECECEC"><strong>タイトル</strong></th>
																								<td width="462" align="left" bgcolor="#FFFFFF">
																												<textarea name="data_name" cols="60" id="data_name"><?php echo $linkdata["data_name"];?></textarea>
																								</td>
																				</tr>
																				<tr>
																								<th width="102" align="left" bgcolor="#ECECEC"><strong>URL</strong></th>
																								<td width="462" align="left" bgcolor="#FFFFFF">
																												<input name="data_url" type="text" id="data_url" value="<?php echo $linkdata["url"];?>" size="60">
																								</td>
																				</tr>
																				<?php 
		 if($linksetting["data_image_chk"]==1) {
		 ?>
																				<tr>
																								<th rowspan="2" align="left" valign="top" bgcolor="#ECECEC">イメージ画像</th>
																								<td align="left" valign="top" bgcolor="#FFFFFF">
																												<?php if($linkdata["data_image"]!=NULL){;?>
																												<img src="<?php echo "http://".$_SESSION["DomainData"]["domain_name"].$linkdata["data_image"];?>" alt="image" /><br />
																												<label>
																																<input name="delimage" type="checkbox" id="delimage" value="1" />
																																写真削除</label>
																												<?php }?>
																								</td>
																				</tr>
																				<tr>
																								<td align="left" valign="top" bgcolor="#FFFFFF">
																												<input name="imagefile" type="file" id="imagefile">
																								</td>
																				</tr>
																				<?php
		  }
		  ?>
																				<?php 
		 if($linksetting["data_comm_chk"]==1) {
		 ?>
																				<tr>
																								<th width="102" align="left" valign="top" bgcolor="#ECECEC"><strong>内容</strong></th>
																								<td align="left" valign="top" bgcolor="#FFFFFF">
																												<textarea name="data_comm" cols="50" rows="15" id="data_comm"><?php echo $linkdata["data_comm"];?></textarea>
																								</td>
																				</tr>
																				<?php
		  }
		  ?>
																				<tr>
																								<th width="102" align="left" valign="top" bgcolor="#ECECEC">公開</th>
																								<td align="left" valign="top" bgcolor="#FFFFFF">
																												<select name="view_chk" id="view_chk">
																																<option value="1"<?php if($linkdata["view_chk"]==1){echo " selected";}?>>公開する</option>
																																<option value="0"<?php if($linkdata["view_chk"]==0){echo " selected";}?> >公開しない</option>
																												</select>
																								</td>
																				</tr>
																				<tr>
																								<td align="left" valign="top" bgcolor="#ECECEC">&nbsp;</td>
																								<td align="left" valign="top" bgcolor="#FFFFFF">
																												<input name="bbtm_regist" type="button" id="bbtm_regist" value="更新する" onClick="datachk()">
																												<input name="pmode" type="hidden" id="pmode" value="update">
																												<input name="data_id" type="hidden" id="data_id" value="<?php echo $_REQUEST["data_id"];?>">
																												<input name="cate_id" type="hidden" id="cate_id" value="<?php echo $linkdata["cate_id"];?>" />
																												<input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onclick="location.replace('?PID=link_details&cate_id=<?php echo $linkdata["cate_id"];?>')" />
																								</td>
																				</tr>
																</table>
																<?php 
		}
		?>
												</form>
								</td>
				</tr>
</table>
<?php

}
?>
