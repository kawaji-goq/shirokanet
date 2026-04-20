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
		include ("./hpdata/jyuken1101cojp/mf_designsetting.php");
		$pagetype="gw";
		break;			/* 新着情報 */
		case "news_reg":
		include "./hpdata/jyuken1101cojp/mf_news_reg.php";
		$pagetype="fudousan";
		break;
		case "top_contents_category":
		include ("./hpdata/jyuken1101cojp/top_contents_category.php");
		$pagetype="fudousan";
		break;			/* 新着情報 */
		case "news":
		include "./hpdata/jyuken1101cojp/mf_news.php";
		$pagetype="fudousan";
		break;
		case "hp_basic_link_category":
		include "./hpdata/jyuken1101cojp/mf_link_category.php";
		$pagetype="fudousan";
		break;		
		case "link":
		include "./hpdata/jyuken1101cojp/mf_link_category.php";
		$pagetype="fudousan";
		break;
		case "link_category":
		$pagetype="fudousan";
		include "./hpdata/jyuken1101cojp/mf_link_category.php";
		break;
		case "hp_basic_link_category_reg":
		$pagetype="fudousan";
		include "./hpdata/jyuken1101cojp/mf_link_category_reg.php";
		break;		
		case "link_add":
		include "./hpdata/jyuken1101cojp/mf_link_reg.php";
		$pagetype="fudousan";
		break;
		case "link_up":
		include "./link/update.php";
		$pagetype="fudousan";
		break;
		case "hp_basic_link_d":
		include "./hpdata/jyuken1101cojp/mf_link.php";		
		$pagetype="fudousan";
		break;
		case "hp_basic_link_reg":
		include "./hpdata/jyuken1101cojp/mf_link_reg.php";		
		$pagetype="fudousan";
		break;
		case "link_d_up":
		include "./link/d_update.php";
		$pagetype="fudousan";
		break;
		case "domain":
		include "./domain/top.php";
		break;
		
		/* ブログコンテンツ */
		case "blog":
		$pagetype="fudousan";
		include "./hpdata/jyuken1101cojp/mf_blog_lineup.php";
		break;
		case "basic_blog_lineup":
		$pagetype="fudousan";
		include "./hpdata/jyuken1101cojp/mf_blog_lineup.php";		
		break;		
		case "hp_basic_blog_cate":
		$pagetype="fudousan";		
		include "./hpdata/jyuken1101cojp/mf_blog_cate.php";		
		break;
		case "hp_basic_blog_cate_reg":
		$pagetype="fudousan";
		include "./hpdata/jyuken1101cojp/mf_blog_cate_reg.php";
		break;
		case "basic_blog_reg":
		$pagetype="fudousan";
		include "./hpdata/jyuken1101cojp/mf_blog_reg.php";
		break;
		case "hp_basic_blog_closeup":
		$pagetype="fudousan";		
		include "./hpdata/jyuken1101cojp/mf_blog_closeup.php";		
		break;
		case "blog_dadd":
		$pagetype="fudousan";
		include "./blog2/d_addition.php";
		break;
		case "basic_blog_reg":
		$pagetype="fudousan";
		include "./hpdata/jyuken1101cojp/mf_blog_reg.php";
		break;
		case "hp_basic_blog_cate":
		$pagetype="fudousan";
		
		include "./blog2/d_update.php";
		break;
		case "hp_basic_blog_closeup":
		$pagetype="fudousan";
		include "./hpdata/jyuken1101cojp/mf_blog_closeup.php";
		break;
		case "hp_basic_blog_cate_reg":
		$pagetype="fudousan";
		include "./hpdata/jyuken1101cojp/mf_blog_cate_reg.php";
		break;
		case "patternlist":
		$pagetype="fudousan";
		
		include "./hpdata/jyuken1101cojp/patternlist.php";
		
		break;
		/* ブログコンテンツ */
		
		case "news_setting":
		$pagetype="fudousan";
		include "./news/setting.php";
		break;
		case "banner":
		$pagetype="fudousan";
		include "./hpdata/jyuken1101cojp/mf_banner.php";
		break;
		case "banner_add":
		$pagetype="fudousan";
		include "./banner/d_addition.php";
		break;
		case "banner_up":
		$pagetype="fudousan";
		include "./banner/d_update.php";
		break;
		case "vup":
		$pagetype="fudousan";
		include "./vup/top.php";
		break;
		case "vup_d":
		$pagetype="fudousan";
		include "./vup/details.php";
		break;
		case "tenpo":
		$pagetype="gw";
		include ("./tenpo/index.php");
		break;
		case "contents_category":
			include "./hpdata/jyuken1101cojp/mf_contents_category.php";
		$pagetype="fudousan";
		break;
		case "contents_details":
		if($_REQUEST["pattern"]=="freelist"){
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/jyuken1101cojp/su/mf_freelist_up.php";
		}
		else {
		include "./hpdata/jyuken1101cojp/mf_list.php";
		}
			}
			elseif($_REQUEST["pattern"]=="freepage"){
				if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/jyuken1101cojp/su/mf_about.php";
		}
		else {
		include "./hpdata/jyuken1101cojp/mf_about.php";
					}
				}
				else if($_REQUEST["pattern"]=="plist"){
		include "./hpdata/jyuken1101cojp/mf_plist.php";
					}
					else if($_REQUEST["pattern"]=="ppage") {
	if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/jyuken1101cojp/su/mf_about.php";
		}
		else {
		include "./hpdata/jyuken1101cojp/mf_about.php";
}
		}
		$pagetype="fudousan";
		break;
case "contents_list_reg":
		if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/jyuken1101cojp/su/mf_about.php";
		}
		else {

		include "./hpdata/jyuken1101cojp/mf_list_reg.php";
}		
		$pagetype="fudousan";
break;
case "contents_plist_reg":
		include "./hpdata/jyuken1101cojp/mf_plist_reg.php";
		$pagetype="fudousan";
break;
case "contents_list_up":
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/jyuken1101cojp/su/mf_about.php";
		}
		else {
	include "./hpdata/jyuken1101cojp/mf_list_up.php";
}		
		$pagetype="fudousan";
break;

case "contents_plist_up":
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/jyuken1101cojp/su/mf_plist_up.php";
		}
		else {
	include "./hpdata/jyuken1101cojp/mf_plist_up.php";
}		
		$pagetype="fudousan";
break;
		case "link_category":
		include "./hpdata/jyuken1101cojp/mf_link_category.php";
		$pagetype="fudousan";
		break;
		case "link_category_reg":
		
			include "./hpdata/jyuken1101cojp/mf_link_category_reg.php";
		$pagetype="fudousan";
		break;
		case "link_d":
		include "./hpdata/jyuken1101cojp/mf_link.php";
		$pagetype="fudousan";
		break;
		case "banner":
		include "./hpdata/jyuken1101cojp/mf_banner.php";
		$pagetype="fudousan";
		break;
		case "news":
		include "./hpdata/jyuken1101cojp/mf_news.php";
		$pagetype="fudousan";
		break;
		case "news_reg":
		include "./hpdata/jyuken1101cojp/mf_news_reg.php";
		$pagetype="fudousan";
		break;
		case "contents_category_reg":
		
		if($_SESSION["editmode"]=="webmaster"){
				include "./hpdata/jyuken1101cojp/su/mf_contents_category.php";
		}
		else {
		include "./hpdata/jyuken1101cojp/mf_contents_category_reg.php";
		}
		
		$pagetype="fudousan";
		break;
		case "contents_category_up":
		if($_SESSION["editmode"]=="webmaster"){
				include "./hpdata/jyuken1101cojp/su/mf_contents_category.php";
		}
		else {
		include "./hpdata/jyuken1101cojp/mf_contents_category_up.php";
		}
		
		$pagetype="fudousan";
		break;
		case "blog_lineup":
		include "./hpdata/jyuken1101cojp/mf_blog_lineup.php";
		$pagetype="fudousan";
		break;
		case "blog_closeup":
		include "./hpdata/jyuken1101cojp/mf_blog_closeup.php";
		$pagetype="fudousan";
		break;
		case "menu":
		include "./hpdata/jyuken1101cojp/mf_menu.php";
		$pagetype="fudousan";
		break;
		case "pagesetting":
		include "./hpdata/jyuken1101cojp/mf_pagesetting.php";
		$pagetype="fudousan";
		break;
		case "blog_cate":
		include "./hpdata/jyuken1101cojp/mf_blog_cate.php";
		$pagetype="fudousan";
		break;
		case "blog_cate_reg":
		include "./hpdata/jyuken1101cojp/mf_blog_cate_reg.php";
		$pagetype="fudousan";
		break;
		case "blog_reg":
		
		include "./hpdata/jyuken1101cojp/mf_blog_reg.php";
		$pagetype="fudousan";
		
		break;
		case "contact":
		
		include "./hpdata/jyuken1101cojp/mf_contact.php";
		$pagetype="fudousan";
		
		break;
		
		case "link_reg":
		
		include "./hpdata/jyuken1101cojp/mf_link_reg.php";
		$pagetype="fudousan";
		break;
	
case "contents2_list_reg":
		if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/jyuken1101cojp/su/mf_about2.php";
		}
		else {

		include "./hpdata/jyuken1101cojp/mf_list2_reg.php";
}		
		$pagetype="fudousan";
break;
case "contents2_plist_reg":
		include "./hpdata/jyuken1101cojp/mf_plist2_reg.php";
		$pagetype="fudousan";
break;

case "contents2_list_up":
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/jyuken1101cojp/su/mf_about2.php";
		}
		else {
	include "./hpdata/jyuken1101cojp/mf_list2_up.php";
}		
		$pagetype="fudousan";
break;

case "contents2_plist_up":
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/jyuken1101cojp/su/mf_plist2_up.php";
		}
		else {
	include "./hpdata/jyuken1101cojp/mf_plist2_up.php";
}		
		$pagetype="fudousan";
break;
		case "contents2_category_reg":
		
		if($_SESSION["editmode"]=="webmaster"){
				include "./hpdata/jyuken1101cojp/su/mf_contents2_category.php";
		}
		else {
		include "./hpdata/jyuken1101cojp/mf_contents2_category_reg.php";
		}
		
		$pagetype="fudousan";
		break;
		case "contents2_category_up":
		if($_SESSION["editmode"]=="webmaster"){
				include "./hpdata/jyuken1101cojp/su/mf_contents2_category.php";
		}
		else {
		include "./hpdata/jyuken1101cojp/mf_contents2_category_up.php";
		}
		
		$pagetype="fudousan";
		break;
				case "contents2_category":
		if($_SESSION["editmode"]=="webmaster"){
				include "./hpdata/jyuken1101cojp/su/mf_contents2_category.php";
		}
		else {
		include "./hpdata/jyuken1101cojp/mf_contents2_category.php";
		}
		$pagetype="fudousan";
		break;
		case "contents2_details":
		if($_REQUEST["pattern"]=="freelist"){
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/jyuken1101cojp/su/mf_freelist2_up.php";
		}
		else {
		include "./hpdata/jyuken1101cojp/mf_list2.php";
		}
			}
			elseif($_REQUEST["pattern"]=="freepage"){
				if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/jyuken1101cojp/su/mf_about2.php";
		}
		else {
		include "./hpdata/jyuken1101cojp/mf_about2.php";
					}
				}
				else if($_REQUEST["pattern"]=="plist"){
		include "./hpdata/jyuken1101cojp/mf_plist2.php";
					}
					else if($_REQUEST["pattern"]=="ppage") {
	if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/jyuken1101cojp/su/mf_about2.php";
		}
		else {
		include "./hpdata/jyuken1101cojp/mf_about2.php";
}
		}
		$pagetype="fudousan";
		break;
	case "company":
		include ("./company/top.php");
		$pagetype="fudousan";
		break;			/* 新着情報 */	
	case "staff_d_add":
		include ("./staff/d_addition.php");
		$pagetype="fudousan";
		break;		
	case "staff_d_up":
		include ("./staff/d_update.php");
		$pagetype="fudousan";
		break;			/* 新着情報 */	
		
		
		/* 新着情報 */	
	case "top_contents_category_reg":
		include ("./hpdata/jyuken1101cojp/top_contents_category_reg.php");
		$pagetype="fudousan";
		break;			/* 新着情報 */	
		case "top_contents_category_up":
		include ("./hpdata/jyuken1101cojp/top_contents_category_up.php");
		$pagetype="fudousan";
		break;			/* 新着情報 */	
		
	case "top_contents":
			include "./hpdata/jyuken1101cojp/top_plist.php";
		$pagetype="fudousan";
	break;
	case "top_contents_reg":
			include "./hpdata/jyuken1101cojp/top_plist_reg.php";
		$pagetype="fudousan";
	break;
	case "top_contents_up":
			include "./hpdata/jyuken1101cojp/top_plist_up.php";
		$pagetype="fudousan";
	break;
	case "top_flash_up":
	if($_SESSION["editmode"]=="webmaster"){
			include "./hpdata/jyuken1101cojp/su/top_flash.php";
	}
	else if($_SESSION["loginmode"]=="su"){
		include "./hpdata/jyuken1101cojp/su/top_flash.php";
		}
		else {
			include "./hpdata/jyuken1101cojp/top_flash_up.php";
		}
		$pagetype="fudousan";
	break;
	case "template":
	if($_SESSION["editmode"]=="webmaster"){
			include "./hpdata/jyuken1101cojp/template.php";
	}
		$pagetype="fudousan";
	break;

	case "template_reg":
	if($_SESSION["editmode"]=="webmaster"){
			include "./hpdata/jyuken1101cojp/template_reg.php";
	}
		$pagetype="fudousan";
	break;
	case "template_up":
	if($_SESSION["editmode"]=="webmaster"){
			include "./hpdata/jyuken1101cojp/template_up.php";
	}
		$pagetype="fudousan";
	break;
	case "template_cate":
	if($_SESSION["editmode"]=="webmaster"){
			include "./hpdata/jyuken1101cojp/template_cate.php";
	}
		$pagetype="fudousan";
	break;
	case "template_cate_up":
	if($_SESSION["editmode"]=="webmaster"){
			include "./hpdata/jyuken1101cojp/template_cate_up.php";
	}
		$pagetype="fudousan";
	break;

	case "top_template":
	if($_SESSION["editmode"]=="webmaster"){
			include "./hpdata/jyuken1101cojp/top_template.php";
	}
		$pagetype="fudousan";
	break;
	case "top_template_up":
	if($_SESSION["editmode"]=="webmaster"){
			include "./hpdata/jyuken1101cojp/top_template_up.php";
	}
		$pagetype="fudousan";
	break;
		case "qa":
					$pagetype="fudousan";
					include "./hpdata/jyuken1101cojp/qa_category.php";
					break;
		   		case "qa_category":
					include "./hpdata/jyuken1101cojp/qa_category.php";
					$pagetype="fudousan";
					break;
		   		case "qa_setting":
					include "./hpdata/jyuken1101cojp/qanda/setting.php";
					$pagetype="fudousan";
					break;
		   
						case "qa_add":	
						$pagetype="fudousan";
					include "./hpdata/jyuken1101cojp/qa_addition.php";
					break;
		   		case "qa_up":
					$pagetype="fudousan";
					include "./hpdata/jyuken1101cojp/qa_update.php";
					break;
		   		case "qa_details":
					include "./hpdata/jyuken1101cojp/qa_d_top.php";
					$pagetype="fudousan";
					break;
		   		case "qa_d_add":
					include "./hpdata/jyuken1101cojp/qa_d_addition.php";
					$pagetype="fudousan";
					break;
				
		   		case "qa_d_up":
					include "./hpdata/jyuken1101cojp/qa_d_update.php";	
					$pagetype="fudousan";
					break;
		   		case "link_header":
					include "./hpdata/jyuken1101cojp/link_header.php";	
					$pagetype="fudousan";
					break;
					
		   		case "qanda":
					$pagetype="fudousan";
					include "./hpdata/jyuken1101cojp/qanda/d_top.php";
					break;
		   		case "qanda_category":
					include "./hpdata/jyuken1101cojp/qanda/category.php";
					$pagetype="fudousan";
					break;
		   		case "qanda_setting":
					include "./hpdata/jyuken1101cojp/qanda/setting.php";
					$pagetype="fudousan";
					break;
		   		case "qanda_add":
					include "./hpdata/jyuken1101cojp/qanda/addition.php";
					break;
		   		case "qanda_up":
					$pagetype="fudousan";
					include "./hpdata/jyuken1101cojp/qanda/update.php";
					break;
		   		case "qanda_details":
					if($_REQUEST["cate_id"]=="") {
						$_REQUEST["cate_id"]=1;
					}
					include "./hpdata/jyuken1101cojp/qanda/d_top.php";
					$pagetype="fudousan";
					break;
					
		   		case "qanda_d_add":
					include "./hpdata/jyuken1101cojp/qanda/d_addition.php";
					$pagetype="fudousan";
					break;
		   		case "qanda_d_up":
					$pagetype="fudousan";
					include "./hpdata/jyuken1101cojp/qanda/d_update.php";
					break;
				case "link_header_reg":
					include "./hpdata/jyuken1101cojp/link_header_reg.php";	
					$pagetype="fudousan";
					break;
					
				case "link_header_up":
					include "./hpdata/jyuken1101cojp/link_header_up.php";	
					$pagetype="fudousan";
					break;					
					
				case "qanda_header":
					include "./hpdata/jyuken1101cojp/qanda_header.php";	
					$pagetype="fudousan";
					break;
					
				case "qanda_header_reg":
					include "./hpdata/jyuken1101cojp/qanda_header_reg.php";	
					$pagetype="fudousan";
					break;
					
		case "qanda_header_up":
					include "./hpdata/jyuken1101cojp/qanda_header_up.php";	
					$pagetype="fudousan";
					break;				
		case "topics_header":
					include "./hpdata/jyuken1101cojp/topics_header.php";	
					$pagetype="fudousan";
					break;
					
		case "topics_header_reg":
					include "./hpdata/jyuken1101cojp/topics_header_reg.php";	
					$pagetype="fudousan";
					break;
					
		case "topics_header_up":
					include "./hpdata/jyuken1101cojp/topics_header_up.php";	
					$pagetype="fudousan";
					break;
					
		case "contact_header":
					include "./hpdata/jyuken1101cojp/contact_header.php";	
					$pagetype="fudousan";
					break;
					
		case "contact_header_reg":
					include "./hpdata/jyuken1101cojp/contact_header_reg.php";	
					$pagetype="fudousan";
					break;
					
		case "contact_header_up":
					include "./hpdata/jyuken1101cojp/contact_header_up.php";	
					$pagetype="fudousan";
					break;				
				
		case "company_header":
					include "./hpdata/jyuken1101cojp/company_header.php";	
					$pagetype="fudousan";
					break;
					
		case "company_header_reg":
					include "./hpdata/jyuken1101cojp/company_header_reg.php";	
					$pagetype="fudousan";
					break;
					
		case "company_header_up":
					include "./hpdata/jyuken1101cojp/company_header_up.php";	
					$pagetype="fudousan";
					break;				
		case "recipe":
					include "./hpdata/jyuken1101cojp/recipe.php";	
					$pagetype="fudousan";
					break;
		case "recipe_cate":
					include "./hpdata/jyuken1101cojp/recipe_cate.php";	
					$pagetype="fudousan";
					break;
					
		case "recipe_cate_reg":
					include "./hpdata/jyuken1101cojp/recipe_cate_reg.php";	
					$pagetype="fudousan";
					break;
		case "recipe2":
					include "./hpdata/jyuken1101cojp/recipe2.php";	
					$pagetype="fudousan";
					break;
					
		case "recipe_reg":
					include "./hpdata/jyuken1101cojp/recipe_reg.php";	
					$pagetype="fudousan";
					break;
		case "recipe_header":
					include "./hpdata/jyuken1101cojp/recipe_header_list.php";	
					$pagetype="fudousan";
					break;

		case "recipe_header_reg":
					include "./hpdata/jyuken1101cojp/recipe_header_reg.php";	
					$pagetype="fudousan";
					break;

		case "sekou_list":
							$pagetype="fudousan";

					include "./hpdata/jyuken1101cojp/sekou_list.php";	
					break;
		case "sekou_reg":
							$pagetype="fudousan";

					include "./hpdata/jyuken1101cojp/sekou_reg.php";	
					break;
		case "sekou_up":
							$pagetype="fudousan";

					include "./hpdata/jyuken1101cojp/sekou_up.php";	
					break;
					
		case "recipe_header_up":
		
					include "./hpdata/jyuken1101cojp/recipe_header_up.php";	
					$pagetype="fudousan";
					break;

		case "recipe_info":
		
					include "./hpdata/jyuken1101cojp/recipe_info.php";	
					$pagetype="fudousan";
					break;
		case "recipe_mate":
		
					include "./hpdata/jyuken1101cojp/recipe_mate.php";	
					$pagetype="fudousan";
					break;
	case "recipe_how2":
		
					include "./hpdata/jyuken1101cojp/recipe_how2.php";	
					$pagetype="fudousan";
					break;
						/*
						 *fudousan
							*/
						//fudousan
						case "re_inputcsv":
					$pagetype="fudousan";
							include "./hpdata/jyuken1101cojp/realestate/inputcsv.php";
							break;
						case "re_c1":
						$pagetype="fudousan";
						include "./hpdata/jyuken1101cojp/realestate/c1/top.php";
							break;
						case "re_c1_rep":
					$pagetype="fudousan";
					if($fudousanschk["use_chk"]==1||$_SESSION["DomainData"]["dbtype"]=="mysql") { 
							include "./hpdata/jyuken1101cojp/realestate/c1/replace2.php";
					}
					else {
							include "./hpdata/jyuken1101cojp/realestate/c1/replace.php";
						}
							break;
						case "re_c1_del":
					$pagetype="fudousan";
							include "./hpdata/jyuken1101cojp/realestate/c1/delete.php";
							break;			
						case "re_c1_add":
					$pagetype="fudousan";
					if($fudousanschk["use_chk"]==1||$_SESSION["DomainData"]["dbtype"]=="mysql") { 
							include "./hpdata/jyuken1101cojp/realestate/c1/addition2.php";
					}
					else {
							include "./hpdata/jyuken1101cojp/realestate/c1/addition.php";
						}
							break;
						case "re_c1_copy":
					$pagetype="fudousan";
					if($fudousanschk["use_chk"]==1||$_SESSION["DomainData"]["dbtype"]=="mysql") { 
							include "./hpdata/jyuken1101cojp/realestate/c1/copy2.php";
					}
					else {
							include "./hpdata/jyuken1101cojp/realestate/c1/copy.php";
						}
							break;
						case "re_c1_set":
					$pagetype="fudousan";
							include "./hpdata/jyuken1101cojp/realestate/c1/setting.php";
							break;
						case "re_c2_copy":
					$pagetype="fudousan";
					if($fudousanschk["use_chk"]==1||$_SESSION["DomainData"]["dbtype"]=="mysql") { 
							include "./hpdata/jyuken1101cojp/realestate/c2/copy2.php";
					}
					else {
							include "./hpdata/jyuken1101cojp/realestate/c2/copy.php";
						}
							break;
						case "re_c3_copy":
					$pagetype="fudousan";
					if($fudousanschk["use_chk"]==1||$_SESSION["DomainData"]["dbtype"]=="mysql") { 
							include "./hpdata/jyuken1101cojp/realestate/c3/copy2.php";
					}
					else {
							include "./hpdata/jyuken1101cojp/realestate/c3/copy.php";
						}
							break;
						case "re_b1_copy":
					$pagetype="fudousan";
					if($fudousanschk["use_chk"]==1||$_SESSION["DomainData"]["dbtype"]=="mysql") { 
							include "./hpdata/jyuken1101cojp/realestate/b1/copy2.php";
					}
					else {
							include "./hpdata/jyuken1101cojp/realestate/b1/copy.php";
						}
							break;
						case "re_b2_copy":
					$pagetype="fudousan";
					if($fudousanschk["use_chk"]==1||$_SESSION["DomainData"]["dbtype"]=="mysql") { 
							include "./hpdata/jyuken1101cojp/realestate/b2/copy2.php";
					}
					else {
							include "./hpdata/jyuken1101cojp/realestate/b2/copy.php";
						}
							break;
						case "re_b3_copy":
					$pagetype="fudousan";
					if($fudousanschk["use_chk"]==1||$_SESSION["DomainData"]["dbtype"]=="mysql") { 
							include "./hpdata/jyuken1101cojp/realestate/b3/copy2.php";
					}
					else {
							include "./hpdata/jyuken1101cojp/realestate/b3/copy.php";
						}
							break;
						case "re_c2":
					$pagetype="fudousan";
							include "./hpdata/jyuken1101cojp/realestate/c2/top.php";
							break;
						case "re_c2_set":
					$pagetype="fudousan";
							include "./hpdata/jyuken1101cojp/realestate/c2/setting.php";
							break;
						case "re_c2_add":
					$pagetype="fudousan";
					if($fudousanschk["use_chk"]==1||$_SESSION["DomainData"]["dbtype"]=="mysql") { 
							include "./hpdata/jyuken1101cojp/realestate/c2/addition2.php";
					}
					else {
							include "./hpdata/jyuken1101cojp/realestate/c2/addition.php";
						}
							break;
						case "re_c2_rep":
					$pagetype="fudousan";
					if($fudousanschk["use_chk"]==1||$_SESSION["DomainData"]["dbtype"]=="mysql") { 
							include "./hpdata/jyuken1101cojp/realestate/c2/replace2.php";
					}
					else {
							include "./hpdata/jyuken1101cojp/realestate/c2/replace.php";
						}
							break;
						case "re_c2_del":
					$pagetype="fudousan";
							include "./hpdata/jyuken1101cojp/realestate/c2/delete.php";
							break;			
						case "re_c3_add":
					$pagetype="fudousan";
					if($fudousanschk["use_chk"]==1||$_SESSION["DomainData"]["dbtype"]=="mysql") { 
							include "./hpdata/jyuken1101cojp/realestate/c3/addition2.php";
					}
					else {
							include "./hpdata/jyuken1101cojp/realestate/c3/addition.php";
						}
							break;
						case "re_c3":
					$pagetype="fudousan";
							include "./hpdata/jyuken1101cojp/realestate/c3/top.php";
							break;
						case "re_c3_set":
					$pagetype="fudousan";
							include "./hpdata/jyuken1101cojp/realestate/c3/setting.php";
							break;
						case "re_c3_rep":
						$pagetype="fudousan";
						if($fudousanschk["use_chk"]==1||$_SESSION["DomainData"]["dbtype"]=="mysql") { 
								include "./hpdata/jyuken1101cojp/realestate/c3/replace2.php";
						}
						else {
							include "./hpdata/jyuken1101cojp/realestate/c3/replace.php";
						}
							break;
						case "re_c3_del":
					$pagetype="fudousan";
							include "./hpdata/jyuken1101cojp/realestate/c3/delete.php";
							break;			
						case "re_b1":
					$pagetype="fudousan";
							include "./hpdata/jyuken1101cojp/realestate/b1/top.php";
							break;
						case "re_b1_rep":
					$pagetype="fudousan";
					if($fudousanschk["use_chk"]==1||$_SESSION["DomainData"]["dbtype"]=="mysql") { 
							include "./hpdata/jyuken1101cojp/realestate/b1/replace2.php";
					}
					else {
							include "./hpdata/jyuken1101cojp/realestate/b1/replace.php";
						}
							break;
						case "re_b1_del":
					$pagetype="fudousan";
							include "./hpdata/jyuken1101cojp/realestate/b1/delete.php";
							break;			
						case "re_b1_add":
					$pagetype="fudousan";
					if($fudousanschk["use_chk"]==1||$_SESSION["DomainData"]["dbtype"]=="mysql") { 
							include "./hpdata/jyuken1101cojp/realestate/b1/addition2.php";
					}
					else {
							include "./hpdata/jyuken1101cojp/realestate/b1/addition.php";
						}
							break;
						case "re_b1_set":
					$pagetype="fudousan";
							include "./hpdata/jyuken1101cojp/realestate/b1/setting.php";
							break;
						case "re_b2":
					$pagetype="fudousan";
							include "./hpdata/jyuken1101cojp/realestate/b2/top.php";
							break;
						case "re_b2_add":
					$pagetype="fudousan";
					if($fudousanschk["use_chk"]==1||$_SESSION["DomainData"]["dbtype"]=="mysql") { 
							include "./hpdata/jyuken1101cojp/realestate/b2/addition2.php";
					}
					else {
							include "./hpdata/jyuken1101cojp/realestate/b2/addition.php";
						}
							break;
						case "re_b2_rep":
					$pagetype="fudousan";
					if($fudousanschk["use_chk"]==1||$_SESSION["DomainData"]["dbtype"]=="mysql") { 
							include "./hpdata/jyuken1101cojp/realestate/b2/replace2.php";
					}
					else {
							include "./hpdata/jyuken1101cojp/realestate/b2/replace.php";
						}
							break;
						case "re_b2_del":
					$pagetype="fudousan";
							include "./hpdata/jyuken1101cojp/realestate/b2/delete.php";
							break;			
						case "re_b2_set":
					$pagetype="fudousan";
							include "./hpdata/jyuken1101cojp/realestate/b2/setting.php";
							break;
						case "re_b3":
					$pagetype="fudousan";
							include "./hpdata/jyuken1101cojp/realestate/b3/top.php";
							break;
						case "re_b3_rep":
					$pagetype="fudousan";
					if($fudousanschk["use_chk"]==1||$_SESSION["DomainData"]["dbtype"]=="mysql") { 
							include "./hpdata/jyuken1101cojp/realestate/b3/replace2.php";
					}
					else {
							include "./hpdata/jyuken1101cojp/realestate/b3/replace.php";
						}
							break;
						case "re_b3_del":
					$pagetype="fudousan";
							include "./hpdata/jyuken1101cojp/realestate/b3/delete.php";
							break;			
						case "re_b3_add":
					$pagetype="fudousan";
					if($fudousanschk["use_chk"]==1||$_SESSION["DomainData"]["dbtype"]=="mysql") { 
							include "./hpdata/jyuken1101cojp/realestate/b3/addition2.php";
					}
					else {
							include "./hpdata/jyuken1101cojp/realestate/b3/addition.php";
						}
							break;
						case "re_b3_set":
					$pagetype="fudousan";
							include "./hpdata/jyuken1101cojp/realestate/b3/setting.php";
							break;
						case "re_tenpo_up":
					$pagetype="fudousan";
							include "./hpdata/jyuken1101cojp/realestate/tenpo.php";
							break;			
						case "re_area":
					$pagetype="fudousan";
							include "./hpdata/jyuken1101cojp/realestate/area/top.php";
							break;
						case "re_area_clist":
					$pagetype="fudousan";
							include "./hpdata/jyuken1101cojp/realestate/area/clist.php";
							break;
						case "re_area_up":
					$pagetype="fudousan";
							include "./hpdata/jyuken1101cojp/realestate/area/update.php";
							break;
						case "re_chiikilist":
					$pagetype="fudousan";
							include "./hpdata/jyuken1101cojp/realestate/area/update.php";
							break;
						case "re_area_chiiki_reg":
					$pagetype="fudousan";
							include "./hpdata/jyuken1101cojp/realestate/area/creg.php";
							break;
						case "re_area_del":
					$pagetype="fudousan";
							include "./hpdata/jyuken1101cojp/realestate/area/delete.php";
							break;
						case "re_setting":
					$pagetype="fudousan";
							include "./hpdata/jyuken1101cojp/realestate/c1/setting.php";
							break;
						case "re_osetting":
					$pagetype="fudousan";
							include "./hpdata/jyuken1101cojp/realestate/oset.php";
							break;
					
					
						case "toppage":
					$pagetype="fudousan";
							include "./hpdata/jyuken1101cojp/toppage.php";
							break;
		default:

					$pagetype="fudousan";
							include "./hpdata/jyuken1101cojp/sekou_list.php";
							break;
		
	}	

?>