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
    <td width="640" align="left" valign="top">
        <?php 
				switch($infocatedata["url"]) {
						case "t_basics1":								
							include "hpdata/basic/pagetemplate/basic1.php";
							break;						
						default:
							include "hpdata/basic/pagetemplate/all.php";
							break;				
				}				
				?>
    </td>
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