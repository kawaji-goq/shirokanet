<?php 

$ad_blog=new Admin_Blog($dbobj);
$blogsetting=$ad_blog->LoadSetting();
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
<table width="740" border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
  		<td>
  				<table width="700" border="0" align="left">
							<tr>
									<td width="278"><img src="./img/siteadmin/edit_menu.gif" alt="編集中のエリア" width="278" height="18" /></td>
									<td width="412" align="left">
											<p><strong>　ブログ　&gt;&gt;　カテゴリ更新</strong></p>
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
	$ad_blog->UpdateOneCate($_POST);
	$blogcdata=$ad_blog->GetDetailsCate($_GET["cate_id"]);
?>
        <table width="510" border="0" align="center">
          <tr>
            <th width="100" align="left"><strong>カテゴリ名</strong></th>
            <td width="400" align="left">
             <?php echo $_POST["cate_name"];?></td>
          </tr>
   <?php
		 if($blogsetting["cate_image_chk"]==1) {
		 ?><?php
		  }
		  ?><?php
		 if($blogsetting["cate_comm_chk"]==1) {
		 ?>
          
          <?php
		  }
		  ?>
          
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
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onClick="location.replace('?PID=blog')">
            </td>
          </tr>
        </table>
		<?php
		}
		else {
			$blogcdata=$ad_blog->GetDetailsCate($_GET["cate_id"]);
		?>
		<table width="510" border="0" align="center">
          <tr>
            <th width="100" align="left"><strong>カテゴリ名</strong></th>
            <td width="400" align="left">
              <textarea name="cate_name" cols="50" id="cate_name"><?php echo $blogcdata["cate_name"];?></textarea>
            </td>
          </tr>
           
          
          <tr>
            <th width="100" align="left" valign="top">公開</th>
            <td align="left" valign="top">
              <select name="view_chk" id="view_chk">
                <option value="1"<?php if($blogcdata["view_chk"]==1){echo " selected";}?>>公開する</option>
                <option value="0"<?php if($blogcdata["view_chk"]==0){echo " selected";}?> >公開しない</option>
              </select>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="更新する" onClick="datachk()">
              <input name="pmode" type="hidden" id="pmode" value="update">
              <input name="cate_id" type="hidden" id="cate_id" value="<?php echo $_REQUEST["cate_id"];?>">
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onclick="location.replace('?PID=blog')" />
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
