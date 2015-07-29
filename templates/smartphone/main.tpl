<!DOCTYPE html>
<html>
<head>
{headers}
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="{THEME}/css/engine.css" rel="stylesheet">
<link href="{THEME}/css/style.css" rel="stylesheet">
<script src="{THEME}/js/libs.js" type="text/javascript"></script>
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<!--[if lt IE 9]><script src="{THEME}/js/html5shiv.js" type="text/javascript"></script><![endif]-->
</head>
<body>
	{AJAX}
	<div id="toolbar">
		<div id="in-toolbar">
			{login}
			<a id="menu-btn">
				<span id="hamburger"></span>
			</a>
		</div>
		<!-- Head Menu -->
		<nav id="menu-head">
			<a href="#">О сайте</a>
			<a href="#">В мире</a>
			<a href="#">Экономика</a>
			<a href="#">Религия</a>
			<a href="#">Криминал</a>
			<a href="#">Спорт</a>
			<a href="#">Культура</a>
			<a href="#">Инопресса</a>
		</nav>
		<!-- Head Menu [E] -->
	</div>
	<div class="background"></div>
	<header id="header">
		<!-- LogoType -->
		<a id="logo" href="/">
			<b id="logo-text">Datalife Engine</b>
			<span>Softnews Media Group</span>
		</a>
		<!-- LogoType [E] -->
		<!--Search-->
		<form id="quicksearch" method="post" action=''>
			<input type="hidden" name="do" value="search">
			<input type="hidden" name="subaction" value="search">
			<div class="quicksearch">
				<input class="f_input" placeholder="Поиск..." name="story" value="" type="search">
				<button type="submit" title="Search" class="thd">Найти</button>
			</div>
		</form>
		<!--Search [E]-->
		<a id="go2full" class="ico" href="/index.php?action=mobiledisable">Полная версия сайта</a>
	</header>
	<section id="content">
		{info}
		{content}
	</section>
	<div id="footmenu">
		<h3>Навигация</h3>
		<nav class="main-nav">
			<a href="#">О сайте</a>
			<a href="#">В мире</a>
			<a href="#">Экономика</a>
			<a href="#">Религия</a>
			<a href="#">Криминал</a>
			<a href="#">Спорт</a>
			<a href="#">Культура</a>
			<a href="#">Инопресса</a>
			<span class="nav-sep"></span>
			<a href="/index.php?do=lastnews" target="_blank">Все последние новости</a>
			<a href="http://dle-news.ru" target="_blank">Поддержка скрипта</a>
			<a href="/index.php?action=mobiledisable">Полная версия сайта</a>
		</nav>
	</div>
	<footer id="footer">
		<div class="background"></div>
		<div id="copyright">Powered by <a href="http://dle-news.ru" target="_blank">DataLife Engine</a> © 2015</div>
	</footer>
	<script type="text/javascript">
	// <![CDATA[
		(function(doc) {

		var addEvent = 'addEventListener',
		type = 'gesturestart',
		qsa = 'querySelectorAll',
		scales = [1, 1],
		meta = qsa in doc ? doc[qsa]('meta[name=viewport]') : [];

		function fix() {
		meta.content = 'width=device-width,minimum-scale=' + scales[0] + ',maximum-scale=' + scales[1];
		doc.removeEventListener(type, fix, true);
		}

		if ((meta = meta[meta.length - 1]) && addEvent in doc) {
		fix();
		scales = [.25, 1.6];
		doc[addEvent](type, fix, true);
		}

		}(document));
	// ]]>
	</script>
</body>
</html>