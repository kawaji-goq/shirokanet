<?php

if($_REQUEST["update_re"]=="更新する") {
	$dbobj->Query("update bukken_setting set reg_chk=".$_REQUEST["reg_chk"].",nodata_view=".$_REQUEST["nodata_view"]);
	$dbobj->Query("update tenpo_data set poptype=".$_REQUEST["poptype"]."");
}

$bsetdata=$dbobj->GetData("select * from bukken_setting");

$tenpodata=$dbobj->GetData("select * from tenpo_data");

?><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
				<td>
						<TABLE width="700"  border="0" align="left" cellpadding="3" cellspacing="0" bgcolor="#CCCCCC" class="realestate_bgcolor1">
								<TR class="realestate_bgcolor2">
										<TD width="95" valign="top" bgcolor="#ECECFF">
												<div align="center"><a href="?PID=re_setting">表示項目設定</a></div>
										</TD>
										<TD width="114" valign="top" bgcolor="#FFECEC">
												<div align="center"><strong><font color="#333333">その他の設定</font></strong></div>
										</TD>
										<TD width="119" valign="top" bgcolor="#FFFFFF">&nbsp;</TD>
										<TD width="28" valign="top" bgcolor="#FFFFFF">&nbsp;</TD>
										<TD width="314" valign="top" bgcolor="#FFFFFF">&nbsp;</TD>
								</TR>
								<form action="" method="post" enctype="multipart/form-data" name="bukken_form">
								</form>
						</TABLE>
				</td>
		</tr>
		<tr>
				<td align="left">
						<TABLE width="700"  border="0" align="left" cellpadding="5" cellspacing="0" class="realestate_bgcolor1">
								<TR class="realestate_bgcolor2">
										<TD colspan="2" valign="top" bgcolor="#FFECEC">&nbsp;</TD>
								</TR>
								<form action="" method="post" enctype="multipart/form-data" name="bukken_form">
										<TR class="realestate_bgcolor2">
												<TD colspan="2" align="center" valign="top">
														<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
																<tr>
																		<td width="175" align="right" bgcolor="#EBEBEB" class="font14">
																				<div align="right"><strong>レインズ読み込み時</strong></div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<select name="reg_chk" id="reg_chk">
																						<option value="1"<?php if($bsetdata["reg_chk"]==1) { echo " selected";}?>>非公開</option>
																						<option value="0"<?php if($bsetdata["reg_chk"]==0) { echo " selected";}?>>公開</option>
																				</select>
																				<br>
																				<font color="#FF0000">※この設定は全ての種別で共通になっております。																		</font></td>
																</tr>
																<tr>
																		<td width="175" align="right" bgcolor="#EBEBEB" class="font14"><strong>データの入力が無い項目</strong></td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<select name="nodata_view" id="nodata_view">
																						<option value="0"<?php if($bsetdata["nodata_view"]==0) { echo " selected";}?>>表示しない</option>
																						<option value="1"<?php if($bsetdata["nodata_view"]==1) { echo " selected";}?>>表示する</option>
																				</select>
																				<br>
																				<font color="#FF0000">※この設定は全ての種別で共通になっております。																		</font></td>
																</tr>
																<tr>
																    <td align="right" valign="top" bgcolor="#EBEBEB" class="font14">
																        <div align="right"><strong>POPの選択</strong></div>
																    </td>
																    <td bgcolor="#FFFFFF" class="font12">
																        <table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                                <td width="200">
                                    <div align="center"><strong>
                                        <input name="poptype" type="radio" value="1"<?php if($tenpodata["poptype"]==1||$tenpodata["poptype"]==NULL) { echo " checked";}?>>
                                        POPタイプ１</strong></div>
                                </td>
                                <td>&nbsp;</td>
                                <td width="200">
                                    <div align="center"><strong>
                                        <input name="poptype" type="radio" value="2"<?php if($tenpodata["poptype"]==2) { echo " checked";}?>>
                                        POPタイプ2</strong></div>
                                </td>
                            </tr>
                            <tr>
                                <td width="200"><img src="http://siteadmin.itcube.ne.jp/sm/img/pop2.jpg" width="200" height="142"></td>
                                <td width="10">&nbsp;</td>
                                <td width="200"><img src="http://siteadmin.itcube.ne.jp/sm/img/pop3.jpg" width="200" height="141"></td>
                            </tr>
                        </table>
																    </td>
																    </tr>
														</table>
												</TD>
										</TR>
										<TR class="realestate_bgcolor2">
												<TD colspan="2" align="center" valign="top">
														<table width="100%" border="0" cellspacing="0" cellpadding="0">
																<tr>
																		<td>&nbsp;</td>
																		<td>&nbsp;</td>
																</tr>
																<tr>
																		<td width="10%">
																				<input name="update_re" type="submit" id="update_re" value="更新する" />
																		</td>
																		<td width="90%">
																				<input name="btm" type="button" id="btm" onClick="history.back()" value="戻る" />
																		</td>
																</tr>
														</table>
												</TD>
										</TR>
								</form>
						</TABLE>
				</td>
		</tr>
</table>
