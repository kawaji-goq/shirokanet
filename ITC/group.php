<?php
class Group {
	var $dbobj;
	function Group($dbobj) {
		$this->dbobj=$dbobj;
	}
	
	function GetAllList2($orderby) {
		$sql="select * from M_GROUP order by ".$orderby;
		$db=$this->dbobj;
		$data=$db->GetList($sql);
		return $data;
	}
	
	function GetAllList() {
		$sql="SELECT * from M_GROUP order by turn";
		$db=$this->dbobj;
		$data=$db->GetList($sql);
		return $data;
		
	}
	function GetAllSelList($id) {
		$db=$this->dbobj;
		if($id==NULL) {
			$sql2="select * from member order by hurigana";
			$rdata=$db->GetList($sql2);
			$rows=0;
		}
		else{ 
			$sql="SELECT M_GROUP.group_name, member.*, M_GROUP.group_id
	FROM (M_GROUP INNER JOIN group_master ON M_GROUP.group_id=group_master.group_id) INNER JOIN member ON group_master.member_id=member.member_id
	WHERE (((M_GROUP.group_id)=".$id."))";
			$rdata=$db->GetList($sql);
		}
		return $rdata;
	}
	
	function GetList($id) {
		if($id!=NULL) {
			$sql="select * from M_GROUP where group_id=".$id;
			$db=$this->dbobj;
			$data=$db->GetList($sql);
			return $data;
		}
	}
	
	
	function Addition($data) {
		$db=$this->dbobj;
		$sql="select max(group_id) as maxid from M_GROUP ";
		$maxid=1;
		$maxdata=$db->GetData($sql);
		$maxid+=$maxdata["maxid"];
		
		$insql="insert into M_GROUP (group_id,group_name,turn)".
				" values (".
				$maxid.",".
				"'".$data["group_name"]."'".",".
				$maxid.
				")";
		$result=$db->Query($insql);
		
		if($result) {
			$rrows=0;
			while($data[rlist][$rrows]) {
				$sql2="select max(gm_id) as maxid from group_master ";
				$maxid2=1;
				$maxdata2=$db->GetData($sql2);
				$maxid2+=$maxdata2["maxid"];
				
				$insql="insert into group_master (gm_id,group_id,member_id,turn)".
						" values (".
						$maxid2.",".
						"'".$maxid."'".",".$data[rlist][$rrows].",".
						$maxid.
						")";
				$result=$db->Query($insql);
				$rrows++;
			}
		}
		return $result;
	}
	
	function Update($data) {
		$db=$this->dbobj;
		$upsql=	"update M_GROUP set ".
				"group_name = '".$data["group_name"]."'".
				" where group_id = ".$data["group_id"];
		$result=$this->dbobj->Query($upsql);
		
		if($result) {
			$delsql="delete from group_master where group_id = ".$data["group_id"];
			$this->dbobj->Query($delsql);
			$rrows=0;
			while($data["rlist"][$rrows]) {
				$sql2="select max(gm_id) as maxid from group_master ";
				$maxid2=1;
				$maxdata2=$db->GetData($sql2);
				$maxid2+=$maxdata2["maxid"];
				
				$insql="insert into group_master (gm_id,group_id,member_id,turn)".
						" values (".
						$maxid2.",".
						"'".$data["group_id"]."'".",".$data[rlist][$rrows].",".
						$maxid2.
						")";
				$result=$db->Query($insql);
				$rrows++;
			}
		}
		return $result;
	}
	
	function GetSelList($group_id) {
		$db=$this->dbobj;
		$sql="select * from group_master where group_id=".$group_id;
		$data=$db->GetList($sql);
		$rows=0;
		
		while($data[$rows]["member_id"]!=NULL) {
			$sql="select * from member where member_id =".$data[$rows]["member_id"];
			$rdata[]=$db->GetData($sql);
			$rows++;
		}
		return $rdata;
		
	}
	
	function GetNSelList($group_id) {
		$db=$this->dbobj;
		$sql="select * from group_master where group_id=".$group_id;
		$data=$db->GetList($sql);
		$rows=0;
		$wheresql="";
		while($data[$rows]["group_id"]!=NULL) {
			$wheresql.=" and member_id <> ".$data[$rows]["member_id"];
			$rows++;
		}
		
		$sql="select * from member where member_id <> 0 ".$wheresql;
		$rdata=$db->GetList($sql);
		return $rdata;
		
	}
	function Delete($id) {
		$delsql="delete from group_master where group_id = ".$id;
		$result=$this->dbobj->Query($delsql);
		
		$delsql="delete from M_GROUP where group_id = ".$id;
		$result=$this->dbobj->Query($delsql);
	}
}
/*
?><meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php
*/
?>