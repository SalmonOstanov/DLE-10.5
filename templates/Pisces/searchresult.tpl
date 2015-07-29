[searchposts]
[fullresult]
<div class="base shortstory">
	<div class="dpad">
		<h3 class="btl">[full-link]{title}[/full-link]</h3>
		<p class="binfo small">Автор: {author} от [day-news]{date}[/day-news], посмотрело: {views}</p>
		<div class="maincont">
			<span class="argcoms">[com-link]<b>{comments-num}</b>[/com-link]</span>
			{short-story}
			<div class="clr"></div>
		</div>
		[edit-date]<p class="editdate small"><i>Изменил: <b>{editor}</b>[edit-reason] по причине: {edit-reason}[/edit-reason]</i></p>[/edit-date]
		<div class="mlink"><div class="mlink">
			<span class="argmore">[full-link]<b>Подробнее</b>[/full-link]</span>
			[not-group=5]
			<ul class="isicons reset">
				<li>[edit]<img src="{THEME}/dleimages/editstore.png" title="Редактировать" alt="Редактировать" />[/edit]</li>
				<li>{favorites}</li>
			</ul>
			[/not-group]
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
		</div></div>
		<p class="argcat small">Категория: {link-category}</p>
	</div>
</div>
<div class="bsep">&nbsp;</div>
[/fullresult]
[shortresult]
<div class="dpad searchitem">
	<h3>[full-link]{title}[/full-link]</h3>
	<b>[day-news]{date}[/day-news]</b> | {link-category} | Автор: {author}
</div>
[/shortresult]
[/searchposts]
[searchcomments]
[fullresult]
	<div class="bcomment">
		<div class="lcol">
			<span class="thide arcom">&lt;</span>
			<div class="avatar">
				<img src="{foto}" alt=""/>
				{group-icon}
			</div>
			<ul class="small reset">
				<li>{comm-num} [declination={comm-num}]комментари|й|я|ев[/declination]</li>
				<li>{news-num} [declination={news-num}]публикаци|я|и|й[/declination]</li>
				[group=1]<li>{ip}</li>[/group]
			</ul>
		</div>
		<div class="rcol">
			<div class="dpad dtop ignore-select">
				<span>{date}</span>
				<h3>{author}</h3>
			</div>
			<div class="dpad cominfo">
				<span class="argreply">[fast]<b>Цитата</b>[/fast]</span>
				<ul class="reset small">
					<li>Группа: {group-name}</li>
					<li>Регистрация: {registration}</li>
					<li>Статус: [online]<img src="{THEME}/images/online.png" style="vertical-align: middle;" title="Пользователь Онлайн" alt="Пользователь Онлайн" />[/online][offline]<img src="{THEME}/images/offline.png" style="vertical-align: middle;" title="Пользователь offline" alt="Пользователь offline" />[/offline]</li>
				</ul>
				<span class="dleft">&nbsp;</span>
			</div>
			<div class="dpad dcont">
				[aviable=lastcomments]<h3 style="margin-bottom: 0.4em;">{news_title}</h3>[/aviable]
				{comment}
				<br clear="all" />
				[signature]<div class="signature">--------------------</div><div class="slink">{signature}</div><br />[/signature]
			</div>
			[not-group=5]
			<div class="dpad comedit">
				<ul class="reset small">
					<li>[spam]Спам[/spam]</li>
					<li>[complaint]Жалоба[/complaint]</li>
					<li>[com-edit]Изменить[/com-edit]</li>
					<li>[com-del]Удалить[/com-del]</li>
					[group=1]<li class="selectmass">{mass-action}</li>[/group]
				</ul>
			</div>
			[/not-group]					
		</div>
		<div class="clr"></div>
	</div>
[/fullresult]
[shortresult]
<div class="dpad searchitem">
	<h3 style="margin-bottom: 0.4em;">{news_title}</h3>
	<b>{date}</b> | Автор: {author}
</div>
[/shortresult]
[/searchcomments]