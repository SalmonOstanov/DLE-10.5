<div class="basecont">
	<div class="bcomment">
		<div class="lcol">
			<span class="thide arcom">&lt;</span>
			<div class="avatar"><img src="{foto}" alt=""/></div>
			<h5>{author}</h5>
			<p>{date}</p>
		[rating]
		[rating-type-1]<div class="rate">{rating}</div>[/rating-type-1]
		[rating-type-2]<div class="ratebox2">
		<ul class="reset">
			<li>[rating-plus]<img src="{THEME}/images/like.png" title="Нравится" alt="Нравится" style="width:14px;" />[/rating-plus]</li>
			<li>{rating}</li>
		</ul></div>[/rating-type-2]
		[rating-type-3]<div class="ratebox3">
		<ul class="reset">
			<li>[rating-minus]<img src="{THEME}/images/ratingminus.png" title="Не нравится" alt="Не нравится" style="width:14px;" />[/rating-minus]</li>
			<li>{rating}</li>
			<li>[rating-plus]<img src="{THEME}/images/ratingplus.png" title="Нравится" alt="Нравится" style="width:14px;" />[/rating-plus]</li>
		</ul>
		</div>[/rating-type-3]
		[/rating]
		</div>
		<div class="rcol">
			<div class="combox">
				<div class="infbtn">
					<span id="cinfb{comment-id}" class="thide" title="Информация к комментарию">Информация к комментарию</span>
					<div id="cinfc{comment-id}" class="infcont">
						<ul>
							<li><i>Группа: {group-name}</i></li>
							[group=1]<li><i>{ip}</i></li>[/group]
							<li><i>Регистрация: {registration}</i></li>
							<li><i>Статус: [online]<img src="{THEME}/images/online.png" style="vertical-align: middle;" title="Пользователь Онлайн" alt="Пользователь Онлайн" />[/online][offline]<img src="{THEME}/images/offline.png" style="vertical-align: middle;" title="Пользователь offline" alt="Пользователь offline" />[/offline]</i></li>
							<li><i>Публикаций: {news-num}</i></li>
							<li><i>Комментариев: {comm-num}</i></li>
						</ul>
					</div>
				</div>
				[aviable=lastcomments]<h3 style="margin-bottom: 0.4em;">{news_title}</h3>[/aviable]
				{comment}
				[signature]<br clear="all" /><div class="signature">--------------------</div><div class="slink">{signature}</div><br />[/signature]
				<div class="comedit">
					[not-group=5]
					<span class="argreply">[fast]<b>Цитировать</b>[/fast] [reply]<b>Ответить</b>[/reply]</span>
					<span class="arg">[com-del]Удалить[/com-del]</span>
					<span class="arg">[com-edit]Изменить[/com-edit]</span>
					<span class="arg">[complaint]Жалоба[/complaint]</span>
					<span class="arg">[spam]Спам[/spam]</span>
					[group=1]<div class="selectmass">{mass-action}</div>[/group]
					[/not-group]
					<div class="clr"></div>
				</div>
			</div>
		</div>
		<div class="clr"></div>
	</div>
</div>
<script type="text/javascript">
	$("#cinfb{comment-id}").Button("#cinfc{comment-id}");
</script>