<?php 
$flobj=new Acts($dbobj);
if($_REQUEST["btm_del"]=="選択した種別を削除する") {
	$delrows=0;
	while($_REQUEST["del_id"][$delrows]!=NULL) {
		$delsql="delete from act_cate where cate_id = '".$_REQUEST["del_id"][$delrows]."'";
		$result=$dbobj->Query($delsql);
		/*
		if($result) {
			@unlink($_REQUEST["del_id"][$delrows]);
		}
		*/
		$delrows++;
	}
}
$fldata=$flobj->Get_CateList();


$fdata=$flobj->GetActList($_REQUEST["cate_id"]);
$fcdata=$flobj->Get_CateData($_REQUEST["cate_id"]);

?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<table width="740"  border="0" align="center" cellpadding="2" cellspacing="2">
	<tr>
		<td colspan="2" align="left" valign="top">
			<table width="100%" border="0" cellspacing="2" cellpadding="2">
				<tr>
					<td width="6%"><img src="/members/img/topics_pt.gif" width="35" height="31"></td>
					<td width="94%">
						<div id="tree"><span class="top">活動予定・報告管理</span>　<span class="gt">>></span>　<span class="sub">活動予定・報告種別管理</span></div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="left" valign="top">&nbsp; </td>
	</tr>
	<tr>
		<td align="left" valign="top"><strong> 活動予定・報告種別 </strong></td>
		<td align="left" valign="top">
			<div align="left"><strong> 活動予定・報告種別一覧</strong></div>
		</td>
	</tr>
	<tr>
		<td width="200" align="left" valign="top">
			<table width="100%"  border="0" cellpadding="2" cellspacing="2" background="/members/img/message_bg1.gif" class="menu">
				<tr>
					<td colspan="2">
						<input type="button" name="Submit" value="活動予定・報告種別管理" onClick="window.location.href='index.php?PID=act_cate'">
					</td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
				<?php
				$flrows=0;
				while($fldata[$flrows]["cate_id"]!=NULL) {
				?>
					<td colspan="2"><a href="index.php?PID=act&cate_id=<?php echo $fldata[$flrows]["cate_id"];?>"><?php echo $fldata[$flrows]["cate_name"];?></a></td>
				</tr>
				<?php 
					$flrows++;
				}
				?>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
			</table>
		</td>
		<form name="form1" method="post" action=""><td align="center" valign="top">
			<table width="100%"  border="0" cellspacing="1" cellpadding="1">
				<tr>
					<td colspan="2">
						<table width="100%"  border="0" cellspacing="2" cellpadding="2">
							<tr>
								<th width="10" background="/members/img/filemenu_bg.gif">&nbsp;</th>
								<th background="/members/img/filemenu_bg.gif">
									<div align="left">種別名</div>
								</th>
								<th width="50" background="/members/img/filemenu_bg.gif">&nbsp;</th>
							</tr>
							<?php
							$flrows=0;
							while($fldata[$flrows]["cate_id"]!=NULL) {
							?>
							<tr>
								<td colspan="3" class="line"></td>
							</tr>
							<tr>
								<td width="10">
								<?php 
								if($fldata[$flrows]["parents_id"]!=0) {
								?>
									<input name="del_id[]" type="checkbox" id="del_id[]" value="<?php echo $fldata[$flrows]["cate_id"]; ?>">
								<?php 
								}
								?>
								</td>
								<td><?php echo $fldata[$flrows]["cate_name"];?></td>
								<td width="50">
									<input name="btm_up" type="button" id="btm_up" value="修正する" onClick="window.location.href='index.php?PID=act_cateup&cate_id=<?php echo $fldata[$flrows]["cate_id"] ?>'">
								</td>
							</tr>
							<?php 
								$flrows++;
							}
							?>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="2">
						<input name="btm_del" type="submit" id="btm_del" value="選択した種別を削除する">
						<input name="btm_add" type="button" id="btm_add" value="新規に項目を登録する" onClick="window.location.href='index.php?PID=act_cateadd'">
					</td>
				</tr>
			</table>
		</td></form>
	</tr>
</table>
