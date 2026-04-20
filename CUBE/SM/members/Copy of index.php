<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<?php
$sql="select * from member order by turn ";
$result=pg_query($dbhandle,$sql);
$resultnumrows=pg_num_rows($result);
if($resultnumrows!=0) {
	$rows=0;
	while($rows<$resultnumrows) {
		$data[$rows]=pg_fetch_array($result,$rows);
		$rows++;
	}
}
?><table width="740" border="0" align="center" cellpadding="0" cellspacing="0">
            	<tr>
            		<td width="45"><img src="/members/img/members_sic.gif" width="45" height="40"></td>
            		<td>
            			<div id="tree"><span class="top">会員管理</span>　<span class="gt">>></span>　<span class="sub">会員管理TOP</span></div>
           			</td>
	</tr>
            	</table>
<br>
<table width="700" border="0" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <td background="/members/img/filemenu_bg.gif">
      <div align="center"><strong>名　　　　称</strong></div>
    </td>
    <td background="/members/img/filemenu_bg.gif">
      <div align="center"><strong>住　　　　所</strong></div>
    </td>
    <td background="/members/img/filemenu_bg.gif">
      <div align="center"><strong>電話番号</strong></div>
    </td>
    <td background="/members/img/filemenu_bg.gif">
      <div align="center"><strong>FAX番号</strong></div>
    </td>
    <td width="30" background="/members/img/filemenu_bg.gif">
      <div align="center"><strong>HP</strong></div>
    </td>
    <td width="30" background="/members/img/filemenu_bg.gif">
      <div align="center"><strong>Mail</strong></div>
    </td>
    <form name="form3" method="get" action="">
      <td colspan="2" background="/members/img/filemenu_bg.gif">
        <table border="0" align="right" cellpadding="0" cellspacing="0">
          <tr>
            <td>
              <div align="right"> </div>
              <div align="right">
                <strong>
                <input name="PID" type="hidden" id="PID" value="members_add">
                <input type="submit" name="Submit" value="新規追加">
                </strong></div>
            </td>
          </tr>
          <?php
$rows=0;
while($data[$rows][member_id]!=NULL) {
?>
          <?php
$rows++;
}
?>
        </table>
      </td>
    </form>
  </tr>
  <?php
$rows=0;
while($data[$rows][member_id]!=NULL) {
?>
  <tr>
  	<td colspan="8" class="line"></td>
  	</tr>
  <tr>
    <td height="48">
      <div align="center"><font size="2"><?php echo $data[$rows][member_name];?></font></div>
    </td>
    <td>
      <div align="left"><font size="2"><?php echo $data[$rows][zipcode]." ".$data[$rows][address];?></font></div>
    </td>
    <td>
      <div align="center"><font size="2"><?php echo $data[$rows][telnumber];?></font></div>
    </td>
    <td width="91">
      <div align="center"><font size="2"><?php echo $data[$rows][faxnumber];?></font></div>
    </td>
    <td>
      <div align="center"><font size="2">
        <?php if($data[$rows][homepage]!=NULL) {echo "<a href=\"".$data[$rows][homepage]."\" target=\"_blank\">○</a>";}else {echo "-";}?>
      </font></div>
    </td>
    <td>
      <div align="center"><font size="2">
        <?php if($data[$rows][mailaddress]!=NULL) {echo "<a href=\"mailto:".$data[$rows][mailaddress]."\" target=\"_blank\">○</a>";}else {echo "-";}?>
        </font></div>
    </td>
    <form name="form1" method="get" action="">
      <td width="75">
        <div align="center">
          <input name="PID" type="hidden" id="PID" value="members_correct">
          <input name="member_id" type="hidden" id="member_id" value="<?php echo $data[$rows][member_id];?>">
          <input type="submit" name="Submit" value="修正する">
        </div>
      </td>
    </form>
    <form name="form2" method="get" action="">
      <td width="75">
        <div align="center">
          <input name="PID" type="hidden" id="PID" value="members_del">
          <input name="member_id" type="hidden" id="member_id" value="<?php echo $data[$rows][member_id];?>">
          <input type="submit" name="Submit" value="削除する">
        </div>
      </td>
    </form>
  </tr>
  <?php
$rows++;
}
?>
</table>
