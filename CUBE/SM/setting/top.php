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
			"sm_title='".$_REQUEST["sm_title"]."',".
			"gwpc_title='".$_REQUEST["gwpc_title"]."',".
			"gwkeitai_title='".$_REQUEST["gwkeitai_title"]."',";
			$tenpodata=$dbobj->GetData($tenposql);
	if($fudousanschk["use_chk"]!=1) {
		$imgobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."/logo/";
		$imgobj->rpath="/tmp/".$bname."_data/logo/";
		$imagefile1=$imgobj->UpImgAndResize("logo",$setdata["listimg_w"],$setdata["listimg_h"]);	
		$setdata["listimg_w"]=250;
		$setdata["listimg_h"]=0;
	}
	else {
				@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/tenpo_data/");
				@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/tenpo_data/",0777);
				$imgobj=new Upload();
				
				$imgobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/tenpo_data/";
				$imgobj->rpath="/tmp/tenpo_data/";
				$imagefile1=$imgobj->UpImgAndResize("header",620,70);
				
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
		}
	$imgobj=new Upload();
	$imgobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/tenpo_data/";
	$imgobj->rpath="/tmp/tenpo_data/";
	$imagefilef=$imgobj->UpImgAndResize("footer",768,50);

	if($imagefilef["filepath"]!=NULL||$_REQUEST["delfooter"]==1){
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		if($imagefilef["filepath"]!=NULL) {
			@chmod($imagefilef["filepath"],0777);
			if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp","tenpo_data");
				$ftp->UpData("tmp/tenpo_data/",$imagefilef["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/tenpo_data/".$imagefilef["name"],"b");
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

	$imagefile2=$imgobj->UpImgAndResize("topimage",550,308);
	
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
	$imagefile2=$imgobj2->UpImgAndResize("k_logo",250,0);	
	
			
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
<?php if(str_replace("www.","",$_SERVER["HTTP_HOST"])!="e-altus.com") {?>
function on_load() {
    //==================================================================
    // FCK Editor
    
    var oFCKeditor = new FCKeditor( 'maintenancemessage' );
    
    oFCKeditor.BasePath = '/fckeditor/';
    oFCKeditor.Width = '100%';
    oFCKeditor.Height = '400';
    oFCKeditor.ToolbarSet = 'Mymenu';
    
    oFCKeditor.ReplaceTextarea();
}
<?php
}
?>
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
                    <p><strong>各種設定</strong></p>
                  </td>
                </tr>
            </table></td>
          </tr>
        </table>
        <br>
								<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
								<?php
													if($fudousanschk["use_chk"]==1) { 

								?>
          <tr>
            <td width="200" bgcolor="#EBEBEB" class="font14">
            		  <div align="right"><strong>店舗名</strong></div>
            </td>
            <td bgcolor="#FFFFFF" class="font12">
            		<input name="name" type="text" id="name" value="<?php echo $tenpodata["name"];?>" size="40" style="width:98%;">
            </td>
          </tr>
          <tr>
            <td width="200" bgcolor="#EBEBEB" class="font14">
                <div align="right"><strong>店舗所在地</strong></div>
            </td>
            <td bgcolor="#FFFFFF" class="font12"><input name="jyusyo" type="text" id="jyusyo" value="<?php echo $tenpodata["jyusyo"];?>" size="40" style="width:98%;">
            </td>
          </tr>
          <tr>
              <td width="200" valign="top" bgcolor="#EBEBEB" class="font14">
                  <div align="right"><strong>免許番号</strong></div>
              </td>
              <td bgcolor="#FFFFFF" class="font12">
                  <input name="poptext1" type="text" id="poptext1" size="50" value="<?php echo $tenpodata["poptext1"];?>" style="width:98%;">
              </td>
          </tr>
          <tr>
              <td width="200" rowspan="3" valign="top" bgcolor="#EBEBEB" class="font14">
                  <div align="right"><strong>所属団体</strong></div>
              </td>
              <td bgcolor="#FFFFFF" class="font12">
                  <input name="poptext2" type="text" id="poptext2" size="50" value="<?php echo $tenpodata["poptext2"];?>" style="width:98%;">
              </td>
          </tr>
          <tr>
              <td bgcolor="#FFFFFF" class="font12">
                  <input name="poptext3" type="text" id="poptext3" size="50" value="<?php echo $tenpodata["poptext3"];?>" style="width:98%;">
              </td>
          </tr>
          <tr>
              <td bgcolor="#FFFFFF" class="font12">
                  <input name="poptext4" type="text" id="poptext4" size="50" value="<?php echo $tenpodata["poptext4"];?>" style="width:98%;">
              </td>
          </tr>
          
          <tr>
            <td width="200" bgcolor="#EBEBEB" class="font14">
              <div align="right" class="font14">
                  <div align="right"><strong>電話番号</strong></div>
              </div></td>
            <td bgcolor="#FFFFFF" class="font12">
              <input name="denwa" type="text" id="denwa" value="<?php echo $tenpodata["denwa"];?>" size="40" style="width:98%;">
            </td>
          </tr>
          <tr>
            <td width="200" bgcolor="#EBEBEB" class="font14">
              <div align="right" class="font14">
                  <div align="right"><strong>FAX番号</strong></div>
              </div></td>
            <td bgcolor="#FFFFFF" class="font12">
              <input name="fax" type="text" id="fax" value="<?php echo $tenpodata["fax"];?>" size="40" style="width:98%;">
            </td>
          </tr>
          <tr>
            <td width="200" bgcolor="#EBEBEB" class="font14">
            		  <div align="right"><strong>メールアドレス</strong></div>
            </td>
            <td bgcolor="#FFFFFF" class="font12"><input name="email" type="text" id="email" value="<?php echo $tenpodata["email"];?>" size="40" style="width:98%;"></td>
          </tr>
          
          <tr>
            <td width="200" bgcolor="#EBEBEB" class="font14">
            		  <div align="right"><strong>URL</strong></div>
            </td>
            <td bgcolor="#FFFFFF" class="font12">
                <input name="url" type="text" id="url" value="<?php echo $tenpodata["url"];?>" size="40" style="width:98%;">
            </td>
          </tr>
										<?php if(str_replace("www.","",$_SERVER["HTTP_HOST"])!="e-altus.com") {?>
										<?php
										if($fudousanschk["use_chk"]!=1) {
										?>
          <tr>
          		<td width="200" rowspan="2" valign="top" bgcolor="#EBEBEB" class="font14">
          				  <div align="right"><strong>PC用ロゴ<br>
          				        </strong><span class="font12">画像ｻｲｽﾞ<br>
          				            （横170px,縦60px） </span><br />
      				          </div>
          		</td>
          		<td bgcolor="#FFFFFF" class="font12"><?php 
							
							if($tenpodata["logo"]!=NULL) {
								echo "<img src=\"http://".$_SESSION["DomainData"]["domain_name"].$tenpodata["logo"]."\">";
								?>
									<br />
									<input name="dellogo" type="checkbox" id="dellogo" value="1" />
									削除する<?php
							}
							
							?></td>
          		</tr>
          <tr>
          		<td bgcolor="#FFFFFF" class="font12">
          				<input name="logo" type="file" id="logo" />
          				<br />
          		</td>
          		</tr>
          <tr>
          		<td width="200" valign="top" bgcolor="#EBEBEB" class="font14">
          				  <div align="right"><strong>PCヘッダーHTML</strong></div>
          		</td>
          		<td bgcolor="#FFFFFF" class="font12">
          				<textarea name="header" cols="50" rows="10"><?php echo $tenpodata["header"];?></textarea>
          		</td>
          		</tr>
												<?php
												}
												else {
												?>
          <tr>
              <td width="200" rowspan="2" valign="top" bgcolor="#EBEBEB" class="font14">
                  <div align="right"><strong>PC用ヘッダー画像</strong><span class="font12"><br>
                      画像ｻｲｽﾞ<br>
                      （横620px,縦70px） </span></div>
              </td>
              <td bgcolor="#FFFFFF" class="font12">
                  <?php 
							
							if($tenpodata["headerimage"]!=NULL) {
								echo "<img src=\"http://".$_SESSION["DomainData"]["domain_name"].$tenpodata["headerimage"]."?".time()."\">";
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
              <td width="200" rowspan="2" valign="top" bgcolor="#EBEBEB" class="font14">
                  <div align="right"><strong>PC用フッター画像<br>
                  </strong><span class="font12">画像ｻｲｽﾞ<br>
                      （横768px,縦50px） </span></div>
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
              <td width="200" rowspan="2" valign="top" bgcolor="#EBEBEB" class="font14">
                  <div align="right"><strong>PC用TOPページ画像</strong><span class="font12"><br>
                      画像ｻｲｽﾞ<br>
                      （横550px,縦308px） </span></div>
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
										<?php
										}
										?>
          <tr>
          		<td width="200" rowspan="2" valign="top" bgcolor="#EBEBEB" class="font14">
          				  <div align="right"><strong>携帯用ロゴ<br>
          				  </strong><span class="font12">画像ｻｲｽﾞ<br>
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
                <th width="200" align="left" nowrap bgcolor="#ECECEC">
                    <div align="right">管理ページタイトル</div>
                </th>
                <td align="left" bgcolor="#FFFFFF">
                    <input name="sm_title" type="text" id="sm_title" style="width:98%;" value="<?php echo $tenpodata["sm_title"] ?>">
                </td>
            </tr>
            <tr>
                <th width="200" align="left" nowrap bgcolor="#ECECEC">
                    <div align="right"><strong>グループウェアPC版タイトル</strong></div>
                </th>
                <td align="left" bgcolor="#FFFFFF">
                    <input name="gwpc_title" type="text" id="gwpc_title" style="width:98%;" value="<?php echo $tenpodata["gwpc_title"] ?>">
                </td>
            </tr>
            <tr>
                <th width="200" align="left" valign="top" nowrap bgcolor="#ECECEC">
                    <div align="right">グループウェア携帯版タイトル</div>
                </th>
                <td align="left" valign="top" bgcolor="#FFFFFF">
                    <input name="gwkeitai_title" type="text" id="gwkeitai_title" style="width:98%;" value="<?php echo $tenpodata["gwkeitai_title"] ?>">
                </td>
            </tr>
            
            <tr>
              <td width="200" valign="top" bgcolor="#EBEBEB" class="font14">
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
              <td width="200" valign="top" bgcolor="#EBEBEB" class="font14">
                  <div align="right"><strong>非公開中メッセージ：</strong></div>
              </td>
              <td bgcolor="#FFFFFF" class="font12">
                  <textarea name="maintenancemessage" cols="50" rows="10"><?php echo $tenpodata["maintenancemessage"];?></textarea>
              </td>
          </tr>
          <tr>
              <td width="200" valign="top" bgcolor="#EBEBEB" class="font14">
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
																						<?php
												}
												?>
												<?php 
										}
										?>
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