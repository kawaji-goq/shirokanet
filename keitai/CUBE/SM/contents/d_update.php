<?php 
$ad_contents=new Admin_Info1($dbobj);
$contentssetting=$ad_contents->LoadSetting();
?><script type="text/javascript" src="/fckeditor/fckeditor.js"></script>

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
											<p><strong>　コンテンツ　&gt;&gt;　詳細データ更新</strong></p>
									</td>
							</tr>
					</table>
  		</td>
 		</tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="690">
      <form action="" method="post" enctype="multipart/form-data" name="update_form" id="update_form">
<?php 
if($_REQUEST["pmode"]=="update") {
	$ad_contents->UpdateOneData($_POST);
	$contentsdata=$ad_contents->GetDetailsData($_GET["data_id"]);
	$contentscdata=$ad_contents->GetDetailsCate($contentsdata["cate_id"]);
?>
<?php
		}
			$contentsdata=$ad_contents->GetDetailsData($_GET["data_id"]);
			$contentscdata=$ad_contents->GetDetailsCate($contentsdata["cate_id"]);
		?><script type="text/javascript">
<!--

function on_load() {
    //==================================================================
    // FCK Editor
    
    var oFCKeditor = new FCKeditor( 'data_comm' );
    
    oFCKeditor.BasePath = '/fckeditor/';
    oFCKeditor.Width = '400';
    oFCKeditor.Height = '400';
    oFCKeditor.ToolbarSet = 'Mymenu4';
    
    oFCKeditor.ReplaceTextarea();
}

// -->

</script>
<table width="700" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <th align="left" bgcolor="#ECECEC">カテゴリ名</th>
            <td align="left" bgcolor="#FFFFFF"><?php echo $contentscdata["cate_name"];?></td>
          </tr>
          <tr>
            <th width="100" align="left" bgcolor="#ECECEC"><strong>タイトル</strong></th>
            <td width="400" align="left" bgcolor="#FFFFFF">
              <textarea name="data_name" cols="50" id="data_name"><?php echo $contentsdata["data_name"];?></textarea>
            </td>
          </tr>
        
         <tr>
           <th rowspan="2" align="left" valign="top" bgcolor="#ECECEC">イメージ画像</th>
           <td align="left" valign="top" bgcolor="#FFFFFF">
             <?php if($contentsdata["data_image"]!=NULL){;?>
             <img src="<?php echo "http://".$_SESSION["DomainData"]["domain_name"].$contentsdata["data_image"];?>" alt="image" />
             <input name="oldphoto" type="hidden" id="oldphoto" value="<?php echo $contentsdata["data_image"] ?>" />
             <br />
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
         
          <tr>
            <th width="100" align="left" valign="top" bgcolor="#ECECEC"><strong>内容</strong></th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <textarea name="data_comm" cols="50" rows="15" id="data_comm"><?php echo $contentsdata["data_comm"];?></textarea>
            </td>
          </tr>
          <tr>
            <th width="100" align="left" valign="top" bgcolor="#ECECEC">公開</th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <select name="view_chk" id="view_chk">
                <option value="1"<?php if($contentsdata["view_chk"]==1){echo " selected";}?>>公開する</option>
                <option value="0"<?php if($contentsdata["view_chk"]==0){echo " selected";}?> >公開しない</option>
              </select>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top" bgcolor="#ECECEC">&nbsp;</td>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="更新する" onClick="datachk()">
              <input name="pmode" type="hidden" id="pmode" value="update">
              <input name="data_id" type="hidden" id="data_id" value="<?php echo $_REQUEST["data_id"];?>">
              <input name="cate_id" type="hidden" id="cate_id" value="<?php echo $contentsdata["cate_id"];?>" />
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onclick="location.replace('?PID=contents_details&contents_id=<?php echo $_REQUEST["contents_id"];?>&cate_id=<?php echo $contentsdata["cate_id"];?>')" />
            </td>
          </tr>
        </table>
        <?php 
		?>
      </form>
    </td>
  </tr>
</table>
<script type="text/javascript">
on_load();
</script>