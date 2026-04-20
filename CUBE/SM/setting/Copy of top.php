<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
 <form id="form2" name="form2" method="post" action=""><table width="600" border="0" align="center">
              <tr>
                <td width="20">&nbsp;</td>
                <td width="198">新着情報</td>
                <td>
                  <select name="news" size="1" onchange="selchange(this.form)">
                    <option value="1" <?php if($setdata["news"]==1) { echo " selected";}?>>使用する</option>
                    <option value="0"<?php if($setdata["news"]==0) { echo " selected";}?>>使用しない</option>
                  </select>
                </td>
              </tr>
            </table>
            <table width="600" border="0" align="center" id="tb_sub_news" style="display:<?php if($setdata["news"]==1) { echo " block";}else {echo " none";}?>;">
              <tr>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="174">日付</td>
                <td>
                  <select name="news_date" size="1">
                    <option value="1"<?php if($newsdata["date_chk"]==0) { echo " selected";}?>>使用する</option>
                    <option value="0"<?php if($newsdata["date_chk"]==0) { echo " selected";}?>>使用しない</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="174">タイトル</td>
                <td>
                  <select name="news_title" size="1">
                    <option value="1"<?php if($newsdata["title_chk"]==1) { echo " selected";}?>>使用する</option>
                    <option value="0"<?php if($newsdata["title_chk"]==0) { echo " selected";}?>>使用しない</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="174">内容</td>
                <td>
                  <select name="news_comm" size="1">
                    <option value="1"<?php if($newsdata["comm_chk"]==1) { echo " selected";}?>>使用する</option>
                    <option value="0"<?php if($newsdata["comm_chk"]==0) { echo " selected";}?>>使用しない</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="174">リンク</td>
                <td>
                  <select name="news_link" size="1">
                    <option value="1"<?php if($newsdata["news_chk"]==1) { echo " selected";}?>>使用する</option>
                    <option value="0"<?php if($newsdata["news_chk"]==0) { echo " selected";}?>>使用しない</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="174">イメージ画像</td>
                <td>
                  <select name="news_image" size="1">
                    <option value="1"<?php if($newsdata["image_chk"]==1) { echo " selected";}?>>使用する</option>
                    <option value="0"<?php if($newsdata["image_chk"]==0) { echo " selected";}?>>使用しない</option>
                  </select>
                </td>
              </tr>
            </table>
            <table width="600" border="0" align="center">
              <tr>
                <td width="20">&nbsp;</td>
                <td width="198"> 会社概要 </td>
                <td>
                  <select name="company" size="1">
                    <option value="1" <?php if($setdata["company"]==1) { echo " selected";}?>>使用する</option>
                    <option value="0"<?php if($setdata["company"]==0) { echo " selected";}?>>使用しない</option>
                  </select>
                </td>
              </tr>
            </table>
            <table width="600" border="0" align="center">
              <tr>
                <td width="20">&nbsp;</td>
                <td width="198">
                  <div id="div2">施工実績</div>
                </td>
                <td>
                  <select name="sekou" size="1" onchange="selchange(this.form)">
                    <option value="1" <?php if($setdata["sekou"]==1) { echo " selected";}?>>使用する</option>
                    <option value="0"<?php if($setdata["sekou"]==0) { echo " selected";}?>>使用しない</option>
                  </select>
                </td>
              </tr>
            </table>
            <table width="600" border="0" align="center" id="tb_sub_sekou" style=" display:<?php if($setdata["sekou"]==1) { echo " block";}else {echo " none";}?>;">
              <tr>
                <td width="20" align="left">&nbsp;</td>
                <td width="20" align="left">&nbsp;</td>
                <td colspan="3" align="left">カテゴリ</td>
              </tr>
              <tr>
                <td width="20" align="left">&nbsp;</td>
                <td width="20" align="left">&nbsp;</td>
                <td width="20" align="left">&nbsp;</td>
                <td width="150" align="left">タイトル</td>
                <td align="left">
                  <select name="sekou_cate_title" size="1">
                    <option value="1"<?php if($sekoudata["cate_name_chk"]==1) { echo " selected";}?>>使用する</option>
                    <option value="0"<?php if($sekoudata["cate_name_chk"]==0) { echo " selected";}?>>使用しない</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="20" align="left">&nbsp;</td>
                <td width="20" align="left">&nbsp;</td>
                <td width="20" align="left">&nbsp;</td>
                <td width="150" align="left">内容</td>
                <td align="left">
                  <select name="sekou_cate_comm" size="1">
                    <option value="1"<?php if($sekoudata["cate_comm_chk"]==1) { echo " selected";}?>>使用する</option>
                    <option value="0"<?php if($sekoudata["cate_comm_chk"]==0) { echo " selected";}?>>使用しない</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="20" align="left">&nbsp;</td>
                <td width="20" align="left">&nbsp;</td>
                <td width="20" align="left">&nbsp;</td>
                <td width="150" align="left">イメージ画像</td>
                <td align="left">
                  <select name="sekou_cate_image" size="1">
                    <option value="1"<?php if($sekoudata["cate_image_chk"]==1) { echo " selected";}?>>使用する</option>
                    <option value="0"<?php if($sekoudata["cate_image_chk"]==0) { echo " selected";}?>>使用しない</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="20" align="left">&nbsp;</td>
                <td width="20" align="left">&nbsp;</td>
                <td width="20" align="left">&nbsp;</td>
                <td width="150" align="left">詳細ページ上画像</td>
                <td align="left">
                  <select name="sekou_cate_h_image" size="1">
                    <option value="1"<?php if($sekoudata["cate_head_image_chk"]==1) { echo " selected";}?>>使用する</option>
                    <option value="0"<?php if($sekoudata["cate_head_image_chk"]==0) { echo " selected";}?>>使用しない</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="20" align="left">&nbsp;</td>
                <td width="20" align="left">&nbsp;</td>
                <td width="20" align="left">&nbsp;</td>
                <td width="150" align="left">詳細ページ下画像</td>
                <td align="left">
                  <select name="sekou_cate_f_image" size="1">
                    <option value="1"<?php if($sekoudata["cate_foot_image_chk"]==1) { echo " selected";}?>>使用する</option>
                    <option value="0"<?php if($sekoudata["cate_foot_image_chk"]==0) { echo " selected";}?>>使用しない</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="20" align="left">&nbsp;</td>
                <td width="20" align="left">&nbsp;</td>
                <td colspan="3" align="left">&nbsp;</td>
              </tr>
              <tr>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td colspan="3">詳細ページ</td>
              </tr>
              <tr>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="150">タイトル</td>
                <td>
                  <select name="sekou_data_title" size="1">
                    <option value="1"<?php if($sekoudata["data_name_chk"]==1) { echo " selected";}?>>使用する</option>
                    <option value="0"<?php if($sekoudata["data_name_chk"]==0) { echo " selected";}?>>使用しない</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="150">内容</td>
                <td>
                  <select name="sekou_data_comm" size="1">
                    <option value="1"<?php if($sekoudata["data_comm_chk"]==1) { echo " selected";}?>>使用する</option>
                    <option value="0"<?php if($sekoudata["data_comm_chk"]==0) { echo " selected";}?>>使用しない</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="150">イメージ画像</td>
                <td>
                  <select name="sekou_data_image" size="1">
                    <option value="1"<?php if($sekoudata["data_image_chk"]==1) { echo " selected";}?>>使用する</option>
                    <option value="0"<?php if($sekoudata["data_image_chk"]==0) { echo " selected";}?>>使用しない</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="150">追記ページ</td>
                <td>
                  <select name="sekou_data_addtional" size="1">
                    <option value="1"<?php if($sekoudata["data_additional_chk"]==1) { echo " selected";}?>>使用する</option>
                    <option value="0"<?php if($sekoudata["data_additional_chk"]==0) { echo " selected";}?>>使用しない</option>
                  </select>
                </td>
              </tr>
            </table>
            <table width="600" border="0" align="center">
              <tr>
                <td width="20">&nbsp;</td>
                <td width="198"> 施工案内 </td>
                <td>
                  <select name="sekou_info" size="1" onchange="selchange(this.form)">
                    <option value="1" <?php if($setdata["sekou_info"]==1) { echo " selected";}?>>使用する</option>
                    <option value="0"<?php if($setdata["sekou_info"]==0) { echo " selected";}?>>使用しない</option>
                  </select>
                </td>
              </tr>
            </table>
            <table width="600" border="0" align="center" id="tb_sub_sekouinfo" style=" display:<?php if($setdata["sekou_info"]==1) { echo " block";}else {echo " none";}?>;">
              <tr>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td colspan="3">カテゴリ</td>
              </tr>
              <tr>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="150">タイトル</td>
                <td>
                  <select name="sekou_info_cate_title" size="1">
                    <option value="1"<?php if($sekou_infodata["cate_name_chk"]==1) { echo " selected";}?>>使用する</option>
                    <option value="0"<?php if($sekou_infodata["cate_name_chk"]==0) { echo " selected";}?>>使用しない</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="150">内容</td>
                <td>
                  <select name="sekou_info_cate_comm" size="1">
                    <option value="1"<?php if($sekou_infodata["cate_comm_chk"]==1) { echo " selected";}?>>使用する</option>
                    <option value="0"<?php if($sekou_infodata["cate_comm_chk"]==0) { echo " selected";}?>>使用しない</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="150">イメージ画像</td>
                <td>
                  <select name="sekou_info_cate_image" size="1">
                    <option value="1"<?php if($sekou_infodata["cate_image_chk"]==1) { echo " selected";}?>>使用する</option>
                    <option value="0"<?php if($sekou_infodata["cate_image_chk"]==0) { echo " selected";}?>>使用しない</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="150">詳細ページ上画像</td>
                <td>
                  <select name="sekou_info_cate_h_image" size="1">
                    <option value="1"<?php if($sekou_infodata["cate_head_image_chk"]==1) { echo " selected";}?>>使用する</option>
                    <option value="0"<?php if($sekou_infodata["cate_head_image_chk"]==0) { echo " selected";}?>>使用しない</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="150">詳細ページ下画像</td>
                <td>
                  <select name="sekou_info_cate_f_image" size="1">
                    <option value="1"<?php if($sekou_infodata["cate_foot_image_chk"]==1) { echo " selected";}?>>使用する</option>
                    <option value="0"<?php if($sekou_infodata["cate_foot_image_chk"]==0) { echo " selected";}?>>使用しない</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td colspan="3">&nbsp;</td>
              </tr>
              <tr>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td colspan="3">詳細ページ</td>
              </tr>
              <tr>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="150">タイトル</td>
                <td>
                  <select name="sekou_info_data_title" size="1">
                    <option value="1"<?php if($sekou_infodata["data_name_chk"]==1) { echo " selected";}?>>使用する</option>
                    <option value="0"<?php if($sekou_infodata["data_name_chk"]==0) { echo " selected";}?>>使用しない</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="150">内容</td>
                <td>
                  <select name="sekou_info_data_comm" size="1">
                    <option value="1"<?php if($sekou_infodata["data_comm_chk"]==1) { echo " selected";}?>>使用する</option>
                    <option value="0"<?php if($sekou_infodata["data_comm_chk"]==0) { echo " selected";}?>>使用しない</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="150">イメージ画像</td>
                <td>
                  <select name="sekou_info_data_image" size="1">
                    <option value="1"<?php if($sekou_infodata["data_image_chk"]==1) { echo " selected";}?>>使用する</option>
                    <option value="0"<?php if($sekou_infodata["data_image_chk"]==0) { echo " selected";}?>>使用しない</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="150">追記ページ</td>
                <td>
                  <select name="sekou_info_data_addtional" size="1">
                    <option value="1"<?php if($sekou_infodata["data_additional_chk"]==1) { echo " selected";}?>>使用する</option>
                    <option value="0"<?php if($sekou_infodata["data_additional_chk"]==0) { echo " selected";}?>>使用しない</option>
                  </select>
                </td>
              </tr>
            </table>
            <table width="600" border="0" align="center">
              <tr>
                <td width="20">&nbsp;</td>
                <td width="198">リンク</td>
                <td>
                  <select name="link" size="1" onchange="selchange(this.form)">
                    <option value="1" <?php if($setdata["link"]==1) { echo " selected";}?>>使用する</option>
                    <option value="0"<?php if($setdata["link"]==0) { echo " selected";}?>>使用しない</option>
                  </select>
                </td>
              </tr>
            </table>
            <table width="600" border="0" align="center" id="tb_sub_link" style=" display:<?php if($setdata["link"]==1) { echo " block";}else {echo " none";}?>;">
              <tr>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td colspan="3">カテゴリ</td>
              </tr>
              <tr>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="150">タイトル</td>
                <td>
                  <select name="link_cate_title" size="1">
                    <option value="1">使用する</option>
                    <option value="0">使用しない</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="150">内容</td>
                <td>
                  <select name="link_cate_comm" size="1">
                    <option value="1">使用する</option>
                    <option value="0">使用しない</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="150">バナー画像</td>
                <td>
                  <select name="link_cate_banner" size="1">
                    <option value="1">使用する</option>
                    <option value="0">使用しない</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td colspan="3">&nbsp;</td>
              </tr>
              <tr>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td colspan="3">リンクデータ</td>
              </tr>
              <tr>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="150">タイトル</td>
                <td>
                  <select name="link_data_title" size="1">
                    <option value="1">使用する</option>
                    <option value="0">使用しない</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="150">内容</td>
                <td>
                  <select name="link_data_comm" size="1">
                    <option value="1">使用する</option>
                    <option value="0">使用しない</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>URL</td>
                <td>
                  <select name="link_data_url" size="1">
                    <option value="1">使用する</option>
                    <option value="0">使用しない</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="20">&nbsp;</td>
                <td width="150">バナー画像</td>
                <td>
                  <select name="link_data_banner" size="1">
                    <option value="1">使用する</option>
                    <option value="0">使用しない</option>
                  </select>
                </td>
              </tr>
            </table>
            <table width="600" border="0" align="center">
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>
                  <input name="btm_update" type="submit" id="btm_update" value="この内容で更新する" />
                </td>
              </tr>
            </table>
        </form>