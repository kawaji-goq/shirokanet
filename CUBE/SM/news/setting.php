<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php 
$newsobj=new News($dbobj);

if($_POST["btm_update"]=="更新する") {
	$updata[]="'".$_POST["listpath"]."'";
	$updata[]="'".$_POST["detailspath"]."'";
	$updata[]="'".$_POST["listimg_w"]."'";
	$updata[]="'".$_POST["listimg_h"]."'";
	$updata[]="'".$_POST["listimg_defalt"]."'";
	$updata[]="'".$_POST["detailsimg_w"]."'";
	$updata[]="'".$_POST["detailsimg_h"]."'";
	$updata[]="'".$_POST["detailsimg_defalt"]."'";
	$newsobj->UpdateSet($updata);
}

$setdata=$newsobj->LoadSet();

?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<table width="700" border="0" align="center">
  <tr>
    <td width="50"><a href="../../admin/news/?PID=news"><img src="/img/news_ic.jpg" alt="news" width="50" height="50" border="0" /></a></td>
    <td width="640" align="left">
      <div id="tree">
        <table width="100%" border="0" cellpadding="10" cellspacing="10">
          <tr>
            <td width="25%"><a href="../../admin/news/?PID=news_list_src">一覧表示用ソース</a></td>
            <td width="25%"><a href="../../admin/news/?PID=news_setting">News設定</a></td>
            <td width="25%">&nbsp;</td>
            <td width="25%">&nbsp;</td>
          </tr>
        </table>
      </div>
    </td>
  </tr>
</table>
<table width="700" border="0" align="center">
  <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>
        <table width="600" border="0" align="center">
          <tr>
            <th align="left">イメージ画像</th>
          </tr>
        </table>
        <table width="600" border="0" align="center">
          <tr>
            <th width="200" align="left">横幅</th>
            <td width="400" align="left">
              <input name="detailsimg_w" type="text" id="detailsimg_w" size="8" value="<?php echo $setdata["detailsimg_w"];?>" />
              px</td>
          </tr>
          <tr>
            <th align="left">縦幅</th>
            <td width="400" align="left">
              <input name="detailsimg_h" type="text" id="detailsimg_h" size="8" value="<?php echo $setdata["detailsimg_h"];?>" />
              px</td>
          </tr>
          <tr>
            <th align="left">デフォルト画像</th>
            <td width="400" align="left">
              <input name="listimg_defalt" type="file" id="listimg_defalt" />
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
        <input name="btm_update" type="submit" id="btm_update" value="更新する" />
      </td>
    </tr>
  </form>
</table>
