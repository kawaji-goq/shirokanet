<?php
class Site_Links extends Ab_LinkPageType{
	function Site_Links($dbobj) {
		$this->dbobj=$dbobj;
		$this->bname="link";
	}
}

class Admin_Links extends Ab_AdminLinkPageType{
	function Admin_Links($dbobj) {
		$this->dbobj=$dbobj;
		$this->bname="link";
	}
}

class Links extends Ab_LinkPageType{
	function Links($dbobj) {
		$this->dbobj=$dbobj;
		$this->bname="link";
	}
}

class Ad_Links extends Ab_AdminLinkPageType{
	function Ad_Links($dbobj) {
		$this->dbobj=$dbobj;
		$this->bname="link";
	}
}
/*
class Links{

	var $dbobj;
	var $data;
	
	function Links($dbobj) {
		$this->dbobj=$dbobj;
	}
	
	function Get_CateList() {
	
		$sql="select * from link_cate  where parents_id = 0 order by turn";
		$result=$this->dbobj->Query($sql);
		$resultnumrows=$this->dbobj->NumRows($result);
		$rows=0;
		
		if($resultnumrows!=0) {
			while($rows<$resultnumrows) {
				$data=$this->dbobj->FetchArray($result,$rows);
				$this->data[]=$data;
				$this->_Get_CateList($data["cate_id"]);
				$rows++;
			}
		}
		
		return $this->data;
		
	}
	
	function Get_CateList2($id) {
	
		$sql="select * from link_cate  where parents_id = $id order by turn";
		$result=$this->dbobj->Query($sql);
		$resultnumrows=$this->dbobj->NumRows($result);
		$rows=0;
		
		if($resultnumrows!=0) {
			while($rows<$resultnumrows) {
				$data=$this->dbobj->FetchArray($result,$rows);
				$this->data[]=$data;
				$this->_Get_CateList($data["cate_id"]);
				$rows++;
			}
		}
		
		return $this->data;
		
	}
	
	function _Get_CateList($cate_id) {
		$sql="select * from link_cate  where parents_id = $cate_id order by turn";
		
		$result=$this->dbobj->Query($sql);
		$resultnumrows=$this->dbobj->NumRows($result);
		$rows=0;
		
		while($rows<$resultnumrows) {
			$data=$this->dbobj->FetchArray($result,$rows);
			$space="　";
			$srows=0;
			
			while($srows<$data["rank"]) {
				$data["cate_name"]=$space.$data["cate_name"];
				$srows++;
			}
			
			$this->data[]=$data;
			$this->_Get_CateList($data["cate_id"]);
			$rows++;
			
		}
	}
	
	function GetLinkList($cate_id) {
	
		if($cate_id!=NULL) {
			$sql="select * from link where cate_id = ".$cate_id." order by turn";
			$data=$this->dbobj->GetList($sql);
		}
		else{
			$sql="select * from link order by turn ".$this->dbobj->CreateLimitSql($sql,5,0);
			$data=$this->dbobj->GetList($sql);
		}
		
		return $data;
	}
	
	function GetLinkList2($cate_id) {
	
		if($cate_id!=NULL) {
			$sql="select * from link where cate_id = ".$cate_id." order by turn";
			$data=$this->dbobj->GetList($sql);
		}
		
		return $data;
	}
	
	function GetLinkLimList($cate_id,$lim,$setnum) {
		$limittxt=$this->dbobj->CreateLimitSql($sql,$lim,$setnum);
	
		if($cate_id!=NULL) {
			$sql="select * from link where cate_id = ".$cate_id." order by registdate desc ".$limittxt;
			$data=$this->dbobj->GetList($sql);
		}
		else{
			$sql="select * from link order by registdate desc ".$limittxt;
			$data=$this->dbobj->GetList($sql);
		}
		
		return $data;
	}
	
	function Get_CateData($cate_id) {
		if($cate_id!=NULL) {
		
			$sql="select * from link_cate where cate_id = ".$cate_id." order by turn";
			$data=$this->dbobj->GetData($sql);
			
		}
		else{
		
			$sql="select * from link_cate where cate_id = 0 order by turn";
			$data=$this->dbobj->GetData($sql);
			
		}
		
		return $data;
	}
	
	function Update_Cate($pdata) {
		$sql="select * from link_cate where cate_id = ".$pdata["parents_id"];
		$data=$this->dbobj->GetData($sql);
		
		if($pdata["parents_id"]!=$pdata["cate_id"]) {
		
			$upsql=	"update link_cate set ".
					"parents_id=".$pdata["parents_id"].",".
					"cate_name='".$pdata["cate_name"]."',".
					"rank=".($data["rank"]+1)."".
					" where cate_id = ".$pdata["cate_id"]."";
					
			$this->dbobj->Query($upsql);
			return 0;
		}
		else {
			return "親種別と自種別が同じになっています。";
		}
	}
	
	function Addition_Cate($pdata) {
		$sql="select * from link_cate where cate_id = ".$pdata["parents_id"];
		$data=$this->dbobj->GetData($sql);
		$maxsql="select max(cate_id) as maxid from link_cate";
		$maxdata=$this->dbobj->GetData($maxsql);
		$maxid=1;
		
		$maxid+=$maxdata["maxid"];
		$upsql=	"insert into link_cate(cate_id,parents_id,cate_name,rank,turn)  ".
				" values (".
				$maxid.",".$pdata["parents_id"].",".
				"'".$pdata["cate_name"]."',".
				"".($data["rank"]+1).",".
				"".$maxid.")";
		$this->dbobj->Query($upsql);
		return 0;
	}
	
	function Get_LinkData($link_id){
		$sql="select * from link where link_id = ".$link_id;
		$data=$this->dbobj->GetData($sql);
		return $data;
	}
	
	function Get_LinkDData($cate_id,$link_id,$pare_id){
		$db=$this->dbobj;
		if($link_id!=NULL) {
			$sql="select * from link where link_id = ".$link_id;
		}
		else if($cate_id!=0&&$cate_id!=1&&$cate_id!=2&&$cate_id!=3){
			$sql="select * from link where cate_id = ".$cate_id;
		}
		else {
			$sql="select * from link_cate where parents_id = ".$pare_id;
			$result=$db->Query($sql);
			$mksql=" where cate_id = 0 ";
			$numrows=$db->NumRows($result);
			if($numrows!=0) {
				$rows=0;
				while($rows<$numrows) {
					$data=$db->FetchArray($result,$rows);
					$mksql.=" or cate_id = ".$data["cate_id"];
					$rows++;
				}
				$sql="select * from link ".$mksql;
			} 
		}
		$data=$this->dbobj->GetData($sql);
		return $data;
	}
	
	function Update_Link($pdata) {
	
		$sql="select * from link_cate where cate_id = ".$pdata["parents_id"];
		$data=$this->dbobj->GetData($sql);
		
		$upsql=	"update link set ".
				"cate_id=".$pdata["parents_id"].",".
				"link_name='".$pdata["link_name"]."',".
				"url='".$pdata["url"]."' ".
				" where link_id = ".$pdata["link_id"]."";
		
		$this->dbobj->Query($upsql);
		return 0;
		
	}
	
	function Addition_Link($pdata) {
	
		$sql="select * from link_cate where cate_id = ".$pdata["parents_id"];
		$data=$this->dbobj->GetData($sql);
		$maxsql="select max(link_id) as maxid from link";
		$maxdata=$this->dbobj->GetData($maxsql);
		$maxid=1;
		
		$maxid+=$maxdata["maxid"];
		$date=date("Y-m-d",time());
		
		$upsql=	"insert into link(link_id,link_name,comment,url,registdate,turn,link_type,cate_id) ".
				" values (".
				$maxid.",'".$pdata["links_name"]."',".
				"'".$pdata["comment"]."',".
				"'".$pdata["url"]."',".
				"'".$date."'".
				",".$maxid.",0,".
				"".$pdata["parents_id"]."".
				")";
				
		$this->dbobj->Query($upsql);
		return 0;
	}
	
	
	function Get_ALLLinkCate() {
		$db=$this->dbobj;
		$sql="select * from link_cate where parents_id = 0";
		$result=$db->Query($sql);
		$numrows=$db->NumRows($result);
		if($numrows!=0){
			$rows=0;
			while($rows<$numrows) {
				$data[$rows]=$db->FetchArray($result,$rows);
				$rdata=$this->_Get_ALLLinkCate($data[$rows]["cate_id"],$data[$rows]);
				if($rdata!=NULL) {
					$data[$rows]=$rdata;
				}
				$rows++;
			}
		}
		return $data;
	}
	
	function _Get_ALLLinkCate($id,$data) {
		$db=$this->dbobj;
		$sql="select * from link_cate where parents_id = $id";
		$result=$db->Query($sql);
		$numrows=$db->NumRows($result);
		if($numrows!=0){
			$rows=0;
			while($rows<$numrows) {
				$data[$rows]=$db->FetchArray($result,$rows);
				$rdata=$this->_Get_ALLLinkCate($data[$rows]["cate_id"],$data[$rows]);
				if($rdata!=NULL) {
					$data[$rows]=$rdata;
				}
				$rows++;
			}
		}
		return $data;
	}
	function Get_CateLinkData($cate_id,$spnum) {
		$db=$this->dbobj;
		$sql="select * from link where cate_id = ".$cate_id;
		$data=$db->GetList($sql);
		
		$rows=0;
		while($data[$rows]["cate_id"]!=NULL) {
			$rdata[(int)($rows/$spnum)][(int)($rows%$spnum)]=$data[$rows];
			$rows++;
		}
		return $rdata;
		
	}
}
*/
/*
?><meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php
*/

?>