<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php 
mb_language("japanese");
mb_internal_encoding("euc-jp");

$sql="select * from member where login_id='".$logindata["login_id"]."' and login_pw ='".$logindata["login_pw"]."'";
$rdata=$dbobj->GetData($sql);
//print_r($rdata);
//$resultnumrows=$dbobj->NumRows($result);
//$rdata=$dbobj->FetchAllArray($result,$resultnumrows);
?>
<script language="javascript">
function mailchk(frm) {
	if(frm.kmail.value=="") {
		alert("携帯メールアドレスが入力されていません。");
	}
	else {
		res=confirm("メールを送信してもよろしいですか？");
		if(res) {
			frm.sendurl.value="ok";
			frm.submit();
		}
	}
}
</script>
<div id="messsage">
	<table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1">
		
		<tr>
				<td>&nbsp;</td>
		</tr>
		<tr>
			<td>
					<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FCFCFC">
							<tr>
									<td width="4%"><img src="/GW/img/template/icon_keitai.jpg" width="40" height="42"></td>
									<td width="96%" class="title"><font color="#333333">携帯に送信</font></td>
							</tr>
					</table>
</td>
		</tr>
		<tr>
			<td>
				<?php 
				if($_REQUEST["sendurl"]=="ok") {
				mb_send_mail($_REQUEST["kmail"],"携帯サイトURL","下記アドレスにアクセスしてください。\nhttp://siteadmin.itcube.ne.jp/keitai/?kpass=".$rdata["kpass"],"From:info@itcube.jp\n");
				?>
				<table width="98%"  border="0" align="center" cellpadding="1" cellspacing="1">
                	<tr>
                		<td>&nbsp;</td>
               		</tr>
                	<tr>
                		<td>
                			<div align="left">
                				<?php echo $_REQUEST["kmail"];?>宛てに携帯サイトのURLを送信しました。           				  </div>
               			</td>
               		</tr>
                	<tr>
                		<td align="left">&nbsp;                			</td>
               		</tr>
               	</table>
				<?php
				}
				else {
				?>
					<table width="98%"  border="0" align="center" cellpadding="1" cellspacing="1">
				<form name="form1" method="post" action="">
                    	<tr>
                    	  <td>携帯のアドレスを入力してください。</td>
                  	  </tr>
                    	<tr>
                    		<th>
                    			<div align="left">
                    				<input name="kmail" type="text" value="<?php echo $rdata["kmail"];?>" size="50">
                    				</div>
                   			</th>
                   		</tr>
                    	<tr>
                    		<td align="left">
                    			<input name="send_url" type="button" id="send_url" value="URLを送信する" onClick="mailchk(this.form)">
                                <input name="sendurl" type="hidden" id="sendurl">
</td>
                   		</tr>
				</form>
               	</table>
				<?php 
				}
				?>
</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
	</table>
</div>
