<?PHP
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
 Файл: bbcode.php
-----------------------------------------------------
 Назначение: подключение основных компонентов
=====================================================
*/

if(!defined('DATALIFEENGINE'))
{
  die("Hacking attempt!");
}

$i = 0;
$output = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"100%\"><tr>";

$smilies = explode(",", $config['smilies']);
$count_smilies = count($smilies);

foreach($smilies as $smile)
{
   $i++; $smile = trim($smile);

   $output .= "<td style=\"padding:2px;\" align=\"center\"><a href=\"#\" onclick=\"dle_smiley(':$smile:'); return false;\"><img style=\"border: none;\" alt=\"$smile\" src=\"".$config['http_home_url']."engine/data/emoticons/$smile.gif\" /></a></td>";

    if ($i%4 == 0 AND $i < $count_smilies) $output .= "</tr><tr>";

}

$output .= "</tr></table>";

if (isset($addtype) AND $addtype == "addnews") {

	$js_array[] = "engine/classes/js/bbcodes.js";

   $startform = "short_story"; 
   $addform = "document.entryform";

   $add_id = (isset($_REQUEST['id'])) ? intval($_REQUEST['id']) : '';
   $p_name = urlencode($member_id['name']);

   if ($is_logged AND ($user_group[$member_id['user_group']]['allow_image_upload'] OR $user_group[$member_id['user_group']]['allow_file_upload']) )
   {
      $image_upload = "<b id=\"b_up\" class=\"bb-btn\" onclick=\"dle_image_upload( '{$p_name}', '{$add_id}' ); return false;\" title=\"{$lang['bb_t_up']}\"></b>";
   } 
   else {$image_upload = "";}

$code = <<<HTML
<div class="bb-pane" onmouseenter="if(is_ie9) get_sel(eval('fombj.'+ selField));">
<b id="b_b" class="bb-btn" onclick="simpletag('b')" title="{$lang['bb_t_b']}"></b>
<b id="b_i" class="bb-btn" onclick="simpletag('i')" title="{$lang['bb_t_i']}"></b>
<b id="b_u" class="bb-btn" onclick="simpletag('u')" title="{$lang['bb_t_u']}"></b>
<b id="b_s" class="bb-btn" onclick="simpletag('s')" title="{$lang['bb_t_s']}"></b>
<span class="bb-sep"></span>
<b id="b_img" class="bb-btn" onclick="tag_image()" title="{$lang['bb_b_img']}"></b>
{$image_upload}
<span class="bb-sep"></span>
<b id="b_emo" class="bb-btn" onclick="ins_emo(this)" title="{$lang['bb_t_emo']}"></b>
<span class="bb-sep"></span>
<b id="b_url" class="bb-btn" onclick="tag_url()" title="{$lang['bb_t_url']}"></b>
<b id="b_leech" class="bb-btn" onclick="tag_leech()" title="{$lang['bb_t_leech']}"></b>
<b id="b_mail" class="bb-btn" onclick="tag_email()" title="{$lang['bb_t_m']}"></b>
<span class="bb-sep"></span>
<b id="b_video" class="bb-btn" onclick="tag_video()" title="{$lang['bb_t_video']}"></b>
<b id="b_audio" class="bb-btn" onclick="tag_audio()" title="{$lang['bb_t_audio']}"></b>
<span class="bb-sep"></span>
<b id="b_hide" class="bb-btn" onclick="simpletag('hide')" title="{$lang['bb_t_hide']}"></b>
<b id="b_quote" class="bb-btn" onclick="simpletag('quote')" title="{$lang['bb_t_quote']}"></b>
<b id="b_code" class="bb-btn" onclick="simpletag('code')" title="{$lang['bb_t_code']}"></b>
<span class="bb-sep"></span>
<b id="b_br" class="bb-btn" onclick="pagebreak()" title="{$lang['bb_t_br']}"></b>
<b id="b_pl" class="bb-btn" onclick="pagelink()" title="{$lang['bb_t_p']}"></b>
<div class="clr"></div>
<b id="b_font" class="bb-sel"><select name="bbfont" onchange="insert_font(this.options[this.selectedIndex].value, 'font'); this.selectedIndex=0;"><option value='0'>{$lang['bb_t_font']}</option><option value='Arial'>Arial</option><option value='Arial Black'>Arial Black</option><option value='Century Gothic'>Century Gothic</option><option value='Courier New'>Courier New</option><option value='Georgia'>Georgia</option><option value='Impact'>Impact</option><option value='System'>System</option><option value='Tahoma'>Tahoma</option><option value='Times New Roman'>Times New Roman</option><option value='Verdana'>Verdana</option></select></b>
<b id="b_size" class="bb-sel"><select name="bbsize" onchange="insert_font(this.options[this.selectedIndex].value, 'size'); this.selectedIndex=0;"><option value='0'>{$lang['bb_t_size']}</option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option><option value='6'>6</option><option value='7'>7</option></select></b>
<span class="bb-sep"></span>
<b id="b_left" class="bb-btn" onclick="simpletag('left')" title="{$lang['bb_t_l']}"></b>
<b id="b_center" class="bb-btn" onclick="simpletag('center')" title="{$lang['bb_t_c']}"></b>
<b id="b_right" class="bb-btn" onclick="simpletag('right')" title="{$lang['bb_t_r']}"></b>
<span class="bb-sep"></span>
<b id="b_color" class="bb-btn" onclick="ins_color(this)" title="{$lang['bb_t_color']}"></b>
<b id="b_spoiler" class="bb-btn" onclick="simpletag('spoiler')" title="{$lang['bb_t_spoiler']}"></b>
<span class="bb-sep"></span>
<b id="b_fla" class="bb-btn" onclick="tag_flash()" title="{$lang['bb_t_flash']}"></b>
<b id="b_yt" class="bb-btn" onclick="tag_youtube()" title="{$lang['bb_t_youtube']}"></b>
<b id="b_tf" class="bb-btn" onclick="tag_typograf(); return false;" title="{$lang['bb_t_t']}"></b>
<span class="bb-sep"></span>
<b id="b_list" class="bb-btn" onclick="tag_list('list')" title="{$lang['bb_t_list1']}"></b>
<b id="b_ol" class="bb-btn" onclick="tag_list('ol')" title="{$lang['bb_t_list2']}"></b>
<span class="bb-sep"></span>
</div>
<div id="dle_emos" style="display: none;" title="{$lang['bb_t_emo']}"><div style="width:100%;height:100%;overflow: auto;">{$output}</div></div>
HTML;


$image_align = array (0 => '', 'left' => '', 'right' => '', 'center' => '');
$image_align[$config['image_align']] = "selected";


$bb_code = <<<HTML
<script type="text/javascript">
<!--
var text_enter_url       = "$lang[bb_url]";
var text_enter_size       = "$lang[bb_flash]";
var text_enter_flash       = "$lang[bb_flash_url]";
var text_enter_page      = "$lang[bb_page]";
var text_enter_url_name  = "$lang[bb_url_name]";
var text_enter_tooltip  = "$lang[bb_url_tooltip]";
var text_enter_page_name = "$lang[bb_page_name]";
var text_enter_image    = "$lang[bb_image]";
var text_enter_email    = "$lang[bb_email]";
var text_code           = "$lang[bb_code]";
var text_quote          = "$lang[bb_quote]";
var text_upload         = "$lang[bb_t_up]";
var error_no_url        = "$lang[bb_no_url]";
var error_no_title      = "$lang[bb_no_title]";
var error_no_email      = "$lang[bb_no_email]";
var prompt_start        = "$lang[bb_prompt_start]";
var img_title   		= "$lang[bb_img_title]";
var email_title  	    = "$lang[bb_email_title]";
var text_pages  	    = "$lang[bb_bb_page]";
var image_align  	    = "{$config['image_align']}";
var bb_t_emo  	        = "{$lang['bb_t_emo']}";
var bb_t_col  	        = "{$lang['bb_t_col']}";
var text_enter_list     = "{$lang['bb_list_item']}";
var text_alt_image      = "{$lang['bb_alt_image']}";
var img_align  	        = "{$lang['images_align']}";
var img_align_sel  	    = "<select name='dleimagealign' id='dleimagealign' class='ui-widget-content ui-corner-all'><option value='' {$image_align[0]}>{$lang['images_none']}</option><option value='left' {$image_align['left']}>{$lang['images_left']}</option><option value='right' {$image_align['right']}>{$lang['images_right']}</option><option value='center' {$image_align['center']}>{$lang['images_center']}</option></select>";

var selField  = "{$startform}";
var fombj    = {$addform};
-->
</script>
{$code}
HTML;

} else {

	if( $config['allow_comments_wysiwyg'] == "-1" ) {

		$code = <<<HTML
<div class="bb-editor">
<textarea name="comments" id="comments" cols="70" rows="10">{text}</textarea>
</div>
HTML;

		if ( isset($allow_subscribe) AND $allow_subscribe ) $code .= "<br /><input type=\"checkbox\" name=\"allow_subscribe\" id=\"allow_subscribe\" value=\"1\" /><label for=\"allow_subscribe\">&nbsp;" . $lang['c_subscribe'] . "</label><br />";

		$bb_code = 	$code;
		$startform = "comments"; 
		$addform = "document.getElementById( 'dle-comments-form' )";
		$add_id = false;
		
	} else {
		
		$js_array[] = "engine/classes/js/bbcodes.js";
		$startform = "comments"; 
		$addform = "document.getElementById( 'dle-comments-form' )";
		$add_id = false;
	
		if ($user_group[$member_id['user_group']]['allow_url']) {
		  $url_link = "<b id=\"b_url\" class=\"bb-btn\" onclick=\"tag_url()\" title=\"{$lang['bb_t_url']}\"></b><b id=\"b_leech\" class=\"bb-btn\" onclick=\"tag_leech()\" title=\"{$lang['bb_t_leech']}\"></b>";
		} else $url_link = "";
	
		if ($user_group[$member_id['user_group']]['allow_image']) {
			$image_link = "<b id=\"b_img\" class=\"bb-btn\" onclick=\"tag_image()\" title=\"{$lang['bb_b_img']}\"></b>";
		} else $image_link = "";
	
		$code = <<<HTML
<div class="bb-editor">
<div class="bb-pane" onmouseenter="if(is_ie9) get_sel(eval('fombj.'+ selField));">
<b id="b_b" class="bb-btn" onclick="simpletag('b')" title="{$lang['bb_t_b']}"></b>
<b id="b_i" class="bb-btn" onclick="simpletag('i')" title="{$lang['bb_t_i']}"></b>
<b id="b_u" class="bb-btn" onclick="simpletag('u')" title="{$lang['bb_t_u']}"></b>
<b id="b_s" class="bb-btn" onclick="simpletag('s')" title="{$lang['bb_t_s']}"></b>
<span class="bb-sep"></span>
<b id="b_left" class="bb-btn" onclick="simpletag('left')" title="{$lang['bb_t_l']}"></b>
<b id="b_center" class="bb-btn" onclick="simpletag('center')" title="{$lang['bb_t_c']}"></b>
<b id="b_right" class="bb-btn" onclick="simpletag('right')" title="{$lang['bb_t_r']}"></b>
<span class="bb-sep"></span>
<b id="b_emo" class="bb-btn" onclick="ins_emo(this)" title="{$lang['bb_t_emo']}"></b>
{$url_link}
{$image_link}
<b id="b_color" class="bb-btn" onclick="ins_color(this)" title="{$lang['bb_t_color']}"></b>
<span class="bb-sep"></span>
<b id="b_hide" class="bb-btn" onclick="simpletag('hide')" title="{$lang['bb_t_hide']}"></b>
<b id="b_quote" class="bb-btn" onclick="simpletag('quote')" title="{$lang['bb_t_quote']}"></b>
<b id="b_tnl" class="bb-btn" onclick="translit()" title="{$lang['bb_t_translit']}"></b>
<b id="b_spoiler" class="bb-btn" onclick="simpletag('spoiler')" title="{$lang['bb_t_spoiler']}"></b>
</div>
<div id="dle_emos" style="display: none;" title="{$lang['bb_t_emo']}"><div style="width:100%;height:100%;overflow: auto;">{$output}</div></div>
<textarea name="comments" id="comments" cols="70" rows="10" onfocus="setNewField(this.name, document.getElementById( 'dle-comments-form' ))">{text}</textarea>
</div>
HTML;
	
		if ( isset($allow_subscribe) AND $allow_subscribe ) $code .= "<br /><input type=\"checkbox\" name=\"allow_subscribe\" id=\"allow_subscribe\" value=\"1\" /><label for=\"allow_subscribe\">&nbsp;" . $lang['c_subscribe'] . "</label><br />";
	
		$image_align = array (0 => '', 'left' => '', 'right' => '', 'center' => '');
		$image_align[$config['image_align']] = "selected";
	
	
		$bb_code = <<<HTML
<script type="text/javascript">
<!--
var text_enter_url       = "$lang[bb_url]";
var text_enter_size       = "$lang[bb_flash]";
var text_enter_flash       = "$lang[bb_flash_url]";
var text_enter_page      = "$lang[bb_page]";
var text_enter_url_name  = "$lang[bb_url_name]";
var text_enter_tooltip  = "$lang[bb_url_tooltip]";
var text_enter_page_name = "$lang[bb_page_name]";
var text_enter_image    = "$lang[bb_image]";
var text_enter_email    = "$lang[bb_email]";
var text_code           = "$lang[bb_code]";
var text_quote          = "$lang[bb_quote]";
var text_upload         = "$lang[bb_t_up]";
var error_no_url        = "$lang[bb_no_url]";
var error_no_title      = "$lang[bb_no_title]";
var error_no_email      = "$lang[bb_no_email]";
var prompt_start        = "$lang[bb_prompt_start]";
var img_title   		= "$lang[bb_img_title]";
var email_title  	    = "$lang[bb_email_title]";
var text_pages  	    = "$lang[bb_bb_page]";
var image_align  	    = "{$config['image_align']}";
var bb_t_emo  	        = "{$lang['bb_t_emo']}";
var bb_t_col  	        = "{$lang['bb_t_col']}";
var text_enter_list     = "{$lang['bb_list_item']}";
var text_alt_image      = "{$lang['bb_alt_image']}";
var img_align  	        = "{$lang['images_align']}";
var img_align_sel  	    = "<select name='dleimagealign' id='dleimagealign' class='ui-widget-content ui-corner-all'><option value='' {$image_align[0]}>{$lang['images_none']}</option><option value='left' {$image_align['left']}>{$lang['images_left']}</option><option value='right' {$image_align['right']}>{$lang['images_right']}</option><option value='center' {$image_align['center']}>{$lang['images_center']}</option></select>";
	
var selField  = "{$startform}";
var fombj    = {$addform};
-->
</script>
{$code}
HTML;
	}
}

?>