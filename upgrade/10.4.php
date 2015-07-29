<?php

if( ! defined( 'DATALIFEENGINE' ) ) {
	die( "Hacking attempt!" );
}

if( !$_SESSION['step_update'] ) {

	$tableSchema[] = "ALTER TABLE `" . PREFIX . "_usergroups` ADD `max_edit_days` TINYINT(1) NOT NULL DEFAULT '0'";
	$tableSchema[] = "ALTER TABLE `" . PREFIX . "_usergroups` ADD `spampmfilter` TINYINT(1) NOT NULL DEFAULT '2'";


	foreach($tableSchema as $table) {
		$db->query ($table);
	}

	if ($db->error_count) {
	
		$error_info = "Всего запланировано запросов: <b>".$db->query_num."</b> Неудалось выполнить запросов: <b>".$db->error_count."</b>. Возможно они уже выполнены ранее.<br /><br /><div class=\"quote\"><b>Список не выполненных запросов:</b><br /><br />"; 
	
		foreach ($db->query_list as $value) {
	
			$error_info .= $value['query']."<br /><br />";
	
		}
	
		$error_info .= "</div>";
	
	} else $error_info = "";

	$sql_info = "<div style=\"background:#F2DDDD;border:1px solid #992A2A;padding:5px;color: #992A2A;text-align: justify;\"><b>Важная информация:</b><br /><br />На следующем шаге системе обновления DLE необходимо выполнить тяжелый запрос для таблицы пользователей. На некоторых больших сайтах выполнение данного запроса может занимать продолжительное время и возможно не сможет быть выполнено PHP скриптом. Если скрипт зависнет и запрос не будет выполнен, то вам необходимо будет выполнить данный запрос вручную средствами SSH. Скопируйте запрос, который вам необходимо будет выполнить, если он не будет выполнен автоматически:<br/><br/><b>ALTER TABLE `" . PREFIX . "_comments` ADD `parent` INT(11) NOT NULL DEFAULT '0', ADD INDEX `parent` (`parent`);</b><br /><br /></div>";

	$_SESSION['step_update'] = 1;

	if ( $error_info ) {

		msgbox("info","Информация", "{$error_info}<br />{$sql_info}<br /><br />Нажмите далее для продолжения процессa обновления скрипта.");

	} else {

	    msgbox("info","Информация", "<br /><div style=\"border: 1px solid #475936; background: #6F8F52; color: #FFFFFF;padding:8px;text-align: justify;\">Было успешно выполнено <b>".$db->query_num."</b> запросов.</div><br /><br />{$sql_info}<br /><br />Нажмите далее для продолжения процессa обновления скрипта.");

	}

	die();
}

if( $_SESSION['step_update'] == 1 ) {

	$db->query ("ALTER TABLE `" . PREFIX . "_comments` ADD `parent` INT(11) NOT NULL DEFAULT '0', ADD INDEX `parent` (`parent`)");

	if ($db->error_count) {
	
		$error_info = "Всего запланировано запросов: <b>".$db->query_num."</b> Неудалось выполнить запросов: <b>".$db->error_count."</b>. Возможно они уже выполнены ранее.<br /><br /><div class=\"quote\"><b>Список не выполненных запросов:</b><br /><br />"; 
	
		foreach ($db->query_list as $value) {
	
			$error_info .= $value['query']."<br /><br />";
	
		}
	
		$error_info .= "</div>";
	
	} else $error_info = "";

	$_SESSION['step_update'] = 2;

	$sql_info = "<div style=\"background:#F2DDDD;border:1px solid #992A2A;padding:5px;color: #992A2A;text-align: justify;\"><b>Важная информация:</b><br /><br />На следующем шаге системе обновления DLE необходимо выполнить тяжелый запрос для таблицы пользователей. На некоторых больших сайтах выполнение данного запроса может занимать продолжительное время и возможно не сможет быть выполнено PHP скриптом. Если скрипт зависнет и запрос не будет выполнен, то вам необходимо будет выполнить данный запрос вручную средствами SSH. Скопируйте запрос, который вам необходимо будет выполнить, если он не будет выполнен автоматически:<br/><br/><b>ALTER TABLE `" . PREFIX . "_users` CHANGE `foto` `foto` VARCHAR(255) NOT NULL DEFAULT '';</b><br /><br /></div>";

	if ( $error_info ) {

		msgbox("info","Информация", "{$error_info}<br />{$sql_info}<br /><br />Нажмите далее для продолжения процессa обновления скрипта.");

	} else {

	    msgbox("info","Информация", "<br /><br /><div style=\"border: 1px solid #475936; background: #6F8F52; color: #FFFFFF;padding:8px;text-align: justify;\">Был успешно выполнен <b>1 MySQL</b> запрос.</div><br /><br />{$sql_info}<br /><br />Нажмите далее для продолжения процессa обновления скрипта.");

	}

	die();

}

if( $_SESSION['step_update'] == 2 ) {

	$db->query ("ALTER TABLE `" . PREFIX . "_users` CHANGE `foto` `foto` VARCHAR(255) NOT NULL DEFAULT ''");
	
	if ($db->error_count) {
	
		$error_info = "Всего запланировано запросов: <b>".$db->query_num."</b> Неудалось выполнить запросов: <b>".$db->error_count."</b>. Возможно они уже выполнены ранее.<br /><br /><div class=\"quote\"><b>Список не выполненных запросов:</b><br /><br />"; 
	
		foreach ($db->query_list as $value) {
	
			$error_info .= $value['query']."<br /><br />";
	
		}
	
		$error_info .= "</div>";
	
	} else $error_info = "";

	$_SESSION['step_update'] = 3;

	$sql_info = "";

	if ( $error_info ) {

		msgbox("info","Информация", "{$error_info}<br />{$sql_info}<br /><br />Нажмите далее для продолжения процессa обновления скрипта.");

	} else {

	    msgbox("info","Информация", "<div style=\"border: 1px solid #475936; background: #6F8F52; color: #FFFFFF;padding:8px;text-align: justify;\">Был успешно выполнен <b>1 MySQL</b> запрос.</div><br /><br />{$sql_info}<br /><br />Нажмите далее для продолжения процессa обновления скрипта.");

	}

	die();
}

if( $_SESSION['step_update'] == 3 ) {

	$config['version_id'] = "10.5";
	$config['tree_comments'] = "0";
	$config['tree_comments_level'] = "5";
	$config['simple_reply'] = "0";
	$config['recaptcha_theme'] = "light";
	$config['yandex_spam_check'] = "0";
	$config['yandex_api_key'] = "";
	$config['smtp_secure'] = "";
	
	unset($config['mail_additional']);
	unset($config['smtp_helo']);
	unset($config['use_admin_mail']);
	
	$handler = fopen(ENGINE_DIR.'/data/config.php', "w") or die("Извините, но невозможно записать информацию в файл <b>.engine/data/config.php</b>.<br />Проверьте правильность проставленного CHMOD!");
	fwrite($handler, "<?PHP \n\n//System Configurations\n\n\$config = array (\n\n");
	foreach($config as $name => $value)
	{
		fwrite($handler, "'{$name}' => \"{$value}\",\n\n");
	}
	fwrite($handler, ");\n\n?>");
	fclose($handler);
	
	$fdir = opendir( ENGINE_DIR . '/cache/system/' );
	while ( $file = readdir( $fdir ) ) {
		if( $file != '.' and $file != '..' and $file != '.htaccess' ) {
			@unlink( ENGINE_DIR . '/cache/system/' . $file );
			
		}
	}
	
	@unlink(ENGINE_DIR.'/data/snap.db');
	
	clear_cache();

	$_SESSION['step_update'] = false;

	msgbox("info","Информация", "Обновление базы данных с версии <b>10.4</b> до версии <b>10.5</b> успешно завершено.<br /><br />Нажмите далее для продолжения процессa обновления скрипта.");

}

?>