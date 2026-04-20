<?php 
$scheobj=new Schedule($dbobj);

if($_REQUEST["mode"]=="addition") {
	$upresult=$scheobj->Addition($_POST);
	$send_address=$_REQUEST["m_raddress"];
	if($_REQUEST["mail_save_chk"]==1) {
		$s_sql="select max(temp_id) as maxid from mail_templete ";
		$s_data=$dbobj->GetOneData($s_sql);
		$maxid=1+$s_data["maxid"];
		$inssql="insert into mail_templete(temp_id,subject,check_address,m_text) ".
				" values (".$maxid.",'".$_REQUEST[""]."','".$_REQUEST["send_address"]."','".$_REQUEST["mailtxt"]."')";
		$dbobj->Query($inssql);
	}
	if($_REQUEST["sche_save_chk"]==1) {
		$s_sql="select max(temp_id) as maxid from sche_temp";
		$s_data=$dbobj->GetOneData($s_sql);
		$maxid=1+$s_data["maxid"];
		$inssql="insert into sche_temp(temp_id,sche_title,sche_text,view_chk,date_view) ".
				" values (".$maxid.",'".$_REQUEST[""]."','".$send_address."','".$mailtxt."')";
		$dbobj->Query($inssql);
	}
	
}

if($_REQUEST["mode"]=="additionandmail") {
	$upresult=$scheobj->Addition($_POST);
	//メールテンプレート登録
	if($_REQUEST["PROCCESS"]=="regist") {
		$send_address=$_REQUEST["m_raddress"];
		if($_REQUEST["save_chk"]==1) {
			$s_sql="select max(temp_id) as maxid from mail_templete ";
			$s_data=$dbobj->GetOneData($s_sql);
			$maxid=1+$s_data["maxid"];
			$inssql="insert into mail_templete(temp_id,subject,check_address,m_text) ".
					" values (".$maxid.",'".$sbj."','".$send_address."','".$mailtxt."')";
			$dbobj->Query($inssql);
		}
		
		$rrows=0;
		//$members_list="\n---------------------------------------------------\n以上のメンバーにメールを送信しました。\n";
		
		$sbj=mb_convert_kana($sbj,"KV","EUC-JP");
		$mailtxt=mb_convert_kana($mailtxt,"KV","EUC-JP");
		
		//会員にメールを送信
		while($_REQUEST["rlist"][$rrows]!=NULL){
			
			$m_sql="select * from member where member_id = ".$_REQUEST["rlist"][$rrows];
			$m_data=$dbobj->GetOneData($m_sql);

			switch($_REQUEST["mail_type"]) {
			
				case 1:
					$send_address=$m_data["mailaddress"];
					//$members_list.=$m_data["member_name"]."\n";
					$sbj=mb_convert_kana($sbj,"KV");
					$mailtxt=mb_convert_kana($mailtxt,"KV");
					//$mres=mb_send_mail($send_address,$sbj,$mailtxt.$members_list,"From:".$_REQUEST["m_raddress"]."\n");
					break;
					
				case 2:
					if($m_data["kmail"]!=NULL) {
						$send_address=$m_data["kmail"];
						$sbj=mb_convert_kana($sbj,"KV");
						$mailtxt=mb_convert_kana($mailtxt,"KV");
						//$mres=mb_send_mail($send_address,$sbj,$mailtxt.$members_list,"From:".$_REQUEST["m_raddress"]."\n");
					}
					else {
						$send_address=$m_data["mailaddress"];
					}
					$sbj=mb_convert_kana($sbj,"KV");
					$mailtxt=mb_convert_kana($mailtxt,"KV");
					//$mres=mb_send_mail($send_address,$sbj,$mailtxt.$members_list,"From:".$_REQUEST["m_raddress"]."\n");
					break;
			}
			
			$rrows++;
		}
		//echo $send_address;
		//$mres=mb_send_mail($send_address,$sbj,$mailtxt.$members_list,"From:".$_REQUEST["m_raddress"]."\n");
		/*if($mres) {
			echo "成功";
		}
		else {
			echo "失敗";
		}
		*/
	
}

$sregdate=explode("-",$_REQUEST["rdate"]);
$gobj=new Group($dbobj);
$mobj=new Member($dbobj);

$gdata=$gobj->GetList(" turn ");
$mdata=$mobj->GetList();
if($_REQUEST["PROCCESS"]=="mtmpdel"&&$_REQUEST["temp_id"]!=NULL) {
	$tmpsql="delete from mail_templete where temp_id= ".$_REQUEST["temp_id"];
	$tmpdata=$dbobj->GetData($tmpsql);
}

$tmpsql="select * from mail_templete";
$tmpdata=$dbobj->GetData($tmpsql);
$stmpsql="select * from sche_temp";
$stmpdata=$dbobj->GetData($stmpsql);

//$schedata=
//$scheobj->GetData($_REQUEST["sche_id"]);

?>
<script language="javascript">
function mtempdel(frm) {
	var num1=document.sche_form.elements[27].selectedIndex;
	var num2=document.sche_form.elements[27].options[num1].value;
	window.location.href="/admin/index.php?PID=sche_add&rdate=2007-02-12&PROCCESS=mtmpdel&temp_id="+num2;
}
function tmpchange2(frm) {
	var num1=document.sche_form.elements[27].selectedIndex;
	var num2=document.sche_form.elements[27].options[num1].value;
	switch(num2) {
	<?php
	$tmprows=0;
	while($tmpdata[$tmprows]["temp_id"]!=NULL) {
	?>
		case "<?php echo $tmpdata[$tmprows]["temp_id"];?>":
		frm.m_sbj.value="<?php echo $tmpdata[$tmprows]["subject"];?>";
		frm.m_txt.value="<?php echo str_replace("\n","\\n",str_replace("\r","",$tmpdata[$tmprows]["m_text"]));?>";
		frm.m_raddress.value="<?php echo $tmpdata[$tmprows]["check_address"];?>";
		break;
		<?php
		$tmprows++;
	}
	?>
	}
}

function Groupchange(num) {
	var selnum=document.sche_form.elements[18].options[document.sche_form.elements[18].options.selectedIndex].value;
	createlist(num,selnum);
}

function Groupchange2(num) {
	//alert(document.sche_form.elements[32].name);
	var selnum=document.sche_form.elements[32].options[document.sche_form.elements[32].options.selectedIndex].value;
	createlist(num,selnum);
}

function createlist(num,num2) {
<?php
$newary1="";
$newary2="";
$GAList=$gobj->GetAllList();
$GSList=$gobj->GetAllSelList("");

?>
	clearlist(num);
	var i=document.sche_form.elements[num].length;
	var j=0;
	switch(num2) {
		case "0":
			<?php
			$grows2=0;
			while($GSList[$grows2]["member_id"]!=NULL) {
				?>
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
	
	while(oprows<document.sche_form.elements[17].length) {
		document.sche_form.elements[17].options[oprows].selected=true;
		oprows++;
	}
	
	document.sche_form.submit();
}

function datachk(frm) {
	res=confirm("この内容で登録してもよろしいですか？");
	if(res) {
		
		frm.mode.value="addition";
		senddata();
	}
}

function datachk2(frm) {
	res=confirm("この内容で登録してもよろしいですか？");
	if(res) {
		
		frm.mode.value="additionandmail";
		senddata();
	}
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<div id="files">
	<table width="740"  border="0" align="center" cellpadding="2" cellspacing="2">
					<form action="" method="post" name="sche_form" id="sche_form">
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
				if($_REQUEST["mode"]=="additionandmail") {
					?>
					<?php 
				}
				else {
				?>
<table width="700"  border="0" align="center" cellpadding="2" cellspacing="2">
						<tr>
							<td colspan="2">&nbsp;</td>
						</tr>
						<tr>
							<td width="140" background="/members/img/filemenu_bg.gif">
								<div align="right"><strong>開始日時：</strong></div>
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
									<option<?php if($nowhour==0){ echo " selected";}?>>1</option>
									<option<?php if($nowhour==1){ echo " selected";}?>>2</option>
									<option<?php if($nowhour==2){ echo " selected";}?>>3</option>
									<option<?php if($nowhour==3){ echo " selected";}?>>4</option>
									<option<?php if($nowhour==4){ echo " selected";}?>>10</option>
									<option<?php if($nowhour==5){ echo " selected";}?>>11</option>
									<option<?php if($nowhour==6){ echo " selected";}?>>6</option>
									<option<?php if($nowhour==7){ echo " selected";}?>>7</option>
									<option<?php if($nowhour==8){ echo " selected";}?>>8</option>
									<option<?php if($nowhour==9){ echo " selected";}?>>9</option>
									<option<?php if($nowhour==10){ echo " selected";}?>>10</option>
									<option<?php if($nowhour==11){ echo " selected";}?>>11</option>
									<option<?php if($nowhour==12){ echo " selected";}?>>12</option>
									<option<?php if($nowhour==13){ echo " selected";}?>>13</option>
									<option<?php if($nowhour==14){ echo " selected";}?>>14</option>
									<option<?php if($nowhour==15){ echo " selected";}?>>15</option>
									<option<?php if($nowhour==16){ echo " selected";}?>>16</option>
									<option<?php if($nowhour==17){ echo " selected";}?>>17</option>
									<option<?php if($nowhour==18){ echo " selected";}?>>18</option>
									<option<?php if($nowhour==19){ echo " selected";}?>>19</option>
									<option<?php if($nowhour==20){ echo " selected";}?>>20</option>
									<option<?php if($nowhour==21){ echo " selected";}?>>21</option>
									<option<?php if($nowhour==22){ echo " selected";}?>>22</option>
									<option<?php if($nowhour==23){ echo " selected";}?>>23</option>
									<option<?php if($nowhour==24){ echo " selected";}?>>24</option>
								</select>
								時
								<select name="smin">
									<option value="00" selected>00</option>
									<option value="30">30</option>
								</select>
								分〜 </strong></td>
						</tr>
						<tr>
							<td width="140" background="/members/img/filemenu_bg.gif">
								<div align="right"><strong>終了日時：</strong></div>
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
									<option<?php if($nowhour==0){ echo " selected";}?>>6</option>
									<option<?php if($nowhour==1){ echo " selected";}?>>7</option>
									<option<?php if($nowhour==2){ echo " selected";}?>>8</option>
									<option<?php if($nowhour==3){ echo " selected";}?>>9</option>
									<option<?php if($nowhour==4){ echo " selected";}?>>10</option>
									<option<?php if($nowhour==5){ echo " selected";}?>>11</option>
									<option<?php if($nowhour==6){ echo " selected";}?>>6</option>
									<option<?php if($nowhour==7){ echo " selected";}?>>7</option>
									<option<?php if($nowhour==8){ echo " selected";}?>>8</option>
									<option<?php if($nowhour==9){ echo " selected";}?>>9</option>
									<option<?php if($nowhour==10){ echo " selected";}?>>10</option>
									<option<?php if($nowhour==11){ echo " selected";}?>>11</option>
									<option<?php if($nowhour==12){ echo " selected";}?>>12</option>
									<option<?php if($nowhour==13){ echo " selected";}?>>13</option>
									<option<?php if($nowhour==14){ echo " selected";}?>>14</option>
									<option<?php if($nowhour==15){ echo " selected";}?>>15</option>
									<option<?php if($nowhour==16){ echo " selected";}?>>16</option>
									<option<?php if($nowhour==17){ echo " selected";}?>>17</option>
									<option<?php if($nowhour==18){ echo " selected";}?>>18</option>
									<option<?php if($nowhour==19){ echo " selected";}?>>19</option>
									<option<?php if($nowhour==20){ echo " selected";}?>>20</option>
									<option<?php if($nowhour==21){ echo " selected";}?>>21</option>
									<option<?php if($nowhour==22){ echo " selected";}?>>22</option>
									<option<?php if($nowhour==23){ echo " selected";}?>>21</option>
									<option<?php if($nowhour==24){ echo " selected";}?>>22</option>
								</select>
								時
								<select name="fmin">
									<option value="00" selected>00</option>
									<option value="30">30</option>
								</select>
								分</strong></td>
						</tr>
						<tr>
							<td width="140" align="right" background="/members/img/filemenu_bg.gif"><strong>テンプレートを使用：</strong></td>
							<td>
								<select name="tmp_id" id="tmp_id" onChange="tmpchange(this.form)">
                                	<option value="" selected>テンプレートを選択してください。</option>
                                	<?php
											$tmprows=0;
											while($stmpdata[$tmprows]["temp_id"]!=NULL){
											?>
                                	<option value="<?php echo $stmpdata[$tmprows]["temp_id"]; ?>"><?php echo $stmpdata[$tmprows]["sche_title"]; ?></option>
                                	<?php
												$tmprows++;
											}	
											?>
                               	</select>
                                <input type="button" name="Submit" value="を削除する" onClick="stempdel(this.form)">
</td>
						</tr>
						<tr>
							<td width="140" background="/members/img/filemenu_bg.gif">
								<div align="right"><strong>タイトル：</strong></div>
							</td>
							<td>
								<input name="title" type="text" id="title" value="<?php echo $schedata["title"] ?>" size="50">
							</td>
						</tr>
						<tr>
							<td width="140" valign="top" background="/members/img/filemenu_bg.gif">
								<div align="right"><strong>表示：</strong></div>
							</td>
							<td>
								<select name="view_type" id="view_type">
                                	<option value="0" selected>会員専用</option>
                                	<option value="1">全てに表示</option>
                               	</select>
							</td>
						</tr>
						<tr>
							<td width="140" align="right" valign="top" background="/members/img/filemenu_bg.gif"><strong>日付表示：</strong></td>
							<td>
								<select name="day_view" id="day_view">
									<option value="0" selected>表示しない</option>
									<option value="1">表示する</option>
								</select>
							</td>
						</tr>
						<tr>
							<td width="140" valign="top" background="/members/img/filemenu_bg.gif">
								<div align="right"><strong>
内容：</strong></div>
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
							<th width="140" align="right" valign="top" background="/members/img/filemenu_bg.gif">&nbsp;</th>
							<td>
								<input name="sche_save_chk" type="checkbox" id="sche_save_chk" value="1">
このスケジュールの内容をテンプレートに保存する</td>
						</tr>
						<tr>
							<th width="140" align="right" valign="top" background="/members/img/filemenu_bg.gif">参加者</th>
						    <td>
						    	<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
                                	<tr>
                                		<th align="left">
                                			<select name="menu1" onChange="Groupchange(19)">
											<option value="" selected>グループを選択してください。</option>
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
                                						<input type="button" name="Submit" value="←追加" onClick="func(22,19)">
                               						</td>
                               					</tr>
                                				<tr>
                                					<td align="center">
                                						<input type="button" name="Submit" value="削除→" onClick="func(19,22)">
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
							<td colspan="2">
								<input name="mode" type="hidden" id="mode" value=" ">
                                <input name="sche_id" type="hidden" id="sche_id" value="<?php echo $_REQUEST["sche_id"]; ?>">
                                <input name="member_id" type="hidden" id="member_id" value="0">
</td>
						</tr>
						<tr>
							<td colspan="2">&nbsp;							</td>
						</tr>
				</table>
				<TABLE width="700"  border="0" align="center" cellpadding="1" cellspacing="1">
                	<TR>
                		<TD>
                			<TABLE width="100%"  border="0" cellpadding="2" cellspacing="2">
                				<TR>
                					<TD width="140" align="right" background="/members/img/filemenu_bg.gif"><strong>メール送信先：</strong></TD>
                					<TD>
                						<select name="mail_type" id="mail_type" onChange="">
                							<option value="0" selected>テスト送信</option>
                							<option value="1">PC</option>
                							<option value="2">携帯</option>
                							<option value="3">PCと携帯</option>
                                            </select>
                						</TD>
               					</TR>
                				</TABLE>
                			<TABLE width="100%"  border="0" cellspacing="2" cellpadding="2">
                				<TR>
                					<TD width="140" align="right" background="/members/img/filemenu_bg.gif"><strong>テンプレート使用：</strong></TD>
                					<TD>
                						<select name="tmp_id" id="tmp_id" onChange="tmpchange2(this.form)">
                							<option value="" selected>テンプレートを選択してください。</option>
                							<?php
											$tmprows=0;
											while($tmpdata[$tmprows]["temp_id"]!=NULL){
											?>
                							<option value="<?php echo $tmpdata[$tmprows]["temp_id"]; ?>"><?php echo $tmpdata[$tmprows]["subject"]; ?></option>
                							<?php
												$tmprows++;
											}	
											?>
                							</select>
                						<input type="button" name="Submit" value="を削除する" onClick="mtempdel(this.form)">
                						</TD>
               					</TR>
                				<TR>
                					<TD width="140" background="/members/img/filemenu_bg.gif">
                						<div align="right"><strong>件名：</strong></div>
               						</TD>
                					<TD>
                						<input name="m_sbj" type="text" id="m_sbj" size="40">
                						</TD>
               					</TR>
                				<TR>
                					<TD width="140" align="right" background="/members/img/filemenu_bg.gif"><strong>確認用アドレス：</strong></TD>
                					<TD>
                						<input name="m_raddress" type="text" id="m_raddress" size="40">
                						</TD>
               					</TR>
                				<TR>
                					<TD width="140" valign="top" background="/members/img/filemenu_bg.gif">
                						<div align="right"><strong>メール本文：</strong></div>
               						</TD>
                					<TD>
                						<textarea name="m_txt" cols="60" rows="10" id="m_txt"></textarea>
                						</TD>
               					</TR>
                				<TR>
                					<TD width="140" valign="top" background="/members/img/filemenu_bg.gif">
                						<div align="right"><strong>対象会員：</strong></div>
               						</TD>
                					<TD>
                						<table width="95%"  border="0" align="left" cellpadding="0" cellspacing="0">
                							<tr>
                								<th align="left">
                									<select name="menu2" onChange="Groupchange2(33)">
                										<option value="0" selected>全会員</option>
                										<?php
										   	$GAROWS=0;
											while($GAList[$GAROWS]["group_id"]!=NULL) {
												echo "<option value=\"".$GAList[$GAROWS]["group_id"]."\">".$GAList[$GAROWS]["group_name"]."</option>";
												$GAROWS++;
											}
										   ?>
                										</select>
                									</th>
                								<th>&nbsp;</th>
                								<th align="left">&nbsp; </th>
               								</tr>
                							<tr>
                								<td width="200" align="center">
                									<select name="rlist[]" size="10" multiple id="rlist[]" style="width:100%;">
                										<?php
														$mrows=0;
														while($mselList[$mrows]["member_id"]!=NULL) {
														?>
                										<option value="<?php echo $mselList[$mrows]["member_id"] ?>"> <?php echo $mselList[$mrows]["member_name"] ?> </option>
                										<?php
															$mrows++;
														}
														?>
                										</select>
                									</td>
                								<td width="75">
                									<table width="95%"  border="0" cellspacing="5" cellpadding="5">
                										<tr>
                											<td align="center">
                												<input type="button" name="Submit" value="←追加" onClick="func(36,33)">
                												</td>
               											</tr>
                										<tr>
                											<td align="center">
                												<input type="button" name="Submit" value="削除→" onClick="func(33,36)">
                												</td>
               											</tr>
                										</table>
               									</td>
                								<td width="200" align="center">
                									<select name="nrlist" size="10" multiple id="nrlist" style="width:100%;">
                										<?php
														$mrows=0;
														while($mdata[$mrows]["member_id"]!=NULL) {
														?>
                										<option value="<?php echo $mdata[$mrows]["member_id"] ?>"><?php echo $mdata[$mrows]["member_name"] ?></option>
                										<?php
															$mrows++;
														}
														?>
                										</select>
                									</td>
               								</tr>
                							<tr>
                								<td colspan="3">&nbsp;</td>
               								</tr>
                							</table>
               						</TD>
               					</TR>
                				<TR>
                					<TD align="right" valign="top" background="/members/img/filemenu_bg.gif"><strong>出欠確認：</strong></TD>
                					<TD>
                						<input name="mail_send" type="radio" value="0" checked>
不要
<input name="mail_send" type="radio" value="1">
必要 </TD>
               					</TR>
                				<TR>
                					<TD valign="top" background="/members/img/filemenu_bg.gif">
                						<div align="right"></div>
               						</TD>
                					<TD>
                						<input name="mail_save_chk" type="checkbox" id="mail_save_chk" value="1">
						このメールをテンプレートに保存する</TD>
               					</TR>
                				</TABLE>
               			</TD>
               		</TR>
                	<TR>
                		<TD>                			<input name="PROCCESS" type="hidden" id="PROCCESS" value="regist">
                			<input name="PID" type="hidden" id="PID" value="<?php echo $_REQUEST["PID"];?>">
                            <input name="sche_add" type="button" id="sche_add" value="追加する" onClick="datachk(this.form)">
                            <input name="sche_add" type="button" id="sche_add" value="追加してメールを送信する" onClick="datachk2(this.form)">
                            <input name="hisback" type="button" id="hisback" value="戻る" onClick="window.location.href='index.php?PID=schedule'">
</TD>
               		</TR>
                	</TABLE>
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
					</form>
	</table>
</div>
