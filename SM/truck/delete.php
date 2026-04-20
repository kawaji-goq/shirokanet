<?php
$re1obj=new Ad_RealEstate($dbobj);
$re1obj->type=1;

if($_REQUEST["delete_re"]=="削除する") {
	$dbobj->Query("update lastupdate set lastupdate=".time()."");

	$upsql=	"delete from bukken ";
	$bname="bukken";
	$ftp=new Cube_FTP();
	$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
	$fdata=$ftp->GetSimpleList("tmp/".$bname."_data/".$_REQUEST["bid"]."/");
	for($delimgrows=0;$fdata[$delimgrows]!=NULL;$delimgrows++){
		$ftp->RmFile("tmp/".$bname."_data/".$_REQUEST["bid"]."/".$fdata[$delimgrows]);		
	}
	$ftp->RmDir("tmp/".$bname."_data/".$_REQUEST["bid"]."/");	
	$upsql.=" where id='".$_REQUEST["bid"]."'";
	$dbobj->Query($upsql);
	?>
<script language="javascript">
	location.replace("index.php?PID=re_c3");
	</script>
<?php
}

$re1data=$re1obj->GetReData($_GET["bid"]);

?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<script language="JavaScript" src="/tool/keypress.js" type="text/javascript">
function hback() {
history.back();
}
</script>
<style type="text/css">
<!--
.btmwidth_100 {
	width: 100px;
	font-weight: bold;
	text-transform: uppercase;
	text-align: center;
	height: 40px;
}
-->
</style>
<script language="javascript">
function realestate_move(mode) {
	location.replace("index.php?mode=lease_"+mode+"&realestate_id=");
}

function zipcode() {
	var zipcode;
	var address;
	zipcode=document.lease_apaman_form.lease_apaman_zipcode.value;
	result=showModalDialog("/tool/zipserch.php?zipcode="+zipcode,"test");
	address=result.split(" ");
	document.lease_apaman_form.lease_apaman_zipcode.value=address[0];
	document.lease_apaman_form.lease_apaman_pref.value=address[1];
	document.lease_apaman_form.lease_apaman_address1.value=address[2]+address[3];
}

function realestate_move(mode) {
	location.replace("index.php?PAGEID=realestate&mode=lease_"+mode+"&realestate_id=");
}
//リスト内の移動をする関数
function func(elenum1,elenum2) {
	var devneko;
			switch(document.lease_apaman_form.elements[elenum1].value) {
				case "1":
				devneko="";
				document.lease_apaman_form.elements[elenum2].length=0;
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "1";
					var str = document.createTextNode("大竹駅");
					ele.appendChild(str);
			
					document.lease_apaman_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "2";
					var str = document.createTextNode("岩国駅");
					ele.appendChild(str);
			
					document.lease_apaman_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "3";
					var str = document.createTextNode("南岩国駅");
					ele.appendChild(str);
			
					document.lease_apaman_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "4";
					var str = document.createTextNode("藤生駅");
					ele.appendChild(str);
			
					document.lease_apaman_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "5";
					var str = document.createTextNode("通津駅");
					ele.appendChild(str);
			
					document.lease_apaman_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "6";
					var str = document.createTextNode("由宇駅");
					ele.appendChild(str);
			
					document.lease_apaman_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "7";
					var str = document.createTextNode("神代駅");
					ele.appendChild(str);
			
					document.lease_apaman_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "8";
					var str = document.createTextNode("大畠駅");
					ele.appendChild(str);
			
					document.lease_apaman_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "9";
					var str = document.createTextNode("柳井港駅");
					ele.appendChild(str);
			
					document.lease_apaman_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "10";
					var str = document.createTextNode("柳井駅");
					ele.appendChild(str);
			
					document.lease_apaman_form.elements[elenum2].appendChild(ele);
				}
								break;
					case "2":
				devneko="";
				document.lease_apaman_form.elements[elenum2].length=0;
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "2";
					var str = document.createTextNode("岩国駅");
					ele.appendChild(str);
			
					document.lease_apaman_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "11";
					var str = document.createTextNode("川西駅");
					ele.appendChild(str);
			
					document.lease_apaman_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "12";
					var str = document.createTextNode("御庄駅");
					ele.appendChild(str);
			
					document.lease_apaman_form.elements[elenum2].appendChild(ele);
				}
								break;
					case "3":
				devneko="";
				document.lease_apaman_form.elements[elenum2].length=0;
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "2";
					var str = document.createTextNode("岩国駅");
					ele.appendChild(str);
			
					document.lease_apaman_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "11";
					var str = document.createTextNode("川西駅");
					ele.appendChild(str);
			
					document.lease_apaman_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "13";
					var str = document.createTextNode("西岩国駅");
					ele.appendChild(str);
			
					document.lease_apaman_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "14";
					var str = document.createTextNode("柱野駅");
					ele.appendChild(str);
			
					document.lease_apaman_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "15";
					var str = document.createTextNode("欽明路駅");
					ele.appendChild(str);
			
					document.lease_apaman_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "16";
					var str = document.createTextNode("玖珂駅 ");
					ele.appendChild(str);
			
					document.lease_apaman_form.elements[elenum2].appendChild(ele);
				}
								break;
					default:
				document.lease_apaman_form.elements[elenum2].length=0;
				var ele = document.createElement("option");
				ele.value = "0";
				var str = document.createTextNode("駅を選択してください");
				ele.appendChild(str);
				document.lease_apaman_form.elements[elenum2].appendChild(ele);
	}
}

function  gotolist() {
	location.replace("index.php?PID=re_c3");
}

</script>
<TABLE width="700"  border="0" align="left" cellpadding="3" cellspacing="1" class="realestate_bgcolor1">
		<TR class="realestate_bgcolor2">
				<TD valign="top">
						<form action="" method="post" enctype="multipart/form-data" name="lease_apaman_form">
								<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="border">
										<tr>
												<td width="15" bgcolor="#CCCCCC">&nbsp; </td>
												<td>
														<table width="100%"  border="0" cellspacing="0" cellpadding="5">
																<tr>
																		<td bgcolor="#FFFFFF" class="font10">
																				<p>事業用物件削除 </font> </p>
																		</td>
																</tr>
														</table>
												</td>
										</tr>
								</table>
								<br>
								<table width="692" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right">種目</div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"> <?php echo 	$re1data["syumoku"]; ?> </td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right" class="font14">物件名称</div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"> <?php echo $re1data["bukken_mei"];?> </td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right" class="font14">物件フリガナ</div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"> <?php echo $re1data["bukken_hurigana"];?> </td>
										</tr>
										<tr>
												<td width="150" rowspan="2" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right" class="font14">物件所在地 </div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"> <?php echo $re1data["yubinbangou"];?> </td>
										</tr>
										<tr>
												<td bgcolor="#FFFFFF" class="font12"> <?php echo $re1data["todouhuken"];?> <?php echo $re1data["jyusyo1"];?> <br />
														<?php echo $re1data["jyusyo2"];?> <?php echo $re1data["jyusyo3"];?> <br />
												</td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right" class="font14">賃料</div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"> <?php echo $re1data["kakaku"];?> 万
														円 </td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right"><strong class="font14">沿線 </div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"> <?php echo $re1data["ensen"];?> </td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right"><strong class="font14">駅名 </div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"> <?php echo $re1data["eki"];?> </td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right"><strong class="font14">徒歩 </div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"> <?php echo $re1data["ekiho"];?> 分 </td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right"><strong class="font14">バス </div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"> <?php echo $re1data["basu"];?> 分 バス停名 <?php echo $re1data["basutei"];?> から 徒歩 <?php echo $re1data["basu_ho"];?> 分 </td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right"><strong class="font14">車 </div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"> <?php echo $re1data["kuruma"];?> 分 <?php echo $re1data["kyori"];?>m </td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right" class="font14">構造 </div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"> <?php echo $re1data["kouzou"];?> </td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right"><font color="#000000">物件階層</font></div>
												</td>
												<td bgcolor="#FFFFFF" class="font12">地上 <?php echo $re1data["chijoukaisou"];?> 階<br />
														地下 <?php echo $re1data["chikakaisou"];?> 階<br />
														所在 <?php echo $re1data["kaisou"];?> 階 </td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right" class="font14">築年月</div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"> <span> <?php echo $re1data["chiku_nen"];?> 年 <?php echo $re1data["chiku_tsuki"];?> 月 </span> </td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right" class="font14">敷金</div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"> <span class="realestate_bgcolor3"> <?php echo $re1data["shikikin"];?> ヶ月 </span> <span class="realestate_bgcolor3"> <?php echo $re1data["sikikintani"];?> 万円</span></td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right" class="font14">礼金</div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"> <span class="realestate_bgcolor3"> <?php echo $re1data["reikin"];?> ヶ月 <?php echo $re1data["reikin_tani"];?> 万円 </span> </td>
										</tr>
										<tr>
												<td width="150" height="31" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right">共益費</div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"> <span class="realestate_bgcolor3"> <?php echo $re1data["kyouekihi"];?> 円 </span> </td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right" class="font14">駐車場</div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"> <?php echo $re1data["chusyajou"];?> <?php echo $re1data["chusya_ryoukin"];?> 円</td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right"><font color="#000000">償却金 </font></div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"> <?php echo $re1data["hosyoukin_syoukyaku"];?> 円 </td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right" class="font14">専有面積 </div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"> <?php echo $re1data["senyumenseki"];?> m<sup>2</sup> </td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right" class="font14">バルコニー面積 </div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"> <?php echo $re1data["barukoni_menseki"];?> m<sup>2</sup> </td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right" class="font14">間取り </div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"> <?php echo $re1data["madori"];?> <?php echo $re1data["madori_tani"];?> </td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right" class="font14">間取り詳細</div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"> <?php echo $re1data["madori_syousai"];?> </td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right" class="font14">取引態様</div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"> <?php echo $re1data["torihikitaiyou"];?> </td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right" class="font14">写真１ </div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"> 
														<?php if($re1data["photo1"]!=NULL) {?>
														<img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo1"];?>" />
														<?php }
																		?>
												</td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right" class="font14">写真２ </div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"> 
														<?php if($re1data["photo2"]!=NULL) {?>
														<img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo2"];?>" />
														<?php }
																		?>
												</td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right" class="font14">写真３ </div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"> 
														<?php if($re1data["photo3"]!=NULL) {?>
														<img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo3"];?>" />
														<?php }
																		?>
												</td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right" class="font14">写真４</div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"> 
														<?php if($re1data["photo4"]!=NULL) {?>
														<img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo4"];?>" />
														<?php }
																		?>
												</td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right" class="font14">写真５ </div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"> 
														<?php if($re1data["photo5"]!=NULL) {?>
														<img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo5"];?>" />
														<?php }	?>
												</td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right" class="font14">間取図1 </div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"> 
														<?php if($re1data["madorizu1"]!=NULL) {?>
														<img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["madorizu1"];?>" />
														<?php }
																		?>
												</td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right" class="font14">間取図2</div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"> 
														<?php if($re1data["madorizu2"]!=NULL) {?>
														<img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["madorizu2"];?>" />
														<?php }
																		?>
												</td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right" class="font14">現況</div>
												</td>
												<td bgcolor="#FFFFFF" class="font12">  <?php echo $re1data["genkyou"];?> </td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right">入居可能日 </div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"> <?php echo $re1data["hikiwatashi"];?> <?php echo $re1data["hikiwatashi_nen"];?> 年 <?php echo $re1data["hikiwatashi_tsuki"];?> 月 <?php echo $re1data["hikiwatashi_syun"];?> </td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right"><strong class="font14">室内設備</div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"> 
														<?php if($re1data["setsubi_naka1"]==1){ ?>
														<img src="http://fudousan.itcube.ne.jp/img/icon/gas.jpg" alt="給湯" width="38" height="38" />
														<?php }?>
														<?php if($re1data["setsubi_naka2"]==1){ ?>
														<img src="http://fudousan.itcube.ne.jp/img/icon/coldstorage.jpg" width="38" height="38" />
														<?php }?>
														<?php if($re1data["setsubi_naka3"]==1){ ?>
														<img src="http://fudousan.itcube.ne.jp/img/icon/denka.jpg" width="38" height="38" />
														<?php }?>
														<?php if($re1data["setsubi_naka4"]==1){ ?>
														<img src="http://fudousan.itcube.ne.jp/img/icon/light.jpg" width="38" height="38" />
														<?php }?>
														<?php if($re1data["setsubi_naka5"]==1){ ?>
														<img src="http://fudousan.itcube.ne.jp/img/icon/usen.jpg" width="38" height="38" />
														<?php }?>
														<?php if($re1data["setsubi_naka6"]==1){ ?>
														<img src="http://fudousan.itcube.ne.jp/img/icon/catv.jpg" width="38" height="38" />
														<?php }?>
														<?php if($re1data["setsubi_naka7"]==1){ ?>
														<img src="http://fudousan.itcube.ne.jp/img/icon/internet.jpg" width="38" height="38" />
														<?php }?>
														<?php if($re1data["setsubi_naka8"]==1){ ?>
														<img src="http://fudousan.itcube.ne.jp/img/icon/tv.jpg" width="38" height="38" />
														<?php }?>
														<?php if($re1data["setsubi_naka9"]==1){ ?>
														<img src="http://fudousan.itcube.ne.jp/img/icon/floor.jpg" width="38" height="38" />
														<?php }?>
														<?php if($re1data["setsubi_naka10"]==1){ ?>
														<img src="http://fudousan.itcube.ne.jp/img/icon/systemkichen5.jpg" width="38" height="38" />
														<?php }?>
														<?php if($re1data["setsubi_naka11"]==1){ ?>
														<img src="http://fudousan.itcube.ne.jp/img/icon/indoor.jpg" width="38" height="38" />
														<?php }?>
														<?php if($re1data["setsubi_naka12"]==1){ ?>
														<img src="http://fudousan.itcube.ne.jp/img/icon/wash.jpg" width="38" height="38" />
														<?php }?>
														<?php if($re1data["setsubi_naka13"]==1){ ?>
														<img src="http://fudousan.itcube.ne.jp/img/icon/separate.jpg" width="38" height="38" />
														<?php }?>
														<?php if($re1data["setsubi_naka14"]==1){ ?>
														<img src="http://fudousan.itcube.ne.jp/img/icon/shower.jpg" width="38" height="38" />
														<?php }?>
														<?php if($re1data["setsubi_naka15"]==1){ ?>
														<img src="http://fudousan.itcube.ne.jp/img/icon/shanp.jpg" width="38" height="38" />
														<?php }?>
														<?php if($re1data["setsubi_naka16"]==1){ ?>
														<?php }?>
														<?php if($re1data["setsubi_naka17"]==1){ ?>
														<?php }?>
														<?php if($re1data["setsubi_naka18"]==1){ ?>
														<?php }?>
														<?php if($re1data["setsubi_naka19"]==1){ ?>
														<?php }?>
														<?php if($re1data["setsubi_naka20"]==1){ ?>
														<?php }?>
												</td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right"><strong class="font14">室外・その他設備 </div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"> 
														<?php if($re1data["setsubi_soto1"]==1){ ?>
														<img src="http://fudousan.itcube.ne.jp/img/icon/park_bcl.jpg" width="38" height="38" />
														<?php }?>
														<?php if($re1data["setsubi_soto2"]==1){ ?>
														<img src="http://fudousan.itcube.ne.jp/img/icon/park_car.jpg" width="38" height="38" />
														<?php }?>
														<?php if($re1data["setsubi_soto3"]==1){ ?>
														<img src="http://fudousan.itcube.ne.jp/img/icon/autolock.jpg" width="38" height="38" />
														<?php }?>
														<?php if($re1data["setsubi_soto4"]==1){ ?>
														<img src="http://fudousan.itcube.ne.jp/img/icon/ev.jpg" width="38" height="38" />
														<?php }?>
														<?php if($re1data["setsubi_soto5"]==1){ ?>
														<img src="http://fudousan.itcube.ne.jp/img/icon/post.jpg" width="38" height="38" />
														<?php }?>
														<?php if($re1data["setsubi_soto6"]==1){ ?>
														<?php }?>
														<?php if($re1data["setsubi_soto7"]==1){ ?>
														<?php }?>
														<?php if($re1data["setsubi_soto8"]==1){ ?>
														<?php }?>
														<?php if($re1data["setsubi_soto9"]==1){ ?>
														<?php }?>
														<?php if($re1data["setsubi_soto10"]==1){ ?>
														<?php }?>
												</td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right"><strong class="font14">条件</div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"> 
														<?php if($re1data["jouken1"]==1){ ?>
														<img src="http://fudousan.itcube.ne.jp/img/icon/company.jpg" width="38" height="38" />
														<?php }?>
														<?php if($re1data["jouken2"]==1){ ?>
														<img src="http://fudousan.itcube.ne.jp/img/icon/woman.jpg" width="38" height="38" />
														<?php }?>
														<?php if($re1data["jouken3"]==1){ ?>
														<img src="http://fudousan.itcube.ne.jp/img/icon/pet.jpg" width="38" height="38" />
														<?php }?>
														<?php if($re1data["jouken4"]==1){ ?>
														<img src="http://fudousan.itcube.ne.jp/img/icon/piano.jpg" width="38" height="38" />
														<?php }?>
														<?php if($re1data["jouken5"]==1){ ?>
														<?php }?>
														<?php if($re1data["jouken6"]==1){ ?>
														<?php }?>
														<?php if($re1data["jouken7"]==1){ ?>
														<?php }?>
														<?php if($re1data["jouken8"]==1){ ?>
														<?php }?>
														<?php if($re1data["jouken9"]==1){ ?>
														<?php }?>
														<?php if($re1data["jouken10"]==1){ ?>
														<?php }?>
												</td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right">お勧め</div>
												</td>
												<td bgcolor="#FFFFFF" class="font12">&nbsp;</td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right">公開用備考</div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"> <span class="realestate_bgcolor3"> <?php echo $re1data["bikou"];?> </span> </td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right">非公開用備考</div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"> <span class="realestate_bgcolor3"> <?php echo $re1data["admin_bikou"];?> </span> </td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">&nbsp; </td>
												<td bgcolor="#FFFFFF" class="font12"> 
														<input name="delete_re" type="submit" id="delete_re" value="削除する" />
														<input type="reset" name="Submit" value="リセット" />
														<span class="realestate_bgcolor3">
														<input name="btm" type="button" id="btm" onclick="gotolist()" value="一覧へ戻る" />
														</span>
														<input name="bid" type="hidden" id="bid" value="<?php echo $_REQUEST["bid"];?>" />
												</td>
										</tr>
								</table>
						</form>
				</TD>
		</TR>
</TABLE>
