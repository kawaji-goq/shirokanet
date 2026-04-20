<?php 

$scheobj=new Schedule($dbobj);
$schedata=$scheobj->GetList($_GET["sche_id"]);
$mselList=$scheobj->GetSelList($_GET["sche_id"]);
$mList=$scheobj->GetMList();
$Gobj=new Group($dbobj);
$GAList=$Gobj->GetAllList();
$mAttendList=$scheobj->GetSelAttendList2($_GET["sche_id"],1);

$sql="SELECT schedule.*, member.*, schedule_master.schedule_id
		FROM member INNER JOIN (schedule INNER JOIN schedule_master ON 
		schedule.schedule_id = schedule_master.schedule_id) ON member.member_id = schedule_master.member_id
		WHERE (((schedule_master.schedule_id)=".$_GET["sche_id"]."))";

$data=$dbobj->GetData($sql);

if($_SESSION["mem_id"]!=NULL) {
	$atrows=0;
	$addtxt="";
	//参加者分のメールを送信
	while($mAttendList[$atrows]["member_id"]!=NULL) {
		$sbj=$schedata["title"];
		$mailtxt=strip_tags(str_replace("<br />","\n",$schedata["comment"]));
		
		//出欠確認を取る場合
		if($schedata["mail_send"]==1) {
			$addtxt="\n-----------------\n".
					"下記urlから出欠を登録してください。\n".
					"http://www.".$_SERVER['HTTP_HOST']."/keitai/schedule_attend.php?kpass=".$mAttendList[$atrows]["kpass"]."&sche_id=".$_GET["sche_id"]."";
		}
		else {
					"下記urlから詳細を確認してください。\n".
					"http://www.".$_SERVER['HTTP_HOST']."/keitai/schedule_detail.php?kpass=".$mAttendList[$atrows]["kpass"]."&sche_id=".$_GET["sche_id"]."";
		}
		
		//携帯アドレスが有る場合に送信　送信チェックを入れる
		if($mAttendList[$atrows]["kpass"]!=NULL) {
			mb_send_mail($mAttendList[$atrows]["kmail"],$sbj,$mailtxt.$addtxt,"From:info@".$_SERVER['HTTP_HOST']."\n");
			$upsql="update schedule_master  set mail_send =1 ".
					" where member_id=".$mAttendList[$atrows]["member_id"]." and schedule_id =".$_GET["sche_id"];
			$dbobj->Query($upsql);		
		}
		
		$atrows++;
	}
	
}

?>
<script language="javascript">
location.replace("index.php?PID=sche_up&sche_id=<?php echo $_GET["sche_id"] ?>");
</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
