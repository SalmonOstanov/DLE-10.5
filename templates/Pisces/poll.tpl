	<h4 class="pollhead">{question}</h4>
	{list}
	<br />
	<div class="pollfoot">
	[voted]Всего проголосовало: {votes}[/voted]
	[not-voted]
		<button class="fbutton" type="submit" onclick="doPoll('vote', '{news-id}'); return false;" ><span>Голосовать</span></button>
		<button class="fbutton" type="submit" onclick="doPoll('results', '{news-id}'); return false;"><span>Результаты</span></button>
	[/not-voted]
	</div>