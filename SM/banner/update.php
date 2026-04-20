<?php 

$ad_info1=new Admin_Banner($dbobj);
$info1setting=$ad_info1->LoadSetting();
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
<table width="700" border="0" align="center">
  <tr>
    <td width="278"><img src="./img/siteadmin/edit_menu.gif" alt="編集中のエリア" width="278" height="18" /></td>
    <td width="412" align="left">
      <p><strong>　<?php echo $menudata[6]["data_name"]; ?>　&gt;&gt;　カテゴリ更新</strong></p>
    </td>
  </tr>
</table>
<table width="700" border="0" align="center">
  <tr>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td>
      <form action="" method="post" enctype="multipart/form-data" name="update_form" id="update_form">
<?php 
if($_REQUEST["pmode"]=="update") {
	$ad_info1->UpdateOneCate($_POST);
	$info1cdata=$ad_info1->GetDetailsCate($_GET["cate_id"]);
?>
        <table width="510" border="0" align="center">
          <tr>
            <th width="100" align="left"><strong>カテゴリ名</strong></th>
            <td width="400" align="left">
             <?php echo $_POST["cate_name"];?></td>
          </tr>
   <?php
		 if($info1setting["cate_image_chk"]==1) {
		 ?><tr>
            <th align="left" valign="top">イメージ画像</th>
            <td align="left" valign="top">
              <?php if($info1cdata["cate_image"]!=NULL){;?>
              <img src="<?php echo "http://".$_SESSION["DomainData"]["domain_name"].$info1cdata["cate_image"];?>?a" alt="image" />
              <?php }?>
</td>
          </tr><?php
		  }
		  ?><?php
		 if($info1setting["cate_comm_chk"]==1) {
		 ?>
          <tr>
          		<th align="left" valign="top">イメージ画像2</th>
          		<td align="left" valign="top">
          				<?php if($info1cdata["image2"]!=NULL){;?>
									<img src="<?php echo "http://".$_SESSION["DomainData"]["domain_name"].$info1cdata["image2"];?>" alt="image" />
									<?php }?>
</td>
          		</tr>
          <tr>
            <th width="100" align="left" valign="top"><strong>内容</strong></th>
            <td align="left" valign="top">
           <?php echo $_POST["cate_comm"];?>            </td>
          </tr><?php
		  }
		  ?>
          <tr>
          		<th align="left" valign="top">URL</th>
          		<td align="left" valign="top"><?php echo $_POST["url"];?></td>
          		</tr>
          <tr>
            <th width="100" align="left" valign="top">公開</th>
            <td align="left" valign="top"><?php 
			
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
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onClick="location.replace('?PID=info1_category')">
            </td>
          </tr>
        </table>
		<?php
		}
		else {
			$info1cdata=$ad_info1->GetDetailsCate($_GET["cate_id"]);
		?>
		<table width="510" border="0" align="center">
          <tr>
            <th width="100" align="left"><strong>カテゴリ名</strong></th>
            <td width="400" align="left">
              <textarea name="cate_name" cols="50" id="cate_name"><?php echo $info1cdata["cate_name"];?></textarea>
            </td>
          </tr>
           <?php
		 if($info1setting["cate_image_chk"]==1) {
		 ?>  
           <tr>
             <th rowspan="2" align="left" valign="top">イメージ画像</th>
             <td align="left" valign="top">
               <?php if($info1cdata["cate_image"]!=NULL){;?>
               <img src="<?php echo "http://".$_SESSION["DomainData"]["domain_name"].$info1cdata["cate_image"];?>" alt="image" /><br />
               <label>
               <input name="delimage" type="checkbox" id="delimage" value="1" />
               写真削除</label><?php }?>
             </td>
           </tr>
           <tr>
            <td align="left" valign="top">
              <input name="imagefile" type="file" id="imagefile">
            </td>
          </tr><?php
		  }
		  ?>           <tr>
             <th rowspan="2" align="left" valign="top">イメージ画像2</th>
             <td align="left" valign="top">
               <?php if($info1cdata["image2"]!=NULL){;?>
               <img src="<?php echo "http://".$_SESSION["DomainData"]["domain_name"].$info1cdata["image2"];?>" alt="image" /><br />
               <label>
               <input name="delimage2" type="checkbox" id="delimage2" value="1" />
               写真削除</label><?php }?>
             </td>
           </tr>
           <tr>
            <td align="left" valign="top">
              <input name="imagefile2" type="file" id="imagefile2">
            </td>
          </tr><?php
		 if($info1setting["cate_comm_chk"]==1) {
		 ?>
          <tr>
            <th width="100" align="left" valign="top"><strong>内容</strong></th>
            <td align="left" valign="top">
              <textarea name="cate_comm" cols="50" rows="15" id="cate_comm"><?php echo $info1cdata["cate_comm"];?></textarea>
            </td>
          </tr><?php
		  }
		  ?>
          <tr>
            <th align="left" valign="top">&nbsp;</th>
            <td align="left" valign="top"><input name="html_chk" type="checkbox" id="html_chk" value="1"<?php if($info1cdata["html_chk"]==1) {?> checked="checked" <?php }?>/>
            <label for="html_chk">htmlを使用する</label></td>
          </tr>
          <tr>
          		<th align="left" valign="top">リンク先</th>
          		<td align="left" valign="top">
          				<input name="url" type="text" id="url" size="40" value="<?php echo $info1cdata["url"];?>" />
          		</td>
          		</tr>
          <tr>
            <th width="100" align="left" valign="top">公開</th>
            <td align="left" valign="top">
              <select name="view_chk" id="view_chk">
                <option value="1"<?php if($info1cdata["view_chk"]==1){echo " selected";}?>>公開する</option>
                <option value="0"<?php if($info1cdata["view_chk"]==0){echo " selected";}?> >公開しない</option>
              </select>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="更新する" onClick="datachk()">
              <input name="pmode" type="hidden" id="pmode" value="update">
              <input name="cate_id" type="hidden" id="cate_id" value="<?php echo $_REQUEST["cate_id"];?>">
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onclick="location.replace('?PID=info1_category')" />
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
