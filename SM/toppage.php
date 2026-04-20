<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td width="45"><img src="/members/img/page_sic.gif" width="45" height="40"></td>
		<td>
			<div id="tree"><span class="top">ページ管理</span>　<span class="gt">>></span>　</div>
		</td>
	</tr>
</table>
<table width="700" border="0" align="center" cellpadding="2" cellspacing="2">
	<tr>
		<td colspan="2">&nbsp;</td>
    </tr>
	<tr>
		<td width="160" valign="top">
			<table width="100%" border="0" align="center" cellpadding="2" cellspacing="2">
            	<tr>
            		<td>・<a href="index.php?PID=toppage">TOPページ</a></td>
           		</tr>
            	<tr>
            		<td>・JCとは</td>
           		</tr>
            	<tr>
            		<td width="100%"> 　 <a href="index.php?PID=pageedit&page_id=whatjc1-1">青年会議所とは</a></td>
           		</tr>
            	<tr>
            		<td> 　 <a href="index.php?PID=pageedit&page_id=whatjc1-2">JC宣言</a></td>
           		</tr>
            	<tr>
            		<td> 　 <a href="index.php?PID=pageedit&page_id=whatjc1-3">綱領</a> 　 </td>
           		</tr>
            	<tr>
            		<td>・青年会議所の特性</td>
           		</tr>
            	<tr>
            		<td> 　 <a href="index.php?PID=pageedit&page_id=whatjc2-1">特性</a></td>
           		</tr>
            	<tr>
            		<td> 　 <a href="index.php?PID=pageedit&page_id=whatjc2-2">平均的JC会員像</a></td>
           		</tr>
            	<tr>
            		<td> 　 <a href="index.php?PID=pageedit&page_id=whatjc2-3">産業別</a></td>
           		</tr>
            	<tr>
            		<td> 　 <a href="index.php?PID=pageedit&page_id=whatjc2-4">役職別</a></td>
           		</tr>
            	<tr>
            		<td> 　 <a href="index.php?PID=pageedit&page_id=whatjc2-5">継続者別</a></td>
           		</tr>
            	<tr>
            		<td>・<a href="index.php?PID=pageedit&page_id=whatjc3-1">青年会議所の活動紹介</a></td>
           		</tr>
            	<tr>
            		<td>・国際青年会議所について</td>
           		</tr>
            	<tr>
            		<td> 　 <a href="index.php?PID=pageedit&page_id=whatjc4-1">国際青年会議所</a></td>
           		</tr>
            	<tr>
            		<td> 　 <a href="index.php?PID=pageedit&page_id=whatjc4-2">JCI綱領</a></td>
           		</tr>
            	<tr>
            		<td> 　 <a href="index.php?PID=pageedit&page_id=whatjc4-3">JCI綱領（日本語）</a></td>
           		</tr>
            	<tr>
            		<td>・<a href="index.php?PID=pageedit&page_id=whatjc5-1">青年会議所の組織</a></td>
           		</tr>
            	<tr>
            		<td>&nbsp;</td>
           		</tr>
            	<tr>
            		<td>2007年度JC</td>
           		</tr>
            	<tr>
            		<td>・理事長所信</td>
           		</tr>
            	<tr>
            		<td>・組織図</td>
           		</tr>
            	<tr>
            		<td>・委員会紹介</td>
           		</tr>
            	<tr>
            		<td>&nbsp;</td>
           		</tr>
            	<tr>
            		<td>青少年育成事業</td>
           		</tr>
            	<tr>
            		<td>・構成メンバー</td>
           		</tr>
            	<tr>
            		<td>・基本方針</td>
           		</tr>
            	<tr>
            		<td>・基本計画</td>
           		</tr>
            	<tr>
            		<td>・委員長所信</td>
           		</tr>
            	</table>
		</td>
	    <td valign="top" >
	    	<form name="shiken_correct_form" method="POST" action="">
            	<?php 
	if($_POST["PROCCESS"]=="regist") { 
	$sql="update topcontents set title= '".$_SESSION["title"]."',memo= '".$_SESSION["memo"]."'";
	$_SESSION["new_htmldata"]="";
	$_SESSION["title"]="";
	$result=$dbobj->Query($sql);
	?>
            	<TABLE width="100%"  border="0" align="center" cellpadding="1" cellspacing="1">
            		<TR>
            			<TD width="100%">&nbsp;</TD>
           			</TR>
            		<TR>
            			<TD>
            				<div align="center">更新しました。</div>
           				</TD>
           			</TR>
            		<TR>
            			<TD>
            				<input type="button" name="Submit" value="戻る" onClick="back_toppage()">
           				</TD>
           			</TR>
           		</TABLE>
            	<?php 
	}
	else if($_POST["PROCCESS"]=="check") {
	
	?>
            	<TABLE width="100%"  border="0" align="center" cellpadding="1" cellspacing="1">
            		<TR>
            			<TD><strong>タイトル</strong></TD>
           			</TR>
            		<TR>
            			<TD><?php
					$_SESSION["title"]=$_POST["title"];
					 echo $title;?></TD>
           			</TR>
            		<TR>
            			<TD width="100%"> <strong>内容</strong> </TD>
           			</TR>
            		<TR>
            			<TD>
            				<?php
					$_SESSION["memo"]=$_POST["memo"];
					 echo str_replace("\\","",$memo);?> </TD>
           			</TR>
            		<TR>
            			<TD>
            				<input type="submit" name="Submit" value="更新する">
            				<input type="button" name="Submit" value="戻る" onClick="data_correct()">
            				<input name="PROCCESS" type="hidden" id="PROCCESS" value="regist">
           				</TD>
           			</TR>
           		</TABLE>
            	<?php 
	}
	else {
	?>
            	<TABLE width="100%"  border="0" align="center" cellpadding="1" cellspacing="1">
            		<TR>
            			<TD><strong>タイトル
            				<?php 
			if($_SESSION["title"]==NULL) {
			
				$sql2="select * from topcontents ";
				$result2=$dbobj->Query($sql2);
				$resultnumrows2=$dbobj->NumRows($result2);
				if($resultnumrows2!=0) {
					$data2=$dbobj->FetchArray($result2,0);
				}
			}
			?>
            			</strong></TD>
           			</TR>
            		<TR>
            			<TD>                            <input name="title" type="text" id="title" value="<?php echo $data2["title"];?>" size="40">
</TD>
           			</TR>
            		<TR>
            			<TD width="100%"> <strong> 内容 </strong> </TD>
           			</TR>
            		<TR>
            			<TD>
            				<?php 
			$fckobject=new FCKeditor("memo");
			$fckobject->BasePath="/FCKeditor/";
			$fckobject->Width=500;
			$fckobject->Height=300;
			
			if($_SESSION["memo"]==NULL) {
				$fckobject->Value=$data2[memo];
			}
			else {
				$fckobject->Value=str_replace("\\","",$memo);
			}
			$fckobject->Create();
			?>
           				</TD>
           			</TR>
            		<TR>
            			<TD>
            				<input type="submit" name="Submit" value="確認する">
            				<input type="button" name="Submit" value="戻る" onClick="back_toppage()">
            				<input name="PROCCESS" type="hidden" id="PROCCESS" value="check">
            				<input name="page_id" type="hidden" id="page_id" value="<?php echo $_REQUEST["page_id"];?>">
            			</TD>
           			</TR>
           		</TABLE>
            	<?php 
	}
	?>
           	</form>
        </td>
	</tr>
</table>
<?php 

?>
