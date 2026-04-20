<?php 
$ad_news=new Admin_News($dbobj);
$newscdata=$ad_news->GetDetailsCate($_GET["cate_id"]);
$newssetting=$ad_news->LoadSetting();
?>
<script language="javascript">
function datachk() {
	res=confirm("この内容で登録してもよろしいですか?");
	if(res) {
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
<table width="700" border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
  		<td>
  				<table width="700" border="0" align="center">
							<tr>
									<td width="278"><img src="./img/siteadmin/edit_menu.gif" alt="編集中のエリア" width="278" height="18" /></td>
									<td width="412" align="left">
											<p><strong>　<?php echo $menudata[1]["data_name"]; ?>　&gt;&gt;　データ登録</strong></p>
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
      <form action="" method="post" enctype="multipart/form-data" name="update_form" id="update_form">
<?php 
if($_REQUEST["pmode"]=="regist") {
	$newid=$ad_news->AdditionData($_POST);
		if(($_REQUEST["newday"])==NULL) {
		$_REQUEST["newday"]=$tenpodata["news_newday"];
	}
	if(($_REQUEST["viewday"])==NULL) {
		$_REQUEST["viewday"]=$tenpodata["news_viewday"];
	}
		$dbobj->Query("update news_data set newday=".$_REQUEST["newday"].",viewday=".$_REQUEST["viewday"]." where news_id =".$newid);
	$newsdata=$ad_news->GetDetailsData($newid);

?>
        <table width="700" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <th align="left" bgcolor="#ECECEC">日付</th>
    <td align="left" bgcolor="#FFFFFF"><?php echo $ryear."-".$rmonth."-".$rday;?></td>
  </tr>
          <tr>
            <th width="100" align="left" bgcolor="#ECECEC"><strong>表示テキスト</strong></th>
            <td width="585" align="left" bgcolor="#FFFFFF">
             <?php echo $_POST["new_data_title"];?></td>
          </tr>
        <tr>
            <th align="left" valign="top" bgcolor="#ECECEC">リンク先</th>
            <td align="left" valign="top" bgcolor="#FFFFFF"><?php $_REQUEST["new_link"]; ?>&nbsp;</td>
        </tr>
        <tr>
            <th align="left" valign="top" bgcolor="#ECECEC">ウィンドウ</th>
            <td align="left" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
        <tr>
            <th align="left" valign="top" bgcolor="#ECECEC">表示日時</th>
            <td align="left" valign="top" bgcolor="#FFFFFF">公開日から <?php echo $_REQUEST["viewday"];?>日後に表示を解除</td>
        </tr>
        <tr>
            <th align="left" valign="top" bgcolor="#ECECEC">New表示</th>
            <td align="left" valign="top" bgcolor="#FFFFFF">公開日から <?php echo $_REQUEST["newday"];?> 日後に表示を解除</td>
        </tr>
        
        <tr>
            <th align="left" valign="top" bgcolor="#ECECEC">公開設定</th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
                <?php 
			switch($_REQUEST["new_view_chk"]) {
				case 0:
					echo "公開しない";
					break;
				case 1:
					echo "公開する";
					break;
				default:
					break;
			}
			
			?>
            </td>
        </tr>
        <tr>
            <th align="left" valign="top" bgcolor="#ECECEC">&nbsp;</th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
                <input name="bbtm_regist" type="button" id="bbtm_regist" value="続けて登録する" onClick="location.replace('?PID=news_add&amp;cate_id=<?php echo $_REQUEST["cate_id"];?>')" />
                <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onClick="location.replace('?PID=news&amp;cate_id=<?php echo $_REQUEST["cate_id"];?>')" />
            </td>
        </tr>
        </table>
        <?php
		}
		else {
		?>
        <script>
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
		<table width="700" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
        <?php
		if($newsdata["rdate"]!=NULL) {
			$exday=explode("-",$newsdata["rdate"]);
		}
		else {
			$exday=explode("-",date("Y-m-d"));
		}
		
		$RDATE=date("Ymd",mktime(0,0,0,$exday[1],$exday[2],$exday[0])); 
		$year=$exday[0];
		$month=$exday[1];
		$day=$exday[2];
		?>
          <tr>
            <th rowspan="1" align="left" valign="top" bgcolor="#ECECEC">日付
            <input name="dft_dat" type="hidden" id="dft_dat" value="<?php echo $RDATE;?>"></th>
            <td align="left" bgcolor="#FFFFFF"><select name="ryear" id="ryear" onChange="check3()">
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
				<option value="<?php if($mi<10) {echo "0";}echo $mi;?>"<?php if($mi==$month){echo " selected";}?>><?php if($mi<10) {echo "0";}echo $mi;?></option>
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
				<option value="<?php if($di<10) {echo "0";}echo $di;?>"<?php if($di==$day){echo " selected";}?>><?php if($di<10) {echo "0";}echo $di;?></option>
				<?php
			}

			?>
</select>
日
<input name="day_view" type="checkbox" id="day_view" value="1" onClick="day_chk()"<?php if($newsdata["rdate"]==NULL) { echo  " checked";}?>>
<label for="day_view">日付を表示しない</label></td>
          </tr>
          <tr>
            <th width="102" align="left" valign="top" bgcolor="#ECECEC"><strong>表示テキスト</strong></th>
            <td width="583" align="left" bgcolor="#FFFFFF">
                <input name="new_data_title" type="text" id="new_data_title" value="" size="60">
            </td>
          </tr>
          <tr>
              <th align="left" valign="top" bgcolor="#ECECEC">リンク先</th>
              <td align="left" bgcolor="#FFFFFF">
                  <input name="new_link" type="text" id="new_link" size="50" />
              </td>
          </tr>
          <tr>
              <th align="left" valign="top" bgcolor="#ECECEC">ウィンドウ</th>
              <td align="left" bgcolor="#FFFFFF">
                  <select name="new_linktarget" id="new_linktarget">
                      <option value="_self" selected="selected">ページを移動する</option>
                      <option value="_brank">新しいウィンドウを開く</option>
                  </select>
              </td>
          </tr>
          <tr>
              <th align="left" valign="top" bgcolor="#ECECEC">表示日時</th>
              <td align="left" valign="top" bgcolor="#FFFFFF">公開日から
                  <input name="viewday" type="text" id="viewday" size="4" value="<?php echo $tenpodata["news_viewday"];?>">
                  日後に表示を解除</td>
          </tr>
          <tr>
              <th align="left" valign="top" bgcolor="#ECECEC">New表示</th>
              <td align="left" valign="top" bgcolor="#FFFFFF">公開日から
                  <input name="newday" type="text" id="newday" size="4" value="<?php echo $tenpodata["news_newday"];?>">
                  日後に表示を解除</td>
          </tr>
          
          <tr>
              <th align="left" valign="top" bgcolor="#ECECEC">公開設定</th>
              <td align="left" bgcolor="#FFFFFF">
                  <select name="new_view_chk" id="new_view_chk">
                      <option value="1">公開する</option>
                      <option value="0" selected="selected">公開しない</option>
                  </select>
              </td>
          </tr>
          <tr>
              <th align="left" valign="top" bgcolor="#ECECEC">&nbsp;</th>
              <td align="left" bgcolor="#FFFFFF">
                  <input name="bbtm_regist" type="submit" id="bbtm_regist" value="登録する" onClick="datachk()" />
                  <input name="pmode" type="hidden" id="pmode" value="regist" />
                  <input name="cate_id" type="hidden" id="cate_id" value="0" />
                  <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onClick="location.replace('?PID=news&cate_id=<?php echo $_GET["cate_id"];?>')" />
              </td>
          </tr>
         <?php if($newssetting["image_chk"]==1) {?><?php 
				 }
				 ?>
        </table>
				<div id="type_link" style="display:block;">
				    <script>
		day_chk();
		      </script>

        <?php
		  }
		  ?>
      </div>
    </form>
    </td>
  </tr>
</table>
