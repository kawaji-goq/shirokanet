<?php /*?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php
*/
$today=date("Y-m-d",time());
$gobj=new Group($dbobj);
$mobj=new Members($dbobj);
$gdata=$gobj->GetList(" turn ");
$mlist=$mobj->getList2();
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
			$maxsql="select max(id) as maxid from todo";
			$maxid=1;
			$maxdata=$dbobj->GetData($maxsql);
			$maxid+=$maxdata["maxid"];
			
			
				if($_POST["hopedate"]!=""){
		$_POST["hopedate"] = "'".$_POST["hopedate"]."'";
	}
	else{
	 	$_POST["hopedate"] = "null";
	}
			
			$inssql="insert into todo (id,title,comment,readchk,status,registdate,hopedate,from_member_id,to_member_id,cate_id) values (".
											"$maxid,'".$_POST["title"]."','".$_POST["comment"]."',0,1,'".date("Y-m-d h:i:s")."',".
											$_POST["hopedate"].",".$logindata["member_id"].",".$_POST["member_id"].
											",".$_POST["cate_id"].")";
			//echo $inssql;
			
			$dbobj->Query($inssql);
			
			$maxsql="select max(log_id) as maxid from todo_logs";
			$maxid3=1;
			$maxdata=$dbobj->GetData($maxsql);
			$maxid3+=$maxdata["maxid"];
			
			$inssql="insert into todo_logs (log_id,sled_id,comment,member_id,writetime,log_num,res_id) values (".
					$maxid3.",".$maxid.",'".$_POST["comment"]."',".$logindata["member_id"].
					",'".date("Y-m-d H:i:s")."',0,".$maxid.")";
					
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
	/*
	while(oprows<document.add_form.elements[4].length) {
		document.add_form.elements[4].options[oprows].selected=true;
		oprows++;
	}
	*/
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
                                    <td height="40" bgcolor="#EFF6FF">タイトル<br>
                                        <input name="title" type="text" size="40" style="width:98%">                                    </td>
                                </tr>
                                <tr>
                                  <td>フォルダ</td>
                                </tr>
                                <tr>
                                  <td bgcolor="#FFFFFF"><label>
                                    <select name="cate_id" id="cate_id">
									 <option value="0">指定なし</option>
                                      <?php
$todo_cate_list=$dbobj->GetList("select * from todo_cate where to_member_id = ".$logindata["member_id"]);
for($i=0;count($todo_cate_list)>$i;$i++){
?>
                                      <option value="<?php echo $todo_cate_list[$i]["cate_id"];?>"<?php if($_GET["cate_id"]==$todo_cate_list[$i]["cate_id"]){ echo " selected";}?>><?php echo $todo_cate_list[$i]["cate_name"];?></option>
                                      <?php
																												}
																												?>
                                    </select>
                                  </label></td>
                                </tr>
                                
                                <tr>
                                    <td>期限</td>
                                </tr>
                                <tr>
                                    <td bgcolor="#FFFFFF"><strong>
                                      <input type="text" name="hopedate" id="hopedate" value="" onclick="YahhoCal.render(this.id);" />
                                    </strong></td>
                                </tr>
                                <tr>
                                    <td>本文</td>
                                </tr>
                                <tr>
                                    <td bgcolor="#FFFFFF">
                                        <textarea name="comment" cols="40" rows="10" id="comment" style="width:98%"></textarea>                                    </td>
                                </tr>
                                <tr>
                                    <td>依頼先</td>
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
																																																				<option value="<?php echo $mlist[$i]["member_id"] ?>"<?php if($mlist[$i]["member_id"]==$logindata["member_id"]){?> selected<?php }?>><?php echo $mlist[$i]["member_name"]?></option>
																																																				<?php
																																																				}
																																																				?>
                                                    </select>                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td height="30">
                                                    <input name="btm_addition" type="button" id="btm_addition" value="送信する" onClick="datachk(this.form)">
                                                    <input name="btm_back" type="button" id="btm_back" value="戻る" onClick="window.location.href='index.php?PID=todo&cate_id=<?php echo $_GET["cate_id"];?>'">
                                                    <input name="senddate" type="hidden" id="senddate" value="<?php echo $today; ?>">
                                                    <strong>
                                                    <input name="mode" type="hidden" id="mode">
                                                    </strong></td>
                                            </tr>
                                        </table>                                    </td>
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
