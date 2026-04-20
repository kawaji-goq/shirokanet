<?php

/*
if($_REQUEST["subm"]=="送信する") {
	$fp=ftp_connect("localhost");
	if($fp) {
		echo "サーバーに接続しました。<br>";
		$ftphd=ftp_login($fp,"takken-iwakuni","vh47JEbv");
		if($ftphd) {
			echo "認証に成功しました。<br>";
			$res=ftp_chcate($fp,"/httpdocs/members/tmp/file");
			//ftp_put($fp,"ugau.jpg",$_REQUEST["file1"],FTP_BINARY);
			$catelist=ftp_nlist($fp,"./");
			print_r($catelist);
		}
		else {
			echo "認証に失敗しました。<br>";
		}
	}
	else {
		echo "サーバーの接続に失敗しました。<br>";
	}
}

//print_r($_REQUEST);
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php 
*/
$flobj=new Acts($dbobj);

if($_REQUEST["mode"]=="addition") {
	$result=$flobj->Addition_Cate($_POST);
}

$fldata=$flobj->Get_CateList();
$fcdata=$flobj->Get_CateData($_REQUEST["cate_id"]);

?>
<script language="javascript">
function datachk(frm) {
	if(frm.cate_name.value!=null&&frm.cate_name.value!="") {
		res=confirm("この内容で更新してもよろしいですか？");
		if(res) {
			frm.mode.value="addition";
			frm.submit();
		}
	}
	else {
		alert("種別名が入力されていません。");
	}
}
</script>
<div id="files">
	<table width="740"  border="0" align="center" cellpadding="2" cellspacing="2">
		<tr>
			<td colspan="2" align="left" valign="top">
				<table width="700" border="0" cellspacing="2" cellpadding="2">
	<tr>
		<td width="45"><img src="/members/img/topics_pt.gif" width="35" height="31"></td>
		<td><div id="tree"><span class="top">活動予定・報告管理</span>　<span class="gt">>></span>　<span class="sub">活動予定・報告種別更新</span></div></td>
	</tr>
</table>

			</td>
		</tr>
		<tr>
			<td colspan="2" align="left" valign="top">&nbsp;			</td>
		</tr>
		<tr>
			<td width="200" align="left" valign="top"><strong> 活動予定・報告種別 </strong></td>
			<td width="535" align="left" valign="top">
				<div align="left"></div>
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
				?><tr>
						<td colspan="2">&nbsp;</td>
					</tr>
				
				</table>
			</td>
				<form action="" method="post" name="up_form" id="up_form">
			<td align="center" valign="top">			
					<?php 
					if($_REQUEST["mode"]=="addition"&&$result=="") {
					
					?><script language="javascript">
	window.location.replace("index.php?PID=act_cate");
</script>
                    <table width="95%" border="0" cellspacing="0" cellpadding="0">
                    	<tr>
                    		<td width="50%">&nbsp;</td>
                    		<td width="50%">&nbsp;</td>
                   		</tr>
                    	<tr>
                    		<td colspan="2">
                    			<div align="center"><strong>以下の内容で登録しました。</strong></div>
                    		</td>
                   		</tr>
                    	<tr>
                    		<td>&nbsp;</td>
                    		<td>&nbsp;</td>
                   		</tr>
                   	</table>					
                    <table width="95%"  border="0" cellspacing="2" cellpadding="2">
                    	<tr>
                    		<td width="100" background="/members/img/filemenu_bg.gif">
                    			<div align="right"><strong>親種別</strong></div>
                   			</td>
                    		<td colspan="6" valign="top"><?php 
							$updata=$flobj->Get_CateData($_REQUEST["parents_id"]);
							echo $updata["cate_name"];
?>&nbsp;                    			</td>
                   		</tr>
                    	<tr>
                    		<td width="100" background="/members/img/filemenu_bg.gif">
                    			<div align="right"><strong>
				種別名</strong></div>
                   			</td>
                    		<td colspan="6">
                    			<?php echo $_REQUEST["cate_name"] ?>
                   			</td>
                   		</tr>
                   	</table>
					<table width="95%" border="0" cellspacing="0" cellpadding="0">
                    	<tr>
                    		<td width="50%">&nbsp;</td>
                   		</tr>
                    	<tr>
                    		<td height="30" background="/members/img/bukken_bg.gif">                    			<input name="btm_back" type="button" id="btm_back" value="リストへ戻る" onClick="window.location.href='index.php?PID=act_cate'">
                   			</td>
                   		</tr>
                   	</table>
					<?php 
					}
					else {?><table width="95%"  border="0" cellspacing="2" cellpadding="2">
                    	<tr>
                    		<td width="100" background="/members/img/filemenu_bg.gif">
                    			<div align="right"><strong>親種別</strong></div>
                   			</td>
                    		<td colspan="6" valign="top">
                    			<select name="parents_id" id="parents_id">
                    				<option value="0" selected>home</option>
                    				<?php
				$flrows=0;
				while($fldata[$flrows]["cate_id"]!=NULL) {
				?><option value="<?php echo $fldata[$flrows]["cate_id"];?>"<?php if($fcdata["parents_id"]==$fldata[$flrows]["cate_id"]) {echo " selected";}?>><?php echo $fldata[$flrows]["cate_name"];?></option>
                    				<?php 
					$flrows++;
				}
				?>
                   				</select>
                   			</td>
                   		</tr>
                    	<tr>
                    		<td width="100" background="/members/img/filemenu_bg.gif">
                    			<div align="right"><strong>
                    				<input name="mode" type="hidden" id="mode">
                   				種別名</strong></div>
                   			</td>
                    		<td colspan="6">
                    			<input name="cate_name" type="text" id="cate_name" size="50">
                   			</td>
                   		</tr>
                    	</table>
					<table width="95%" border="0" cellspacing="0" cellpadding="0">
                    	<tr>
                    		<td width="50%">&nbsp;</td>
                   		</tr>
                    	<tr>
                    		<td height="30" background="/members/img/bukken_bg.gif">
                    			<input name="btm_add" type="button" id="btm_add" value="登録する" onClick="datachk(this.form)">
                    			<input name="btm_back" type="button" id="btm_back" value="リストへ戻る" onClick="window.location.href='index.php?PID=act_cate'">
                   			</td>
                   		</tr>
                   	</table><?php
						} ?>
			</td>
				</form>
		</tr>
	</table>
</div>
