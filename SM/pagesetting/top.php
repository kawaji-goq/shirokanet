<?php
if($_REQUEST["menu_up"]=="更新する") {

	for($i=0;$_REQUEST["menuid"][$i]!=NULL;$i++) {
		if($_REQUEST["turn"][$i]==NULL) {
				$_REQUEST["turn"][$i]=0;
		}
		$dbobj->Query("update menu_data set turn =".$_REQUEST["turn"][$i].",data_name= '".$_REQUEST["title"][$i]."',use_chk=".$_REQUEST["use_chk"][$i]." where data_id=".$_REQUEST["menuid"][$i]);
	}
	if($_REQUEST["new_contents"]!="--") {
			$maxdata=$dbobj->GetData("select max(data_id) as maxid from menu_data");
			$maxid=1+$maxdata["maxid"];
			
			switch($_REQUEST["new_contents"]) {
				case "contents":
					$contmaxdata=$dbobj->GetData("select max(cate_id) as maxid from info1_cate");
					$contmaxid=1+$contmaxdata["maxid"];
					$dbobj->Query("insert into menu_data(data_id,data_name,data_comm,turn,data_code,use_chk) ".
																			" values (".$maxid.",'".$_REQUEST["new_title"]."','".$contmaxid."',".$maxid.",'contents',1)");
					break;
				case "banner":
					$contmaxdata=$dbobj->GetData("select max(data_id) as maxid from banner_data");
					$contmaxid=1+$contmaxdata["maxid"];
					$dbobj->Query("insert into menu_data(data_id,data_name,data_comm,turn,data_code,use_chk) ".
																			" values (".$maxid.",'".$_REQUEST["new_title"]."','".$contmaxid."',".$maxid.",'banner',1)");
					
					break;
					
			}
	}
}
if($_REQUEST["pmode"]=="delete") {	
		$deldata=$dbobj->GetData("select * from menu_data where data_id =".$_REQUEST["delid"]);
		switch($deldata["data_code"]) {
					case "banner":
						$dbobj->Query("delete from banner_data where data_id = ".$daldata["data_comm"]);
						break;			
		}
		$dbobj->Query("delete from menu_data where data_id = ".$_REQUEST["delid"]);
		
}

$pmenulist=$dbobj->GetList("select * from menu_data order by turn");
?>
<script language="javascript">
function delchk(name,id) {
	var res=confirm(name+"を削除してもよろしいですか？");
	
	if(res) {
		location.href="?PID=pagesetting&pmode=delete&delid="+id;
	}
	
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<form name="form1" method="post" action="">
    <table width="700" border="0" cellspacing="1" cellpadding="2">
        <tr>
            <td><strong>メインメニューの編集</strong></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        
        <tr>
            <td><strong>メニュー一覧</strong></td>
        </tr>
        <tr>
            <td>
                <table width="694" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
                    <tr>
                        <td width="51" bgcolor="#ECECEC">
                            <div align="center"><strong>表示順</strong></div>
                        </td>
                        <td width="442" bgcolor="#ECECEC"><strong>メニュー名</strong></td>
                        <td width="43" bgcolor="#ECECEC">
                            <div align="center"><strong>編集</strong></div>
                        </td>
                        <td width="89" bgcolor="#ECECEC">
                            <div align="center"><strong>公開設定</strong></div>
                        </td>
                        <td width="43" bgcolor="#ECECEC">
                            <div align="center"><strong>削除</strong></div>
                        </td>
                    </tr>
                    <?php
																for($pmi=0;$pmenulist[$pmi]["data_id"]!=NULL;$pmi++) {
																?>
                    <tr>
                        <td bgcolor="#FFFFFF">
                            <div align="center">
                                <input name="turn[<?php echo $pmi;?>]" type="text" id="turn[<?php echo $pmi;?>]" size="4" value="<?php echo $pmenulist[$pmi]["turn"];?>">
                                </div>
                        </td>
                        <td bgcolor="#FFFFFF">
                            <input name="title[<?php echo $pmi;?>]" type="text" id="title[<?php echo $pmi;?>]" value="<?php echo $pmenulist[$pmi]["data_name"];?>" style="width:95%">
                            <input name="menuid[<?php echo $pmi;?>]" type="hidden" id="menuid[<?php echo $pmi;?>]" value="<?php echo $pmenulist[$pmi]["data_id"];?>">
                        </td>
                        <td bgcolor="#FFFFFF">
                            <input type="button" name="Submit" value="編集" onClick="location.href='?PID=<?php 
																												switch($pmenulist[$pmi]["data_code"]) {
																												case "contents":
																														echo $pmenulist[$pmi]["data_code"]."_category";
																														echo "\&contents_id=".$pmenulist[$pmi]["data_comm"];
																														break;
																													case "banner":
																														echo $pmenulist[$pmi]["data_code"];
																														echo "\&data_id=".$pmenulist[$pmi]["data_comm"];
																													break;
																													default:
																														echo $pmenulist[$pmi]["data_code"];

																													break;
																												}
																												?>'">
                        </td>
                        <td bgcolor="#FFFFFF">
                            <select name="use_chk[<?php echo $blogrow; ?>]">
                                <option value="1"<?php if($pmenulist[$pmi]["use_chk"]==1) {echo " selected";}?>>公開する</option>
                                <option value="0"<?php if($pmenulist[$pmi]["use_chk"]==0) {echo " selected";}?>>公開しない</option>
                            </select>
                        </td>
                        <td bgcolor="#FFFFFF"><?php
																								if($pmenulist[$pmi]["data_code"]=="banner"||$pmenulist[$pmi]["data_code"]=="contents") {?>
                            <input type="button" name="Submit" value="削除" onclick="delchk('<?php $pmenulist[$pmi]["title"]; ?>','<?php echo $pmenulist[$pmi]["data_id"];?>')" /><?php }
																												?>
                        </td>
                    </tr>
                    <?php
																}
																?>
                </table>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>
                <table width="700" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
                    <tr>
                        <td bgcolor="#ECECEC"><strong>新規追加</strong></td>
                    </tr>
                    <tr>
                        <td bgcolor="#FFFFFF">
                            <select name="new_contents" id="new_contents">
                                <option selected>--</option>
                                <option value="contents">基本コンテンツ</option>
                                <option value="banner">バナー</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#FFFFFF">
                            <input name="new_title" type="text" id="new_title" size="40">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>
                <input type="Submit" name="menu_up" value="更新する">
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
    </table>
</form>
