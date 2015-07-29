<article class="post static">
  <h1 class="title">
    [registration]Регистрация[/registration]
    [validation]Продолжение регистрации[/validation]
  </h1>
    [registration]
      <b>Здравствуйте, уважаемый посетитель нашего сайта!</b><br />
      Регистрация на нашем сайте позволит Вам быть его полноценным участником.
      Вы сможете добавлять новости на сайт, оставлять свои комментарии, просматривать скрытый текст и многое другое.
      <br />В случае возникновения проблем с регистрацией, обратитесь к <a href="/index.php?do=feedback">администратору</a> сайта.
    [/registration]
    [validation]
      <b>Уважаемый посетитель,</b><br />
      Ваш аккаунт был зарегистрирован на нашем сайте,
      однако информация о Вас является неполной, поэтому заполните дополнительные поля в Вашем профиле.
    [/validation]
</article>
<div class="ux-form">
  <ul class="ui-form">
    [registration]
      <li>
        <div class="combofield">
          <input placeholder="Логин" type="text" name="name" id="name" class="f_input f_wide">
          <input class="bbcodes" title="Check" onclick="CheckLogin(); return false;" type="button" value="Проверить">
        </div>
        <div class="clr" id='result-registration'></div>
      </li>
      <li>
        <input placeholder="Пароль" type="password" name="password1" id="password1" class="f_input f_wide">
      </li>
      <li>
        <input placeholder="Повторите пароль" type="password" name="password2" id="password2" class="f_input f_wide">
      </li>
      <li>
        <input placeholder="E-mail" type="email" name="email" id="email" class="f_input f_wide">
      </li>
      [question]
      <li>
        Вопрос: <b>{question}</b>
        <div><input placeholder="Ответ" type="text" name="question_answer" id="question_answer" class="f_input f_wide" ></div>
      </li>
      [/question]
      [sec_code]
      <li>
        <div class="c-captcha-box">
          <label for="sec_code">Повторите код:</label>
          <div class="c-captcha">
            {reg_code}
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
      [/registration]
      [validation]
      <li><input placeholder="Ваше имя" type="text" id="fullname" name="fullname" class="f_input f_wide"></li>
      <li><input placeholder="Местонахождение" type="text" id="land" name="land" class="f_input f_wide"></li>
      <li><input placeholder="ICQ" type="text" id="icq" name="icq" class="f_input f_wide"></li>
      <li><textarea placeholder="О себе" id="info" name="info" rows="3" class="f_textarea f_wide"></textarea></li>
      <li><label for="image">Аватар:</label><input type="file" id="image" name="image" class="f_input f_wide"></li>
      [/validation]
  </ul>
  <div class="submitline">
    <button name="submit" class="btn f_wide" type="submit">Зарегистрироваться</button>
  </div>
</div>