<?php
class Files{
	var $dbobj;
	var $data;
	
	function Files($dbobj) {
		$this->dbobj=$dbobj;
	}
	
	function Get_CateList() {
	
		$sql="select * from file_dir  where parents_id = 0 order by turn";
		$result=$this->dbobj->Query($sql);
		$resultnumrows=$this->dbobj->NumRows($result);
		$rows=0;
		
		if($resultnumrows!=0) {
			while($rows<$resultnumrows) {
				$data=$this->dbobj->FetchArray($result,$rows);
				$this->data[]=$data;
				$this->_Get_CateList($data["dir_id"]);
				$rows++;
			}
		}
		
		return $this->data;
		
	}
	
	function _Get_CateList($dir_id) {
		$sql="select * from file_dir  where parents_id = $dir_id order by turn";
		
		$result=$this->dbobj->Query($sql);
		$resultnumrows=$this->dbobj->NumRows($result);
		$rows=0;
		
		while($rows<$resultnumrows) {
			$data=$this->dbobj->FetchArray($result,$rows);
			$space="　";
			$srows=0;
			
			while($srows<$data["rank"]) {
				$data["dir_name"]=$space.$data["dir_name"];
				$srows++;
			}
			
			$this->data[]=$data;
			$this->_Get_CateList($data["dir_id"]);
			$rows++;
			
		}
	}
	
	function GetFileList($dir_id) {
	
		if($dir_id!=NULL) {
			$sql="select * from files where dir_id = ".$dir_id." order by turn";
			$data=$this->dbobj->GetList($sql);
		}
		else{
			$sql="select * from files order by turn";
			$data=$this->dbobj->GetList($sql);
		}
		
		return $data;
	}
	
	function Get_CateData($dir_id) {
		if($dir_id!=NULL) {
		
			$sql="select * from file_dir where dir_id = ".$dir_id." order by turn";
			$data=$this->dbobj->GetData($sql);
			
		}
		else{
		
			$sql="select * from file_dir where dir_id = 0 order by turn";
			$data=$this->dbobj->GetData($sql);
			
		}
		
		return $data;
	}
	
	function Update_Cate($pdata) {
		$sql="select * from file_dir where dir_id = ".$pdata["parents_id"];
		$data=$this->dbobj->GetData($sql);
		
		if($pdata["parents_id"]!=$pdata["cate_id"]) {
		
			$upsql=	"update file_dir set ".
					"parents_id=".$pdata["parents_id"].",".
					"dir_name='".$pdata["dir_name"]."',".
					"rank=".($data["rank"]+1)."".
					" where dir_id = ".$pdata["cate_id"]."";
					
			$this->dbobj->Query($upsql);
			return 0;
		}
		else {
			return "親種別と自種別が同じになっています。";
		}
	}
	
	function Addition_Cate($pdata) {
		$sql="select * from file_dir where dir_id = ".$pdata["parents_id"];
		$data=$this->dbobj->GetData($sql);
		$maxsql="select max(dir_id) as maxid from file_dir";
		$maxdata=$this->dbobj->GetData($maxsql);
		$maxid=1;
		
		$maxid+=$maxdata["maxid"];
		$upsql=	"insert into file_dir(dir_id,parents_id,dir_name,rank,turn)  ".
				" values (".
				$maxid.",".$pdata["parents_id"].",".
				"'".$pdata["dir_name"]."',".
				"".($data["rank"]+1).",".
				"".$maxid.")";
		$this->dbobj->Query($upsql);
		return 0;
	}
	
	function Get_FileData($files_id){
		$sql="select * from files where files_id = ".$files_id;
		$data=$this->dbobj->GetData($sql);
		return $data;
	}
	
	function Update_File($pdata,$fdata) {
		$sql="select * from file_dir where dir_id = ".$pdata["parents_id"];
		$data=$this->dbobj->GetData($sql);
		if($fdata[0]["error"]==0) {
			$upsql=	"update files set ".
					"dir_id=".$pdata["parents_id"].",".
					"files_name='".$pdata["files_name"]."',".
					"files_size=".($fdata[0]["size"]/1000).",".
					"file_path='".$fdata[0]["filepath"]."',".
					"file_type='".$fdata[0]["type"]."'".
					" where files_id = ".$pdata["files_id"]."";
		}
		else {
			$upsql=	"update files set ".
					"dir_id=".$pdata["parents_id"].",".
					"files_name='".$pdata["files_name"]."'".
					" where files_id = ".$pdata["files_id"]."";
		}
		$this->dbobj->Query($upsql);
		return 0;
	}
	
	function Addition_File($pdata,$fdata) {
		$sql="select * from file_dir where dir_id = ".$pdata["parents_id"];
		$data=$this->dbobj->GetData($sql);
		$maxsql="select max(files_id) as maxid from files";
		$maxdata=$this->dbobj->GetData($maxsql);
		$maxid=1;
		
		$maxid+=$maxdata["maxid"];
		$date=date("Y-m-d",time());
		$upsql=	"insert into files(files_id,files_name,registdate,turn,dir_id,files_size,file_path,file_type)  ".
				" values (".
				$maxid.",'".$pdata["files_name"]."',".
				"'".$date."',".
				"".$maxid.",".
				"".$pdata["parents_id"].
				",".($fdata[0]["size"]/1000).",'".$fdata[0]["filepath"]."','".$fdata[0]["type"]."'".
				")";
		$this->dbobj->Query($upsql);
		return 0;
	}
}
/*
?><meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php
*/

?>