<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" >
<form id="form1" name="form1" method="post" action="">
  <table width="700" border="0" align="center">
    <tr>
      <td>ドメイン設定</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>
        <table width="100%" border="0">
          <tr>
            <td>登録名</td>
            <td>
             <?php echo $DomainData["name"];?>
            </td>
          </tr>
          <tr>
            <td width="14%">ドメイン</td>
            <td width="86%">
              <?php echo $DomainData["domain_name"];?>
            </td>
          </tr>
          <tr>
            <td>FTPID</td>
            <td>
             <?php echo $DomainData["id"];?>
            </td>
          </tr>
          <tr>
            <td>FTPパスワード</td>
            <td>
             <?php echo $DomainData["pass"];?>
            </td>
          </tr>

          <tr>
            <td>ADMINID</td>
            <td>
              <input name="adminid" type="text" value="<?php echo $DomainData["admin_id"];?>" style="ime-mode:disabled" />
            </td>
          </tr>
          <tr>
            <td>ADMINPASS</td>
            <td>
              <input name="adminpass" type="text" value="<?php echo $DomainData["passwd"];?>" style="ime-mode:disabled" />
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>
              <input name="btm_adminupdate" type="submit" id="btm_adminupdate" value="更新する" />
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</form>
