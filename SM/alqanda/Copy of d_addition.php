<?php 
$ad_qanda=new Admin_QA($dbobj);
$qandacdata=$ad_qanda->GetDetailsCate($_GET["cate_id"]);
$qandasetting=$ad_qanda->LoadSetting();

?>
<script language="javascript">
function datachk() {
	res=confirm("この内容で登録してもよろしいですか?");
	
	if(res) {
		document.form1.submit();
	}
	
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<table width="700" border="0" align="center">
  <tr>
    <td width="278"><img src="./img/siteadmin/edit_menu.gif" alt="編集中のエリア" width="278" height="18" /></td>
    <td width="412" align="left">
      <p><strong>　情報１　&gt;&gt;　詳細データ登録</strong></p>
    </td>
  </tr>
</table>
<table width="700" border="0" align="center">
  <tr>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td>
      <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
<?php 
if($_REQUEST["pmode"]=="regist") {
	$new_id=$ad_qanda->AdditionData($_POST);
	$qandadata=$ad_qanda->GetDetailsData($new_id);
	$qandacdata=$ad_qanda->GetDetailsCate($qandadata["cate_id"]);
	
?>
        <table width="510" border="0" align="center">
          <tr>
            <th align="left">カテゴリ名</th>
            <td align="left"><?php echo $qandacdata["cate_name"];?></td>
          </tr>
          <tr>
            <th width="100" align="left"><strong>タイトル</strong></th>
            <td width="400" align="left">
             <?php echo $_POST["new_data_name"];?></td>
          </tr>
         <?php 
		 if($qandasetting["data_image_chk"]==1) {
		 ?> <tr>
            <th align="left" valign="top">イメージ画像</th>
            <td align="left" valign="top">
              <?php if($qandadata["data_image"]!=NULL){;?>
              <img src="<?php echo "http://".$_SESSION["DomainData"]["domain_name"].$qandadata["data_image"];?>" alt="image" />
              <?php }?>
             
</td>
          </tr>
		  <?php
		  }
		  ?>         <?php 
		 if($qandasetting["data_comm_chk"]==1) {
		 ?>
          <tr>
            <th width="100" align="left" valign="top"><strong>内容</strong></th>
            <td align="left" valign="top">
           <?php echo $_POST["new_data_comm"];?>            </td>
          </tr>		  <?php
		  }
		  ?><?php 
		 if($qandasetting["data_additional_chk"]==1) {
		 ?>
          <tr>
            <th align="left" valign="top">追記</th>
            <td align="left" valign="top">
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
            <th width="100" align="left" valign="top">公開</th>
            <td align="left" valign="top"><?php 
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
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="続けて登録する" onClick="location.replace('?PID=qanda_d_add&cate_id=<?php echo $_REQUEST["cate_id"];?>')">
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onclick="location.replace('?PID=qanda_details&cate_id=<?php echo $_GET["cate_id"];?>')" />
            </td>
          </tr>
        </table>
		<?php
		}
		else {
		?>
		<table width="510" border="0" align="center">
          <tr>
            <th align="left">カテゴリ名</th>
            <td align="left"><?php echo $qandacdata["cate_name"];?></td>
          </tr>
          <tr>
            <th width="100" align="left"><strong>タイトル</strong></th>
            <td width="400" align="left">
              <input name="new_data_name" type="text" id="new_data_name">
            </td>
          </tr>
         <?php 
		 if($qandasetting["data_image_chk"]==1) {
		 ?><tr>
            <th align="left" valign="top">イメージ画像</th>
            <td align="left" valign="top">
              <input name="imagefile" type="file" id="imagefile">
            </td>
          </tr><?php
		  }
		  ?><?php 
		 if($qandasetting["data_comm_chk"]==1) {
		 ?>
          <tr>
            <th width="100" align="left" valign="top"><strong>内容</strong></th>
            <td align="left" valign="top">
              <textarea name="new_data_comm" cols="40" rows="5" id="new_data_comm"></textarea>
            </td>
          </tr><?php
		  }
		  ?><?php 
		 if($qandasetting["data_additional_chk"]==1) {
		 ?>
          <tr>
            <th align="left" valign="top">追記</th>
            <td align="left" valign="top">
              <table width="100%" border="0">
                <tr>
                  <td width="35%" align="left" valign="top">
                    <input name="sub_title[0]" type="text" id="sub_title[0]" />
                  </td>
                  <td width="65%" align="left" valign="top">
                    <textarea name="sub_comm[0]" cols="30" rows="4" id="sub_comm[0]"></textarea>
                    <input name="sub_num[0]" type="hidden" id="sub_num[0]" value="1" />
                  </td>
                </tr>
                <tr>
                  <td align="left" valign="top">
                    <input name="sub_title[1]" type="text" id="sub_title[1]" />
                  </td>
                  <td align="left" valign="top">
                    <textarea name="sub_comm[1]" cols="30" rows="4" id="sub_comm[1]"></textarea>
                    <input name="sub_num[1]" type="hidden" id="sub_num[1]" value="1" />
                  </td>
                </tr>
                <tr>
                  <td align="left" valign="top">
                    <input name="sub_title[2]" type="text" id="sub_title[2]" />
                  </td>
                  <td align="left" valign="top">
                    <textarea name="sub_comm[2]" cols="30" rows="4" id="sub_comm[2]"></textarea>
                    <input name="sub_num[2]" type="hidden" id="sub_num[2]" value="1" />
                  </td>
                </tr>
                <tr>
                  <td align="left" valign="top">
                    <input name="sub_title[3]" type="text" id="sub_title[3]" />
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
            <th width="100" align="left" valign="top">公開</th>
            <td align="left" valign="top">
              <select name="new_view_chk" id="new_view_chk">
                <option value="1">公開する</option>
                <option value="0" selected>公開しない</option>
              </select>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">
              <input name="bbtm_regist" type="submit" id="bbtm_regist" value="登録する" onClick="datachk()">
              <input name="pmode" type="hidden" id="pmode" value="regist">
              <input name="cate_id" type="hidden" id="cate_id" value="0">
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onclick="location.replace('?PID=qanda_details&cate_id=<?php echo $_GET["cate_id"];?>')" />
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
