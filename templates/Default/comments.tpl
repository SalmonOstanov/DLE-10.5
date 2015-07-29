<div class="bcomment">
	<div class="dtop">
		<div class="lcol"><span><img src="{foto}" alt=""/></span></div>
		<div class="rcol">
			<span class="reply">[fast]<b>Цитата</b>[/fast][reply]<b>Ответить</b>[/reply]</span>
			<ul class="reset">
				<li><h4>{author}</h4></li>
				<li>{date}</li>
			</ul>
			<ul class="cmsep reset">
				<li>Группа: {group-name}</li>
			</ul>
		</div>
		<div class="clr"></div>
	</div>
	<div class="cominfo"><div class="dpad">
		[not-group=5]
		<div class="comedit">
			<div class="selectmass">{mass-action}</div>
			<ul class="reset">
				<li>[spam]Спам[/spam]</li>
				<li>[complaint]Жалоба[/complaint]</li>
				<li>[com-edit]Изменить[/com-edit]</li>
				<li>[com-del]Удалить[/com-del]</li>
			</ul>
		</div>
		[/not-group]
		<ul class="cominfo reset">
			<li>Регистрация: {registration}</li>
			<li>Статус: [online]<img src="{THEME}/images/online.png" style="vertical-align: middle;" title="Пользователь Онлайн" alt="Пользователь Онлайн" />[/online][offline]<img src="{THEME}/images/offline.png" style="vertical-align: middle;" title="Пользователь offline" alt="Пользователь offline" />[/offline]</li>
			<li>{comm-num} [declination={comm-num}]комментари|й|я|ев[/declination]</li>
			<li>{news-num} [declination={news-num}]публикаци|я|и|й[/declination]</li>
		</ul>
	</div>
	<span class="thide">^</span>
	</div>
	<div class="dcont">
		[aviable=lastcomments]<h3 style="margin-bottom: 0.4em;">{news_title}</h3>[/aviable]
		{comment}
		[signature]<br clear="all" /><div class="signature">--------------------</div><div class="slink">{signature}</div>[/signature]
		[rating]
		[rating-type-1]<div class="ratebox"><div class="rate">{rating}</div></div>[/rating-type-1]
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
		<div class="clr"></div>
	</div>
</div>