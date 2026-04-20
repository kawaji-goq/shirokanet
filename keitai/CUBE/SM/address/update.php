<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<style>
#address_reg .forms input,#address_reg .forms textarea{
	width:98%;
}
</style>
<script language="javascript">
function zipcodex() {
	var zipcode;
	var address;
	zipcode=document.address_regform1.zipcode.value;
	result=showModalDialog("/SM/tool/zipsearch.php?zipcode="+zipcode,"test");
	address=result.split(",");
	document.address_regform1.address.value=address[0]+address[1]+address[2];
}

</script>
<?php

if($_REQUEST["company_id"]!=NULL) {
	$sql="select * from company_addressbook where company_id = ".$_REQUEST["company_id"];
	$companydata=$dbobj->GetData($sql);
	$sql2="select * from company_tantou where company_id = ".$_REQUEST["company_id"];
	$tantoulist=$dbobj->GetList($sql2);
	
if($_REQUEST["btm_chk"]=="更新する"){
		$insql = 'update company_addressbook set '.
											'company_code=\''.$_REQUEST["company_code"].'\','.
											'company_name = \''.$_REQUEST["company_name"].'\','.
											'company_yomi=\''.$_REQUEST["company_yomi"].'\','.
											'shortname = \''.$_REQUEST["shortname"].'\','.
											'group_name=\''.$_REQUEST["group_name"].'\','.
											'zipcode=\''.$_REQUEST["zipcode"].'\','.
		         'address=\''.$_REQUEST["address"].'\','.
											'telnumber=\''.$_REQUEST["telnumber"].'\','.
											'faxnumber=\''.$_REQUEST["faxnumber"].'\','.
											'url=\''.$_REQUEST["url"].'\','.
											'mail_address=\''.$_REQUEST["mail_address"].'\','.
											'memos=\''.$_REQUEST["memos"].'\' where company_id = '.$_REQUEST["company_id"];
											
		$res=$dbobj->Query($insql);
		if($res) {
		    $insql = "update company_tantou set ".
															"tantou_name='".$_REQUEST["tantou_name"]."',".
															"tantou_post='".$_REQUEST["tantou_post"]."',".
															"tantou_telnumber='".$_REQUEST["tantou_telnumber"]."',".
															"tantou_faxnumber='".$_REQUEST["tantou_faxnumber"]."',".
															"tantou_yomi='".$_REQUEST["tantou_yomi"]."',".
															"tantou_mailaddress='".$_REQUEST["tantou_mailaddress"]."',".
															"tantou_keitainumber='".$_REQUEST["tantou_keitainumber"]."',".
															"tantou_memos = '".$_REQUEST["tantou_memos"]."' where company_id = ".$_REQUEST["company_id"];			
		    $dbobj->Query($insql);
		}
		?>
		<script language="javascript">
		history.go(-2)
		</script>
		<?php
}
?>
<div id="address_reg">
    <form name="address_regform1" method="post" action="">
        <TABLE width="100%"  border="0" align="center" cellpadding="2" cellspacing="2">
            <TR>
                <th width="50%" valign="top">
                    <TABLE width="100%"  border="0" align="center" cellpadding="2" cellspacing="2">
                        <TR>
                            <th width="100%">会社情報</th>
                        </TR>
                        <TR>
                            <TD>
                                <TABLE width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC" class="forms">
                                    <TR>
                                        <th align="right" nowrap bgcolor="#ececec">会社コード：</th>
                                        <TD align="left" bgcolor="#FFFFFF">
                                            <input name="company_code" type="text" id="company_code" style="ime-mode:disabled" value="<?php echo $companydata["company_code"]; ?>" size="40">
                                        </TD>
                                    </TR>
                                    <TR>
                                        <th align="right" nowrap bgcolor="#ececec"><strong>会社名</strong>：</th>
                                        <TD align="left" bgcolor="#FFFFFF">
                                            <input name="company_name" type="text" id="company_name" style="ime-mode:active" value="<?php echo $companydata["company_name"]; ?>" size="40">
                                        </TD>
                                    </TR>
                                    <TR>
                                        <th align="right" nowrap bgcolor="#ececec"><strong>ふりがな：</strong></th>
                                        <TD align="left" bgcolor="#FFFFFF">
                                            <input name="company_yomi" type="text" id="company_yomi" size="40" style="ime-mode:active" value="<?php echo $companydata["company_yomi"]; ?>" >
                                        </TD>
                                    </TR>
                                    <!--<TR>
													<td align="right"><strong>JC入会年：</strong></td>
													<TD align="left">
														<input name="new_op_ryear" type="text" id="new_op_ryear" value="<?php echo  $mdata["opyear"];?>" style="ime-mode:disabled">
													</TD>
												</TR>-->
                                    <TR>
                                        <th align="right" nowrap bgcolor="#ececec">携帯用表示名：</th>
                                        <TD align="left" bgcolor="#FFFFFF">
                                            <input name="shortname" type="text" id="company_yomi" size="40" style="ime-mode:active" value="<?php echo $companydata["shortname"]; ?>" >
                                        </TD>
                                    </TR>
                                    <TR>
                                        <th align="right" nowrap bgcolor="#ececec">郵便番号：</th>
                                        <TD align="left" bgcolor="#FFFFFF">
                                            <table width="200" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td width="100">
                                                        <input name="zipcode" type="text" id="zipcode" size="40" style="ime-mode:disabled" value="<?php echo $companydata["zipcode"]; ?>" >
                                                    </td>
                                                    <td width="10">&nbsp;</td>
                                                    <td>
                                                        <input type="button" name="Submit" value="郵便番号から住所を検索" onClick="zipcodex()">
                                                    </td>
                                                </tr>
                                            </table>
                                        </TD>
                                    </TR>
                                    <TR>
                                        <th align="right" valign="top" nowrap bgcolor="#ececec">所在地：</th>
                                        <TD align="left" bgcolor="#FFFFFF">
                                            <textarea name="address" cols="40" id="address" style="ime-mode:active"><?php echo $companydata["address"]; ?></textarea>
                                        </TD>
                                    </TR>
                                    <TR>
                                        <th align="right" nowrap bgcolor="#ececec">電話番号：</th>
                                        <TD align="left" bgcolor="#FFFFFF">
                                            <input name="telnumber" type="text" id="telnumber" size="40" style="ime-mode:active" value="<?php echo $companydata["telnumber"]; ?>" >
                                        </TD>
                                    </TR>
                                    <TR>
                                        <th align="right" nowrap bgcolor="#ececec">FAX番号：</th>
                                        <TD align="left" bgcolor="#FFFFFF">
                                            <input name="faxnumber" type="text" id="faxnumber" size="40" style="ime-mode:active" value="<?php echo $companydata["faxnumber"]; ?>" >
                                        </TD>
                                    </TR>
                                    <TR>
                                        <th align="right" nowrap bgcolor="#ececec">部署：</th>
                                        <TD align="left" bgcolor="#FFFFFF">
                                            <input name="group_name" type="text" id="group_name" size="40" style="ime-mode:active" value="<?php echo $companydata["group_name"]; ?>" >
                                        </TD>
                                    </TR>
                                    <TR>
                                        <th width="25%" align="right" nowrap bgcolor="#ececec">
                                            <div align="right"><strong>ホームページ： </strong></div>
                                        </th>
                                        <TD width="75%" align="left" bgcolor="#FFFFFF">
                                            <input name="url" type="text" id="url" size="40" style="ime-mode:disabled" value="<?php echo $companydata["url"]; ?>" >
                                        </TD>
                                    </TR>
                                    <TR>
                                        <th width="25%" align="right" nowrap bgcolor="#ececec">
                                            <div align="right"><strong>メールアドレス： </strong></div>
                                        </th>
                                        <TD width="75%" align="left" bgcolor="#FFFFFF">
                                            <input name="mail_address" type="text" id="mail_address" size="40" style="ime-mode:disabled" value="<?php echo $companydata["mail_address"]; ?>" >
                                        </TD>
                                    </TR>
                                    <TR>
                                        <th align="right" valign="top" nowrap bgcolor="#ececec">メモ：</th>
                                        <TD align="left" bgcolor="#FFFFFF">
                                            <textarea name="memos" rows="6" id="memos"><?php echo $companydata["memos"]; ?></textarea>
                                        </TD>
                                    </TR>
                                </TABLE>
                            </TD>
                        </TR>
                    </TABLE>
                </th>
                <th width="50%" valign="top">
                    <TABLE width="100%"  border="0" align="center" cellpadding="2" cellspacing="2">
                        <TR>
                            <th>担当者連絡先</th>
                        </TR>
                        <TR>
                            <TD><?php
																												for($tantourows=0;$tantoulist[$tantourows]["tantou_id"]!=NULL;$tantourows++){
																												?>
                                <TABLE width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC" class="forms">
                                    <TR>
                                        <th width="25%" nowrap bgcolor="#ececec">
                                            <div align="right"><strong>担当者名：</strong></div>
                                        </th>
                                        <TD width="80%" align="left" bgcolor="#FFFFFF">
                                            <input name="tantou_name" type="text" id="tantou_name" value="<?php echo $tantoulist[$tantourows]["tantou_name"] ?>">
                                        </TD>
                                    </TR>
                                    <TR>
                                        <th valign="top" nowrap bgcolor="#ececec">
                                            <div align="right">ふりがな：</div>
                                        </th>
                                        <TD align="left" bgcolor="#FFFFFF">
                                            <input name="tantou_yomi" type="text" id="tantou_yomi" value="<?php echo $tantoulist[$tantourows]["tantou_yomi"] ?>">
                                        </TD>
                                    </TR>
                                    <TR>
                                        <th width="25%" valign="top" nowrap bgcolor="#ececec">
                                            <div align="right"><strong>役職： </strong></div>
                                        </th>
                                        <TD align="left" bgcolor="#FFFFFF">
                                            <input name="tantou_post" type="text" id="tantou_post" style="ime-mode:active" size="40" value="<?php echo $tantoulist[$tantourows]["tantou_post"] ?>">
                                        </TD>
                                    </TR>
                                    <TR>
                                        <th width="25%" nowrap bgcolor="#ececec">
                                            <div align="right"><strong>電話番号： </strong></div>
                                        </th>
                                        <TD align="left" bgcolor="#FFFFFF">
                                            <input name="tantou_telnumber" type="text" id="tantou_telnumber" style="ime-mode:disabled" value="<?php echo $tantoulist[$tantourows]["tantou_telnumber"] ?>">
                                        </TD>
                                    </TR>
                                    <TR>
                                        <th width="25%" nowrap bgcolor="#ececec">
                                            <div align="right"><strong>FAX番号： </strong></div>
                                        </th>
                                        <TD align="left" bgcolor="#FFFFFF">
                                            <input name="tantou_faxnumber" type="text" id="tantou_faxnumber" style="ime-mode:disabled" value="<?php echo $tantoulist[$tantourows]["tantou_faxnumber"] ?>">
                                        </TD>
                                    </TR>
                                    <TR>
                                        <th nowrap bgcolor="#ececec">
                                            <div align="right">携帯番号：</div>
                                        </th>
                                        <TD align="left" bgcolor="#FFFFFF">
                                            <input name="tantou_keitainumber" type="text" id="tantou_keitainumber" style="ime-mode:disabled" value="<?php echo $tantoulist[$tantourows]["tantou_keitainumber"] ?>">
                                        </TD>
                                    </TR>
                                    <TR>
                                        <th nowrap bgcolor="#ececec">
                                            <p align="right">メールアドレス：</p>
                                        </th>
                                        <TD align="left" bgcolor="#FFFFFF">
                                            <input name="tantou_mailaddress" type="text" id="tantou_mailaddress" style="ime-mode:disabled" value="<?php echo $tantoulist[$tantourows]["tantou_mailaddress"] ?>">
                                        </TD>
                                    </TR>
                                    <TR>
                                        <th valign="top" nowrap bgcolor="#ececec">
                                            <div align="right">メモ：</div>
                                        </th>
                                        <TD align="left" bgcolor="#FFFFFF">
                                            <textarea name="tantou_memos" rows="6" id="tantou_memos" style="ime-mode:active"><?php echo $tantoulist[$tantourows]["tantou_memos"] ?></textarea>
                                        </TD>
                                    </TR>
                                </TABLE>
                                <?php 
																				
																				}
																				?>
</TD>
                        </TR>
                    </TABLE>
                </th>
            </TR>
            <TR>
                <TD>&nbsp;</TD>
                <TD>&nbsp;</TD>
            </TR>
            <TR>
                <TD height="30">
                    <input name="btm_chk" type="submit" id="btm_chk" value="更新する">
                    <input name="btm_back" type="button" id="btm_back" onClick="history.back()" value="戻る">
                    <input name="company_id" type="hidden" id="company_id" value="<?php echo $_REQUEST["company_id"];?>">
</TD>
                <TD>&nbsp;</TD>
            </TR>
        </TABLE>
        </form>
</div>
<?php
}
?>