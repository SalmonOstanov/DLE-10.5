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
 Файл: comments.php
-----------------------------------------------------
 Назначение: WYSIWYG для комментариев
=====================================================
*/

if(!defined('DATALIFEENGINE'))
{
  die("Hacking attempt!");
}

if( $config['allow_comments_wysiwyg'] == 1 ) {

	if ($user_group[$member_id['user_group']]['allow_url']) $link_icon = "\"LinkDialog\", \"DLELeech\","; else $link_icon = "";
	if ($user_group[$member_id['user_group']]['allow_image']) $link_icon .= "\"ImageDialog\",";

$wysiwyg = <<<HTML
<style type="text/css">
.wseditor table td { 
	padding:0px;
	border:0;
}
</style>
    <div class="wseditor"><textarea id="comments" name="comments" rows="10" cols="50">{$text}</textarea>
<script type="text/javascript">
    var wscomm = new InnovaEditor("wscomm");
	var use_br = false;
	var use_div = true;

    wscomm.width = 540;
    wscomm.height = 250;
    wscomm.css = "{$config['http_home_url']}engine/editor/scripts/style/default.css";
    wscomm.useBR = use_br;
    wscomm.useDIV = use_div;
    wscomm.groups = [
			["grpEdit1", "", ["Bold", "Italic", "Underline", "Strikethrough", "ForeColor"]],
			["grpEdit2", "", ["JustifyLeft", "JustifyCenter", "JustifyRight", "JustifyFull", "Bullets", "Numbering"]],
			["grpEdit3", "", [{$link_icon}"DLESmiles", "DLEQuote", "DLEHide"]]
        ];
    wscomm.arrCustomButtons.push(["DLESmiles", "modalDialog('{$config['http_home_url']}engine/editor/emotions.php',250,160)", "{$lang['bb_t_emo']}", "btnEmoticons.gif"]);
    wscomm.arrCustomButtons.push(["DLEQuote", "DLEcustomTag('[quote]', '[/quote]')", "{$lang['bb_t_quote']}", "dle_quote.gif"]);
    wscomm.arrCustomButtons.push(["DLEHide", "DLEcustomTag('[hide]', '[/hide]')", "{$lang['bb_t_hide']}", "dle_hide.gif"]);
    wscomm.arrCustomButtons.push(["DLELeech", "DLEcustomTag('[leech=http://]', '[/leech]')", "{$lang['bb_t_leech']}", "dle_leech.gif"]);

    wscomm.REPLACE("comments");
</script></div>
HTML;

} else {

	if ($user_group[$member_id['user_group']]['allow_url']) $link_icon = "link dle_leech "; else $link_icon = "";
	if ($user_group[$member_id['user_group']]['allow_image']) $link_icon .= "image ";

$wysiwyg = <<<HTML

<script type="text/javascript">
$(function(){

	tinymce.init({
		selector: 'textarea#comments',
		language : "{$lang['wysiwyg_language']}",
		width : 460,
		height : 220,
		plugins: ["link image paste"],
		theme: "modern",
		relative_urls : false,
		convert_urls : false,
		remove_script_host : false,
		extended_valid_elements : "div[align|class|style|id|title]",
		paste_as_text: true,
		toolbar_items_size: 'small',
		statusbar : false,

		menubar: false,
		toolbar1: "bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | {$link_icon}dleemo | bullist numlist | dlequote dlehide",

		content_css : "{$config['http_home_url']}engine/editor/css/content.css",

		setup : function(ed) {

			ed.addButton('dlequote', {
				title: '{$lang['bb_t_quote']}',
				image: '{$config['http_home_url']}engine/editor/jscripts/tiny_mce/skins/dle_quote.gif',
				onclick: function() {
					ed.execCommand('mceReplaceContent',false,'[quote]' + ed.selection.getContent() + '[/quote]');
				}
			});		
			ed.addButton('dlehide', {
				title: '{$lang['bb_t_hide']}',
				image: '{$config['http_home_url']}engine/editor/jscripts/tiny_mce/skins/dle_hide.gif',
				onclick: function() {
					ed.execCommand('mceReplaceContent',false,'[hide]' + ed.selection.getContent() + '[/hide]');
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

});
</script>
    <textarea id="comments" name="comments" rows="10" cols="50">{$text}</textarea>
HTML;


}


if ( $allow_subscribe ) $wysiwyg .= "<br /><input type=\"checkbox\" name=\"allow_subscribe\" id=\"allow_subscribe\" value=\"1\" /><label for=\"allow_subscribe\">&nbsp;&nbsp;" . $lang['c_subscribe'] . "</label><br />";


?>