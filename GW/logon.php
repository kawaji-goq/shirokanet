<?php
header("Content-type: text/html; charset=euc-jp");

//$_SERVER["DOCUMENT_ROOT"] = "/home/xb658521/sougou-net.jp/public_html/";

session_start();
ini_set("display_errors",1);
mb_internal_encoding("euc-jp");
$path = '/tmp/CUBE/';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

include $_SERVER["DOCUMENT_ROOT"]."/CUBE/ITC/modules.php";
ini_set("display_errors",1);

if($_REQUEST["logout"]){
	unset($_SESSION["domain"]);
	?>
	<script language="JavaScript" type="text/javascript">
	location.replace("index.php");
	</script>
	<?php
}else if($_REQUEST["logout"]==1){
	unset($_SESSION);
	unset($_SESSION["login_id"],$_SESSION["login_pass"]);
	
	?>
	<script language="JavaScript" type="text/javascript">
	location.replace("index.php");
	</script>
	<?php
}

if($_REQUEST["domain"]!=NULL) {
	$_SESSION["domain"]=$_REQUEST["domain"];
}

if(str_replace("www.","",$_SERVER["HTTP_HOST"])=="siteadmin.itcube.ne.jp") {
	?>
	<script language="javascript">
	location.replace("http://siteadmin.itcube.ne.jp/?logout=1");
	</script>
	<?php
	exit();
}

$usedb="postgresql";
$adminobj=Cube_DB :: UseDB($usedb);
$adminobj->host="13.114.106.30";
$adminobj->name="itcube_admin";

$adminobj->Connect();

if(str_replace("www.","",$_SERVER["HTTP_HOST"])=="matsue.laut-japan.jp"){
	$domaindata=$adminobj->GetData("select * from domain where domain_name = 'matsue.laut-japan.com'");
}
else if(str_replace("www.","",$_SERVER["HTTP_HOST"])=="miyajima.laut-japan.jp"){
	$domaindata=$adminobj->GetData("select * from domain where domain_name = 'miyajima.laut-japan.com'");
}else if(str_replace("www.","",$_SERVER["HTTP_HOST"])=="koreanfoods.9141.jp"){
	$domaindata=$adminobj->GetData("select * from domain where domain_name = 'kf.goq.co.jp'");
}else if(str_replace("www.","",$_SERVER["HTTP_HOST"])=="sanko-sp.co.jp"){
	$domaindata=$adminobj->GetData("select * from domain where domain_name = 'stk.itcube.ne.jp'");
}
else if(str_replace("www.","",$_SERVER["HTTP_HOST"])=="e-altus.com"){
	$domaindata=$adminobj->GetData("select * from domain where domain_name = 'altus.itcube.ne.jp'");

}
else if(str_replace("www.","",$_SERVER["HTTP_HOST"])=="9141.jp")
{
	$domaindata=$adminobj->GetData("select * from domain where domain_name = 'ww2.9141.jp'");
}else if(str_replace("www.","",$_SERVER["HTTP_HOST"])=="n-build.com"){

	$domaindata=$adminobj->GetData("select * from domain where domain_name = 'n-build.com'");

}
else {
$domaindata=$adminobj->GetData("select * from domain where domain_name = '".str_replace("www.","",$_SERVER["HTTP_HOST"])."'");

}
$dbobj=Cube_DB :: UseDB("mysql");
$dbobj->host='mysql203.xbiz.ne.jp';
$dbobj->name="xb464987_shirokanetjp";
$dbobj->user="xb464987_shiroka";
$dbobj->pass="xrhHKXtm63hYRH";
$dbobj->charcode="euc-jp";

$dbobj->Connect();
$domobj=$dbobj;
//$domobj=Cube_DB :: UseDB($domaindata["dbtype"]);
//$domobj->name=$domaindata["dbname"];
//$domobj->Connect();
//echo $domaindata["dbname"];
//サイト作成者設定用ログイン

if($_GET["btm_login"]=="ログイン"&&$_GET["admin_id"]!=NULL&&$_GET["admin_pass"]!=NULL) {
	
	if($_GET["admin_id"]=="itcubes"&&$_GET["admin_pass"]=="itc7310") {
	
			$_SESSION["SU"]["login_id"]=md5($_GET["admin_id"]);
			$_SESSION["SU"]["login_pw"]=md5($_GET["admin_pass"]);
			
			$loginsql="select * from domain where domain_name ='itcube.jp'";
	
			$res=$adminobj->Query($loginsql);
			$resnum=$adminobj->NumRows($res);
			if($resnum!=0) {
				$data=$adminobj->FetchArray($res,0);
				$_SESSION["domain"]=$data["domain_name"];
				$_SESSION["DomainData"]=$data;
				?>
				<script language="JavaScript" type="text/javascript">
				location.replace("su/index.php");
				</script>
				exit();
				<?php
				
			}
			
	}
	else 
	{
		
		if($_GET["admin_id"]=="itcube"&&$_GET["admin_pass"]=="itc7310")
		{
			$loginsql="select * from login where domain ='".str_replace("www.","",$_SERVER['HTTP_HOST'])."'";
			$res=$adminobj->Query($loginsql);
				
				//print_r($res);
				//	exit();
			$resnum=$adminobj->NumRows($res);
			if($resnum!=0) {
				$data=$adminobj->FetchArray($res,0);
				//echo $data["login_type"];
						
				//	print_r($data);
				//	echo exit();
					switch($data["login_type"]) {
						case 20:
							
						$_SESSION["GW"]["domain"]=$data["domain"];
						$_SESSION["GW"]["login_id"]=$data["login_id"];
						$_SESSION["GW"]["login_pw"]=$data["login_pw"];
						//echo str_replace("www.","",$_SERVER['HTTP_HOST']);
						//	exit();
						if(str_replace("www.","",$_SERVER['HTTP_HOST'])=='matsue.laut-japan.jp') {
						$_SESSION["login_id"]=$data["login_id"];
						$_SESSION["login_pass"]=$data["login_pw"];
						?>
								<script language="JavaScript" type="text/javascript">
								location.replace("/SM/index.php");
								</script>
								<?php
								exit();
						}
						else{
						?>
						<script language="JavaScript" type="text/javascript">
						location.replace("index.php");
						</script>
						<?php
						exit();
						}
						break;
							
						case 10:
						
							$_SESSION["loginmode"]="webmaster";
						
							$_SESSION["login_id"]=$data["login_id"];
							$_SESSION["login_pass"]=$data["login_pw"];
							print_r($_SESSION);
							//exit();
							//echo $data["domain"];
							?>
							<script language="JavaScript" type="text/javascript">
							location.replace("/SM/index.php");
							</script>
							<?php
							exit();
							break;
					}
				}
		}
		else {
			
		 	$loginsql="select * from domain where id ='".$_GET["admin_id"]."' and pass='".$_GET["admin_pass"]."'";
			$res=$adminobj->Query($loginsql);
		 	$resnum=$adminobj->NumRows($res);
			
			if($resnum!=0) {
				$data=$adminobj->FetchArray($res,0);
				
				$_SESSION["domain"]=$data["domain_name"];
				
				?>
				<script language="JavaScript" type="text/javascript">
				location.replace("http://siteadmin.itcube.ne.jp/index.php");
				</script>
				<?php
				
			}
			else 
{
				$loginsql="select * from login where login_id ='".$_GET["admin_id"]."' and login_pw='".$_GET["admin_pass"]."'";
				$res=$adminobj->Query($loginsql);
					//print_r($res);
					//exit();
				$resnum=$adminobj->NumRows($res);
					//echo $resnum;
				if($resnum!=0) {
					$data=$adminobj->FetchArray($res,0);
				//	print_r($data);
					echo $data["login_type"];
					switch($data["login_type"]) {
						case 20:
						$_SESSION["GW"]["domain"]=$data["domain"];
							$_SESSION["GW"]["login_id"]=$data["login_id"];
							$_SESSION["GW"]["login_pw"]=$data["login_pw"];
							
							if(str_replace("www.","",trim($_SERVER['HTTP_HOST']))=='matsue.laut-japan.jp') {
								$_SESSION["login_id"]=$data["login_id"];
								$_SESSION["login_pass"]=$data["login_pw"];
								$_SESSION["domain"]=$data["domain"];
							?>
								<script language="JavaScript" type="text/javascript">
								location.replace("/SM/index.php");
								</script>
								<?php
							}
							else{
								$_SESSION["login_id"]=$data["login_id"];
								$_SESSION["login_pass"]=$data["login_pw"];
								$_SESSION["domain"]=$data["domain"];
							?>
							<script language="JavaScript" type="text/javascript">
								location.replace("index.php");
							</script>
							<?php
							}
							break;
						case 10:
						
							$_SESSION["login_id"]=$_GET["admin_id"];
							$_SESSION["login_pass"]=$_GET["admin_pass"];
							$_SESSION["domain"]=$data["domain"];
							?>
							<script language="JavaScript" type="text/javascript">
							 location.replace("/SM/index.php");
							</script>
							<?php
							
							break;				
					}
				}
			}
		}
	}	
}

if($_SESSION["domain"]!=NULL) {
unset($_SESSION["domain"]);
?>
<script language="JavaScript" type="text/javascript">
location.replace("index.php");
</script>
<?php
}
else {

}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<title>Site Manager2</title>
<style>
td{
text-align:left;
}
a{
text-decoration:none;
}
</style>
<?php
?>
<link href="gw/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div align="center"> <a name="top" id="top"></a></div>
<div align="center"> <a href="index.php"></a>
  <table border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td valign="bottom">
       <img src="/CUBE_IMG/loginheader.jpg" width="841" height="79" border="0" usemap="#Map">
        		<map name="Map" id="Map2">
        				<area shape="rect" coords="8,53,266,75" href="http://itcube.jp" target="_blank">
								<area shape="rect" coords="6,7,264,52" href="index.php">
						</map>
        		<map name="Map" id="Map">
          		<area shape="rect" coords="11,59,271,88" href="http://itcube.jp" target="_blank">
          <area shape="rect" coords="5,5,249,51" href="index.php">
          </map>

      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="400" valign="top">
          <table width="600" border="0" align="center" cellpadding="3" cellspacing="3">
        <form id="form1" name="form1" method="get" action="">
            <tr>
              <td width="283">&nbsp;</td>
              <td width="296">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2">
                <h3 align="center">ログイン</h3>
              </td>
            </tr>
												<?php
												if($_REQUEST["loginmode"]=="webmaster"){
												?>
												 <tr>
              <td>
                <div align="right">管理ID</div>
              </td>
              <td>
                  <input name="admin_id" type="text" id="admin_id" value="<?php echo $_REQUEST["admin_id"];?>" style="ime-mode:disabled;">
                  <input name="loginmode" type="hidden" id="loginmode" value="webmaster">
              </td>
            </tr>
												<?php
												
												}
												else {
												?>
            <tr>
              <td>
                <div align="right">管理ID</div>
              </td>
              <td>
                  <?php

                  $userlist=$domobj->GetList("select * from member order by turn");

                  ?>
              		<select name="admin_id">
								<?php 

								for($i=0;$userlist[$i]["member_id"]!=NULL;$i++) {
								?>
								<option value="<?php echo $userlist[$i]["login_id"];?>"<?php if($_REQUEST["admin_id"]==$userlist[$i]["login_id"]) { echo " selected";}?>><?php echo $userlist[$i]["member_name"];?></option>
								<?php
								}
								?>
                		</select>
              </td>
            </tr>
												<?php
												}
												?>
            <tr>
              <td>
                <div align="right">パスワード</div>
              </td>
              <td>
                <label>
                <input name="admin_pass" type="password" id="admin_pass" value="<?php echo $_REQUEST["admin_pass"];?>">
                </label>
                <input name="btm_login" type="hidden" id="btm_login" value="ログイン">
              </td>
            </tr>
            <tr>
              <td>
                <div align="right"></div>
              </td>
              <td>
                <input name="btm_login2" type="submit" id="btm_login2" value="ログイン">
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><a href="?loginmode=webmaster"><font color="#FFFFFF">管理者ログイン</font></a></td>
            </tr>
                </form>
          </table>
      </td>
    </tr>
    <tr>
      <td>&nbsp; </td>
    </tr>
    <tr>
      <td>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="35%" background="/image/temp/footer_bg.gif"><a href="http://itcube.jp" target="_blank"><img src="/CUBE_IMG/siteadmin/footer_itc_logo.gif" width="247" height="18" border="0"></a></td>
            <td width="65%" align="right" valign="bottom" background="/image/temp/footer_bg.gif">

            	<div align="right"></div>
            </td>
          </tr>
          <tr>
            <td colspan="2"></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</div>
</body>
</html>
