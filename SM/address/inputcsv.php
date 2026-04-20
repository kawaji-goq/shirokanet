<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<?php

@unlink($_SERVER['DOCUMENT_ROOT']."/tmp/address.csv");
if($_REQUEST["btm_upfile"]=="アドレス登録") {
	$upobj=new Upload();
	$upobj->fdata=$_FILES["address"];
	$upobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/";
	$upobj->rpath="/tmp/";
	$upobj->newname="address.csv";
	$res=$upobj->Upfile("");
	$fdata=@file($_SERVER['DOCUMENT_ROOT']."/tmp/address.csv");
	$maxid=1;
	$maxid2=1;
	$dbobj->Query("delete from company_addressbook where inputcsv = 1");
	$dbobj->Query("delete from company_tantou where inputcsv = 1");
	
	for($i=1;$fdata[$i]!=NULL;$i++){		
		
		$rowdata=explode(",",mb_convert_encoding(str_replace(", N","、N",str_replace("\"","",$fdata[$i])),"EUCJP","SJIS"));
		$maxdata=$dbobj->GetData("select max(company_id) as maxid from company_addressbook");
		$maxid=1+$maxdata["maxid"];
		
		$sql="insert into company_addressbook (company_id,company_name,company_yomi,zipcode,address,telnumber,faxnumber,turn,shortname,inputcsv)
			values(".$maxid.",'".$rowdata[16]."','".mb_convert_kana($rowdata[15],"HV")."','".$rowdata[19]."','".$rowdata[20].$rowdata[21]."','".$rowdata[23]."','".$rowdata[24]."',".$maxid.",'".str_replace("株式会社","",str_replace("有限会社","",$rowdata[16]))."',1)";			
		$res=$dbobj->Query($sql);
		//echo "<br>";
		if($res){
				$maxdata2=$dbobj->GetData("select max(tantou_id) as maxid from company_tantou");
				$maxid2=1+$maxdata2["maxid"];
				$sql2="insert into company_tantou (tantou_id,company_id,tantou_name,tantou_post,tantou_telnumber,tantou_yomi,inputcsv)
					values(".$maxid2.",".$maxid.",'".$rowdata[2]."','".$rowdata[18]."','".$rowdata[14]."','".mb_convert_kana($rowdata[1],"HV")."',1)";
				$res2=$dbobj->Query($sql2);		
		//echo "<br>";
		}
		if(!$res2) {
				$errbid2[]=$rowdata[16]." ".$rowdata[2];
				//echo $sql."<br>";
				$errnum2++;
		}
	}
}
?>
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
                                    <p><font color="#000000"></font>アドレスデータ読み込み </p>
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
if($_REQUEST["btm_upfile"]=="アドレス登録") {	
	?>
                        <table width="700" border="0" align="center" cellpadding="3" cellspacing="0">
                            <tr>
                                <td><?php echo ($i-$errnum-1-$errnum2)."件のアドレスを登録しました。"; ?></td>
                            </tr>
                            <?php 	if($errnum!=0) {	?>
                            <tr>
                                <td><font color="#FF0000"><?php echo $errnum."件のアドレスが重複していた為登録出来ませんでした。"; ?></font></td>
                            </tr>
                            <?php 	}?>
                            <?php 	if($errnum2!=0) {	?>
                            <tr>
                                <td><font color="#FF0000"><?php echo $errnum2."件の物件のアドレスに失敗しました。"; ?><br />
                                    登録に失敗したアドレス<br />
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
                                    <td width="150" bgcolor="#EBEBEB">種類</td>
                                    <td bgcolor="#FFFFFF">
                                        <select name="bunrui" id="bunrui">
                                            <option value="1">筆まめデータ</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="150" bgcolor="#EBEBEB">CSVファイル</td>
                                    <td bgcolor="#FFFFFF">
                                        <input name="address" type="file" id="address" />
                                    </td>
                                </tr>
                                
                                
                                <tr>
                                    <td width="150" bgcolor="#EBEBEB">&nbsp;</td>
                                    <td bgcolor="#FFFFFF">
                                        <input name="btm_upfile" type="submit" id="btm_upfile" value="アドレス登録" />
                                        <input type="button" name="Submit" value="戻る" onClick="location.href='?PID=address'">
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
