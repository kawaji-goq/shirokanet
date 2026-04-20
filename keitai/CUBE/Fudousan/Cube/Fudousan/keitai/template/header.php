<meta http-equiv="Content-Type" content="text/html; charset=shift_jis" />
<?php
$tenpodata=$dbobj->GetData("select * from tenpo_data");
function kecho($txt) {
	echo mb_convert_encoding($txt,"sjis","euc-jp");
}

if($tenpodata["k_logo"]!=NULL) {
?><div align="center"><img src="<?php echo $tenpodata["k_logo"] ?>"></div>
<?php
}
else {
?><div align="center">
<?php
	echo mb_convert_kana(mb_convert_encoding($tenpodata["name"],"sjis","eucjp"),"k")."<br />";
 echo "携帯サイト";
?>
</div>
<?php
}
?><hr>