<?php
$bsetdata=$dbobj->GetData("select * from bukken_setting");
if($_REQUEST["up_tenpo"]=="更新する") {
	$imgobj=new Upload();
	$bname="bukken";
	$setdata["listimg_w"]=170;
	$setdata["listimg_h"]=59;
	
	@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."/");
	@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."/logo/");
	
	$upsql="update tenpo_data set ".
			"name='".$_REQUEST["name"]."',".
			"jyusyo='".$_REQUEST["jyusyo"]."',".
			"denwa='".$_REQUEST["denwa"]."',".
			"fax='".$_REQUEST["fax"]."',".
			"email='".$_REQUEST["email"]."',".
			"status=".$_REQUEST["status"].",".
			"maintenancemessage='".$_REQUEST["maintenancemessage"]."',".
			"poptext1='".$_REQUEST["poptext1"]."',".
			"poptext2='".$_REQUEST["poptext2"]."',".
			"poptext3='".$_REQUEST["poptext3"]."',".
			"poptext4='".$_REQUEST["poptext4"]."',".
			"pagetitle='".$_REQUEST["pagetitle"]."',".
			"headertext='".$_REQUEST["headertext"]."',";
			
				@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/tenpo_data/");
				@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/tenpo_data/",0777);
				$imgobj=new Upload();
				
				$imgobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/tenpo_data/";
				$imgobj->rpath="/tmp/tenpo_data/";
				$imagefile1=$imgobj->UpImgAndResize("header",855,84);
				
				if($imagefile1["filepath"]!=NULL||$_REQUEST["delimage1"]==1){
				$ftp=new Cube_FTP();
				$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
				
				if($imagefile1["filepath"]!=NULL) {
				
				@chmod($imagefile1["filepath"],0777);
				if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp","tenpo_data");
				$ftp->UpData("tmp/tenpo_data/",$imagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/tenpo_data/".$imagefile1["name"],"b");
				}
				$upsql.="headerimage='".$imagefile1["filepath"]."',";
				}
				else if($setdata["listimg_defalt"]!=NULL){
				if($_REQUEST["delimage1"]==1) {
				$upsql.="headerimage=null,";
				
				}
				}
				else if($_REQUEST["delimage1"]==1) {
				$upsql.="headerimage=null,";
				}
	$imgobj=new Upload();
	$imgobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/tenpo_data/";
	$imgobj->rpath="/tmp/tenpo_data/";
	$imagefilef=$imgobj->UpImgAndResize("footer",855,35);

	if($imagefilef["filepath"]!=NULL||$_REQUEST["delfooter"]==1){
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		if($imagefilef["filepath"]!=NULL) {
			@chmod($imagefilef["filepath"],0777);
			if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp","tenpo_data");
				$ftp->UpData("tmp/tenpo_data/",$imagefilef["name"],"./tmp/tenpo_data/".$imagefilef["name"],"b");
			}
			$upsql.="footerimage='".$imagefilef["filepath"]."',";
		}
		else if($setdata["listimg_defalt"]!=NULL){
			if($_REQUEST["delfooter"]==1) {
				$upsql.="footerimage=null,";
			}
		}
		else if($_REQUEST["delfooter"]==1) {
			$upsql.="footerimage=null,";
		}
	}
	}
	$imgobj=new Upload();
	$imgobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/tenpo_data/";
	$imgobj->rpath="/tmp/tenpo_data/";

	$imagefile2=$imgobj->UpImgAndResize("topimage",640,300);
	
	if($imagefile2["filepath"]!=NULL||$_REQUEST["delimage2"]==1){
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
	
		if($imagefile2["filepath"]!=NULL) {
		
			@chmod($imagefile2["filepath"],0777);
			if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp","tenpo_data");
				$ftp->UpData("tmp/tenpo_data/",$imagefile2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/tenpo_data/".$imagefile2["name"],"b");
			}
		$upsql.="topimage='".$imagefile2["filepath"]."',";
		}
		else if($setdata["listimg_defalt"]!=NULL){
		if($_REQUEST["delimage2"]==1) {
		$upsql.="topimage=null,";
		
		}
	}
	else if($_REQUEST["delimage2"]==1) {
		$upsql.="topimage=null,";
	}
}
	
	//携帯
	$imgobj2=new Upload();
	$imgobj2->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."/logo/";
	$imgobj2->rpath="/tmp/".$bname."_data/logo/";
	$imagefile2=$imgobj2->UpImgAndResize("k_logo",$setdata["listimg_w"],$setdata["listimg_h"]);	
	
			
	if($imagefile1["filepath"]!=NULL||$_REQUEST["dellogo"]==1){
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		
			if($imagefile1["filepath"]!=NULL) {
				@chmod($imagefile1["filepath"],0777);
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data","logo");
				$ftp->UpData("tmp/".$bname."_data/logo/",$imagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."/logo/".$imagefile1["name"],"b");
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
				$ftp->UpData("tmp/".$bname."_data/logo/",$imagefile2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."/logo/".$imagefile2["name"],"b");
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
$bsetdata=$dbobj->GetData("select * from bukken_setting");
$tenpodata=$dbobj->GetData("select * from tenpo_data");
?>
<script type="text/javascript" src="/fckeditor/fckeditor.js"></script>

<script type="text/javascript">
<!--

function on_load() {
    //==================================================================
    // FCK Editor
    
    var oFCKeditor = new FCKeditor( 'maintenancemessage' );
    
    oFCKeditor.BasePath = '/fckeditor/';
    oFCKeditor.Width = '400';
    oFCKeditor.Height = '400';
    oFCKeditor.ToolbarSet = 'Mymenu';
    
    oFCKeditor.ReplaceTextarea();
}

// -->

</script>

<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<TABLE width="800"  border="0" align="left" cellpadding="3" cellspacing="1" class="realestate_bgcolor1">
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
                    <p><strong>店舗情報更新</strong></p></td>
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
            		<input name="name" type="text" id="name" value="<?php echo $tenpodata["name"];?>" size="40" style="width:98%;">
            </td>
          </tr>
          <tr>
            <td width="150" bgcolor="#EBEBEB" class="font14">
              <div align="right"><strong>店舗所在地</strong></div></td>
            <td bgcolor="#FFFFFF" class="font12"><input name="jyusyo" type="text" id="jyusyo" value="<?php echo $tenpodata["jyusyo"];?>" size="40" style="width:98%;">
            </td>
          </tr>
          
          <tr>
            <td width="150" bgcolor="#EBEBEB" class="font14">
              <div align="right" class="font14"><strong>電話番号</strong></div></td>
            <td bgcolor="#FFFFFF" class="font12">
                <input name="denwa" type="text" id="denwa" value="<?php echo $tenpodata["denwa"];?>" size="40" style="width:98%;">
            </td>
          </tr>
          <tr>
            <td width="150" bgcolor="#EBEBEB" class="font14">
              <div align="right" class="font14"><strong>FAX番号</strong></div></td>
            <td bgcolor="#FFFFFF" class="font12">
                <input name="fax" type="text" id="fax" value="<?php echo $tenpodata["fax"];?>" size="40" style="width:98%;">
            </td>
          </tr>
          <tr>
            <td width="150" bgcolor="#EBEBEB" class="font14">
            		<div align="right"><strong>メールアドレス</strong></div></td>
            <td bgcolor="#FFFFFF" class="font12"><input name="email" type="text" id="email" value="<?php echo $tenpodata["email"];?>" size="40" style="width:98%;"></td>
          </tr>
          
          <tr>
              <td bgcolor="#EBEBEB" class="font14">
                  <div align="right"><strong>URL</strong></div>
              </td>
              <td bgcolor="#FFFFFF" class="font12">
                  <input name="url" type="text" id="url" value="<?php echo $tenpodata["url"];?>" size="40" style="width:98%;">
              </td>
          </tr>
          <tr>
              <td bgcolor="#EBEBEB" class="font14">
                  <div align="right"><strong>ページタイトル</strong></div>
              </td>
              <td bgcolor="#FFFFFF" class="font12">
                  <input name="pagetitle" type="text" id="pagetitle" value="<?php echo $tenpodata["pagetitle"];?>" size="40" style="width:98%;">
              </td>
          </tr>
          <tr>
            <td width="150" bgcolor="#EBEBEB" class="font14">
            		<div align="right"><strong>ヘッダーテキスト</strong></div>
            </td>
            <td bgcolor="#FFFFFF" class="font12">
                <input name="headertext" type="text" id="headertext" value="<?php echo $tenpodata["headertext"];?>" size="40" style="width:98%;">
            </td>
          </tr>

          <tr>
              <td rowspan="2" valign="top" bgcolor="#EBEBEB" class="font14">
                  <div align="right"><strong>PC用ヘッダー画像</strong></div><div align="right"><span class="font12">画像ｻｲｽﾞ<br>
                      （横855px,縦84px） </span></div>
              </td>
              <td bgcolor="#FFFFFF" class="font12">
                  <?php 
							
							if($tenpodata["headerimage"]!=NULL) {
								echo "<img src=\"http://".$_SESSION["DomainData"]["domain_name"].$tenpodata["headerimage"]."?".time()."\" width=\"620\">";
								?>
                  <br />
                  <input name="delimage1" type="checkbox" id="delimage1" value="1" />
削除する
<?php
							}
							
							?>
              </td>
          </tr>
          <tr>
              <td bgcolor="#FFFFFF" class="font12">
                  <input name="header" type="file" id="header" />
              </td>
          </tr>          <tr>
              <td rowspan="2" valign="top" bgcolor="#EBEBEB" class="font14">
                  <div align="right"><strong>PC用フッター画像</strong></div>
                  <div align="right"><span class="font12">画像ｻｲｽﾞ<br>
                      （横855,縦35px） </span></div>
              </td>
              <td bgcolor="#FFFFFF" class="font12">
                  <?php 
							
							if($tenpodata["footerimage"]!=NULL) {
								echo "<img src=\"http://".$_SESSION["DomainData"]["domain_name"].$tenpodata["footerimage"]."?".time()."\" width=\"620\">";
								?>
                  <br />
                  <input name="delfooter" type="checkbox" id="delfooter" value="1" />
削除する
<?php
							}
							
							?>
              </td>
          </tr>
          <tr>
              <td bgcolor="#FFFFFF" class="font12">
                  <input name="footer" type="file" id="footer" />
              </td>
          </tr>

          <tr>
              <td rowspan="2" valign="top" bgcolor="#EBEBEB" class="font14">
                  <div align="right"><strong>PC用TOPページ画像</strong></div>  
                  <div align="right"><span class="font12">画像ｻｲｽﾞ<br>
                      （横640px,縦300px） </span></div>
              </td>
              <td bgcolor="#FFFFFF" class="font12">
                  <?php 
							
							if($tenpodata["topimage"]!=NULL) {
								echo "<img src=\"http://".$_SESSION["DomainData"]["domain_name"].$tenpodata["topimage"]."?".time()."\">";
								?>
                  <br />
                  <input name="delimage2" type="checkbox" id="delimage2" value="1" />
削除する
<?php
							}
							
							?>
</td>
          </tr>
          <tr>
              <td bgcolor="#FFFFFF" class="font12">
                  <input name="topimage" type="file" id="topimage" />
              </td>
          </tr>
          <tr>
          		<td rowspan="2" valign="top" bgcolor="#EBEBEB" class="font14">
          				<div align="right"><strong>携帯用ロゴ</strong></div>
          		  <div align="right"><span class="font12">画像ｻｲｽﾞ<br>
          		      （横250px） </span></div>
          		</td>
          		<td bgcolor="#FFFFFF" class="font12">
          				<?php 
							
							if($tenpodata["k_logo"]!=NULL) {
								echo "<img src=\"http://".$_SESSION["DomainData"]["domain_name"].$tenpodata["k_logo"]."\">";
														?>
          				<br />
          				<input name="delk_logo" type="checkbox" id="delk_logo" value="1" />
削除する
<?php
							}
							
							?>
          		</td>
          		</tr>
          <tr>
          		<td bgcolor="#FFFFFF" class="font12">
          				<input name="k_logo" type="file" id="k_logo" />
          		</td>
          		</tr>
          <tr>
              <td valign="top" bgcolor="#EBEBEB" class="font14">
                  <div align="right"><strong>ホームページ公開：</strong></div>
              </td>
              <td bgcolor="#FFFFFF" class="font12">
                  <select name="status">
                      <option value="0"<?php if($tenpodata["status"]==0||$tenpodate["status"]==NULL) { echo " selected";}?>>公開</option>
                      <option value="1"<?php if($tenpodata["status"]==1) { echo " selected";}?>>非公開</option>
                  </select>
                  </td>
          </tr>
          <tr>
              <td valign="top" bgcolor="#EBEBEB" class="font14">
                  <div align="right"><strong>非公開中メッセージ：</strong></div>
              </td>
              <td bgcolor="#FFFFFF" class="font12">
                  <textarea name="maintenancemessage" cols="50" rows="10"><?php echo $tenpodata["maintenancemessage"];?></textarea>
              </td>
          </tr>
          <tr>
              <td valign="top" bgcolor="#EBEBEB" class="font14">
                  <div align="right"><strong>メンテナンス中　<br>
                      ページ閲覧URL：</strong></div>
              </td>
              <td bgcolor="#FFFFFF" class="font12"><a href="http://<?php echo $_SESSION["DomainData"]["domain_name"];?>/?key=<?php 
														$keydata=$dbobj->GetData("select * from member where member_id= 0");
														echo $keydata["login_pw"];
														
														?>" target="_blank">http://<?php echo $_SESSION["DomainData"]["domain_name"];?>/?key=<?php 
														$keydata=$dbobj->GetData("select * from member where member_id= 0");
														echo $keydata["login_pw"];
														
														?>
              </a></td>
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
<script type="text/javascript">
on_load();
</script>