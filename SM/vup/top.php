<?php
if($_REQUEST["PAGE"]==NULL) {
	$_REQUEST["PAGE"]=1;
}
$offset=($_REQUEST["PAGE"]-1)*30;

if($_REQUEST["cate_id"]==NULL) {
	$_REQUEST["cate_id"]=1;
}
$vupdata=$adminobj->GetList("select * from vup_data where  view_chk =1 and cate_id =".$_REQUEST["cate_id"]." order by rdate desc limit 30 offset ".$offset);

?><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<table width="100%" border="0" cellpadding="1" cellspacing="1">
		<tr>
				<td width="" background="http://siteadmin.itcube.ne.jp/img/0707icon/c1.jpg"><strong>&nbsp;<img src="http://siteadmin.itcube.ne.jp/sm/img/<?php 
				if($_REQUEST["cate_id"]==1) {echo "infofromitcube.jpg";}else if($_REQUEST["cate_id"]==2) {echo "versionoup.jpg";}?>" width="221" height="65"></strong></td>
		</tr>
		<tr>
				<td>&nbsp;</td>
		</tr>
		<tr>
				<td>
						<table width="100%" border="0" align="center" cellpadding="2" cellspacing="2" bgcolor="#FFFFFF">
								<?php
			$rows=0;
			while($vupdata[$rows]["vup_id"]!=NULL) {
			?>
								<tr>
										<td width="100"><?php echo str_replace("-",".",$vupdata[$rows]["rdate"]); ?>&nbsp;</td>
										<td><a href="index.php?PID=vup_d&vup_id=<?php echo $vupdata[$rows]["vup_id"] ?>"><?php echo $vupdata[$rows]["title"] ?></a>&nbsp;</td>
								</tr>
								<?php
				$rows++;
			}
			?>
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
