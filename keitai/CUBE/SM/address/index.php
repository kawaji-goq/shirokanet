<?php
if($_GET["PAGE"]==NULL) {
	$_GET["PAGE"]=1;

}
$pagelimit=30;

$wheretxt="where company_name <>''";

if($_GET["initial"]!=NULL) {
		$wheretxt.=" and company_yomi like '".$_GET["initial"]."%'";
}

$maxpagesql="select count(company_id) as countnum from company_addressbook ".$wheretxt;
$maxpagedata=$dbobj->GetData($maxpagesql);
$maxpage=ceil($maxpagedata["countnum"]/$pagelimit);

$maxpagesql="select * from company_addressbook ".$wheretxt." order by company_code limit ".$pagelimit." offset ".(($_GET["PAGE"]-1)*$pagelimit);
$addresslist=$dbobj->GetList($maxpagesql);



?><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">

<style>
#address a:link,#address a:visited{
	color:#003366;
	font-size:14px;
}
#address a:hover,#address a:active{
	font-size:14px;
	color:#FF6600;
}
</style>
<div id="address">
    <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1">
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    
    <tr>
        <td width="220" valign="top">
            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#DCDCFF">
                            <tr>
                                <td bgcolor="#DCDCFF">
                                    <div align="center"><strong>50音[<a href="?PID=address_top">全て</a>]</strong></div>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" bgcolor="#FFFFFF">
                                    <table width="100%" border="0" cellpadding="5" cellspacing="0">
                                        <tr>
                                            <td bgcolor="#FFFFFF">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                                    <tr>
                                                        <td> 
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("あ") ?>">あ</a>]</div>
                                                        </td>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("い") ?>">い</a>]</div>
                                                        </td>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("う") ?>">う</a>]</div>
                                                        </td>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("え") ?>">え</a>]</div>
                                                        </td>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("お") ?>">お</a>]</div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("か") ?>">か</a>]</div>
                                                        </td>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("き") ?>">き</a>]</div>
                                                        </td>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("く") ?>">く</a>]</div>
                                                        </td>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("け") ?>">け</a>]</div>
                                                        </td>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("こ") ?>">こ</a>]</div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("さ") ?>">さ</a>]</div>
                                                        </td>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("し") ?>">し</a>]</div>
                                                        </td>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("す") ?>">す</a>]</div>
                                                        </td>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("せ") ?>">せ</a>]</div>
                                                        </td>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("そ") ?>">そ</a>]</div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("た") ?>">た</a>]</div>
                                                        </td>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("ち") ?>">ち</a>]</div>
                                                        </td>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("つ") ?>">つ</a>]</div>
                                                        </td>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("て") ?>">て</a>]</div>
                                                        </td>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("と") ?>">と</a>]</div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("な") ?>">な</a>]</div>
                                                        </td>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("に") ?>">に</a>]</div>
                                                        </td>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("ぬ") ?>">ぬ</a>]</div>
                                                        </td>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("ね") ?>">ね</a>]</div>
                                                        </td>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("の") ?>">の</a>]</div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("は") ?>">は</a>]</div>
                                                        </td>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("ひ") ?>">ひ</a>]</div>
                                                        </td>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("ふ") ?>">ふ</a>]</div>
                                                        </td>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("へ") ?>">へ</a>]</div>
                                                        </td>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("ほ") ?>">ほ</a>]</div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("ま") ?>">ま</a>]</div>
                                                        </td>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("み") ?>">み</a>]</div>
                                                        </td>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("む") ?>">む</a>]</div>
                                                        </td>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("め") ?>">め</a>]</div>
                                                        </td>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("も") ?>">も</a>]</div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("や") ?>">や</a>]</div>
                                                        </td>
                                                        <td>
                                                            <div align="center"></div>
                                                        </td>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("ゆ") ?>">ゆ</a>]</div>
                                                        </td>
                                                        <td>
                                                            <div align="center"></div>
                                                        </td>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("よ") ?>">よ</a>]</div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("ら") ?>">ら</a>]</div>
                                                        </td>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("り") ?>">り</a>]</div>
                                                        </td>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("る") ?>">る</a>]</div>
                                                        </td>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address&initial=<?php echo urlencode("れ") ?>">れ</a>]</div>
                                                        </td>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("ろ") ?>">ろ</a>]</div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div align="center">[<a href="?PID=address_top&initial=<?php echo urlencode("わ") ?>">わ</a>]</div>
                                                        </td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                </table>
</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" bgcolor="#FFFFFF"><a href="?PID=address_regist">新規にアドレスを追加する</a></td>
                            </tr>
                            <tr>
                                <td valign="top" bgcolor="#FFFFFF"><a href="?PID=address_inputcsv">CSVから登録する</a></td>
                            </tr>
                            <tr>
                                <td valign="top" bgcolor="#FFFFFF"><a href="?PID=address_tantou">担当者一覧</a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </td>
        <td valign="top">
            <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#DCDCFF">
                            <tr>
                                <td bgcolor="#DCDCFF"><strong>会社情報一覧</strong></td>
                            </tr>
                            <tr>
                                <td height="100" valign="top" bgcolor="#FFFFFF">
                                    <table width="100%" border="0" cellpadding="5" cellspacing="0">
                                        <tr>
                                            <td width="9%" nowrap bgcolor="#ececec">会社コード</td>
                                            <td width="23%" nowrap bgcolor="#ececec">会社名</td>
                                            <td width="32%" nowrap bgcolor="#ececec">所在地</td>
                                            <td width="12%" nowrap bgcolor="#ececec">
                                                <div align="left">電話番号</div>
                                            </td>
                                            <td width="14%" nowrap bgcolor="#ececec">
                                                <div align="center">FAX番号</div>
                                            </td>
                                            <td width="5%" nowrap bgcolor="#ececec">
                                                <div align="center">編集</div>
                                            </td>
                                            <td width="5%" nowrap bgcolor="#ececec">
                                                <div align="center">削除</div>
                                            </td>
                                        </tr>
                                        <?php 
			
				for($comrows=0;$addresslist[$comrows]["company_id"]!=NULL;$comrows++) {
				?>
                                        <tr>
                                            <td bgcolor="#FFFFFF"><a href="?PID=address_update&company_id=<?php echo $addresslist[$comrows]["company_id"] ?>"><?php echo $addresslist[$comrows]["company_code"] ?></a></td>
                                            <td nowrap bgcolor="#FFFFFF"><a href="?PID=address_update&company_id=<?php echo $addresslist[$comrows]["company_id"] ?>"><?php echo $addresslist[$comrows]["company_name"] ?></a></td>
                                            <td nowrap bgcolor="#FFFFFF"><?php echo $addresslist[$comrows]["address"] ?></td>
                                            <td bgcolor="#FFFFFF"><?php echo $addresslist[$comrows]["telnumber"] ?></td>
                                            <td bgcolor="#FFFFFF"><?php echo $addresslist[$comrows]["faxnumber"] ?></td>
                                            <td bgcolor="#FFFFFF">
                                                <div align="center"><a href="?PID=address_update&company_id=<?php echo $addresslist[$comrows]["company_id"] ?>"><img src="img/template/bbs/edit.gif" width="15" height="16" border="0"></a></div>
                                                </td>
                                            <td bgcolor="#FFFFFF">
                                                <div align="center"><a href="?PID=address_delete&company_id=<?php echo $addresslist[$comrows]["company_id"] ?>"><img src="http://siteadmin.itcube.ne.jp/gw/img/trashbox.gif" width="16" height="20" border="0"></a></div>
                                                </td>
                                        </tr>
                                        <?php 	
				}
				?>
                                    </table>
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
                        <div align="center">
                            <?php 
							if($maxpage==NULL) {
								$maxpage=1;
							}
							if($_GET["PAGE"]!=NULL&&$_GET["PAGE"]!=1) { ?>
                            <a href="?PID=address_top&PAGE=<?php echo $_GET["PAGE"]-1; ?>&initial=<?php echo urlencode($_GET["initial"])?>">
                                <?php }?>
                                ＜＜前のページ　
                                <?php if($_GET["PAGE"]!=NULL&&$_GET["PAGE"]!=1) { ?>
                            </a>
                            <?php }?>
                            <?php
								for($p=1;$p<=$maxpage;$p++) {
									if($p==$_GET["PAGE"]) {
										echo '<strong> '.$p." </strong>";
									}else {
								?>
                            <a href="?PID=address_top&PAGE=<?php echo $p; ?>&initial=<?php echo urlencode($_GET["initial"])?>"><?php echo $p; ?></a>
                            <?php  }} ?>
                            <?php if($_GET["PAGE"]!=$maxpage) {?>
                            <a href="?PID=address_top&PAGE=<?php echo $_GET["PAGE"]+1; ?>&initial=<?php echo urlencode($_GET["initial"])?>">
                                <?php }?>
                                次のページ＞＞
                                <?php if($_GET["PAGE"]>=$maxpage) {?>
                            </a>
                            <?php }?>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp; </td>
    </tr>
</table>
</div>