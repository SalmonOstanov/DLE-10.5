<article class="post static">
  <h1 class="title">Пользователь: {usertitle}</h1>
  Полное имя: {fullname}<br />
  Дата регистрации: {registration}<br />
  Последнее посещение: {lastdate}<br />
  Группа: <font color="red">{status}</font>[time_limit] в группе до: {time_limit}[/time_limit]<br /><br />
  Место жительства: {land}<br />
  Номер ICQ: {icq}<br />
  Немного о себе:<br />{info}<br /><br />
  Количество публикаций: {news-num}<br />
  [ {news} ]<br /><br />
  Количество комментариев: {comm-num}<br />
  [ {comments} ]<br /><br />
  [ {email} ]<br />
  [ {pm} ]<br />
  {edituser}
</article>
[not-logged]
<div id="options" style="display:none;">
  <div class="ux-form">
    <h3>Редактирование информации</h3>
    <ul class="ui-form">
      <li><input placeholder="E-mail" type="email" name="email" value="{editmail}" class="f_input f_wide"><div>{hidemail}</div></li>
      <li><br /></li>
      <li><input placeholder="Ваше Имя" type="text" name="fullname" value="{fullname}" class="f_input f_wide"></li>
      <li><input placeholder="Место жительства" type="text" name="land" value="{land}" class="f_input f_wide"></li>
      <li><input placeholder="Номер ICQ" type="text" name="icq" value="{icq}" class="f_input f_wide"></li>
      <li><br /></li>
      <li><input placeholder="Старый пароль" type="password" name="altpass" class="f_input f_wide"></li>
      <li><input placeholder="Новый пароль" type="password" name="password1" class="f_input f_wide"></li>
      <li><input placeholder="Повторите" type="password" name="password2" class="f_input f_wide"></li>
      <li><br /></li>
      <li><textarea name="allowed_ip" rows="2" class="f_textarea f_wide">{allowed-ip}</textarea><br />
        Ваш текущий IP: <b>{ip}</b><br /><div style="color:red;font-size:11px;">* Внимание! Будьте бдительны при изменении данной настройки. Доступ к Вашему аккаунту будет доступен только с того IP-адреса или подсети, который Вы укажете. Вы можете указать несколько IP адресов, по одному адресу на каждую строчку.<br />Пример: 192.48.25.71 или 129.42.*.*</div>
      </li>
      <li><br /></li>
      <li><label for="image">Аватар:</label><input type="file" name="image" class="f_input f_wide"><p><input type="checkbox" name="del_foto" value="yes">  Удалить фотографию</p></li>
      <li><br /></li>
      <li><textarea placeholder="О себе" name="info" rows="2" class="f_textarea f_wide">{editinfo}</textarea></li>
      <li><textarea placeholder="Подпись" name="signature" rows="2" class="f_textarea f_wide">{editsignature}</textarea></li>
    </ul>
    <div class="submitline">
      <button name="submit" class="btn f_wide" type="submit">Сохранить</button>
      <input name="submit" type="hidden" id="submit" value="submit">
    </div>
  </div>
</div>
[/not-logged]