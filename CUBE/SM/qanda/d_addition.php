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
<script type="text/javascript" src="/FCK/fckeditor.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<table width="700" border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
  		<td>
  				<table width="700" border="0" align="center">
							<tr>
									<td width="278"><img src="./img/siteadmin/edit_menu.gif" alt="編集中のエリア" width="278" height="18" /></td>
									<td width="412" align="left">
											<p><strong>　<?php echo $menudata[8]["data_name"]; ?>　&gt;&gt;　詳細データ登録</strong></p>
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
	$new_id=$ad_qanda->AdditionData($_POST);
	$qandadata=$ad_qanda->GetDetailsData($new_id);
	$qandacdata=$ad_qanda->GetDetailsCate($qandadata["cate_id"]);
	
?>
        <table width="700" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
          <!--<tr>
            <th align="left" bgcolor="#ECECEC">カテゴリ名</th>
            <td align="left" bgcolor="#FFFFFF"><?php echo $qandacdata["cate_name"];?></td>
          </tr>-->
          <tr>
            <th width="138" align="left" bgcolor="#ECECEC"><strong>タイトル</strong></th>
            <td width="552" align="left" bgcolor="#FFFFFF">
             <?php echo $_POST["new_data_name"];?></td>
          </tr>
         <?php 
		 if($qandasetting["data_image_chk"]==1) {
		 ?> <tr>
            <th align="left" valign="top" bgcolor="#ECECEC">イメージ画像</th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <?php if($qandadata["data_image"]!=NULL){
							$pdata=(@getimagesize("http://".$_SESSION["DomainData"]["domain_name"].$qandadata["data_image"]));
							if($pdata[0]>400) {
								 $pdata[0]=400;
							}
							
							?>
              <img src="<?php echo "http://".$_SESSION["DomainData"]["domain_name"].$qandadata["data_image"];?>" alt="image" width="<?php echo $pdata[0];?>px"/>
              <?php }?>
</td>
          </tr>
		  <?php
		  }
		  ?>         <?php 
		 if($qandasetting["data_comm_chk"]==1) {
		 ?>
          <tr>
            <th width="138" align="left" valign="top" bgcolor="#ECECEC"><strong>内容</strong></th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
           <?php echo $_POST["new_data_comm"];?>            </td>
          </tr>		  <?php
		  }
		  ?><?php 
		 if($qandasetting["data_additional_chk"]==1) {
		 ?>
          <?php
		  }
		  ?>
          <tr>
            <th width="138" align="left" valign="top" bgcolor="#ECECEC">公開</th>
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
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="続けて登録する" onClick="location.replace('?PID=qanda_d_add&cate_id=<?php echo $_REQUEST["cate_id"];?>')">
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onclick="location.replace('?PID=qanda_details&cate_id=<?php echo $_GET["cate_id"];?>')" />
            </td>
          </tr>
        </table>
		<?php
		}
		else {
		?><script type="text/javascript">
<!--

function on_load() {
    //==================================================================
    // FCK Editor
    
    var oFCKeditor = new FCKeditor( 'new_data_comm' );
    
    oFCKeditor.BasePath = '/FCK/';
    oFCKeditor.Width = '400';
    oFCKeditor.Height = '400';
    oFCKeditor.ToolbarSet = 'Mymenu';
    
    oFCKeditor.ReplaceTextarea();
}
// -->

</script>

		<table width="700" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
          <!--<tr>
            <th align="left" bgcolor="#ECECEC">カテゴリ名</th>
            <td align="left" bgcolor="#FFFFFF"><?php echo $qandacdata["cate_name"];?></td>
          </tr>-->
          <tr>
            <th width="100" align="left" bgcolor="#ECECEC"><strong>タイトル</strong></th>
            <td width="400" align="left" bgcolor="#FFFFFF">
              	<textarea name="new_data_name" cols="50" id="new_data_name" style="width:98%;"></textarea>
            </td>
          </tr>
         <?php 
		 if($qandasetting["data_image_chk"]==1) {
		 ?><tr>
            <th align="left" valign="top" bgcolor="#ECECEC">イメージ画像</th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <input name="imagefile" type="file" id="imagefile">
            </td>
          </tr><?php
		  }
		  ?><?php 
		 if($qandasetting["data_comm_chk"]==1) {
		 ?>
          <tr>
            <th width="100" align="left" valign="top" bgcolor="#ECECEC"><strong>内容</strong></th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <textarea name="new_data_comm" cols="50" rows="15" id="new_data_comm" style="width:98%;"></textarea>
            </td>
          </tr>
					<script language="javascript">
					on_load();
					</script>
					<?php
		  }
		  ?><?php 
		 if($qandasetting["data_additional_chk"]==1) {
		 ?>
          <?php
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
											<?php
												if($_REQUEST["cate_id"]==""){
												$_REQUEST["cate_id"]=1;
												}
												?>
              <input name="bbtm_regist" type="submit" id="bbtm_regist" value="登録する" onClick="datachk()">
              <input name="pmode" type="hidden" id="pmode" value="regist">
              <input name="cate_id" type="hidden" id="cate_id" value="<?php echo $_REQUEST["cate_id"];?>">
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
