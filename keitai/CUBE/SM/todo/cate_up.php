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

if($_REQUEST["mode"]=="update") {
			
			
			$upsql = "update todo_cate set 
			cate_name = '".$_REQUEST["cate_name"]."',
			comment = '".$_REQUEST["comment"]."',
			up_time = ".time().",
			deadline = ".numchk(strtotime($_REQUEST["deadline"])).",
			to_member_id = '".$_REQUEST["member_id"]."' where cate_id = ".$_GET["cate_id"];
			$dbobj->Query($upsql);
			
		//	$_GET["cate_id"]=$_POST["cate_id"];
			
/*
			$memsql="select * from member where member_id =".$_REQUEST["rlist"][$j];
			$memdata=$dbobj->GetData($memsql);
			
			if($_REQUEST["keitai_send"]==1&&$memdata["kmail"]!=NULL) {
					mb_send_mail($memdata["kmail"],$_REQUEST["title"],$_REQUEST["comment"],"From:".$logindata["mailaddress"]);
			}
			
*/
?>
<script language="javascript">
	//window.location.replace("index.php?PID=todo");
</script>
<?php
}

if($_GET["cate_id"]!=""){
	$sql="select * from todo_cate where cate_id = ".$_GET["cate_id"];
	$todo_cate_data = $dbobj->GetData($sql);
}
else{
?><script language="javascript">location.replace("?PID=todo");</script>
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
			
			frm.mode.value="update";
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
                                    <td height="40" bgcolor="#EFF6FF">フォルダ名<br>
                                        <input name="cate_name" type="text" id="cate_name" style="width:98%" value="<?php echo $todo_cate_data["cate_name"];?>" size="40">
                                    </td>
                                </tr>
                                <tr>
                                    <td>期限</td>
                                </tr>
                                <tr>
                                    <td bgcolor="#FFFFFF"><strong>
                                      <input type="text" name="deadline" id="deadline" value="<?php 
									  if($todo_cate_data["deadline"]!=""){
									  echo str_replace("-","/",str_replace("00:00:00","",date("Y-m-d",$todo_cate_data["deadline"])));
									  }
									  ?>" onclick="YahhoCal.render(this.id);" /> 
                                  </strong> </td>
                                </tr>
                                <tr>
                                    <td>コメント</td>
                                </tr>
                                <tr>
                                    <td bgcolor="#FFFFFF">
                                        <textarea name="comment" cols="40" rows="10" id="comment" style="width:98%"><?php echo $todo_cate_data["comment"];?></textarea>
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
				<option value="<?php echo $mlist[$i]["member_id"] ?>"<?php if($todo_cate_data["to_member_id"]==$mlist[$i]["member_id"]){ echo " selected";}?>><?php echo $mlist[$i]["member_name"]?></option>
				<?php
				}
				?>
                                                    </select>
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td height="30">
                                                    <input name="btm_addition" type="button" id="btm_addition" value="登録する" onClick="datachk(this.form)">
                                                    <input name="btm_back" type="button" id="btm_back" value="戻る" onClick="window.location.href='index.php?PID=todo&cate_id=<?php echo $_GET["cate_id"];?>'">
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
