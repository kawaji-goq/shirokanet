<?php 
$ad_link=new Ad_Links($dbobj);
$linkcdata=$ad_link->GetDetailsCate($_GET["cate_id"]);
$linksetting=$ad_link->LoadSetting();

?>
<script language="javascript">
function datachk(frm) {
	res=confirm("この内容で登録してもよろしいですか?");
	
	if(res) {
		frm.submit();
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
                        <p><strong>　リンク管理　&gt;&gt;　管理</strong></p>
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
            <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
                <?php 
if($_REQUEST["pmode"]=="regist") {
	$new_id=$ad_link->AdditionData($_POST);
	$linkdata=$ad_link->GetDetailsData($new_id);
	$linkcdata=$ad_link->GetDetailsCate($linkdata["cate_id"]);
	
?>
    <script language="javascript">
location.replace('?PID=link_details&cate_id=<?php echo $_GET["cate_id"];?>');
</script>
            <table width="700" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                    <tr>
                        <th align="left" bgcolor="#ECECEC">カテゴリ名</th>
                        <td align="left" bgcolor="#FFFFFF"><?php echo $linkcdata["cate_name"];?></td>
                    </tr>
                    <tr>
                        <th width="102" align="left" bgcolor="#ECECEC"><strong>タイトル</strong></th>
                        <td width="462" align="left" bgcolor="#FFFFFF"> <?php echo $_POST["new_data_name"];?></td>
                    </tr>
                    <tr>
                        <th align="left" valign="top" bgcolor="#ECECEC">URL</th>
                        <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo $_POST["new_data_url"];?></td>
                    </tr>
                    <?php 
		 if($linksetting["data_image_chk"]==1) {
		 ?>
                    <tr>
                        <th align="left" valign="top" bgcolor="#ECECEC">イメージ画像</th>
                        <td align="left" valign="top" bgcolor="#FFFFFF">
                            <?php if($linkdata["data_image"]!=NULL){;?>
                            <img src="<?php echo "http://".$_SESSION["DomainData"]["domain_name"].$linkdata["data_image"];?>" alt="image" />
                            <?php }?>
                        </td>
                    </tr>
                    <?php
		  }
		  ?>
                    <?php 
		 if($linksetting["data_comm"]==1&&($_SERVER['HTTP_HOST']!="altus.itcube.ne.jp"||str_replace("www.","",$_SERVER["HTTP_HOST"])=="e-altus.com")) {
		 ?>
                    <tr>
                        <th width="102" align="left" valign="top" bgcolor="#ECECEC"><strong>内容</strong></th>
                        <td align="left" valign="top" bgcolor="#FFFFFF"> <?php echo $_POST["new_data_comm"];?> </td>
                    </tr>
                    <?php
		  }
		  ?>
                    <tr>
                        <th width="102" align="left" valign="top" bgcolor="#ECECEC">公開</th>
                        <td align="left" valign="top" bgcolor="#FFFFFF">
                            <?php 
			switch($_POST["new_view_chk"]) {
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
                            <input name="bbtm_regist" type="button" id="bbtm_regist" value="続けて登録する" onClick="location.replace('?PID=link_d_add&cate_id=<?php echo $_REQUEST["cate_id"];?>')">
                            <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onclick="location.replace('?PID=link_details&cate_id=<?php echo $_GET["cate_id"];?>')" />
                        </td>
                    </tr>
                </table>
                <?php
		}
		else {
		?>
                <table width="700" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                    <tr>
                        <th align="left" bgcolor="#ECECEC">カテゴリ名</th>
                        <td align="left" bgcolor="#FFFFFF"><?php echo $linkcdata["cate_name"];?></td>
                    </tr>
                    <tr>
                        <th width="102" align="left" bgcolor="#ECECEC"><strong>タイトル</strong></th>
                        <td width="462" align="left" bgcolor="#FFFFFF">
                            <input name="new_data_name" type="text" id="new_data_name" value="" size="50">
                        </td>
                    </tr>
                    <tr>
                        <th align="left" valign="top" bgcolor="#ECECEC">URL</th>
                        <td align="left" valign="top" bgcolor="#FFFFFF">
                            <input name="new_data_url" type="text" id="new_data_url" size="50" />
                        </td>
                    </tr>
                    <?php 
		 if($linksetting["data_image_chk"]==1) {
		 ?>
                    <tr>
                        <th align="left" valign="top" bgcolor="#ECECEC">イメージ画像</th>
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
                        <th width="102" align="left" valign="top" bgcolor="#ECECEC"><strong>内容</strong></th>
                        <td align="left" valign="top" bgcolor="#FFFFFF">
                            <textarea name="new_data_comm" cols="50" rows="15" id="new_data_comm"></textarea>
                        </td>
                    </tr>
                    <?php
		  }
		  ?>
                    <?php 
		 if($linksetting["data_additional_chk"]==1) {
		 ?>
                    <tr>
                        <th align="left" valign="top" bgcolor="#ECECEC">追記</th>
                        <td align="left" valign="top" bgcolor="#FFFFFF">
                            <table width="100%" border="0">
                                <tr>
                                    <td width="35%" align="left" valign="top">
                                        <textarea name="sub_title[0]" id="sub_title[0]"></textarea>
                                    </td>
                                    <td width="65%" align="left" valign="top">
                                        <textarea name="sub_comm[0]" cols="30" rows="4" id="sub_comm[0]"></textarea>
                                        <input name="sub_num[0]" type="hidden" id="sub_num[0]" value="1" />
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">
                                        <textarea name="sub_title[1]" id="sub_title[1]"></textarea>
                                    </td>
                                    <td align="left" valign="top">
                                        <textarea name="sub_comm[1]" cols="30" rows="4" id="sub_comm[1]"></textarea>
                                        <input name="sub_num[1]" type="hidden" id="sub_num[1]" value="1" />
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">
                                        <textarea name="sub_title[2]" id="sub_title[2]"></textarea>
                                    </td>
                                    <td align="left" valign="top">
                                        <textarea name="sub_comm[2]" cols="30" rows="4" id="sub_comm[2]"></textarea>
                                        <input name="sub_num[2]" type="hidden" id="sub_num[2]" value="1" />
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top">
                                        <textarea name="sub_title[3]" id="sub_title[3]"></textarea>
                                    </td>
                                    <td align="left" valign="top">
                                        <textarea name="sub_comm[3]" cols="30" rows="4" id="sub_comm[3]"></textarea>
                                        <input name="sub_num[3]" type="hidden" id="sub_num[3]" value="1" />
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <?php
		  }
		  ?>
                    <tr>
                        <th width="102" align="left" valign="top" bgcolor="#ECECEC">公開</th>
                        <td align="left" valign="top" bgcolor="#FFFFFF">
                            <select name="new_view_chk" id="new_view_chk">
                                <option value="1" selected>公開する</option>
                                <option value="0">公開しない</option>
                            </select>
                            <input name="new_view_type" type="hidden" id="new_link_type" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td align="left" valign="top" bgcolor="#ECECEC">&nbsp;</td>
                        <td align="left" valign="top" bgcolor="#FFFFFF">
                            <input name="bbtm_regist" type="button" id="bbtm_regist" value="登録する" onClick="datachk(this.form)">
                            <input name="pmode" type="hidden" id="pmode" value="regist">
                            <input name="cate_id" type="hidden" id="cate_id" value="<?php echo $_GET["cate_id"];?>">
                            <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onclick="location.replace('?PID=link_details&cate_id=<?php echo $_GET["cate_id"];?>')" />
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
								<td colspan="3" align="left">
												<table width="700" border="0" align="left">
																<tr>
																				<td width="278"><img src="./img/siteadmin/edit_menu.gif" alt="編集中のエリア" width="278" height="18" /></td>
																				<td width="412" align="left">
																								<p><strong>　リンク管理　&gt;&gt;　管理</strong></p>
																				</td>
																</tr>
												</table>
								</td>
				</tr>
				<tr>
								<td colspan="3" align="left">&nbsp;</td>
				</tr>
				<tr>
								<td width="200" align="left" valign="top">
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
												<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
																<?php 
if($_REQUEST["pmode"]=="regist") {
	$new_id=$ad_link->AdditionData($_POST);
	$linkdata=$ad_link->GetDetailsData($new_id);
	$linkcdata=$ad_link->GetDetailsCate($linkdata["cate_id"]);
	
?>
																<script language="javascript">
location.replace('?PID=link_details&cate_id=<?php echo $_GET["cate_id"];?>');
</script>
																<table width="579" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
																				<tr>
																								<th align="left" bgcolor="#ECECEC">カテゴリ名</th>
																								<td align="left" bgcolor="#FFFFFF"><?php echo $linkcdata["cate_name"];?></td>
																				</tr>
																				<tr>
																								<th width="102" align="left" bgcolor="#ECECEC"><strong>タイトル</strong></th>
																								<td width="462" align="left" bgcolor="#FFFFFF"> <?php echo $_POST["new_data_name"];?></td>
																				</tr>
																				<tr>
																								<th align="left" valign="top" bgcolor="#ECECEC">URL</th>
																								<td align="left" valign="top" bgcolor="#FFFFFF"><?php echo $_POST["new_data_url"];?></td>
																				</tr>
																				<?php 
		 if($linksetting["data_image_chk"]==1) {
		 ?>
																				<tr>
																								<th align="left" valign="top" bgcolor="#ECECEC">イメージ画像</th>
																								<td align="left" valign="top" bgcolor="#FFFFFF">
																												<?php if($linkdata["data_image"]!=NULL){;?>
																												<img src="<?php echo "http://".$_SESSION["DomainData"]["domain_name"].$linkdata["data_image"];?>" alt="image" />
																												<?php }?>
																								</td>
																				</tr>
																				<?php
		  }
		  ?>
																				<?php 
		 if($linksetting["data_comm"]==1) {
		 ?>
																				<tr>
																								<th width="102" align="left" valign="top" bgcolor="#ECECEC"><strong>内容</strong></th>
																								<td align="left" valign="top" bgcolor="#FFFFFF"> <?php echo $_POST["new_data_comm"];?> </td>
																				</tr>
																				<?php
		  }
		  ?>
																				<tr>
																								<th width="102" align="left" valign="top" bgcolor="#ECECEC">公開</th>
																								<td align="left" valign="top" bgcolor="#FFFFFF">
																												<?php 
			switch($_POST["new_view_chk"]) {
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
																												<input name="bbtm_regist" type="button" id="bbtm_regist" value="続けて登録する" onClick="location.replace('?PID=link_d_add&cate_id=<?php echo $_REQUEST["cate_id"];?>')">
																												<input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onclick="location.replace('?PID=link_details&cate_id=<?php echo $_GET["cate_id"];?>')" />
																								</td>
																				</tr>
																</table>
																<?php
		}
		else {
		?>
																<table width="579" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
																				<tr>
																								<th align="left" bgcolor="#ECECEC">カテゴリ名</th>
																								<td align="left" bgcolor="#FFFFFF"><?php echo $linkcdata["cate_name"];?></td>
																				</tr>
																				<tr>
																								<th width="102" align="left" bgcolor="#ECECEC"><strong>タイトル</strong></th>
																								<td width="462" align="left" bgcolor="#FFFFFF">
																												<input name="new_data_name" type="text" id="new_data_name" value="" size="50">
																								</td>
																				</tr>
																				<tr>
																								<th align="left" valign="top" bgcolor="#ECECEC">URL</th>
																								<td align="left" valign="top" bgcolor="#FFFFFF">
																												<input name="new_data_url" type="text" id="new_data_url" size="50" />
																								</td>
																				</tr>
																				<?php 
		 if($linksetting["data_image_chk"]==1) {
		 ?>
																				<tr>
																								<th align="left" valign="top" bgcolor="#ECECEC">イメージ画像</th>
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
																												<textarea name="new_data_comm" cols="50" rows="15" id="new_data_comm"></textarea>
																								</td>
																				</tr>
																				<?php
		  }
		  ?>
																				<?php 
		 if($linksetting["data_additional_chk"]==1) {
		 ?>
																				<tr>
																								<th align="left" valign="top" bgcolor="#ECECEC">追記</th>
																								<td align="left" valign="top" bgcolor="#FFFFFF">
																												<table width="100%" border="0">
																																<tr>
																																				<td width="35%" align="left" valign="top">
																																								<textarea name="sub_title[0]" id="sub_title[0]"></textarea>
																																				</td>
																																				<td width="65%" align="left" valign="top">
																																								<textarea name="sub_comm[0]" cols="30" rows="4" id="sub_comm[0]"></textarea>
																																								<input name="sub_num[0]" type="hidden" id="sub_num[0]" value="1" />
																																				</td>
																																</tr>
																																<tr>
																																				<td align="left" valign="top">
																																								<textarea name="sub_title[1]" id="sub_title[1]"></textarea>
																																				</td>
																																				<td align="left" valign="top">
																																								<textarea name="sub_comm[1]" cols="30" rows="4" id="sub_comm[1]"></textarea>
																																								<input name="sub_num[1]" type="hidden" id="sub_num[1]" value="1" />
																																				</td>
																																</tr>
																																<tr>
																																				<td align="left" valign="top">
																																								<textarea name="sub_title[2]" id="sub_title[2]"></textarea>
																																				</td>
																																				<td align="left" valign="top">
																																								<textarea name="sub_comm[2]" cols="30" rows="4" id="sub_comm[2]"></textarea>
																																								<input name="sub_num[2]" type="hidden" id="sub_num[2]" value="1" />
																																				</td>
																																</tr>
																																<tr>
																																				<td align="left" valign="top">
																																								<textarea name="sub_title[3]" id="sub_title[3]"></textarea>
																																				</td>
																																				<td align="left" valign="top">
																																								<textarea name="sub_comm[3]" cols="30" rows="4" id="sub_comm[3]"></textarea>
																																								<input name="sub_num[3]" type="hidden" id="sub_num[3]" value="1" />
																																				</td>
																																</tr>
																												</table>
																								</td>
																				</tr>
																				<?php
		  }
		  ?>
																				<tr>
																								<th width="102" align="left" valign="top" bgcolor="#ECECEC">公開</th>
																								<td align="left" valign="top" bgcolor="#FFFFFF">
																												<select name="new_view_chk" id="new_view_chk">
																																<option value="1" selected>公開する</option>
																																<option value="0">公開しない</option>
																												</select>
																												<input name="new_view_type" type="hidden" id="new_link_type" value="1">
																								</td>
																				</tr>
																				<tr>
																								<td align="left" valign="top" bgcolor="#ECECEC">&nbsp;</td>
																								<td align="left" valign="top" bgcolor="#FFFFFF">
																												<input name="bbtm_regist" type="button" id="bbtm_regist" value="登録する" onClick="datachk(this.form)">
																												<input name="pmode" type="hidden" id="pmode" value="regist">
																												<input name="cate_id" type="hidden" id="cate_id" value="<?php echo $_GET["cate_id"];?>">
																												<input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onclick="location.replace('?PID=link_details&cate_id=<?php echo $_GET["cate_id"];?>')" />
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
