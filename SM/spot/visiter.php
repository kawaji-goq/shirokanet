<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php

if($_GET["pmode"]=="delete") {
	$delres=$dbobj->Query("delete from number_of_visitors where rdate = ".$_REQUEST["rdate"]);
}
if($_GET["lim"]!=NULL) {
	$_SESSION["spot_visit"]["lim"]=$_GET["lim"];
}
else {
	$_SESSION["spot_visit"]["lim"]=30;
}
if($_GET["page"]!=NULL) {
	$_SESSION["spot_visit"]["page"]=$_GET["page"];
}
else if($_SESSION["spot_visit"]["page"]==NULL) {
	$_SESSION["spot_visit"]["page"]=1;
}

if($_GET["selmenu"]!=NULL) {
	$_SESSION["dmtemp"]["selmenu"]=$_GET["selmenu"];
}


$today=explode("-",date("Y-m-d"));
$bdate=mktime(0,0,0,$today[1],$today[2]+1,$today[0]);
$edate=mktime(0,0,0,$today[1],$today[2]-7,$today[0]);
$visiterdata=$dbobj->GetList("select * from number_of_visitors order by rdate desc offset ".$_SESSION["spot_visit"]["lim"]*($_SESSION["spot_visit"]["page"]-1)." limit ".$_SESSION["spot_visit"]["lim"]);
$dmres=$dbobj->Query("select * from number_of_visitors");
$maxcount=$dbobj->NumRows($dmres);
$maxpage=ceil(($maxcount)/$_SESSION["spot_visit"]["lim"]);
?><script language="javascript">
function delchk(name,id) {
	var res=confirm(name+"を削除してもよろしいですか？");
	
	if(res) {
		location.href="?PID=spot_visiter&pmode=delete&rdate="+id;
	}
	
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<table width="700" border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
  		<td>&nbsp;</td>
 		</tr>
  <tr>
  		<td>
  				<table border="0" cellspacing="0" cellpadding="3">
							<tr>
									<td>現在の累計</td>
									<td><?php 
							$sumdata=$dbobj->GetData("select sum(counter) as sumcount,max(rdate) as maxdate from number_of_visitors where rdate <= ".time());

						
						?><?php echo number_format($sumdata["sumcount"]); ?>人</td>
							</tr>
					</table>
  		</td>
 		</tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td>
      <form id="form1" name="form1" method="post" action="">
        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <td width="146" align="left" bgcolor="#EBEBEB">日付</td>
            <td width="452" align="left" bgcolor="#EBEBEB">来訪数</td>
            <td colspan="2" align="left" bgcolor="#EBEBEB">
              <div align="center">
                	
                	<input type="button" name="Submit" value="新規登録" onClick="location.href='?PID=spot_vister_reg'" />
              		</div>
            </td>
          </tr>
          <?php
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　施工実績カテゴリ一覧開始　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/
for($visterrow=0;$visiterdata[$visterrow]["rdate"];$visterrow++){ 
?>
          <tr>
            <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo date("Y年m月d日",$visiterdata[$visterrow]["rdate"]); ?>&nbsp;</td>
               <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo number_format($visiterdata[$visterrow]["counter"]); ?>人</td>
         <td width="42" align="left" valign="top" bgcolor="#FFFFFF">
              <input type="button" name="Submit" value="修正" onClick="location.replace('?PID=spot_visiter_up&rdate=<?php echo $visiterdata[$visterrow]["rdate"];?>')" />
            </td>
            <td width="42" align="left" valign="top" bgcolor="#FFFFFF">
              <input type="button" name="Submit" value="削除" onClick="delchk('<?php echo date("Y年m月d日",$visiterdata[$visterrow]["rdate"]); ?>','<?php echo $visiterdata[$visterrow]["rdate"]; ?>')" />
            </td>
          </tr>
          <?php 
				}
				/*↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑*/
				/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
				/*　　　　　　　　　施工実績カテゴリ一覧終了　　　　　　　　　　*/
				/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
				/****************************************************************/
				?>
        </table>
        <table width="100%" border="0">
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
          		<td colspan="2">
          				<div align="center">
											<?php if($_SESSION["spot_visit"]["page"]!=NULL&&$_SESSION["spot_visit"]["page"]!=1){  ?>
											<a href="?PID=spot_visiter&amp;page=<?php echo $_SESSION["spot_visit"]["page"]-1;?>">
											<?php }?>
		&lt;&lt;　前の10件
		<?php 
		if($_SESSION["spot_visit"]["page"]!=NULL&&$_SESSION["spot_visit"]["page"]!=1){  ?>
											</a>
											<?php 
		}
		for($prows=1;$prows<=$maxpage;$prows++) { 
		  if($prows==$_SESSION["spot_visit"]["page"]) {
		  		echo " <strong><font color=\"#FF6600\">".$prows."</font></strong> ";
			}
			else {
		  		echo " <a href=\"?PID=spot_visiter&page=".$prows."\">".$prows."</a> ";
			}
		  
		  }?>
											<?php if($maxpage!=$_SESSION["spot_visit"]["page"]) {?>
											<a href="?PID=spot_visiter&amp;page=<?php echo $_SESSION["spot_visit"]["page"]+1;?>">
											<?php } ?>
													次の10件　&gt;&gt;
		<?php if($maxpage!=$_SESSION["spot_visit"]["page"]) {?>
											</a>
											<?php } ?>
									</div>
          		</td>
          		</tr>
        </table>
      </form>
    </td>
  </tr>
</table>
