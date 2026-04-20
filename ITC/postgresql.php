<?php 
class Cube_Postgres {
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
	function Cube_Postgres() {
		$this->language="japanese";
		$this->charcode="euc-jp";
		$this->host="localhost";
		$this->port="5432";
		$this->name="common";
		$this->user="goq";
		$this->pass="itc2011";
		$this->debag=0;
		$this->errdata=$this->ErrList();
	}
	
	function Connect() {
		$errnum=0;
		$consrc="host=".$this->host.
				//" port = ".$this->port.
				" dbname = ".$this->name.
				" user = ".$this->user.
				" password=".$this->pass;
		if($this->host!=NULL&&$this->host!=NULL&&$this->host!=NULL&&$this->host!=NULL&&$this->host!=NULL) {
			$this->dbhandle=pg_connect($consrc);
			
			if($this->dbhandle) {
				@pg_set_client_encoding($this->dbhandle,$this->charcode);
				$this->Err("DB000");
			}
			else {
				$this->Err("DB101");
				echo "ただいまシステムのメンテナンス中です<br />しばらくたってからお試しください。";
				exit();
			}
			
		}
		else {
			$this->Err("DB101");	
			exit();
		}
	}
	
	function Count($sql) {
		$result=$this->Query($sql);
		$resultnumrows=$this->NumRows($result);
		return $resultnumrows;
	}
	function Close() {
		$res=pg_close($this->dbhandle);
	}
	
	function FreeResult($result) {
		$res=pg_free_result($result);
	}
	
	function Query($sql) {
		$result=@pg_query($this->dbhandle,$sql);
		if($result) {
			$this->Err("DB001");
			return $result;
		}
		else{
			if($this->debag==1){		
				$this->Err("DB102");
					//	mb_send_mail("yusaku@itcube.jp","DBERR:".$_SERVER['HTTP_HOST'],$sql,"\nFrom:yusaku.itc@gmail.com");

				if($_SERVER['REMOTE_ADDR']=="43.244.223.65") {
					echo $sql;
				}
			}
		}
	}
	
	function NumRows($result) {
		$numrows=@pg_num_rows($result);
		$this->numrows=$numrows;
		return $numrows;
	}
	
	function FetchArray($result,$rows) {
		$data=@pg_fetch_array($result,$rows);
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
			return $data;
		}
	}
	
	function GetList($sql) {
		$result=$this->Query($sql);
		$resultnumrows=$this->NumRows($result);
		if($resultnumrows!=0) {
			$data=$this->FetchAllArray($result,$resultnumrows);
			return $data;
		}
	}
	
	function CreateLimitSql($sql,$lim,$setnum) {
		if($lim!=NULL) {
			$sql.=" limit $lim ";
		}
		if($setnum!=NULL) {
			$sql.="offset ".$setnum;
		}
		return $sql;
	}
	/*
	
	*/
	function SelectList($table,$where,$lim,$setnum,$orderby) {
		
		if($orderby==NULL) {
			$orderby="turn";
		}
		
		$sql="select * from ".$table." ".$where." order by ".$orderby." ".$this->CreateLimitSql("",$lim,$setnum);
		$data=$this->GetList($sql);
		return $data;
	}
	
	function SelectSimpleList($table,$where) {
		
		if($orderby==NULL) {
			$orderby="turn";
		}
		
		$sql="select * from ".$table." ".$where." order by turn";
		$data=$this->GetList($sql);
		return $data;
	}
	function SelectData($table,$where) {
		$sql="select * from ".$table." ".$where;
		$data=$this->GetData($sql);
		return $data;
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
		if($_SERVER['REMOTE_ADDR']=="43.244.223.65") {
			//echo $sql;
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
		$errdata["DB000"]["mes"]="DBの接続に成功しました。<br />";
		$errdata["DB000"]["pro"]="nopb";
		$errdata["DB001"]["mes"]="クエリーの実行に成功しました。<br />";
		$errdata["DB001"]["pro"]="nopb";
		$errdata["DB101"]["mes"]="データベースの接続に失敗しました。<br />";
		$errdata["DB101"]["pro"]="stop";
		$errdata["DB102"]["mes"]="クエリーの実行に失敗しました。<br />";
		$errdata["DB102"]["pro"]="stop";
		return $errdata;
	}
	
	function Err($errcode) {
		if($this->debag==1){
			echo $this->errdata[$errcode]["mes"]."<br>";
		}
		else {
			if($errcode!="DB000"&&$errcode!="DB001"){
				echo $this->errdata[$errcode]["mes"]."<br>";
			}
		}
	}
	
}
/*
?><meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php
*/
?>
