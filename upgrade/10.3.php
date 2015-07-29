<?php

if( ! defined( 'DATALIFEENGINE' ) ) {
	die( "Hacking attempt!" );
}

if( !$_SESSION['step_update'] ) {

	$tableSchema[] = "DROP TABLE IF EXISTS " . PREFIX . "_comment_rating_log";
	$tableSchema[] = "CREATE TABLE " . PREFIX . "_comment_rating_log (
  `id` int unsigned NOT NULL auto_increment,
  `c_id` int NOT NULL default '0',
  `member` varchar(40) NOT NULL default '',
  `ip` varchar(40) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `c_id` (`c_id`),
  KEY `member` (`member`),
  KEY `ip` (`ip`)
  ) ENGINE=MyISAM /*!40101 DEFAULT CHARACTER SET " . COLLATE . " COLLATE " . COLLATE . "_general_ci */";

	$tableSchema[] = "INSERT INTO " . PREFIX . "_email values (7, 'wait_mail', 'Уважаемый {%username%},\r\n\r\nВы сделали запрос на обьединение  вашего аккаунта на сайте {$config['http_home_url']} с аккаунтом в социальной сети {%network%}.  Однако в целях безопасности вам необходимо подтвердить данное действие по следующей ссылке: \r\n\r\n------------------------------------------------\r\n{%link%}\r\n------------------------------------------------\r\n\r\nВнимание, в случае объединения аккаунтов, ваш основной пароль на сайте будет сброшен, и если вы входили на сайт используя ваш логин и пароль, то ваш пароль будет больше не действителен.\r\n\r\nЕсли вы не делали данного запроса, то просто удалите это письмо, данные вашего аккаунта хранятся в надежном месте, и недоступны посторонним лицам.\r\n\r\nIP адрес отправителя: {%ip%}\r\n\r\nС уважением,\r\n\r\nАдминистрация {$config['http_home_url']}')";
	$tableSchema[] = "INSERT INTO " . PREFIX . "_email values (8, 'newsletter', '<html>\r\n<head>\r\n<title>{%title%}</title>\r\n<meta content=\"text/html; charset={%charset%}\" http-equiv=Content-Type>\r\n<style type=\"text/css\">\r\nhtml,body{\r\n    font-family: Verdana;\r\n    word-spacing: 0.1em;\r\n    letter-spacing: 0;\r\n    line-height: 1.5em;\r\n    font-size: 11px;\r\n}\r\n\r\np {\r\n	margin:0px;\r\n	padding: 0px;\r\n}\r\n\r\na:active,\r\na:visited,\r\na:link {\r\n	color: #4b719e;\r\n	text-decoration:none;\r\n}\r\n\r\na:hover {\r\n	color: #4b719e;\r\n	text-decoration: underline;\r\n}\r\n</style>\r\n</head>\r\n<body>\r\n{%content%}\r\n</body>\r\n</html>')";


	$tableSchema[] = "ALTER TABLE `" . PREFIX . "_social_login` ADD `wait` TINYINT(1) NOT NULL DEFAULT '0'";
	$tableSchema[] = "ALTER TABLE `" . PREFIX . "_category` ADD `allow_rss` TINYINT(1) NOT NULL DEFAULT '1'";
	$tableSchema[] = "ALTER TABLE `" . PREFIX . "_usergroups` ADD `allow_comments_rating` TINYINT(1) NOT NULL DEFAULT '1'";
	$tableSchema[] = "ALTER TABLE `" . PREFIX . "_email` ADD `use_html` TINYINT(1) NOT NULL DEFAULT '0'";
	$tableSchema[] = "ALTER TABLE `" . PREFIX . "_admin_logs` CHANGE `ip` `ip` VARCHAR(40) NOT NULL DEFAULT ''";
	$tableSchema[] = "ALTER TABLE `" . PREFIX . "_login_log` CHANGE `ip` `ip` VARCHAR(40) NOT NULL DEFAULT ''";
	$tableSchema[] = "ALTER TABLE `" . PREFIX . "_logs` CHANGE `ip` `ip` VARCHAR(40) NOT NULL DEFAULT ''";
	$tableSchema[] = "ALTER TABLE `" . PREFIX . "_read_log` CHANGE `ip` `ip` VARCHAR(40) NOT NULL DEFAULT ''";
	$tableSchema[] = "ALTER TABLE `" . PREFIX . "_spam_log` CHANGE `ip` `ip` VARCHAR(40) NOT NULL DEFAULT ''";
	$tableSchema[] = "ALTER TABLE `" . PREFIX . "_vote_result` CHANGE `ip` `ip` VARCHAR(40) NOT NULL DEFAULT ''";

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

	$sql_info = "<div style=\"background:#F2DDDD;border:1px solid #992A2A;padding:5px;color: #992A2A;text-align: justify;\"><b>Важная информация:</b><br /><br />На следующем шаге системе обновления DLE необходимо выполнить тяжелый запрос для таблицы пользователей. На некоторых больших сайтах выполнение данного запроса может занимать продолжительное время и возможно не сможет быть выполнено PHP скриптом. Если скрипт зависнет и запрос не будет выполнен, то вам необходимо будет выполнить данный запрос вручную средствами SSH. Скопируйте запрос, который вам необходимо будет выполнить, если он не будет выполнен автоматически:<br/><br/><b>ALTER TABLE `" . PREFIX . "_users` CHANGE `logged_ip` `logged_ip` VARCHAR(40) NOT NULL DEFAULT '';</b><br /><br /></div>";

	$_SESSION['step_update'] = 1;

	if ( $error_info ) {

		msgbox("info","Информация", "{$error_info}<br />{$sql_info}<br /><br />Нажмите далее для продолжения процессa обновления скрипта.");

	} else {

	    msgbox("info","Информация", "<br /><div style=\"border: 1px solid #475936; background: #6F8F52; color: #FFFFFF;padding:8px;text-align: justify;\">Было успешно выполнено <b>".$db->query_num."</b> запросов.</div><br /><br />{$sql_info}<br /><br />Нажмите далее для продолжения процессa обновления скрипта.");

	}

	die();
}

if( $_SESSION['step_update'] == 1 ) {

	$db->query ("ALTER TABLE `" . PREFIX . "_users` CHANGE `logged_ip` `logged_ip` VARCHAR(40) NOT NULL DEFAULT ''");

	if ($db->error_count) {
	
		$error_info = "Всего запланировано запросов: <b>".$db->query_num."</b> Неудалось выполнить запросов: <b>".$db->error_count."</b>. Возможно они уже выполнены ранее.<br /><br /><div class=\"quote\"><b>Список не выполненных запросов:</b><br /><br />"; 
	
		foreach ($db->query_list as $value) {
	
			$error_info .= $value['query']."<br /><br />";
	
		}
	
		$error_info .= "</div>";
	
	} else $error_info = "";

	$_SESSION['step_update'] = 2;

	$sql_info = "<div style=\"background:#F2DDDD;border:1px solid #992A2A;padding:5px;color: #992A2A;text-align: justify;\"><b>Важная информация:</b><br /><br />На следующем шаге системе обновления DLE необходимо выполнить тяжелый запрос для таблицы пользователей. На некоторых больших сайтах выполнение данного запроса может занимать продолжительное время и возможно не сможет быть выполнено PHP скриптом. Если скрипт зависнет и запрос не будет выполнен, то вам необходимо будет выполнить данный запрос вручную средствами SSH. Скопируйте запрос, который вам необходимо будет выполнить, если он не будет выполнен автоматически:<br/><br/><b>ALTER TABLE `" . PREFIX . "_comments` CHANGE `ip` `ip` VARCHAR(40) NOT NULL DEFAULT '', ADD `rating` INT(11) NOT NULL DEFAULT '0', ADD `vote_num` INT(11) NOT NULL DEFAULT '0';</b><br /><br /></div>";

	if ( $error_info ) {

		msgbox("info","Информация", "{$error_info}<br />{$sql_info}<br /><br />Нажмите далее для продолжения процессa обновления скрипта.");

	} else {

	    msgbox("info","Информация", "<br /><br /><div style=\"border: 1px solid #475936; background: #6F8F52; color: #FFFFFF;padding:8px;text-align: justify;\">Был успешно выполнен <b>1 MySQL</b> запрос.</div><br /><br />{$sql_info}<br /><br />Нажмите далее для продолжения процессa обновления скрипта.");

	}

	die();

}

if( $_SESSION['step_update'] == 2 ) {

	$db->query ("ALTER TABLE `" . PREFIX . "_comments` CHANGE `ip` `ip` VARCHAR(40) NOT NULL DEFAULT '', ADD `rating` INT(11) NOT NULL DEFAULT '0', ADD `vote_num` INT(11) NOT NULL DEFAULT '0'");

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

	$config['version_id'] = "10.4";
	$config['login_ban_timeout'] = "20";
	$config['watermark_seite'] = "4";
	$config['auth_only_social'] = "0";
	$config['rating_type'] = "0";
	$config['allow_comments_rating'] = "1";
	$config['comments_rating_type'] = "1";

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

	msgbox("info","Информация", "Обновление базы данных с версии <b>10.3</b> до версии <b>10.4</b> успешно завершено.<br /><br />Нажмите далее для продолжения процессa обновления скрипта.");

}

?>