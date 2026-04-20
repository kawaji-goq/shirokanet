<?php /*?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php
*/
$today=date("Y-m-d",time());
$gobj=new Group($dbobj);
$mobj=new Members($dbobj);
$gdata=$gobj->GetList(" turn ");
$mlist=$mobj->getList2();



if($_REQUEST["mode"]=="addition") {
	
	$maxsql="select max(cate_id) as maxid from todo_cate";
			$maxid=1;
			$maxdata=$dbobj->GetData($maxsql);
			$maxid+=$maxdata["maxid"];
			$inssql="insert into  todo_cate (cate_id,cate_name,comment,reg_time,up_time,deadline,status,from_member_id,to_member_id) values (".
											"$maxid,'".$_REQUEST["cate_name"]."','".$_REQUEST["comment"]."',".time().",".time().",".mktime(0,0,0,$_REQUEST["fmonth"],$_REQUEST["fday"],$_REQUEST["fyear"]).",0,".$logindata["member_id"].",".$_REQUEST["member_id"].")";
			$dbobj->Query($inssql);
			
			
/*
			$memsql="select * from member where member_id =".$_REQUEST["rlist"][$j];
			$memdata=$dbobj->GetData($memsql);
			
			if($_REQUEST["keitai_send"]==1&&$memdata["kmail"]!=NULL) {
					mb_send_mail($memdata["kmail"],$_REQUEST["title"],$_REQUEST["comment"],"From:".$logindata["mailaddress"]);
			}
			
*/
?>
<script language="javascript">
window.location.replace("index.php?PID=todo&cate_id=<?php echo $_GET["cate_id"];?>");	
</script>
<?php
}

$countsql="select * from todo where to_member_id=".$logindata["member_id"]." and status <> 10";
$countunreaddata["countnum"]=$dbobj->Count($countsql);

if($countunreaddata["countnum"]==NULL) {
	$countunreaddata["countnum"]=0;
}

$countsql="select * from todo where to_member_id=".$logindata["member_id"]." and status = 5";
$countdoingdata["countnum"]=$dbobj->Count($countsql);

if($countdoingdata["countnum"]==NULL) {
	
	$countdoingdata["countnum"]=0;
	
}

$countsql="select * from todo where to_member_id=".$logindata["member_id"]." and status = 10";
$countenddata["countnum"]=$dbobj->Count($countsql);

if($countenddata["countnum"]==NULL) {
	
	$countenddata["countnum"]=0;
	
}

$countsql="select * from todo where from_member_id=".$logindata["member_id"]." and to_member_id<>".$logindata["member_id"]." and status <> 10";
$countorderunenddata["countnum"]=$dbobj->Count($countsql);

if($countorderunenddata["countnum"]==NULL) {
	$countorderunenddata["countnum"]=0;
}

$countsql="select * from todo where from_member_id=".$logindata["member_id"]." and to_member_id<>".$logindata["member_id"]."  and status = 10";
$countorderenddata["countnum"]=$dbobj->Count($countsql);

if($countorderenddata["countnum"]==NULL) {
	$countorderenddata["countnum"]=0;
}
echo "<!-- ";
print_r($logindata);

print_r($mlist);
echo "--> ";

?>
<script language="javascript">

function Groupchange(num) {

	var selnum=document.add_form.elements[2].options[document.add_form.elements[2].options.selectedIndex].value;
	createlist(num,selnum);
	
}

function Groupchange1(num) {

	var selnum=document.add_form.elements[3].options[document.add_form.elements[3].options.selectedIndex].value;
	createlist1(num,selnum);
}


function createlist(num,num2) {
//	var addary2=new Array();
<?php

$newary1="";
$newary2="";

$GAList=$gobj->GetAllList();
$GSList=$gobj->GetAllSelList("");

?>
	clearlist(4);
	var i=document.add_form.elements[num].length;
	var j=0;
	switch(num2) {
		case "0":
<?php
			$grows2=0;
			while($GSList[$grows2]["member_id"]!=NULL) {
?>
				document.add_form.elements[num].options[<?php echo $grows2 ?>] = new Option("<?php echo $GSList[$grows2]["member_name"];?>","<?php echo $GSList[$grows2]["member_id"];?>");
				<?php
				$grows2++;
			}
			?>
		break;
		<?php 
		$grows=1;
		while($GAList[$grows-1]["group_id"]!=NULL) {
			$GSList="";
			$newary1="";
			$newary2="";
			$GSList=$gobj->GetAllSelList($GAList[$grows-1]["group_id"]);
			$grows2=0;
			?>
			case "<?php echo $GAList[$grows-1]["group_id"];?>" :
			<?php 
			while($GSList[$grows2]["member_id"]!=NULL) {
			?>
				document.add_form.elements[num].options[<?php echo $grows2 ?>] = new Option("<?php echo $GSList[$grows2]["member_name"];?>","<?php echo $GSList[$grows2]["member_id"];?>");
		<?php
				$grows2++;
			}
			?>
			break;
			<?php
			$grows++;
		}
		?>
	}
}


function createlist1(num,num2) {
//	var addary2=new Array();
<?php

$newary1="";
$newary2="";

$GAList=$gobj->GetAllList();
$GSList=$gobj->GetAllSelList("");

?>
	clearlist(7);
	var i=document.add_form.elements[num].length;
	var j=0;
	switch(num2) {
		case "0":
<?php
			$grows2=0;
			while($GSList[$grows2]["member_id"]!=NULL) {
?>
				document.add_form.elements[num].options[<?php echo $grows2 ?>] = new Option("<?php echo $GSList[$grows2]["member_name"];?>","<?php echo $GSList[$grows2]["member_id"];?>");
				<?php
				$grows2++;
			}
			?>
		break;
		<?php 
		$grows=1;
		while($GAList[$grows-1]["group_id"]!=NULL) {
			$GSList="";
			$newary1="";
			$newary2="";
			$GSList=$gobj->GetAllSelList($GAList[$grows-1]["group_id"]);
			$grows2=0;
			?>
			case "<?php echo $GAList[$grows-1]["group_id"];?>" :
			<?php 
			while($GSList[$grows2]["member_id"]!=NULL) {
			?>
				document.add_form.elements[num].options[<?php echo $grows2 ?>] = new Option("<?php echo $GSList[$grows2]["member_name"];?>","<?php echo $GSList[$grows2]["member_id"];?>");
		<?php
				$grows2++;
			}
			?>
			break;
			<?php
			$grows++;
		}
		?>
	}
}

function createlist2(num,num2) {
//	var addary2=new Array();
<?php

$newary1="";
$newary2="";

$GAList=$gobj->GetAllList();
$GSList=$gobj->GetAllSelList("");

?>
	clearlist(7);
	var i=document.add_form.elements[num].length;
	var j=0;
	switch(num2) {
		case "0":
<?php
			$grows2=0;
			while($GSList[$grows2]["member_id"]!=NULL) {
?>
				document.add_form.elements[num].options[<?php echo $grows2 ?>] = new Option("<?php echo $GSList[$grows2]["member_name"];?>","<?php echo $GSList[$grows2]["member_id"];?>");
				<?php
				$grows2++;
			}
			?>
		break;
		<?php 
		$grows=1;
		while($GAList[$grows-1]["group_id"]!=NULL) {
			$GSList="";
			$newary1="";
			$newary2="";
			$GSList=$gobj->GetAllSelList($GAList[$grows-1]["group_id"]);
			$grows2=0;
			?>
			case "<?php echo $GAList[$grows-1]["group_id"];?>" :
			<?php 
			while($GSList[$grows2]["member_id"]!=NULL) {
			?>
				document.add_form.elements[num].options[<?php echo $grows2 ?>] = new Option("<?php echo $GSList[$grows2]["member_name"];?>","<?php echo $GSList[$grows2]["member_id"];?>");
		<?php
				$grows2++;
			}
			?>
			break;
			<?php
			$grows++;
		}
		?>
	}
}



function chklist(num,id) {
	var i=document.add_form.elements[num].length;
	var j=0;
	while(j<i) {
		if(document.add_form.elements[num].options[j].value==id){
			return false;
		}
		j++;
	}
	return true;
}

function clearlist(num) {
	var i=document.add_form.elements[num].length;
	if(i!=0) {
		var j=0;
		while(document.add_form.elements[num].options[j]!=null) {
			document.add_form.elements[num].options[j]=null;
			j++;
		}
		i=document.add_form.elements[num].length;
		if(i!=0) {
			clearlist(num);
		}
	}
}

//リスト内の移動をする関数
function func(selectnum,selectnum2) {
	while (document.add_form.elements[selectnum].selectedIndex != -1) {
		var test=document.add_form.elements[selectnum2].length;
		var res=chklist(selectnum2,document.add_form.elements[selectnum].options[document.add_form.elements[selectnum].selectedIndex].value);
		
		if(res) {
			document.add_form.elements[selectnum2].options[test]
			= new Option(document.add_form.elements[selectnum].options[document.add_form.elements[selectnum].selectedIndex].text,document.add_form.elements[selectnum].options[document.add_form.elements[selectnum].selectedIndex].value);
		}
		
		if(selectnum<selectnum2) {
			document.add_form.elements[selectnum].options[document.add_form.elements[selectnum].selectedIndex] = null;
		}
		else {
			document.add_form.elements[selectnum].options[document.add_form.elements[selectnum].selectedIndex] = new Option(document.add_form.elements[selectnum].options[document.add_form.elements[selectnum].selectedIndex].text,document.add_form.elements[selectnum].options[document.add_form.elements[selectnum].selectedIndex].value);
		}
		
	}
}

//全リストを選択してデータを送信する関数
function senddata() {
	var oprows=0;
	
	while(oprows<document.add_form.elements[4].length) {
		document.add_form.elements[4].options[oprows].selected=true;
		oprows++;
	}
	
	document.add_form.submit();
}

function datachk(frm) {
	if(frm.title.value=="") {
		alert("タイトルを入力して下さい。");
	}
	else{
		res=confirm("この内容で更新してもよろしいですか？");
		if(res) {
			
			frm.mode.value="addition";
			senddata();
		}
	}
}

function datachk2(frm) {
	if(frm.title.value=="") {
		alert("タイトルを入力して下さい。");
	}
	else{
		res=confirm("この内容で更新してもよろしいですか？");
		if(res) {
			
			frm.mode.value="additionandmail";
			senddata();
		}
	}
}

function txtcopy(frm) {
	frm.m_sbj.value=frm.title.value;
	frm.m_txt.value=frm.comment.value;
}
</script>

<table width="100%"  border="0" align="center" cellpadding="2" cellspacing="2">
    <tr>
        <td colspan="2">
            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td >
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FCFCFC">
                            <tr>
                                <td width="4%"><img src="/GW/img/template/icon_todo.jpg" width="40" height="42"></td>
                                <td width="96%" class="title">TODO</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td width="220" valign="top"><?php
		
		include "leftmenu.php";
		?></td>
        <td valign="top">
            <table width="100%" border="0" cellspacing="1" cellpadding="1">
                <tr>
                    <td height="30" bgcolor="#DCDCFF">
                        <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1">
                            <form name="add_form" method="post" action=""><?php 
																												
																												$sregdate=explode("-",date("Y-m-d"));
																												?>
                                <tr>
                                    <td height="40" bgcolor="#EFF6FF">フォルダ名<br>
                                        <input name="cate_name" type="text" size="40" style="width:98%" id="cate_name">
                                    </td>
                                </tr>
                                <tr>
                                    <td>期限</td>
                                </tr>
                                <tr>
                                    <td bgcolor="#FFFFFF"><strong>
                                        <select name="fyear" id="fyear">
                                            <?php 
								$yrows=0;
								while($yrows<=5) {
								?>
                                            <option value="<?php echo ($sregdate[0]+$yrows);?>"<?php if(($sregdate[0]+$yrows)==$sregdate[0]) { echo "selected";}?>><?php echo ($sregdate[0]+$yrows);?>年</option>
                                            <?php
									$yrows++;
								}
							?>
                                        </select>
                                        <select name="fmonth">
                                            <option value="1"<?php if($sregdate[1]==1) { echo " selected";}?>>1月</option>
                                            <option value="2"<?php if($sregdate[1]==2) { echo " selected";}?>>2月</option>
                                            <option value="3"<?php if($sregdate[1]==3) { echo " selected";}?>>3月</option>
                                            <option value="4"<?php if($sregdate[1]==4) { echo " selected";}?>>4月</option>
                                            <option value="5"<?php if($sregdate[1]==5) { echo " selected";}?>>5月</option>
                                            <option value="6"<?php if($sregdate[1]==6) { echo " selected";}?>>6月</option>
                                            <option value="7"<?php if($sregdate[1]==7) { echo " selected";}?>>7月</option>
                                            <option value="8"<?php if($sregdate[1]==8) { echo " selected";}?>>8月</option>
                                            <option value="9"<?php if($sregdate[1]==9) { echo " selected";}?>>9月</option>
                                            <option value="10"<?php if($sregdate[1]==10) { echo " selected";}?>>10月</option>
                                            <option value="11"<?php if($sregdate[1]==11) { echo " selected";}?>>11月</option>
                                            <option value="12"<?php if($sregdate[1]==12) { echo " selected";}?>>12月</option>
                                        </select>
                                        <select name="fday" id="fday">
                                            <option<?php if($sregdate[2]==1) { echo " selected";}?> value="1">1日</option>
                                            <option<?php if($sregdate[2]==2) { echo " selected";}?> value="2">2日</option>
                                            <option<?php if($sregdate[2]==3) { echo " selected";}?> value="3">3日</option>
                                            <option<?php if($sregdate[2]==4) { echo " selected";}?> value="4">4日</option>
                                            <option<?php if($sregdate[2]==5) { echo " selected";}?> value="5">5日</option>
                                            <option<?php if($sregdate[2]==6) { echo " selected";}?> value="6">6日</option>
                                            <option<?php if($sregdate[2]==7) { echo " selected";}?> value="7">7日</option>
                                            <option<?php if($sregdate[2]==8) { echo " selected";}?> value="8">8日</option>
                                            <option<?php if($sregdate[2]==9) { echo " selected";}?> value="9">9日</option>
                                            <option<?php if($sregdate[2]==10) { echo " selected";}?> value="10">10日</option>
                                            <option<?php if($sregdate[2]==11) { echo " selected";}?> value="11">11日</option>
                                            <option<?php if($sregdate[2]==12) { echo " selected";}?> value="12">12日</option>
                                            <option<?php if($sregdate[2]==13) { echo " selected";}?> value="13">13日</option>
                                            <option<?php if($sregdate[2]==14) { echo " selected";}?> value="14">14日</option>
                                            <option<?php if($sregdate[2]==15) { echo " selected";}?> value="15">15日</option>
                                            <option<?php if($sregdate[2]==16) { echo " selected";}?> value="16">16日</option>
                                            <option<?php if($sregdate[2]==17) { echo " selected";}?> value="17">17日</option>
                                            <option<?php if($sregdate[2]==18) { echo " selected";}?> value="18">18日</option>
                                            <option<?php if($sregdate[2]==19) { echo " selected";}?> value="19">19日</option>
                                            <option<?php if($sregdate[2]==20) { echo " selected";}?> value="20">20日</option>
                                            <option<?php if($sregdate[2]==21) { echo " selected";}?> value="21">21日</option>
                                            <option<?php if($sregdate[2]==22) { echo " selected";}?> value="22">22日</option>
                                            <option<?php if($sregdate[2]==23) { echo " selected";}?> value="23">23日</option>
                                            <option<?php if($sregdate[2]==24) { echo " selected";}?> value="24">24日</option>
                                            <option<?php if($sregdate[2]==25) { echo " selected";}?> value="25">25日</option>
                                            <option<?php if($sregdate[2]==26) { echo " selected";}?> value="26">26日</option>
                                            <option<?php if($sregdate[2]==27) { echo " selected";}?> value="27">27日</option>
                                            <option<?php if($sregdate[2]==28) { echo " selected";}?> value="28">28日</option>
                                            <option<?php if($sregdate[2]==29) { echo " selected";}?> value="29">29日</option>
                                            <option<?php if($sregdate[2]==30) { echo " selected";}?> value="30">30日</option>
                                            <option<?php if($sregdate[2]==31) { echo " selected";}?> value="31">31日</option>
                                        </select>
                                    </strong> </td>
                                </tr>
                                <tr>
                                    <td>コメント</td>
                                </tr>
                                <tr>
                                    <td bgcolor="#FFFFFF">
                                        <textarea name="comment" cols="40" rows="10" id="comment" style="width:98%"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>作成先</td>
                                </tr>
                                <tr>
                                    <td bgcolor="#FFFFFF">
                                        <table width="700" border="0" cellpadding="1" cellspacing="1">
                                            <tr>
                                                <td>
                                                    <select name="member_id" id="member_id">
				<?php
				for($i=0;$mlist[$i]["member_id"]!=NULL;$i++) {
				?>
				<option value="<?php echo $mlist[$i]["member_id"] ?>"<?php if($logindata["member_id"]==$mlist[$i]["member_id"]){ echo " selected";}?>><?php echo $mlist[$i]["member_name"]?></option>
				<?php
				}
				?>
                                                    </select>
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td height="30">
                                                    <input name="btm_addition" type="button" id="btm_addition" value="登録する" onClick="datachk(this.form)">
                                                    <input name="btm_back" type="button" id="btm_back" value="戻る" onClick="window.location.href='index.php?PID=todo'">
                                                    <input name="senddate" type="hidden" id="senddate" value="<?php echo $today; ?>">
                                                    <strong>
                                                    <input name="mode" type="hidden" id="mode">
                                                    </strong></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </form>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td height="30">&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
</table>
