<div class="pheading"><h2>Добавить новость</h2></div>
<div class="baseform">	
	<table class="tableform">
		<tr>
			<td class="label">
				Заголовок:<span class="impot">*</span>
			</td>
			<td><input type="text" id="title" name="title" value="{title}" maxlength="150" class="f_input" />&nbsp;<input class="bbcodes" style="height: 22px; font-size: 11px;" title="Найти похожие новости" onclick="find_relates(); return false;" type="button" value="Найти похожие" /><span id="related_news"></span></td>
		</tr>
	[urltag]
		<tr>
			<td class="label">URL статьи:</td>
			<td><input type="text" name="alt_name" value="{alt-name}" maxlength="150" class="f_input" /></td>
		</tr>
	[/urltag]
		<tr>
			<td class="label">
				Категория:<span class="impot">*</span>
			</td>
			<td>{category}</td>
		</tr>
		<tr>
			<td class="label">&nbsp;</td>
			<td><a href="#" onclick="$('.addvote').toggle();return false;">Добавить опрос</a></td>
		</tr>
		<tr  class="addvote" style="display:none;" >
			<td class="label">Заголовок опроса:</td>
			<td><input type="text" name="vote_title" value="{votetitle}" maxlength="150" class="f_input" /></td>
		</tr>
		<tr  class="addvote" style="display:none;" >
			<td class="label">Вопрос:</td>
			<td><input type="text" name="frage" value="{frage}" maxlength="150" class="f_input" /></td>
		</tr>
		<tr  class="addvote" style="display:none;" >
			<td class="label">Варианты ответов:<br /><br />Каждая новая строка является новым вариантом ответа</td>
			<td><textarea name="vote_body" rows="10" class="f_textarea" >{votebody}</textarea><br /><input type="checkbox" name="allow_m_vote" value="1" {allowmvote}> Разрешить выбор нескольких вариантов</td>
		</tr>
		<tr>
			<td colspan="2">
				<b>Вводная часть: <span class="impot">*</span></b> (Обязательно)
				[not-wysywyg]
				<div class="bb-editor">
					{bbcode}
					<textarea name="short_story" id="short_story" onfocus="setFieldName(this.name)" rows="15" >{short-story}</textarea>
				</div>
				[/not-wysywyg]
				{shortarea}
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<b>Подробная часть:</b> (Необязательно)
				[not-wysywyg]
				<div class="bb-editor">
					{bbcode}
					<textarea name="full_story" id="full_story" onfocus="setFieldName(this.name)" rows="20" >{full-story}</textarea>
				</div>
				[/not-wysywyg]
				{fullarea}
			</td>
		</tr>
		{xfields}
		<tr>
			<td class="label">Ключевые слова для облака тегов:</td>
			<td><input type="text" name="tags" id="tags" value="{tags}" maxlength="150"  class="f_input" autocomplete="off" /></td>
		</tr>
		[question]
		<tr>
			<td class="label">
				Вопрос:
			</td>
			<td>
				<div>{question}</div>
			</td>
		</tr>
		<tr>
			<td class="label">
				Ответ:<span class="impot">*</span>
			</td>
			<td>
				<div><input type="text" name="question_answer" class="f_input" /></div>
			</td>
		</tr>
		[/question]
		[sec_code]
		<tr>
			<td class="label">
				Введите код<br />с картинки:<span class="impot">*</span>
			</td>
			<td>
				<div>{sec_code}</div>
				<div><input type="text" name="sec_code" id="sec_code" style="width:154px" class="f_input" /></div>
			</td>
		</tr>
		[/sec_code]
		[recaptcha]
		<tr>
			<td class="label">
				Подтвердите что вы не робот:<span class="impot">*</span>
			</td>
			<td>
				<div>{recaptcha}</div>
			</td>
		</tr>
		[/recaptcha]
		<tr>
			<td colspan="2">{admintag}</td>
		</tr>
	</table>
	<div class="fieldsubmit">
		<button name="add" class="fbutton" type="submit"><span>Отправить</span></button>
		<button name="nview" onclick="preview()" class="fbutton" type="submit"><span>Просмотр</span></button>
	</div>
</div>