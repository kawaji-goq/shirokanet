<?php
if($_REQUEST["up_tenpo"]=="更新する") {
	$imgobj=new Upload();
	$bname="bukken";
	$setdata["listimg_w"]=170;
	$setdata["listimg_h"]=59;
	
	@mkdir("../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."/");
	@mkdir("../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."/logo/");
	
	$imgobj->path="../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."/logo/";
	$imgobj->rpath="/tmp/".$bname."_data/logo/";
	$imagefile1=$imgobj->UpImgAndResize("logo",$setdata["listimg_w"],$setdata["listimg_h"]);	
	$setdata["listimg_w"]=250;
	$setdata["listimg_h"]=0;
	$imgobj2=new Upload();
	$imgobj2->path="../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."/logo/";
	$imgobj2->rpath="/tmp/".$bname."_data/logo/";
	$imagefile2=$imgobj2->UpImgAndResize("k_logo",$setdata["listimg_w"],$setdata["listimg_h"]);	
	
	$upsql="update tenpo_data set ".
			"name='".$_REQUEST["name"]."',".
			"jyusyo='".$_REQUEST["jyusyo"]."',".
			"denwa='".$_REQUEST["denwa"]."',".
			"fax='".$_REQUEST["fax"]."',".
			"email='".$_REQUEST["email"]."',";
			
	if($imagefile1["filepath"]!=NULL||$_REQUEST["dellogo"]==1){
		
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		
			if($imagefile1["filepath"]!=NULL) {
			
				@chmod($imagefile1["filepath"],0777);
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data","logo");
				$ftp->UpData("tmp/".$bname."_data/logo/",$imagefile1["name"],"../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."/logo/".$imagefile1["name"],"b");
				$upsql.="logo='".$imagefile1["filepath"]."',";
				
			}
			else if($setdata["listimg_defalt"]!=NULL){
				if($_REQUEST["dellogo"]==1) {
					$upsql.="logo='',";

				}
			}
			else if($_REQUEST["dellogo"]==1) {
					$upsql.="logo='',";
			}

	}
	if($imagefile2["filepath"]!=NULL||$_REQUEST["delk_logo"]==1){
		
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		
			if($imagefile2["filepath"]!=NULL) {
				@chmod($imagefile2["filepath"],0777);
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data","logo");
				$ftp->UpData("tmp/".$bname."_data/logo/",$imagefile2["name"],"../tmp/".$_SESSION["DomainData"]["dbname"]."/".$bname."/logo/".$imagefile2["name"],"b");
				$upsql.="k_logo='".$imagefile2["filepath"]."',";
			}
			else if($setdata["listimg_defalt"]!=NULL){
				if($_REQUEST["delk_logo"]==1) {

				$upsql.="k_logo='',";
				}
			}
			else if($_REQUEST["delk_logo"]==1) {
				$upsql.="k_logo='',";
			}

	}
			
	$upsql.="header='".htmlspecialchars($_REQUEST["header"])."',".
			"url='".$_REQUEST["url"]."'";
	$dbobj->Query($upsql);
	
}
$tenpodata=$dbobj->GetData("select * from tenpo_data");
?><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<TABLE width="700"  border="0" align="left" cellpadding="3" cellspacing="1" class="realestate_bgcolor1">
      <form action="" method="post" enctype="multipart/form-data" name="bukken_form">
  <TR class="realestate_bgcolor2">
    <TD valign="top">
        <table width="100%"  border="0" cellpadding="0" cellspacing="0" class="border">
          <tr>
            <td width="15" bgcolor="#999999">&nbsp; </td>
            <td>
              <table width="100%"  border="0" cellspacing="0" cellpadding="5">
                <tr>
                  <td bgcolor="#FFFFFF" class="font10">
                    <p><strong>地域・エリア</strong>設定</p>
                  </td>
                </tr>
            </table></td>
          </tr>
        </table>
        <br>
        <table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <td width="150" bgcolor="#EBEBEB" class="font14">
            		<div align="right"><strong>店舗名</strong></div>
            </td>
            <td bgcolor="#FFFFFF" class="font12">
            		<input name="name" type="text" id="name" value="<?php echo $tenpodata["name"];?>" size="40">
            </td>
          </tr>
          <tr>
            <td width="150" bgcolor="#EBEBEB" class="font14">
              <div align="right"><strong>店舗所在地</strong></div></td>
            <td bgcolor="#FFFFFF" class="font12"><input name="jyusyo" type="text" id="jyusyo" value="<?php echo $tenpodata["jyusyo"];?>" size="40">
            </td>
          </tr>
        </table>
    </TD>
  </TR>
  <TR class="realestate_bgcolor2">
    <TD valign="top">&nbsp;</TD>
  </TR>
  <TR class="realestate_bgcolor2">
    <TD valign="top"><input name="up_tenpo" type="submit" id="up_tenpo" value="更新する"></TD>
  </TR>
</form></TABLE>
