<?php
	$tenpodata=$dbobj->GetData("select * from tenpo_data");
	$newsobj=new Site_News($dbobj);
	$nblim=4;											
	$now=explode("-",date("Y-m-d"));
	$newblogsql="select * from blog_data where view_chk = 1 order by rdate desc limit $nblim ";
	$newblogdata=$dbobj->GetList($newblogsql);
	$tenpodata=$dbobj->GetData("select * from tenpo_data");
	
	if($_REQUEST["cate_id"]!=NULL) {
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<style type="text/css">
<!--
body {
	background-color:white;
	margin:0px;
	padding:0px;
}
-->
</style>
<link href="/afiss.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
a:link {
	color:#0000CC;
}
a:visited {
	color:#000099;
}
a:hover {
	color: #0066FF;
}
a:active {
	color: #000099;
}
.style5 {color: #666666}
-->
</style>
<script type="text/javascript" src="/fckeditor/fckeditor.js"></script>

<script language="javascript">
function datachk() {
	res=confirm("この内容で更新してもよろしいですか?");
	
	if(res) {
		document.update_form.submit();
	}
}
</script>
<?php 
if($_REQUEST["pmode"]=="update") {
	$ad_contents=new Admin_Info1($dbobj);
	$contentssetting=$ad_contents->LoadSetting();

	$ad_contents->UpdateOneData($_POST);
	$dbobj->Query("update info1_data set options ='".date("Y.m.d")."' where data_id = ".$_REQUEST["data_id"]);
	$contentsdata=$ad_contents->GetDetailsData($_GET["data_id"]);
	$contentscdata=$ad_contents->GetDetailsCate($contentsdata["cate_id"]);
?>
<?php
		}
			?><script type="text/javascript">
<!--

function on_load() {
    //==================================================================
    // FCK Editor
    
    var oFCKeditor = new FCKeditor( 'data_comm' );
    
    oFCKeditor.BasePath = '/fckeditor/';
    oFCKeditor.Width = '600';
    oFCKeditor.Height = '600';
    oFCKeditor.ToolbarSet = 'Mymenu4';
    
    oFCKeditor.ReplaceTextarea();
}

// -->

</script>
<?php
	$infocatedata=$dbobj->GetData("select * from info1_cate where cate_id = ".$_REQUEST["cate_id"]);
	$infocatetitledata=$dbobj->GetData("select * from menu_data where data_code = 'contents' and data_comm='".$infocatedata["parents_id"]."'");

?><?php
																		
																		if($_REQUEST["cate_id"]!=NULL) {
																		$infodata=$dbobj->GetData("select * from info1_data where cate_id =".$_REQUEST["cate_id"]." order by turn");
																		if($infodata["cate_id"]==NULL) {
																			$dbobj->GetData("insert into info1_data (data_id,cate_id,view_chk) values (".$_REQUEST["cate_id"].",".$_REQUEST["cate_id"].",1)");
																		$infodata=$dbobj->GetData("select * from info1_data where cate_id =".$_REQUEST["cate_id"]." order by turn");
																			
																		}
																		?>
<a name="top" id="top"></a>
<table width="0" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top"><?php include"tmp_header.html" ?></td>
  </tr>
</table>
<table width="855" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="200" align="left" valign="top"><table width="0" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top"><?php include"tmp_left_main.html" ?></td>
      </tr>
    </table></td>
    <td width="15"><img src="/img/sp/15_15.jpg" width="15" height="15" /></td>
    <td width="640" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        
        <tr>
          <td width="640" height="35" align="left" valign="middle" background="/img/main/title_bg.jpg"><table width="99%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="14">&nbsp;</td>
              <td width="497" class="text2"><p><?php echo $infocatetitledata["data_name"];?></p></td>
              <td width="123" class="text1">最終更新日　<?php echo $infodata["options"];?></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="left" valign="top" background="/img/main/sideline.jpg">
              <form id="update_form" name="update_form" method="post" action="">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                          <td width="2%" align="left" valign="top">&nbsp;</td>
                          <td align="left" valign="top" class="text2">
                              <p> <span class="texttitle_16"><?php echo $infocatedata["cate_name"];?>
                                  </span><br />
                                  <br />
                                  <?php
																}?>
                                  <span class="texttitle_16"><strong>記事</strong></span>
    <br>
    <textarea name="data_comm"><?php echo $infodata["data_comm"] ?></textarea>
                              </p></td>
                      </tr>
                      <tr>
                          <td align="center" valign="top">&nbsp;</td>
                          <td align="center" valign="top">&nbsp;</td>
                      </tr>
                      <tr>
                          <td align="center" valign="top">&nbsp;</td>
                          <td align="center" valign="top">
                              <div align="left">
                                  <select name="view_chk" id="view_chk">
                                      <option value="1"<?php if($infodata["view_chk"]!=0){echo " selected";}?>>公開する</option>
                                      <option value="0"<?php if($infodata["view_chk"]==0){echo " selected";}?> >公開しない</option>
                                  </select>
                              </div>
                          </td>
                      </tr>
                      <tr>
                          <td align="center" valign="top">&nbsp;</td>
                          <td align="center" valign="top">&nbsp;</td>
                      </tr>
                      <tr>
                          <td align="center" valign="top">
                              <div align="left"></div>
                          </td>
                          <td align="center" valign="top">
                              <div align="left">
                                  <input name="bbtm_regist" type="button" id="bbtm_regist" value="更新する" onClick="datachk()">
                                          <input name="pmode" type="hidden" id="pmode" value="update">
              <input name="data_id" type="hidden" id="data_id" value="<?php echo $infodata["cate_id"];?>">
              <input name="cate_id" type="hidden" id="cate_id" value="<?php echo $infodata["cate_id"];?>" />  </div>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="2" align="left" valign="top" class="text2">
                              <table width="99%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                      <td>&nbsp;</td>
                                      <td class="text2">&nbsp;</td>
                                  </tr><?php
																																		if($_SERVER['HTTP_HOST']=="re.332049.com") {
																																		?>
                                  <tr>
                                      <td>&nbsp;</td>
                                      <td class="text2">下のソースをページの一番上に貼り付けてください。</td>
                                  </tr>
                                  <tr>
                                      <td>&nbsp;</td>
                                      <td class="text2"><font color="#FF0000"><?php 
																																						echo htmlspecialchars('<?php');
																																						echo "\n<br>"; 
																																						echo htmlspecialchars('include $_SERVER["DOCUMENT_ROOT"]."/config/config.php";');
																																						echo "\n<br>"; 
																																						echo htmlspecialchars('																																						?>');
?>
                                      </font></td>
                                  </tr>
                                  <tr>
                                      <td>&nbsp;</td>
                                      <td class="text2">&nbsp;</td>
                                  </tr>
                                  <tr>
                                      <td>&nbsp;</td>
                                      <td class="text2">
                                          <p>下のソースを表示したい場所に貼り付けてください。</p>
                                          </td>
                                  </tr>
                                  <tr>
                                      <td>&nbsp;</td>
                                      <td class="text2">
                                          <pre><font color="#0000FF"><?php 
																																						echo htmlspecialchars('<?php');
																																						
																																												echo "\n<br>";
																																echo htmlspecialchars('$'.'infodata=$'.'dbobj->GetData("select * from info1_data where cate_id ='.$_REQUEST["cate_id"].' order by turn");');
																																						echo "\n<br>";
																																						echo htmlspecialchars('ec'.'ho '.'$'.'infodata'.'["data_comm"];');
																																												echo "\n<br>";
																																						echo htmlspecialchars('?>');?></font></pre>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>&nbsp;</td>
                                      <td class="text2">&nbsp;</td>
                                  </tr>
																																		<?php
																																		}
																																		?>
                                  <tr>
                                      <td width="14">&nbsp;</td>
                                      <td class="text2">
                                          <p>▲<a href="#top">ページTOP</a></p>
                                      </td>
                                  </tr>
                              </table>
                          </td>
                      </tr>
                  </table>
                        </form>
              </td>
        </tr>
        <tr>
          <td align="left" valign="top"><img src="/img/main/title_lower.jpg" width="640" height="12" /></td>
        </tr>
    </table></td>
  </tr>
</table>
<table width="0" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top"><?php include"tmp_footer.html" ?></td>
  </tr>
</table><script type="text/javascript">
on_load();
</script>
<?php
}
?>