<style>
.vuptitle{
	font-size:16px;
	color:#333333;
	font-weight:bold;
}
</style>
<?php
if($_REQUEST["PAGE"]==NULL) {
	$_REQUEST["PAGE"]=1;
}
$offset=($_REQUEST["PAGE"]-1)*30;
if($_REQUEST["vup_id"]==NULL) {
	?>
	<script language="javascript">
	location.replace("?PID=vup");
	</script>
	<?php
}
$vupdata=$adminobj->GetData("select * from vup_data where view_chk =1  and vup_id = ".$_REQUEST["vup_id"]);

?><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
		<tr>
				<td width="" background="http://siteadmin.itcube.ne.jp/img/0707icon/c1.jpg"><strong>&nbsp;<img src="http://siteadmin.itcube.ne.jp/sm/img/<?php 
				if($vupdata["cate_id"]==1) {echo "infofromitcube.jpg";}else if($vupdata["cate_id"]==2) {echo "versionoup.jpg";}?>" width="221" height="65"></strong></td>
		</tr>
		<tr>
				<td>
						<table width="700" border="0" align="left" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF"><?php
								if($vupdata["image"]!=NULL) {
								?>
								<?php
								}
								?>
								<tr>
										<td height="300" valign="top">
												<table width="700" border="0" align="center" cellpadding="2" cellspacing="2" bgcolor="#FFFFFF">
														<tr>
																<td colspan="2">&nbsp;</td>
														</tr>
														<tr>
																<td height="30" class="vuptitle"><?php echo $vupdata["title"]?>&nbsp;</td>
																<td valign="bottom">
																		<div align="right"></div>
																</td>
														</tr>
														<tr>
																<td colspan="2"><a href="index.php?PID=vup_d"></a><?php echo $vupdata["comm"]?></td>
														</tr>
														<?php
								if($vupdata["image"]!=NULL) {
								?>
														<tr>
																<td colspan="2"><img src="<?php echo $vupdata["image"]?>"></td>
														</tr>
														<?php
								}
								?>
												</table>
										</td>
								</tr>
								<tr>
										<td>
												<div align="left"><?php echo str_replace("-",".",$vupdata["rdate"])?></div>
										</td>
								</tr>
								<tr>
										<td>&nbsp;</td>
								</tr>
								<tr>
										<td>
												<input type="button" name="Submit" value="戻る" onClick="history.back()">
										</td>
								</tr>
						</table>
						<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF">
								<tr>
										<td>
												<div align="right"></div>
										</td>
								</tr>
						</table>
				</td>
		</tr>
</table>
