<article class="post static">
	<h1>Восстановление пароля</h1>
</article>
<div class="ux-form">
	<ul class="ui-form">
		<li><input placeholder="Логин или E-mail" class="f_input f_wide" type="text" name="lostname" id="lostname"></li>
		[sec_code]
		<li>
			<div class="c-captcha-box">
				<label for="sec_code">Повторите код:</label>
				<div class="c-captcha">
					{code}
					<input title="Введите код указанный на картинке" type="text" name="sec_code" id="sec_code" class="f_input" >
				</div>
			</div>
		</li>
		[/sec_code]
		[recaptcha]
		<li>
			<div>Введите слова</div>
			{recaptcha}
		</li>
		[/recaptcha]
	<div class="submitline">
		<button name="submit" class="btn f_wide" type="submit">Восстановить</button>
	</div>
</div>