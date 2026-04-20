<?php 
$ad_info2=new Admin_Info2($dbobj);
$info2cdata=$ad_info2->GetDetailsCate($_GET["cate_id"]);
$info2setting=$ad_info2->LoadSetting();

?><script type="text/javascript" src="/FCK/fckeditor.js"></script>
<script language="javascript">
function datachk() {
	res=confirm("この内容で登録してもよろしいですか?");
	
	if(res) {
		document.form1.submit();
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
											<p><strong>　<?php echo $menudata[7]["data_name"]; ?>　&gt;&gt;　詳細データ登録</strong></p>
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
      <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
<?php 
if($_REQUEST["pmode"]=="regist") {
	$new_id=$ad_info2->AdditionData($_POST);
	$info2data=$ad_info2->GetDetailsData($new_id);
	$info2cdata=$ad_info2->GetDetailsCate($info2data["cate_id"]);
	
?>
        <table width="700" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <th align="left" bgcolor="#ECECEC">カテゴリ名</th>
            <td align="left" bgcolor="#FFFFFF"><?php echo $info2cdata["cate_name"];?></td>
          </tr>
          <tr>
            <th width="100" align="left" bgcolor="#ECECEC"><strong>タイトル</strong></th>
            <td width="400" align="left" bgcolor="#FFFFFF">
             <?php echo $_POST["new_data_name"];?></td>
          </tr>
         <?php 
		 if($info2setting["data_image_chk"]==1) {
		 ?> <tr>
            <th align="left" valign="top" bgcolor="#ECECEC">イメージ画像</th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <?php if($info2data["data_image"]!=NULL){;?>
              <img src="<?php echo "http://".$_SESSION["DomainData"]["domain_name"].$info2data["data_image"];?>" alt="image" />
              <?php }?>
</td>
          </tr>
		  <?php
		  }
		  ?>         <?php 
		 if($info2setting["data_comm_chk"]==1) {
		 ?>
          <tr>
            <th width="100" align="left" valign="top" bgcolor="#ECECEC"><strong>内容</strong></th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
           <?php echo $_POST["new_data_comm"];?>            </td>
          </tr>		  <?php
		  }
		  ?><?php 
		 if($info2setting["data_additional_chk"]==1) {
		 ?>
          <tr>
            <th align="left" valign="top" bgcolor="#ECECEC">追記</th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <table width="100%" border="0">
                <?php
				for($i=0;$_REQUEST["sub_num"][$i]!=NULL;$i++){
					if($_REQUEST["sub_title"][$i]!=NULL||$_REQUEST["sub_comm"][$i]!=NULL) {
				?><tr>
                  <td width="35%" align="left" valign="top">
                    <?php echo $_REQUEST["sub_title"][$i]; ?>                  </td>
                  <td width="65%" align="left" valign="top">
                     <?php echo $_REQUEST["sub_comm"][$i]; ?>                  </td>
                </tr>
				<?php
					}
				}
				?>
              </table>
            </td>
          </tr><?php
		  }
		  ?>
          <tr>
            <th width="100" align="left" valign="top" bgcolor="#ECECEC">公開</th>
            <td align="left" valign="top" bgcolor="#FFFFFF"><?php 
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
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="続けて登録する" onClick="location.replace('?PID=info2_d_add&cate_id=<?php echo $_REQUEST["cate_id"];?>')">
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onclick="location.replace('?PID=info2_details&cate_id=<?php echo $_GET["cate_id"];?>')" />
            </td>
          </tr>
        </table>
		<?php
		}
		else {
		?>
		<table width="700" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <th align="left" bgcolor="#ECECEC">カテゴリ名</th>
            <td align="left" bgcolor="#FFFFFF"><?php echo $info2cdata["cate_name"];?></td>
          </tr>
          <tr>
            <th width="100" align="left" bgcolor="#ECECEC"><strong>タイトル</strong></th>
            <td width="400" align="left" bgcolor="#FFFFFF">
              <textarea name="new_data_name" cols="50" id="new_data_name"></textarea>
            </td>
          </tr>
         <?php 
		 if($info2setting["data_image_chk"]==1) {
		 ?><tr>
            <th align="left" valign="top" bgcolor="#ECECEC">イメージ画像</th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <input name="imagefile" type="file" id="imagefile">
            </td>
          </tr><?php
		  }
		  ?><?php 
		 if($info2setting["data_comm_chk"]==1) {
		 ?>
          <tr>
            <th width="100" align="left" valign="top" bgcolor="#ECECEC"><strong>内容</strong>

		<script type="text/javascript">
<!--

function on_load() {
    //==================================================================
    // FCK Editor
    
    var oFCKeditor = new FCKeditor( 'new_data_comm' );
    
    oFCKeditor.BasePath = '/FCK/';
    oFCKeditor.Width = '500';
    oFCKeditor.Height = '400';
    oFCKeditor.ToolbarSet = 'Mymenu2';
    oFCKeditor.ReplaceTextarea();
}

// -->

</script></th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <textarea name="new_data_comm" cols="50" rows="15" id="new_data_comm"></textarea>
            </td>
          </tr><?php
		  }
		  ?><?php 
		 if($info2setting["data_additional_chk"]==1) {
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
          </tr><?php
		  }
		  ?>
          <tr>
            <th width="100" align="left" valign="top" bgcolor="#ECECEC">公開</th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <select name="new_view_chk" id="new_view_chk">
                <option value="1">公開する</option>
                <option value="0" selected>公開しない</option>
              </select>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top" bgcolor="#ECECEC">&nbsp;</td>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <input name="bbtm_regist" type="submit" id="bbtm_regist" value="登録する" onClick="datachk()">
              <input name="pmode" type="hidden" id="pmode" value="regist">
              <input name="cate_id" type="hidden" id="cate_id" value="<?php echo $_GET["cate_id"];?>">
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onclick="location.replace('?PID=info2_details&cate_id=<?php echo $_GET["cate_id"];?>')" />
            </td>
          </tr>
        </table>
				<?php 
		 if($info2setting["data_comm_chk"]==1) {
		 ?>
<script type="text/javascript">
on_load();
</script>        <?php 
}
		}
		?>
      </form>
    </td>
  </tr>
</table>
