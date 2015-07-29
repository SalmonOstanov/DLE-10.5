[not-group=5]
<a id="login-btn" class="logged ico">{login}</a>
<div id="lg-dialog" title="О пользователе" class="wideDialog">
	<a id="lg-close" class="thd">Закрыть</a>
	<ul id="usermenu">
		<li><a href="{profile-link}">Мой профиль</a></li>
		<li><a href="{pm-link}">Cообщения ({new-pm} | {all-pm})</a></li>
		<li><a href="{favorites-link}">Мои закладки</a></li>
		<li><a href="{stats-link}">Статистика</a></li>
		<li><a href="{newposts-link}">Обзор непрочитанного</a></li>
		<li><a href="{logout-link}">Завершить сеанс!</a></li>
	</ul>
</div>
[/not-group]
[group=5]
<a id="login-btn" class="ico">Войти</a>
<div id="lg-dialog" title="Авторизация" class="wideDialog">
	<a id="lg-close" class="thd">Закрыть</a>
	<form class="login-form" method="post" action="">
		<ul>
			<li><label for="login_name">{login-method}</label>
			<input class="f_input" type="text" name="login_name" id="login_name" ></li>
			<li><label for="login_password">Пароль:</label>
			<input class="f_input" type="password" name="login_password" id="login_password" ></li>
		</ul>
		<div class="submitline">
			<button onclick="submit();" type="submit" title="Войти" class="btn f_wide">Войти</button>
		</div>
		<div class="log-links">
			<a href="{lostpassword-link}">Забыли пароль?</a> |
			<a href="{registration-link}">Регистрация</a>
		</div>
		<input name="login" type="hidden" id="login" value="submit">
	</form>
</div>
[/group]