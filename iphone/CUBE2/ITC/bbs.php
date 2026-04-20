<?php 
class Cube_BBS {
	var $dbobj;
	
	function Cube_BBS($dbobj) {
		$this->dbobj=$dbobj;
	}
	
	function Get_SledList() {
		$sql="select * from bbs_sled where parents = 0";
		$data=$this->dbobj->GetList($sql);
		return $data;
	}
	
	function Get_TopicsList($sled_id) {
		if($_GET["PAGE"]==NULL) {
			$_GET["PAGE"]=1;
		}
			$sql="SELECT bbs_sled.sled_id, bbs_sled.sled_name, bbs_sled.parents, bbs_sled.cate_name, ".
				"bbs_sled.master_name, bbs_sled.master_id, bbs_sled.master_comment, bbs_sled.last_name,".
				"bbs_sled.last_id,bbs_sled.last_comment,bbs_sled.countnum,bbs_sled.registdate,".
				"bbs_sled.last_update,bbs_sled.upfiles,Count(bbs_sledlogs.log_id) AS maxcount ".
				"FROM bbs_sled INNER JOIN bbs_sledlogs ON bbs_sled.sled_id = bbs_sledlogs.sled_id ".
				"GROUP BY bbs_sled.sled_id, bbs_sled.sled_name, bbs_sled.parents, bbs_sled.cate_name,".
				" bbs_sled.master_name, bbs_sled.master_id, bbs_sled.master_comment, bbs_sled.last_name,".
				" bbs_sled.last_id, bbs_sled.last_comment, bbs_sled.countnum, bbs_sled.registdate, ".
				"bbs_sled.last_update, bbs_sled.upfiles having parents=".$sled_id." order by last_update desc ".($this->dbobj->CreateLimitSql("",10,($_GET["PAGE"]-1)*10));
		$data=$this->dbobj->GetList($sql);
		return $data;
	}
	
	function Get_UpSledList($limitnum) {
		if($limitnum!="all") {
			$sql="SELECT bbs_sled.sled_id, bbs_sled.sled_name, bbs_sled.parents, bbs_sled.cate_name, ".
				"bbs_sled.master_name, bbs_sled.master_id, bbs_sled.master_comment, bbs_sled.last_name,".
				"bbs_sled.last_id,bbs_sled.last_comment,bbs_sled.countnum,bbs_sled.registdate,".
				"bbs_sled.last_update,bbs_sled.upfiles,Count(bbs_sledlogs.log_id) AS maxcount ".
				"FROM bbs_sled INNER JOIN bbs_sledlogs ON bbs_sled.sled_id = bbs_sledlogs.sled_id ".
				"GROUP BY bbs_sled.sled_id, bbs_sled.sled_name, bbs_sled.parents, bbs_sled.cate_name,".
				" bbs_sled.master_name, bbs_sled.master_id, bbs_sled.master_comment, bbs_sled.last_name,".
				" bbs_sled.last_id, bbs_sled.last_comment, bbs_sled.countnum, bbs_sled.registdate, ".
				"bbs_sled.last_update, bbs_sled.upfiles order by last_update desc ".$this->dbobj->CreateLimitSql("",$limitnum,"");
		}
		else {
			$sql="SELECT bbs_sled.sled_id, bbs_sled.sled_name, bbs_sled.parents, bbs_sled.cate_name, ".
				"bbs_sled.master_name, bbs_sled.master_id, bbs_sled.master_comment, bbs_sled.last_name,".
				"bbs_sled.last_id,bbs_sled.last_comment,bbs_sled.countnum,bbs_sled.registdate,".
				"bbs_sled.last_update,bbs_sled.upfiles,Count(bbs_sledlogs.log_id) AS maxcount ".
				"FROM bbs_sled INNER JOIN bbs_sledlogs ON bbs_sled.sled_id = bbs_sledlogs.sled_id ".
				"GROUP BY bbs_sled.sled_id, bbs_sled.sled_name, bbs_sled.parents, bbs_sled.cate_name,".
				" bbs_sled.master_name, bbs_sled.master_id, bbs_sled.master_comment, bbs_sled.last_name,".
				" bbs_sled.last_id, bbs_sled.last_comment, bbs_sled.countnum, bbs_sled.registdate, ".
				"bbs_sled.last_update, bbs_sled.upfiles order by last_update desc";
		}
		$data=$this->dbobj->GetList($sql);		
		return $data;
	}
	
	function get_NoReadList($member_id) {
		$sql="SELECT bbs_sled.sled_id, bbs_sled.sled_name, bbs_sled.parents,bbs_readlogs.read_status, bbs_sled.cate_name, ".
			"bbs_sled.master_name, bbs_sled.master_id, bbs_sled.master_comment, bbs_sled.last_name,".
			"bbs_sled.last_id,bbs_sled.last_comment,bbs_sled.countnum,bbs_sled.registdate,".
			"bbs_sled.last_update,bbs_sled.upfiles,Count(bbs_sledlogs.log_id) AS maxcount ".
			"FROM bbs_sled INNER JOIN bbs_sledlogs ON bbs_sled.sled_id = bbs_sledlogs.sled_id inner join bbs_readlogs on bbs_sled.sled_id = bbs_readlogs.sled_id ".
			"GROUP BY bbs_sled.sled_id,bbs_readlogs.sled_id,bbs_readlogs.member_id,bbs_readlogs.read_status, bbs_sled.sled_name, bbs_sled.parents, bbs_sled.cate_name,".
			" bbs_sled.master_name, bbs_sled.master_id, bbs_sled.master_comment, bbs_sled.last_name,".
			" bbs_sled.last_id, bbs_sled.last_comment, bbs_sled.countnum, bbs_sled.registdate, ".
			"bbs_sled.last_update, bbs_sled.upfiles having read_status = 0 and bbs_readlogs.member_id = ".$member_id." order by last_update desc";
		$data=$this->dbobj->GetList($sql);		
		return $data;
	}
	
	function Get_TehmaList2($lim) {
		if($lim==NULL) {
			$lim=5;
		}
		else if($lim==0) {
			$lim=1;
		}
	
		$sql="select * from bbs_sled where parents = 0 order by sled_id ".$this->dbobj->CreateLimitSql("",$lim,$setnum);;
		return $this->dbobj->GetList($sql);
	}
	function Get_ThemaList() {
		if($_GET["PAGE"]==NULL) {
			$_GET["PAGE"]=1;
		}
		$sql="select * from bbs_sled where parents = 0 order by sled_id ".$this->dbobj->CreateLimitSql("",20,($_GET["PAGE"]-1)*20);
		return $this->dbobj->GetList($sql);
	}
	function get_PagerData($type) {
		switch($type) {
			case "theme_max":
				$sql="select count(parents) as countnum from bbs_sled where parents = 0";
				$data=$this->dbobj->GetData($sql);
				return ceil($data["countnum"]/20);
				break;
				
			case "topics_max":
			$sql="SELECT count(bbs_sled.sled_id) as countnums from bbs_sled where  parents=".$_GET["sled_id"];
				$data=$this->dbobj->GetData($sql);
				return ceil($data["countnums"]/10);
				break;
			default:
				break;
		}
	}
	function Get_ResData($sled_id,$res_id) {
		$sql="select * from bbs_sledlogs where sled_id = ".$sled_id." and log_num = ".$res_id;
		$data=$this->dbobj->GetData($sql);
		return $data;
	}
	function Get_SledData($sled_id) {
		$sql=	"SELECT bbs_sled.sled_id, bbs_sled.sled_name, bbs_sled.parents, bbs_sled.cate_name, ".
				"bbs_sled.master_name, bbs_sled.master_id, bbs_sled.master_comment, bbs_sled.last_name,".
				"bbs_sled.last_id,bbs_sled.last_comment,bbs_sled.countnum,bbs_sled.registdate,".
				"bbs_sled.last_update,bbs_sled.upfiles,Count(bbs_sledlogs.log_id) AS maxcount ".
				"FROM bbs_sled INNER JOIN bbs_sledlogs ON bbs_sled.sled_id = bbs_sledlogs.sled_id ".
				"GROUP BY bbs_sled.sled_id, bbs_sled.sled_name, bbs_sled.parents, bbs_sled.cate_name,".
				" bbs_sled.master_name, bbs_sled.master_id, bbs_sled.master_comment, bbs_sled.last_name,".
				" bbs_sled.last_id, bbs_sled.last_comment, bbs_sled.countnum, bbs_sled.registdate, ".
				"bbs_sled.last_update, bbs_sled.upfiles HAVING (((bbs_sled.sled_id)=".$sled_id."))";
		$data=$this->dbobj->GetData($sql);
		
		if($data["sled_id"]==NULL) {
			
			$sql=	"SELECT * from bbs_sled where sled_id=".$sled_id."";
			$data=$this->dbobj->GetData($sql);
			
		}
		
		return $data;
	}
	
	function Get_LogData($sled_id,$pagelimit,$pagenum,$searkey) {
		
		if($pagelimit==NULL) {
			$pagelimit=20;
		}
		
		if($pagenum==NULL) {
			$pagenum=1;
		}
		
		$sql="select * from bbs_sledlogs where sled_id = ".$sled_id." and view_chk<>0 and (res_id =1 or res_id is NULL)  order by log_num ".$searkey;
		$sql=$this->dbobj->CreateLimitSql($sql,$pagelimit,($pagelimit*($pagenum-1)));
		$data=$this->dbobj->GetList($sql);
		
		return $data;
		
	}
	
	function get_SubLogList($sled_id ,$log_num,$rtxt) {
	    global $logindata;
		$sql="select * from bbs_sledlogs where sled_id = ".$sled_id." and res_id= ".$log_num. " order by writetime desc";
		$list=$this->dbobj->GetList($sql);
		for($i=0;$list[$i]["sled_id"]!=NULL;$i++) {
			$rtxt.='<hr>';
			$rtxt.='<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="20">&nbsp;</td>
        <td>'.$list[$i]["writer"].'　'.str_replace("-",".",$list[$i]["writetime"]);
			$readdata=$this->get_ReadCheck($sled_id,$logindata["member_id"]);
			if(strtotime($readdata["lastreadtime"])-strtotime($list[$i]['writetime'])<0) {
				$rtxt.='<font color="#FF0000"><strong>New!</strong></font>';
			}
			
			$rtxt.='<br>'.nl2br($list[$i]["comment"]).''.'<div align="right">';
			
			$rtxt.='<a href="index.php?PID=add_log&sled_id='.$list[$i]["sled_id"].'&res_id='.$list[$i]["log_num"].'"><img src="/CUBE_IMG/btn_reply_s_over.gif" width="76" height="26" border="0"></a>';
			
			if($logindata["member_id"]==$list[$i]["member_id"]||$logindata["admin_type"]==10){
			$rtxt.='<a href="?PID=up_log&log_id='.($list[$i]["log_id"]).'&sled_id='.$_REQUEST["sled_id"].'"><img src="img/template/bbs/rep.gif" width="76" height="23" border="0"></a>';
			}
			
			if($list[$i]["upfiles"]!=NULL) {
				$rtxt.='<a href="'.$list[$i]["upfiles"].'" target="_blank"><img src="http://siteadmin.itcube.ne.jp/gw/img/clip_sic.gif" width="16" height="20" border="0"></a>';
			}
			if($logindata["member_id"]==$list[$i]["member_id"]||$logindata["admin_type"]==10){
				$rtxt.='<a href="index.php?PID=del_log&sled_id='.$list[$i]["sled_id"].'&log_id='.$list[$i]["log_id"].'"><img src="http://siteadmin.itcube.ne.jp/gw/img/trashbox.gif" alt="この書き込みを削除する" width="16" height="20" border="0"></a>';
			}
			$rtxt.=' </div></td></tr></table>';
			
			$rtxt=$this->get_SubLogList($list[$i]["sled_id"] ,$list[$i]["log_num"],$rtxt);
		}
		//echo $rtxt;
		return $rtxt;
	}
	function Get_LastLogData($sled_id,$pagelimit) {
		$data=$this->Get_LogData($sled_id,$pagelimit,0,"desc");
		$rdata=@array_reverse($data,FALSE);
		return $rdata;
	}
	
	function Add_Log($data,$fdata) {
		global $logindata;
		$now=date("Y-m-d H:i:s",time());
		$sql="select max(log_id) as maxid from bbs_sledlogs";
		$maxdata=$this->dbobj->GetData($sql);
		$maxid=$maxdata["maxid"]+1;
		$sql2="select max(log_num) as maxid,count(log_num) as countnum from bbs_sledlogs where sled_id = ".$data["sled_id"];
		$maxdata2=$this->dbobj->GetData($sql2);
		$maxid2=$maxdata2["maxid"]+1;
		$countnum=$maxdata2["countnum"]+1;
		
		if($maxdata2["countnum"]!=0) {
			$view_chk=1;
		}
		else {
			$view_chk=0;
		}
		
		if($data["noname"]==1){
			$data["writer"]="匿名";
		}
		if($data["res_id"]==NULL) {
			$data["res_id"]=0;
		}
		$insql=	"insert into bbs_sledlogs (log_id,sled_id,comment,writer,member_id,writetime,log_num,upfiles,view_chk,res_id)".
				" values (".
				"$maxid,".$data["sled_id"].",'".$data["comment"]."','".$data["writer"]."',".$logindata["member_id"].",'".$now."',".$maxid2.
				",'".$fdata[0]["filepath"]."',".$view_chk.",".trim($data["res_id"]).")";				
				
		$this->dbobj->Query($insql);
		$upsql=	"update bbs_sled set ".
				"last_name='".$data["writer"]."',".
				"last_id=1,".
				"last_comment='".$data["comment"]."',".
				"last_update='".$now."',".
				"countnum =".$countnum.
				" where sled_id = ".$data["sled_id"];
		$this->dbobj->Query($upsql);
		$memlist=$this->dbobj->GetList("select * from member");
		for($i=0;$memlist[$i]["member_id"]!=NULL;$i++) {
			$this->set_ReadCheck($data["sled_id"],$memlist[$i]["member_id"],0);
		}
		
	}
	
	function up_Log($data,$fdata) {
		global $logindata;
		$now=date("Y-m-d H:i:s",time());
		$insql=	"update bbs_sledlogs set comment = '".$data["comment"]."' where log_id =".$data["log_id"];				
				
		$this->dbobj->Query($insql);
		$upsql=	"update bbs_sled set ".
				"last_update='".$now."',".
				" where sled_id = ".$data["sled_id"];
		$this->dbobj->Query($upsql);
		$memlist=$this->dbobj->GetList("select * from member");
		for($i=0;$memlist[$i]["member_id"]!=NULL;$i++) {
			$this->set_ReadCheck($data["sled_id"],$memlist[$i]["member_id"],0);
		}
		
		
	}
	function up_Topics($data) {
		$upsql="update bbs_sled set sled_name ='".$data["sled_name"]."',master_comment = '".$data["comment"]."' where sled_id = ".$data["sled_id"];
		$this->dbobj->Query($upsql);
		
		$upsql="update bbs_sledlogs set comment = '".$data["comment"]."' where sled_id = ".$data["sled_id"]." and log_num =1";
		$this->dbobj->Query($upsql);
		$memlist=$this->dbobj->GetList("select * from member");
		for($i=0;$memlist[$i]["member_id"]!=NULL;$i++) {
			$this->set_ReadCheck($data["sled_id"],$memlist[$i]["member_id"],0);
		}
	}
	
	function up_Theme($data) {
		 $upsql="update bbs_sled set sled_name ='".$data["sled_name"]."' where sled_id = ".$data["sled_id"];
		$this->dbobj->Query($upsql);
	}
	function Add_Theme($data,$fdata) {
		global $logindata;
		$now=date("Y-m-d H:i",time());
		$sql="select max(sled_id) as maxid from bbs_sled";
		$maxdata=$this->dbobj->GetData($sql);
		$maxid=$maxdata["maxid"]+1;
		if($data["noname"]==1){
			$data["master_name"]="匿名";
		}
		if($data["sled_id"]==NULL) {
			$data["sled_id"]=0;
		}
	$inssql="insert into bbs_sled (".
				"sled_id,sled_name,parents,cate_name,master_name,".
				"master_id,master_comment,last_name,last_id,last_comment,countnum,registdate,last_update".
				",upfiles)".
				" values (".
				"$maxid,'".$data["sled_name"]."',".$data["sled_id"].",'','".$data["master_name"]."',".
				"".$logindata["member_id"].",'".$data["master_comment"]."','".$data["master_name"]."',".$logindata["member_id"].",'".
				$data["master_comment"]."',1,'".$now."','".$now."','".$fdata[0]["filepath"]."'".
				")";
				
		$this->dbobj->Query($inssql);
		$logdata["sled_id"]=$maxid;
		$logdata["comment"]=$data["master_comment"];
		$logdata["writer"]=$data["master_name"];
		$logdata["noname"]=$data["noname"];
		if($data["sled_id"]!=0) {
			$this->Add_Log($logdata,$fdata);			
		}
		
	}
	
	function Del_Log($log_id) {
	
		$sql="select * from bbs_sledlogs where log_id = ".$log_id;
		$data=$this->dbobj->GetData($sql);
				
		$this->del_ResLog($data["sled_id"],$data["log_num"]);
				
		$delsql="delete from bbs_sledlogs where log_id = ".$log_id;		
		$result=$this->dbobj->Query($delsql);		

		if($result) {
			@unlink($data["upfiles"]);
		}
				
	}
	/*
	 * delete reslogs 
	 */
	function del_ResLog($sled_id,$log_num) {
		$sql="select * from bbs_sledlogs where sled_id = ".$sled_id ." and  res_id = ".$log_num;
		$list=$this->dbobj->GetList($sql);
		for($i=0; $list[$i]["log_id"]!=NULL;$i++) {
			$this->del_ResLog($list[$i]["sled_id"],$list[$i]["log_num"]);
			$delsql="delete from bbs_sledlogs where log_id = ". $list[$i]["log_id"];
			$this->dbobj->Query($delsql);
		}
	}
	
	
	function Del_Sled($sled_id) {
		$sql="select * from bbs_sledlogs where sled_id = ".$sled_id;
		$data=$this->dbobj->GetList($sql);
		$rows=0;
		
		while($data[$rows]["log_id"]!=NULL) {
			$this->Del_Log($data[$rows]["log_id"]);
			$rows++;
		}
		
		$sql2="select * from bbs_sled where sled_id = ".$sled_id;
		$data2=$this->dbobj->GetData($sql2);
		$delsql="delete from bbs_sled where sled_id = ".$sled_id;
		$result=$this->dbobj->Query($delsql);
		
		if($result) {
			@unlink($data2["upfiles"]);
		}
		
	}
	
	function Del_Theme($sled_id) {
		$sql="select * from bbs_sled where parents = ".$sled_id;
		$data=$this->dbobj->GetList($sql);
		$rows=0;
		
		while($data[$rows]["sled_id"]!=NULL) {
			$this->Del_Sled($data[$rows]["sled_id"]);
			$rows++;
		}
		
		$delsql="delete from bbs_sled where sled_id = ".$sled_id;
		$result=$this->dbobj->Query($delsql);
		
	}
	function Get_SelLog($log_id) {
		$sql="select * from bbs_sledlogs where log_id = ".$log_id;
		$data=$this->dbobj->GetData($sql);
		return $data;
	}
	
	function Resurved_DelLog($pdata) {
		
		$sql="update bbs_sledlogs set view_chk = 2 where log_id = ".$pdata["log_id"];
		$this->dbobj->Query($sql);
		
		$sub="BBSで削除依頼が有りました。";
		
		$text=	"以下の内容で削除依頼の申請が有りました。\n\n".
				"--------------------------------------------\n".
				"削除対象\n".
				"スレッド名　　：".$pdata["sled_name"]."\n".
				"記事番号　　　：".$pdata["log_num"]."\n".
				"書き込み者　　：".$pdata["writer"]."\n".
				"削除依頼者　　：".$pdata["del_name"]."\n".
				"メンバー名　　：".$pdata["member_name"]."\n".
				"\n".
				"--------------------------------------------\n".
				"削除理由\n".
				"--------------------------------------------\n".
				$pdata["del_reason"]."\n\n";
				
				
		$sub=mb_convert_kana($sub,"KV");
		$text=mb_convert_kana($text,"KV");
		mb_send_mail("info@".$_SERVER['HTTP_HOST']."",$sub,$text,"From:info@".$_SERVER['HTTP_HOST']."\nreturn-path:info@".$_SERVER['HTTP_HOST']."\n");
	}
	
	function Get_DelLogData() {
		$sql=	"SELECT bbs_sled.*, bbs_sledlogs.*, bbs_sledlogs.view_chk ".
				"FROM bbs_sled INNER JOIN bbs_sledlogs ON bbs_sled.sled_id = bbs_sledlogs.sled_id ".
				"WHERE (((bbs_sledlogs.view_chk)=2))";
		$data=$this->dbobj->GetList($sql);
		return $data;
	}
	
	function set_ReadCheck($sled_id,$member_id,$status) {
		$sql='select * from bbs_readlogs where sled_id = '. $sled_id . ' and member_id ='.$member_id;
		$res=$this->dbobj->Query($sql);
		$resnum=$this->dbobj->NumRows($res);
		if($resnum==0) {
			$maxsql="select max(logs_id) as maxid from bbs_readlogs";
			$maxdata=$this->dbobj->GetData($maxsql);
			$maxid=$maxdata["maxid"]+1;
			$inssql='insert into  bbs_readlogs (logs_id,sled_id,member_id,read_status) values ('.$maxid.','.$sled_id .','.$member_id.',' . $status.')';
			$this->dbobj->Query($inssql);			
		}
		else {
			$upsql='update bbs_readlogs set read_status = '.$status .' where sled_id = ' . $sled_id . ' and member_id = ' . $member_id;
			$this->dbobj->Query($upsql);			
		}
		if($status==1) {
			$upsql='update bbs_readlogs set lastreadtime = \''.date("Y-m-d H:i:s",time()) .'\' where sled_id = ' . $sled_id . ' and member_id = ' . $member_id;
			$this->dbobj->Query($upsql);			
		}
	}
	function get_ReadCheck($sled_id,$member_id) {	
		$sql='select * from bbs_readlogs where sled_id = '. $sled_id .' and member_id = '.$member_id;
		$data=$this->dbobj->GetData($sql);
				return $data;
	}
	
}
/*
?><meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php
*/
?>