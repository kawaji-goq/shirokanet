<?php
$ad_blog=new Admin_Blog($dbobj);

if($_GET["pmode"]=="delete"&&$_GET["delid"]!=NULL) {
	$ad_blog->DeleteOneData($_GET["delid"]);
}
if($_REQUEST["btm_upata"]=="¹¹¿·¤¹¤ë") {

	$ad_blog->UpdateDataList($_POST);
	
}
if($_GET["syear"]==NULL){
$_GET["syear"]=date("Y");
}

if($_GET["smonth"]==NULL) {
	$_GET["smonth"]=date("m");
}

$jandata=$dbobj->GetData("select count(blog_id) as countnum from blog_data where ryear=".$_GET["syear"]." and rmonth=1");
$febdata=$dbobj->GetData("select count(blog_id) as countnum from blog_data where ryear=".$_GET["syear"]." and rmonth=2");
$mardata=$dbobj->GetData("select count(blog_id) as countnum from blog_data where ryear=".$_GET["syear"]." and rmonth=3");
$aprdata=$dbobj->GetData("select count(blog_id) as countnum from blog_data where ryear=".$_GET["syear"]." and rmonth=4");
$maydata=$dbobj->GetData("select count(blog_id) as countnum from blog_data where ryear=".$_GET["syear"]." and rmonth=5");
$jundata=$dbobj->GetData("select count(blog_id) as countnum from blog_data where ryear=".$_GET["syear"]." and rmonth=6");
$juldata=$dbobj->GetData("select count(blog_id) as countnum from blog_data where ryear=".$_GET["syear"]." and rmonth=7");
$auggdata=$dbobj->GetData("select count(blog_id) as countnum from blog_data where ryear=".$_GET["syear"]." and rmonth=8");
$sepdata=$dbobj->GetData("select count(blog_id) as countnum from blog_data where ryear=".$_GET["syear"]." and rmonth=9");
$ougdata=$dbobj->GetData("select count(blog_id) as countnum from blog_data where ryear=".$_GET["syear"]." and rmonth=10");
$novdata=$dbobj->GetData("select count(blog_id) as countnum from blog_data where ryear=".$_GET["syear"]." and rmonth=11");
$decdata=$dbobj->GetData("select count(blog_id) as countnum from blog_data where ryear=".$_GET["syear"]." and rmonth=12");
?><script language="javascript">
function delchk(name,id) {
	var res=confirm(name+"¤òºï½ü¤·¤Æ¤â¤è¤í¤·¤¤¤Ç¤¹¤«¡©");
	
	if(res) {
		location.href="?PID=blog_list&pmode=delete&cate_id=<?php echo $_GET["cate_id"];?>&delid="+id;
	}
	
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<table border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
  		<td>
  				<table width="700" border="0" align="left">
							<tr>
									<td width="278"><img src="./img/siteadmin/edit_menu.gif" alt="ÊÔ½¸Ãæ¤Î¥¨¥ê¥¢" width="278" height="18" /></td>
									<td width="412" align="left">
											<p><strong>¡¡¥È¥Ô¥Ã¥¯¥¹ &gt;&gt;¡¡¥Ç¡¼¥¿°ìÍ÷</strong></p>
									</td>
							</tr>
					</table>
  		</td>
 		</tr>
  <tr>
      <td>&nbsp;</td>
  </tr>
  <tr>
      <td><?php echo $_GET["syear"];?>
          <?php if($jandata["countnum"]!=0){?>
          <a href="?PID=<?php echo $_GET["PID"];?>&syear=<?php echo $_GET["syear"];?>&smonth=1"> <font color="#FF6600">
          <?php }?>
1·î
<?php if($jandata["countnum"]!=0){?>
          </font></a>
          <?php }?>
          <?php if($febdata["countnum"]!=0){?>
          <a href="?PID=<?php echo $_GET["PID"];?>&syear=<?php echo $_GET["syear"];?>&smonth=2"> <font color="#FF6600">
          <?php }?>
2·î
<?php if($febdata["countnum"]!=0){?>
          </font></a>
          <?php }?>
          <?php if($mardata["countnum"]!=0){?>
          <a href="?PID=<?php echo $_GET["PID"];?>&syear=<?php echo $_GET["syear"];?>&smonth=3"> <font color="#FF6600">
          <?php }?>
3·î
<?php if($mardata["countnum"]!=0){?>
          </font> </a>
          <?php }?>
          <?php if($aprdata["countnum"]!=0){?>
          <a href="?PID=<?php echo $_GET["PID"];?>&syear=<?php echo $_GET["syear"];?>&smonth=4"> <font color="#FF6600">
          <?php }?>
4·î
<?php if($aprdata["countnum"]!=0){?>
          </font></a>
          <?php }?>
          <?php if($maydata["countnum"]!=0){?>
          <a href="?PID=<?php echo $_GET["PID"];?>&syear=<?php echo $_GET["syear"];?>&smonth=5"> <font color="#FF6600">
          <?php }?>
5·î
<?php if($maydata["countnum"]!=0){?>
          </font> </a>
          <?php }?>
          <?php if($jundata["countnum"]!=0){?>
          <a href="?PID=<?php echo $_GET["PID"];?>&syear=<?php echo $_GET["syear"];?>&smonth=6"> <font color="#FF6600">
          <?php }?>
6·î
<?php if($jundata["countnum"]!=0){?>
          </font></a>
          <?php }?>
          <?php if($juldata["countnum"]!=0){?>
          <a href="?PID=<?php echo $_GET["PID"];?>&syear=<?php echo $_GET["syear"];?>&smonth=7"> <font color="#FF6600">
          <?php }?>
7·î
<?php if($juldata["countnum"]!=0){?>
          </font> </a>
          <?php }?>
          <?php if($augdata["countnum"]!=0){?>
          <a href="?PID=<?php echo $_GET["PID"];?>&syear=<?php echo $_GET["syear"];?>&smonth=8"> <font color="#FF6600">
          <?php }?>
8·î
<?php if($augdata["countnum"]!=0){?>
          </font> </a>
          <?php }?>
          <?php if($sepdata["countnum"]!=0){?>
          <a href="?PID=<?php echo $_GET["PID"];?>&syear=<?php echo $_GET["syear"];?>&smonth=9"> <font color="#FF6600">
          <?php }?>
9·î
<?php if($sepdata["countnum"]!=0){?>
          </font> </a>
          <?php }?>
          <?php if($octdata["countnum"]!=0){?>
          <a href="?PID=<?php echo $_GET["PID"];?>&syear=<?php echo $_GET["syear"];?>&smonth=10"> <font color="#FF6600">
          <?php }?>
10·î
<?php if($octdata["countnum"]!=0){?>
          </font></a>
          <?php }?>
          <?php if($novdata["countnum"]!=0){?>
          <a href="?PID=<?php echo $_GET["PID"];?>&syear=<?php echo $_GET["syear"];?>&smonth=11"> <font color="#FF6600">
          <?php }?>
11·î
<?php if($novdata["countnum"]!=0){?>
          </font> </a>
          <?php }?>
          <?php if($decdata["countnum"]!=0){?>
          <a href="?PID=<?php echo $_GET["PID"];?>&syear=<?php echo $_GET["syear"];?>&smonth=12"> <font color="#FF6600">
          <?php }?>
12·î
<?php if($decdata["countnum"]!=0){?>
          </font></a>
          <?php }?>
          <a href="?PID=<?php echo $_GET["PID"];?>&syear=<?php echo $_GET["syear"]-1;?>&smonth=<?php echo $_GET["smonth"];?>"><?php echo $_GET["syear"]-1;?></a> <a href="?PID=<?php echo $_GET["PID"];?>&syear=<?php echo $_GET["syear"]+1;?>&smonth=<?php echo $_GET["smonth"];?>"><?php echo $_GET["syear"]+1;?></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td>
      <form id="form1" name="form1" method="post" action="">
        	<table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
									<td align="left" valign="top">
									    <table width="100%" border="0">
	<tr>
													    <td colspan="2">																<?php
/****************************************************************/
/*¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡*/
/*¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡»Ü¹©¼ÂÀÓ¥«¥Æ¥´¥ê°ìÍ÷³«»Ï¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡*/
/*¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡*/
/*¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­*/
$blogdata=$dbobj->GetList("select * from blog_data where ryear=".$_GET["syear"]." and rmonth=".$_GET["smonth"]." order by rdate desc");
for($blogrow=0;$blogdata[$blogrow];$blogrow++){ 
$blogddata=new Ary_Viewer($blogdata[$blogrow]);
?>		
													        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                         <tr>
                             <td align="center">
                                 <table width="700" border="0" cellpadding="0" cellspacing="0">
                                     <tr>
                                         <td width="110" align="left" valign="top">
                                             <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                 <tr>
                                                     <td align="center" bgcolor="#666666" class="text11">
                                                         <div align="center"><strong><font color="#FFFFFF"><?php echo str_replace("-",".",$blogdata[$blogrow]["rdate"]); ?></font></strong></div>
                                                     </td>
                                                 </tr>
                                                 <tr>
                                                     <td>&nbsp;</td>
                                                 </tr>
                                                 <tr>
                                                     <td><a href="?PID=blog_dup&blog_id=<?php echo $blogdata[$blogrow]["blog_id"];?>">
                                                         <?php if($blogdata[$blogrow]["image"]!=NULL){
								$pdata=(getimagesize("http://".$_SESSION["DomainData"]["domain_name"].$blogdata[$blogrow]["image"]));
							if($pdata[0]>100) {
								 $pdata[0]=100;
							}
					 
						 ?>
                                                         <img src="<?php echo "http://".$_SESSION["DomainData"]["domain_name"].$blogdata[$blogrow]["image"];?>?file=<?php echo time();?>" alt="image" width="<?php echo $pdata[0];?>px" border="0"/><br />
                                                         <label></label>
<?php }?>
</a></td>
                                                 </tr>
                                             </table>
                                         </td>
                                         <td width="10" align="left" valign="top">&nbsp;</td>
                                         <td width="580" align="left" valign="top">
                                             <table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-size:13px;">
                                                 <tr>
                                                     <td class="text14b_16">
                                                         <strong>
                                                         <input name="turn[<?php echo $blogrow; ?>]" type="hidden" id="turn[<?php echo $blogrow; ?>]" value="<?php $blogddata->Moji("turn"); ?>" size="6" />
                                                         <a href="?PID=blog_dup&blog_id=<?php echo $blogdata[$blogrow]["blog_id"];?>">
                                                         <?php $blogddata->Moji("title"); ?>
                                                         </a>
                                                         <input name="blog_id[<?php echo $blogrow; ?>]" type="hidden" id="blog_id[<?php echo $blogrow; ?>]" value="<?php echo $blogdata[$blogrow]["blog_id"];?>" />
                                                         </strong></td>
                                                 </tr>
                                                 <tr>
                                                     <td>&nbsp;</td>
                                                 </tr>
                                                 <tr>
                                                     <td style="font-size:12px;">
                                                         
                                                             <div align="left">
                                                                 <?php $blogddata->Moji("comm"); ?>
                                                                 <br>
                                                                 </div>
                                                             <table width="95" border="0" align="left" cellpadding="2" cellspacing="1">
                                                             
                                                             <tr>
                                                                 <td align="left" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
                                                                 <td align="left" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
                                                             </tr>
                                                             <tr>
                                                                 <td width="42" align="left" valign="top" bgcolor="#FFFFFF">
                                                                     <input type="button" name="Submit" value="½¤Àµ" onclick="location.replace('?PID=blog_dup&blog_id=<?php echo $blogdata[$blogrow]["blog_id"];?>')" />
                                                                 </td>
                                                                 <td width="42" align="left" valign="top" bgcolor="#FFFFFF">
                                                                     <input type="button" name="Submit" value="ºï½ü" onclick="delchk('<?php echo trim($blogdata[$blogrow]["title"]); ?>','<?php echo $blogdata[$blogrow]["blog_id"];?>')" />
                                                                 </td>
                                                             </tr>
                                                         </table>
                                                     </td>
                                                 </tr>
                                                 <tr>
                                                     <td class="text12_22">
                                                         <hr size="1" />
                                                     </td>
                                                 </tr>
                                             </table>
                                         </td>
                                     </tr>
                                     <tr>
                                         <td align="left" valign="top">&nbsp;</td>
                                         <td align="left" valign="top">&nbsp;</td>
                                         <td align="left" valign="top">&nbsp;</td>
                                     </tr>
                                 </table>
                             </td>
                             </tr>
                         <tr>
                             <td>&nbsp;</td>
                             </tr>
                     </table>
													        
													    <?php 
				}
				/*¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬*/
				/*¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡*/
				/*¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡»Ü¹©¼ÂÀÓ¥«¥Æ¥´¥ê°ìÍ÷½ªÎ»¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡*/
				/*¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡*/
				/****************************************************************/
				?>
				</td>
													    </tr>
													<tr>
															<td width="80%">&nbsp;</td>
															<td width="20%">&nbsp;</td>
													</tr>									<tr>
															<td align="left">
															    <input type="button" name="Submit" value="¿·µ¬ÅÐÏ¿" onClick="location.href='?PID=blog_dadd&cate_id=<?php echo $_GET["cate_id"];?>'" />
															</td>
															<td>&nbsp;</td>
													</tr>
											</table>
									</td>
							</tr>
					</table>
        	</form>
    </td>
  </tr>
</table>
