<?php
if(!class_exists("Cube_DB")) {
	include "ITC/modules.php";
}
function AddSearch($m,$c) {
	mb_language("japanese");
	mb_internal_encoding("EUC-JP");
	if($m==NULL) {
		$m="p";
	}
	$dbobj=Cube_DB :: UseDB("postgresql");
	$dbobj->name="common";
	$dbobj->Connect();
	
	switch($m) {
		case "p":
			$List=$dbobj->GetList("select pref,code from prefcode order by code");
			break;
		case "c1":
			$List=$dbobj->GetList("select distinct(address1),address_h1,code from zipcode2 where code like '".$c."%' order by address_h1");
			break;
		case "c2":
			$List=$dbobj->GetList("select distinct(address2),address_h2 from zipcode2 where code ='".$c."' and address2 <> '以下に掲載がない場合' order by address_h2");
			break;
	}
	
	return $List;
}

$list=AddSearch($_GET["m"],$_GET["c"]);
switch($_GET["m"]) {
	case  "c1":
	for($i=0;$list[$i]["address1"]!=NULL;$i++) {	
		?>
		<a href="?c=<?php echo $list[$i]["code"];?>&m=c2"><?php echo $list[$i]["address1"];?></a><br>
	<?php
	}
	break;
	case  "c2":
	for($i=0;$list[$i]["address2"]!=NULL;$i++) {	
		?>
		<?php echo $i.":".str_replace("（","",str_replace("）","",$list[$i]["address2"]));?><br>
	<?php
	}
	break;
	default:
	for($i=0;$list[$i]["code"]!=NULL;$i++) {	
		?>
		<a href="?c=<?php echo $list[$i]["code"];?>&m=c1"><?php echo $list[$i]["pref"];?></a><br>
	<?php
	}
	break;
}

?>
