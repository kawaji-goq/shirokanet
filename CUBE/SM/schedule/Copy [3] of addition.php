<?php 
$scheobj=new Schedule($dbobj);

if($_REQUEST["mode"]=="addition") {
	$upresult=$scheobj->Addition($_POST);
	
}

if($_REQUEST["mode"]=="additionandmail") {
	$upresult=$scheobj->Addition($_POST);
}
$sregdate=explode("-",$_REQUEST["rdate"]);
$gobj=new Group($dbobj);
$mobj=new Member($dbobj);

$gdata=$gobj->GetList(" turn ");
$mdata=$mobj->GetList();
//$schedata=
//$scheobj->GetData($_REQUEST["sche_id"]);

?>
<script language="javascript">
<?php
/*
$newary1="";
$newary2="";
$GAList=$gobj->GetAllList();
$GSList=$gobj->GetAllSelList("");
$grows2=0;
echo "var addary1=new Array();\n";
echo "var addary2=new Array();\n";

while($GSList[$grows2]["member_id"]!=NULL) {
	if($grows2!=0){
	//$newary1.=",";
	//$newary2.=",";		
	}
	echo "addary1[\"0\"][\"".$grows2."\"]=\"".$GSList[$grows2]["member_id"]."\";\n";
	echo "addary2[\"0\"][\"".$grows2."\"]=\"".$GSList[$grows2]["member_name"]."\";\n";
	//$newary1.="\"".$GSList[$grows2]["member_id"]."\"";
	//$newary2.="\"".$GSList[$grows2]["member_name"]."\"";
	$grows2++;
}
*/
//echo $newary1.");\n";
//echo $newary2.");\n";
/*
$grows=1;
while($GAList[$grows-1]["group_id"]!=NULL) {
	$GSList="";
	$newary1="";
	$newary2="";
	$GSList=$gobj->GetAllSelList($GAList[$grows-1]["group_id"]);
	$grows2=0;
	while($GSList[$grows2]["member_id"]!=NULL) {
		echo "addary1[\"".$GSList[$grows-1]["group_id"]."\"][\"".$grows2."\"]=\"".$GSList[$grows2]["member_id"]."\";\n";
		echo "addary2[\"".$GSList[$grows-1]["group_id"]."\"][\"".$grows2."\"]=\"".$GSList[$grows2]["member_name"]."\";\n";
		$grows2++;
	}
	$grows++;
}*/
?>
function Groupchange(num) {
	var selnum=document.sche_form.elements[17].options[document.sche_form.elements[17].options.selectedIndex].value;
	createlist(num,selnum);
}
function createlist(num,num2) {
//	var addary2=new Array();
<?php

$newary1="";
$newary2="";
//echo $newary1.");\n";
//echo $newary2.");\n";
/*
*/
$GAList=$gobj->GetAllList();
$GSList=$gobj->GetAllSelList("");

?>
	clearlist(18);
	var i=document.sche_form.elements[num].length;
	var j=0;
	switch(num2) {
		case "0":
			<?php
			$grows2=0;
			while($GSList[$grows2]["member_id"]!=NULL) {
				if($grows2!=0){
				//$newary1.=",";
				//$newary2.=",";		
				}?>
				document.sche_form.elements[num].options[<?php echo $grows2 ?>] = new Option("<?php echo $GSList[$grows2]["member_name"];?>","<?php echo $GSList[$grows2]["member_id"];?>");
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
				document.sche_form.elements[num].options[<?php echo $grows2 ?>] = new Option("<?php echo $GSList[$grows2]["member_name"];?>","<?php echo $GSList[$grows2]["member_id"];?>");
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
	var i=document.sche_form.elements[num].length;
	var j=0;
	while(j<i) {
		if(document.sche_form.elements[num].options[j].value==id){
			return false;
		}
		j++;
	}
	return true;
}
function clearlist(num) {
	var i=document.sche_form.elements[num].length;
	if(i!=0) {
		var j=0;
		while(document.sche_form.elements[num].options[j]!=null) {
			document.sche_form.elements[num].options[j]=null;
			j++;
		}
		i=document.sche_form.elements[num].length;
		if(i!=0) {
			clearlist(num);
		}
	}
}
//リスト内の移動をする関数
function func(selectnum,selectnum2) {
	while (document.sche_form.elements[selectnum].selectedIndex != -1) {
		var test=document.sche_form.elements[selectnum2].length;
		var res=chklist(selectnum2,document.sche_form.elements[selectnum].options[document.sche_form.elements[selectnum].selectedIndex].value);
		if(res) {
			document.sche_form.elements[selectnum2].options[test]
			= new Option(document.sche_form.elements[selectnum].options[document.sche_form.elements[selectnum].selectedIndex].text,document.sche_form.elements[selectnum].options[document.sche_form.elements[selectnum].selectedIndex].value);
		}
		if(selectnum<selectnum2) {
			document.sche_form.elements[selectnum].options[document.sche_form.elements[selectnum].selectedIndex] = null;
		}
		else {
			document.sche_form.elements[selectnum].options[document.sche_form.elements[selectnum].selectedIndex] = new Option(document.sche_form.elements[selectnum].options[document.sche_form.elements[selectnum].selectedIndex].text,document.sche_form.elements[selectnum].options[document.sche_form.elements[selectnum].selectedIndex].value);
		}
	}
	
}
//全リストを選択してデータを送信する関数
function senddata() {
	var oprows=0;
	
	while(oprows<document.sche_form.elements[18].length) {
		document.sche_form.elements[18].options[oprows].selected=true;
		oprows++;
	}
	
	document.sche_form.submit();
}

function datachk(frm) {
	res=confirm("この内容で更新してもよろしいですか？");
	if(res) {
		
		frm.mode.value="addition";
		senddata();
	}
}
function datachk2(frm) {
	res=confirm("この内容で更新してもよろしいですか？");
	if(res) {
		
		frm.mode.value="additionandmail";
		senddata();
	}
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<div id="files">
	<table width="740"  border="0" align="center" cellpadding="2" cellspacing="2">
		<tr>
			<td align="left" valign="middle">
				<table width="100%" border="0" cellpadding="2" cellspacing="2">
					<tr>
						<td width="45"><img src="/members/img/sche_sic.gif" width="42" height="38"></td>
						<td>
							<div id="tree"><span class="top">スケジュール</span>　<span class="gt">>></span>　<span class="sub"><?php echo $schedata["title"];?></span></div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="left" valign="top">
				<?php 
				if($_REQUEST["mode"]=="addition") {
				?>
				<table width="700" border="0" align="center" cellpadding="2" cellspacing="2">
                	<tr>
                		<td>&nbsp;</td>
               		</tr>
                	<tr>
                		<td>
                			<div align="center"><strong>
               				以下の内容でスケジュールを登録しました。</strong></div>
                		</td>
               		</tr>
                	<tr>
                		<td>&nbsp;</td>
               		</tr>
               	</table>
				<table width="700"  border="0" align="center" cellpadding="2" cellspacing="2">
                	<tr>
                		<td colspan="2">&nbsp;</td>
               		</tr>
                	<tr>
                		<td width="100" background="/members/img/filemenu_bg.gif">
                			<div align="right"><strong>開始日時</strong></div>
                		</td>
               		    <td><?php echo $_REQUEST["syear"]."年".$_REQUEST["smonth"]."月".$_REQUEST["sday"]."日 ".$_REQUEST["stime"];?></td>
                	</tr>
                	<tr>
                		<td width="100" background="/members/img/filemenu_bg.gif">
                			<div align="right"><strong>終了日時</strong></div>
                		</td>
                		<td><?php echo $_REQUEST["fyear"]."年".$_REQUEST["fmonth"]."月".$_REQUEST["fday"]."日 ".$_REQUEST["ftime"];?></td>
               		</tr>
                	<tr>
                		<td width="100" background="/members/img/filemenu_bg.gif">
                			<div align="right"><strong>タイトル</strong></div>
                		</td>
                		<td><?php echo $_REQUEST["title"] ?></td>
               		</tr>
                	<tr>
                		<td width="100" valign="top" background="/members/img/filemenu_bg.gif">
                			<div align="right"><strong>表示</strong></div>
                		</td>
                		<td><?php 
						switch($_REQUEST["view_type"]) {
						case 0:
							echo "会員専用";
							break;
						case 1:
							echo "全てに表示";
							break;
						 
						}?> </td>
               		</tr>
                	<tr>
                		<td width="100" align="right" valign="top" background="/members/img/filemenu_bg.gif"><strong>日付表示</strong></td>
                		<td><?php 
						switch($_REQUEST["day_view"]) {
						case 0:
							echo "表示しない";
							break;
						case 1:
							echo "表示する";
							break;
						}
						?>&nbsp;</td>
               		</tr>
                	<tr>
                		<td width="100" valign="top" background="/members/img/filemenu_bg.gif">
                			<div align="right"><strong>内容</strong></div>
                		</td>
               		    <td><?php echo nl2br($_REQUEST["comment"]);?></td>
                	</tr>
                	<tr>
                		<td colspan="2">&nbsp;               			</td>
               		</tr>
                	<tr>
                		<td colspan="2">
                			<input name="hisback" type="button" id="hisback" value="戻る" onClick="window.location.href='index.php?PID=schedule'">
                		</td>
           		    </tr>
               	</table>
				<?php 
				}
				else {
				?>
				<table width="700"  border="0" align="center" cellpadding="2" cellspacing="2">
					<form action="" method="post" name="sche_form" id="sche_form">
						<tr>
							<td colspan="2">&nbsp;</td>
						</tr>
						<tr>
							<td width="100" background="/members/img/filemenu_bg.gif">
								<div align="right"><strong>開始日時</strong></div>
							</td>
							<td>
								<select name="syear" id="syear">
									<?php 
								$yrows=-5;
								while($yrows<=5) {
								?>
									<option value="<?php echo ($sregdate[0]+$yrows);?>"<?php if(($sregdate[0]+$yrows)==$sregdate[0]) { echo "selected";}?>><?php echo ($sregdate[0]+$yrows);?></option>
									<?php
									$yrows++;
								}
							?>
								</select>
								<strong>年
								<select name="smonth">
									<option value="1"<?php if($sregdate[1]==1) { echo " selected";}?>>1</option>
									<option value="2"<?php if($sregdate[1]==2) { echo " selected";}?>>2</option>
									<option value="3"<?php if($sregdate[1]==3) { echo " selected";}?>>3</option>
									<option value="4"<?php if($sregdate[1]==4) { echo " selected";}?>>4</option>
									<option value="5"<?php if($sregdate[1]==5) { echo " selected";}?>>5</option>
									<option value="6"<?php if($sregdate[1]==6) { echo " selected";}?>>6</option>
									<option value="7"<?php if($sregdate[1]==7) { echo " selected";}?>>7</option>
									<option value="8"<?php if($sregdate[1]==8) { echo " selected";}?>>8</option>
									<option value="9"<?php if($sregdate[1]==9) { echo " selected";}?>>9</option>
									<option value="10"<?php if($sregdate[1]==10) { echo " selected";}?>>10</option>
									<option value="11"<?php if($sregdate[1]==11) { echo " selected";}?>>11</option>
									<option value="12"<?php if($sregdate[1]==12) { echo " selected";}?>>12</option>
								</select>
								月
								<select name="sday" id="sday">
									<option<?php if($sregdate[2]==1) { echo " selected";}?>>1</option>
									<option<?php if($sregdate[2]==2) { echo " selected";}?>>2</option>
									<option<?php if($sregdate[2]==3) { echo " selected";}?>>3</option>
									<option<?php if($sregdate[2]==4) { echo " selected";}?>>4</option>
									<option<?php if($sregdate[2]==5) { echo " selected";}?>>5</option>
									<option<?php if($sregdate[2]==6) { echo " selected";}?>>6</option>
									<option<?php if($sregdate[2]==7) { echo " selected";}?>>7</option>
									<option<?php if($sregdate[2]==8) { echo " selected";}?>>8</option>
									<option<?php if($sregdate[2]==9) { echo " selected";}?>>9</option>
									<option<?php if($sregdate[2]==10) { echo " selected";}?>>10</option>
									<option<?php if($sregdate[2]==11) { echo " selected";}?>>11</option>
									<option<?php if($sregdate[2]==12) { echo " selected";}?>>12</option>
									<option<?php if($sregdate[2]==13) { echo " selected";}?>>13</option>
									<option<?php if($sregdate[2]==14) { echo " selected";}?>>14</option>
									<option<?php if($sregdate[2]==15) { echo " selected";}?>>15</option>
									<option<?php if($sregdate[2]==16) { echo " selected";}?>>16</option>
									<option<?php if($sregdate[2]==17) { echo " selected";}?>>17</option>
									<option<?php if($sregdate[2]==18) { echo " selected";}?>>18</option>
									<option<?php if($sregdate[2]==19) { echo " selected";}?>>19</option>
									<option<?php if($sregdate[2]==20) { echo " selected";}?>>20</option>
									<option<?php if($sregdate[2]==21) { echo " selected";}?>>21</option>
									<option<?php if($sregdate[2]==22) { echo " selected";}?>>22</option>
									<option<?php if($sregdate[2]==23) { echo " selected";}?>>23</option>
									<option<?php if($sregdate[2]==24) { echo " selected";}?>>24</option>
									<option<?php if($sregdate[2]==25) { echo " selected";}?>>25</option>
									<option<?php if($sregdate[2]==26) { echo " selected";}?>>26</option>
									<option<?php if($sregdate[2]==27) { echo " selected";}?>>27</option>
									<option<?php if($sregdate[2]==28) { echo " selected";}?>>28</option>
									<option<?php if($sregdate[2]==29) { echo " selected";}?>>29</option>
									<option<?php if($sregdate[2]==30) { echo " selected";}?>>30</option>
									<option<?php if($sregdate[2]==31) { echo " selected";}?>>31</option>
								</select>
								日
								<?php 
								$nowhour=date("H");
								
								?>
								<select name="shour" id="shour">
									<option selected>--</option>
									<option>0</option>
									<option>1</option>
									<option>2</option>
									<option>3</option>
									<option></option>4</option>
									<option<?php if($nowhour==5){ echo " ";}?>>5</option>
									<option<?php if($nowhour==6){ echo " ";}?>>6</option>
									<option<?php if($nowhour==7){ echo " ";}?>>7</option>
									<option<?php if($nowhour==8){ echo " ";}?>>8</option>
									<option<?php if($nowhour==9){ echo " ";}?>>9</option>
									<option<?php if($nowhour==10){ echo " ";}?>>10</option>
									<option<?php if($nowhour==11){ echo " ";}?>>11</option>
									<option<?php if($nowhour==12){ echo " ";}?>>12</option>
									<option<?php if($nowhour==13){ echo " ";}?>>13</option>
									<option<?php if($nowhour==14){ echo " ";}?>>14</option>
									<option<?php if($nowhour==15){ echo " ";}?>>15</option>
									<option<?php if($nowhour==16){ echo " ";}?>>16</option>
									<option<?php if($nowhour==17){ echo " ";}?>>17</option>
									<option<?php if($nowhour==18){ echo " ";}?>>18</option>
									<option<?php if($nowhour==19){ echo " ";}?>>19</option>
									<option<?php if($nowhour==20){ echo " ";}?>>20</option>
									<option<?php if($nowhour==21){ echo " ";}?>>21</option>
									<option<?php if($nowhour==22){ echo " ";}?>>22</option>
									<option<?php if($nowhour==23){ echo " ";}?>>23</option>
									<option<?php if($nowhour==24){ echo " ";}?>>24</option>
								</select>
								時
								<select name="smin">
									<option value="--" selected>--</option>
									<option value="00" >00</option>
									<option value="30">30</option>
								</select>
								分〜 </strong></td>
						</tr>
						<tr>
							<td width="100" background="/members/img/filemenu_bg.gif">
								<div align="right"><strong>終了日時</strong></div>
							</td>
							<td><strong>
								<select name="fyear" id="fyear">
									<?php 
								$yrows=-5;
								while($yrows<=5) {
								?>
									<option value="<?php echo ($sregdate[0]+$yrows);?>"<?php if(($sregdate[0]+$yrows)==$sregdate[0]) { echo "selected";}?>><?php echo ($sregdate[0]+$yrows);?></option>
									<?php
									$yrows++;
								}
							?>
								</select>
								年
								<select name="fmonth">
									<option value="1"<?php if($sregdate[1]==1) { echo " selected";}?>>1</option>
									<option value="2"<?php if($sregdate[1]==2) { echo " selected";}?>>2</option>
									<option value="3"<?php if($sregdate[1]==3) { echo " selected";}?>>3</option>
									<option value="4"<?php if($sregdate[1]==4) { echo " selected";}?>>4</option>
									<option value="5"<?php if($sregdate[1]==5) { echo " selected";}?>>5</option>
									<option value="6"<?php if($sregdate[1]==6) { echo " selected";}?>>6</option>
									<option value="7"<?php if($sregdate[1]==7) { echo " selected";}?>>7</option>
									<option value="8"<?php if($sregdate[1]==8) { echo " selected";}?>>8</option>
									<option value="9"<?php if($sregdate[1]==9) { echo " selected";}?>>9</option>
									<option value="10"<?php if($sregdate[1]==10) { echo " selected";}?>>10</option>
									<option value="11"<?php if($sregdate[1]==11) { echo " selected";}?>>11</option>
									<option value="12"<?php if($sregdate[1]==12) { echo " selected";}?>>12</option>
								</select>
								月
								<select name="fday" id="fday">
									<option<?php if($sregdate[2]==1) { echo " selected";}?>>1</option>
									<option<?php if($sregdate[2]==2) { echo " selected";}?>>2</option>
									<option<?php if($sregdate[2]==3) { echo " selected";}?>>3</option>
									<option<?php if($sregdate[2]==4) { echo " selected";}?>>4</option>
									<option<?php if($sregdate[2]==5) { echo " selected";}?>>5</option>
									<option<?php if($sregdate[2]==6) { echo " selected";}?>>6</option>
									<option<?php if($sregdate[2]==7) { echo " selected";}?>>7</option>
									<option<?php if($sregdate[2]==8) { echo " selected";}?>>8</option>
									<option<?php if($sregdate[2]==9) { echo " selected";}?>>9</option>
									<option<?php if($sregdate[2]==10) { echo " selected";}?>>10</option>
									<option<?php if($sregdate[2]==11) { echo " selected";}?>>11</option>
									<option<?php if($sregdate[2]==12) { echo " selected";}?>>12</option>
									<option<?php if($sregdate[2]==13) { echo " selected";}?>>13</option>
									<option<?php if($sregdate[2]==14) { echo " selected";}?>>14</option>
									<option<?php if($sregdate[2]==15) { echo " selected";}?>>15</option>
									<option<?php if($sregdate[2]==16) { echo " selected";}?>>16</option>
									<option<?php if($sregdate[2]==17) { echo " selected";}?>>17</option>
									<option<?php if($sregdate[2]==18) { echo " selected";}?>>18</option>
									<option<?php if($sregdate[2]==19) { echo " selected";}?>>19</option>
									<option<?php if($sregdate[2]==20) { echo " selected";}?>>20</option>
									<option<?php if($sregdate[2]==21) { echo " selected";}?>>21</option>
									<option<?php if($sregdate[2]==22) { echo " selected";}?>>22</option>
									<option<?php if($sregdate[2]==23) { echo " selected";}?>>23</option>
									<option<?php if($sregdate[2]==24) { echo " selected";}?>>24</option>
									<option<?php if($sregdate[2]==25) { echo " selected";}?>>25</option>
									<option<?php if($sregdate[2]==26) { echo " selected";}?>>26</option>
									<option<?php if($sregdate[2]==27) { echo " selected";}?>>27</option>
									<option<?php if($sregdate[2]==28) { echo " selected";}?>>28</option>
									<option<?php if($sregdate[2]==29) { echo " selected";}?>>29</option>
									<option<?php if($sregdate[2]==30) { echo " selected";}?>>30</option>
									<option<?php if($sregdate[2]==31) { echo " selected";}?>>31</option>
								</select>
								日
								<?php 
							//$sftime=explode(":",$schedata["ftime"]);
							
							?>
                                <select name="fhour">
									<option selected>--</option>
									<option>0</option>
									<option>1</option>
									<option>2</option>
									<option>3</option>
									<option></option>4</option>
									<option<?php if($nowhour==5){ echo " ";}?>>5</option>
									<option<?php if($nowhour==6){ echo " ";}?>>6</option>
									<option<?php if($nowhour==7){ echo " ";}?>>7</option>
									<option<?php if($nowhour==8){ echo " ";}?>>8</option>
									<option<?php if($nowhour==9){ echo " ";}?>>9</option>
									<option<?php if($nowhour==10){ echo " ";}?>>10</option>
									<option<?php if($nowhour==11){ echo " ";}?>>11</option>
									<option<?php if($nowhour==12){ echo " ";}?>>12</option>
									<option<?php if($nowhour==13){ echo " ";}?>>13</option>
									<option<?php if($nowhour==14){ echo " ";}?>>14</option>
									<option<?php if($nowhour==15){ echo " ";}?>>15</option>
									<option<?php if($nowhour==16){ echo " ";}?>>16</option>
									<option<?php if($nowhour==17){ echo " ";}?>>17</option>
									<option<?php if($nowhour==18){ echo " ";}?>>18</option>
									<option<?php if($nowhour==19){ echo " ";}?>>19</option>
									<option<?php if($nowhour==20){ echo " ";}?>>20</option>
									<option<?php if($nowhour==21){ echo " ";}?>>21</option>
									<option<?php if($nowhour==22){ echo " ";}?>>22</option>
									<option<?php if($nowhour==23){ echo " ";}?>>23</option>
									<option<?php if($nowhour==24){ echo " ";}?>>24</option>
                                	</select>								
                                時
								<select name="fmin">
									<option value="--" selected>--</option>
									<option value="00" >00</option>
									<option value="30">30</option>
								</select>
								分</strong></td>
						</tr>
						<tr>
							<td width="100" background="/members/img/filemenu_bg.gif">
								<div align="right"><strong>タイトル</strong></div>
							</td>
							<td>
								<input name="title" type="text" id="title" value="<?php echo $schedata["title"] ?>" size="50">
							</td>
						</tr>
						<tr>
							<td width="100" valign="top" background="/members/img/filemenu_bg.gif">
								<div align="right"><strong>表示</strong></div>
							</td>
							<td>
								<select name="view_type" id="view_type">
                                	<option value="0" selected>会員専用</option>
                                	<option value="1">全てに表示</option>
                               	</select>
							</td>
						</tr>
						<tr>
							<td width="100" align="right" valign="top" background="/members/img/filemenu_bg.gif"><strong>日付表示</strong></td>
							<td>
								<select name="day_view" id="day_view">
									<option value="0" selected>表示しない</option>
									<option value="1">表示する</option>
								</select>
							</td>
						</tr>
						<tr>
							<td width="100" valign="top" background="/members/img/filemenu_bg.gif">
								<div align="right"><strong>
内容</strong></div>
							</td>
							<td>
								<?php 
								$fckobject=new FCKeditor("comment");
								$fckobject->BasePath="/FCKeditor/";
								$fckobject->Width=500;
								$fckobject->Height=400;
								$fckobject->ToolbarSet='Mymenu';
								$fckobject->Value=$schedata["comment"];
								$fckobject->Create();
								?>
							</td>
						</tr>
						<tr>
							<th align="right" valign="top" background="/members/img/filemenu_bg.gif">出欠確認</th>
							<td>
								<input name="mail_send" type="radio" value="0" checked>
不要
<input name="mail_send" type="radio" value="1">
必要 </td>
						</tr>
						<tr>
							<th width="100" align="right" valign="top" background="/members/img/filemenu_bg.gif">参加者</th>
						    <td>
						    	<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
                                	<tr>
                                		<th align="left">
                                			<select name="menu1" onChange="Groupchange(18)">
											<option value="" selected>個別選択</option>
                                            	<option value="0">全会員</option>
                                            	<?php
										   	$GAROWS=0;
											while($GAList[$GAROWS]["group_id"]!=NULL) {
												echo "<option value=\"".$GAList[$GAROWS]["group_id"]."\">".$GAList[$GAROWS]["group_name"]."</option>";
												$GAROWS++;
											}
										   ?>
                                            	</select>
                                		</th>
                                		<td>&nbsp;</td>
                                		<th align="left">&nbsp;                                		</th>
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
                                						<input type="button" name="Submit" value="←追加" onClick="func(21,18)">
                               						</td>
                               					</tr>
                                				<tr>
                                					<td align="center">
                                						<input type="button" name="Submit" value="削除→" onClick="func(18,21)">
                               						</td>
                               					</tr>
                               				</table>
                               			</td>
                                		<td width="200">
                                			<select name="nrlist" size="10" multiple id="nrlist" style="width:100%;">
                				<?php
								$mrows=0;
								while($mdata[$mrows]["member_id"]!=NULL) {
								?><option value="<?php echo $mdata[$mrows]["member_id"] ?>">
			<?php echo $mdata[$mrows]["member_name"] ?>
			</option>
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
							<td colspan="2">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="2">
								<input name="mode" type="hidden" id="mode" value=" "> 
								<input name="sche_id" type="hidden" id="sche_id" value="<?php echo $_REQUEST["sche_id"]; ?>">
                                <input name="member_id" type="hidden" id="member_id" value="0">
</td>
						</tr>
						<tr>
							<td height="30" colspan="2">
								<input name="sche_add" type="button" id="sche_add" value="追加する" onClick="datachk(this.form)">
								<input name="sche_add" type="button" id="sche_add" value="追加してメールを送信する" onClick="datachk2(this.form)">
								<input name="hisback" type="button" id="hisback" value="戻る" onClick="window.location.href='index.php?PID=schedule'">
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
			<td align="left" valign="top">
				<div id="calender"> </div>
			</td>
		</tr>
	</table>
</div>
