<?php 
class Cube_Mysql {
	var $dbhandle;
	var $host;
	var $port;
	var $name;
	var $user;
	var $pass;
	var $result;
	var $numrows;
	var $errdata;
	var $debag;
	var $language;
	var $charcode;
	//constructor
	function Cube_Mysql() {
		$this->language="japanese";
		$this->charcode="utf-8";
		$this->port="3306";
		$this->host='mysql203.xbiz.ne.jp';
		$this->user="xb464987_shiroka";
		$this->pass="xrhHKXtm63hYRH";
		$this->debag=0;
		$this->errdata=$this->ErrList();
		
	}
	function SelectList($table,$where,$lim,$setnum,$orderby) {
		
		if($orderby==NULL) {
			$orderby="turn";
		}
		
		$sql="select * from ".$table." ".$where." order by ".$orderby." ".$this->CreateLimitSql("",$lim,$setnum);
		$data=$this->GetList($sql);
		return $data;
	}
	function Connect() {
		$errnum=0;
		//$consrc="'".$this->host."','".."','".."'";
				
		if($this->host!=NULL&&$this->name!=NULL&&$this->user!=NULL&&$this->pass!=NULL) {
			//echo $this->host.",".$this->user.",".$this->pass;
			$this->dbhandle=mysqli_connect($this->host,$this->user,$this->pass);
			
			mysqli_select_db($this->dbhandle,$this->name);
			if($this->dbhandle) {
				$this->Err("DB000");
			}
			else {
				echo $consrc;
				$this->Err("DB101");
			}
		}
		else {
			$this->Err("DB101");
		}
	}
	function SelectSimpleList($table,$where) {
		
		if($orderby==NULL) {
			$orderby="turn";
		}
		
		$sql="select * from ".$table." ".$where." order by turn";
		$data=$this->GetList($sql);
		return $data;
	}
	function Close() {
		$res=@mysql_close($this->dbhandle);
	}
	
	function FreeResult($result) {
	
		$res=@mysqli_free_result($result);
		
	}
	
	function Query($sql) {
		mysqli_set_charset($this->dbhandle, $this->charcode);
		$sql=mb_convert_encoding($sql,'utf-8');

		$result=mysqli_query($this->dbhandle,$sql);

		if($result) {
			//$this->Err("DB001");
			return $result;
		}
		else{
			mysqli_error($this->dbhandle);
//			mb_send_mail("yusaku@itcube.jp","DBERR:".$_SERVER['HTTP_HOST'],$sql,"\nFrom:yusaku.itc@gmail.com");
			$this->Err("DB102");
			//echo $sql;
		}
	}
	
	function NumRows($result) {
		$numrows=@mysqli_num_rows($result);
		return $numrows;
	}
	
	function FetchArray($result,$rows) {
		$data=@mysqli_fetch_array($result);
		//$this->FreeResult($result);
		return $data;
	}
	
	function FetchAllArray($result,$resultnumrows) {
		if($resultnumrows!=0) {
			$rows=0;
			while($rows<$resultnumrows) {
				$data[$rows]=$this->FetchArray($result,$rows);
				$rows++;
			}
			$this->FreeResult($result);
			return $data;
		}
	}
	
	function GetData($sql) {
		$result=$this->Query($sql);
		$resultnumrows=$this->NumRows($result);
		if($resultnumrows!=0) {
			$data=$this->FetchArray($result,0);
			mb_convert_variables('euc-jp','auto',$data);
			return $data;
		}
	}
	
	function GetList($sql) {
		$result=$this->Query($sql);
		$resultnumrows=$this->NumRows($result);
		if($resultnumrows!=0) {
			$data=$this->FetchAllArray($result,$resultnumrows);
			mb_convert_variables('euc-jp','auto',$data);
			return $data;
		}
	}
	function GetMaxId($table,$id) {
		$sql="select max(".$id.") as maxid from ".$table;
		$data=$this->GetData($sql);
		$maxid=1+$data["maxid"];
		return $maxid;
	}
	
	function Insert($table,$field,$data) {
		
		$ftxt="(";
		$dtxt="";
	//	print_r($data);
		for($i=0;$field[$i]!=NULL;$i++) {
			if($field[$i]=="option") {
				$field[$i]=str_replace("option","options",$field[$i]);
			}
			if($i!=0) {
				$ftxt.=",";
				$dtxt.=",";
			}
			
			$ftxt.=$field[$i];
			$dtxt.=$data[$i];
			
		}
		
		$ftxt.=") values (";
		$dtxt.=")";
		
		$sql="insert into ".$table.$ftxt.$dtxt;
		if($_SERVER['REMOTE_ADDR']=="118.243.22.177") {
			//echo $this->name;
			
		//	echo $sql;
		}
		$result=$this->Query($sql);
		return $result;
		
	}
	
	function Update($table,$field,$data,$where) {
		
		$querytxt="";
				
		for($i=0;$field[$i]!=NULL;$i++) {
			
			if($i!=0) {
				$querytxt.=",";
		
			}
			if($field[$i]=="option") {
				$field[$i]=str_replace("option","options",$field[$i]);
			}
			$querytxt.=$field[$i]."=".$data[$i];
		
		}
		
		$sql="update ".$table." set ".$querytxt." ".$where;
		$result=$this->Query($sql);
		return $result;
		
	}
	function Delete($table,$where) {
		
		$querytxt="";
		$sql="delete from ".$table." ".$where;
		$result=$this->Query($sql);

		return $result;
		
	}
	function ErrList() {
		$errdata["DB000"]["mes"]="DBの接続に成功しました。";
		$errdata["DB000"]["pro"]="nopb";
		$errdata["DB001"]["mes"]="クエリーの実行に成功しました。";
		$errdata["DB001"]["pro"]="nopb";
		$errdata["DB101"]["mes"]="データベースの接続に失敗しました。";
		$errdata["DB101"]["pro"]="stop";
		$errdata["DB102"]["mes"]="クエリーの実行に失敗しました。";
		$errdata["DB102"]["pro"]="stop";
		return $errdata;
	}
		function SelectData($table,$where) {
		$sql="select * from ".$table." ".$where;
		$data=$this->GetData($sql);
		return $data;
	}

	function CreateLimitSql($sql,$lim,$setnum) {
		if($setnum==NULL||$setnum==""){
		$setnum=0;
		}
		if($lim!=NULL&&$lim!="") {
			$sql.=" limit $setnum,$lim";
		}
			return $sql;
	}
	function Err($errcode) {
		if($this->debag==1){
			//echo $this->errdata[$errcode]["mes"]."<br>";
		}
		else {
			if($errcode!="DB000"&&$errcode!="DB001"){
				//echo $this->errdata[$errcode]["mes"]."<br>";
			}
		}
	}
	
	function TList() {
		$result=$this->Query("SHOW TABLES ");
		$resultnumrows=$this->NumRows($result);
		if($resultnumrows!=0) {
			$data=$this->FetchAllArray($result,$resultnumrows);
			return $data;
		}
		return $data;
	}
	
	function FList($table) {
		$result=$this->Query("SHOW FIELDS FROM ".$table);
		$resultnumrows=$this->NumRows($result);
		if($resultnumrows!=0) {
			$data=$this->FetchAllArray($result,$resultnumrows);
			return $data;
		}
	}
	
}


