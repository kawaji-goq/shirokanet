<?php

function numberreplace($number) {	
		$number=str_replace(",","",$number);
		$number=str_replace("бв","",$number);
		$number=str_replace("▒▀","",$number);
		$number=str_replace("\\","",$number);
		$number=str_replace("бя","",$number);
		$number=str_replace("╦№","",$number);
		$number=str_replace("└щ","",$number);
		return $number;
}
echo numberreplace("5,000");
?>