<?php 
/* 
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<?php
*/

$gobj=new Group($dbobj);
$mobj=new Member($dbobj);

if($_REQUEST["mode"]=="group_add") {
	$gobj->Addition($_POST);
	?>
	<script language="javascript">
	window.location.replace("index.php?PID=group");
	</script>
	<?php
	
}
$gdata=$gobj->GetList(" turn ");
$mdata=$mobj->GetList();
?>
<script language="javascript">
//リスト内の移動をする関数
function func(selectnum,selectnum2) {
	while (document.gfrom.elements[selectnum].selectedIndex != -1) {
		var test=document.gfrom.elements[selectnum2].length;
		document.gfrom.elements[selectnum2].options[test]
		= new Option(document.gfrom.elements[selectnum].options[document.gfrom.elements[selectnum].selectedIndex].text,document.gfrom.elements[selectnum].options[document.gfrom.elements[selectnum].selectedIndex].value);
		document.gfrom.elements[selectnum].options[document.gfrom.elements[selectnum].selectedIndex] = null;
	}
}
//全リストを選択してデータを送信する関数
function senddata() {
	var oprows=0;
	
	while(oprows<document.gfrom.elements[1].length) {
		document.gfrom.elements[1].options[oprows].selected=true;
		oprows++;
	}
	
	document.gfrom.submit();
}
function datachk () {
	if(document.gfrom.group_name.value!="") {
		res=confirm("この内容で登録してもよろしいですか？");
	
		if(res) {
			senddata();
		}
	}
	else {
		alert("グループ名を入力してください。");
	}
}
</script>
<br>
<div id="group_list">
<table width="700"  border="0" align="left" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
	<form name="gfrom" method="post" action="">
		<tr>
			<th width="140" align="left" bgcolor="#ECECEC">
					<div align="right">グループ名</div>
			</th>
		    <td bgcolor="#FFFFFF">
		    	<input name="group_name" type="text" id="group_name" size="50">
		    </td>
		</tr>
		
		<tr>
			<th width="140" align="left" valign="top" bgcolor="#ECECEC">
					<div align="right">所属会員</div>
			</th>
		    <td align="left" bgcolor="#FFFFFF">
		    	<table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
                	<tr>
                		<th>&nbsp;</th>
                		<td>&nbsp;</td>
                		<th>&nbsp;</th>
                		</tr>
                	<tr>
                		<td width="200">
                			<select name="rlist[]" size="10" multiple id="rlist[]" style="width:100%;">
   	                            </select>
                		</td>
                		<td width="75">
                			<table width="95%"  border="0" cellspacing="5" cellpadding="5">
                            	<tr>
                            		<td align="center">
                            			<input type="button" name="Submit" value="←追加" onClick="func(4,1)">
                            		</td>
                            		</tr>
                            	<tr>
                            		<td align="center">
                            			<input type="button" name="Submit" value="削除→" onClick="func(1,4)">
</td>
                            		</tr>
                            	</table>
                		</td>
                		<td width="200">
                			<select name="nrlist" size="10" multiple id="nrlist" style="width:100%;">
                				
                				<?php
								$mrows=0;
								while($mdata[$mrows]["member_id"]!=NULL) {
								?><option value="<?php echo $mdata[$mrows]["member_id"] ?>"><?php echo $mdata[$mrows]["member_name"] ?></option>
								<?php
									$mrows++;
								}
								?>
                                </select>
                		</td>
                		</tr>
                	</table>
		    </td>
		</tr>
		<tr>
			<td width="140" align="left" bgcolor="#ECECEC">
					<div align="right"></div>
			</td>
		    <td align="left" bgcolor="#FFFFFF">
		    	<input name="mode" type="hidden" id="mode" value="group_add">
		    </td>
		</tr>
		<tr>
			<td width="140" align="left" bgcolor="#ECECEC">
					<div align="right"></div>
			</td>
		    <td align="left" bgcolor="#FFFFFF">
		    	<input name="btmgroup_add" type="button" id="btmgroup_add" value="登録する" onClick="datachk()">
		    	<input name="btmgroup_update" type="button" id="btmgroup_update" value="戻る" onClick="window.location.href='index.php'">
		    </td>
		</tr>
	</form>
</table>
</div>