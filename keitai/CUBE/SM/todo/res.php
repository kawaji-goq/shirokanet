<?php /*?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php
*/
$today=date("Y-m-d",time());
$gobj=new Group($dbobj);
$mobj=new Member($dbobj);
$gdata=$gobj->GetList(" turn ");
$mdata=$mobj->GetList();

function numchk($num){
	if((int)$num==0){
		return "null";
	}
	else{
		return $num;
	}
}

function dateChk($day){
	if($day!=""){
		return "'".$day."'";
	}
	else{
		return "null";
	}
}
if($_REQUEST["mode"]=="addition") {
	
		if($_REQUEST["comment"]!=""){
		
			$maxsql="select max(log_id) as maxid from todo_logs";
			$maxid3=1;
			$maxdata=$dbobj->GetData($maxsql);
			$maxid3+=$maxdata["maxid"];
			
			$inssql="insert into todo_logs (log_id,sled_id,comment,member_id,writetime,log_num,res_id,status) values (".
							$maxid3.",".$_REQUEST["res_id"].",'".$_REQUEST["comment"]."',".$logindata["member_id"].
							",".dateChk(date("Y-m-d H:i:s")).",1,".$_REQUEST["res_id"].",".$_REQUEST["status"].")";
			$dbobj->Query($inssql);
				
		}
		
		$inssql="update todo set title='".$_REQUEST["title"]."',status = ".$_REQUEST["status"].",cate_id=".($_POST["cate_id"]).",plan_date=".dateChk($_REQUEST["plan_date"])." where id = ".$_REQUEST["res_id"];
		$dbobj->Query($inssql);			

		$sel_sql1="select count(*) as count_num,min(plan_date) as fin_date from todo where cate_id =  ".$_POST["cate_id"]." and status <>10 ";
		$sel_data1=$dbobj->GetData($sel_sql1);
		
		$sel_sql2="select count(*) as count_num from todo where cate_id =  ".$_POST["cate_id"]." and status = 10 ";
		$sel_data2=$dbobj->GetData($sel_sql2);
		$onum=(int)($sel_data1["count_num"]);
		$onum2=(int)($sel_data2["count_num"]);
		
		if($sel_data1["fin_date"]!=""){
		$fntime=strtotime($sel_data1["fin_date"]);
		}
		else{
			$fntime="";
		}
		 $up_sql="update todo_cate set over_count= ".$onum." , all_count=".($onum+$onum2).",fin_time=".numchk($fntime)." where cate_id = ".$_POST["cate_id"];
		$dbobj->Query($up_sql);	
		//$_GET["cate_id"]=$_POST["cate_id"];

		$sel_sql1="select count(*) as count_num,max(plan_date) as fin_date from todo where cate_id =  ".$_GET["cate_id"]." and status <>10 ";
		$sel_data1=$dbobj->GetData($sel_sql1);
		
		$sel_sql2="select count(*) as count_num from todo where cate_id =  ".$_GET["cate_id"]." and status = 10 ";
		$sel_data2=$dbobj->GetData($sel_sql2);
		$onum=(int)($sel_data1["count_num"]);
		$onum2=(int)($sel_data2["count_num"]);
		
		 $up_sql="update todo_cate set over_count= ".$onum." , all_count=".($onum+$onum2)." where cate_id = ".$_GET["cate_id"];
		$dbobj->Query($up_sql);	
		
?>
<script language="javascript">
	window.location.replace("index.php?PID=todo&cate_id=<?php echo $_GET["cate_id"];?>");
</script>
<?php
}

$sql="select * from todo where id = ".$_GET["todo_id"];
$mesdata=$dbobj->GetData($sql);

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
<script type="text/javascript" src="http://siteadmin.itcube.ne.jp/js/YahhoCal.js"></script>
<script type="text/javascript">YahhoCal.loadYUI(); //Googleのサーバから読み込む場合
 
//YahhoCal.loadYUI("/path/to/your/yui/dir/"); //自分のサーバから読み込む場合。パスは環境に合わせて変更してください
</script>

<table width="100%"  border="0" align="center" cellpadding="2" cellspacing="2" id="bbs">
    
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
        <td valign="top">    <form name="add_form" method="post" action="" style="margin:0px;padding:0px;">
            <table width="100%" border="0" cellspacing="1" cellpadding="1">
                <tr>
                    <td height="30" bgcolor="#DCDCFF">
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            
                            <tr>
                                <td bgcolor="#EFF6FF">
                                    <table  border="0" cellpadding="5" cellspacing="5" bgcolor="#EFF6FF" class="sledtitle">
                                        <tr>
                                            <td nowrap="nowrap"><div><input name="title" type="text" size="40" value="<?php echo $mesdata["title"] ?>"></div></td>
                                            <td><?php if($mesdata["status"]==1) {?>
                                            		<strong><font color="#FF0000">New!</font></strong>
                                            		<?php } ?>
                                   		  <?php 
																		$plan_date=$mesdata["plan_date"];
																		
																		$to_day=date("Y-m-d");
																		
																		
																		$count_date=strtotime($to_day)-strtotime($plan_date);
																		
																		
																		if($count_date>0){
																			echo "<font color='red'><strong>(+".$count_date/(60*60*24)."日)</strong></font>";
																		}
																		else if($count_date==0) {
																				echo "<font color='red'><strong>(今日)</strong></font>";
																		}
																		else if($count_date/(60*60*24)==-1){
																			echo "<font color='red'><strong>(明日)</strong></font>";
																		}
																		?></td>
                                            <td>目標期限</td>
                                            <td><input type="text" name="plan_date" id="plan_date" value="<?php echo str_replace("-","/",str_replace("00:00:00","",	$mesdata["plan_date"]));?>" onclick="YahhoCal.render(this.id);" /></td>
                                            <td><font color="#333333">依頼期限
																										<label> <?php echo  str_replace("-","/",str_replace("00:00:00","",$mesdata["hopedate"]));?> </label>
                                            </font></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                            		<td><strong>フォルダ2</strong></td>
                   		  </tr>
                            <tr>
                            		<td bgcolor="#FFFFFF"><label>
                            				<select name="cate_id" id="cate_id">
												 <option value="0">指定なし</option>
                            						<?php
																												$todo_cate_list=$dbobj->GetList("select * from todo_cate where to_member_id = ".$mesdata["to_member_id"]);
																												
																												for($i=0;count($todo_cate_list)>$i;$i++){
																												
																												?>
                            						<option value="<?php echo $todo_cate_list[$i]["cate_id"];?>"<?php if($mesdata["cate_id"]==$todo_cate_list[$i]["cate_id"]){ echo " selected";}?>><?php echo $todo_cate_list[$i]["cate_name"];?></option>
                            						<?php
																												}
																												?>
               						</select>
                            				</label></td>
                   		  </tr>
                            <tr>
                                <td><strong>依頼主</strong>　
<?php
																																	$sql="select * from member where member_id =".$mesdata["from_member_id"];
																																	$mdata=$dbobj->GetData($sql);

																																echo $mdata["member_name"];
																																?>
                                    　
                                <?php echo str_replace("-",".",$mesdata["registdate"]);?></td>
                            </tr>
                            <tr>
                                <td height="30" bgcolor="#FFFFFF"><?php echo nl2br($mesdata["comment"]); ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td height="30" bgcolor="#DCDCFF">
                        <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1">
                        
                                <tr>
                                    <td><strong>状態</strong></td>
                                </tr>
                                <tr>
                                    <td bgcolor="#FFFFFF">
                                        <select name="status">
																																								<option value="1"<?php if($mesdata["status"]==1){echo " selected";} ?>>未確認</option>
																																								<option value="2"<?php if($mesdata["status"]==2){echo " selected";} ?>>確認済</option>
																																								<option value="5"<?php if($mesdata["status"]==5){echo " selected";} ?>>作業中</option>
																																								<option value="10"<?php if($mesdata["status"]==10){echo " selected";} ?>>完了</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>本文</strong> </td>
                                </tr>
                                <tr>
                                    <td bgcolor="#FFFFFF">
                                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                                            <tr>
                                                <td>
                                                    <textarea name="comment" cols="40" rows="10" style="width:98%"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="30">
                                                    <input name="btm_addition" type="button" id="btm_addition" value="送信する" onClick="datachk(this.form)">
                                                    <input name="btm_back" type="button" id="btm_back" value="戻る" onClick="window.location.href='index.php?PID=todo&cate_id=<?php echo $_GET["cate_id"];?>'">
                                                    <input name="senddate" type="hidden" id="senddate" value="<?php echo $today; ?>">
                                                    <input name="member_id" type="hidden" id="member_id" value="<?php echo $logindata["member_id"]; ?>">
                                                    <strong>
                                                    <input name="mode" type="hidden" id="mode">
                                                    <input name="res_id" type="hidden" id="res_id" value="<?php echo $_GET["todo_id"];?>">
                                                    <input name="original_id" type="hidden" id="original_id" value="<?php echo $mesdata["id"];?>">
                                                    </strong></td>
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
                <tr>
                    <td height="30">&nbsp;</td>
                </tr>
            </table> </form>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
</table>
