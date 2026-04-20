<?php
if($_GET["mysort"]!=NULL) {
	$_SESSION["mytodo"]["sort"]=$_GET["mysort"];
}
if($_GET["pmode"]=="logdel") {
	$sql="delete from todo_logs where log_id = ".$_REQUEST["delid"];
	$dbobj->Query($sql);
	?>
	<script language="javascript">
	location.replace("?PID=todo");
	</script>
	<?php
}



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


if($_POST["todo_reg_x"]!=""){
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
	
	
}

/*
if($_POST["update_data"]=="更新する"){
	
	for($i=0;$_POST["todo_id"][$i]!="";$i++){
		
		if($_POST["status"][$i]==1){
			$upsql="update todo set status = 2 where id = ".$_POST["todo_id"][$i];
			$dbobj->Query($upsql);
		}
		else{
		
			$upsql="update todo set status = 1 where id = ".$_POST["todo_id"][$i];
			$dbobj->Query($upsql);
					
		}
		//echo $upsql;
		
	}
	
}
*/
if($_GET["mode"]=="state1"){
	$upsql="update todo set status = 2 where id = ".$_GET["todo_id"];
	$dbobj->Query($upsql);
	?>
	<script language="javascript">
	location.replace("?PID=todo&cate_id=<?php $_GET["cate_id"];?>");
	</script>
	<?php
	
			
}
if($_SESSION["mytodo"]["sort"]=="all"||$_SESSION["mytodo"]["sort"]==NULL) {
	
	if($_GET["cate_id"]!=""){
		$sql="select * from todo inner join member on member.member_id = todo.from_member_id where to_member_id = ".$logindata["member_id"]." and status <> 10 and status <> 1 and cate_id = ".$_GET["cate_id"]." order by status,plan_date,id desc";


		$sql1="select * from todo inner join member on member.member_id = todo.from_member_id where to_member_id = ".$logindata["member_id"]." and  status = 1 and cate_id = ".$_GET["cate_id"]." order by status,plan_date,id desc";

		$cate_sql="select * from todo_cate where cate_id = ".$_REQUEST["cate_id"]." order by cate_id";
		
		
	}
	else{	
		$sql="select * from todo inner join member on member.member_id = todo.from_member_id where to_member_id = ".$logindata["member_id"]." "."and status <> 10 and status <> 1 order by status,plan_date,id desc";
		
		$sql1="select * from todo inner join member on member.member_id = todo.from_member_id where to_member_id = ".$logindata["member_id"]." "."and status = 1 order by status,plan_date,id desc";
		
		
		$cate_sql="select * from todo_cate order by cate_id";
		
	}
	
}
else {
	if($_GET["cate_id"]!=""){

		$sql = 	"select * from todo inner join member on member.member_id = todo.from_member_id where to_member_id = ".$logindata["member_id"]." ".
				"and status = ".$_SESSION["mytodo"]["sort"]." and cate_id = ".$_GET["cate_id"]." order by status,plan_date,id desc";
				
		$cate_sql="select * from todo_cate where cate_id = ".$_REQUEST["cate_id"];
	
	}
	else{
	
		$sql="select * from todo inner join member on member.member_id = todo.from_member_id where to_member_id = ".$logindata["member_id"]." "."and status = ".$_SESSION["mytodo"]["sort"]." order by status,plan_date,id desc";
		$cate_sql="select * from todo_cate order by cate_id";
		
		
	}

}
$todolist=$dbobj->GetList($sql);
$todo_cate_data=$dbobj->GetData($cate_sql);
$todolist1=$dbobj->GetList($sql1);

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
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<script type="text/JavaScript">
<!--

function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

function delchk(id) {
	res=confirm("削除してもよろしいですか？");
	if(res) {
		location.replace("?PID=todo&pmode=logdel&delid="+id);
	}
}

//-->
</script>
<script type="text/javascript" src="http://siteadmin.itcube.ne.jp/js/YahhoCal.js"></script>
<script type="text/javascript">YahhoCal.loadYUI(); //Googleのサーバから読み込む場合
 
//YahhoCal.loadYUI("/path/to/your/yui/dir/"); //自分のサーバから読み込む場合。パスは環境に合わせて変更してください
</script>
<script language="javascript">
function datachk(){
	var chkdata=document.getElementById('title').value;
	if(chkdata==""){
		alert("タイトルが入力されていません。");
		return false;
	}
	else{
	
		return true;
	}
}
</script>
<div id="bbs">

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
		?>
      </td>
      <td valign="top">
            <table width="98%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#DCDCFF">
              <tr>
                <td height="25" bgcolor="#DCDCFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><div align="left"><strong>
                        <?php
									if($_GET["cate_id"]!=""&&$todo_cate_data["cate_name"]!=""){
										echo "【".$todo_cate_data["cate_name"]."】";
									}
									
									?>
                        新着TODO一覧</strong>　（<a href="?PID=todo_cate_up&amp;cate_id=<?php echo $todo_cate_data["cate_id"];?>">フォルダ編集</a>）</div></td>
                      <form name="form1" id="form1">
                        <td><div align="right">
                            <select name="select" id="select" onchange="MM_jumpMenu('parent',this,0)">
                              <option value="?PID=todo&amp;mysort=1"<?php if($_SESSION["mytodo"]["sort"]==1){echo " selected";}?>>未確認</option>
                              <option value="?PID=todo&amp;mysort=2"<?php if($_SESSION["mytodo"]["sort"]==2){echo " selected";}?>>確認済</option>
                              <option value="?PID=todo&amp;mysort=5"<?php if($_SESSION["mytodo"]["sort"]==5){echo " selected";}?>>作業中</option>
                              <option value="?PID=todo&amp;mysort=all"<?php if($_SESSION["mytodo"]["sort"]=="all"){echo " selected";}?>>全て表示</option>
                            </select>
                        </div></td>
                      </form>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td valign="top" bgcolor="#FFFFFF"><form id="form2" name="form2" method="post" action="" style="margin:0px;">
                    <table width="100%" border="0" cellpadding="5" cellspacing="0">
                      <tr>
                        <td colspan="2" nowrap="nowrap" bgcolor="#ececec">タイトル</td>
                        <td width="11%" nowrap="nowrap" bgcolor="#ececec">終了予定</td>
                        <td width="15%" nowrap="nowrap" bgcolor="#ececec">依頼期限</td>
                        <td width="13%" nowrap="nowrap" bgcolor="#ececec">状態</td>
                        <td width="14%" nowrap="nowrap" bgcolor="#ececec">依頼主</td>
                        <td width="13%" nowrap="nowrap" bgcolor="#ececec">&nbsp;</td>
                      </tr>
                      <?php
for($i=0;$todolist1[$i]["id"]!=NULL;$i++) {

$plan_date=$todolist1[$i]["plan_date"];

$to_day=date("Y-m-d");

$count_date=strtotime($to_day)-strtotime($plan_date);

$hope_count_date = strtotime($to_day)-strtotime($todolist1[$i]["hopedate"]);


if($todolist1[$i]["status"]==1) {
$color="009900";
	
}
else if($count_date>=0&&$plan_date!=""){
$color="ff0000";
	
}
else{
$color="3366ff";
}



?>
                      <tr>
                        <td colspan="2" bgcolor="#FFFFFF"><a href="#<?php echo $todolist1[$i]["title"];?>"><strong><font color="#<?php echo $color;?>"><?php echo $todolist1[$i]["title"];
																
																
																
																?>
                                  <?php if($todolist1[$i]["status"]==1) {?>
                                  <font color='red'><strong> New!</strong></font>
                                  <?php } ?>
                                  <?php 
																	
																		
																		if($count_date>0){
																			echo "<font color='red'><strong>(+".$count_date/(60*60*24)."日)</strong></font>";
																		}
																		else if($count_date==0&&$plan_date!="") {
																				echo "<font color='red'><strong>(今日)</strong></font>";
																		}
																		else if($count_date/(60*60*24)==-1){
																			echo "<font color='red'><strong>(明日)</strong></font>";
																		}
																		?>
                                  <?php 
																if($todolist1[$i]["cate_id"]!=""){
																		$cate_data=$dbobj->GetData("select * from todo_cate where cate_id = ".$todolist1[$i]["cate_id"]);
																		echo "【".$cate_data["cate_name"]."】";
																};?>
                                  <input name="todo_id[<?php echo $i;?>]" type="hidden" id="todo_id[<?php echo $i;?>]" value="<?php echo $todolist1[$i]["id"];?>" />
                        </font></strong></a></td>
                        <td bgcolor="#FFFFFF"><?php echo str_replace("-",".",str_replace("00:00:00","",$todolist1[$i]["plan_date"]));?></td>
                        <td bgcolor="#FFFFFF"><?php 
							  if($todolist1[$i]["hopedate"]!=""){
							  if($hope_count_date>=0){
							  echo '<font color = "red"><strong>'.str_replace("-",".",str_replace("00:00:00","",$todolist1[$i]["hopedate"]))."</strong></font>";
							  }
							  else{
							  echo str_replace("-",".",str_replace("00:00:00","",$todolist1[$i]["hopedate"]));
							  }
							  }?></td>
                        <td bgcolor="#FFFFFF"><a href="?PID=todo&cate_id=<?php echo $_GET["cate_id"];?>&mode=state1&todo_id=<?php echo $todolist1[$i]["id"];?>"><font color="red">未確認</font></a></td>
                        <td bgcolor="#FFFFFF"><?php
																																echo $todolist1[$i]["member_name"];
																																?></td>
                        <td bgcolor="#FFFFFF"><div align="right"><a href="?PID=todo_res&amp;todo_id=<?php echo $todolist1[$i]["id"];?>&amp;cate_id=<?php echo $_GET["cate_id"];?>"><img src="/GW/img/changestatus.gif" width="76" height="23" border="0" /></a></div></td>
                      </tr>
                      <?php
																												}
																												?>
                      <tr>
                        <td width="25%" bgcolor="#FFFFFF">&nbsp;</td>
                        <td width="9%" nowrap="nowrap" bgcolor="#FFFFFF">&nbsp;</td>
                        <td bgcolor="#FFFFFF">&nbsp;</td>
                        <td bgcolor="#FFFFFF">&nbsp;</td>
                        <td bgcolor="#FFFFFF">&nbsp;</td>
                        <td bgcolor="#FFFFFF">&nbsp;</td>
                        <td bgcolor="#FFFFFF">&nbsp;</td>
                      </tr>
                      <tr>
                        <td bgcolor="#FFFFFF"><input name="update_data" type="submit" id="update_data" value="更新する" /></td>
                        <td nowrap="nowrap" bgcolor="#FFFFFF">&nbsp;</td>
                        <td bgcolor="#FFFFFF">&nbsp;</td>
                        <td bgcolor="#FFFFFF">&nbsp;</td>
                        <td bgcolor="#FFFFFF">&nbsp;</td>
                        <td bgcolor="#FFFFFF">&nbsp;</td>
                        <td bgcolor="#FFFFFF">&nbsp;</td>
                      </tr>
                    </table>
                </form></td>
              </tr>
            </table>
            <table width="98%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#DCDCFF">
                <tr>
                    <td height="25" bgcolor="#DCDCFF">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>
                                    <div align="left"><strong><?php
									if($_GET["cate_id"]!=""&&$todo_cate_data["cate_name"]!=""){
										echo "【".$todo_cate_data["cate_name"]."】";
									}
									
									?>TODO一覧</strong>　（<a href="?PID=todo_cate_up&cate_id=<?php echo $todo_cate_data["cate_id"];?>">フォルダ編集</a>）</div>
                                </td>
                                        <form name="form1">
                                <td>
                                    <div align="right">
                                            <select name="mysort" id="mysort" onChange="MM_jumpMenu('parent',this,0)">
																																	<option value="?PID=todo&mysort=1"<?php if($_SESSION["mytodo"]["sort"]==1){echo " selected";}?>>未確認</option>
																																	<option value="?PID=todo&mysort=2"<?php if($_SESSION["mytodo"]["sort"]==2){echo " selected";}?>>確認済</option>
																																	<option value="?PID=todo&mysort=5"<?php if($_SESSION["mytodo"]["sort"]==5){echo " selected";}?>>作業中</option>
																																	<option value="?PID=todo&mysort=all"<?php if($_SESSION["mytodo"]["sort"]=="all"){echo " selected";}?>>全て表示</option>
                                      </select>
                                  </div>
                                </td>
                                        </form>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td valign="top" bgcolor="#FFFFFF">
                        <form id="form4" name="form4" method="post" action="" style="margin:0px;" onsubmit="return datachk()">
                          <table width="100%" border="0" cellpadding="5" cellspacing="0">
                            <tr>
                              <td colspan="2" nowrap="nowrap" bgcolor="#ececec">タイトル</td>
                              <td width="11%" nowrap="nowrap" bgcolor="#ececec">終了予定</td>
                              <td width="15%" nowrap="nowrap" bgcolor="#ececec">依頼期限</td>
                              <td width="13%" nowrap="nowrap" bgcolor="#ececec">状態</td>
                              <td width="14%" nowrap="nowrap" bgcolor="#ececec">依頼主</td>
                              <td width="13%" nowrap="nowrap" bgcolor="#ececec">&nbsp;</td>
                            </tr>
                            <?php
for($i=0;$todolist[$i]["id"]!=NULL;$i++) {

$plan_date=$todolist[$i]["plan_date"];

$to_day=date("Y-m-d");


$count_date=strtotime($to_day)-strtotime($plan_date);
$hope_count_date = (strtotime($to_day)-strtotime($todolist[$i]["hopedate"]))/(24*60*60);

if($todolist[$i]["status"]==1) {
$color="009900";
	
}
else if($count_date>=0&&$plan_date!=""){
$color="ff0000";
	
}
else{
$color="3366ff";
}
?>
                            <tr>
                              <td colspan="2" bgcolor="#FFFFFF"><a href="#<?php echo $todolist[$i]["title"];?>"><strong><font color="#<?php echo $color;?>"><?php echo $todolist[$i]["title"];
																
																
																
																?>
                                  <?php if($todolist[$i]["status"]==1) {?>
                                <font color='red'><strong>  New!</strong></font>
                                  <?php } ?>
                                  <?php 
																	
																		
																		if($count_date>0){
																			echo "<font color='red'><strong>(+".$count_date/(60*60*24)."日)</strong></font>";
																		}
																		else if($count_date==0&&$plan_date!="") {
																				echo "<font color='red'><strong>(今日)</strong></font>";
																		}
																		else if($count_date/(60*60*24)==-1){
																			echo "<font color='red'><strong>(明日)</strong></font>";
																		}
																		?>
                                  <?php 
																if($todolist[$i]["cate_id"]!=""){
																		$cate_data=$dbobj->GetData("select * from todo_cate where cate_id = ".$todolist[$i]["cate_id"]);
																		echo "【".$cate_data["cate_name"]."】";
																};?>
                              </font></strong></a></td>
                              <td bgcolor="#FFFFFF"><?php echo str_replace("-",".",str_replace("00:00:00","",$todolist[$i]["plan_date"]));?></td>
                              <td bgcolor="#FFFFFF"><?php 
							  if($todolist[$i]["hopedate"]!=""){
							  if($hope_count_date>=-7){
							  echo '<font color = "red"><strong>'.str_replace("-",".",str_replace("00:00:00","",$todolist[$i]["hopedate"]))."<strong></font>";
							  }
							  else{
							  	echo str_replace("-",".",str_replace("00:00:00","",$todolist[$i]["hopedate"]));
							  }
							  }
							  ?>
                              <td bgcolor="#FFFFFF"><?php 
																																switch($todolist[$i]["status"]) {
																																 case 1:
																																		echo "未確認";
																																		break;
																																 case 2:
																																		echo "確認済";
																																		break;
																																		case 5:
																																		echo "作業中";
																																		break;
																																	case 10:
																																		echo "完了";
																																	break;
																																}	?></td>
                              <td bgcolor="#FFFFFF"><?php
																																echo $todolist[$i]["member_name"];
																																?></td>
                              <td bgcolor="#FFFFFF"><div align="right"><a href="?PID=todo_res&amp;todo_id=<?php echo $todolist[$i]["id"];?>&amp;cate_id=<?php echo $_GET["cate_id"];?>"><img src="/GW/img/changestatus.gif" width="76" height="23" border="0" /></a></div></td>
                            </tr>
                            <?php
																												}
																												?>
                            <tr>
                              <td width="25%" bgcolor="#FFFFFF">&nbsp;</td>
                              <td width="9%" nowrap="nowrap" bgcolor="#FFFFFF">&nbsp;</td>
                              <td bgcolor="#FFFFFF">&nbsp;</td>
                              <td bgcolor="#FFFFFF">&nbsp;</td>
                              <td bgcolor="#FFFFFF">&nbsp;</td>
                              <td bgcolor="#FFFFFF">&nbsp;</td>
                              <td bgcolor="#FFFFFF">&nbsp;</td>
                            </tr>
                            <tr>
                              <td bgcolor="#FFFFFF"><input name="title" type="text" size="40" style="width:98%" /></td>
                              <td nowrap="nowrap" bgcolor="#FFFFFF"><select name="cate_id" id="cate_id">
  <option value="0">指定なし</option>
                                <?php
																												$todo_cate_list=$dbobj->GetList("select * from todo_cate where to_member_id = ".$logindata["member_id"]);
																												
																												for($i=0;count($todo_cate_list)>$i;$i++){
																												
																												?>
                                <option value="<?php echo $todo_cate_list[$i]["cate_id"];?>"<?php if($_GET["cate_id"]==$todo_cate_list[$i]["cate_id"]){ echo " selected";}?>><?php echo $todo_cate_list[$i]["cate_name"];?></option>
                                <?php
																												}
																												?>
                              </select></td>
                              <td bgcolor="#FFFFFF">&nbsp;</td>
                              <td bgcolor="#FFFFFF"><strong>
                                <input type="text" name="hopedate" id="hopedate" value="" onclick="YahhoCal.render(this.id);" />
                              </strong></td>
                              <td bgcolor="#FFFFFF">&nbsp;</td>
                              <td bgcolor="#FFFFFF"><select name="member_id" id="member_id">
                                  <?php
				for($i=0;$mlist[$i]["member_id"]!=NULL;$i++) {
				?>
                                  <option value="<?php echo $mlist[$i]["member_id"] ?>"<?php if($todo_cate_data["to_member_id"]==$mlist[$i]["member_id"]){ echo " selected";}?>><?php echo $mlist[$i]["member_name"]?></option>
                                  <?php
				}
				?>
                              </select></td>
                              <td align="right" bgcolor="#FFFFFF"><div align="right">
                                  <label>
                                  <input name="todo_reg" type="image" id="todo_reg" src="/GW/img/regist_todo.gif" />
                                  </label>
                              </div></td>
                            </tr>
                          </table>
                      </form>
                  </td>
                </tr>
            </table>
          <?php
													for($i=0;$todolist[$i]["id"]!=NULL;$i++) {
$plan_date=$todolist[$i]["plan_date"];

$to_day=date("Y-m-d");


$count_date=strtotime($to_day)-strtotime($plan_date);

$hope_count_date = (strtotime($to_day)-strtotime($todolist[$i]["hopedate"]))/(24*60*60);
if($todolist[$i]["status"]==1) {
$color="009900";
	
}
else if($count_date>=0&&$plan_date!=""){
$color="ff0000";
	
}
else{
$color="3366ff";
}
													?>
          <table width="98%"  border="0" align="center" cellpadding="3" cellspacing="0">
                <tr>
                    <td><a href="?PID=todo_add"></a></td>
                </tr>
                <tr>
                    <td bgcolor="#DCDCFF">
                        <table width="100%"  border="0" align="center" cellpadding="2" cellspacing="1">
                            <?php
																												$messql="select * from todo inner join todo_logs on todo.id=todo_logs.sled_id where sled_id = ".$todolist[$i]["id"]." order by registdate";
																													$meslist=$dbobj->GetList($messql);
																													for($j=0;$meslist[$j]["id"]!=NULL;$j++) {
																												if($j==0) {
																												
																												
																												
																												
																												?>
                            <tr>
                                <td height="40" bgcolor="#EFF6FF">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td>
                                                <table  border="0" cellpadding="5" cellspacing="5" bgcolor="#EFF6FF" class="sledtitle">
                                                    <tr>
                                                        <td><a name="<?php echo $meslist[$j]["title"];?>"><font color="#<?php echo $color?>"><?php echo $meslist[$j]["title"];?></font> 
                                                                <?php if($todolist[$i]["status"]==1) {?>
                                                                <strong><font color="#FF0000">New!</font></strong>
                                                                <?php } ?></a></td>
                                                        <td><font color="#333333">終了予定</font></td>
                                                        <td><font color="#333333"><?php echo str_replace("-",".",str_replace("00:00:00","",$todolist1[$i]["plan_date"]));?></font></td>
                                                        <td><font color="#333333"><span class="">期限　<?php echo str_replace("-",".",str_replace("00:00:00","",	$meslist[$j]["hopedate"]));?></span></font>
                                                                <div align="right"></div>                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td>
                                                <div align="right"><a href="?PID=todo_res&todo_id=<?php echo $meslist[$j]["id"];?>&cate_id=<?php echo $_GET["cate_id"];?>"><img src="/GW/img/changestatus.gif" width="76" height="23" border="0"></a> </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <div align="right"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>依頼主　
                                <?php
																																	$sql="select * from member where member_id =".$meslist[$j]["from_member_id"];
																																	$mdata=$dbobj->GetData($sql);

																																echo $mdata["member_name"];
																																?>　<?php echo str_replace("-",".",$meslist[$j]["registdate"]);?></td>
                            </tr>
                            
                            <tr>
                                <td bgcolor="#FFFFFF">
                                    <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="3">
                                        <tr>
                                            <td colspan="2" class="comment"><?php echo nl2br($meslist[$j]["comment"])?>&nbsp;</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <?php
																												}
																												else {
																												?>
                            <tr>
                                <td><span class="comment">
                                    <?php 
																																	$sql="select * from member where member_id =".$meslist[$j]["member_id"];
																																	$mdata=$dbobj->GetData($sql);
echo $mdata["member_name"];
																																												?>
	<?php
	if($count_date>0){
																			echo "<font color='red'><strong>(+".$count_date/(60*60*24)."日)</strong></font>";
																		}
																		else if($count_date==0&&$plan_date!="") {
																				echo "<font color='red'><strong>(今日)</strong></font>";
																		}
																		else if($count_date/(60*60*24)==-1){
																			echo "<font color='red'><strong>(明日)</strong></font>";
																		}?><?php 
echo str_replace("-",".",$meslist[$j]["writetime"]);
																																												?>
                                </span></td>
                            </tr>
                            <tr>
                                <td bgcolor="#FFFFFF">
                                    <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
                                        <tr>
                                            <td colspan="2" bgcolor="#FFFFFF" class="comment">
                                                状態：<?php 
																																switch($meslist[$j]["status"]) {
																																 case 1:
																																		echo "未確認";
																																		break;
																																 case 2:
																																		echo "確認済";
																																		break;
																																		case 5:
																																		echo "作業中";
																																		break;
																																	case 10:
																																		echo "完了";
																																	break;
																																}	?>
                                            </td>
                                        </tr>
																																								<?php
																																								if($meslist[$j]["comment"]!=NULL) {
																																								?>
                                        <tr>
                                            <td width="200%" colspan="2" bgcolor="#FFFFFF" class="comment">
                                            <?php echo nl2br($meslist[$j]["comment"]);?></td>
                                        </tr>
																																								<?php
																																								}
																																								?><?php
																																								if($meslist[$j]["member_id"]==$logindata["member_id"]) {
																																								?>
                                        <tr>
                                            <td colspan="2" bgcolor="#FFFFFF" class="comment">
                                                <div align="right"><a href="#" onClick="delchk(<?php echo $meslist[$j]["log_id"] ?>)"><img src="http://siteadmin.itcube.ne.jp/gw/img/trashbox.gif" alt="この書き込みを削除する" width="16" height="20" border="0"></a></div>
                                            </td>
                                        </tr>	<?php
																																								}
																																								?>
                                    </table>
                                </td>
                            </tr>
                            <?php
																												}
													}
																											?>
                        </table>
                    </td>
                </tr>
        </table>
          <table width="98%" border="0" align="center">
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3" align="right"><a href="#">▲ページトップ</a></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>
          <?php 
												}
												?>
          <table width="98%" border="0" align="center">
            <tr>
              <td align="left"><a href="?PID=todo_add<?php if($_GET["cate_id"]!=""){ echo "&cate_id=".$_GET["cate_id"];}?>"><img src="/GW/img/regist_todo.gif" width="142" height="24" border="0" /></a></td>
            </tr>
          </table></td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
</table>
</div>