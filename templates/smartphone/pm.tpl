<article class="post static">
  <h1 class="title">Персональные сообщения</h1>
  [inbox]Входящие сообщения[/inbox] <br /> [outbox]Отправленные сообщения[/outbox] <br /> [new_pm]Отправить сообщение[/new_pm]
</article>
[pmlist]
<div class="ux-form">
  <h3>Список сообщений</h3>
  {pmlist}
</div>
[/pmlist]
[newpm]
<div class="ux-form">
  <h3>Отправка сообщения</h3>
  <ul class="ui-form">
    <li><input placeholder="Получатель" type="text" name="name" value="{author}" class="f_input f_wide"></li>
    <li><input placeholder="Тема" type="text" name="subj" value="{subj}" class="f_input f_wide"></li>
    <li><textarea placeholder="Сообщение" name="comments" id="comments" rows="2" class="f_textarea f_wide">{text}</textarea></li>
    <li><input type="checkbox" name="outboxcopy" value="1"> Сохранить сообщение в папке "Отправленные"</li>
    [sec_code]
    <li>
      <div class="c-captcha-box">
        <label for="sec_code">Повторите код:</label>
        <div class="c-captcha">
          {sec_code}
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
  </ul>
  <div class="submitline">
    <button class="btn f_wide" name="add" type="submit" name="submit">Отправить сообщение</button>
  </div>
</div>
[/newpm]
[readpm]
<div class="comment vcard">
  <div class="com-cont clrfix">
    <strong>{subj}</strong><br />
    {text}
  </div>
  <div class="com-inf">
    <span class="arg">Сообщение от <b class="fn">{author}</b></span>
    <span class="fast">[reply]<b class="thd">Ответить</b>[/reply]</span>
    <span class="del">[del]<b class="thd">Удалить</b>[/del]</span>
  </div>
</div>
[/readpm]