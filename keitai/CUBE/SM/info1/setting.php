<?php 
$sekouobj=new Sekou($dbobj);
if($_POST["btm_update"]=="更新する") {
	
	$updata[]="'".$_POST["listpath"]."'";
	$updata[]="'".$_POST["detailspath"]."'";
	$updata[]="'".$_POST["listimg_w"]."'";
	$updata[]="'".$_POST["listimg_h"]."'";

	$updata[]="'".$_POST["detailsimg_w"]."'";
	$updata[]="'".$_POST["detailsimg_h"]."'";
	$sekouobj->UpdateSet();
}
$setdata=$sekouobj->LoadSet();
?><meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
  <table width="700" border="0" align="center">
    <tr>
      <td width="50"><a href="?PID=news"><img src="/img/jissseki_ic.gif" alt="news" width="50" height="50" border="0" /></a></td>
      <td width="640" align="left">
        <div id="tree">
          <table width="100%" border="0" cellpadding="10" cellspacing="10">
            <tr>
              <td width="25%"><a href="?PID=sekou_list_src">カテゴリ一覧ソース</a></td>
              <td width="25%"><a href="?PID=sekou_detailslist_src">詳細一覧ソース</a></td>
              <td width="25%"><a href="?PID=sekou_setting">施工実績設定</a></td>
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
            <td align="left">ファイルのパス</td>
          </tr>
        </table>
        <table width="600" border="0" align="center">
          <tr>
            <td width="200" align="left">一覧ページ</td>
            <td width="400" align="left">
              <input name="listpath" type="text" id="listpath" value="<?php echo $setdata["listpath"];?>" size="40" />
              <br />
              絶対パス（/で始まるパス）
            で入力して下さい。</td>
          </tr>
          <tr>
            <td width="200" align="left">詳細ページ</td>
            <td width="400" align="left">
              <input name="detailspath" type="text" id="detailspath" size="40" value="<?php echo $setdata["detailspath"];?>" />
              <br />
              絶対パス（/で始まるパス）
            で入力して下さい。 </td>
          </tr>
        </table>
        <table width="600" border="0" align="center">
          <tr>
            <td align="left">一覧用画像</td>
          </tr>
        </table>
        <table width="600" border="0" align="center">
          <tr>
            <td width="200" align="left">横幅</td>
            <td width="400" align="left">
              <input name="listimg_w" type="text" id="listimg_w" size="8" value="<?php echo $setdata["listimg_w"];?>" />
              px</td>
          </tr>
          <tr>
            <td align="left">縦幅</td>
            <td width="400" align="left">
              <input name="listimg_h" type="text" id="listimg_h" size="8" value="<?php echo $setdata["listimg_h"];?>" />
              px</td>
          </tr>
          <tr>
            <td align="left">デフォルト画像</td>
            <td width="400" align="left">
              <input name="listimg_defalt" type="file" id="listimg_defalt" />
            </td>
          </tr>
        </table>
        <table width="600" border="0" align="center">
          <tr>
            <td align="left">詳細用画像サイズ</td>
          </tr>
        </table>
        <table width="600" border="0" align="center">
          <tr>
            <td width="200" align="left">横幅</td>
            <td width="400" align="left">
              <input name="detailsimg_w" type="text" id="detailsimg_w" size="8" value="<?php echo $setdata["detailsimg_w"];?>" />
              px</td>
          </tr>
          <tr>
            <td width="200" align="left">縦幅</td>
            <td width="400" align="left">
              <input name="detailsimg_h" type="text" id="detailsimg_h" size="8" value="<?php echo $setdata["detailsimg_h"];?>" />
              px</td>
          </tr>
          <tr>
            <td width="200" align="left">デフォルト画像</td>
            <td width="400" align="left">
              <input name="detailsimg_defalt" type="file" id="detailsimg_defalt" />
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="left">
        <input name="btm_update" type="submit" id="btm_update" value="更新する" />
      </td>
    </tr>
</form>
  </table>
