<?php
	$tenpodata=$dbobj->GetData("select * from tenpo_data");
	$newsobj=new Site_News($dbobj);
	$nblim=4;											
	$now=explode("-",date("Y-m-d"));
	$newblogsql="select * from blog_data where view_chk = 1 order by rdate desc limit $nblim ";
	$newblogdata=$dbobj->GetList($newblogsql);
	$tenpodata=$dbobj->GetData("select * from tenpo_data");

?>
<?php
if($_REQUEST["menu_up"]=="更新する") {

	for($i=0;$_REQUEST["menuid"][$i]!=NULL;$i++) {
		if($_REQUEST["turn"][$i]==NULL) {
				$_REQUEST["turn"][$i]=0;
		}
		$dbobj->Query("update menu_data set turn =".$_REQUEST["turn"][$i].",data_name= '".$_REQUEST["title"][$i]."',use_chk=".$_REQUEST["use_chk"][$i]." where data_id=".$_REQUEST["menuid"][$i]);
	}
	if($_REQUEST["new_contents"]!="--") {
			$maxdata=$dbobj->GetData("select max(data_id) as maxid from menu_data");
			$maxid=1+$maxdata["maxid"];

			switch($_REQUEST["new_contents"]) {
				case "contents":
					$contmaxdata=$dbobj->GetData("select max(cate_id) as maxid from info1_cate");
					$contmaxid=1+$contmaxdata["maxid"];
					$dbobj->Query("insert into menu_data(data_id,data_name,data_comm,turn,data_code,use_chk) ".
																			" values (".$maxid.",'".$_REQUEST["new_title"]."','".$contmaxid."',".$maxid.",'contents',1)");
					$dbobj->Query("insert into info1_cate(cate_id) ".
																			" values (".$contmaxid.")");
					break;
				case "banner":
					$contmaxdata=$dbobj->GetData("select max(data_id) as maxid from banner_data");
					$contmaxid=1+$contmaxdata["maxid"];
					$dbobj->Query("insert into menu_data(data_id,data_name,data_comm,turn,data_code,use_chk) ".
																			" values (".$maxid.",'".$_REQUEST["new_title"]."','".$contmaxid."',".$maxid.",'banner',1)");
				?>
				<script language="javascript">
				location.replace("?PID=hp_basic_banner&data_id=<?php echo $contmaxid;?>");
				</script>
				<?php
					break;
					
			}
	}
}
if($_REQUEST["pmode"]=="delete") {	
		$deldata=$dbobj->GetData("select * from menu_data where data_id =".$_REQUEST["delid"]);
		switch($deldata["data_code"]) {
					case "banner":
						$dbobj->Query("delete from banner_data where data_id = ".$daldata["data_comm"]);
						break;			
		}
		$dbobj->Query("delete from menu_data where data_id = ".$_REQUEST["delid"]);
		?>
		<script language="javascript">
		location.replace("?PID=hp_basic_menu");
</script>
		<?php
}

$pmenulist=$dbobj->GetList("select * from menu_data order by turn");
?>
<script language="javascript">
function delchk(name,id) {
	var res=confirm(name+"を削除してもよろしいですか？");
	
	if(res) {
		location.href="?PID=hp_basic_menu&pmode=delete&delid="+id;
	}
	
}
</script><meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
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
.style6 {color: #999999}
.style7 {
	color: #999999;
	font-size: 12px;
}
-->
</style>
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
    <td width="640" align="left" valign="top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
        
        <tr>
          <td width="600" height="35" align="left" valign="middle" background="/img/main/title_bg.jpg"><table width="99%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="15">&nbsp;</td>
              <td width="622" class="text2">
                  <p><strong>メインメニューの編集</strong></p>
              </td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="left" valign="top" background="/img/main/sideline.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="2%" align="left" valign="top">&nbsp;</td>
                <td align="left" valign="top"><table width="97%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="texttitle_1">&nbsp;</td>
                  </tr>
                </table>
                    <table width="100%" border="0" align="center">
                        <tr>
                            <td>
                                <form name="form1" method="post" action="">
                                    <table width="100%" border="0" cellspacing="1" cellpadding="2">
                                        <tr>
                                            <td width="100%"><strong>メニュー一覧</strong></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table width="99%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
                                                    <tr>
                                                        <td width="10%" bgcolor="#ECECEC">
                                                            <div align="center"><strong>表示順</strong></div>
                                                        </td>
                                                        <td width="65%" bgcolor="#ECECEC"><strong>メニュー名</strong></td>
                                                        <td width="16%" bgcolor="#ECECEC">
                                                            <div align="center"><strong>公開設定</strong></div>
                                                        </td>
                                                        <td width="9%" bgcolor="#ECECEC">
                                                            <div align="center"><strong>削除</strong></div>
                                                        </td>
                                                    </tr>
                                                    <?php
																for($pmi=0;$pmenulist[$pmi]["data_id"]!=NULL;$pmi++) {
																?>
                                                    <tr>
                                                        <td bgcolor="#FFFFFF">
                                                            <div align="center">
                                                                <input name="turn[<?php echo $pmi;?>]" type="text" id="turn[<?php echo $pmi;?>]" size="4" value="<?php echo $pmenulist[$pmi]["turn"];?>">
                                                            </div>
                                                        </td>
                                                        <td bgcolor="#FFFFFF">
                                                            <input name="title[<?php echo $pmi;?>]" type="text" id="title[<?php echo $pmi;?>]" value="<?php echo $pmenulist[$pmi]["data_name"];?>" style="width:95%">
                                                            <input name="menuid[<?php echo $pmi;?>]" type="hidden" id="menuid[<?php echo $pmi;?>]" value="<?php echo $pmenulist[$pmi]["data_id"];?>">
                                                        </td>
                                                        <td bgcolor="#FFFFFF">
                                                            <div align="center">
                                                                <select name="use_chk[<?php echo $blogrow; ?>]">
                                                                    <option value="1"<?php if($pmenulist[$pmi]["use_chk"]==1) {echo " selected";}?>>公開する</option>
                                                                    <option value="0"<?php if($pmenulist[$pmi]["use_chk"]==0) {echo " selected";}?>>公開しない</option>
                                                                </select>
                                                                </div>
                                                        </td>
                                                        <td bgcolor="#FFFFFF">
                                                            <div align="center">
                                                                <?php
																								if($pmenulist[$pmi]["data_code"]=="banner"||$pmenulist[$pmi]["data_code"]=="contents") {?>
                                                                <input type="button" name="Submit" value="削除" onclick="delchk('<?php echo $pmenulist[$pmi]["data_name"];?>','<?php echo $pmenulist[$pmi]["data_id"];?>')" />
                                                                <?php }
																												?>
                                                                </div>
                                                        </td>
                                                    </tr>
                                                    <?php
																}
																?>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
                                                    <tr>
                                                        <td width="100%" bgcolor="#ECECEC"><strong>新規追加</strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td bgcolor="#FFFFFF">
                                                            <select name="new_contents" id="new_contents">
                                                                <option selected>--</option>
                                                                <option value="contents">基本コンテンツ</option>
                                                                <option value="banner">バナー</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td bgcolor="#FFFFFF">
                                                            <input name="new_title" type="text" id="new_title" size="40">
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
                                                <input type="Submit" name="menu_up" value="更新する">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </table>
                                                                </form>
                                </td>
                        </tr>
                    </table>
                </td>
              </tr>
              <tr>
                <td colspan="2" align="center" valign="top"><img src="/img/sp/7_7.jpg" width="7" height="7" /></td>
              </tr>
            </table>
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
</table>
