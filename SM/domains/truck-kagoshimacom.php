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

class Ab_Truck extends Ab_RealEstate{
	
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
		
	
		
		if($_SESSION["hicost"]!=NULL&&$_SESSION["hicost"]!=0) {
			$whereary[]="kakaku <= ".$_SESSION["hicost"]."";
		}
		
		if($_SESSION["lowcost"]!=NULL&&$_SESSION["lowcost"]!=0) {
			$whereary[]="kakaku >= ".$_SESSION["lowcost"]."";
		}
			
	
		$whereary[]="(".implode(" or ",$cwhereary).")";

		if($_SESSION["nophoto"]==1) {
		$whereary[]="photo1 is null";
		}
		
		if($whereary[0]!=NULL) {
			$wheretxt=" and ".implode(" and ",$whereary);
		}
		
		switch($this->type) {
			case "1":
				$sql="select * from bukken where bunrui = ".$bunrui." and (syumoku = 'ウィング' or syumoku ='バン') ".$wheretxt." and del_chk <>1 order by ".$sort;
				$res=$db->Query($sql);
				$this->numrows=$db->NumRows($res);
				$sql.=$db->CreateLimitSql("",$_SESSION["lim"],$_SESSION["lim"]*($_SESSION["page"]-1));
				$rdata=$db->GetList($sql);
				return $rdata;
				break;
			case 2:
				$sql="select * from bukken where bunrui =  ".$bunrui." and (syumoku ='冷凍車' or syumoku = '冷凍ウィング') and del_chk <>1 ".$wheretxt." order by ".$sort;
				$res=$db->Query($sql);
				$this->numrows=$db->NumRows($res);
				$sql.=$db->CreateLimitSql("",$_SESSION["lim"],$_SESSION["lim"]*($_SESSION["page"]-1));
				$rdata=$db->GetList($sql);

				return $rdata;
				break;
			case 3:
				$sql="select * from bukken where bunrui =  ".$bunrui." and (syumoku = '平ボディ') ".$wheretxt." and del_chk <>1 order by ".$sort;
				$res=$db->Query($sql);
				$this->numrows=$db->NumRows($res);
				$sql.=$db->CreateLimitSql("",$_SESSION["lim"],$_SESSION["lim"]*($_SESSION["page"]-1));
				$rdata=$db->GetList($sql);

				return $rdata;
				break;
				
			case 4:
				$sql="select * from bukken where bunrui =  ".$bunrui." and (syumoku = 'ダンプ') and del_chk <>1 ".$wheretxt." order by ".$sort;
				$res=$db->Query($sql);
				$this->numrows=$db->NumRows($res);
				$sql.=$db->CreateLimitSql("",$_SESSION["lim"],$_SESSION["lim"]*($_SESSION["page"]-1));;
				$rdata=$db->GetList($sql);

				return $rdata;
				break;
				
			case 5:
				$sql="select * from bukken where bunrui =  ".$bunrui." and (syumoku = 'クレーン付' or syumoku = 'セルフクレーン付') and del_chk <>1 ".$wheretxt." order by ".$sort;
				$res=$db->Query($sql);
				$this->numrows=$db->NumRows($res);
				$sql.=$db->CreateLimitSql("",$_SESSION["lim"],$_SESSION["lim"]*($_SESSION["page"]-1));;
				$rdata=$db->GetList($sql);
				return $rdata;
				break;
				
			case 6:
				$sql="select * from bukken where bunrui =  ".$bunrui." and (syumoku = 'セルフローダー車載車') and del_chk <>1 ".$wheretxt." order by ".$sort;
				$res=$db->Query($sql);
				$this->numrows=$db->NumRows($res);
				$sql.=$db->CreateLimitSql("",$_SESSION["lim"],$_SESSION["lim"]*($_SESSION["page"]-1));;
				$rdata=$db->GetList($sql);
				return $rdata;
				break;

		case 7:
				$sql="select * from bukken where bunrui =  ".$bunrui." and (syumoku = 'バス' or syumoku = '特殊車') and del_chk <>1 ".$wheretxt." order by ".$sort;
				$res=$db->Query($sql);
				$this->numrows=$db->NumRows($res);
				$sql.=$db->CreateLimitSql("",$_SESSION["lim"],$_SESSION["lim"]*($_SESSION["page"]-1));;
				$rdata=$db->GetList($sql);
				return $rdata;
				break;
				
		case 8:
				$sql="select * from bukken where bunrui =  ".$bunrui." and (syumoku = 'その他') and del_chk <>1 ".$wheretxt." order by ".$sort;
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

class Truck extends Ab_Truck{
	
}

class Ad_Truck extends Ab_Truck{
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
					$whereary[]="photo1 is null";
					break;
				case 2:
					$whereary[]="not photo1 is null";
					break;
			}
						
			if($whereary[0]!=NULL) {
				$wheretxt=" and ".implode(" and ",$whereary);
			}
			
			switch($this->type) {
				case "1":
				 					$sql="select * from bukken where bunrui = ".$bunrui." and (syumoku = 'ウィング' or syumoku ='バン') ".$wheretxt." order by ".$sort;
					$res=$db->Query($sql);
					$this->numrows=$db->NumRows($res);
					$sql.=$db->CreateLimitSql("",$_SESSION["lim"],$_SESSION["lim"]*($_SESSION["page"]-1));
					$rdata=$db->GetList($sql);
					return $rdata;
					break;
				case 2:
				 					$sql="select * from bukken where bunrui =  ".$bunrui." and (syumoku ='冷凍車' or syumoku = '冷凍ウィング') ".$wheretxt." order by ".$sort;
					$res=$db->Query($sql);
					$this->numrows=$db->NumRows($res);
					$sql.=$db->CreateLimitSql("",$_SESSION["lim"],$_SESSION["lim"]*($_SESSION["page"]-1));
					$rdata=$db->GetList($sql);
	
					return $rdata;
					break;
					
				case 3:
				 					$sql="select * from bukken where bunrui =  ".$bunrui." and (syumoku = '平ボディ' ) ".$wheretxt." order by ".$sort;
					$res=$db->Query($sql);
					$this->numrows=$db->NumRows($res);
					$sql.=$db->CreateLimitSql("",$_SESSION["lim"],$_SESSION["lim"]*($_SESSION["page"]-1));
					$rdata=$db->GetList($sql);
	
					return $rdata;
					break;
					
				case 4:
				 					$sql="select * from bukken where bunrui =  ".$bunrui." and (syumoku = 'ダンプ') ".$wheretxt." order by ".$sort;
					$res=$db->Query($sql);
					$this->numrows=$db->NumRows($res);
					$sql.=$db->CreateLimitSql("",$_SESSION["lim"],$_SESSION["lim"]*($_SESSION["page"]-1));
					$rdata=$db->GetList($sql);
	
					return $rdata;
					break;
					
				case 5:
				 					$sql="select * from bukken where bunrui =  ".$bunrui." and (syumoku = 'クレーン付' or syumoku = 'セルフクレーン付') ".$wheretxt." order by ".$sort;
					$res=$db->Query($sql);
					$this->numrows=$db->NumRows($res);
					$sql.=$db->CreateLimitSql("",$_SESSION["lim"],$_SESSION["lim"]*($_SESSION["page"]-1));
					$rdata=$db->GetList($sql);
					return $rdata;
					break;
					
				case 6:
				 					$sql="select * from bukken where bunrui =  ".$bunrui." and (syumoku = 'セルフローダー車載車') ".$wheretxt." order by ".$sort;
					$res=$db->Query($sql);
					$this->numrows=$db->NumRows($res);
					$sql.=$db->CreateLimitSql("",$_SESSION["lim"],$_SESSION["lim"]*($_SESSION["page"]-1));
					$rdata=$db->GetList($sql);
					return $rdata;
					break;
		case 7:
				 $sql="select * from bukken where bunrui =  ".$bunrui." and (syumoku = 'バス' or syumoku = '特殊車')  ".$wheretxt." order by ".$sort;
				$res=$db->Query($sql);
				$this->numrows=$db->NumRows($res);
				$sql.=$db->CreateLimitSql("",$_SESSION["lim"],$_SESSION["lim"]*($_SESSION["page"]-1));;
				$rdata=$db->GetList($sql);
				return $rdata;
				break;
				
		case 8:
					 			$sql="select * from bukken where bunrui =  ".$bunrui." and (syumoku = 'その他') ".$wheretxt." order by ".$sort;
				$res=$db->Query($sql);
				$this->numrows=$db->NumRows($res);
				$sql.=$db->CreateLimitSql("",$_SESSION["lim"],$_SESSION["lim"]*($_SESSION["page"]-1));;
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

class Keitai_Truck extends Ab_Truck{
	
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
				$sql="select * from bukken where bunrui = ".$bunrui." and (syumoku = 'ウィング' or syumoku ='バン') ".$wheretxt." and del_chk <>1 order by ".$sort;
				$res=$db->Query($sql);
				$this->numrows=$db->NumRows($res);
				$sql.=$db->CreateLimitSql("",5,5*($_REQUEST["page"]-1));
				$rdata=$db->GetList($sql);
				return $rdata;
				break;
			case 2:
				$sql="select * from bukken where bunrui =  ".$bunrui." and (syumoku ='冷凍車' or syumoku = '冷凍ウィング') and del_chk <>1 ".$wheretxt." order by ".$sort;
				$res=$db->Query($sql);
				$this->numrows=$db->NumRows($res);
				$sql.=$db->CreateLimitSql("",5,5*($_REQUEST["page"]-1));
				$rdata=$db->GetList($sql);

				return $rdata;
				break;
			case 3:
				$sql="select * from bukken where bunrui =  ".$bunrui." and (syumoku = '平ボディ') ".$wheretxt." and del_chk <>1 order by ".$sort;
				$res=$db->Query($sql);
				$this->numrows=$db->NumRows($res);
				$sql.=$db->CreateLimitSql("",5,5*($_REQUEST["page"]-1));
				$rdata=$db->GetList($sql);

				return $rdata;
				break;
				
			case 4:
				$sql="select * from bukken where bunrui =  ".$bunrui." and (syumoku = 'ダンプ') and del_chk <>1 ".$wheretxt." order by ".$sort;
				$res=$db->Query($sql);
				$this->numrows=$db->NumRows($res);
				$sql.=$db->CreateLimitSql("",5,5*($_REQUEST["page"]-1));
				$rdata=$db->GetList($sql);

				return $rdata;
				break;
				
			case 5:
				$sql="select * from bukken where bunrui =  ".$bunrui." and (syumoku = 'クレーン付' or syumoku = 'セルフクレーン付') and del_chk <>1 ".$wheretxt." order by ".$sort;
				$res=$db->Query($sql);
				$this->numrows=$db->NumRows($res);
				$sql.=$db->CreateLimitSql("",5,5*($_REQUEST["page"]-1));
				$rdata=$db->GetList($sql);
				return $rdata;
				break;
				
			case 6:
				$sql="select * from bukken where bunrui =  ".$bunrui." and (syumoku = 'セルフローダー車載車') and del_chk <>1 ".$wheretxt." order by ".$sort;
				$res=$db->Query($sql);
				$this->numrows=$db->NumRows($res);
				$sql.=$db->CreateLimitSql("",5,5*($_REQUEST["page"]-1));
				$rdata=$db->GetList($sql);

				return $rdata;
				break;
		case 7:
				$sql="select * from bukken where bunrui =  ".$bunrui." and (syumoku = 'バス' or syumoku = '特殊車') and del_chk <>1 ".$wheretxt." order by ".$sort;
				$res=$db->Query($sql);
				$this->numrows=$db->NumRows($res);
				$sql.=$db->CreateLimitSql("",$_SESSION["lim"],$_SESSION["lim"]*($_SESSION["page"]-1));;
				$rdata=$db->GetList($sql);
				return $rdata;
				break;
				
		case 8:
				$sql="select * from bukken where bunrui =  ".$bunrui." and (syumoku = 'その他') and del_chk <>1 ".$wheretxt." order by ".$sort;
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
/*
?><meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php
*/
?><?php
   switch($_REQUEST["PID"]) {
				
			 case "keitai":
					include ("./keitai/index.php");
					$pagetype="gw";
					break;
			
				case "topics_list":
					$pagetype="hp";
					include "./topics/d_top.php";
					break;
		   case "topics":
					$pagetype="hp";
					include "./topics/d_addition.php";
					break;
		   		case "topics_dadd":
					$pagetype="hp";
					include "./topics/d_addition.php";
					break;
		   		case "topics_dup":
					$pagetype="hp";
					include "./topics/d_update.php";
					break;			
			
						case "pagesetting":
					$pagetype="hp";
							include ("./pagesetting/top.php");
							break;
					case "news":
							if($basicchk["use_chk"]==1) {
								include "./news2/d_top.php";
							
							}
							else {	
								include "./news/d_top.php";
							}
						$pagetype="hp";
					break;
		   		case "news_add":
							if($basicchk["use_chk"]==1) {
								include "./news2/d_addition.php";
							
							}
							else {	
								include "./news/d_addition.php";
							}
					$pagetype="hp";
					break;
		   		case "news_up":
							if($basicchk["use_chk"]==1) {
								include "./news2/d_update.php";
							
							}
							else {	
								include "./news/d_update.php";
							}
					$pagetype="hp";
					break;

		   		case "qanda":
					$pagetype="hp";
					include "./qanda/d_top.php";
					break;
		   		case "qanda_category":
					include "./qanda/category.php";
					$pagetype="hp";
					break;
		   		case "qanda_setting":
					include "./qanda/setting.php";
					$pagetype="hp";
					break;
		   		case "qanda_add":
					include "./qanda/addition.php";
					break;
		   		case "qanda_up":
					$pagetype="hp";
					include "./qanda/update.php";
					break;
		   		case "qanda_details":
					include "./qanda/d_top.php";
					$pagetype="hp";
					break;
		   		case "qanda_d_add":
					include "./qanda/d_addition.php";
					$pagetype="hp";
					break;
					$pagetype="hp";
		   		case "qanda_d_up":
					include "./qanda/d_update.php";
					break;
		   		case "staff":
					$pagetype="hp";
					include "./staff/d_top.php";
					break;
		   		case "staff_setting":
					include "./staff/setting.php";
					$pagetype="hp";
					break;
		   		case "staff_add":
					include "./staff/d_addition.php";
					$pagetype="hp";
					break;
		   		case "staff_up":
					$pagetype="hp";
					include "./staff/d_update.php";
					break;
		   		case "staff_details":
					$pagetype="hp";
					include "./staff/d_top.php";
					break;
		   		case "staff_d_add":
					$pagetype="hp";
						include "./staff/d_addition.php";
						break;
		   		case "staff_d_up":
						include "./staff/d_update.php";
					$pagetype="hp";
						break;
		   		case "setting":
							
								include "./setting/top.php";
							
							$pagetype="hp";
						break;
		   		case "company":
					$pagetype="fudousan";
						include "./truck/company.php";
						break;		
		   		case "company1":
					$pagetype="hp";
						include "./company1/top.php";
						break;
		   		case "company1_details":
					$pagetype="hp";
						include "./company1/details.php";
						break;
		   		case "company1_list_src":
					$pagetype="hp";
						include "./company1/list_src.php";
						break;
		   		case "company1_setting":
					$pagetype="hp";
						include "./company1/setting.php";
						break;
		   		case "company2":
					$pagetype="hp";
						include "./company2/top.php";
						break;
		   		case "company2_detailslist_src":
					$pagetype="hp";
						include "./company2/detailslist_src.php";
						break;
		   		case "company2_list_src":
					$pagetype="hp";
						include "./company2/list_src.php";
						break;
		   		case "company2_setting":
					$pagetype="hp";
						include "./company2/setting.php";
						break;
		   		case "company3":
					$pagetype="hp";
						include "./company3/top.php";
						break;
		   		case "company3_setting":
					$pagetype="hp";
						include "./company3/setting.php";
						break;
		   		case "link":
						
								include "./link/top.php";
					$pagetype="hp";
						break;
		   		case "link_category":
					$pagetype="hp";

									include "./link/category.php";

						break;
		   		case "link_add":

						include "./link/addition.php";

					$pagetype="hp";
						break;
		   		case "link_up":
						include "./link/update.php";
					$pagetype="hp";
						break;
		   		case "link_details":

					include "./link/d_top.php";
		
							
					$pagetype="hp";
					break;
		   		case "link_d_add":

						include "./link/d_addition.php";
					$pagetype="hp";
					break;
		   		case "link_d_up":
						include "./link/d_update.php";
					$pagetype="hp";
						break;


						/*
						 *fudousan
							*/
						//fudousan
						case "re_inputcsv":
					$pagetype="fudousan";
							include "./truck/inputcsv.php";
							break;
						case "re_c1":
						$pagetype="fudousan";
						include "./truck/c1/top.php";
							break;
						case "re_c1_rep":
					$pagetype="fudousan";
							include "./truck/c1/replace2.php";
							break;
						case "re_c1_del":
					$pagetype="fudousan";
							include "./truck/c1/delete.php";
							break;			
						case "re_c1_add":
					$pagetype="fudousan";
							include "./truck/c1/addition2.php";
							break;
						case "re_c1_copy":
					$pagetype="fudousan";
							include "./truck/c1/copy2.php";
							break;
						case "re_c1_set":
					$pagetype="fudousan";
							include "./truck/c1/setting.php";
							break;
						case "re_c2_copy":
					$pagetype="fudousan";
							include "./truck/c2/copy2.php";
							break;
						case "re_c3_copy":
					$pagetype="fudousan";
							include "./truck/c3/copy2.php";
							break;
						case "re_b1_copy":
					$pagetype="fudousan";
							include "./truck/b1/copy2.php";
							break;
						case "re_b2_copy":
					$pagetype="fudousan";
							include "./truck/b2/copy2.php";
							break;
						case "re_b3_copy":
					$pagetype="fudousan";
							include "./truck/b3/copy2.php";
							break;
						case "re_c2":
					$pagetype="fudousan";
							include "./truck/c2/top.php";
							break;
						case "re_c2_set":
					$pagetype="fudousan";
							include "./truck/c2/setting.php";
							break;
						case "re_c2_add":
					$pagetype="fudousan";
							include "./truck/c2/addition2.php";
							break;
						case "re_c2_rep":
					$pagetype="fudousan";
							include "./truck/c2/replace2.php";
							break;
						case "re_c2_del":
					$pagetype="fudousan";
							include "./truck/c2/delete.php";
							break;			
						case "re_c3_add":
					$pagetype="fudousan";
							include "./truck/c3/addition2.php";
							break;
						case "re_c3":
					$pagetype="fudousan";
							include "./truck/c3/top.php";
							break;
						case "re_c3_set":
					$pagetype="fudousan";
							include "./truck/c3/setting.php";
							break;
						case "re_c3_rep":
						$pagetype="fudousan";
								include "./truck/c3/replace2.php";
							break;
						case "re_c3_del":
					$pagetype="fudousan";
							include "./truck/c3/delete.php";
							break;			
						case "re_b1":
					$pagetype="fudousan";
							include "./truck/b1/top.php";
							break;
						case "re_b1_rep":
					$pagetype="fudousan";
							include "./truck/b1/replace2.php";
							break;
						case "re_b1_del":
					$pagetype="fudousan";
							include "./truck/b1/delete.php";
							break;			
						case "re_b1_add":
					$pagetype="fudousan";
							include "./truck/b1/addition2.php";
							break;
						case "re_b1_set":
					$pagetype="fudousan";
							include "./truck/b1/setting.php";
							break;
						case "re_b2":
					$pagetype="fudousan";
							include "./truck/b2/top.php";
							break;
						case "re_b2_add":
					$pagetype="fudousan";
							include "./truck/b2/addition2.php";
							break;
						case "re_b2_rep":
					$pagetype="fudousan";
							include "./truck/b2/replace2.php";
							break;
						case "re_b2_del":
					$pagetype="fudousan";
							include "./truck/b2/delete.php";
							break;			
						case "re_b2_set":
					$pagetype="fudousan";
							include "./truck/b2/setting.php";
							break;
						case "re_b3":
					$pagetype="fudousan";
							include "./truck/b3/top.php";
							break;
						case "re_b3_rep":
					$pagetype="fudousan";
							include "./truck/b3/replace2.php";
							break;
						case "re_b3_del":
					$pagetype="fudousan";
							include "./truck/b3/delete.php";
							break;			
						case "re_b3_add":
					$pagetype="fudousan";
							include "./truck/b3/addition2.php";

							break;
						case "re_b3_set":
					$pagetype="fudousan";
							include "./truck/b3/setting.php";
							break;
						case "re_tenpo_up":
					$pagetype="fudousan";
							include "./truck/tenpo.php";
							break;			
						case "re_area":
					$pagetype="fudousan";
							include "./truck/area/top.php";
							break;
						case "re_area_clist":
					$pagetype="fudousan";
							include "./truck/area/clist.php";
							break;
						case "re_area_up":
					$pagetype="fudousan";
							include "./truck/area/update.php";
							break;
						case "re_chiikilist":
					$pagetype="fudousan";
							include "./truck/area/update.php";
							break;
						case "re_area_chiiki_reg":
					$pagetype="fudousan";
							include "./truck/area/creg.php";
							break;
						case "re_area_del":
					$pagetype="fudousan";
							include "./truck/area/delete.php";
							break;
						case "re_setting":
					$pagetype="fudousan";
							include "./truck/c1/setting.php";
							break;
						case "re_osetting":
					$pagetype="fudousan";
							include "./truck/oset.php";
							break;
						

		   case "blog":
						$pagetype="hp";
						
						if($basicchk["use_chk"]==1) {
							include "./blog2/top.php";
						}
						else {
							include "./blog/top.php";
						}
						
						break;
		   case "blog_add":
						$pagetype="hp";
						if($basicchk["use_chk"]==1) {
							include "./blog2/addition.php";
						}
						else {
							include "./blog/addition.php";
						}
						break;
		   case "blog_up":
						$pagetype="hp";
						if($basicchk["use_chk"]==1) {
							include "./blog2/update.php";
						}
						else {
							include "./blog/update.php";
						}
						break;
		   case "blog_list":
						$pagetype="hp";

						if($basicchk["use_chk"]==1) {
							include "./blog2/d_top.php";
						}
						else {
							include "./blog/d_top.php";
						}

						break;
		   case "blog_dadd":
						$pagetype="hp";
						if($basicchk["use_chk"]==1) {
							include "./blog2/d_addition.php";
						}
						else {
							include "./blog/d_addition.php";
						}
						break;
		   case "blog_dup":
						$pagetype="hp";

						if($basicchk["use_chk"]==1) {
							include "./blog2/d_update.php";
						}
						else {
							include "./blog/d_update.php";
						}

						break;
					
		   		case "news_setting":
					$pagetype="hp";
					include "./news/setting.php";
					break;
		   		case "vup":
					$pagetype="hp";
					include "./vup/top.php";
					break;
		   		case "vup_d":
					$pagetype="hp";
					include "./vup/details.php";
					break;
case "tenpo":
					$pagetype="gw";
include ("./tenpo/index.php");
break;
			default:
				$pagetype="fudousan";
				include "./truck/c1/top.php";
					break;
}
/*
?>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-jp" />
<?php
*/?>