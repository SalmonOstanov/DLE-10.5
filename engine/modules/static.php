<?php
/*
=====================================================
 DataLife Engine - by SoftNews Media Group 
-----------------------------------------------------
 http://dle-news.ru/
-----------------------------------------------------
 Copyright (c) 2004,2015 SoftNews Media Group
=====================================================
 Данный код защищен авторскими правами
=====================================================
 Файл: static.php
-----------------------------------------------------
 Назначение: вывод статистических страниц
=====================================================
*/
if( ! defined( 'DATALIFEENGINE' ) ) {
	die( "Hacking attempt!" );
}

$name = @$db->safesql( trim( totranslit( $_GET['page'], true, false ) ) );

if(!isset($static_result['id']) OR !$static_result['id'] ) $static_result = $db->super_query( "SELECT * FROM " . PREFIX . "_static WHERE name='{$name}'" ); else $static_result['id'] = intval($static_result['id']);

if( $static_result['id'] ) {
	
	if ($static_result['allow_count']) $db->query( "UPDATE " . PREFIX . "_static SET views=views+1 WHERE id='{$static_result['id']}'" );
	
	$static_result['grouplevel'] = explode( ',', $static_result['grouplevel'] );
	
	if( $static_result['date'] ) $_DOCUMENT_DATE = $static_result['date'];

	$disable_index = $static_result['disable_index'];
	
	if( $static_result['grouplevel'][0] != "all" and ! in_array( $member_id['user_group'], $static_result['grouplevel'] ) ) {

		msgbox( $lang['all_err_1'], $lang['static_denied'] );

	} else {

		if ($config['allow_alt_url'] AND $config['seo_control'] AND $static_result['name'] != "dle-rules-page" AND ( isset($_GET['seourl']) OR strpos ( $_SERVER['REQUEST_URI'], "?" ) !== false ) ) {


			if ($_GET['seourl'] != $static_result['name'] OR strpos ( $_SERVER['REQUEST_URI'], "?" ) !== false ) {


				if ($view_template == "print") {
	
					$re_url = explode ( "engine/print.php", strtolower ( $_SERVER['PHP_SELF'] ) );
					$re_url = reset ( $re_url );
	
				} else {
	
					$re_url = explode ( "index.php", strtolower ( $_SERVER['PHP_SELF'] ) );
					$re_url = reset ( $re_url );
	
				}

				header("HTTP/1.0 301 Moved Permanently");
				header("Location: {$re_url}{$static_result['name']}.html");
				die("Redirect");

			}	
		}
		
		$template = stripslashes( $static_result['template'] );
		$static_descr = stripslashes( strip_tags( $static_result['descr'] ) );
		
		if( $static_result['metakeys'] == '' AND $static_result['metadescr'] == '' ) create_keywords( $template );
		else {
			$metatags['keywords'] = $static_result['metakeys'];
			$metatags['description'] = $static_result['metadescr'];
		}

		if ($static_result['metatitle']) $metatags['header_title'] = $static_result['metatitle'];
		
		if( $static_result['allow_template'] or $view_template == "print" ) {
			
			if( $view_template == "print" ) $tpl->load_template( 'static_print.tpl' );
			elseif( $static_result['tpl'] != '' ) $tpl->load_template( $static_result['tpl'] . '.tpl' );
			else $tpl->load_template( 'static.tpl' );
			
			if( ! $news_page ) $news_page = 1;
			
			if( $view_template == "print" ) {
				
				$template = str_replace( "{PAGEBREAK}", "", $template );
				$template = str_replace( "{pages}", "", $template );
				$template = preg_replace( "'\[PAGE=(.*?)\](.*?)\[/PAGE\]'si", "", $template );
			
			} else {
				
				$news_seiten = explode( "{PAGEBREAK}", $template );
				$anzahl_seiten = count( $news_seiten );
				
				if( $news_page <= 0 or $news_page > $anzahl_seiten ) {
					$news_page = 1;
				}
				
				$template = $news_seiten[$news_page - 1];
				
				$template = preg_replace( '#(\A[\s]*<br[^>]*>[\s]*|<br[^>]*>[\s]*\Z)#is', '', $template ); // remove <br/> at end of string
				

				$news_seiten = "";
				unset( $news_seiten );
				
				if( $anzahl_seiten > 1 ) {
					
					if( $news_page < $anzahl_seiten ) {
						$pages = $news_page + 1;
						if( $config['allow_alt_url'] ) {
							$nextpage = " | <a href=\"" . $config['http_home_url'] . "page," . $pages . "," . $static_result['name'] . ".html\">" . $lang['news_next'] . "</a>";
						} else {
							$nextpage = " | <a href=\"$PHP_SELF?do=static&page=" . $static_result['name'] . "&news_page=" . $pages . "\">" . $lang['news_next'] . "</a>";
						}
					}
					
					if( $news_page > 1 ) {
						$pages = $news_page - 1;
						if( $config['allow_alt_url'] ) {
							$prevpage = "<a href=\"" . $config['http_home_url'] . "page," . $pages . "," . $static_result['name'] . ".html\">" . $lang['news_prev'] . "</a> | ";
						} else {
							$prevpage = "<a href=\"$PHP_SELF?do=static&page=" . $static_result['name'] . "&news_page=" . $pages . "\">" . $lang['news_prev'] . "</a> | ";
						}
					}
					
					$tpl->set( '{pages}', $prevpage . $lang['news_site'] . " " . $news_page . $lang['news_iz'] . $anzahl_seiten . $nextpage );
					
					if( $config['allow_alt_url'] ) {
						$replacepage = "<a href=\"" . $config['http_home_url'] . "page," . "\\1" . "," . $static_result['name'] . ".html\">\\2</a>";
					} else {
						$replacepage = "<a href=\"$PHP_SELF?do=static&page=" . $static_result['name'] . "&news_page=\\1\">\\2</a>";
					}
					
					$template = preg_replace( "'\[PAGE=(.*?)\](.*?)\[/PAGE\]'si", $replacepage, $template );
				
				} else {
					
					$tpl->set( '{pages}', '' );
					$template = preg_replace( "'\[PAGE=(.*?)\](.*?)\[/PAGE\]'si", "", $template );
				
				}
			
			}
			
			if( $config['allow_alt_url'] ) $print_link = $config['http_home_url'] . "print:" . $static_result['name'] . ".html";
			else $print_link = $config['http_home_url'] . "engine/print.php?do=static&amp;page=" . $static_result['name'];

			if( @date( "Ymd", $static_result['date'] ) == date( "Ymd", $_TIME ) ) {
				
				$tpl->set( '{date}', $lang['time_heute'] . langdate( ", H:i", $static_result['date'] ) );
			
			} elseif( @date( "Ymd", $static_result['date'] ) == date( "Ymd", ($_TIME - 86400) ) ) {
				
				$tpl->set( '{date}', $lang['time_gestern'] . langdate( ", H:i", $static_result['date'] ) );
			
			} else {
				
				$tpl->set( '{date}', langdate( $config['timestamp_active'], $static_result['date'] ) );
			
			}

			$news_date = $static_result['date'];	
			$tpl->copy_template = preg_replace_callback ( "#\{date=(.+?)\}#i", "formdate", $tpl->copy_template );
			

			$tpl->set( '{description}', $static_descr );
			$tpl->set( '{static}', $template );
			$tpl->set( '{views}', $static_result['views'] );

			if ($config['allow_search_print']) {

				$tpl->set( '[print-link]', "<a href=\"" . $print_link . "\">" );
				$tpl->set( '[/print-link]', "</a>" );

			} else {

				$tpl->set( '[print-link]', "<a href=\"" . $print_link . "\" rel=\"nofollow\">" );
				$tpl->set( '[/print-link]', "</a>" );

			}
			
			if( $_GET['page'] == "dle-rules-page" ) if( $do != "register" ) {
				
				$tpl->set( '{ACCEPT-DECLINE}', "" );
			
			} else {
				
				$tpl->set( '{ACCEPT-DECLINE}', "<form  method=\"post\" name=\"registration\" id=\"registration\" action=\"\"><input type=\"submit\" class=\"bbcodes\" value=\"{$lang['rules_accept']}\" />&nbsp;&nbsp;&nbsp;<input type=\"button\" class=\"bbcodes\" value=\"{$lang['rules_decline']}\" onclick=\"history.go(-1); return false;\" /><input name=\"do\" type=\"hidden\" id=\"do\" value=\"register\" /><input name=\"dle_rules_accept\" type=\"hidden\" id=\"dle_rules_accept\" value=\"yes\" /></form>" );
			
			}

			if( $vk_url ) {
				$tpl->set( '[vk]', "" );
				$tpl->set( '[/vk]', "" );
				$tpl->set( '{vk_url}', $vk_url );	
			} else {
				$tpl->set_block( "'\\[vk\\](.*?)\\[/vk\\]'si", "" );
				$tpl->set( '{vk_url}', '' );	
			}
			if( $odnoklassniki_url ) {
				$tpl->set( '[odnoklassniki]', "" );
				$tpl->set( '[/odnoklassniki]', "" );
				$tpl->set( '{odnoklassniki_url}', $odnoklassniki_url );
			} else {
				$tpl->set_block( "'\\[odnoklassniki\\](.*?)\\[/odnoklassniki\\]'si", "" );
				$tpl->set( '{odnoklassniki_url}', '' );	
			}
			if( $facebook_url ) {
				$tpl->set( '[facebook]', "" );
				$tpl->set( '[/facebook]', "" );
				$tpl->set( '{facebook_url}', $facebook_url );	
			} else {
				$tpl->set_block( "'\\[facebook\\](.*?)\\[/facebook\\]'si", "" );
				$tpl->set( '{facebook_url}', '' );	
			}
			if( $google_url ) {
				$tpl->set( '[google]', "" );
				$tpl->set( '[/google]', "" );
				$tpl->set( '{google_url}', $google_url );
			} else {
				$tpl->set_block( "'\\[google\\](.*?)\\[/google\\]'si", "" );
				$tpl->set( '{google_url}', '' );	
			}
			if( $mailru_url ) {
				$tpl->set( '[mailru]', "" );
				$tpl->set( '[/mailru]', "" );
				$tpl->set( '{mailru_url}', $mailru_url );	
			} else {
				$tpl->set_block( "'\\[mailru\\](.*?)\\[/mailru\\]'si", "" );
				$tpl->set( '{mailru_url}', '' );	
			}
			if( $yandex_url ) {
				$tpl->set( '[yandex]', "" );
				$tpl->set( '[/yandex]', "" );
				$tpl->set( '{yandex_url}', $yandex_url );
			} else {
				$tpl->set_block( "'\\[yandex\\](.*?)\\[/yandex\\]'si", "" );
				$tpl->set( '{yandex_url}', '' );
			}
			
			$tpl->compile( 'content' );

			$tpl->clear();
		
		} else
			$tpl->result['content'] = $template;

		if( $user_group[$member_id['user_group']]['allow_hide'] ) $tpl->result['content'] = str_replace( "[hide]", "", str_replace( "[/hide]", "", $tpl->result['content']) );
		else $tpl->result['content'] = preg_replace ( "#\[hide\](.+?)\[/hide\]#is", "<div class=\"quote\">" . $lang['news_regus'] . "</div>", $tpl->result['content'] );

		if( $config['files_allow'] ) if( strpos( $tpl->result['content'], "[attachment=" ) !== false ) {
			
			$tpl->result['content'] = show_attach( $tpl->result['content'], $static_result['id'], true );
		
		}

		if ($config['rss_informer'] AND count ($informers) ) {
			foreach ( $informers as $name => $value ) {
				$tpl->result['content'] = str_replace ( "{inform_" . $name . "}", $value, $tpl->result['content'] );
			}
		}

		if (stripos ( $tpl->result['content'], "[static=" ) !== false) {
			$tpl->result['content'] = preg_replace_callback ( "#\\[(static)=(.+?)\\](.*?)\\[/static\\]#is", "check_static", $tpl->result['content'] );
		}

		if (stripos ( $tpl->result['content'], "[not-static=" ) !== false) {
			$tpl->result['content'] = preg_replace_callback ( "#\\[(not-static)=(.+?)\\](.*?)\\[/not-static\\]#is", "check_static", $tpl->result['content'] );
		}

		if( $config['allow_banner'] ) include_once ENGINE_DIR . '/modules/banners.php';
		
		if( $config['allow_banner'] AND count( $banners ) ) {
			
			foreach ( $banners as $name => $value ) {
				$tpl->result['content'] = str_replace( "{banner_" . $name . "}", $value, $tpl->result['content'] );
			}
		}


	}
	
} else {
	
	@header( "HTTP/1.0 404 Not Found" );
	$lang['static_page_err'] = str_replace ("{page}", $name.".html", $lang['static_page_err']);
	msgbox( $lang['all_err_1'], $lang['static_page_err'] );

}
?>