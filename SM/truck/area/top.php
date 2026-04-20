<?php
$re1obj=new Admin_RE_Area($dbobj);
if($_GET["mode"]=="deletearea") {
			$dbobj->Query("delete from re_area where area_id=".$_REQUEST["deleteid"]);
			$dbobj->Query("delete from re_area_master where area_id=".$_REQUEST["deleteid"]);
			?>
			<script language="javascript">
			location.replace("?PID=re_area");
			</script>
			<?php
}
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

function deletearea(name,id) {
		res=confirm(name+"を削除してもよろしいですか？");
		if(res) {
			location.href='?PID=re_area&mode=deletearea&deleteid='+id;
		}
}

function goreplace(bid) {

	location.href="index.php?PID=re_area_clist&bid="+bid;
	
}

function godelete(bid,pref,add) {

	location.href="index.php?PID=re_area_del&area_id="+bid+"&p="+pref+"&a="+add;
	
}

function gorealestatetop() {

 location.replace("index.php?PAGEID=realestate");
 
}
function goreplace2(bid,pref,add) {

	location.href="?PID=re_area_up&area_id="+bid+"&p="+pref+"&a="+add;
	
}
</script>
<TABLE width="900"  border="0" align="left" cellpadding="0" cellspacing="0"> 
  <TR>
      <TD>
          <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="border">
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
      </TD>
  </TR>
  <TR>
      <TD>&nbsp;</TD>
  </TR>
  <TR> 
    <TD>
        <form name="form1" method="post" action="">
            <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="font12">
						<tr>
								<td bgcolor="#FFFFFF">
								    <TABLE width="100%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC" class="realestate_bgcolor1">
                <TR bgcolor="#EABFC7" class="realestate_bgcolor2">
                    <TD width="52" bgcolor="#EBEBEB">
                        <div align="center"><strong>表示順</strong></div>
                    </TD>
                    <TD width="200" bgcolor="#EBEBEB">
                        <div class="font14">
                            <div align="left"><strong>エリア名</strong></div>
                        </div>
                    </TD>
                    <TD width="468" bgcolor="#EBEBEB"><strong>選択中の地域</strong></TD>
                    <TD width="74" bgcolor="#EBEBEB">
                        <div align="center" class="font14">
                            <div align="center"><strong>地域登録</strong></div>
                        </div>
                    </TD>
                    <TD width="70" bgcolor="#EBEBEB">
                        <div align="center"><strong>エリア削除</strong></div>
                    </TD>
                </TR>
                <?php
													for($re1rows=0;$re1data[$re1rows]["area_id"]!=NULL;$re1rows++) {
													?>
                <TR bgcolor="#EABFC7" class="realestate_bgcolor3">
                    <TD valign="top" bgcolor="#FFFFFF" class="font14">
                        <div align="center">
                            <input name="turn[<?php echo $re1rows;?>]" type="text" id="turn[<?php echo $re1rows;?>]" value="<?php echo $re1data[$re1rows]["turn"];?>" size="4" />
                            <input name="area_id[<?php echo $re1rows;?>]" type="hidden" id="area_id[<?php echo $re1rows;?>]" value="<?php echo $re1data[$re1rows]["area_id"]; ?>" />
                        </div>
                    </TD>
                    <TD valign="top" bgcolor="#FFFFFF" class="font14">
                        <input name="area_name[<?php echo $re1rows;?>]" type="text" id="area_name[<?php echo $re1rows;?>]" value="<?php echo $re1data[$re1rows]["area_name"];?>" size="40">
                    </TD>
                    <TD bgcolor="#FFFFFF" class="font14">
<?php 													$re2data=$dbobj->GetList("select distinct(area_id),pref,address1 from re_area_master where area_id =".$re1data[$re1rows]["area_id"]);
													if($re2data[0]["area_id"]!=NULL){
?>                        <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC" class="realestate_bgcolor1">
                            
                            <?php
													for($re2rows=0;$re2data[$re2rows]["area_id"]!=NULL;$re2rows++) {
													?>
                            <tr bgcolor="#EABFC7" class="realestate_bgcolor3">
                                <td width="216" valign="top" nowrap bgcolor="#FFFFFF" class="font14"> <?php echo $re2data[$re2rows]["pref"].$re2data[$re2rows]["address1"].$re2data[$re2rows]["address2"];?>
                                        <div align="center"> </div>
                                </td>
                                <td width="159" bgcolor="#FFFFFF" class="font14">
                                    <?php 
												$chiikisql="select * from re_area_master where area_id = ".$re2data[$re2rows]["area_id"]." and pref='".$re2data[$re2rows]["pref"]."' and address1 = '".$re2data[$re2rows]["address1"]."'";
												$chiikilist=$dbobj->GetList($chiikisql);
												for($crows=0;$chiikilist[$crows]["area_id"]!=NULL;$crows++) {
													if($crows!=0) {
														echo "<br>";
													}
													if($chiikilist[$crows]["address2"]=="") {
														echo "全て";
													}
													else {
														echo $chiikilist[$crows]["address2"];
													}
												}
												?>
                                </td>
                                <td width="44" valign="top" bgcolor="#FFFFFF" class="font14">
                                    <div align="center">
                                        <input type="button" name="Submit" value="修正" onclick="goreplace2('<?php echo $re2data[$re2rows]["area_id"];?>','<?php echo urlencode($re2data[$re2rows]["pref"]);?>','<?php echo urlencode($re2data[$re2rows]["address1"]);?>')" />
                                    </div>
                                </td>
                                <td width="46" valign="top" bgcolor="#FFFFFF">
                                    <div align="center">
<input type="button" name="Submit" value="削除" onclick="godelete('<?php echo $re2data[$re2rows]["area_id"];?>','<?php echo urlencode($re2data[$re2rows]["pref"]);?>','<?php echo urlencode($re2data[$re2rows]["address1"]);?>')" />                                    </div>
                                </td>
                            </tr>
                            <?php
					}
					?>
                        </table>
<?php 					}
					else {
					?>
<font color="#FF0000"><strong>地域が登録されていません。</strong></font>
					       
					<?php
					}
?>                    </TD>
                    <TD valign="top" bgcolor="#FFFFFF">
                        <div align="center">
                            <input type="button" name="Submit" value="地域登録"onClick="location.replace('?PID=re_area_chiiki_reg&area_id=<?php echo $re1data[$re1rows]["area_id"]; ?>')" />
                        </div>
                    </TD>
                    <TD valign="top" bgcolor="#FFFFFF">
                        <input type="button" name="Submit" value="エリア削除" onClick="deletearea('<?php echo $re1data[$re1rows]["area_name"];?>',<?php echo $re1data[$re1rows]["area_id"];?>)">
                    </TD>
                </TR>
                <?php
					}
					?>
                <TR bgcolor="#EBEBEB" class="realestate_bgcolor3">
                    <TD colspan="5" class="font14">新規に登録する場合は入力してください。</TD>
                </TR>
                <TR bgcolor="#EABFC7" class="realestate_bgcolor3">
                    <TD bgcolor="#FFFFFF" class="font14">
                        <div align="center">
                            <input name="new_turn" type="text" id="new_turn" value="<?php echo $re1data[$re1rows]["turn"];?>" size="4" />
                        </div>
                    </TD>
                    <TD colspan="4" bgcolor="#FFFFFF" class="font14">
                        <input name="new_area_name" type="text" id="new_area_name" value="<?php echo $re1data[$re1rows]["area_name"];?>" size="40">
                    </TD>
                </TR>
            </TABLE>
								</td>
						</tr>
						<tr>
								<td bgcolor="#FFFFFF">
										<div align="center">										</div>
								  <input name="btm_update_re_area" type="submit" id="btm_update_re_area" value="エリアを更新する">
								</td>
						</tr>
		</table>
        </form> 
    </TD> 
  </TR> 
</TABLE> 
<br>
