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
 Файл: googlemap.php
-----------------------------------------------------
 Назначение: Создание карты сайта sitemap
=====================================================
*/
if( !defined( 'DATALIFEENGINE' ) OR !defined( 'LOGGED_IN' ) ) {
  die("Hacking attempt!");
}

if( !$user_group[$member_id['user_group']]['admin_googlemap'] ) {
	msg( "error", $lang['index_denied'], $lang['index_denied'] );
}

function send_url($url, $map) {
					
	$data = false;
			
	$file = $url.urlencode($map);
					
	if( function_exists( 'curl_init' ) ) {
						
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $file );
		curl_setopt( $ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT'] );
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, false );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 6 );
						
		$data = curl_exec( $ch );
		curl_close( $ch );
			
		return $data;
					
	} else {
			
		return @file_get_contents( $file );
			
	}
			
}

if ($_POST['action'] == "create") {

	include_once ENGINE_DIR.'/classes/google.class.php';
	$map = new googlemap($config);

	$config['charset'] = strtolower($config['charset']);

	$map->limit = intval($_POST['limit']);
	$map->news_priority = strip_tags(stripslashes($_POST['priority']));
	$map->stat_priority = strip_tags(stripslashes($_POST['stat_priority']));
	$map->cat_priority = strip_tags(stripslashes($_POST['cat_priority']));

	$row = $db->super_query( "SELECT COUNT(*) as count FROM " . PREFIX . "_post" );
	if ( !$map->limit ) $map->limit = $row['count'];


	if ( $map->limit > 45000 ) {

		$pages_count = @ceil( $row['count'] / 40000 );

		$sitemap = $map->build_index( $pages_count );

		if ( $config['charset'] != "utf-8" ) {
			if( function_exists( 'mb_convert_encoding' ) ) {
		
				$sitemap = mb_convert_encoding( $sitemap, "UTF-8", $config['charset'] );
		
			} elseif( function_exists( 'iconv' ) ) {
			
				$sitemap = iconv($config['charset'], "UTF-8//IGNORE", $sitemap);
			
			}
		}


	    $handler = fopen(ROOT_DIR. "/uploads/sitemap.xml", "wb+");
	    fwrite($handler, $sitemap);
	    fclose($handler);
	
		@chmod(ROOT_DIR. "/uploads/sitemap.xml", 0666);

		$sitemap = $map->build_stat();

		if ( $config['charset'] != "utf-8" ) {

			if( function_exists( 'mb_convert_encoding' ) ) {
		
				$sitemap = mb_convert_encoding( $sitemap, "UTF-8", $config['charset'] );
		
			} elseif( function_exists( 'iconv' ) ) {
			
				$sitemap = iconv($config['charset'], "UTF-8//IGNORE", $sitemap);
			
			}

		}

	    $handler = fopen(ROOT_DIR. "/uploads/sitemap1.xml", "wb+");
	    fwrite($handler, $sitemap);
	    fclose($handler);
	
		@chmod(ROOT_DIR. "/uploads/sitemap1.xml", 0666);

		for ($i =0; $i < $pages_count; $i++) {

			$t = $i+2;
			$n = $n+1;

			$sitemap = $map->build_map_news( $n );

			if ( $config['charset'] != "utf-8" ) {
				if( function_exists( 'mb_convert_encoding' ) ) {
			
					$sitemap = mb_convert_encoding( $sitemap, "UTF-8", $config['charset'] );
			
				} elseif( function_exists( 'iconv' ) ) {
				
					$sitemap = iconv($config['charset'], "UTF-8//IGNORE", $sitemap);
				
				}

			}


		    $handler = fopen(ROOT_DIR. "/uploads/sitemap{$t}.xml", "wb+");
		    fwrite($handler, $sitemap);
		    fclose($handler);
		
			@chmod(ROOT_DIR. "/uploads/sitemap{$t}.xml", 0666);

		}


	} else {

		$sitemap = $map->build_map();

		if ( $config['charset'] != "utf-8" ) {

			if( function_exists( 'mb_convert_encoding' ) ) {
		
				$sitemap = mb_convert_encoding( $sitemap, "UTF-8", $config['charset'] );
		
			} elseif( function_exists( 'iconv' ) ) {
			
				$sitemap = iconv($config['charset'], "UTF-8//IGNORE", $sitemap);
			
			}
		}
	
	    $handler = fopen(ROOT_DIR. "/uploads/sitemap.xml", "wb+");
	    fwrite($handler, $sitemap);
	    fclose($handler);
	
		@chmod(ROOT_DIR. "/uploads/sitemap.xml", 0666);
	}

	if(defined('AUTOMODE')) {

		if ($config['allow_alt_url']) {
	
			$map_link = $config['http_home_url']."sitemap.xml";
		
		} else {
		
			$map_link = $config['http_home_url']."uploads/sitemap.xml";
		
		}

		send_url("http://google.com/webmasters/sitemaps/ping?sitemap=", $map_link);
		send_url("http://ping.blogs.yandex.ru/ping?sitemap=", $map_link);
		send_url("http://www.bing.com/webmaster/ping.aspx?siteMap=", $map_link);
		send_url("http://rpc.weblogs.com/pingSiteForm?name=InfraBlog&url=", $map_link);

		die("done"); 

	} else { $db->query( "INSERT INTO " . USERPREFIX . "_admin_logs (name, date, ip, action, extras) values ('".$db->safesql($member_id['name'])."', '{$_TIME}', '{$_IP}', '38', '')" ); }

}

echoheader( "<i class=\"icon-globe\"></i>".$lang['opt_google'], $lang['header_g_1'] );


echo <<<HTML
<div class="row">
<div class="col-md-7">
<form action="" method="post" class="form-horizontal">
<input type="hidden" name="action" value="create">
<div class="box">
  <div class="box-header">
    <div class="title">{$lang['google_map']}</div>
  </div>
  <div class="box-content">

	<div class="row box-section">
HTML;

	if(!@file_exists(ROOT_DIR. "/uploads/sitemap.xml")){ 

		echo $lang['no_google_map'];

	} else {

		$file_date = date("d.m.Y H:i", filectime(ROOT_DIR. "/uploads/sitemap.xml") );

		echo "<b>".$file_date."</b> ".$lang['google_map_info'];

		if ($config['allow_alt_url']) {

			$map_link = $config['http_home_url']."sitemap.xml";

			echo " <a class=\"list\" href=\"".$map_link."\" target=\"_blank\">".$config['http_home_url']."sitemap.xml</a>";

		} else {

			$map_link = $config['http_home_url']."uploads/sitemap.xml";

			echo " <a class=\"list\" href=\"".$map_link."\" target=\"_blank\">".$config['http_home_url']."uploads/sitemap.xml</a>";

		}

		$map_link = base64_encode(urlencode($map_link));

		echo "<br /><br /><input id=\"sendbutton\" name=\"sendbutton\" type=\"button\" class=\"btn btn-gray\" value=\"{$lang['google_map_send']}\" /><div id=\"send_result\" class=\"padded\"></div>";

	}


echo <<<HTML
<script type="text/javascript">
$(function(){
	$('#sendbutton').click(function() {
		$('#send_result').html('{$lang['dle_updatebox']}');
		$.post("engine/ajax/sitemap.php", { url: "{$map_link}" } , function( data ){
					$('#send_result').append('<br />' + data);
		});
	});
});
</script>
		<div class="form-group">
		  <label class="control-label col-lg-4">{$lang['google_nnum']}</label>
		  <div class="col-lg-8">
			<input type="text" size="14" name="limit">&nbsp;<span class="help-button" data-rel="popover" data-trigger="hover" data-placement="right" data-content="{$lang['hint_g_num']}" >?</span>
		   </div>
		 </div>
		<div class="form-group">
		  <label class="control-label col-lg-4">{$lang['google_stat_priority']}</label>
		  <div class="col-lg-8">
			<input type="text" size="14" name="stat_priority" value="0.5">&nbsp;<span class="help-button" data-rel="popover" data-trigger="hover" data-placement="right" data-content="{$lang['hint_g_priority']}" >?</span>
		   </div>
		 </div>
		<div class="form-group">
		  <label class="control-label col-lg-4">{$lang['google_priority']}</label>
		  <div class="col-lg-8">
			<input type="text" size="14" name="priority" value="0.6">
		   </div>
		 </div>
		<div class="form-group">
		  <label class="control-label col-lg-4">{$lang['google_cat_priority']}</label>
		  <div class="col-lg-8">
			<input type="text" size="14" name="cat_priority" value="0.7">
		   </div>
		 </div>	
		 
	</div>
<div class="row box-section"><input type="submit" class="btn btn-green" value="{$lang['google_create']}"></div>	
   </div>
</div>
</form>
</div>
HTML;

echo <<<HTML
<div class="col-md-5">
<div class="box" style="height:312px;">
  <div class="box-header">
    <div class="title">{$lang['google_main']}</div>
  </div>
  <div class="box-content">

	<div class="row box-section">
	
	  {$lang['google_info']}
	  
	</div>
	
   </div>
</div>
</div>
</div>
HTML;


echofooter();
?>