<?php
include("./lib/mobile_class_7.php");

$dmdata=$dbobj->GetData("select * from direct_mail where dm_id=".$_REQUEST["dm_id"]."");
$_SESSION["dm"]=$dmdata;
$exday=explode("-",date("Y-m-d-H-i",$_SESSION["dm"]["sendtime"]));
$year=$exday[0];
$month=$exday[1];
$day=$exday[2];
$hour=$exday[3];
$hour=$exday[3];
$minite=$exday[4];
$dmcondata=$dbobj->GetList("select * from dm_temp order by turn");
$coupondata=$dbobj->GetList("select * from promo_coupon order by coupon_id");
?><meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<table width="740" border="0" align="left" cellpadding="0" cellspacing="0"> 
  
    <tr> 
      <td> <table width="740" border="0" align="center" cellpadding="3" cellspacing="0"> 
          <tr>
          		<td>
          				<table width="100%"  border="0" align="left" cellpadding="0" cellspacing="0" class="border">
											<tr>
													<td width="15" bgcolor="#CCCCCC">&nbsp; </td>
													<td>
															<table width="100%"  border="0" cellspacing="0" cellpadding="5">
																	<tr>
																			<td class="font10"> <strong>DMプレビュー</strong> </td>
																	</tr>
															</table>
													</td>
											</tr>
						</table>
          		</td>
          		</tr>
          <tr> 
            <td>&nbsp;</td> 
          </tr> 
        </table>
      </td> 
    </tr> 
     
    <tr> 
      <td>
      		<form name="update_form" method="post" action=""> 
 <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <td width="150" valign="top" bgcolor="#EBEBEB">対象</td>
            <td bgcolor="#FFFFFF"><?php 
														 if($_SESSION["dm"]["target"]=="p") { echo "PCアドレス";} 
														 if($_SESSION["dm"]["target"]=="k") { echo "携帯アドレス";} 
														 if($_SESSION["dm"]["target"]=="pk"||$_SESSION["dm"]["target"]==NULL) { echo "すべて";} ?></td>
          </tr>
          <tr>
            <td valign="top" bgcolor="#EBEBEB">予定日</td>
            <td bgcolor="#FFFFFF"><?php echo $year;?>年<?php echo $month;?>月<?php echo $day;?>日</td>
          </tr>
          <tr>
            <td valign="top" bgcolor="#EBEBEB">予定時刻</td>
            <td bgcolor="#FFFFFF"><?php echo $hour;?>：<?php echo $minite;?></td>
          </tr>
          <tr>
            <td valign="top" bgcolor="#EBEBEB">送信元のアドレス</td>
            <td bgcolor="#FFFFFF"> <?php echo $_SESSION["dm"]["raddress"];?></td>
          </tr>
          <tr>
            <td valign="top" bgcolor="#EBEBEB">件名</td>
            <td bgcolor="#FFFFFF"> <?php echo $_SESSION["dm"]["rsubjext"];?> </td>
          </tr>
          <tr>
            <td valign="top" bgcolor="#EBEBEB">PC用本文</td>
            <td bgcolor="#FFFFFF"> <?php echo nl2br($_SESSION["dm"]["rpctxt"]);?> </td>
          </tr>
          <tr>
          		<td valign="top" bgcolor="#EBEBEB">携帯用件名</td>
          		<td bgcolor="#FFFFFF"><?php 
						$DECODE_DATA=$emoji_obj->emj_decode(str_replace("\r","",str_replace("\n","\\n",$_SESSION["dm"]["ksubjext"])));
						echo nl2br($DECODE_DATA["web"]);
						?></td>
          		</tr>
          <tr>
            <td valign="top" bgcolor="#EBEBEB">携帯用本文</td>
            <td bgcolor="#FFFFFF">
              <label>
              <?php 
						$DECODE_DATA=$emoji_obj->emj_decode(nl2br($_SESSION["dm"]["rktxt"]));
						echo nl2br($DECODE_DATA["web"]);
						?>
              </label>
            </td>
          </tr>
          <tr>
            <td valign="top" bgcolor="#EBEBEB">&nbsp;</td>
            <td bgcolor="#FFFFFF">
            		<input type="button" name="Submit" value="コピーして新規登録" onClick="location.href='?PID=promo_dm_copy&dm_id=<?php echo $_REQUEST["dm_id"];?>'" />
            	<?php 		$res=$adminobj->Query("select * from mail_queue where dm_id = ".$_REQUEST["dm_id"]." and dbname = '".$_SESSION["DomainData"]["dbname"]."'");
										$resnumrows=$adminobj->NumRows($res);?>		<?php if($resnumrows!=0&&$resnumrows!=NULL) {?>
            	<input type="button" name="Submit" value="変更" onclick="location.href='?PID=promo_dm_up&dm_id=<?php echo $_REQUEST["dm_id"]; ?>'" />
            	<input type="button" name="Submit" value="削除" onclick="location.href='?PID=promo_dm_del&dm_id=<?php echo $_REQUEST["dm_id"]; ?>'" />
            	<?php }?>	<input type="button" name="Submit" value="一覧へ戻る" onclick="history.back();" />
              <input name="mode" type="hidden" id="mode" value="update" />
              <input name="dm_id" type="hidden" id="dm_id" value="<?php echo $_REQUEST["dm_id"];?>" />
</td>
          </tr>
        </table>
       </form>
        </td> 
    </tr> 
</table> 
