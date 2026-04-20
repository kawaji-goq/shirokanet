<?php 

$ad_contents=new Admin_Info1($dbobj);
$contentssetting=$ad_contents->LoadSetting();
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
											<p><strong>　コンテンツ　&gt;&gt;　カテゴリ更新</strong></p>
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
	$ad_contents->UpdateOneCate($_POST);
	$contentscdata=$ad_contents->GetDetailsCate($_GET["cate_id"]);
?>
        <table width="700" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <th width="100" align="left" bgcolor="#ECECEC"><strong>カテゴリ名</strong></th>
            <td width="400" align="left" bgcolor="#FFFFFF">
             <?php echo $_POST["cate_name"];?></td>
          </tr>
   <?php
		 if($contentssetting["cate_image_chk"]==1) {
		 ?><?php
		  }
		  ?><?php
		 if($contentssetting["cate_comm_chk"]==1) {
		 ?><?php
		  }
		  ?>
          <tr>
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
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onClick="location.replace('?PID=contents_category')">
            </td>
          </tr>
        </table>
		<?php
		}
		else {
			$contentscdata=$ad_contents->GetDetailsCate($_GET["cate_id"]);
		?>
		<table width="700" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <th width="100" align="left" bgcolor="#ECECEC"><strong>カテゴリ名</strong></th>
            <td width="400" align="left" bgcolor="#FFFFFF">
              <textarea name="cate_name" cols="50" id="cate_name"><?php echo $contentscdata["cate_name"];?></textarea>
            </td>
          </tr>
           <?php
		 if($contentssetting["cate_image_chk"]==1) {
		 ?><?php
		  }
		  ?><?php
		 if($contentssetting["cate_image_chk"]==1) {
		 ?><?php
		  }
		  ?>
          <tr>
            <th width="100" align="left" valign="top" bgcolor="#ECECEC">公開</th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <select name="view_chk" id="view_chk">
                <option value="1"<?php if($contentscdata["view_chk"]==1){echo " selected";}?>>公開する</option>
                <option value="0"<?php if($contentscdata["view_chk"]==0){echo " selected";}?> >公開しない</option>
              </select>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top" bgcolor="#ECECEC">&nbsp;</td>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="更新する" onClick="datachk()">
              <input name="pmode" type="hidden" id="pmode" value="update">
              <input name="cate_id" type="hidden" id="cate_id" value="<?php echo $_REQUEST["cate_id"];?>">
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onclick="location.replace('?PID=contents_category&contents_id=<?php echo $_REQUEST["contents_id"];?>')" />
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
