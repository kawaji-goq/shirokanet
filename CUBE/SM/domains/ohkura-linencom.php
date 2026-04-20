<?php
/*
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<?php
*/
	switch($_REQUEST["PID"]){
			/* 携帯 */
		case "keitai":
		include ("./keitai/index.php");
		$pagetype="gw";
		break;	
case "designsetting":
		include ("./hpdata/ohkura-linencom/mf_designsetting.php");
		$pagetype="gw";
		break;			/* 新着情報 */
		case "news_reg":
		include "./hpdata/ohkura-linencom/mf_news_reg.php";
		$pagetype="hp";
		break;
		case "news":
		include "./hpdata/ohkura-linencom/mf_news.php";
		$pagetype="hp";
		break;
		case "hp_basic_link_category":
		include "./hpdata/ohkura-linencom/mf_link_category.php";
		$pagetype="hp";
		break;		
		case "link":
		include "./hpdata/ohkura-linencom/mf_link_category.php";
		$pagetype="hp";
		break;
		case "link_category":
		$pagetype="hp";
		include "./hpdata/ohkura-linencom/mf_link_category.php";
		break;
		case "hp_basic_link_category_reg":
		$pagetype="hp";
		include "./hpdata/ohkura-linencom/mf_link_category_reg.php";
		break;		
		case "link_add":
		include "./hpdata/ohkura-linencom/mf_link_reg.php";
		$pagetype="hp";
		break;
		case "link_up":
		include "./link/update.php";
		$pagetype="hp";
		break;
		case "hp_basic_link_d":
		include "./hpdata/ohkura-linencom/mf_link.php";		
		$pagetype="hp";
		break;
		case "hp_basic_link_reg":
		include "./hpdata/ohkura-linencom/mf_link_reg.php";		
		$pagetype="hp";
		break;
		case "link_d_up":
		include "./link/d_update.php";
		$pagetype="hp";
		break;
		case "domain":
		include "./domain/top.php";
		break;
		
		/* ブログコンテンツ */
		case "blog":
		$pagetype="hp";
		include "./hpdata/ohkura-linencom/mf_blog_lineup.php";
		break;
		case "basic_blog_lineup":
		$pagetype="hp";
		include "./hpdata/ohkura-linencom/mf_blog_lineup.php";		
		break;		
		case "hp_basic_blog_cate":
		$pagetype="hp";		
		include "./hpdata/ohkura-linencom/mf_blog_cate.php";		
		break;
		case "hp_basic_blog_cate_reg":
		$pagetype="hp";
		include "./hpdata/ohkura-linencom/mf_blog_cate_reg.php";
		break;
		case "basic_blog_reg":
		$pagetype="hp";
		include "./hpdata/ohkura-linencom/mf_blog_reg.php";
		break;
		case "hp_basic_blog_closeup":
		$pagetype="hp";		
		include "./hpdata/ohkura-linencom/mf_blog_closeup.php";		
		break;
		case "blog_dadd":
		$pagetype="hp";
		include "./blog2/d_addition.php";
		break;
		case "basic_blog_reg":
		$pagetype="hp";
		include "./hpdata/ohkura-linencom/mf_blog_reg.php";
		break;
		case "hp_basic_blog_cate":
		$pagetype="hp";
		
		include "./blog2/d_update.php";
		break;
		case "hp_basic_blog_closeup":
		$pagetype="hp";
		include "./hpdata/ohkura-linencom/mf_blog_closeup.php";
		break;
		case "hp_basic_blog_cate_reg":
		$pagetype="hp";
		include "./hpdata/ohkura-linencom/mf_blog_cate_reg.php";
		break;
		case "patternlist":
		$pagetype="hp";
		
		include "./hpdata/ohkura-linencom/patternlist.php";
		
		break;
		/* ブログコンテンツ */
		
		case "news_setting":
		$pagetype="hp";
		include "./news/setting.php";
		break;
		case "banner":
		$pagetype="hp";
		include "./hpdata/ohkura-linencom/mf_banner.php";
		break;
		case "banner_add":
		$pagetype="hp";
		include "./banner/d_addition.php";
		break;
		case "banner_up":
		$pagetype="hp";
		include "./banner/d_update.php";
		break;
		case "vup":
		$pagetype="hp";
		include "./vup/top.php";
		break;
		case "vup_d":
		$pagetype="hp";
		include "./vup/details.php";
		break;
		case "tenpo":
		$pagetype="gw";
		include ("./tenpo/index.php");
		break;
		case "contents_category":
			include "./hpdata/ohkura-linencom/mf_contents_category.php";
		$pagetype="hp";
		break;
		case "contents_details":
		if($_REQUEST["pattern"]=="freelist"){
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/ohkura-linencom/su/mf_freelist_up.php";
		}
		else {
		include "./hpdata/ohkura-linencom/mf_list.php";
		}
			}
			elseif($_REQUEST["pattern"]=="freepage"){
				if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/ohkura-linencom/su/mf_about.php";
		}
		else {
		include "./hpdata/ohkura-linencom/mf_about.php";
					}
				}
				else if($_REQUEST["pattern"]=="plist"){
		include "./hpdata/ohkura-linencom/mf_plist.php";
					}
					else if($_REQUEST["pattern"]=="ppage") {
	if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/ohkura-linencom/su/mf_about.php";
		}
		else {
		include "./hpdata/ohkura-linencom/mf_about.php";
}
		}
		$pagetype="hp";
		break;
case "contents_list_reg":
		if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/ohkura-linencom/su/mf_about.php";
		}
		else {

		include "./hpdata/ohkura-linencom/mf_list_reg.php";
}		
		$pagetype="hp";
break;
case "contents_plist_reg":
		include "./hpdata/ohkura-linencom/mf_plist_reg.php";
		$pagetype="hp";
break;
case "contents_list_up":
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/ohkura-linencom/su/mf_about.php";
		}
		else {
	include "./hpdata/ohkura-linencom/mf_list_up.php";
}		
		$pagetype="hp";
break;

case "contents_plist_up":
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/ohkura-linencom/su/mf_plist_up.php";
		}
		else {
	include "./hpdata/ohkura-linencom/mf_plist_up.php";
}		
		$pagetype="hp";
break;
		case "link_category":
		include "./hpdata/ohkura-linencom/mf_link_category.php";
		$pagetype="hp";
		break;
		case "link_category_reg":
		
			include "./hpdata/ohkura-linencom/mf_link_category_reg.php";
		$pagetype="hp";
		break;
		case "link_d":
		include "./hpdata/ohkura-linencom/mf_link.php";
		$pagetype="hp";
		break;
		case "banner":
		include "./hpdata/ohkura-linencom/mf_banner.php";
		$pagetype="hp";
		break;
		case "news":
		include "./hpdata/ohkura-linencom/mf_news.php";
		$pagetype="hp";
		break;
		case "news_reg":
		include "./hpdata/ohkura-linencom/mf_news_reg.php";
		$pagetype="hp";
		break;
		case "contents_category_reg":
		
		if($_SESSION["editmode"]=="webmaster"){
				include "./hpdata/ohkura-linencom/su/mf_contents_category.php";
		}
		else {
		include "./hpdata/ohkura-linencom/mf_contents_category_reg.php";
		}
		
		$pagetype="hp";
		break;
		case "contents_category_up":
		if($_SESSION["editmode"]=="webmaster"){
				include "./hpdata/ohkura-linencom/su/mf_contents_category.php";
		}
		else {
		include "./hpdata/ohkura-linencom/mf_contents_category_up.php";
		}
		
		$pagetype="hp";
		break;
		case "blog_lineup":
		include "./hpdata/ohkura-linencom/mf_blog_lineup.php";
		$pagetype="hp";
		break;
		case "blog_closeup":
		include "./hpdata/ohkura-linencom/mf_blog_closeup.php";
		$pagetype="hp";
		break;
		case "menu":
		include "./hpdata/ohkura-linencom/mf_menu.php";
		$pagetype="hp";
		break;
		case "pagesetting":
		include "./hpdata/ohkura-linencom/mf_pagesetting.php";
		$pagetype="hp";
		break;
		case "blog_cate":
		include "./hpdata/ohkura-linencom/mf_blog_cate.php";
		$pagetype="hp";
		break;
		case "blog_cate_reg":
		include "./hpdata/ohkura-linencom/mf_blog_cate_reg.php";
		$pagetype="hp";
		break;
		case "blog_reg":
		
		include "./hpdata/ohkura-linencom/mf_blog_reg.php";
		$pagetype="hp";
		
		break;
		case "contact":
		
		include "./hpdata/ohkura-linencom/mf_contact.php";
		$pagetype="hp";
		
		break;
		
		case "link_reg":
		
		include "./hpdata/ohkura-linencom/mf_link_reg.php";
		$pagetype="hp";
		break;
	
case "contents2_list_reg":
		if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/ohkura-linencom/su/mf_about2.php";
		}
		else {

		include "./hpdata/ohkura-linencom/mf_list2_reg.php";
}		
		$pagetype="hp";
break;
case "contents2_plist_reg":
		include "./hpdata/ohkura-linencom/mf_plist2_reg.php";
		$pagetype="hp";
break;

case "contents2_list_up":
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/ohkura-linencom/su/mf_about2.php";
		}
		else {
	include "./hpdata/ohkura-linencom/mf_list2_up.php";
}		
		$pagetype="hp";
break;

case "contents2_plist_up":
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/ohkura-linencom/su/mf_plist2_up.php";
		}
		else {
	include "./hpdata/ohkura-linencom/mf_plist2_up.php";
}		
		$pagetype="hp";
break;
		case "contents2_category_reg":
		
		if($_SESSION["editmode"]=="webmaster"){
				include "./hpdata/ohkura-linencom/su/mf_contents2_category.php";
		}
		else {
		include "./hpdata/ohkura-linencom/mf_contents2_category_reg.php";
		}
		
		$pagetype="hp";
		break;
		case "contents2_category_up":
		if($_SESSION["editmode"]=="webmaster"){
				include "./hpdata/ohkura-linencom/su/mf_contents2_category.php";
		}
		else {
		include "./hpdata/ohkura-linencom/mf_contents2_category_up.php";
		}
		
		$pagetype="hp";
		break;
				case "contents2_category":
		if($_SESSION["editmode"]=="webmaster"){
				include "./hpdata/ohkura-linencom/su/mf_contents2_category.php";
		}
		else {
		include "./hpdata/ohkura-linencom/mf_contents2_category.php";
		}
		$pagetype="hp";
		break;
		case "contents2_details":
		if($_REQUEST["pattern"]=="freelist"){
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/ohkura-linencom/su/mf_freelist2_up.php";
		}
		else {
		include "./hpdata/ohkura-linencom/mf_list2.php";
		}
			}
			elseif($_REQUEST["pattern"]=="freepage"){
				if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/ohkura-linencom/su/mf_about2.php";
		}
		else {
		include "./hpdata/ohkura-linencom/mf_about2.php";
					}
				}
				else if($_REQUEST["pattern"]=="plist"){
		include "./hpdata/ohkura-linencom/mf_plist2.php";
					}
					else if($_REQUEST["pattern"]=="ppage") {
	if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/ohkura-linencom/su/mf_about2.php";
		}
		else {
		include "./hpdata/ohkura-linencom/mf_about2.php";
}
		}
		$pagetype="hp";
		break;
	case "company":
		include ("./hpdata/ohkura-linencom/company.php");
		$pagetype="hp";
		break;			/* 新着情報 */	
	case "staff_d_add":
		include ("./hpdata/ohkura-linencom/staff_add.php");
		$pagetype="hp";
		break;			/* 新着情報 */	
		default:
		if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="smart-spice.jp") {
				include "./hpdata/ohkura-linencom/mf_menu.php";
		}
		else {
			include "./hpdata/ohkura-linencom/index.php";
		}
		$pagetype="hp";
		break;
			
	}	

?>