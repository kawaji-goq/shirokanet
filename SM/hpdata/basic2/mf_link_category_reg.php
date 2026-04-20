<?php
	$tenpodata=$dbobj->GetData("select * from tenpo_data");
	$newsobj=new Site_News($dbobj);
	$nblim=4;											
	$now=explode("-",date("Y-m-d"));
	$newblogsql="select * from blog_data where view_chk = 1 order by rdate desc limit $nblim ";
	$newblogdata=$dbobj->GetList($newblogsql);
	$tenpodata=$dbobj->GetData("select * from tenpo_data");
	if($_REQUEST["cate"]==NULL) {
		$_REQUEST["cate"]=1;
	}
$ad_link=new Ad_Links($dbobj);

class bsad_Links extends Ad_Links{
	function UpdateCateList($data) {
		$db=$this->dbobj;
		$bname=$this->bname;
	
		for($i=0;$data["cate_id"][$i]!=NULL;$i++) {
			if($data["turn"][$i]==NULL) {
				$data["turn"][$i]=0;
			}
			$field[]="turn";
			$tdata[]=$data["turn"][$i];
			$field[]="cate_name";
			$tdata[]="'".$data["cate_name"][$i]."'";
			$field[]="view_chk";
			$tdata[]=$data["view_chk"][$i];
			$db->Update($bname."_cate",$field,$tdata," where cate_id = ".$data["cate_id"][$i]);
			unset($field,$tdata);
				$db->Query("update lastupdate set lastupdate=".time()."");
		} 
	}
}

$ad_link=new bsad_Links($dbobj);

$linksetting=$ad_link->LoadSetting();

$ad_link=new Ad_Links($dbobj);
$linkcdata=$ad_link->GetDetailsCate($_GET["cate_id"]);
$linksetting=$ad_link->LoadSetting();

?>
<script language="javascript">
function datachk(frm) {
	res=confirm("この内容で登録してもよろしいですか?");
	
	if(res) {
		frm.submit();
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
                  <p>リンクカテゴリ編集</p>
              </td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="left" valign="top" background="/img/main/sideline.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="2%" align="left" valign="top">&nbsp;</td>
                <td align="left" valign="top">
                    <form action="" method="post" enctype="multipart/form-data" name="link_form" id="link_form">
                        <?php 
if($_REQUEST["pmode"]=="regist") {
	$newid=$ad_link->AdditionCate($_POST);
	$linkcdata=$ad_link->GetDetailsCate($newid);

?><script language="javascript">
location.replace('?PID=hp_basic_link_category');
</script>
                        <?php
		}
		else {
		?>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                            <tr>
                                <th width="19%" align="left" valign="middle" bgcolor="#ECECEC"><strong>カテゴリ名</strong></th>
                                <td width="81%" align="left" valign="middle" bgcolor="#FFFFFF">
                                    <input name="new_cate_name" type="text" id="new_cate_name" value="" size="50">
                                </td>
                            </tr>
                            <?php
		 if($linksetting["cate_comm_chk"]==1) {
		 ?>
                            <?php
		  }
		  ?>
                            <tr>
                                <th width="19%" align="left" valign="middle" bgcolor="#ECECEC">公開設定</th>
                                <td align="left" valign="middle" bgcolor="#FFFFFF">
                                    <select name="view_chk" id="view_chk">
                                        <option value="1" selected>公開する</option>
                                        <option value="0">公開しない</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" valign="top" bgcolor="#ECECEC">&nbsp;</td>
                                <td align="left" valign="top" bgcolor="#FFFFFF">
                                    <input name="bbtm_regist" type="submit" id="bbtm_regist" value="登録する" onClick="datachk(this.form)">
                                    <input name="pmode" type="hidden" id="pmode" value="regist">
                                    <input name="cate_id" type="hidden" id="cate_id" value="0">
                                    <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onclick="location.replace('?PID=hp_basic_link_category')" />
                                </td>
                            </tr>
                        </table>
                        <?php 
		}
		?>
                    </form>
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
