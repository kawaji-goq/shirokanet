<?php
include("./lib/mobile_class_7.php");
$today=explode("-",date("Y-m-d",time()));

if($_REQUEST["mode"]=="delete") {
	
	$insql=" delete from dm_temp where temp_id=".$_REQUEST["temp_id"];
	$chkres=$dbobj->Query($insql);
	if($chkres){
	?>
	<script language="javascript">
	location.replace("?PID=promo_dmtemp&page=1");
	</script>
	<?php
	}
	else{
		$_POST["mode"]="";
		$errmess="削除に失敗しました。";
	
	}
}
else {
$dmtmpdata=$dbobj->GetData("select * from dm_temp where temp_id=".$_REQUEST["temp_id"]."");

?>
<style>
.helper{
	line-height:25px;
	margin:1px;
	padding:4px;
	background-color:#fcfcfc;
	border:solid;
	border:#ECECEC;
	border:1px;"
}
.helper1 {	line-height:25px;
	margin:1px;
	padding:4px;
	background-color:#fcfcfc;
	border:solid;
	border:#ECECEC;
	border:1px;"
}
</style>

<script>
function datachk() {
	var frm=document.delete_form;
	var alertchk=0;
	var alerttxt="";
	if(alertchk==0) {
		res=confirm("この内容で削除しますか？");
		if(res) {
			frm.submit();
		}
		
	}else {
			alert(alerttxt);
		}
}
//-->

</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
		<table width="740" border="0" align="left" cellpadding="0" cellspacing="0">
<form id="delete_form" name="delete_form" method="post" action="">
				<tr>
						<td>
								<table width="740" border="0" align="center" cellpadding="3" cellspacing="0">
										<tr>
										    <td width="15" bgcolor="#CCCCCC">&nbsp;</td>
												<td><strong>メール配信テンプレート削除</strong></td>
										</tr>
								</table>
						</td>
				</tr>
				<tr>
						<td>&nbsp;</td>
				</tr>
				<tr>
						<td>
								<?php
								if($errmess!=NULL) {
								?>
								<table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
										<tr>
												<td>&nbsp;</td>
										</tr>
										<tr>
												<td><font color="#FF0000"><strong><?php echo $errmess; ?></strong></font></td>
										</tr>
										<tr>
												<td>&nbsp;</td>
										</tr>
								</table>
								<?php 
								}
								?>            <div class="helper"> 登録した<span class="helper1">メール配信</span>テンプレートを削除します。<br>
            内容を確認して削除してもよければ<strong>「削除する」</strong>ボタンをクリックしてください。<br>
            削除をしない場合は「<a href="#" onclick="location.replace('?PID=promo_dmtemp')"><strong>一覧に戻る</strong></a>」ボタンをクリックするとテンプレートの一覧ページに戻れます。</div>
                                <br>

								<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB">テンプレート名</td>
												<td bgcolor="#FFFFFF">
														<?php echo $dmtmpdata["temp_name"];?>												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">対象アドレス</td>
												<td bgcolor="#FFFFFF">
												
                                                         <?php 
														 if($dmtmpdata["temp_target"]=="p") { echo "PCアドレス";} 
														 if($dmtmpdata["temp_target"]=="k") { echo "携帯アドレス";} 
														 if($dmtmpdata["temp_target"]=="pk"||$dmtmpdata["temp_target"]==NULL) { echo "すべて";} ?>
												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">送信元のアドレス</td>
												<td bgcolor="#FFFFFF">
														<?php echo $dmtmpdata["raddress"];?>												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">PC用件名</td>
												<td bgcolor="#FFFFFF">
														<?php echo $dmtmpdata["rsubjext"];?>												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">PC用本文</td>
												<td bgcolor="#FFFFFF"><?php echo $dmtmpdata["rpctxt"];?></td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">携帯用件名</td>
												<td bgcolor="#FFFFFF"><?php 
						$DECODE_DATA=$emoji_obj->emj_decode($dmtmpdata["ksubjext"]);
						echo nl2br($DECODE_DATA["web"]);
						?></td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">携帯用本文</td>
												<td bgcolor="#FFFFFF">
						<?php 
						$DECODE_DATA=$emoji_obj->emj_decode($dmtmpdata["rktxt"]);
						echo nl2br($DECODE_DATA["web"]);
						?>
						</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">&nbsp;</td>
										  <td bgcolor="#FFFFFF">
														<input type="button" name="Submit" value="削除する" onclick="datachk()" />
														<input type="button" name="Submit" value="一覧へ戻る"onclick="location.replace('?PID=promo_dmtemp');" />
														<input name="mode" type="hidden" id="mode" value="delete" />
                                                        <input name="temp_id" type="hidden" id="temp_id" value="<?php echo $dmtmpdata["temp_id"];?>" />
</td>
										</tr>
							</table>				  
						</td>
				</tr>
</form>
		</table>
<?php
}
?>