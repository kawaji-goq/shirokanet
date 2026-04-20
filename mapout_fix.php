

<?php
header("Content-type: text/html; charset=utf-8");


// function get_gps_from_address( $address='' )
// {
//     $res = array();
//     $req = 'http://maps.google.com/maps/api/geocode/xml';
//     $req .= '?address='.urlencode($address);
//     $req .= '&sensor=false';
//     $xml = simplexml_load_file($req) or die('XML parsing error');
//     if ($xml->status == 'OK') {
//         $location = $xml->result->geometry->location;
//         $res['lat'] = (string)$location->lat[0];
//         $res['lng'] = (string)$location->lng[0];
//     }
//     return $res;
// }
//
// $latlng = get_gps_from_address($_GET["address"]);


if (!empty($_GET['address'])) {
	$address = $_GET['address'];
	$encode = mb_detect_encoding($address,  "ASCII,EUC-JP,UTF-8", true);
	$address = mb_convert_encoding($address, 'utf-8', $encode);
	$address = mb_convert_kana($address, 'n');
}


if (!empty($_GET["name"])) {
	$bukkenName = $_GET["name"];
}
// google map api地図表示のため加工
if (preg_match('/下\d+/', $address, $temp)) {
	 $houseNumber = ltrim($temp[0], '下');
	$address =  preg_replace('/下\d+/', $houseNumber, $address);
}
$paramAdr = preg_replace("/(外.+$|他.+$|より分筆+.*$|同所.*$|\(予定\)+$|（予定）+$|（元.+）|\(元.+\))/", '', $address);
$paramAdr = rtrim(rtrim($paramAdr, '番'), '号');
$paramAdr = str_replace('　', '', str_replace(' ', '', str_replace('番', '-', str_replace('ー', '-', $paramAdr))));
$paramAdr = urlencode($paramAdr);
$title = htmlspecialchars($_GET["name"]. ' ' . $address, ENT_QUOTES, 'utf-8');


?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?= $title; ?></title>
<?php include $_SERVER['DOCUMENT_ROOT']. '/CUBE/Fudousan/template/meta_utf8.php'; ?>
<link href="css.css" rel="stylesheet" type="text/css">
<style>
th {
	font-size:14px;
	font-weight: bold;
}
td {
	font-size:12px;
	color:#666666;
}
</style>
    <script src="http://maps.google.com/maps?file=api&v=2&key=AIzaSyBb6W5fuBfgGZGKJXuLZIX0VkprovMGCgI" type="text/javascript" charset="utf-8"></script>
	<!--
ABQIAAAAQ1yPIvUpZ5l-fAiK5Bn-mRTKj4UIH--
fr4jdRrSHHp8jRZUBXxQc1-Hav3uCEDQWKKyxZcxa0TZnOg
-->
<script language="javascript">
// function load(){
// //alert("ss");
// 	gmapload();
// }
//<![CDATA[
// var map = null;
// var geocoder = null;
// 初期化
// <body onload="load()"> で呼び出されています
// function gmapload() {
// 	if (GBrowserIsCompatible()) {
// 		map = new GMap2(document.getElementById("map"));
// 		//map.setCenter(new GLatLng(35.67431, 139.69082), 18);
// 		// GClientGeocoderを初期化
// 		geocoder = new GClientGeocoder();
// 		map.addControl(new GLargeMapControl());
// 		map.addControl(new GMapTypeControl());
// 		showAddress("<?php echo $_GET["address"];?>");
// 	}
// 	else {
// 		alert("ご使用されているブラウザではマップを表示できません。\nブラウザをバージョンアップもしくは変更してお試し下さい。");
// 	}
// }
//     // 「移動する」ボタンを押されると実行されます
//     function showAddress(address) {
//       if (geocoder) {
//         geocoder.getLatLng(
//           address,
//           function(point) {
//             if (!point) {
//               alert(address + " not found");
//             } else {
// 				map.setCenter(point, 14);
// 				var marker = new GMarker(point);
// 				map.addOverlay(marker);
// 				marker.openInfoWindowHtml('<table width="200"  border="0" cellspacing="3" cellpadding="3"> <tr><th align="left"><?php echo $_GET["name"];?></th>	</tr>	<tr>		<td></td></tr><tr><td><?php echo $_GET["address"];?></td></tr></table>');
//             }
//           }
//         );
//       }
//     }
</script>
</head>
<!-- gmapload -->
<body>

<iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="//maps.google.co.jp/maps?q=<?=$paramAdr?>&z=16&output=embed"></iframe>
</script>

<script type="text/javascript">
_uacct = "UA-2150070-1";
urchinTracker();
</script>

</body>
</html>
