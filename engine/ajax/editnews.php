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
 Файл: editnews.php
-----------------------------------------------------
 Назначение: AJAX для редакторования
=====================================================
*/

@error_reporting ( E_ALL ^ E_WARNING ^ E_NOTICE );
@ini_set ( 'display_errors', true );
@ini_set ( 'html_errors', false );
@ini_set ( 'error_reporting', E_ALL ^ E_WARNING ^ E_NOTICE );

define( 'DATALIFEENGINE', true );
define( 'ROOT_DIR', substr( dirname(  __FILE__ ), 0, -12 ) );
define( 'ENGINE_DIR', ROOT_DIR . '/engine' );

include ENGINE_DIR . '/data/config.php';

date_default_timezone_set ( $config['date_adjust'] );

if( $config['http_home_url'] == "" ) {
	
	$config['http_home_url'] = explode( "engine/ajax/editnews.php", $_SERVER['PHP_SELF'] );
	$config['http_home_url'] = reset( $config['http_home_url'] );
	$config['http_home_url'] = "http://" . $_SERVER['HTTP_HOST'] . $config['http_home_url'];

}

require_once ENGINE_DIR . '/classes/mysql.php';
require_once ENGINE_DIR . '/data/dbconfig.php';
require_once ENGINE_DIR . '/modules/functions.php';

dle_session();

$_COOKIE['dle_skin'] = trim(totranslit( $_COOKIE['dle_skin'], false, false ));
$_TIME = time ();

if( $_COOKIE['dle_skin'] ) {
	if( @is_dir( ROOT_DIR . '/templates/' . $_COOKIE['dle_skin'] ) ) {
		$config['skin'] = $_COOKIE['dle_skin'];
	}
}

if( $config["lang_" . $config['skin']] ) {

	if ( file_exists( ROOT_DIR . '/language/' . $config["lang_" . $config['skin']] . '/website.lng' ) ) {	
		include_once ROOT_DIR . '/language/' . $config["lang_" . $config['skin']] . '/website.lng';
	} else die("Language file not found");

} else {
	
	include_once ROOT_DIR . '/language/' . $config['langs'] . '/website.lng';

}
$config['charset'] = ($lang['charset'] != '') ? $lang['charset'] : $config['charset'];

@header( "Content-type: text/html; charset=" . $config['charset'] );

require_once ENGINE_DIR . '/classes/parse.class.php';
require_once ENGINE_DIR . '/modules/sitelogin.php';

$parse = new ParseFilter( Array (), Array (), 1, 1 );

if( ! $is_logged ) die( "error" );

$id = intval( $_REQUEST['id'] );

if( ! $id ) die( "error" );

//################# Определение групп пользователей
$user_group = get_vars( "usergroup" );

if( ! $user_group ) {
	$user_group = array ();
	
	$db->query( "SELECT * FROM " . USERPREFIX . "_usergroups ORDER BY id ASC" );
	
	while ( $row = $db->get_row() ) {
		
		$user_group[$row['id']] = array ();
		
		foreach ( $row as $key => $value ) {
			$user_group[$row['id']][$key] = stripslashes($value);
		}
	
	}
	set_vars( "usergroup", $user_group );
	$db->free();
}

if( $_REQUEST['action'] == "edit" ) {
	$row = $db->super_query( "SELECT p.id, p.autor, p.date, p.short_story, p.full_story, p.xfields, p.title, p.category, p.approve, p.allow_br, e.reason FROM " . PREFIX . "_post p LEFT JOIN " . PREFIX . "_post_extras e ON (p.id=e.news_id) WHERE p.id = '$id'" );
	
	if( $id != $row['id'] ) die( "error" );
	
	$cat_list = explode( ',', $row['category'] );
	
	$have_perm = 0;

	if( $user_group[$member_id['user_group']]['allow_edit'] and $row['autor'] == $member_id['name'] ) {
		$have_perm = 1;
	}
	
	if( $user_group[$member_id['user_group']]['allow_all_edit'] ) {
		$have_perm = 1;
		
		$allow_list = explode( ',', $user_group[$member_id['user_group']]['cat_add'] );
		
		foreach ( $cat_list as $selected ) {
			if( $allow_list[0] != "all" and ! in_array( $selected, $allow_list ) ) $have_perm = 0;
		}
	}
	
	if( $user_group[$member_id['user_group']]['max_edit_days'] ) {
		$newstime = strtotime( $row['date'] );
		$maxedittime = $_TIME - ($user_group[$member_id['user_group']]['max_edit_days'] * 3600 * 24);
		if( $maxedittime > $newstime ) $have_perm = 0;
	}
	
	if( ($member_id['user_group'] == 1) ) {
		$have_perm = 1;
	}

	
	if( !$have_perm ) die( $lang['editnews_error'] );

	if( !$user_group[$member_id['user_group']]['allow_html'] ) $config['allow_quick_wysiwyg'] = false;
	
	$news_txt = $row['short_story'];
	$full_txt = $row['full_story'];
	
	if( $row['allow_br'] and !$config['allow_quick_wysiwyg'] ) {
		
		$news_txt = $parse->decodeBBCodes( $news_txt, false );
		$full_txt = $parse->decodeBBCodes( $full_txt, false );
		$fix_br = "checked";
	
	} else {
		
		if( $config['allow_quick_wysiwyg'] ) {
			$news_txt = $parse->decodeBBCodes( $news_txt, true, true );
			$full_txt = $parse->decodeBBCodes( $full_txt, true, true );
		} else { 
			$news_txt = $parse->decodeBBCodes( $news_txt, true, false );
			$full_txt = $parse->decodeBBCodes( $full_txt, true, false );

		}
		
		$fix_br = "";
	
	}

	if( $row['approve'] ) {
		$fix_approve = "checked";
	} else $fix_approve = "";
	
	$row['title'] = $parse->decodeBBCodes( $row['title'], false );

	$xfields = xfieldsload();
	$xfieldsdata = xfieldsdataload ($row['xfields']);
	$xfbuffer = "";

	foreach ($xfields as $name => $value) {
		$fieldname = $value[0];

		if ( isset($xfieldsdata[$value[0]]) ) $fieldvalue = $xfieldsdata[$value[0]]; else continue;

		$smode = $parse->safe_mode;

		if ( $value[8] ) {
			$parse->safe_mode = true;
		}

		if( $row['allow_br'] AND !$config['allow_quick_wysiwyg'] ) {
			
			$fieldvalue = $parse->decodeBBCodes( $fieldvalue, false );
		
		} else {
			
			if( $config['allow_quick_wysiwyg'] ) $fieldvalue = $parse->decodeBBCodes( $fieldvalue, true, "yes" );
			else $fieldvalue = $parse->decodeBBCodes( $fieldvalue, true, "no" );
		
		}

		$parse->safe_mode = $smode;

		if ($value[3] == "textarea") {

			if ( !$config['allow_quick_wysiwyg'] ) {

				$params = "onfocus=\"setNewField(this.id, document.ajaxnews{$id})\" "; 
				$class_name = "bb-editor";
			} else {

				$params = "class=\"wysiwygeditor\" ";
				$class_name = "";
			}

			 $xfbuffer .= "<div style=\"padding-top:5px;\">{$value[1]}:<br /><div class=\"{$class_name}\"><!--panel--><textarea name=\"xfield[{$fieldname}]\" id=\"xf_$fieldname\" rows=\"10\" cols=\"50\" {$params}>{$fieldvalue}</textarea></div></div>";

		} elseif ($value[3] == "text") {

			$fieldvalue = str_replace('"', '&quot;', $fieldvalue);
			$fieldvalue = str_replace('&amp;', '&', $fieldvalue);

			$xfbuffer .= "<div style=\"padding-top:5px;\">{$value[1]}:&nbsp;<input type=\"text\" name=\"xfield[{$fieldname}]\" id=\"xfield[{$fieldname}]\" value=\"{$fieldvalue}\" class=\"ui-widget-content ui-corner-all\" style=\"width:250px;padding: .4em;\" /></div>";

		} elseif ($value[3] == "select") { 

			$fieldvalue = str_replace('&amp;', '&', $fieldvalue);
			$fieldvalue = str_replace('&quot;', '"', $fieldvalue);

			$xfbuffer .= "<div style=\"padding-top:5px;\">{$value[1]}:&nbsp;<select name=\"xfield[{$fieldname}]\">";

	        foreach (explode("\r\n", $value[4]) as $index => $value) {
			  $value = str_replace("'", "&#039;", $value);
	          $xfbuffer .= "<option value=\"$index\"" . ($fieldvalue == $value ? " selected" : "") . ">$value</option>\r\n";
	        }

			$xfbuffer .= "</select></div>";
		}
	
	}
	
	$addtype = "addnews";
	
	if( !$config['allow_quick_wysiwyg'] ) {
		
		include_once ENGINE_DIR . '/ajax/bbcode.php';
		$xfbuffer = str_replace ("<!--panel-->", $code, $xfbuffer);
	
	} else {

		$p_name = urlencode($row['autor']);

		if ( $config['allow_quick_wysiwyg'] == "2") {

			if ( $user_group[$member_id['user_group']]['allow_image_upload'] OR $user_group[$member_id['user_group']]['allow_file_upload'] ) $image_upload = "media_upload('short_story', '{$p_name}', '{$row['id']}', '2')"; else $image_upload = "return false;";

			$bb_code = <<<HTML

<script type="text/javascript">
var text_upload = "$lang[bb_t_up]";

setTimeout(function() {

	tinymce.remove('textarea.wysiwygeditor');

	tinymce.init({
		selector: 'textarea.wysiwygeditor',
		language : "{$lang['wysiwyg_language']}",
		width : "100%",
		height : "280",
		theme: "modern",
		plugins: ["advlist autolink lists link image charmap anchor searchreplace visualblocks visualchars fullscreen media nonbreaking table contextmenu emoticons paste textcolor code  spellchecker"],
		relative_urls : false,
		convert_urls : false,
		remove_script_host : false,
		extended_valid_elements : "noindex,div[align|class|style|id|title]",
		custom_elements : 'noindex',

		menubar: "edit insert view format table tools",
		toolbar1: "undo redo | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | dleupload link dleemo image | bullist numlist | forecolor backcolor",


		spellchecker_language : "ru",
		spellchecker_rpc_url : "http://speller.yandex.net/services/tinyspell",
		content_css : "{$config['http_home_url']}engine/editor/css/content.css",

		setup : function(ed) {
			ed.addMenuItem('dleleech', {
				text: '{$lang['bb_t_leech']}',
				context: 'insert',
				onclick: function() {
					ed.execCommand('mceReplaceContent',false,"[leech=http://]{$selection}[/leech]");
				}
			});	
			ed.addMenuItem('dlequote', {
				text: '{$lang['bb_t_quote']}',
				context: 'insert',
				onclick: function() {
					ed.execCommand('mceReplaceContent',false,'[quote]' + ed.selection.getContent() + '[/quote]');
				}
			});		
			ed.addMenuItem('dlehide', {
				text: '{$lang['bb_t_hide']}',
				context: 'insert',
				onclick: function() {
					ed.execCommand('mceReplaceContent',false,'[hide]' + ed.selection.getContent() + '[/hide]');
				}
			});	
			ed.addMenuItem('dlecode', {
				text: '{$lang['bb_t_code']}',
				context: 'insert',
				onclick: function() {
					ed.execCommand('mceReplaceContent',false,'[code]' + ed.selection.getContent() + '[/code]');
				}
			});
			ed.addMenuItem('dlemp', {
				text: '{$lang['bb_t_video']} (BB Codes)',
				context: 'insert',
				onclick: function() {
					ed.execCommand('mceInsertContent',false,"[video=http://]");
				}
			});
			ed.addMenuItem('dletube', {
				text: '{$lang['bb_t_yvideo']} (Youtube)',
				context: 'insert',
				onclick: function() {
					ed.execCommand('mceInsertContent',false,"[media=http://]");
				}
			});	

			ed.addMenuItem('dlespoiler', {
				text: '{$lang['bb_t_spoiler']}',
				context: 'insert',
				onclick: function() {
					ed.execCommand('mceReplaceContent',false,'[spoiler]' + ed.selection.getContent() + '[/spoiler]');
				}
			});	
			
			ed.addMenuItem('dlebreak', {
				text: '{$lang['bb_t_br']}',
				context: 'tools',
				onclick: function() {
					ed.execCommand('mceInsertContent',false,'{PAGEBREAK}');
				}
			});
			ed.addMenuItem('dlepage', {
				text: '{$lang['bb_t_p']}',
				context: 'tools',
				onclick: function() {
					ed.execCommand('mceReplaceContent',false,"[page=1]{$selection}[/page]");
				}
			});

			ed.addButton('dleupload', {
				title : '{$lang['bb_t_up']}',
				image : '{$config['http_home_url']}engine/editor/jscripts/tiny_mce/skins/dle_upload.gif',
				onclick : function() {
					{$image_upload}
				}
	        });

			ed.addButton('dleemo', {
				title : '{$lang['bb_t_emo']}',
				icon : 'emoticons',
				onclick : function() {
					ed.windowManager.open({
					    title: "{$lang['bb_t_emo']}",
					    url: '{$config['http_home_url']}engine/editor/jscripts/tiny_mce/plugins/emoticons/emotions.php',
					    width: 250,
					    height: 160
					});
				}
	        });
   		 }


	});

}, 100);

</script>
HTML;

		
		} else {


			if ( $user_group[$member_id['user_group']]['allow_image_upload'] OR $user_group[$member_id['user_group']]['allow_file_upload'] ) $image_upload = "\"DLEUpload\", "; else $image_upload = "";
	
			$bb_code = <<<HTML

<script type="text/javascript">
var text_upload = "$lang[bb_t_up]";
function show_newseditor( root ) {
	var use_br = false;
	var use_div = true;
	
	oUtil.initializeEditor("wysiwygeditor",  {
		width: "100%", 
		height: "370", 
		css: root + "engine/editor/scripts/style/default.css",
		useBR: use_br,
		useDIV: use_div,
		groups:[
			["grpEdit1", "", ["TextDialog", "FontDialog", "Subscript", "Superscript", "ForeColor", "BackColor", "BRK", "Bold", "Italic", "Underline", "Strikethrough", "Styles", "RemoveFormat"]],
			["grpEdit2", "", ["JustifyLeft", "JustifyCenter", "JustifyRight", "JustifyFull", "BRK", "Bullets", "Numbering", "Indent", "Outdent"]],
			["grpEdit3", "", ["TableDialog", "DLESmiles", "FlashDialog", "CharsDialog", "Line", "BRK", "LinkDialog", "DLELeech", "ImageDialog", {$image_upload}"YoutubeDialog"]],
			["grpEdit4", "", ["DLEQuote", "DLECode", "DLEHide", "DLESpoiler","DLEPasteText", "BRK", "DLEVideo", "DLEAudio", "DLEMedia", "HTML5Video", "DLETypograf"]],
			["grpEdit5", "", ["SearchDialog", "SourceDialog", "BRK", "Undo", "Redo"]]
	    ],
		arrCustomButtons:[
			["DLEUpload", "media_upload('short_story', '{$p_name}', '{$row['id']}', '1')", "{$lang['bb_t_up']}", "dle_upload.gif"],
			["DLESmiles", "modalDialog('"+ root +"engine/editor/emotions.php',250,160)", "{$lang['bb_t_emo']}", "btnEmoticons.gif"],
			["DLEPasteText", "modalDialog('"+ root +"engine/editor/scripts/common/webpastetext.htm',450,380)", "{$lang['paste_text']}", "btnPaste.gif"],
			["DLETypograf", "ws_typograf('"+ root +"')", "{$lang['bb_t_t']}", "dle_tt.gif"],
			["DLEQuote", "DLEcustomTag('[quote]', '[/quote]')", "{$lang['bb_t_quote']}", "dle_quote.gif"],
			["DLECode", "DLEcustomTag('[code]', '[/code]')", "{$lang['bb_t_code']}", "dle_code.gif"],
			["DLEHide", "DLEcustomTag('[hide]', '[/hide]')", "{$lang['bb_t_hide']}", "dle_hide.gif"],
			["DLESpoiler", "DLEcustomTag('[spoiler]', '[/spoiler]')", "{$lang['bb_t_spoiler']}", "dle_spoiler.gif"],
			["DLELeech", "DLEcustomTag('[leech=http://]', '[/leech]')", "{$lang['bb_t_leech']}", "dle_leech.gif"],
			["HTML5Video", "modalDialog('"+ root +"engine/editor/scripts/common/webvideo.htm',690,330)", "HTML5 Video", "btnMedia.gif"],
			["DLEVideo", "modalDialog('"+ root +"engine/editor/scripts/common/webbbvideo.htm',400,250)", "{$lang['bb_t_video']} (BB Codes)", "dle_video.gif"],
			["DLEAudio", "modalDialog('"+ root +"engine/editor/scripts/common/webbbaudio.htm',400,200)", "{$lang['bb_t_audio']} (BB Codes)", "dle_mp3.gif"],
			["DLEMedia", "modalDialog('"+ root +"engine/editor/scripts/common/webbbmedia.htm',400,250)", "{$lang['bb_t_yvideo']} (BB Codes)", "dle_media.gif"]
		]
		}
	);

	setTimeout(function() {
		
	    for(var i = 0;i < oUtil.arrEditor.length;i++) {
	      var oEditor = eval("idContent" + oUtil.arrEditor[i]);
	      var sHTML;
	      if(navigator.appName.indexOf("Microsoft") != -1) {
	        sHTML = oEditor.document.documentElement.outerHTML
	      }else {
	        sHTML = getOuterHTML(oEditor.document.documentElement)
	      }
	      sHTML = sHTML.replace(/FONT-FAMILY/g, "font-family");
	      var urlRegex = /font-family?:.+?(\;|,|")/g;
	      var matches = sHTML.match(urlRegex);
	      if(matches) {
	        for(var j = 0, len = matches.length;j < len;j++) {
	          var sFont = matches[j].replace(/font-family?:/g, "").replace(/;/g, "").replace(/,/g, "").replace(/"/g, "");
			  sFont=sFont.split("'").join('');
	          sFont = jQuery.trim(sFont);
	          var sFontLower = sFont.toLowerCase();
	          if(sFontLower != "serif" && sFontLower != "arial" && sFontLower != "arial black" && sFontLower != "bookman old style" && sFontLower != "comic sans ms" && sFontLower != "courier" && sFontLower != "courier new" && sFontLower != "garamond" && sFontLower != "georgia" && sFontLower != "impact" && sFontLower != "lucida console" && sFontLower != "lucida sans unicode" && sFontLower != "ms sans serif" && sFontLower != "ms serif" && sFontLower != "palatino linotype" && sFontLower != "tahoma" && sFontLower != 
	          "times new roman" && sFontLower != "trebuchet ms" && sFontLower != "verdana") {
	            sURL = "http://fonts.googleapis.com/css?family=" + sFont + "&subset=latin,cyrillic";
	            var objL = oEditor.document.createElement("LINK");
	            objL.href = sURL;
	            objL.rel = "StyleSheet";
	            oEditor.document.documentElement.childNodes[0].appendChild(objL)
	          }
	        }
	      }
	    }
	}, 100);

};

function ws_typograf(root) {

	ShowLoading('');

	var oEditor = oUtil.oEditor;
	var obj = oUtil.obj;

	obj.saveForUndo();
    oEditor.focus();
    obj.setFocus();

	var txt = obj.getXHTMLBody();

	$.post(root + "engine/ajax/typograf.php", {txt: txt}, function(data){
	
		HideLoading('');
	
		obj.loadHTML(data); 
	
	});

};

show_newseditor(dle_root);
</script>
HTML;
		}

		$code = "";	
	}

	if ( !$config['allow_quick_wysiwyg'] ) $params = "onfocus=\"setNewField(this.name, document.ajaxnews{$id})\""; else $params = "class=\"wysiwygeditor\"";
	
	$buffer = <<<HTML
<div style="width:100%;height:100%;overflow:auto;position:relative;">
<form name="ajaxnews{$id}" id="ajaxnews{$id}" metod="post" action="">
<div style="width:99%;">
<div style="padding-bottom:5px;">{$lang['s_fstitle']}:&nbsp;&nbsp;<input type="text" id='edit-title-{$id}' class="ui-widget-content ui-corner-all" style="width:350px;padding: .4em;" value="{$row['title']}" /></div>
<div><br /><b>{$lang['s_fshort']}</b></div>
<div class="bb-editor">
{$bb_code}
<textarea name="dleeditnews{$id}" id="dleeditnews{$id}" {$params} rows="15" cols="50">{$news_txt}</textarea>
</div>
<div><br /><b>{$lang['s_ffull']}</b></div>
<div class="bb-editor">
{$code}
<textarea name="dleeditfullnews{$id}" id="dleeditfullnews{$id}" {$params} rows="15" cols="50">{$full_txt}</textarea>
</div>
{$xfbuffer}
<div style="padding-top:5px;padding-bottom:5px;">{$lang['reason']} <input type="text" id='edit-reason-{$id}' class="ui-widget-content ui-corner-all" style="width:250px;padding: .4em;" value="{$row['reason']}"></div>
<div style="padding-top:5px;padding-bottom:5px;"><input type="checkbox" name="approve_{$id}" id="approve_{$id}" value="1" {$fix_approve}>&nbsp;<label for="approve_{$id}">{$lang['add_al_ap']}</label>&nbsp;&nbsp;<input type="checkbox" name="allow_br_{$id}" id="allow_br_{$id}" value="1" {$fix_br}>&nbsp;<label for="allow_br_{$id}">{$lang['aj_allowbr']}</label></div>
</div>
</form>
</div>
HTML;

} elseif( $_REQUEST['action'] == "save" ) {
	$row = $db->super_query( "SELECT id, date, title, category, short_story, full_story, autor FROM " . PREFIX . "_post where id = '$id'" );
	
	if( $id != $row['id'] ) die( "News Not Found" );
	
	$cat_list = explode( ',', $row['category'] );
	
	$have_perm = 0;
	
	if( $user_group[$member_id['user_group']]['allow_all_edit'] ) {
		$have_perm = 1;
		
		$allow_list = explode( ',', $user_group[$member_id['user_group']]['cat_add'] );
		
		foreach ( $cat_list as $selected ) {
			if( $allow_list[0] != "all" and ! in_array( $selected, $allow_list ) ) $have_perm = 0;
		}
	}
	
	if( $user_group[$member_id['user_group']]['allow_edit'] and $row['autor'] == $member_id['name'] ) {
		$have_perm = 1;
	}
	
	if( $user_group[$member_id['user_group']]['max_edit_days'] ) {
		$newstime = strtotime( $row['date'] );
		$maxedittime = $_TIME - ($user_group[$member_id['user_group']]['max_edit_days'] * 3600 * 24);
		if( $maxedittime > $newstime ) $have_perm = 0;
	}
	
	if( ($member_id['user_group'] == 1) ) {
		$have_perm = 1;
	}
	
	if( ! $have_perm ) die( "Access it is refused" );
	
	$allow_br = intval( $_REQUEST['allow_br'] );
	$approve = intval( $_REQUEST['approve'] );

	if( !$user_group[$member_id['user_group']]['moderation'] ) $approve = 0;
	
	if( $allow_br ) $use_html = false;
	else $use_html = true;

	$_POST['title'] = $db->safesql( $parse->process( trim( strip_tags (convert_unicode( $_POST['title'], $config['charset']  ) ) ) ) );

	if ( $config['allow_quick_wysiwyg'] ) $parse->allow_code = false;

	$_POST['news_txt'] = convert_unicode( $_POST['news_txt'], $config['charset'] );
	$_POST['full_txt'] = convert_unicode( $_POST['full_txt'], $config['charset'] );

	if ( !$user_group[$member_id['user_group']]['allow_html'] ) {

		$_POST['news_txt'] = strip_tags ($_POST['news_txt']);
		$_POST['full_txt'] = strip_tags ($_POST['full_txt']);

	}

	$news_txt = $db->safesql($parse->BB_Parse( $parse->process( $_POST['news_txt'] ), $use_html ));
	$full_txt = $db->safesql($parse->BB_Parse( $parse->process( $_POST['full_txt'] ), $use_html ));


	$add_module = "yes";
	$ajax_edit = "yes";
	$stop = "";
	$category = $cat_list;
	$xfieldsaction = "init";
	include (ENGINE_DIR . '/inc/xfields.php');

	$editreason = $db->safesql( htmlspecialchars( strip_tags( stripslashes( trim( convert_unicode( $_POST['reason'], $config['charset'] ) ) ) ), ENT_QUOTES, $config['charset'] ) );
	
	if( $editreason != "" ) $view_edit = 1;
	else $view_edit = 0;
	$added_time = time();
	
	if( !trim($_POST['title']) ) die( $lang['add_err_7'] );

	if ($parse->not_allowed_text ) die( $lang['news_err_39'] );
	
	$db->query( "UPDATE " . PREFIX . "_post SET title='{$_POST['title']}', short_story='$news_txt', full_story='$full_txt', xfields='$filecontents', approve='$approve', allow_br='$allow_br' WHERE id = '$id'" );
	$db->query( "UPDATE " . PREFIX . "_post_extras SET editdate='$added_time', editor='{$member_id['name']}', reason='$editreason', view_edit='$view_edit' WHERE news_id = '$id'" );

	if ($user_group[$member_id['user_group']]['allow_admin']) $db->query( "INSERT INTO " . USERPREFIX . "_admin_logs (name, date, ip, action, extras) values ('".$db->safesql($member_id['name'])."', '{$_TIME}', '{$_IP}', '25', '{$_POST['title']}')" );

	if ( $config['allow_alt_url'] AND !$config['seo_type'] ) $cprefix = "full_"; else $cprefix = "full_".$id;	

	clear_cache( array( 'news_', 'rss', $cprefix ) );
	
	$buffer = "ok";

} else
	die( "error" );

$db->close();

echo $buffer;
?>