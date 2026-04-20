<table width="100%" border="0" cellspacing="0" cellpadding="0">
        
        <tr>
          <td width="640" height="35" align="left" valign="middle" background="/img/main/title_bg.jpg"><table width="99%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="14">&nbsp;</td>
              <td width="497" class="text2"><p><?php echo $infocatetitledata["data_name"];?></p></td>
              <td width="123" class="text1">最終更新日　<?php echo $infodata["options"];?></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="left" valign="top" background="/img/main/sideline.jpg">
              <form id="update_form" name="update_form" method="post" action="">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                          <td width="2%" align="left" valign="top">&nbsp;</td>
                          <td align="left" valign="top" class="text2">
                              <p> <span class="texttitle_16"><?php echo $infocatedata["cate_name"];?>
                                  </span><br />
                                  <br />
                                 
																																	
                                  <span class="texttitle_16"><strong>記事</strong></span>
    <br>
    <textarea name="data_comm"><?php echo $infodata["data_comm"] ?></textarea>
                              </p></td>
                      </tr>
                      <tr>
                          <td align="center" valign="top">&nbsp;</td>
                          <td align="center" valign="top">&nbsp;</td>
                      </tr>
                      <tr>
                          <td align="center" valign="top">&nbsp;</td>
                          <td align="center" valign="top">
                              <div align="left">
                                  <select name="view_chk" id="view_chk">
                                      <option value="1"<?php if($infodata["view_chk"]!=0){echo " selected";}?>>公開する</option>
                                      <option value="0"<?php if($infodata["view_chk"]==0){echo " selected";}?> >公開しない</option>
                                  </select>
                              </div>
                          </td>
                      </tr>
                      <tr>
                          <td align="center" valign="top">&nbsp;</td>
                          <td align="center" valign="top">&nbsp;</td>
                      </tr>
                      <tr>
                          <td align="center" valign="top">
                              <div align="left"></div>
                          </td>
                          <td align="center" valign="top">
                              <div align="left">
                                  <input name="bbtm_regist" type="button" id="bbtm_regist" value="更新する" onClick="datachk()">
                                          <input name="pmode" type="hidden" id="pmode" value="update">
              <input name="data_id" type="hidden" id="data_id" value="<?php echo $infodata["cate_id"];?>">
              <input name="cate_id" type="hidden" id="cate_id" value="<?php echo $infodata["cate_id"];?>" />  </div>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="2" align="left" valign="top" class="text2">
                              <table width="99%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                      <td>&nbsp;</td>
                                      <td class="text2">&nbsp;</td>
                                  </tr><?php
																																		if($_SERVER['HTTP_HOST']=="re.332049.com") {
																																		?>
                                  <tr>
                                      <td>&nbsp;</td>
                                      <td class="text2">下のソースをページの一番上に貼り付けてください。</td>
                                  </tr>
                                  <tr>
                                      <td>&nbsp;</td>
                                      <td class="text2"><font color="#FF0000"><?php 
																																						echo htmlspecialchars('<?php');
																																						echo "\n<br>"; 
																																						echo htmlspecialchars('include $_SERVER["DOCUMENT_ROOT"]."/config/config.php";');
																																						echo "\n<br>"; 
																																						echo htmlspecialchars('																																						?>');
?>
                                      </font></td>
                                  </tr>
                                  <tr>
                                      <td>&nbsp;</td>
                                      <td class="text2">&nbsp;</td>
                                  </tr>
                                  <tr>
                                      <td>&nbsp;</td>
                                      <td class="text2">
                                          <p>下のソースを表示したい場所に貼り付けてください。</p>
                                          </td>
                                  </tr>
                                  <tr>
                                      <td>&nbsp;</td>
                                      <td class="text2">
                                          <pre><font color="#0000FF"><?php 
																																						echo htmlspecialchars('<?php');
																																						
																																												echo "\n<br>";
																																echo htmlspecialchars('$'.'infodata=$'.'dbobj->GetData("select * from info1_data where cate_id ='.$_REQUEST["cate_id"].' order by turn");');
																																						echo "\n<br>";
																																						echo htmlspecialchars('ec'.'ho '.'$'.'infodata'.'["data_comm"];');
																																												echo "\n<br>";
																																						echo htmlspecialchars('?>');?></font></pre>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>&nbsp;</td>
                                      <td class="text2">&nbsp;</td>
                                  </tr>
																																		<?php
																																		}
																																		?>
                                  <tr>
                                      <td width="14">&nbsp;</td>
                                      <td class="text2">
                                          <p>▲<a href="#top">ページTOP</a></p>
                                      </td>
                                  </tr>
                              </table>
                          </td>
                      </tr>
                  </table>
                        </form>
              </td>
        </tr>
        <tr>
          <td align="left" valign="top"><img src="/img/main/title_lower.jpg" width="640" height="12" /></td>
        </tr>
    </table><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
