<?php
$countsql="select count(todo_id) as countnum from todo_readlogs group by member_id,todo_id,member_id,read_status having member_id=".$logindata["member_id"]." and read_status <> 1";
$countunreaddata=$dbobj->GetData($countsql);
if($countunreaddata["countnum"]==NULL) {
	$countunreaddata["countnum"]=0;
}
$todolist=$dbobj->GetList($sql);
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

$countsql="select * from todo where from_member_id=".$logindata["member_id"]." and to_member_id<>".$logindata["member_id"]." and status = 10";
$countorderenddata["countnum"]=$dbobj->Count($countsql);
if($countorderenddata["countnum"]==NULL) {
	$countorderenddata["countnum"]=0;
}

function numchk($num){
	if((int)$num==0){
		return "null";
	}
	else{
		return $num;
	}
}


if($_REQUEST["btm_addition"]=="更新する"){
	
	if($_POST["hopedate"]!=""){
		$_POST["hopedate"] = "'".$_POST["hopedate"]."'";
	}
	else{
	 	$_POST["hopedate"] = "null";
	}
	
	$sql="update todo set title='".$_REQUEST["title"]."',comment='".$_REQUEST["comment"]."',hopedate=".$_POST["hopedate"]." 
	,cate_id=".(int)($_POST["cate_id"])." 
	where id = ".$_REQUEST["id"];
	$dbobj->Query($sql);
//	$sql2="update todo_readlogs set read_status=0 where todo_id = ".$_REQUEST["todo_id"];
//	$dbobj->Query($sql2);
	$sql3="update todo_logs set  title='".$_REQUEST["title"]."',comment= '".$_REQUEST["comment"]."' where sled_id = ".$_REQUEST["id"]." and log_num=0";
	$dbobj->Query($sql3);
?>
<script language="javascript">
 history.go(-2);
</script>
<?php
}

$messql="select * from todo where id = ".$_REQUEST["id"];
$tododata=$dbobj->GetData($messql);

?>
<script type="text/javascript" src="http://siteadmin.itcube.ne.jp/js/YahhoCal.js"></script>
<script type="text/javascript">YahhoCal.loadYUI(); //Googleのサーバから読み込む場合
 
//YahhoCal.loadYUI("/path/to/your/yui/dir/"); //自分のサーバから読み込む場合。パスは環境に合わせて変更してください
</script>

<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<table width="100%"  border="0" align="center" cellpadding="2" cellspacing="2">
    
    <tr>
        <td colspan="2">
            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td >
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FCFCFC">
                            <tr>
                                <td width="4%"><img src="/GW/img/template/icon_todo.jpg" width="40" height="42"></td>
                                <td width="96%" class="title">TODO編集</td>
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
            <table width="98%"  border="0" align="center" cellpadding="3" cellspacing="0">
                <tr>
                        <form name="form1" method="post" action="">
                    <td bgcolor="#DCDCFF">
                            <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1">
                                <?php 
																												$sregday=explode(" ",$tododata["hopedate"]);
																												$sregdate=explode("-",$sregday[0]);
																												?>
                                <tr>
                                    <td height="40" bgcolor="#EFF6FF">タイトル<br>
                                            <input name="title" type="text" style="width:98%" value="<?php echo $tododata["title"] ?>" size="40">
                                    </td>
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
																												<option value="<?php echo $todo_cate_list[$i]["cate_id"];?>"><?php echo $todo_cate_list[$i]["cate_name"];?></option>
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
                                      <input type="text" name="hopedate" id="hopedate" value="<?php echo $todo_cate_list[$i]["hopedate"];?>" onclick="YahhoCal.render(this.id);" />
                                    </strong></td>
                                </tr>
                                <tr>
                                    <td>本文</td>
                                </tr>
                                <tr>
                                    <td bgcolor="#FFFFFF">
                                        <textarea name="comment" cols="40" rows="10" id="comment" style="width:98%"><?php echo $tododata["comment"] ?></textarea>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td bgcolor="#FFFFFF">
                                        <table width="700" border="0" cellpadding="1" cellspacing="1">
                                            
                                            <tr>
                                                <td height="30">
                                                    <input name="btm_addition" type="submit" id="btm_addition" value="更新する">
                                                    <input name="btm_back" type="button" id="btm_back" value="戻る" onClick="history.back()">
                                                    <input name="senddate" type="hidden" id="senddate" value="<?php echo $today; ?>">
                                                    <strong>
                                                    <input name="mode" type="hidden" id="mode">
                                                </strong></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                    </td>
                        </form>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
</table>