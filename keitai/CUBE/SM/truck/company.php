<?php 

//redefine Admin_Staff Class
class AdminCompany2  extends Admin_Company{
			function AdditionData($data){
				$db=$this->dbobj;
				$bname=$this->bname;
				$db=$this->dbobj;
				$bname=$this->bname;
				for($i=0;$data["new_view_chk"][$i]!=NULL;$i++) {
				$maxid=$db->GetMaxId($bname."_data","data_id");
				unset($field,$tdata);			
					//echo $data["new_view_chk"];
					$setdata=$this->LoadSet();
		
					$field[]="data_id";
					$field[]="data_name";
					$field[]="data_comm";
					$field[]="cate_id";
					$field[]="view_chk";
					$tdata[]=$maxid;
					$tdata[]="'".$data["new_data_name"][$i]."'";
					$tdata[]="'".$data["new_data_comm"][$i]."'";
					$tdata[]=1;
					$tdata[]=1;
					$field[]="turn";
					$tdata[]=$maxid;
		
					if($data["url"]!=NULL&&$data["url"]!="") {
						$field[]="url";
						$tdata[]="'".$data["url"]."'";
					}			
				
					$db->Insert($bname."_data",$field,$tdata);
					$data["data_id"]=$maxid;
				}	
				$db->Query("update lastupdate set lastupdate=".time()."");
				return $maxid;
			}
}

$ad_company=new AdminCompany2($dbobj);
$ad_staff=new Admin_Staff($dbobj);

$_GET["cate_id"]=1;
if($_REQUEST["mode"]=="delete"&&$_REQUEST["editstaffid"]!=NULL) {
	$ad_staff->DeleteOneData($_REQUEST["editstaffid"]);
	$_REQUEST["btm_update"]="更新する";
}

if($_REQUEST["btm_update"]=="更新する"||$_REQUEST["mode"]=="saveandstaffreg"||$_REQUEST["mode"]=="saveandstaffup"||$_REQUEST["btm_update"]=="項目追加") {

	$ad_staff->UpdateDataList($_POST);
	
	for($i=0;$_REQUEST["data_id"][$i]!=NULL;$i++) {
		if($_REQUEST["view_chk"][$i]==NULL) {
			$_REQUEST["view_chk"][$i]=0;
		}
	}
	
	$ad_company->UpdateData($_REQUEST);
	$ad_company->AdditionData($_REQUEST);
	$ad_company->DeleteData($_REQUEST);
	$upsql="update tenpo_data set ";
	
	@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/tenpo_data/");
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/tenpo_data/",0777);
	$imgobj=new Upload();

	$imgobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/tenpo_data/";
	$imgobj->rpath="/tmp/tenpo_data/";
	$imagefile1=$imgobj->UpImgAndResize("imagefile1",300,0);
	
	if($imagefile1["filepath"]!=NULL||$_REQUEST["delimage1"]==1){
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		
			if($imagefile1["filepath"]!=NULL) {
			
				@chmod($imagefile1["filepath"],0777);
		if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
					$ftp->MkDir("tmp","tenpo_data");
					$ftp->UpData("tmp/tenpo_data/",$imagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/tenpo_data/".$imagefile1["name"],"b");
				}
				$upsql.="tenpophoto='".$imagefile1["filepath"]."',";
			}
			else if($setdata["listimg_defalt"]!=NULL){
				if($_REQUEST["delimage1"]==1) {
				$upsql.="tenpophoto=null,";

				}
			}
			else if($_REQUEST["delimage1"]==1) {
				$upsql.="tenpophoto=null,";
			}
	}
	
	$imgobj=new Upload();
	$imgobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/tenpo_data/";
	$imgobj->rpath="/tmp/tenpo_data/";

	$imagefile2=$imgobj->UpImgAndResize("imagefile2",300,0);
	
	if($imagefile2["filepath"]!=NULL||$_REQUEST["delimage2"]==1){
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		
			if($imagefile2["filepath"]!=NULL) {
			
				@chmod($imagefile2["filepath"],0777);
		if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
					$ftp->MkDir("tmp","tenpo_data");
					$ftp->UpData("tmp/tenpo_data/",$imagefile2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/tenpo_data/".$imagefile2["name"],"b");
				}
				$upsql.="goaisatsuphoto='".$imagefile2["filepath"]."',";
			}
			else if($setdata["listimg_defalt"]!=NULL){
				if($_REQUEST["delimage2"]==1) {
				$upsql.="goaisatsuphoto=null,";

				}
			}
			else if($_REQUEST["delimage2"]==1) {
				$upsql.="goaisatsuphoto=null,";
			}
	}
	
	$upsql.=" goaisatsu = '".$_REQUEST["goaisatsu"]."'";
	$dbobj->Query($upsql);
	
	if($_REQUEST["mode"]=="saveandstaffreg"){
	?>
	<script language="javascript">
	location.replace('?PID=staff_d_add&cate_id=1');
	</script>
	<?php
	}
	
	if($_REQUEST["mode"]=="saveandstaffup"){
	?>
	<script language="javascript">
	location.replace('?PID=staff_d_up&data_id=<?php echo $_REQUEST["editstaffid"] ?>');
	</script>
	<?php
	}
}

$nowdata=$ad_company->GetDataIdList(1,$orderby);
$tenpodata=$dbobj->GetData("select * from tenpo_data");
//print_r($comcatesep);
?>

<script language="javascript">
addcounter=0;
function companycontentsadd()	{
var nowdata=document.getElementById("addfield").innerHTML;
document.getElementById("addfield").innerHTML=nowdata+'<table width="695" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">'+
'     <tr>'+
'        <td width="43" align="left" valign="top" bgcolor="#FFFFFF">&nbsp;</td>'+
'        <td width="43" align="left" valign="top" bgcolor="#FFFFFF">'+
'            <input name="new_view_chk['+addcounter+']" type="hidden" id="new_view_chk['+addcounter+']" value="1" />'+
'        </td>'+
'        <td width="188" align="left" valign="top" bgcolor="#FFFFFF">'+
'            <textarea name="new_data_name['+addcounter+']" rows="4" wrap="off" id="new_data_name['+addcounter+']" style="width:98%;"></textarea>'+
'        </td>'+
'        <td width="392" align="left" valign="top" bgcolor="#FFFFFF">'+
'            <textarea name="new_data_comm['+addcounter+']" cols="50" rows="4" wrap="off" id="new_data_comm['+addcounter+']" style="width:98%;"></textarea>'+
'        </td>'+
'    </tr>'+
'</table>';
addcounter+=1;
}
</script>

<script language="javascript">
function movestaffreg(id) {
//var res=confirm("変更した内容を保存しますか？");
//	if(res) {
		document.form1.mode.value="saveandstaffreg";
		document.form1.submit();
/*	}
	else {
		location.href='?PID=staff_d_add&cate_id='+id;
	}
	*/	
}
function delchk(name,id) {
	var res=confirm(name+"を削除してもよろしいですか？");
	
	if(res) {
		document.form1.mode.value="delete";
		document.form1.editstaffid.value=id;
		document.form1.submit();
	}
	
}
function movestaffup(id) {
//var res=confirm("変更した内容を保存しますか？");
	//if(res) {
		document.form1.mode.value="saveandstaffup";
		document.form1.editstaffid.value=id;
		document.form1.submit();
/*	}
	else {
		location.href='?PID=staff_d_up&data_id='+id; 
	}
	*/	
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<table width="800" border="0" align="left" cellpadding="0" cellspacing="0">
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
   <tr>
   		<td height="15">
   				<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
   						<tr>
   								<td colspan="2" bgcolor="#ececec"><strong>会社概要</strong></td>
   								</tr>
   						<tr>
   								<td width="79" align="center" valign="top" bgcolor="#FFFFFF">
   										<div align="center">
   												<table width="100%" border="0" cellspacing="5" cellpadding="5">
   														<tr>
   																<td><img src="img/re/compinimg3.jpg" width="70" height="86"></td>
   																</tr>
   														</table>
   												</div>
   										</td>
   								<td width="706" bgcolor="#FFFFFF">
   										<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
   												<tr>
   														<td height="15"> 
   																<table width="695" border="0" cellpadding="3" cellspacing="1">
   																		
   																		
   																		<tr>
   																				<td width="43" align="left" valign="top" bgcolor="#FFFFFF">
   																						<div align="center"></div>
   																						</td>
   																				<td width="43" align="left" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
   																				<td width="189" align="left" valign="top" bgcolor="#FFFFFF">
   																						<div align="center"></div>
   																						</td>
   																				<td width="391" align="left" valign="top" bgcolor="#FFFFFF">
   																						<div align="left"class="helper">
   																								<table width="100%" border="0" cellspacing="1" cellpadding="3">
   																										<tr>
   																												<th bgcolor="#CCCCCC">※事業所の地図を表示出来る様にするには</th>
   																												</tr>
   																										<tr>
   																												<td bgcolor="#FFFFFF">
   																														<input name="textfield" type="text" value="&lt;map&gt;この部分に住所を入力してください。&lt;/map&gt;" style="width:98%;">
   																														上のテキストをコピーし<font color="#FF0000">赤字</font>の部分に所在地を入力して下さい。<br>
   																														例：&lt;map&gt;山口県岩国市今津町&lt;/map&gt; </td>
   																												</tr>
   																										</table>
   																								</div>
   																						<div align="center"><img src="img/downcursor.jpg" width="49" height="31"></div>
   																						</td>
   																				</tr>
   																		</table>
   																<table width="695" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
   																		<tr>
   																				<th align="left" valign="top" nowrap="nowrap" bgcolor="#ECECEC"><div align="center">削除</div></th>
   																				<th align="left" valign="top" nowrap bgcolor="#ECECEC"><div align="center">公開</div></th>
   																				<th align="left" valign="top" bgcolor="#ECECEC">項目名</th>
   																				<th align="left" valign="top" bgcolor="#ECECEC">内容</th>
   																				</tr>
   																		<?php 
			for($datanum=0;$nowdata[$datanum];$datanum++) {
			?>
   																		<tr>
   																				<td width="43" align="left" valign="top" bgcolor="#FFFFFF">
   																						<div align="center">
   																								<input name="delchk[]" type="checkbox" id="delchk[]" value="<?php echo $nowdata[$datanum]["data_id"] ?>" />
   																								<input name="data_id[<?php echo $datanum ?>]" type="hidden" id="data_id[<?php echo $datanum ?>]"  value="<?php echo $nowdata[$datanum]["data_id"] ?>"/>
 																								</div></td>
   																				<td width="43" align="left" valign="top" bgcolor="#FFFFFF">
   																						<div align="center">
   																								<input type="checkbox"  name="view_chk[<?php echo $datanum ?>]" id="view_chk[<?php echo $datanum ?>]" value="1"<?php if($nowdata[$datanum]["view_chk"]==1) { ?> checked<?php }?>>                                      
 																								</div></td>
   																				<td width="189" align="left" valign="top" bgcolor="#FFFFFF">
   																						<div align="center">
   																								<textarea name="data_name[<?php echo $datanum ?>]" rows="4" wrap="off" id="data_name[<?php echo $datanum ?>]" style="width:98%;"><?php echo $nowdata[$datanum]["data_name"] ?></textarea>
   																								</div>
   																						</td>
   																				<td width="391" align="left" valign="top" bgcolor="#FFFFFF">
   																						<div align="center">
   																								<textarea name="data_comm[<?php echo $datanum ?>]" rows="4" wrap="off" id="data_comm[<?php echo $datanum ?>]" style="width:98%;"><?php echo $nowdata[$datanum]["data_comm"] ?></textarea>
   																								<br />
   																								</div>
   																						</td>
   																				</tr>
   																		<?php
		}
		?>
 																		</table>                                </td>
   														</tr>
   												<tr>
   														<td height="15">	<div id="addfield"></div></td>
   														</tr>
   												<tr>
   														<td height="15"><table width="100%" border="0" cellspacing="1" cellpadding="1">
   																
   																<tr>
   																		<td>
   																				<input name="btm_update" type="button" id="btm_update" value="項目追加"  onClick="companycontentsadd()"/>
   																				<input name="btm_update" type="submit" id="btm_update" value="更新する" />
   																				</td>
   																		</tr>
   																</table>                            
   																</td>
   														</tr>
   												</table>
   										</td>
   								</tr>
   						</table>
   				</td>
   		</tr>
    <tr>
      <td height="15" align="left">
          <br>
          <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
              <tr>
                  <td colspan="2" valign="top" bgcolor="#ECECEC"><strong>会社概要写真</strong></td>
            </tr>
              <tr>
                  <td width="78" rowspan="2" valign="top" bgcolor="#FFFFFF">
                      <div align="center">
                          <table width="100%" border="0" cellspacing="5" cellpadding="5">
                              <tr>
                                  <td><img src="img/re/compinimg4.jpg" width="70" height="86"></td>
                              </tr>
                          </table>
                      </div>
                  </td>
                  <td width="707" bgcolor="#FFFFFF">
                      <?php if($tenpodata["tenpophoto"]!=NULL){?>
                      <img src="http://<?php echo $_SESSION["DomainData"]["domain_name"].$tenpodata["tenpophoto"]."?".time(); ?>"> <br>
                      <input name="delimage1" type="checkbox" id="delimage1" value="1">
                      <label for="delimage1">この写真を削除する</label>
                      <?php }?>
                  </td>
              </tr>
              <tr>
                  <td bgcolor="#FFFFFF">
                      <input name="imagefile1" type="file" id="imagefile1">
                  </td>
              </tr>
          </table>
      </td>
    </tr>
    <tr>
        <td height="15" align="left">&nbsp;</td>
    </tr>
    <tr>
        <td height="15" align="left">&nbsp;</td>
    </tr>
    <tr>
        <td height="15" align="left">&nbsp;</td>
    </tr>
    <tr>
      <td height="15" align="left">
            <input name="btm_update" type="submit" id="btm_update" value="更新する" />
            <input name="cate_id" type="hidden" value="1" />
            <input name="mode" type="hidden" id="mode">
      <input name="editstaffid" type="hidden" id="editstaffid"></td>
    </tr>
</form>
</table>
