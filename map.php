<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<title><?php echo $tenpodata["pagetitle"];?></title>
<?php include $_SERVER['DOCUMENT_ROOT']. '/CUBE/Fudousan/template/meta.php'; ?>
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
    <script src="http://maps.google.com/maps?file=api&v=2&key=ABQIAAAAQ1yPIvUpZ5l-fAiK5Bn-mRTKj4UIH--fr4jdRrSHHp8jRZUBXxQc1-Hav3uCEDQWKKyxZcxa0TZnOg" type="text/javascript" charset="utf-8"></script>
<script language="javascript">
function load(){
//alert("ss");
	gmapload();
}
//<![CDATA[
var map = null;
var geocoder = null;
// 初期化
// <body onload="load()"> で呼び出されています
function gmapload() {
	if (GBrowserIsCompatible()) {
		map = new GMap2(document.getElementById("map"));
		//map.setCenter(new GLatLng(35.67431, 139.69082), 18);
		// GClientGeocoderを初期化
		geocoder = new GClientGeocoder();
		map.addControl(new GLargeMapControl());
		map.addControl(new GMapTypeControl());
		showAddress("<?php echo $_GET["address"];?>");
	}
	else {
		alert("ご使用されているブラウザではマップを表示できません。\nブラウザをバージョンアップもしくは変更してお試し下さい。");
	}
}
    // 「移動する」ボタンを押されると実行されます
    function showAddress(address) {
      if (geocoder) {
        geocoder.getLatLng(
          address,
          function(point) {
            if (!point) {
              alert(address + " not found");
            } else {
				map.setCenter(point, 14);
				var marker = new GMarker(point);
				map.addOverlay(marker);
				marker.openInfoWindowHtml('<table width="200"  border="0" cellspacing="3" cellpadding="3"> <tr><th align="left"></th>	</tr>	<tr>		<td></td></tr><tr><td><?php echo $_GET["address"];?></td></tr></table>');
            }
          }
        );
      }
    }
</script>
</head>
<body onload="setTimeout('gmapload()',1000)">
<div id="map" style="width:600px; height:480px"></div>
<map name="Map3"><area shape="rect" coords="78,12,250,31" href="http://itcube.jp" target="_blank"></map><script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-3889879-1");
pageTracker._initData();
pageTracker._trackPageview();
</script>
