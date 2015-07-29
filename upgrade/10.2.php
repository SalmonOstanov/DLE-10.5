<?php

if( ! defined( 'DATALIFEENGINE' ) ) {
	die( "Hacking attempt!" );
}

if( !$_SESSION['step_update'] ) {

	$tableSchema = array();

	$tableSchema[] = "DROP TABLE IF EXISTS " . PREFIX . "_social_login";
	$tableSchema[] = "CREATE TABLE " . PREFIX . "_social_login (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` varchar(40) NOT NULL DEFAULT '',
  `uid` int(11) NOT NULL DEFAULT '0',
  `password` varchar(32) NOT NULL DEFAULT '',
  `provider` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `sid` (`sid`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARACTER SET " . COLLATE . " COLLATE " . COLLATE . "_general_ci */";

	$tableSchema[] = "ALTER TABLE `" . PREFIX . "_links` ADD `rcount` TINYINT(3) NOT NULL DEFAULT '0'";

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

	$sql_info = "<div style=\"background:#F2DDDD;border:1px solid #992A2A;padding:5px;color: #992A2A;text-align: justify;\"><b>Важная информация:</b><br /><br />На следующем шаге системе обновления DLE необходимо выполнить тяжелый запрос для таблицы пользователей. На некоторых больших сайтах выполнение данного запроса может занимать продолжительное время и возможно не сможет быть выполнено PHP скриптом. Если скрипт зависнет и запрос не будет выполнен, то вам необходимо будет выполнить данный запрос вручную средствами SSH. Скопируйте запрос, который вам необходимо будет выполнить, если он не будет выполнен автоматически:<br/><br/><b>ALTER TABLE `" . PREFIX . "_users` DROP `icq`;</b><br /><br /></div>";

	$_SESSION['step_update'] = 1;

	if ( $error_info ) {

		msgbox("info","Информация", "{$error_info}<br />{$sql_info}<br /><br />Нажмите далее для продолжения процессa обновления скрипта.");

	} else {

	    msgbox("info","Информация", "<br /><div style=\"border: 1px solid #475936; background: #6F8F52; color: #FFFFFF;padding:8px;text-align: justify;\">Было успешно выполнено <b>3 MySQL</b> запроса.</div><br /><br />{$sql_info}<br /><br />Нажмите далее для продолжения процессa обновления скрипта.");

	}

	die();
}

if( $_SESSION['step_update'] == 1 ) {

	$db->query ("ALTER TABLE `" . PREFIX . "_users` DROP `icq`;");

	if ($db->error_count) {
	
		$error_info = "Всего запланировано запросов: <b>".$db->query_num."</b> Неудалось выполнить запросов: <b>".$db->error_count."</b>. Возможно они уже выполнены ранее.<br /><br /><div class=\"quote\"><b>Список не выполненных запросов:</b><br /><br />"; 
	
		foreach ($db->query_list as $value) {
	
			$error_info .= $value['query']."<br /><br />";
	
		}
	
		$error_info .= "</div>";
	
	} else $error_info = "";

	$_SESSION['step_update'] = 2;

	$sql_info = "<div style=\"background:#F2DDDD;border:1px solid #992A2A;padding:5px;color: #992A2A;text-align: justify;\"><b>Важная информация:</b><br /><br />На следующем шаге системе обновления DLE необходимо выполнить тяжелый запрос для таблицы пользователей. На некоторых больших сайтах выполнение данного запроса может занимать продолжительное время и возможно не сможет быть выполнено PHP скриптом. Если скрипт зависнет и запрос не будет выполнен, то вам необходимо будет выполнить данный запрос вручную средствами SSH. Скопируйте запрос, который вам необходимо будет выполнить, если он не будет выполнен автоматически:<br/><br/><b>ALTER TABLE `" . PREFIX . "_users` ADD `timezone` VARCHAR(100) NOT NULL DEFAULT ''</b><br /><br /></div>";

	if ( $error_info ) {

		msgbox("info","Информация", "{$error_info}<br />{$sql_info}<br /><br />Нажмите далее для продолжения процессa обновления скрипта.");

	} else {

	    msgbox("info","Информация", "<br /><br /><div style=\"border: 1px solid #475936; background: #6F8F52; color: #FFFFFF;padding:8px;text-align: justify;\">Был успешно выполнен <b>1 MySQL</b> запрос.</div><br /><br />{$sql_info}<br /><br />Нажмите далее для продолжения процессa обновления скрипта.");

	}

	die();

}

if( $_SESSION['step_update'] == 2 ) {

	$db->query ("ALTER TABLE `" . PREFIX . "_users` ADD `timezone` VARCHAR(100) NOT NULL DEFAULT ''");

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

	$config['version_id'] = "10.3";
	$config['category_separator'] = "/";
	$config['speedbar_separator'] = "&raquo;";
	$config['adminlog_maxdays'] = "30";
	$config['allow_social'] = "0";
	$config['medium_image'] = "0";
	$config['date_adjust'] = date_default_timezone_get();

	$handler = fopen(ENGINE_DIR.'/data/config.php', "w") or die("Извините, но невозможно записать информацию в файл <b>.engine/data/config.php</b>.<br />Проверьте правильность проставленного CHMOD!");
	fwrite($handler, "<?PHP \n\n//System Configurations\n\n\$config = array (\n\n");
	foreach($config as $name => $value)
	{
		fwrite($handler, "'{$name}' => \"{$value}\",\n\n");
	}
	fwrite($handler, ");\n\n?>");
	fclose($handler);

$social_config = <<<HTML
<?PHP

//Social Configurations

\$social_config = array (

'vk' => '0',

'vkid' => '',

'vksecret' => '',

'od' => '0',

'odid' => '',

'odpublic' => '',

'odsecret' => '',

'fc' => '0',

'fcid' => '',

'fcsecret' => '',

'google' => '0',

'googleid' => '',

'googlesecret' => '',

'mailru' => '0',

'mailruid' => '',

'mailrusecret' => '',

'yandex' => '0',

'yandexid' => '',

'yandexsecret' => '',

);

?>
HTML;

	$con_file = fopen(ENGINE_DIR."/data/socialconfig.php", "w+") or die("Извините, но невозможно создать файл <b>.engine/data/socialconfig.php</b>.<br />Проверьте правильность проставленного CHMOD!");
	fwrite($con_file, $social_config);
	fclose($con_file);
	@chmod(ENGINE_DIR."/data/socialconfig.php", 0666);
	
	$fdir = opendir( ENGINE_DIR . '/cache/system/' );
	while ( $file = readdir( $fdir ) ) {
		if( $file != '.' and $file != '..' and $file != '.htaccess' ) {
			@unlink( ENGINE_DIR . '/cache/system/' . $file );
			
		}
	}
	
	@unlink(ENGINE_DIR.'/data/snap.db');
	
	clear_cache();

	$_SESSION['step_update'] = false;

	msgbox("info","Информация", "Обновление базы данных с версии <b>10.2</b> до версии <b>10.3</b> успешно завершено.<br /><br />Нажмите далее для продолжения процессa обновления скрипта.");

}

?>