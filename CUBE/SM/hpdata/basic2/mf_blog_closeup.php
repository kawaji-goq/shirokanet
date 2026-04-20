<?php

	$tenpodata=$dbobj->GetData("select * from tenpo_data");
	$newsobj=new Site_News($dbobj);
	$nblim=4;											
	$now=explode("-",date("Y-m-d"));
	$newblogsql="select * from blog_data where view_chk = 1 order by rdate desc limit $nblim ";
	$newblogdata=$dbobj->GetList($newblogsql);
	$tenpodata=$dbobj->GetData("select * from tenpo_data");
	$dbobj->Query("update blog_set set listimg_w=70,listimg_h=52,detailsimg_w=70,detailsimg_h=52");
	
	if($_REQUEST["blog_id"]!=NULL) {
		$blogdata=$dbobj->GetData("select * from blog_data where blog_id = ".$_REQUEST["blog_id"]." and view_chk=1");
	}
	else {
		$blogdata=$dbobj->GetData("select * from blog_data where view_chk = 1");
	}
	
?>
<?php 
$ad_blog=new Admin_Blog($dbobj);
$blogsetting=$ad_blog->LoadSetting();
?><script type="text/javascript" src="/fckeditor/fckeditor.js"></script>

<script language="javascript">
function datachk() {
	if(document.update_form.title.value=="") {
		alert("タイトルが入力されていません");
	}
	else {
		res=confirm("この内容で更新してもよろしいですか?");
		
		if(res) {
			document.update_form.submit();
		}
	}
	
}

function delchk() {
	res=confirm("この記事で削除してもよろしいですか?");
	
	if(res) {
	document.update_form.pmode.value="delete";
		document.update_form.submit();
	}
	
}
function view_change(num) {

	switch(num) {	
		case 0:
			document.all.type_link.style.display="none";
			document.all.type_text.style.display="block";
			break;
		case 1:
			document.all.type_link.style.display="block";
			document.all.type_text.style.display="none";
			break;
	}		
}

</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<style type="text/css">
<!--
body {
	background-color:white;
	margin:0px;
	padding:0px;
}
-->
</style>
<link href="/afiss.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
a:link {
	color:#0000CC;
}
a:visited {
	color:#000099;
}
a:hover {
	color: #0066FF;
}
a:active {
	color: #000099;
}
-->
</style>
<table width="0" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top"><?php include"tmp_header.html" ?></td>
  </tr>
</table>
<table width="855" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="200" align="left" valign="top"><table width="0" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><?php include"tmp_left_topics.html" ?></td>
      </tr>
    </table>
    <table width="0" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top"><?php include"tmp_left_main.html" ?></td>
      </tr>
    </table></td>
    <td width="15"><img src="/img/sp/15_15.jpg" width="15" height="15" /></td>
    <td width="640" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        
        <tr>
          <td align="left" valign="top"><img src="/img/main/title_closeup.jpg" alt="ニュース＆リリース" width="640" height="35" /></td>
        </tr>
        <tr>
          <td align="left" valign="top" background="/img/main/sideline.jpg"><?php 
if($_REQUEST["pmode"]=="update") {
	$ad_blog->UpdateOneData($_POST);
	$blogdata=$ad_blog->GetDetailsData($_POST["blog_id"]);
	
	//print_r($_POST);
?>
<script language="javascript">
location.replace('?PID=basic_blog_lineup&cate_id=<?php echo $_REQUEST["cate_id"];?>');
</script>
<?php

		}
		else if($_REQUEST["pmode"]=="delete") {
	$ad_blog->DeleteOneData($_POST["blog_id"]);
	$blogdata=$ad_blog->GetDetailsData($_POST["blog_id"]);
	
	//print_r($_POST);
?>
<script language="javascript">
location.replace('?PID=basic_blog_lineup&cate_id=<?php echo $_REQUEST["cate_id"];?>');
</script>
<?php

		}
else {
		
			$blogdata=$ad_blog->GetDetailsData($_GET["blog_id"]);
			$blogcdata=$ad_blog->GetDetailsCate($blogdata["cate_id"]);
		?><script type="text/javascript">
<!--

function on_load() {
    //==================================================================
    // FCK Editor
    
    var oFCKeditor = new FCKeditor( 'comm' );
    
    oFCKeditor.BasePath = '/fckeditor/';
    oFCKeditor.Width = '600';
    oFCKeditor.Height = '400';
    oFCKeditor.ToolbarSet = 'Mymenu4';
    
    oFCKeditor.ReplaceTextarea();
}

// -->

</script><script>
<!--
//****月によって、日付のselect.optionを変更****
function check3(){
	year=document.update_form.ryear.value;
	month=document.update_form.rmonth.value;
	day=document.update_form.rday.value;
	day_cnt=31;
	if(month=="02"){
		if((year % 4 )!=0){day_cnt=28}	else{day_cnt=29}}
	if((month=="04")|(month=="06")|(month=="09")|(month=="11")){day_cnt=30}

//		前のSELECTをクリアー
			obj=eval("document.update_form.rday") 
			del_cnt=document.update_form.rday.length;
		for(i=0;i<del_cnt;i++){
			obj.options.remove(0);
		}
//		新しいSELECTを組立
		for(i=1;i<=day_cnt;i++){
			new_option=document.createElement("option");
				if(i<10){date="0" +i;} else {date=""+i;}
			new_option.value=date
			new_option.text=date
			obj=eval("document.update_form.rday") 
			obj.options.add(new_option,eval(obj.length));
		}
}
//****月によって、日付のselect.optionを変更****
function set_date_dft(){
		dft_date=document.all.dft_dat.value;
		document.update_form.ryear.value=dft_date.substr(0,4);
		document.update_form.rmonth.value=dft_date.substr(4,2);
		document.update_form.rday.value=dft_date.substr(6,2);
}
function day_chk() {
	if(document.update_form.day_view.checked){
		document.update_form.ryear.value="";
		document.update_form.rmonth.value="";
		document.update_form.rday.value="";
		
	}
	else {
		set_date_dft();
	}
}
//-->
</script>
<?php
		if($blogdata["rdate"]!=NULL) {
			$exday=explode("-",$blogdata["rdate"]);
		}
		else {
			$exday=explode("-",date("Y-m-d"));
		}
		
		$RDATE=date("Ymd",mktime(0,0,0,$exday[1],$exday[2],$exday[0])); 
		$year=$exday[0];
		$month=$exday[1];
		$day=$exday[2];

?>
<form action="" method="post" enctype="multipart/form-data" name="update_form">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top" class="text2" ><span class="textmenu">活動報告・トピックス</span>&gt;<a href="mf_topics_lineup.php?cate_id=<?php echo $_REQUEST["cate_id"];?>&year=<?php echo $blogdata["ryear"]; ?>&month=<?php echo $blogdata["rmonth"]; ?>"><?php echo $blogdata["ryear"]; ?>年<?php echo $blogdata["rmonth"]; ?>月</a>&gt;カテゴリ：
                    <?php 
														$blogcatedata=$dbobj->GetData("select * from blog_cate where cate_id = ".$blogdata["cate_id"]);														
														echo $blogcatedata["cate_name"];
														 ?>
            </td>
        </tr>
        <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top" class="text2">&nbsp;</td>
        </tr>
        <tr>
            <td width="2%" align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top" class="text2"><span class="texttitle_16">日付</span><br>
                <select name="ryear" id="ryear" onChange="check3()">
                <option value="">--</option>
                <?php
			for($yi=-1;$yi<2;$yi++) {
				?>
                <option value="<?php echo $year+$yi;?>" <?php if($yi==0) {echo " selected";}?>><?php echo $year+$yi;?></option>
                <?php
			}
			?>
                </select>
                年
                <select name="rmonth" id="rmonth" onChange="check3()">
                    <option value="">--</option>
                    <?php
			for($mi=1;$mi<13;$mi++) {
				?>
                    <option value="<?php if($mi<10) {echo "0";}echo $mi;?>"<?php if($mi==$month){echo " selected";}?>>
                        <?php if($mi<10) {echo "0";}echo $mi;?>
                        </option>
                    <?php
			}

			?>
                    </select>
                月
                <select name="rday" id="rday">
                    <option value="">--</option>
                    <?php
			$mday=date("t",mktime(0,0,0,$month,$day,$year));
			for($di=1;$di<=$mday;$di++) {
				?>
                    <option value="<?php if($di<10) {echo "0";}echo $di;?>"<?php if($di==$day){echo " selected";}?>>
                        <?php if($di<10) {echo "0";}echo $di;?>
                        </option>
                    <?php
			}

			?>
                    </select>
                日
                <input name="day_view" type="checkbox" id="day_view" value="1" onClick="day_chk()"<?php if($blogdata["rdate"]==NULL) { echo  " checked";}?>>
                <label for="day_view">日付を表示しない</label>
                <input name="dft_dat" type="hidden" id="dft_dat" value="<?php echo $RDATE;?>">
            </td></tr>
        <tr>
            <td align="center" valign="top"><span></span></td>
            <td align="center" valign="top"><img src="/img/sp/7_7.jpg" width="7" height="7" /></td>
        </tr>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top"><span class="texttitle_16">タイトル　</span><font color="#FF0000">※必須</font></td>
        </tr>
        <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top"><span class="texttitle_20">■</span>
                    <input name="title" type="text" id="title" value="<?php echo $blogdata["title"] ?>" size="60">
            </span></td>
        </tr>
        <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">
                <table border="0" align="left" cellpadding="2" cellspacing="1">
                    <?php
		if($blogdata["rdate"]!=NULL) {
			$exday=explode("-",$blogdata["rdate"]);
		}
		else {
			$exday=explode("-",date("Y-m-d"));
		}
		
		$RDATE=date("Ymd",mktime(0,0,0,$exday[1],$exday[2],$exday[0])); 
		$year=$exday[0];
		$month=$exday[1];
		$day=$exday[2];
		?>
                    <!--<tr>
            <td align="left"><input name="day_txt" type="text" id="day_txt" size="40" value="<?php echo $blogdata["day_txt"];?>"></td>
          </tr>-->
                    <?php
	$catedata=$dbobj->GetList("select * from blog_cate order by turn");
	$res=$dbobj->Query("select * from blog_cate order by turn");
	$num=$dbobj->NumRows($res);
	if($num!=0) {
	?>
                    <?php
			}
			?>
                    <?php if($blogsetting["image_chk"]==1) {?>
                    <tr>
                        <td align="left" valign="top" bgcolor="#FFFFFF"><span class="texttitle_16">一覧表示写真</span></td>
                    </tr>
                    <tr>
                        <td align="left" valign="top" bgcolor="#FFFFFF">
                            <?php if($blogdata["image"]!=NULL){
								$pdata=(getimagesize("http://".$_SESSION["DomainData"]["domain_name"].$blogdata["image"]));
							if($pdata[0]>400) {
								 $pdata[0]=400;
							}
					 
						 ?>
                            <img src="<?php echo "http://".$_SESSION["DomainData"]["domain_name"].$blogdata["image"];?>?file=<?php echo time();?>" alt="image" width="<?php echo $pdata[0];?>px"/><br />
                            <label>
                            <input name="delimage" type="checkbox" id="delimage" value="1" />
                                写真削除</label>
                            <?php }?>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" valign="top" bgcolor="#FFFFFF">
                            <input name="imagefile" type="file" id="imagefile">
                        </td>
                    </tr>
                    <?php
					}
				 ?>
                </table>
            </td>
        </tr>
        <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top"><span class="texttitle_16">記事</span></td>
        </tr>
        <tr>
            <td width="2%" align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">
                <p class="texttitle_16">
                    <textarea name="comm"><?php echo $blogdata["comm"];?></textarea>
                </p>
            </td>
        </tr>
        <tr>
            <td align="center" valign="top"><span></span></td>
            <td align="center" valign="top"><img src="/img/sp/7_7.jpg" width="7" height="7" /></td>
        </tr>
    </table>
    <script>
		day_chk();
		  </script>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="center" valign="top" class="text2">
<span class="texttitle_16">公開設定</span>            </td>
        </tr>
        <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="center" valign="top" class="text2">
                <div align="left">
                    <select name="view_chk" id="view_chk">
                        <option value="1"<?php if($blogdata["view_chk"]==1||$blogdata["view_chk"]==NULL){echo " selected";}?>>公開する</option>
                        <option value="0"<?php if($blogdata["view_chk"]==0){echo " selected";}?> >公開しない</option>
                    </select>
                </div>
            </td>
        </tr>
        <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="center" valign="top" class="text2">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="center" valign="top" class="text2">
                <div align="left">
                    <input name="bbtm_regist" type="button" id="bbtm_regist" value="更新する" onclick="datachk()" />
                    <input name="bbtm_del" type="button" id="bbtm_del" value="削除する" onclick="delchk()" />
                    <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onclick="location.replace('?PID=basic_blog_lineup&cate_id=<?php echo $blogdata["cate_id"];?>')" />
                    
                    <input name="pmode" type="hidden" id="pmode" value="update" />
                    <input name="cate_id" type="hidden" id="cate_id" value="<?php echo $blogdata["cate_id"] ?>" />
                    <input name="blog_id" type="hidden" id="blog_id" value="<?php echo $_REQUEST["blog_id"];?>" />
                </div>
            </td>
        </tr>
        <tr>
            <td width="2%" align="left" valign="top">&nbsp;</td>
            <td align="center" valign="top" class="text2">
                <table width="0" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <!--&lt;前のページ&gt; &lt; 1  2  3  4  5  6  7  8  9  次の10件&gt; &lt;次のページ&gt;-->
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center" valign="top"><img src="/img/sp/7_7.jpg" width="7" height="7" /></td>
        </tr>
    </table>
</form><script type="text/javascript">
on_load();
</script>
<?php 
		}
		?>
</td>
        </tr>
        <tr>
          <td align="left" valign="top"><img src="/img/main/title_lower.jpg" width="640" height="12" /></td>
        </tr>
    </table></td>
  </tr>
</table>
<table width="0" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top"><?php include"tmp_footer.html" ?></td>
  </tr>
</table>