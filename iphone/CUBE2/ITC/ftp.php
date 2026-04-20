<?php

class Cube_FTP{
	var $fp;
	var $con;
	var $defaultpath;
	var $host;
	var $useport;
	var $ddir;
	
	function Cube_FTP() {
		$this->host="itcube.ne.jp";
		$this->useport=21;
		$this->ddir="/httpdocs/";
	}
	
	function Connect($id,$pass) {
		$this->con=ftp_connect($this->host,$this->useport);
		if($this->con) {
			$this->fp=ftp_login($this->con,$id,$pass);
			return $this->fp;
		}
		else {
			return 1;
		}
	}
	function ChDir($dir) {
		ftp_chdir($this->con,$this->ddir);
		return @ftp_chdir($this->con,$dir);
	}
	
	function MkDir($dir,$dirname) {
		$this->ChDir($dir);
		$mkres=@ftp_mkdir($this->con,$dirname);
		$upres=@ftp_site($this->con,"chmod 0777 ".$dirname);
		return $mkres;
	}
	function RmFile($filepath) {
		$this->ChDir("");
			
		return ftp_delete($this->con,$filepath);
	}
	function RmDir($dir) {
		$this->ChDir("");
		return @ftp_rmdir($this->con,$dir);
	}
	
	function GetList($dir) {
		$this->ChDir($dir);
		return ftp_rawlist($this->con,"");
	}
	
	function GetSimpleList($dir) {
		$this->ChDir($dir);
		return ftp_nlist($this->con,"");
	}
	
	function UpData($dir,$rname,$fpath,$mode) {
	
		$res=$this->ChDir($dir);
		if($res) {
			if($mode=="b") {
				$upres=ftp_put($this->con,$rname,$fpath,FTP_BINARY);
			}
			else {
				$upres=ftp_put($this->con,$rname,$fpath,FTP_ASCII);
			}
			$res=$this->ChDir($dir);
			$upres=@ftp_site($this->con,"chmod 0777 ".$rname);
			//echo " chmod 0777 ".$rname;
		}
	}
	function DownData($dir,$rname,$fpath,$mode) {
		$res=$this->ChDir($dir);
		if($res) {
			if($mode=="b") {
				return $upres=@ftp_get($this->con,$fpath,$rname,FTP_BINARY);
			}
			else {
				return $upres=@ftp_get($this->con,$fpath,$rname,FTP_ASCII);
			}
		}
	}
	
	function UpDir($rdir,$ldir,$mode) {
		$data=$this->GetSimpleList($ldir);
		for($i=0;$data[$i]!=NULL;$i++) {
			$this->UpData($rdir,$data[$i],$ldir.$data[$i],$mode);
		}
	}
	
	function DownDir($rdir,$ldir,$mode) {
		$data=$this->GetSimpleList($rdir);
		for($i=0;$data[$i]!=NULL;$i++) {
			$this->DownData($rdir,$data[$i],$ldir.$data[$i],$mode);
		}
		return $data;
	}	
}
/*
?><meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php
*/
?>
