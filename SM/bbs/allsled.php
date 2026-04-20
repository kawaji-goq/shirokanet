<meta http-equiv="Content-Type" content="text/html; charset=euc-jp"/>
<?php 
$bbsobj=new Cube_BBS($dbobj);
$updata=$bbsobj->Get_TehmaList2(10);
$updata2=$bbsobj->get_NoReadList($logindata["member_id"]);
$alldata=$bbsobj->Get_UpSledList("all");
$themalist=$bbsobj->Get_ThemaList();
//$sleddata=$bbsobj->Get_SledData($_REQUEST["sled_id"]);
//$logdata=$bbsobj->Get_LogData($_REQUEST["sled_id"],20,$pagenum,$searkey);

?>
<div id="bbs">
	<table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1">
		
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%"  border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td>
								<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FCFCFC">
										<tr>
												<td width="4%"><img src="/GW/img/template/icon_bbs.jpg" width="40" height="42"></td>
												<td width="96%" class="title"><font color="#333333">BBSテーマ一覧</font></td>
										</tr>
								</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		
		<tr>
			<td width="220" valign="top">
			    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>
                            <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#DCDCFF">
                                <tr>
                                    <td bgcolor="#DCDCFF"><strong>テーマ一覧
                                        <?php $updata=$bbsobj->Get_TehmaList2(10);  ?>
                                    </strong></td>
                                </tr>
                                <tr>
                                    <td valign="top" bgcolor="#FFFFFF">
                                        <table width="100%" border="0" cellpadding="5" cellspacing="0">
                                            <?php 
				$rows=0;
				while($updata[$rows]["sled_id"]!=NULL) {
				?>
                                            <tr>
                                                <td bgcolor="#FFFFFF"><a href="index.php?PID=bbs_topics&sled_id=<?php echo $updata[$rows]["sled_id"] ?>"><?php echo $updata[$rows]["sled_name"];?></a><a href="index.php?PID=bbs_topics&sled_id=<?php echo $updata[$rows]["sled_id"] ?>"> (
                                                    <?php
										$themamax=$dbobj->GetData("select count(sled_id) as maxcount from bbs_sled where parents=".$updata[$rows]["sled_id"]);							
																	 echo $themamax["maxcount"] ?>
                                                    ) </a>
                                                        <div align="right"></div>
                                                </td>
                                            </tr>
                                            <?php 				
					$rows++;
				}
				?>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" bgcolor="#FFFFFF"><a href="index.php?PID=add_theme"><img src="/GW/img/template/addthema.jpg" border="0"></a><br>
                                        <a href="index.php?PID=bbs_allsled"><img src="/GW/img/template/display_allthema.jpg" width="169" height="23" border="0"></a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#DCDCFF">
                                <tr>
                                    <td>
                                        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td><strong><span class="subtitle">最近の書き込み</span></strong></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <?php 
				$rows=0;
				while($updata2[$rows]["sled_id"]!=NULL) {
				$bbsreadstatus[$rows]=$bbsobj->get_ReadCheck($updata2[$rows]["sled_id"],$logindata["member_id"]);
				?>
                                <tr>
                                    <td bgcolor="#FFFFFF">
                                        <table width="100%"  border="0" cellspacing="1" cellpadding="1">
                                            <tr>
                                                <td><?php echo str_replace("-",".",$updata2[$rows]["last_update"]); ?>
                                                        <?php
																if($bbsreadstatus[$rows]["read_status"]!=1) {
																?>
                                                        <font color="#FF0000"><strong>New!</strong></font>
                                                        <?php
																}
																?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><a href="index.php?PID=bbs_sled&sled_id=<?php echo $updata2[$rows]["sled_id"] ?>"><?php echo $updata2[$rows]["sled_name"] ?></a>(<?php echo $updata2[$rows]["maxcount"] ?>)</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <?php 
					$rows++;
				}
				?>
                            </table>
                        </td>
                    </tr>
                </table>
			</td>
			<td valign="top">
					<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td>
							<table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#DCDCFF">
								<tr>
									<td bgcolor="#DCDCFF"><strong>テーマ一覧</strong></td>
								</tr>
								<tr>
									<td height="100" valign="top" bgcolor="#FFFFFF">
											<table width="100%" border="0" cellpadding="5" cellspacing="0">
													<tr>
															<td width="39%" nowrap bgcolor="#ececec">テーマ</td>
															<td width="13%" nowrap bgcolor="#ececec">テーマ作成者</td>
															<td width="10%" nowrap bgcolor="#ececec">
																	<div align="right">トピックス数</div>
															</td>
															<td width="33%" nowrap bgcolor="#ececec">
																	<div align="center">作成日時</div>
															</td>
															<td width="5%" nowrap bgcolor="#ececec">
															    <div align="center">編集</div>
															</td>
															<td width="5%" nowrap bgcolor="#ececec">
																	<div align="center">削除</div>
															</td>
													</tr>
												<?php 
				$rows=0;
				while($themalist[$rows]["sled_id"]!=NULL) {
				?>	<tr>
															<td bgcolor="#FFFFFF"><a href="index.php?PID=bbs_topics&sled_id=<?php echo $themalist[$rows]["sled_id"] ?>"><?php echo $themalist[$rows]["sled_name"];?></a></td>
															<td bgcolor="#FFFFFF"><a href="index.php?PID=bbs_topics&sled_id=<?php echo $themalist[$rows]["sled_id"] ?>"><?php echo $themalist[$rows]["master_name"];?></a></td>
															<td bgcolor="#FFFFFF">
																	<div align="right"><a href="index.php?PID=bbs_topics&sled_id=<?php echo $themalist[$rows]["sled_id"] ?>"><?php
										$themamax=$dbobj->GetData("select count(sled_id) as maxcount from bbs_sled where parents=".$themalist[$rows]["sled_id"]);							
																	 echo $themamax["maxcount"] ?></a></div>
															</td>
															<td bgcolor="#FFFFFF">
																	<div align="right"><a href="index.php?PID=bbs_topics&sled_id=<?php echo $themalist[$rows]["sled_id"] ?>"><?php echo str_replace("-",".",$alldata[$rows]["last_update"]) ?></a></div>
															</td>
															<td bgcolor="#FFFFFF"><?php 
															if($logindata["member_id"]==$themalist[$rows]["master_id"]){?>
															    <div align="center"><a href="?PID=up_theme&sled_id=<?php echo $themalist[$rows]["sled_id"] ?>"><img src="img/template/bbs/edit.gif" width="15" height="16" border="0"></a></div><?php }?>
															</td>
															<td bgcolor="#FFFFFF"><?php 
															if($logindata["member_id"]==$themalist[$rows]["master_id"]){?>
																	<div align="center"><a href="?PID=del_theme&sled_id=<?php echo $themalist[$rows]["sled_id"] ?>"><img src="http://siteadmin.itcube.ne.jp/gw/img/trashbox.gif" width="16" height="20" border="0"></a></div><?php }?>
															</td>
												</tr><?php 				
					$rows++;
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
							$maxpage=$bbsobj->get_PagerData("theme_max");
							if($maxpage==NULL) {
								$maxpage=1;
							}
							if($_GET["PAGE"]!=NULL&&$_GET["PAGE"]!=1) { ?>
						        <a href="?PID=bbs_allsled&PAGE=<?php echo $_GET["PAGE"]-1; ?>">
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
								 <a href="?PID=bbs_allsled&PAGE=<?php echo $p; ?>"><?php echo $p; ?></a> <?php  }} ?><?php if($_GET["PAGE"]!=$maxpage) {?>
						        <a href="?PID=bbs_allsled&PAGE=<?php echo $_GET["PAGE"]+1; ?>">
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
<?php 

?>
