<?php 
include_once("../../master/config.php");
include("../../FCKeditor/fckeditor.php");
include_once("../../class/db.php");
include_once("../../class/postgresql.php");
include_once("../../class/mysql.php");
include_once("../../class/files.php");
include_once("../../class/schedule.php");
include_once("../../class/calendar.php");
include_once("../../class/realestate.php");
include_once("../../class/upload.php");
include_once("../../class/news.php");
include_once("../../class/act.php");

if($_REQUEST["cate_id"]==NULL){
	$_REQUEST["cate_id"]=0;
}

$dbobj=Cube_DB :: UseDB($usedb);
$dbobj->name=$dbname;
$usedb="mysql";
//$dbport="5432";
$dbobj->user=$dbuser;
$dbobj->pass=$dbpass;
$dbobj->Connect();
$flobj=new Acts($dbobj);

$fldata=$flobj->Get_CateList2($_REQUEST["pare_id"]);
$fdata=$flobj->GetActList2($_REQUEST["cate_id"]);
$fcdata=$flobj->Get_CateData($_REQUEST["cate_id"]);
$fddata=$flobj->Get_ActDData($_REQUEST["cate_id"],$_REQUEST["act_id"],$_REQUEST["pare_id"]);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<title>社団法人　大竹青年会議所　活動予定・報告</title>
<link href="/style.css" rel="stylesheet" type="text/css">
<script language="javascript">
function photochange(num) {
	switch(num) {
		case 1:
			document.all("mainphoto").src=document.all("photo1").src;
			break;
		case 2:	
			document.all("mainphoto").src=document.all("photo2").src;
			break;
		case 3:	
			document.all("mainphoto").src=document.all("photo3").src;
			break;
		case 4:	
			document.all("mainphoto").src=document.all("photo4").src;
			break;
		case 5:	
			document.all("mainphoto").src=document.all("photo5").src;
			break;
		case 6:	
			document.all("mainphoto").src=document.all("photo6").src;
			break;
		case 7:	
			document.all("mainphoto").src=document.all("photo7").src;
			break;
		case 8:	
			document.all("mainphoto").src=document.all("photo8").src;
			break;
		case 9:	
			document.all("mainphoto").src=document.all("photo9").src;
			break;
	}
}
</script>
<style>
.fontlhchange {
	line-height:18px;
}
#topics_menu a{
	color: #2476da;
	text-decoration: none;		
}
</style>
</head>
<body link="#0033FF" vlink="#000099">
<a name="top"></a>
<table width="760" border="0" align="center" cellpadding="5" cellspacing="0">
	<tr>
		<td>
			<table width="760" height="79" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td align="left" valign="bottom" background="/img/header_new.jpg">
						<table width="89" height="55" border="0" cellpadding="0" cellspacing="0" >
							<tr>
								<td align="center">
									<script language="javascript" src="/logo.js"></script>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr> </tr>
	<tr>
		<td>
			<table border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td valign="top">
						<table border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td>
									<script language="javascript" src="/indexswf.js"></script>
								</td>
							</tr>
							<tr>
								<td align="left" valign="top">
									<table width="140" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td><img src="/img/bar_menu.jpg" width="140" height="29"></td>
										</tr>
										<tr>
											<td align="left" valign="top">
												<table border="0" align="center" cellpadding="3" cellspacing="0">
													<tr>
														<td align="left"><a href="?pare_id=3"><img src="/img/act/bar_2_teirei_on.jpg" width="132" height="25" border="0"></a></td>
													</tr>
													<tr>
														<td align="left"><a href="?pare_id=2&cate_id=2"><img src="/img/act/bar_2_block_on.jpg" width="132" height="25" border="0"></a></td>
													</tr>
													<tr>
														<td align="left"><a href="?pare_id=1&cate_id=1"><img src="/img/act/bar_2_fureai_on.jpg" width="132" height="25" border="0"></a></td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
									<table width="98%" border="0" align="center" cellpadding="2" cellspacing="2">
										<?php
							$flrows=0;
							while($fldata[$flrows]["cate_id"]!=NULL) {
							?>
										<tr>
											<td width="10" align="left">&nbsp;</td>
											<td align="left">
												<?php 
					  $counum=$flobj->CateSumCount($fldata[$flrows]["cate_id"]);
					  if($counum["ccate_id"]==0) {
					  	?>
												<?php echo $fldata[$flrows]["cate_name"];?>
												<?php
					  }
					  else {
					  ?>
												<a href="?cate_id=<?php echo $fldata[$flrows]["cate_id"];?>&pare_id=<?php echo $_REQUEST["pare_id"];?>"><?php echo $fldata[$flrows]["cate_name"];?></a>
												<?php 
					  }
					  ?>
											</td>
										</tr>
										<?php 
					$flrows++;
				}
				?>
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td width="10">&nbsp;</td>
					<td valign="top">
						<table border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td><img src="/img/bar_headline.jpg" width="448" height="29"></td>
							</tr>
							<tr>
								<td align="center" valign="top">
									<br>
									<?php
					if($fddata["act_id"]!=NULL){ 
					 ?>
									<table width="100%" border="0" cellpadding="0" cellspacing="0">
											<tr>
													<td height="30" align="left" bgcolor="#CCCCCC"><font size="4"><strong><?php echo $fddata["act_name"]?> </strong></font></td>
											</tr>
											<tr>
													<td>&nbsp;</td>
											</tr>
											<tr>
													<td id="base" >
															<div align="left" class="fontlhchange"><?php echo nl2br($fddata["comm"]);?></div>
													</td>
											</tr>
									</table>
									<?php if($fddata["act_path"]!=NULL) {?>
									<table width="100%" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td align="center"><img src="<?php echo $fddata["act_path"]?>" name="mainphoto" width="400" id="mainphoto"></td>
										</tr>
									</table>
									<br>
									<table width="400"  border="0" align="center" cellpadding="3" cellspacing="3">
										<tr align="center" valign="top">
											<td width="33%"><a href="javascript:void(0)" onClick="photochange(1)"><img src="<?php echo $fddata["act_path"]?>" name="photo1" width="100" border="0" id="photo1"></a></td>
											<td width="33%">
												<?php if($fddata["photo2"]!=NULL){?>
												<a href="javascript:void(0)" onClick="photochange(2)"><img src="<?php echo $fddata["photo2"]?>" name="photo2" width="100" border="0" id="photo2"></a>
												<?php }?>
											</td>
											<td width="33%">
												<?php if($fddata["photo3"]!=NULL){?>
												<a href="javascript:void(0)" onClick="photochange(3)"><img src="<?php echo $fddata["photo3"]?>" name="photo3" width="100" border="0" id="photo3"></a>
												<?php }?>
											</td>
										</tr>
										<tr align="center" valign="top">
											<td>
												<?php if($fddata["photo4"]!=NULL){?>
												<a href="javascript:void(0)" onClick="photochange(4)"><img src="<?php echo $fddata["photo4"]?>" name="photo4" width="100" border="0" id="photo4"></a>
												<?php }?>
											</td>
											<td>
												<?php if($fddata["photo5"]!=NULL){?>
												<a href="javascript:void(0)" onClick="photochange(5)"><img src="<?php echo $fddata["photo5"]?>" name="photo5" width="100" border="0" id="photo5"></a>
												<?php }?>
											</td>
											<td>
												<?php 
							if($fddata["photo6"]!=NULL){
							?>
												<a href="javascript:void(0)" onClick="photochange(6)"><img src="<?php echo $fddata["photo6"]?>" name="photo6" width="100" border="0" id="photo6"></a>
												<?php 
							}
							?>
											</td>
										</tr>
										<tr align="center" valign="top">
											<td>
												<?php 
							if($fddata["photo7"]!=NULL){
							?>
												<a href="javascript:void(0)" onClick="photochange(7)"><img src="<?php echo $fddata["photo7"]?>" name="photo7" width="100" border="0" id="photo7"></a>
												<?php 
							}
							?>
											</td>
											<td>
												<?php 
							if($fddata["photo8"]!=NULL){
							?>
												<a href="javascript:void(0)" onClick="photochange(8)"><img src="<?php echo $fddata["photo8"]?>" name="photo8" width="100" border="0" id="photo8"></a>
												<?php 
							}
							?>
											</td>
											<td>
												<?php 
							if($fddata["photo9"]!=NULL){
							?>
												<a href="javascript:void(0)" onClick="photochange(9)"><img src="<?php echo $fddata["photo9"]?>" name="photo9" width="100" border="0" id="photo9"></a>
												<?php 
							}
							?>
											</td>
										</tr>
									</table>
																	<div align="left" class="fontlhchange"></div>		<?php }?><?php 
									}
									else {
									?>
									<img src="/img/henshuu.jpg" width="405" height="304">
									<?php
									}
									?>
								</td>
							</tr>
						</table>
					</td>
					<td>&nbsp;</td>
					<td valign="top">
						<table border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td><img src="/img/bar_topics.jpg" width="154" height="29"></td>
							</tr>
							<tr>
								<td align="center" valign="top">
									<table width="140" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td>&nbsp;</td>
										</tr>
									</table>
									<?php 
									$fdata=$flobj->GetActList($fddata["cate_id"]);
									$fcdata=$flobj->Get_CateData($fddata["cate_id"]);

									?>
									<table width="120" border="0" cellpadding="0" cellspacing="3" id="topics_menu">
										<tr>
											<td height="18" align="center"><font size="2"><?php echo $fcdata["cate_name"] ?></font></td>
										</tr>
										<?php
										

							if($fdata[0]["act_id"]!=NULL) {
							?>
										<tr>
											<td height="18" align="center">&nbsp;</td>
										</tr>
										<?php
										$frows=0; 
										while($fdata[$frows]["act_id"]!=NULL){
										?>
										<tr>
											<td align="center">
												<table width="95%"  border="0" cellspacing="0" cellpadding="2">
                                                	<tr>
                                                		<td align="left">
                                               			<a href="?cate_id=<?php echo $fdata[$frows]["cate_id"] ?>&act_id=<?php echo $fdata[$frows]["act_id"];?>&pare_id=<?php echo $_GET["pare_id"];?>">▼<?php echo $fdata[$frows]["act_name"] ?></a></td>
                                               		</tr>
                                                	<tr>
                                                		<td><a href="?cate_id=<?php echo $fdata[$frows]["cate_id"] ?>&act_id=<?php echo $fdata[$frows]["act_id"];?>&pare_id=<?php echo $_GET["pare_id"];?>"><img src="<?php echo $fdata[$frows]["act_path"] ?>" width="120" height="90" border="0"></a></td>
                                               		</tr>
                                               	</table>
											</td>
										</tr>
										<?php
											$frows++;
										}
										?>
										<tr>
											<td height="18" align="center">&nbsp;</td>
										</tr>
										<?php
										}
										?>
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
		<td>&nbsp; </td>
	</tr>
</table>
<table border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td align="center"><a href="#top"><img src="/img/parts_gototop.jpg" width="49" height="22" border="0"></a></td>
	</tr>
	<tr>
		<td><a href="/index.php"><img src="/img/footer.jpg" width="760" height="43" border="0"></a></td>
	</tr>
</table>
</body>
</html>
