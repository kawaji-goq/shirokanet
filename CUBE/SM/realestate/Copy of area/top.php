<?php
$re1obj=new Admin_RE_Area($dbobj);

if($_REQUEST["btm_update_re_area"]=="エリアを更新する") {
	for($i=0;$_REQUEST["area_id"][$i]!=NULL;$i++) {
		if($_REQUEST["turn"][$i]==NULL) {
			$_REQUEST["turn"][$i]=1;
		}
		if($_REQUEST["area_name"][$i]!=NULL) {
			$dbobj->Query("update re_area set area_name ='".$_REQUEST["area_name"][$i]."' ,turn =".$_REQUEST["turn"][$i]." where area_id=".$_REQUEST["area_id"][$i]);
		}
		else {
			$dbobj->Query("delete from re_area where area_id=".$_REQUEST["area_id"][$i]);
			$dbobj->Query("delete from re_area_master where area_id=".$_REQUEST["area_id"][$i]);
		}
	}
	if($_REQUEST["new_area_name"]!=NULL) {
	
		if($_REQUEST["new_turn"]==NULL) {
			$_REQUEST["new_turn"]=1;
		}
		
		$maxdata=$dbobj->GetData("select max(area_id) as maxid from re_area");
		$maxid=$maxdata["maxid"]+1;
		$dbobj->Query("insert into re_area values(".$maxid.",'".$_REQUEST["new_area_name"]."',".$_REQUEST["new_turn"].")");
		
	}
}
$re1data=$re1obj->GetCateList($_REQUEST["bid"]);
//$maxpage=ceil(($re1obj->numrows)/$_SESSION["lim"]);

?><meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<script language="JavaScript" src="/tool/keypress.js" type="text/javascript">
function hback() {
history.back();
}
</script>
<script language="javascript">

function goreplace(bid) {

	location.href="index.php?PID=re_area_clist&bid="+bid;
	
}

function godelete(bid) {

	location.href="index.php?PID=re_b1_del&bid="+bid;
	
}

function gorealestatetop() {

 location.replace("index.php?PAGEID=realestate");
 
}

</script>
<TABLE width="700"  border="0" align="left" cellpadding="0" cellspacing="0"> 
  <TR> 
    <TD> 
      <table width="700"  border="0" align="center" cellpadding="0" cellspacing="0" class="border"> 
        <tr> 
          <td width="15" bgcolor="#CCCCCC">&nbsp; </td> 
          <td> 
            <table width="100%"  border="0" cellspacing="0" cellpadding="5"> 
              <tr> 
                <td class="font10"> <strong>エリア・地域 管理</strong> </td> 
              </tr> 
            </table> 
          </td> 
        </tr> 
      </table> 
      <form name="form1" method="post" action=""> 
        <TABLE width="700"  border="0" align="center" cellpadding="0" cellspacing="0"> 
          <TR> 
            <TD>&nbsp; 
            </TD> 
          </TR> 
        </TABLE> 
        <TABLE width="700"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC" class="realestate_bgcolor1"> 
          <TR bgcolor="#EABFC7" class="realestate_bgcolor2"> 
            <TD width="54" bgcolor="#EBEBEB"><div align="center"><strong>表示順</strong></div></TD> 
            <TD width="229" bgcolor="#EBEBEB"> 
              <div class="font14"> 
                <div align="left"><strong>エリア名</strong></div>
              </div> 
            </TD> 
            <TD width="296" bgcolor="#EBEBEB">選択中の地域</TD>
            <TD width="92" bgcolor="#EBEBEB"> 
              <div align="center" class="font14">
                <div align="center"><strong>地域選択</strong></div>
              </div> 
            </TD> 
          </TR> 
           <?php
													for($re1rows=0;$re1data[$re1rows]["area_id"]!=NULL;$re1rows++) {
													?>
          <TR bgcolor="#EABFC7" class="realestate_bgcolor3"> 
            <TD valign="top" bgcolor="#FFFFFF" class="font14"><div align="center"><span class="font12">
   		              <input name="turn[<?php echo $re1rows;?>]" type="text" id="turn[<?php echo $re1rows;?>]" value="<?php echo $re1data[$re1rows]["turn"];?>" size="4" />
								  <input name="area_id[<?php echo $re1rows;?>]" type="hidden" id="area_id[<?php echo $re1rows;?>]" value="<?php echo $re1data[$re1rows]["area_id"]; ?>" />
            </span></div></TD> 
            <TD valign="top" bgcolor="#FFFFFF" class="font14">
            <input name="area_name[<?php echo $re1rows;?>]" type="text" id="area_name[<?php echo $re1rows;?>]" value="<?php echo $re1data[$re1rows]["area_name"];?>" size="40"></TD> 
            <TD bgcolor="#FFFFFF" class="font14"><?php 
												$chiikisql="select * from re_area_master where area_id = ".$re1data[$re1rows]["area_id"];
												$chiikilist=$dbobj->GetList($chiikisql);
												for($chiikirows=0;$chiikilist[$chiikirows]["area_id"]!=NULL;$chiikirows++) {
													if($chiikirows!=0) {
														echo "<br>";
													}
													echo $chiikilist[$chiikirows]["pref"].$chiikilist[$chiikirows]["address1"].$chiikilist[$chiikirows]["address2"];
												}
												?>&nbsp;</TD>
            <TD valign="top" bgcolor="#FFFFFF"> 
              <div align="center">
              		<input type="button" name="Submit" value="地域選択" onclick="goreplace('<?php echo $re1data[$re1rows]["area_id"];?>')" />
              </div> 
            </TD> 
          </TR>
          <?php
					}
					?>          <TR bgcolor="#EBEBEB" class="realestate_bgcolor3">
            <TD colspan="4" class="font14">新規に登録する場合は入力してください。</TD>
          </TR>

          <TR bgcolor="#EABFC7" class="realestate_bgcolor3">
            <TD bgcolor="#FFFFFF" class="font14"><div align="center"><span class="font12">
                <input name="new_turn" type="text" id="new_turn" value="<?php echo $re1data[$re1rows]["turn"];?>" size="4" />
            </span></div></TD>
            <TD colspan="3" bgcolor="#FFFFFF" class="font14"><input name="new_area_name" type="text" id="new_area_name" value="<?php echo $re1data[$re1rows]["area_name"];?>" size="40"></TD>
          </TR> 
        </TABLE> 
        <table width="700"  border="0" align="center" cellpadding="0" cellspacing="0" class="font12">
						<tr>
								<td bgcolor="#FFFFFF">&nbsp;</td>
						</tr>
						<tr>
								<td bgcolor="#FFFFFF">
										<div align="center">										</div>
								</td>
						</tr>
		</table>
        <input name="btm_update_re_area" type="submit" id="btm_update_re_area" value="エリアを更新する"> 
        <input type="button" name="Submit" value="もどる" onClick="gorealestatetop()"> 
      </form> 
    </TD> 
  </TR> 
</TABLE> 
<br> 
