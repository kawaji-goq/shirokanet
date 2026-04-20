<a href="#" onClick="javascript:this.setHomePage('http://masaboo.cside.com/');return false;">sss
</a>
<?php
$wday=date("w",time());
$year=date("Y");
$month=date("m");
$date=date("d");
echo $sunday=date("Y-m-d",mktime(0,0,0,$month,$date-$wday,$year));
?>