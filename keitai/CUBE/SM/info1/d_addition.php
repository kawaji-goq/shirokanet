<?php 
$ad_info1=new Admin_Info1($dbobj);
$info1cdata=$ad_info1->GetDetailsCate($_GET["cate_id"]);
$info1setting=$ad_info1->LoadSetting();

?>
<script language="javascript">
function datachk() {
	res=confirm("この内容で登録してもよろしいですか?2");
	if(res) {
		document.infoform1.submit();
	}
}
function datachk2() {
	res=confirm("この内容で登録してもよろしいですか?");
	if(res) {
		document.infoform1.pmode.value="registandback";
		document.infoform1.submit();
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
											<p><strong>　<?php echo $menudata[6]["data_name"]; ?>　&gt;&gt;　詳細データ登録</strong></p>
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
      <form action="" method="post" enctype="multipart/form-data" name="infoform1" id="infoform1">
<?php 
if($_REQUEST["pmode"]=="registandback") {
	$new_id=$ad_info1->AdditionData($_POST);
	$info1data=$ad_info1->GetDetailsData($new_id);
	$info1cdata=$ad_info1->GetDetailsCate($info1data["cate_id"]);
	?>
	<script type="text/javascript">
	location.replace('?PID=info1_details&cate_id=<?php echo $_GET["cate_id"];?>')
	</script>
	<?php
}
else if($_REQUEST["pmode"]=="regist") {
	$new_id=$ad_info1->AdditionData($_POST);
	$info1data=$ad_info1->GetDetailsData($new_id);
	$info1cdata=$ad_info1->GetDetailsCate($info1data["cate_id"]);
	
?>
        <table width="700" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <th align="left" bgcolor="#ECECEC">カテゴリ名</th>
            <td align="left" bgcolor="#FFFFFF"><?php echo $info1cdata["cate_name"];?></td>
          </tr>
          <tr>
            <th width="100" align="left" bgcolor="#ECECEC"><strong>タイトル</strong></th>
            <td width="400" align="left" bgcolor="#FFFFFF">
             <?php echo $_POST["new_data_name"];?></td>
          </tr>
 <?php 
		 if($info1setting["option_chk"]==1) {
		 ?>          	<tr>
         			<th align="left" valign="top" bgcolor="#ECECEC">メーカー名</th>
         			<td align="left" valign="top" bgcolor="#FFFFFF">
         					<?php echo $_POST["maker"];?>         			</td>
         			</tr>
         	<tr>
         			<th align="left" valign="top" bgcolor="#ECECEC">メーカーロゴ</th>
         			<td align="left" valign="top" bgcolor="#FFFFFF">
         					<?php if($info1data["maker_logo"]!=NULL){;?>
									<img src="<?php echo "http://".$_SESSION["DomainData"]["domain_name"].$info1data["maker_logo"];?>" alt="image" />
									<?php }?>
</td>
         			</tr>
         	<tr>
         			<th align="left" valign="top" bgcolor="#ECECEC">商品名</th>
         			<td align="left" valign="top" bgcolor="#FFFFFF"><?php echo $_POST["item_name"];?></td>
         			</tr>
         	<tr>
         			<th align="left" valign="top" bgcolor="#ECECEC">&nbsp;</th>
         			<td align="left" valign="top" bgcolor="#FFFFFF"><?php echo $_POST["option"];?>         			</td>
         			</tr>
         	<tr>
         			<th align="left" valign="top" bgcolor="#ECECEC">商品コード</th>
         			<td align="left" valign="top" bgcolor="#FFFFFF"><?php echo $_POST["item_code"];?>         			</td>
         			</tr>
         	<tr>
         			<th align="left" valign="top" bgcolor="#ECECEC">通常価格</th>
         			<td align="left" valign="top" bgcolor="#FFFFFF"><?php echo $_POST["maker_price"];?>
         			円</td>
         			</tr>
         	<tr>
         		<th align="left" valign="top" bgcolor="#ECECEC"> 販売価格</th>
         		<td align="left" valign="top" bgcolor="#FFFFFF"><?php echo $_POST["price"];?>
         		円</td>
         		</tr>
						<?php
						}
						?>
         <tr>
         		<th align="left" valign="top" bgcolor="#ECECEC">リンク先</th>
         		<td align="left" valign="top" bgcolor="#FFFFFF"><?php echo $_POST["url"];?></td>
         		</tr>
         <?php 
		 if($info1setting["data_image_chk"]==1) {
		 ?>          <tr>
            <th align="left" valign="top" bgcolor="#ECECEC">イメージ画像</th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <?php if($info1data["data_image"]!=NULL){;?>
              <img src="<?php echo "http://".$_SESSION["DomainData"]["domain_name"].$info1data["data_image"];?>" alt="image" />
              <?php }?>
</td>
          </tr>
		  <?php
		  }
		  ?>        
          <tr>
							       <?php 
		 if($info1setting["data_image_chk2"]==1) {
		 ?>           		<th align="left" valign="top" bgcolor="#ECECEC">イメージ画像2</th>
          		<td align="left" valign="top" bgcolor="#FFFFFF">
          				<?php if($info1data["data_image2"]!=NULL){;?>
									<img src="<?php echo "http://".$_SESSION["DomainData"]["domain_name"].$info1data["data_image2"];?>" alt="image" />
									<?php }?>
</td>
          		</tr>
							       <?php 
										 }
		 if($info1setting["data_image_chk3"]==1) {
		 ?>    <tr>
          		<th align="left" valign="top" bgcolor="#ECECEC">イメージ画像3</th>
          		<td align="left" valign="top" bgcolor="#FFFFFF">
          				<?php if($info1data["data_image3"]!=NULL){;?>
									<img src="<?php echo "http://".$_SESSION["DomainData"]["domain_name"].$info1data["data_image3"];?>" alt="image" />
									<?php }?>
</td>
          		</tr><?php }?>
 <?php 
		 if($info1setting["data_comm_chk"]==1) {
		 ?>          <tr>
            <th width="100" align="left" valign="top" bgcolor="#ECECEC"><strong>内容</strong></th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
           <?php echo $_POST["new_data_comm"];?>            </td>
          </tr>		  <?php
		  }
		  ?><?php 
		 if($info1setting["data_additional_chk"]==1) {
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
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="続けて登録する" onClick="location.replace('?PID=info1_d_add&cate_id=<?php echo $_REQUEST["cate_id"];?>')">
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onclick="location.replace('?PID=info1_details&cate_id=<?php echo $_GET["cate_id"];?>')" />
            </td>
          </tr>
        </table>
		<?php
		}
		else {
		?>
		<table width="600" border="0" align="center">
          <tr>
            <th align="left">カテゴリ名</th>
            <td align="left"><?php echo $info1cdata["cate_name"];?></td>
          </tr>
          <tr>
            <th width="100" align="left"><strong>タイトル</strong></th>
            <td width="400" align="left">
              <textarea name="new_data_name" cols="50" rows="4" id="new_data_name"></textarea>
            </td>
          </tr>
 <?php 
		 if($info1setting["option_chk"]==1) {
		 ?>          	<tr>
         			<th align="left" valign="top">メーカー名</th>
         			<td align="left" valign="top">
         					<input name="maker" type="text" id="maker" size="50" />
         			</td>
         			</tr>
         	<tr>
         			<th align="left" valign="top">メーカーロゴ</th>
         			<td align="left" valign="top">
         					<input name="maker_logo" type="file" id="maker_logo" />
         			</td>
         			</tr>
         	<tr>
         			<th align="left" valign="top">商品名</th>
         			<td align="left" valign="top">
         					<input name="item_name" type="text" id="item_name" size="50" />
         			</td>
         			</tr>
         	<tr>
         			<th align="left" valign="top">&nbsp;</th>
         			<td align="left" valign="top">
         					<input name="option" type="text" id="option" size="40" />
         			</td>
         			</tr>
         	<tr>
         			<th align="left" valign="top">商品コード</th>
         			<td align="left" valign="top">
         					<input name="item_code" type="text" id="item_code" />
         			</td>
         			</tr>
         	<tr>
         			<th align="left" valign="top">通常価格</th>
         			<td align="left" valign="top">
         					<input name="maker_price" type="text" id="maker_price" size="20"/>
         			円</td>
         			</tr>
         	<tr>
         		<th align="left" valign="top"> 販売価格</th>
         		<td align="left" valign="top">
         				<input name="price" type="text" id="price" size="20" />
         		円</td>
         		</tr>
						<?php
						}
						?>
     <?php 
		 if($info1setting["data_image_chk"]==1) {
		 ?>         
     <tr>
     		<th align="left" valign="top">&nbsp;</th>
     		<td align="left" valign="top">&nbsp;</td>
     		</tr>
     <tr>
            <th align="left" valign="top">イメージ画像</th>
            <td align="left" valign="top">
              <input name="imagefile" type="file" id="imagefile">
            </td>
          </tr><?php
		  }
		  ?>
     <?php 
		 if($info1setting["data_image_chk2"]==1) {
		 ?>          <tr>
          		<th align="left" valign="top">イメージ画像2</th>
          		<td align="left" valign="top">
          				<input name="imagefile2" type="file" id="imagefile2" />
          		</td>
          		</tr>
           <?php 
					 }
		 if($info1setting["data_image_chk3"]==1) {
		 ?>  <tr>
							<th align="left" valign="top">イメージ画像3</th>
          		<td align="left" valign="top">
									<input name="imagefile3" type="file" id="imagefile3" />
							</td>
          		</tr>
							<?php
							}
							?>
          <tr>
          		<th align="left" valign="top">リンク先</th>
          		<td align="left" valign="top">
          				<input name="url" type="text" id="url" size="40" />
          		</td>
          		</tr>
<?php 
		 if($info1setting["data_comm_chk"]==1) {
		 ?>          <tr>
            <th width="100" align="left" valign="top"><strong>内容</strong><script type="text/javascript" src="/fckeditor/fckeditor.js"></script>

		<script type="text/javascript">
<!--

function on_load() {
    //==================================================================
    // FCK Editor
    var oFCKeditor = new FCKeditor( 'new_data_comm' );
    oFCKeditor.BasePath = '/fckeditor/';
    oFCKeditor.Width = '500';
    oFCKeditor.Height = '400';
    oFCKeditor.ToolbarSet = 'Mymenu2';
    oFCKeditor.ReplaceTextarea();
}

// -->

</script></th>
            <td align="left" valign="top">
              <textarea name="new_data_comm" cols="60" rows="20" id="new_data_comm"></textarea>
            </td>
          </tr><?php
		  }
		  ?><?php 
		 if($info1setting["data_additional_chk"]==1) {
		 ?>
          <tr>
            <th align="left" valign="top">追記</th>
            <td align="left" valign="top">
              <table width="100%" border="0">
                <tr>
                  <td width="35%" align="left" valign="top">
                    <textarea name="sub_title[0]" rows="4" id="sub_title[0]"></textarea>
                  </td>
                  <td width="65%" align="left" valign="top">
                    <textarea name="sub_comm[0]" cols="30" rows="4" id="sub_comm[0]"></textarea>
                    <input name="sub_num[0]" type="hidden" id="sub_num[0]" value="1" />
                  </td>
                </tr>
                <tr>
                  <td align="left" valign="top">
                    <textarea name="sub_title[1]" rows="4" id="sub_title[1]"></textarea>
                  </td>
                  <td align="left" valign="top">
                    <textarea name="sub_comm[1]" cols="30" rows="4" id="sub_comm[1]"></textarea>
                    <input name="sub_num[1]" type="hidden" id="sub_num[1]" value="1" />
                  </td>
                </tr>
                <tr>
                  <td align="left" valign="top">
                    <textarea name="sub_title[2]" rows="4" id="sub_title[2]"></textarea>
                  </td>
                  <td align="left" valign="top">
                    <textarea name="sub_comm[2]" cols="30" rows="4" id="sub_comm[2]"></textarea>
                    <input name="sub_num[2]" type="hidden" id="sub_num[2]" value="1" />
                  </td>
                </tr>
                <tr>
                  <td align="left" valign="top">
                    <textarea name="sub_title[3]" rows="4" id="sub_title[3]"></textarea>
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
										<?php 
		 if($info1setting["data_osusume_chk"]==1) {
		 ?>
										<tr>
												<th align="left" valign="top"><strong>おすすめ</strong></th>
												<td align="left" valign="top">
														<input name="osusume_chk" type="checkbox" id="osusume_chk" value="1"<?php if($info1data["osusume_chk"]==1){ echo " checked";}?> />
												</td>
										</tr>
										<?php
										}
										?>		          <tr>
            <th width="100" align="left" valign="top">状態</th>
            <td align="left" valign="top">
              <select name="new_view_chk" id="new_view_chk">
                <option value="1">公開する</option>
                <option value="0" selected>公開しない</option>
  <?php 
		 if($info1setting["option_chk"]==1) {
		 ?>   <option value="2"<?php if($info1data[$info1row]["view_chk"]==2) {echo " selected";}?>>販売停止</option>
            <?php
						}
						?>              </select>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="登録する" onClick="datachk()">
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="登録して一覧に戻る" onclick="datachk2()" />
              <input name="pmode" type="hidden" id="pmode" value="regist">
              <input name="cate_id" type="hidden" id="cate_id" value="<?php echo $_GET["cate_id"];?>">
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onclick="location.replace('?PID=info1_details&cate_id=<?php echo $_GET["cate_id"];?>')" />
            </td>
          </tr>
        </table>
<script type="text/javascript">
on_load();
</script>        <?php 
		}
		?>
      </form>
    </td>
  </tr>
</table>
