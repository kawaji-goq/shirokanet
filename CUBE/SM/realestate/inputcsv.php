<?php
function str_delnum($txt) {
	for($i=0;$i<10;$i++){
		$txt=str_replace($i,"",$txt);
	}
	return $txt;
}


if($_POST["btm_upfile"]=="物件登録") {
	$dbobj->Query("update bukken_setting set reg_chk=".$_REQUEST["reg_chk"]."");
	$bsetdata=$dbobj->GetData("select * from bukken_setting");

	if($_REQUEST["upchk"]==1) {
		$delsql="delete from bukken where bunrui = '".$_REQUEST["bunrui"]."' and rains_chk=1";
		$dbobj->Query($delsql);
	}
	
	$errnum=0;
	$errnum2=0;
	$errbid2="";
	
	$upobj=new Upload();
	$upobj->fdata=$_FILES["csvfile"];
	$upobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/";
	$upobj->rpath="/tmp/";
	$upobj->newname="csvfile.csv";
	$res=$upobj->Upfile("csvfile");
	$fdata=@file($_SERVER['DOCUMENT_ROOT']."/tmp/csvfile.csv");
	@unlink($_SERVER['DOCUMENT_ROOT']."/tmp/csvfile.csv");
	
	
	for($i=1;$fdata[$i]!=NULL;$i++) {
		unset($tbary);
		unset($dataary);
		unset($csvdata);
			$tbary[]="bukkenn_id";
			$tbary[]="tourokubi";
			$tbary[]="kaiin_shougou";
			$tbary[]="kaiin_denwa";
			$tbary[]="syumoku";
			$tbary[]="shinchiku";
			$tbary[]="syozaichikodo";
			$tbary[]="jyusyo1";
			$tbary[]="jyusyo2";
			$tbary[]="jyusyo3";
			$tbary[]="bukken_mei";
			$tbary[]="heya_bangou";
			$tbary[]="ensen";
			$tbary[]="eki";
			$tbary[]="kyori";
			$tbary[]="ekiho";
			$tbary[]="basu";
			$tbary[]="basutei";
			$tbary[]="basu_hun";
			$tbary[]="basu_ho";
			$tbary[]="syougakkouku";
			$tbary[]="chuugakouku";
			$tbary[]="kakaku";
			$tbary[]="syouhizei_kubun";
			$tbary[]="shikikin";
			$tbary[]="sikikintani";
			$tbary[]="shikibiki_kakaku";
			$tbary[]="shikibiki_tsuki";
			$tbary[]="shikibiki_jippi";
			$tbary[]="hosyoukin_kikan";
			$tbary[]="hosyoukin_kakaku";
			$tbary[]="hosyoukin_syoukyaku";
			$tbary[]="hosyoukin_syoukyaku_per";
			$tbary[]="kenrikin";
			$tbary[]="zousajouto";
			$tbary[]="kanrihi";
			$tbary[]="syuzenhi_tsumitate";
			$tbary[]="kyouekihi";
			$tbary[]="zappi";
			$tbary[]="syakuchisyou";
			$tbary[]="tsubotanka";
			$tbary[]="tochi_kenri";
			$tbary[]="menseki";
			$tbary[]="shidoumenseki";
			$tbary[]="keisoku_houshiki";
			$tbary[]="senyumenseki";
			$tbary[]="barukoni_menseki";
			$tbary[]="barukoni_houkou";
			$tbary[]="syakutiken_syurui";
			$tbary[]="tatemono_chintaisyaku_kubun";
			$tbary[]="kouzou";
			$tbary[]="chijoukaisou";
			$tbary[]="chikakaisou";
			$tbary[]="kaisou";
			$tbary[]="kosu";
			$tbary[]="chiku_nen";
			$tbary[]="chiku_tsuki";
			$tbary[]="madori";
			$tbary[]="madori_syousai";
			$tbary[]="kenpei_ritsu";
			$tbary[]="youseki_ritsu";
			$tbary[]="chimoku";
			$tbary[]="toshikeikaku";
			$tbary[]="youtochiiki";
			$tbary[]="saitekiyouto";
			$tbary[]="kokudohou";
			$tbary[]="genkyou";
			$tbary[]="hikiwatashi";
			$tbary[]="hikiwatashi_nen";
			$tbary[]="hikiwatashi_tsuki";
			$tbary[]="hikiwatashi_syun";
			$tbary[]="setsudou1";
			$tbary[]="setsudou2";
			$tbary[]="setsudou3";
			$tbary[]="setsudou_joukyou";
			$tbary[]="chusyajou";
			$tbary[]="chusya_ryoukin";
			$tbary[]="chusya_shikikin_kikan";
			$tbary[]="chusya_shikikin_kakaku";
			$tbary[]="bikou";
			$tbary[]="jouken";
			$tbary[]="kensetsukakunin";
			$tbary[]="tokki1";
			$tbary[]="tokki2";
			$tbary[]="tokki3";
			$tbary[]="tokki4";
			$tbary[]="tokki5";
			$tbary[]="hokankanyugimu";
			$tbary[]="hokenkikan";
			$tbary[]="hokenkingaku";
			$tbary[]="torihikitaiyou";
			$tbary[]="tesuryou_hutan_kashi";
			$tbary[]="tesuryou_hutan_kari";
			$tbary[]="tesuryou_haibun_moto";
			$tbary[]="tesuryou_haibun_kyaku";
			$tbary[]="housyu_keitai";
			$tbary[]="tesuryou_ritsu";
			$tbary[]="tesuryou_kingaku";
			$tbary[]="keiyaku_kikan";
			$tbary[]="seiyaku_bi";
			$tbary[]="seiyaku_kakaku";
			$tbary[]="madori_tani";
			$tbary[]="bunrui";

		$csvdata=str_replace("\n","",str_replace("\r","",mb_convert_encoding($fdata[$i],"euc-jp","sjis")));
		
		for($y=0;substr_count($csvdata,"\"")!=0;$y++) {
			$s1=strpos($csvdata,"\"",0);
			//echo ",";
			$s2=strpos($csvdata,"\"",$s1+1);
			//echo ",";
			$oldtxt=substr($csvdata,$s1,$s2-$s1+1);
			$newtxt=str_replace(",","、",$oldtxt);
			$newtxt=str_replace("\"","",$newtxt);
			$csvdata=str_replace($oldtxt,$newtxt,$csvdata);
			if($y>200) {
				//echo "outobrange<br>";
				break;
			}
			//echo "\n";
		}
		
		$dataary=explode(",",str_replace("\"","",$csvdata));
		$sql="select * from bukken where bukkenn_id = '".$dataary[0]."'";
		$res=$dbobj->Query($sql);
		$numrows=$dbobj->NumRows($res);
		
		if($_REQUEST["upchk"]==1) {
			$delsql="delete from bukken where bukkenn_id = '".$dataary[0]."'";
			$dbobj->Query($delsql);
			$numrows=0;
		}
			if(count($dataary)<101){
				$c=101-count($dataary);
				for($l=0;$l<$c;$l++){
					$dataary[]="";
				}
			}
//			echo count($dataary);
//			echo "<br>";
		if($numrows==0) {
		
			for($x=0;$x<=101;$x++){
				$dataary[$x]=str_replace(" ","",str_replace("　","",$dataary[$x]));
				if($i==50&&$x==1){ 
				//print_r($dataary);
				}
				switch($x){
					case 14:
						if(trim($dataary[$x])==NULL){
							$dataary[$x]="null";
						}
						break;
					case 15:
						if(trim($dataary[$x])==NULL){
							$dataary[$x]="null";
						}
						break;
					case 18:
						if(trim($dataary[$x])==NULL){
							$dataary[$x]="null";
						}
						break;
					case 19:
						if(trim($dataary[$x])==NULL){
							$dataary[$x]="null";
						}
						break;
					case 22:
						if(trim($dataary[$x])==NULL){
							$dataary[$x]="null";
						}
						
						break;
					case 24:
						if(trim($dataary[$x])==NULL){
							$dataary[$x]="null";
						}
						
						break;
					case 26:
						if(trim($dataary[$x])==NULL){
							$dataary[$x]="null";
						}
						
						break;
					case 27:
						if(trim($dataary[$x])==NULL){
							$dataary[$x]="null";
						}
						
						break;
					case 28:
						if(trim($dataary[$x])==NULL){
							$dataary[$x]="null";
						}
						
						break;
					case 37:
						if(trim($dataary[$x])==NULL){
							$dataary[$x]="null";
						}
						
						break;
					case 40:
						if(trim($dataary[$x])==NULL){
							$dataary[$x]="null";
						}
						
						break;
					case 42:
						if(trim($dataary[$x])==NULL){
							$dataary[$x]="null";
						}
						
						break;
					case 55:
						if(trim($dataary[$x])==NULL){
							$dataary[$x]="null";
						}
						
						break;
					case 56:
						if(trim($dataary[$x])==NULL){
							$dataary[$x]="null";
						}
						
						break;
					case 57:
						if(trim($dataary[$x])==NULL){
							$dataary[$x]="null";
							$dataary[101]="''";
						}
						else {
								$dataary[101]="'".str_replace("0","",str_replace("1","",str_replace("2","",str_replace("3","",str_replace("4","",str_replace("5","",str_replace("6","",str_replace("7","",str_replace("8","",str_replace("9","",$dataary[$x]))))))))))."'";
								$dataary[$x]=str_replace("L","",str_replace("D","",str_replace("K","",str_replace("S","",str_replace("ROOM","",$dataary[$x])))));
						
						}
						
						break;
					case 60:
						if(trim($dataary[$x])==NULL){
							$dataary[$x]="null";
						}
					
						break;
			/*		case 61:
						if(trim($dataary[$x])==NULL){
							$dataary[$x]="null";
						}
						break;
			*/	
				case 98:
						if(trim($dataary[$x])==NULL){
							$dataary[$x]="null";
						}
						break;
			
				case 99:
						if(trim($dataary[$x])==NULL){
							$dataary[$x]="null";
						}
						break;
					case 100:
						if(trim($dataary[100])==NULL){
							$dataary[100]="null";
						}
						
						break;
					case 101:
						if(trim($dataary[101])==NULL){
						//	$dataary[$x]="null";
						}
						break;
					default:
							$dataary[$x]="'".$dataary[$x]."'";
						break;
						
				}
			}
			
			$dataary[102]=$_REQUEST["bunrui"];
			
			if($dataary[101]=="") {
				//$dataary[$x]="''";
			}

			$shikugun=$dataary[7];
			$choumei=str_delnum(mb_convert_kana(str_replace("丁目","",$dataary[8]),"n"));
			$choume="''";
			$banchi=$dataary[9];
			
			$maxdata=$dbobj->GetData("select max(id) as maxid from bukken");
			$maxid=1+$maxdata["maxid"];
			
		  $sql="insert into bukken(id,kaiin_id,".implode(",",$tbary).",keyword,del_chk,shikugun,choumei,choume,banchi,rains_chk) values(".$maxid.",'".$_SESSION["login_id"]."',".implode(",",$dataary).",'".str_replace("null","",str_replace("'","",str_replace("\"","",implode("",$dataary))))."',".$bsetdata["reg_chk"].",".$shikugun.",".$choumei.",".$choume.",".$banchi.",1)";
			
			if($dataary[0]=="'55978'") {
				//echo $sql;
				
			}
			//echo implode(",",$dataary)."\n";
			$res=$dbobj->Query($sql);
			if(!$res) {
				$errbid2[]=$dataary[0];
				//echo $sql."<br>";
				$errnum2++;
			}
			
		}
		else {
			$errnum++;
		}
	}
}
	$bsetdata=$dbobj->GetData("select * from bukken_setting");

?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
				<td colspan="2">
						<table width="700"  border="0" align="left" cellpadding="0" cellspacing="0" class="border">
								<tr>
										<td width="15" bgcolor="#CCCCCC">&nbsp; </td>
										<td>
												<table width="100%"  border="0" align="center" cellpadding="5" cellspacing="0">
														<tr>
																<td bgcolor="#FFFFFF" class="font10">
																		<p><font color="#000000"></font>レインズデータ読み込み </p>
																</td>
														</tr>
												</table>
										</td>
								</tr>
						</table>
				</td>
		</tr>
		<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
		</tr>
		<tr>
				<td colspan="2">
						<table border="0" cellspacing="0" cellpadding="0">
								<tr>
										<td>
												<?php
if($_POST["btm_upfile"]=="物件登録") {

	
	?>
												<table width="700" border="0" align="center" cellpadding="3" cellspacing="0">
														<tr>
																<td><?php echo ($i-$errnum-1-$errnum2)."件の物件を登録しました。"; ?></td>
														</tr>
														<?php 	if($errnum!=0) {	?>
														<tr>
																<td><font color="#FF0000"><?php echo $errnum."件の物件が重複していた為登録出来ませんでした。"; ?></font></td>
														</tr>
														<?php 	}?>
														<?php 	if($errnum2!=0) {	?>
														<tr>
																<td><font color="#FF0000"><?php echo $errnum2."件の物件の登録に失敗しました。"; ?><br />
																		登録に失敗した物件<br />
																		<?php
for($l=0;$errbid2[$l]!=NULL;$l++) {
	echo $errbid2[$l]."<br />";
}
?>
																</font></td>
														</tr>
														<?php 	}?>
												</table>
												<div align="center">
												<?php
	
}
else {
?>
												<table width="700" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
														<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
																<tr>
																		<td width="150" bgcolor="#EBEBEB">種別</td>
																		<td bgcolor="#FFFFFF">
																				<select name="bunrui" id="bunrui">
																						<option value="1">賃貸物件</option>
																						<option value="2">売買物件</option>
																				</select>
																		</td>
																</tr>
																<tr>
																		<td width="150" bgcolor="#EBEBEB">物件ファイル</td>
																		<td bgcolor="#FFFFFF">
																				<input name="csvfile" type="file" id="csvfile" />
																		</td>
																</tr>
																<tr>
																		<td width="150" bgcolor="#EBEBEB">重複した物件データ</td>
																		<td bgcolor="#FFFFFF">
																				<select name="upchk" id="upchk">
																						<option value="0" selected="selected">上書きしない</option>
																						<option value="1">上書きする</option>
																				</select>
																		</td>
																</tr>
																<tr>
																    <td bgcolor="#EBEBEB">読み込み時の初期設定</td>
																    <td bgcolor="#FFFFFF"><span class="font12">
																        <select name="reg_chk" id="reg_chk">
                            <option value="1"<?php if($bsetdata["reg_chk"]==1) { echo " selected";}?>>非公開</option>
                            <option value="0"<?php if($bsetdata["reg_chk"]==0) { echo " selected";}?>>公開</option>
                        </select>
																    </span></td>
																    </tr>
																<tr>
																		<td width="150" bgcolor="#EBEBEB">&nbsp;</td>
																		<td bgcolor="#FFFFFF">
																				<input name="btm_upfile" type="submit" id="btm_upfile" value="物件登録" />
																		</td>
																</tr>
														</form>
												</table>
												<?php 
/*?>
		<font color="#FF0000">ただいまシステムメンテナンス中です。
<br>
			ご迷惑をお掛けいたしますがご協力をお願い致します</font>。<br>
			<font color="#FF0000">終了予定時間は12月13日の0時です。</font></div>
<font color="#FF0000">
<?php
*/
}
?>
												</font></td>
								</tr>
						</table>
				</td>
		</tr>
</table>
