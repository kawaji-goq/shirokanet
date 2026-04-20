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
  <tr>
    <td>
      <form id="form1" name="form1" method="post" action="">
        <table width="100%" border="0">
          <tr>
            <td width="14%">開始タグ</td>
            <td width="86%">
              <input type="submit" name="Submit" value="ソース表示" />
            </td>
          </tr>
        </table>
        <table width="100%" border="0">
          <tr>
            <td width="14%">&nbsp;</td>
            <td width="86%">
              <textarea name="textarea" style="width:100%;height:100px;" disabled="disabled"><?php echo '<?php
//新着情報の繰り返しの始まりにはこのコードを貼り付けてください。
//この部分は変更しないでください。 
for($newsrow=0;$newsdata[$newsrow];$newsrow++){ 
$newsddata=new Ary_Viewer($newsdata[$newsrow]);
/*-------------------　新着情報繰り返しここから　-------------------*/
?>';?></textarea>
            </td>
          </tr>
        </table>
        <table width="100%" border="0">
          <tr>
            <td width="14%">日付</td>
            <td width="86%">
              <input type="submit" name="Submit" value="ソース表示" />
            </td>
          </tr>
        </table>
        <table width="100%" border="0">
          
          <tr>
            <td width="14%">&nbsp;</td>
            <td width="86%">
              <textarea name="textarea" style="width:100%;height:50px;"><?php echo '<?php $newsddata->Date("rdate","年","月","日"); ?>';?></textarea>
            </td>
          </tr>
        </table>
        <table width="100%" border="0">
          <tr>
            <td width="14%">終了タグ</td>
            <td width="86%">
              <input type="submit" name="Submit" value="ソース表示" />
            </td>
          </tr>
        </table>
        <table width="100%" border="0">
          <tr>
            <td width="14%">&nbsp;</td>
            <td width="86%">
              <textarea name="textarea" style="width:100%;height:100px;"><?php echo '<?php 
/*-------------------　新着情報繰り返しここまで　-------------------*/
}
?>';?></textarea>
            </td>
          </tr>
        </table>
      </form>
    </td>
  </tr>
</table>
