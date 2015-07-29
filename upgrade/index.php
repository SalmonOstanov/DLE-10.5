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
 Файл: index.php
-----------------------------------------------------
 Назначение: обновление DLE до актуальной версии
=====================================================
*/

session_start();
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

error_reporting(E_ALL ^ E_NOTICE);
@ini_set('display_errors', true);
@ini_set('html_errors', false);
@ini_set('error_reporting', E_ALL ^ E_NOTICE);

define('DATALIFEENGINE', true);
define('ROOT_DIR', "..");
define('ENGINE_DIR', ROOT_DIR.'/engine');

require_once(ENGINE_DIR.'/data/config.php');
require_once('mysql.php');
require_once(ENGINE_DIR.'/data/dbconfig.php');
require_once(ENGINE_DIR.'/inc/include/functions.inc.php');

$version_id = ($config_version_id) ? $config_version_id : $config['version_id'];

@header("Content-type: text/html; charset=".$config['charset']);

extract($_REQUEST, EXTR_SKIP);

$theme = ENGINE_DIR;

$dle_version = "10.5";
$distr_charset = "utf-8";


require_once(dirname (__FILE__).'/template.php');

if ( strtolower($config['charset']) != $distr_charset ) {
	msgbox("info", "Информация", "Кодировка вашего сайта не соответствует кодировке дистрибутива. Ваш сайт использует кодировку: <b>{$config['charset']}</b>, а дистрибутив на который вы пытаетесь обновиться содержит кодировку: <b>{$distr_charset}</b>. Вам необходимо скачать дистрибутив в соответствующей кодировке, чтобы продолжить обновление.");
	die();
}

switch ($version_id) {

case $dle_version :
	include dirname (__FILE__).'/finish.php';
	break;

case "10.4" :
	include dirname (__FILE__).'/10.4.php';
	break;

case "10.3" :
	include dirname (__FILE__).'/10.3.php';
	break;

case "10.2" :
	include dirname (__FILE__).'/10.2.php';
	break;

case "10.1" :
	include dirname (__FILE__).'/10.1.php';
	break;

case "10.0" :
	include dirname (__FILE__).'/10.0.php';
	break;

case "9.8" :
	include dirname (__FILE__).'/9.8.php';
	break;

case "9.7" :
	include dirname (__FILE__).'/9.7.php';
	break;

case "9.6" :
	include dirname (__FILE__).'/9.6.php';
	break;

case "9.5" :
	include dirname (__FILE__).'/9.5.php';
	break;

case "9.4" :
	include dirname (__FILE__).'/9.4.php';
	break;

case "9.3" :
	include dirname (__FILE__).'/9.3.php';
	break;

case "9.2" :
	include dirname (__FILE__).'/9.2.php';
	break;

case "9.0" :
	include dirname (__FILE__).'/9.0.php';
	break;

case "8.5" :
	include dirname (__FILE__).'/8.5.php';
	break;

case "8.3" :
	include dirname (__FILE__).'/8.3.php';
	break;

case "8.2" :
	include dirname (__FILE__).'/8.2.php';
	break;

case "8.0" :
	include dirname (__FILE__).'/8.0.php';
	break;

case "7.5" :
	include dirname (__FILE__).'/7.5.php';
	break;

case "7.3" :
	include dirname (__FILE__).'/7.3.php';
	break;

case "7.2" :
	include dirname (__FILE__).'/7.2.php';
	break;

case "7.0" :
	include dirname (__FILE__).'/7.0.php';
	break;

case "6.7" :
	include dirname (__FILE__).'/6.7.php';
	break;

case "6.5" :
	include dirname (__FILE__).'/6.5.php';
	break;

case "6.3" :
	include dirname (__FILE__).'/6.3.php';
	break;

case "6.2" :
	include dirname (__FILE__).'/6.2.php';
	break;

case "6.0" :
	include dirname (__FILE__).'/6.0.php';
	break;

case "5.7" :
	include dirname (__FILE__).'/5.7.php';
	break;

case "5.5" :
	include dirname (__FILE__).'/5.5.php';
	break;

case "5.3" :
	include dirname (__FILE__).'/5.3.php';
	break;

case "5.2" :
	include dirname (__FILE__).'/5.2.php';
	break;

case "5.1" :
	include dirname (__FILE__).'/5.1.php';
	break;

case "5.0" :
	include dirname (__FILE__).'/5.0.php';
	break;

case "4.5" :
	include dirname (__FILE__).'/4.5.php';
	break;

case "4.3" :
	include dirname (__FILE__).'/4.3.php';
	break;

case "4.2" :
	include dirname (__FILE__).'/4.2.php';
	break;

case "4.1" :
	include dirname (__FILE__).'/4.1.php';
	break;

case "4.0" :
	include dirname (__FILE__).'/4.0.php';
	break;

case "3.7" :
	include dirname (__FILE__).'/3.7.php';
	break;

case "3.5" :
	include dirname (__FILE__).'/3.5.php';
	break;

default:
	include dirname (__FILE__).'/error.php';
}

?>