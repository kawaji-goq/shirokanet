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
<table width="700" border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
  		<td>
  				<table width="700" border="0" align="center">
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
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td>
      <form action="" method="post" enctype="multipart/form-data" name="update_form" id="update_form">
<?php 
if($_REQUEST["pmode"]=="update") {
	$ad_link->UpdateOneData($_POST);
	$linkdata=$ad_link->GetDetailsData($_GET["data_id"]);
	$linkcdata=$ad_link->GetDetailsCate($linkdata["cate_id"]);
?>
        <table width="700" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <th width="100" align="left" bgcolor="#ECECEC"><strong>タイトル</strong></th>
            <td width="400" align="left" bgcolor="#FFFFFF">
             <?php echo $_POST["data_name"];?></td>
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
		 ?>            <tr>
            <th width="100" align="left" valign="top" bgcolor="#ECECEC"><strong>内容</strong></th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
           <?php echo $_POST["data_comm"];?>            </td>
          </tr><?php
		  }
		  ?>
            <th width="100" align="left" valign="top" bgcolor="#ECECEC">公開</th>
            <td align="left" valign="top" bgcolor="#FFFFFF"><?php 
			
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
		<table width="700" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <th align="left" bgcolor="#ECECEC">カテゴリ名</th>
            <td align="left" bgcolor="#FFFFFF"><?php echo $linkcdata["cate_name"];?></td>
          </tr>
          <tr>
            <th width="138" align="left" bgcolor="#ECECEC"><strong>タイトル</strong></th>
            <td width="552" align="left" bgcolor="#FFFFFF">
              <textarea name="data_name" cols="60" id="data_name"><?php echo $linkdata["data_name"];?></textarea>
            </td>
          </tr>          <tr>
            <th width="138" align="left" bgcolor="#ECECEC"><strong>URL</strong></th>
            <td width="552" align="left" bgcolor="#FFFFFF">
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
		 if($linksetting["data_comm_chk"]==1) {
		 ?>
          <tr>
            <th width="138" align="left" valign="top" bgcolor="#ECECEC"><strong>内容</strong></th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <textarea name="data_comm" cols="50" rows="15" id="data_comm"><?php echo $linkdata["data_comm"];?></textarea>
            </td>
          </tr><?php
		  }
		  ?>
          <tr>
            <th width="138" align="left" valign="top" bgcolor="#ECECEC">公開</th>
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
