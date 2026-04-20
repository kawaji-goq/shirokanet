<?php
/* 
?>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-JP">
<?php 
*/ 
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */
// +----------------------------------------------------------------------+
// | PHP version 4                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2004 The PHP Group                                |
// +----------------------------------------------------------------------+
// | ライセンス説明                                                       |
// | ......                                                               |
// +----------------------------------------------------------------------+
// | Authors: Yusaku <yusaku@itcube.jp>       　　　　　　　　　　　　　　|
// +----------------------------------------------------------------------+
//
// $Id:$
//
// このソースファイルの説明

class Ab_RealEstate extends Ab_BasicType{
	
	var $dbobj;
	var $type;
	var $bunrui;
	var $numrows;
	
	function GetReList($bunrui,$sort) {
		$db=$this->dbobj;
		
		if($bunrui==NULL) {
			$bunrui=1;
		}
		
		if($sort==NULL) {
			$sort="tourokubi desc ,id desc";
		}
		else {
			$sort.=",id";
		}
		if($_GET["lim"]!=NULL) {
			$_SESSION["lim"]=$_GET["lim"];
		}
		else if($_SESSION["lim"]==NULL){
			$_SESSION["lim"]=10;
		}
		if($_GET["page"]!=NULL) {
			$_SESSION["page"]=$_GET["page"];
		}
		else if($_SESSION["page"]==NULL) {
			$_SESSION["page"]=1;
		}
		
		//$wheretxt;
		if($_SESSION["keyword"]!=NULL) {
			$whereary[]="keyword like '%".$_SESSION["keyword"]."%'"; 
		}
		
		//$wheretxt;
		
		if($_SESSION["madori"]!=NULL&&$_SESSION["madori"]!=0&&$_SESSION["madori"]<4) {
			$whereary[]="madori = ".$_SESSION["madori"]."";
		}
		else if($_SESSION["madori"]==4){
			$whereary[]="madori >= 4";
		}
		
		if($_SESSION["hicost"]!=NULL&&$_SESSION["hicost"]!=0) {
			$whereary[]="kakaku <= ".$_SESSION["hicost"]."";
		}
		
		if($_SESSION["lowcost"]!=NULL&&$_SESSION["lowcost"]!=0) {
			$whereary[]="kakaku >= ".$_SESSION["lowcost"]."";
		}
			
			if($_SESSION["chiiki"]!=NULL) {
$cdata=$db->GetList("select * from re_area_master where area_id=".$_SESSION["chiiki"]."");
for($i=0;$cdata[$i]["area_id"];$i++) {
		global $usedb;
		if($usedb=="mysql"){
		$cwhereary[]="(concat(jyusyo1,jyusyo2) like '%".$cdata[$i]["address1"].$cdata[$i]["address2"]."%')";;
		
		//		echo $_SESSION["DomainData"]["dbtype"];
		}
		else{
		$cwhereary[]="( (jyusyo1 || jyusyo2) like '%".$cdata[$i]["address1"].$cdata[$i]["address2"]."%')";
		}
		}
	
		$whereary[]="(".implode(" or ",$cwhereary).")";
		}
		
		if($_SESSION["nophoto"]==1) {
		$whereary[]="(photo1 is null or photo1='')";
		}
		
		if($whereary[0]!=NULL) {
			$wheretxt=" and ".implode(" and ",$whereary);
		}
		
		switch($this->type) {
			case "1":
				$sql="select * from bukken where bunrui = ".$bunrui." and (syumoku like '%アパート%' or syumoku like '%マンション%') ".$wheretxt." and del_chk <>1 order by ".$sort;
				$res=$db->Query($sql);
				$this->numrows=$db->NumRows($res);
				$sql.=$db->CreateLimitSql("",$_SESSION["lim"],$_SESSION["lim"]*($_SESSION["page"]-1));
				$rdata=$db->GetList($sql);
				return $rdata;
				break;
			case 2:
				$sql="select * from bukken where bunrui =  ".$bunrui." and (syumoku like '%貸家%' or syumoku like '%テラスハウス%' or syumoku like '%タウンハウス%' or syumoku like '%間借り%') and del_chk <>1 ".$wheretxt." order by ".$sort;
				$res=$db->Query($sql);
				$this->numrows=$db->NumRows($res);
				$sql.=$db->CreateLimitSql("",$_SESSION["lim"],$_SESSION["lim"]*($_SESSION["page"]-1));
				$rdata=$db->GetList($sql);

				return $rdata;
				break;
			case 3:
				$sql="select * from bukken where bunrui =  ".$bunrui." and (syumoku like '%事務所%' or syumoku like '%店舗%' or syumoku like '%工場%' or syumoku like '%倉庫%' or syumoku like '%旅館%' or syumoku like '%寮%' or syumoku like '%別荘%' or syumoku like '%土地%' or syumoku like '%ビル%' or syumoku like '%その他%') ".$wheretxt." and del_chk <>1 order by ".$sort;
				$res=$db->Query($sql);
				$this->numrows=$db->NumRows($res);
				$sql.=$db->CreateLimitSql("",$_SESSION["lim"],$_SESSION["lim"]*($_SESSION["page"]-1));
				$rdata=$db->GetList($sql);

				return $rdata;
				break;
				
			case 4:
				$sql="select * from bukken where bunrui =  ".$bunrui." and (syumoku like '%新築一戸建%' or syumoku like '%中古一戸建%' or syumoku like '%新築テラスハウス%' or syumoku like '中古テラスハウス' or syumoku like '%新築マンション%' or syumoku like '%中古マンション%' or syumoku like '%新築公団住宅%' or syumoku like '%中古公団住宅%' or syumoku like '%新築公社住宅%' or syumoku like '%中古公社住宅%' or syumoku like '%新築タウンハウス%' or syumoku like '%中古タウンハウス%' or syumoku like 'リゾートマンション%') and del_chk <>1 ".$wheretxt." order by ".$sort;
				$res=$db->Query($sql);
				$this->numrows=$db->NumRows($res);
				$sql.=$db->CreateLimitSql("",$_SESSION["lim"],$_SESSION["lim"]*($_SESSION["page"]-1));;
				$rdata=$db->GetList($sql);

				return $rdata;
				break;
				
			case 5:
				$sql="select * from bukken where bunrui =  ".$bunrui." and (syumoku like '%借地権譲渡%' or syumoku like '売地%') and del_chk <>1 ".$wheretxt." order by ".$sort;
				$res=$db->Query($sql);
				$this->numrows=$db->NumRows($res);
				$sql.=$db->CreateLimitSql("",$_SESSION["lim"],$_SESSION["lim"]*($_SESSION["page"]-1));;
				$rdata=$db->GetList($sql);
				return $rdata;
				break;
				
			case 6:
				$sql="select * from bukken where bunrui =  ".$bunrui." and (syumoku like '%店舗付住宅%' or syumoku like '%住宅付店舗%' or syumoku like '%事務所%' or syumoku like '%店舗事務所%' or syumoku like '%ビル%' or syumoku like '%工場%' or syumoku like '%倉庫%' or syumoku like '%寮%' or syumoku like '%旅館%' or syumoku like '%ホテル%' or syumoku like '%別荘%' or syumoku like '%リゾートマンション%' or syumoku like '%その他%' or syumoku like '%店舗%' or syumoku like '%事務所%' or syumoku like '%店舗・事務所%' or syumoku like '%その他%') and del_chk <>1 ".$wheretxt." order by ".$sort;
				$res=$db->Query($sql);
				$this->numrows=$db->NumRows($res);
				$sql.=$db->CreateLimitSql("",$_SESSION["lim"],$_SESSION["lim"]*($_SESSION["page"]-1));;
				$rdata=$db->GetList($sql);
				return $rdata;
				break;
			default:
				$sql="select * from bukken bunrui =  ".$bunrui." ".$wheretxt." and del_chk <>1 order by ".$sort;
				$res=$db->Query($sql);
				$this->numrows=$db->NumRows($res);
				$sql.=$db->CreateLimitSql("",$_SESSION["lim"],$_SESSION["lim"]*($_SESSION["page"]-1));;
				$rdata=$db->GetList($sql);
				return $rdata;
			break;
		}
		
		}	
		function GetReData($bukkenid) {
			if($bukkenid!=NULL) {
				$sql="select * from bukken where id='".$bukkenid."' and del_chk <>1";
				return $this->dbobj->GetData($sql);
			}
		}
}

class RealEstate extends Ab_RealEstate{
	
}

class Ad_RealEstate extends Ab_RealEstate{
		function GetReList($bunrui,$sort) {
			$db=$this->dbobj;
			
			if($bunrui==NULL) {
				$bunrui=1;
			}
			
			if($sort==NULL) {
				$sort="tourokubi desc ,id desc";
			}
			else {
				$sort.=", id";
			}
			if($_GET["lim"]!=NULL) {
				$_SESSION["lim"]=$_GET["lim"];
			}
			else if($_SESSION["lim"]==NULL){
				$_SESSION["lim"]=10;
			}
			if($_GET["page"]!=NULL) {
				$_SESSION["page"]=$_GET["page"];
			}
			else if($_SESSION["page"]==NULL) {
				$_SESSION["page"]=1;
			}
			
			//$wheretxt;
			if($_SESSION["keyword"]!=NULL) {
				$whereary[]="keyword like '%".$_SESSION["keyword"]."%'"; 
			}
			
			if($_SESSION["madori"]!=NULL&&$_SESSION["madori"]!=0&&$_SESSION["madori"]<4) {
				$whereary[]="madori = ".$_SESSION["madori"]."";
			}
			else if($_SESSION["madori"]==4){
				$whereary[]="madori >= 4";
			}
			
			if($_SESSION["hicost"]!=NULL&&$_SESSION["hicost"]!=0) {
				$whereary[]="kakaku <= ".$_SESSION["hicost"]."";
			}
			
			if($_SESSION["lowcost"]!=NULL&&$_SESSION["lowcost"]!=0) {
				$whereary[]="kakaku >= ".$_SESSION["lowcost"]."";
			}
		//$wheretxt;
		if($_SESSION["vchk"]!=NULL) {
			$whereary[]="del_chk = ".$_SESSION["vchk"].""; 
		}
			if($_SESSION["chiiki"]!=NULL) {
			$cdata=$db->GetList("select * from re_area_master where area_id=".$_SESSION["chiiki"]."");
				//echo $_SERVER['HTTP_HOST'];
for($i=0;$cdata[$i]["area_id"];$i++) {
		if($_SESSION["DomainData"]["dbtype"]=="mysql"){
		$cwhereary[]="(concat(jyusyo1,jyusyo2) like '%".$cdata[$i]["address1"].$cdata[$i]["address2"]."%')";;
		
		//		echo $_SESSION["DomainData"]["dbtype"];
		}
		else{
		$cwhereary[]="( (jyusyo1 || jyusyo2) like '%".$cdata[$i]["address1"].$cdata[$i]["address2"]."%')";
		}
		}
				$whereary[]="(".implode(" or ",$cwhereary).")";
			}
			
			switch($_SESSION["nophoto"]) {
				case 1:
					$whereary[]="(photo1 is null or photo1='')";
					break;
				case 2:
					$whereary[]=" photo1 is not  null";
					break;
			}
						
			if($whereary[0]!=NULL) {
				$wheretxt=" and ".implode(" and ",$whereary);
			}
			
			switch($this->type) {
				case "1":
					$sql="select * from bukken where bunrui = ".$bunrui." and (syumoku like '%アパート%' or syumoku like '%マンション%') ".$wheretxt." order by ".$sort;
					$res=$db->Query($sql);
					$this->numrows=$db->NumRows($res);
					$sql.=$db->CreateLimitSql("",$_SESSION["lim"],$_SESSION["lim"]*($_SESSION["page"]-1));
					$rdata=$db->GetList($sql);
					return $rdata;
					break;
				case 2:
					$sql="select * from bukken where bunrui =  ".$bunrui." and (syumoku like '%貸家%' or syumoku like '%テラスハウス%' or syumoku like '%タウンハウス%' or syumoku like '%間借り%') ".$wheretxt." order by ".$sort;
					$res=$db->Query($sql);
					$this->numrows=$db->NumRows($res);
					$sql.=$db->CreateLimitSql("",$_SESSION["lim"],$_SESSION["lim"]*($_SESSION["page"]-1));
					$rdata=$db->GetList($sql);
	
					return $rdata;
					break;
					
				case 3:
					$sql="select * from bukken where bunrui =  ".$bunrui." and (syumoku like '%事務所%' or syumoku like '%店舗%' or syumoku like '%工場%' or syumoku like '%倉庫%' or syumoku like '%旅館%' or syumoku like '%寮%' or syumoku like '%別荘%' or syumoku like '%土地%' or syumoku like '%ビル%' or syumoku like '%その他%') ".$wheretxt." order by ".$sort;
					$res=$db->Query($sql);
					$this->numrows=$db->NumRows($res);
					$sql.=$db->CreateLimitSql("",$_SESSION["lim"],$_SESSION["lim"]*($_SESSION["page"]-1));
					$rdata=$db->GetList($sql);
	
					return $rdata;
					break;
					
				case 4:
					$sql="select * from bukken where bunrui =  ".$bunrui." and (syumoku like '%新築一戸建%' or syumoku like '%中古一戸建%' or syumoku like '%新築テラスハウス%' or syumoku like '中古テラスハウス' or syumoku like '%新築マンション%' or syumoku like '%中古マンション%' or syumoku like '%新築公団住宅%' or syumoku like '%中古公団住宅%' or syumoku like '%新築公社住宅%' or syumoku like '%中古公社住宅%' or syumoku like '%新築タウンハウス%' or syumoku like '%中古タウンハウス%' or syumoku like 'リゾートマンション%') ".$wheretxt." order by ".$sort;
					$res=$db->Query($sql);
					$this->numrows=$db->NumRows($res);
					$sql.=$db->CreateLimitSql("",$_SESSION["lim"],$_SESSION["lim"]*($_SESSION["page"]-1));
					$rdata=$db->GetList($sql);
	
					return $rdata;
					break;
					
				case 5:
					$sql="select * from bukken where bunrui =  ".$bunrui." and (syumoku like '%借地権譲渡%' or syumoku like '売地%') ".$wheretxt." order by ".$sort;
					$res=$db->Query($sql);
					$this->numrows=$db->NumRows($res);
					$sql.=$db->CreateLimitSql("",$_SESSION["lim"],$_SESSION["lim"]*($_SESSION["page"]-1));
					$rdata=$db->GetList($sql);
					return $rdata;
					break;
					
				case 6:
					$sql="select * from bukken where bunrui =  ".$bunrui." and (syumoku like '%店舗%' or syumoku like '%店舗付住宅%' or syumoku like '%住宅付店舗%' or syumoku like '%事務所%' or syumoku like '%店舗事務所%' or syumoku like '%ビル%' or syumoku like '%工場%'  or syumoku like '%倉庫%' or syumoku like '%寮%' or syumoku like '%旅館%' or syumoku like '%ホテル%' or syumoku like '%別荘%' or syumoku like '%リゾートマンション%' or syumoku like '%その他%' or syumoku like '%店舗%' or syumoku like '%事務所%' or syumoku like '%店舗・事務所%' or syumoku like '%その他%') ".$wheretxt." order by ".$sort;
					$res=$db->Query($sql);
					$this->numrows=$db->NumRows($res);
					$sql.=$db->CreateLimitSql("",$_SESSION["lim"],$_SESSION["lim"]*($_SESSION["page"]-1));
					$rdata=$db->GetList($sql);
					return $rdata;
					break;
					
				default:
					$sql="select * from bukken bunrui =  ".$bunrui." ".$wheretxt." order by ".$sort;
					$res=$db->Query($sql);
					$this->numrows=$db->NumRows($res);
					$sql.=$db->CreateLimitSql("",$_SESSION["lim"],$_SESSION["lim"]*($_SESSION["page"]-1));
					$rdata=$db->GetList($sql);
					return $rdata;
				break;
			}
	}
	
	function GetReData($bukkenid) {
		if($bukkenid!=NULL) {
			$sql="select * from bukken where id='".$bukkenid."'";
			return $this->dbobj->GetData($sql);
		}
	}
	
}

class Keitai_RealEstate extends Ab_RealEstate{
	
	function GetReList($bunrui,$sort) {
		$db=$this->dbobj;
		
		if($bunrui==NULL) {
			$bunrui=1;
		}
		
		if($sort==NULL) {
			$sort="tourokubi desc ,id desc";
		}
		
		if($_GET["lim"]!=NULL) {
			$_REQUEST["lim"]=$_GET["lim"];
		}
		else {
			$_REQUEST["lim"]=5;
		}
		if($_GET["page"]!=NULL) {
			$_REQUEST["page"]=$_GET["page"];
		}
		else if($_REQUEST["page"]==NULL) {
			$_REQUEST["page"]=1;
		}
		
		//$wheretxt;
		if($_REQUEST["keyword"]!=NULL) {
			$whereary[]="keyword like '%".$_REQUEST["keyword"]."%'"; 
		}
		
		if($_REQUEST["madori"]!=NULL&&$_REQUEST["madori"]!=0&&$_REQUEST["madori"]<4) {
			$whereary[]="madori = ".$_REQUEST["madori"]."";
		}
		else if($_REQUEST["madori"]==4){
			$whereary[]="madori >= 4";
		}
		
		if($_REQUEST["hicost"]!=NULL&&$_REQUEST["hicost"]!=0) {
			$whereary[]="kakaku <= ".$_REQUEST["hicost"]."";
		}
		
		if($_REQUEST["lowcost"]!=NULL&&$_REQUEST["lowcost"]!=0) {
			$whereary[]="kakaku >= ".$_REQUEST["lowcost"]."";
		}
	/*	
		switch(mb_convert_encoding($_REQUEST["chiiki"],"eucjp")) {
				case "岩国市麻里布":
					$whereary[]="jyusyo1 = '岩国市' and jyusyo2 like '%麻里布%'";
					break;	
				case "岩国市川下":
					$whereary[]="jyusyo1 = '岩国市' and jyusyo2 like '%川下%'";
					break;	
				case "岩国市平田":
					$whereary[]="jyusyo1 = '岩国市' and jyusyo2 like '%平田%'";
					break;	
				case "岩国市南岩国":
					$whereary[]="jyusyo1 = '岩国市' and jyusyo2 like '%南岩国%'";
					break;	
				case "岩国市岩国":
					$whereary[]="jyusyo1 = '岩国市' and jyusyo2 like '%岩国%'";
				break;	
				case "岩国市通津":
					$whereary[]="jyusyo1 = '岩国市' and jyusyo2 like '%通津%'";
				break;	
				case "岩国市その他":
					$whereary[]="(jyusyo1 = '岩国市') and (jyusyo2 not like '%麻里布%' and jyusyo2 not like '%川下%' and  jyusyo2 not like '%平田%' and jyusyo2 not like '%南岩国%' and jyusyo2 not like '%岩国%' and jyusyo2 not like '%通津%')";
				break;	
				case "柳井市":
					$whereary[]="jyusyo1 = '柳井市'";
				break;
				case "玖珂郡和木町":
					$whereary[]="jyusyo1 like '%和木町%'";
				break;
				case "大竹市":
					$whereary[]="jyusyo1 = '大竹市'";
				break;
		}
		*/
		if($_REQUEST["chiiki"]!=NULL) {
		$cdata=$db->GetList("select * from re_area_master where area_id=".$_REQUEST["chiiki"]."");
for($i=0;$cdata[$i]["area_id"];$i++) {
global $usedb;
		if($usedb=="mysql"){
		$cwhereary[]="(concat(jyusyo1,jyusyo2) like '%".$cdata[$i]["address1"].$cdata[$i]["address2"]."%')";;
		
		//		echo $_SESSION["DomainData"]["dbtype"];
		}
		else{
		$cwhereary[]="( (jyusyo1 || jyusyo2) like '%".$cdata[$i]["address1"].$cdata[$i]["address2"]."%')";
		}
		
	}
			if($cwhereary[0]!=NULL) {
$whereary[]="(".implode(" or ",$cwhereary).")";
			}
		}
					
		if($whereary[0]!=NULL) {
			$wheretxt=" and ".implode(" and ",$whereary);
		}
		
		switch($this->type) {
			case "1":
				$sql="select * from bukken where bunrui = ".$bunrui." and (syumoku like '%アパート%' or syumoku like '%マンション%') ".$wheretxt." and del_chk <>1 order by ".$sort;
				$res=$db->Query($sql);
				$this->numrows=$db->NumRows($res);
				$sql.=$db->CreateLimitSql("",5,5*($_REQUEST["page"]-1));
				$rdata=$db->GetList($sql);
				return $rdata;
				break;
			case 2:
				$sql="select * from bukken where bunrui =  ".$bunrui." and (syumoku like '%貸家%' or syumoku like '%テラスハウス%' or syumoku like '%タウンハウス%' or syumoku like '%間借り%') and del_chk <>1 ".$wheretxt." order by ".$sort;
				$res=$db->Query($sql);
				$this->numrows=$db->NumRows($res);
				$sql.=$db->CreateLimitSql("",5,5*($_REQUEST["page"]-1));
				$rdata=$db->GetList($sql);

				return $rdata;
				break;
			case 3:
				$sql="select * from bukken where bunrui =  ".$bunrui." and (syumoku like '%事務所%' or syumoku like '%店舗%' or syumoku like '%工場%' or syumoku like '%倉庫%' or syumoku like '%旅館%' or syumoku like '%寮%' or syumoku like '%別荘%' or syumoku like '%土地%' or syumoku like '%ビル%' or syumoku like '%その他%') ".$wheretxt." and del_chk <>1 order by ".$sort;
				$res=$db->Query($sql);
				$this->numrows=$db->NumRows($res);
				$sql.=$db->CreateLimitSql("",5,5*($_REQUEST["page"]-1));
				$rdata=$db->GetList($sql);

				return $rdata;
				break;
				
			case 4:
				$sql="select * from bukken where bunrui =  ".$bunrui." and (syumoku like '%新築一戸建%' or syumoku like '%中古一戸建%' or syumoku like '%新築テラスハウス%' or syumoku like '中古テラスハウス' or syumoku like '%新築マンション%' or syumoku like '%中古マンション%' or syumoku like '%新築公団住宅%' or syumoku like '%中古公団住宅%' or syumoku like '%新築公社住宅%' or syumoku like '%中古公社住宅%' or syumoku like '%新築タウンハウス%' or syumoku like '%中古タウンハウス%' or syumoku like 'リゾートマンション%') and del_chk <>1 ".$wheretxt." order by ".$sort;
				$res=$db->Query($sql);
				$this->numrows=$db->NumRows($res);
				$sql.=$db->CreateLimitSql("",5,5*($_REQUEST["page"]-1));
				$rdata=$db->GetList($sql);

				return $rdata;
				break;
				
			case 5:
				$sql="select * from bukken where bunrui =  ".$bunrui." and (syumoku like '%借地権譲渡%' or syumoku like '売地%') and del_chk <>1 ".$wheretxt." order by ".$sort;
				$res=$db->Query($sql);
				$this->numrows=$db->NumRows($res);
				$sql.=$db->CreateLimitSql("",5,5*($_REQUEST["page"]-1));
				$rdata=$db->GetList($sql);
				return $rdata;
				break;
				
			case 6:
				$sql="select * from bukken where bunrui =  ".$bunrui." and (syumoku like '%店舗%' or syumoku like '%店舗付住宅%' or syumoku like '%住宅付店舗%' or syumoku like '%事務所%' or syumoku like '%店舗事務所%' or syumoku like '%ビル%' or syumoku like '%工場%' or syumoku like '%倉庫%' or syumoku like '%寮%' or syumoku like '%旅館%' or syumoku like '%ホテル%' or syumoku like '%別荘%' or syumoku like '%リゾートマンション%' or syumoku like '%その他%' or syumoku like '%店舗%' or syumoku like '%事務所%' or syumoku like '%店舗・事務所%' or syumoku like '%その他%') and del_chk <>1 ".$wheretxt." order by ".$sort;
				$res=$db->Query($sql);
				$this->numrows=$db->NumRows($res);
				$sql.=$db->CreateLimitSql("",5,5*($_REQUEST["page"]-1));
				$rdata=$db->GetList($sql);

				return $rdata;
				break;
				
			default:
				$sql="select * from bukken bunrui =  ".$bunrui." ".$wheretxt." and del_chk <>1 order by ".$sort;
				$res=$db->Query($sql);
				$this->numrows=$db->NumRows($res);
				$sql.=$db->CreateLimitSql("",$_SESSION["lim"],$_SESSION["lim"]*($_SESSION["page"]-1));
				$rdata=$db->GetList($sql);

				return $rdata;
			break;
			
		}
		
	}
	
	function GetReData($bukkenid) {
		if($bukkenid!=NULL) {
			$sql="select * from bukken where id='".$bukkenid."' and del_chk <>1";
			return $this->dbobj->GetData($sql);
		}
	}
}

class CreateSql {
	var $wheretxt;
	var $wherechk;
	function CreateSql($wheretxt,$wherechk) {
		$this->wheretxt=$wheretxt;
		$this->wherechk=$wherechk;
	}
	
	function GetSql() {
		return $this->wheretxt;
	}
	function GetCheckData() {
		return $this->wherechk;
	}
	function Madori($_madori_low,$_madori_hi) {
		$wheretxt=$this->wheretxt;
		$wherechk=$this->wherechk;
		if($_madori_low!=""||$_madori_hi!="") {
			$wheretxt.="(";
			switch($_madori_low) {
				case "":
					$wheretxt.="( madori >= 1";
					switch($_madori_hi) {
						case "1R":
							$wheretxt.=" and madori <= 1)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R') ";
							$wherechk=1;
							break;
						case "1K":
							$wheretxt.=" and  madori <= 1)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K') ";
							$wherechk=1;
							break;
						case "1LK":
							$wheretxt.=" and  madori <= 1)";
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK') ";
							$wherechk=1;
							break;
						case "1DK":
							$wheretxt.=" and  madori <= 1)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK') ";
							$wherechk=1;
							break;
						case "1LDK":
							$wheretxt.=" and  madori <= 1)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK') ";
							$wherechk=1;
							break;
						case "2K":
							$wheretxt.=" and madori <= 1)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK') ";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K'))";
							$wherechk=1;
							break;
						case "2DK":
							$wheretxt.=" and  madori <= 1)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK') ";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK'))";
							$wherechk=1;
							break;
						case "2LK":
							$wheretxt.=" and  madori <= 1)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK') ";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK'))";
							$wherechk=1;
							break;
						case "2LDK":
							$wheretxt.=" madori <= 1)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK') ";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wherechk=1;
							break;
						case "3DK":
							$wheretxt.=" and  madori <= 2)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK') ";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK' or madori_unit = 'DK'))";
							$wherechk=1;
							break;
						case "3LK":
							$wheretxt.=" and  madori <= 2)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK') ";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK'))";
							$wherechk=1;
							break;
						case "3LDK":
							$wheretxt.=" and  madori <= 2)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK') ";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wherechk=1;
							break;
						case "4DK":
							$wheretxt.=" and  madori <= 3)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK') ";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK' or madori_unit = 'DK'))";
							$wherechk=1;
							break;
						case "4LK":
							$wheretxt.=" and  madori <= 3)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK') ";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK'))";
							$wherechk=1;
							break;
						case "4LDK":
							$wheretxt.=" and  madori <= 3)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK') ";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wherechk=1;
							break;
						case "上限なし":
							$wheretxt.=")";
							$wherechk=1;
							break;
						default:
							$wheretxt.=")";
							$wherechk=1;
							break;
					}
					$wherechk=1;
					break;
				case "1K":
					$wheretxt.="( madori = 1";
					switch($_madori_hi) {
						case "1K":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'K') ";
							break;
						case "1LK":
							$wheretxt.=" and  madori <= 1)";
							$wheretxt.=" and (madori_unit = 'K' or madori_unit = 'LK') ";
							break;
						case "1DK":
							$wheretxt.=" and  madori <= 1)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK') ";
							break;
						case "1LDK":
							$wheretxt.=" and  madori <= 1)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK') ";
							break;
						case "2K":
							$wheretxt.=" ";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K'))";
							break;
						case "2DK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')) ";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK'))";
							break;
						case "2LK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')) ";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK'))";
							break;
						case "2LDK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')) ";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						case "3DK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK' or madori_unit = 'DK'))";
							break;
						case "3LK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK'))";
							break;
						case "3LDK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						case "4DK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori>1 and madori <= 3) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK' or madori_unit = 'DK'))";
							break;
						case "4LK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori>1 and madori <= 3) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK'))";
							break;
						case "4LDK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori>1 and madori <= 3) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						case "上限なし":
							$wheretxt.=") or ((madori >1) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						default:
							$wheretxt.=")";
							break;
					}
					$wherechk=1;
					break;
				case "1LK":
					$wheretxt.="( madori = 1";
					switch($_madori_hi) {
						case "1LK":
							$wheretxt.=" and  madori <= 1)";
							$wheretxt.=" and (madori_unit = 'LK') ";
							break;
						case "1DK":
							$wheretxt.=" and  madori <= 1)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK') ";
							break;
						case "1LDK":
							$wheretxt.=" and  madori <= 1)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK') ";
							break;
						case "2K":
							$wheretxt.=" ";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K'))";
							break;
						case "2DK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')) ";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK'))";
							break;
						case "2LK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')) ";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK'))";
							break;
						case "2LDK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')) ";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						case "3DK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK' or madori_unit = 'DK'))";
							break;
						case "3LK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK'))";
							break;
						case "3LDK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						case "4DK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori>1 and madori <= 3) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK' or madori_unit = 'DK'))";
							break;
						case "4LK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori>1 and madori <= 3) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK'))";
							break;
						case "4LDK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori>1 and madori <= 3) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						case "上限なし":
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori >1) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						default:
							$wheretxt.=")";
							break;
					}
					$wherechk=1;
					break;
				case "1R":
					$wheretxt.="( madori >= 1";
					switch($_madori_hi) {
						case "1R":
							$wheretxt.=" and madori <= 1)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R') ";
							$wherechk=1;
							break;
						case "1K":
							$wheretxt.=" and  madori <= 1)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K') ";
							$wherechk=1;
							break;
						case "1LK":
							$wheretxt.=" and  madori <= 1)";
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK') ";
							$wherechk=1;
							break;
						case "1DK":
							$wheretxt.=" and  madori <= 1)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK') ";
							$wherechk=1;
							break;
						case "1LDK":
							$wheretxt.=" and  madori <= 1)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK') ";
							$wherechk=1;
							break;
						case "2K":
							$wheretxt.=" and madori <= 1)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK') ";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K'))";
							$wherechk=1;
							break;
						case "2DK":
							$wheretxt.=" and  madori <= 1)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK') ";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK'))";
							$wherechk=1;
							break;
						case "2LK":
							$wheretxt.=" and  madori <= 1)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK') ";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK'))";
							$wherechk=1;
							break;
						case "2LDK":
							$wheretxt.=" madori <= 1)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK') ";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wherechk=1;
							break;
						case "3DK":
							$wheretxt.=" and  madori <= 2)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK') ";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK' or madori_unit = 'DK'))";
							$wherechk=1;
							break;
						case "3LK":
							$wheretxt.=" and  madori <= 2)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK') ";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK'))";
							$wherechk=1;
							break;
						case "3LDK":
							$wheretxt.=" and  madori <= 2)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK') ";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wherechk=1;
							break;
						case "4DK":
							$wheretxt.=" and  madori <= 3)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK') ";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK' or madori_unit = 'DK'))";
							$wherechk=1;
							break;
						case "4LK":
							$wheretxt.=" and  madori <= 3)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK') ";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK'))";
							$wherechk=1;
							break;
						case "4LDK":
							$wheretxt.=" and  madori <= 3)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK') ";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wherechk=1;
							break;
						case "上限なし":
							$wheretxt.=")";
							$wherechk=1;
							break;
						default:
							$wheretxt.=")";
							$wherechk=1;
							break;
					}
					$wherechk=1;
					break;
				case "1K":
					$wheretxt.="( madori = 1";
					switch($_madori_hi) {
						case "1K":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'K') ";
							break;
						case "1LK":
							$wheretxt.=" and  madori <= 1)";
							$wheretxt.=" and (madori_unit = 'K' or madori_unit = 'LK') ";
							break;
						case "1DK":
							$wheretxt.=" and  madori <= 1)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK') ";
							break;
						case "1LDK":
							$wheretxt.=" and  madori <= 1)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK') ";
							break;
						case "2K":
							$wheretxt.=" ";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K'))";
							break;
						case "2DK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')) ";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK'))";
							break;
						case "2LK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')) ";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK'))";
							break;
						case "2LDK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')) ";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						case "3DK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK' or madori_unit = 'DK'))";
							break;
						case "3LK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK'))";
							break;
						case "3LDK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						case "4DK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori>1 and madori <= 3) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK' or madori_unit = 'DK'))";
							break;
						case "4LK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori>1 and madori <= 3) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK'))";
							break;
						case "4LDK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori>1 and madori <= 3) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						case "上限なし":
							$wheretxt.=") or ((madori >1) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						default:
							$wheretxt.=")";
							break;
					}
					$wherechk=1;
					break;
				case "1LK":
					$wheretxt.="( madori = 1";
					switch($_madori_hi) {
						case "1LK":
							$wheretxt.=" and  madori <= 1)";
							$wheretxt.=" and (madori_unit = 'LK') ";
							break;
						case "1DK":
							$wheretxt.=" and  madori <= 1)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK') ";
							break;
						case "1LDK":
							$wheretxt.=" and  madori <= 1)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK') ";
							break;
						case "2K":
							$wheretxt.=" ";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K'))";
							break;
						case "2DK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')) ";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK'))";
							break;
						case "2LK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')) ";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK'))";
							break;
						case "2LDK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')) ";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						case "3DK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK' or madori_unit = 'DK'))";
							break;
						case "3LK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK'))";
							break;
						case "3LDK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						case "4DK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori>1 and madori <= 3) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK' or madori_unit = 'DK'))";
							break;
						case "4LK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori>1 and madori <= 3) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK'))";
							break;
						case "4LDK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori>1 and madori <= 3) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						case "上限なし":
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori >1) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						default:
							$wheretxt.=")";
							break;
					}
					$wherechk=1;
					break;
				case "1DK":
					$wheretxt.="( madori = 1";
					switch($_madori_hi) {
						case "1DK":
							$wheretxt.=" and  madori <= 1)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'DK') ";
							break;
						case "1LDK":
							$wheretxt.=" and  madori <= 1)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'DK' or madori_unit = 'LDK') ";
							break;
						case "2K":
							$wheretxt.=" and (madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K'))";
							break;
						case "2DK":
							$wheretxt.=" and (madori_unit = 'DK' or madori_unit = 'LDK')) ";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK'))";
							break;
						case "2LK":
							$wheretxt.=" and (madori_unit = 'DK' or madori_unit = 'LDK')) ";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK'))";
							break;
						case "2LDK":
							$wheretxt.=" and (madori_unit = 'DK' or madori_unit = 'LDK')) ";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						case "3DK":
							$wheretxt.=" and (madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK' or madori_unit = 'DK'))";
							break;
						case "3LK":
							$wheretxt.=" and (madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK'))";
							break;
						case "3LDK":
							$wheretxt.=" and (madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						case "4DK":
							$wheretxt.=" and (madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori>1 and madori <= 3) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK' or madori_unit = 'DK'))";
							break;
						case "4LK":
							$wheretxt.=" and (madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori>1 and madori <= 3) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK'))";
							break;
						case "4LDK":
							$wheretxt.=" and (madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori>1 and madori <= 3) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						case "上限なし":
							$wheretxt.=" and (madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori >1) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						default:
							$wheretxt.=")";
							break;
					}
					$wherechk=1;
					break;
				case "1LDK":
					$wheretxt.="( madori = 1";
					switch($_madori_hi) {
						case "1LDK":
							$wheretxt.=" and  madori <= 1)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'LDK') ";
							break;
						case "2K":
							$wheretxt.=" and (madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K'))";
							break;
						case "2DK":
							$wheretxt.=" and (madori_unit = 'LDK')) ";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK'))";
							break;
						case "2LK":
							$wheretxt.=" and (madori_unit = 'LDK')) ";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK'))";
							break;
						case "2LDK":
							$wheretxt.=" and (madori_unit = 'LDK')) ";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						case "3DK":
							$wheretxt.=" and (madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK' or madori_unit = 'DK'))";
							break;
						case "3LK":
							$wheretxt.=" and (madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK'))";
							break;
						case "3LDK":
							$wheretxt.=" and (madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						case "4DK":
							$wheretxt.=" and (madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori>1 and madori <= 3) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK' or madori_unit = 'DK'))";
							break;
						case "4LK":
							$wheretxt.=" and (madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori>1 and madori <= 3) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK'))";
							break;
						case "4LDK":
							$wheretxt.=" and (madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori>1 and madori <= 3) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						case "上限なし":
							$wheretxt.=" and (madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori >1) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						default:
							$wheretxt.=")";
							break;
					}
					$wherechk=1;
					break;
				case "2K":
					$wheretxt.="( madori = 2";
					switch($_madori_hi) {
						case "2K":
							$wheretxt.=" ";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'K'))";
							break;
						case "2DK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK')) ";
							break;
						case "2LK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'K' or madori_unit = 'LK')) ";
							break;
						case "2LDK":
							$wheretxt.=" and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')) ";
							break;
						case "3DK":
							$wheretxt.=" and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK' or madori_unit = 'DK'))";
							break;
						case "3LK":
							$wheretxt.=" and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK'))";
							break;
						case "3LDK":
							$wheretxt.=" and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						case "4DK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori>2 and madori <= 3) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK' or madori_unit = 'DK'))";
							break;
						case "4LK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori>2 and madori <= 3) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK'))";
							break;
						case "4LDK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori>21 and madori <= 3) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						case "上限なし":
							$wheretxt.=" and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori >2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						default:
							$wheretxt.=" and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori >2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
					}
					$wherechk=1;
					break;
				case "2LK":
					$wheretxt.="( madori = 2";
					switch($_madori_hi) {
						case "2DK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK')) ";
							break;
						case "2LK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'LK')) ";
							break;
						case "2LDK":
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')) ";
							break;
						case "3DK":
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK' or madori_unit = 'DK'))";
							break;
						case "3LK":
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK'))";
							break;
						case "3LDK":
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						case "4DK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori>2 and madori <= 3) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK' or madori_unit = 'DK'))";
							break;
						case "4LK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori>2 and madori <= 3) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK'))";
							break;
						case "4LDK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori>21 and madori <= 3) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						case "上限なし":
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori >2))";
							break;
						default:
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori >2))";
							break;
					}
					$wherechk=1;
					break;
				case "2DK":
					$wheretxt.="( madori = 2";
					switch($_madori_hi) {
						case "2DK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'DK')) ";
							break;
						case "2LDK":
							$wheretxt.=" and (madori_unit = 'DK' or madori_unit = 'LDK')) ";
							break;
						case "3DK":
							$wheretxt.=" and (madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK' or madori_unit = 'DK'))";
							break;
						case "3LK":
							$wheretxt.=" and (madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK'))";
							break;
						case "3LDK":
							$wheretxt.=" and (madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						case "4DK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori>2 and madori <= 3) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK' or madori_unit = 'DK'))";
							break;
						case "4LK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori>2 and madori <= 3) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK'))";
							break;
						case "4LDK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori>21 and madori <= 3) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						case "上限なし":
							$wheretxt.=" and (madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori >2))";
							break;
						default:
							$wheretxt.=" and (madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori >2))";
							break;
					}
					$wherechk=1;
					break;
				case "2LDK":
					$wheretxt.="( madori = 2";
					switch($_madori_hi) {
						case "2LDK":
							$wheretxt.=" and (madori_unit = 'LDK')) ";
							break;
						case "3DK":
							$wheretxt.=" and (madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK' or madori_unit = 'DK'))";
							break;
						case "3LK":
							$wheretxt.=" and (madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK'))";
							break;
						case "3LDK":
							$wheretxt.=" and (madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						case "4DK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori>2 and madori <= 3) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK' or madori_unit = 'DK'))";
							break;
						case "4LK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori>2 and madori <= 3) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK'))";
							break;
						case "4LDK":
							$wheretxt.="";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori>21 and madori <= 3) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						case "上限なし":
							$wheretxt.=" and (madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori >2))";
							break;
						default:
							$wheretxt.=" and (madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori >2))";
							break;
					}
					$wherechk=1;
					break;
				case "3LK":
					$wheretxt.="( madori = 3";
					switch($_madori_hi) {
						case "3LK":
							$wheretxt.=" and (madori_unit = 'LK'))";
							break;
						case "3DK":
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK'))";
							break;
						case "3LDK":
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						case "4DK":
							$wheretxt.=" and (madori_unit = 'LK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK' or madori_unit = 'DK'))";
							break;
						case "4LK":
							$wheretxt.=" and (madori_unit = 'LK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK'))";
							break;
						case "4LDK":
							$wheretxt.=" and (madori_unit = 'LK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						case "上限なし":
							$wheretxt.=" and (madori_unit = 'LK')";
							$wheretxt.=" or ((madori >3))";
							break;
						default:
							$wheretxt.=" and (madori_unit = 'LK')";
							$wheretxt.=" or ((madori >3))";
							break;
					}
					$wherechk=1;
					break;
				case "3DK":
					$wheretxt.="( madori = 3";
					switch($_madori_hi) {
						case "3DK":
							$wheretxt.=" and (madori_unit = 'DK')) ";
							break;
						case "3LDK":
							$wheretxt.=" and (madori_unit = 'DK' or madori_unit = 'LDK')) ";
							break;
						case "4DK":
							$wheretxt.=" and (madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK' or madori_unit = 'DK'))";
							break;
						case "4LK":
							$wheretxt.=" and (madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK'))";
							break;
						case "4LDK":
							$wheretxt.=" and (madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						case "上限なし":
							$wheretxt.=" and (madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori >3))";
							break;
						default:
							$wheretxt.=" and (madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori >3))";
							break;
					}
					
					$wherechk=1;
					break;
				case "3LDK":
					$wheretxt.="( madori = 2";
					switch($_madori_hi) {
						case "3LDK":
							$wheretxt.=" and (madori_unit = 'LDK')) ";
							break;
						case "4DK":
							$wheretxt.=" and (madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK' or madori_unit = 'DK'))";
							break;
						case "4LK":
							$wheretxt.=" and (madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK'))";
							break;
						case "4LDK":
							$wheretxt.=" and (madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						case "上限なし":
							$wheretxt.=" and (madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori >3))";
							break;
						default:
							$wheretxt.=" and (madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori >3))";
							break;
					}
					$wherechk=1;
					break;
				case "4LK":
					$wheretxt.="( madori = 4";
					switch($_madori_hi) {
						case "4LK":
							$wheretxt.=" and (madori_unit = 'LK'))";
							break;
						case "4DK":
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK'))";
							break;
						case "4LDK":
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						case "上限なし":
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')";
							$wheretxt.=" or ((madori >3))";
							break;
						default:
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')";
							$wheretxt.=" or ((madori >3))";
							break;
					}
					$wherechk=1;
					break;
				case "4DK":
					$wheretxt.="( madori = 3";
					switch($_madori_hi) {
						case "4DK":
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK'))";
							break;
						case "4LDK":
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							break;
						case "上限なし":
							$wheretxt.=" and (madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori >4))";
							break;
						default:
							$wheretxt.=" and (madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori >4))";
							break;
					}
					$wherechk=1;
					break;
				case "4LDK":
						case "4LDK":
							$wheretxt.=" and (madori_unit = 'LDK')) ";
							break;
						case "上限なし":
							$wheretxt.=" and (madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori >4))";
							break;
						default:
							$wheretxt.=" and (madori_unit = 'LDK'))";
							$wheretxt.=" or ((madori >4))";
							break;
					$wherechk=1;
					break;
				case "5DK以上":
					$wheretxt.=" madori >=5";
					$wherechk=1;
					break;
				default:
					switch($_madori_hi) {
						case "1R":
							$wheretxt.="(";
							$wheretxt.=" madori <= 1)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R') ";
							$wherechk=1;
							break;
						case "1K":
							$wheretxt.="(";
							$wheretxt.=" madori <= 1)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K') ";
							$wherechk=1;
							break;
						case "1LK":
							$wheretxt.="(";
							$wheretxt.=" madori <= 1)";
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK') ";
							$wherechk=1;
							break;
						case "1DK":
							$wheretxt.="(";
							$wheretxt.=" madori <= 1)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK') ";
							$wherechk=1;
							break;
						case "1LDK":
							$wheretxt.="(";
							$wheretxt.=" madori <= 1)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK') ";
							$wherechk=1;
							break;
						case "2K":
							$wheretxt.="(";
							$wheretxt.=" (madori <= 1)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK') ";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K'))";
							$wherechk=1;
							break;
						case "2DK":
							$wheretxt.="(";
							$wheretxt.=" madori <= 1)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK') ";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK'))";
							$wherechk=1;
							break;
						case "2LK":
							$wheretxt.="(";
							$wheretxt.=" madori <= 1)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK') ";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK'))";
							$wherechk=1;
							break;
						case "2LDK":
							$wheretxt.="(";
							$wheretxt.=" madori <= 1)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK') ";
							$wheretxt.=" or ((madori = 2) and (madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wherechk=1;
							break;
						case "3DK":
							$wheretxt.="(";
							$wheretxt.=" madori <= 2)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK') ";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK' or madori_unit = 'DK'))";
							$wherechk=1;
							break;
						case "3LK":
							$wheretxt.="(";
							$wheretxt.=" madori <= 2)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK') ";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK'))";
							$wherechk=1;
							break;
						case "3LDK":
							$wheretxt.="(";
							$wheretxt.=" madori <= 2)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK') ";
							$wheretxt.=" or ((madori = 3) and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wherechk=1;
							break;
						case "4DK":
							$wheretxt.="(";
							$wheretxt.=" madori <= 3)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK') ";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK' or madori_unit = 'DK'))";
							$wherechk=1;
							break;
						case "4LK":
							$wheretxt.="(";
							$wheretxt.=" madori <= 3)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK') ";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK'))";
							$wherechk=1;
							break;
						case "4LDK":
							$wheretxt.="(";
							$wheretxt.=" madori <= 3)";//(madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK')
							$wheretxt.=" and (madori_unit = 'R' or madori_unit = 'K' or madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK') ";
							$wheretxt.=" or ((madori = 4) and (madori_unit = 'LK' or madori_unit = 'DK' or madori_unit = 'LDK'))";
							$wherechk=1;
							break;
						case "上限なし":
							break;
						default:
							break;
					}
					break;
			}
			$wheretxt.=") ";
		}
		$this->wheretxt=$wheretxt;
		$this->wherechk=$wherechk;
	}
	
	function LowRent($lower_cost) {
		if($this->wherechk==1) {
			$this->wheretxt.=" and ";
		}
		
		$this->wheretxt.=" rent >= ".($lower_cost*10000);
		$this->wherechk=1;
	}
	
	function UpperRent($upper_cost) {
		if($this->wherechk==1) {
			$this->wheretxt.=" and ";
		}
		$this->wheretxt.=" rent <= ".($upper_cost*10000);
		$this->wherechk=1;
	}
	
	function Address($address1,$address2,$address3) {
		
		
		switch($address1) {
			case 0:
				if($this->wherechk==1) {
					$this->wheretxt.=" and ";
				}
				$_srchaddress=" address1='岩国市'";
				break;
			case 1:
				if($this->wherechk==1) {
					$this->wheretxt.=" and ";
				}
				$_srchaddress=" address1='大竹市'";
				break;
			case 2:
				if($this->wherechk==1) {
					$this->wheretxt.=" and ";
				}
				$_srchaddress=" address1='和木町'";
				break;
			case 3:
				if($this->wherechk==1) {
					$this->wheretxt.=" and ";
				}
				$_srchaddress=" (address1 <> '和木町' and address1 <> '大竹市' and address1 <> '岩国市')";
				break;
			case 4:
				if($this->wherechk==1) {
					$this->wheretxt.=" and ";
				}
				$_srchaddress=" address1 like '%%' ";
				break;
				
		}
		if($address1!=NULL) {
			if($address2!="指定なし") {
				$_srchaddress.=" and address2='".$address2."'";
			}
			else {
				$_srchaddress.="";
			}
			
			if($address3!=0) {
				$_srchaddress.=" and address3=".$address3;
			}
			else {
				$_srchaddress.="";
			}
		
		}
		$this->wheretxt.=$_srchaddress;
		$this->wherechk=1;
		
	}
	
	function KeyWord($keyword) {
		
		if($this->wherechk==1) {
			$this->wheretxt.=" and ";
		}
		
		$this->wheretxt.=" srhkey like '%".$keyword."%'";
		$this->wherechk=1;
		
	}
	
	function LowerArea($lower_area) {
		if($this->wherechk==1) {
			$this->wheretxt.=" and ";
		}
		
		$this->wheretxt.=" area >= ".($lower_area);
		$this->wherechk=1;
		
	}
	
	function UpperArea($upper_area) {
	
		if($this->wherechk==1) {
			$this->wheretxt.=" and ";
		}
		
		$this->wheretxt.=" area <= ".($upper_area);
		$this->wherechk=1;
		
	}
	
	function LowerCost($lower_cost) {
		if($this->wherechk==1) {
			$this->wheretxt.=" and ";
		}
		
		$this->wheretxt.=" price >= ".($lower_cost*10000);
		$this->wherechk=1;
	}
	
	function UpperCost($upper_cost) {
		if($this->wherechk==1) {
			$this->wheretxt.=" and ";
		}
		$this->wheretxt.=" price <= ".($upper_cost*10000);
		$this->wherechk=1;
	}
	
	function Get_DelAllList() {
		
	}
	
	
}
/*
?><meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php
*/
if($_SERVER['HTTP_HOST']=="118.243.22.177"){
echo "ok";
}
?>