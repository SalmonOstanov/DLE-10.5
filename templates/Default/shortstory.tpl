<div class="base shortstory">
	<div class="dpad">
		<h3 class="btl">[full-link]{title}[/full-link]</h3>
		<div class="bhinfo">
		[not-group=5]
			<ul class="isicons reset">
				<li>[edit]<img src="{THEME}/dleimages/editstore.png" title="Редактировать" alt="Редактировать" />[/edit]</li>
				<li>{favorites}</li>
			</ul>
		[/not-group]
			<span class="baseinfo radial">
				Автор: {author} от [day-news]{date}[/day-news]
			</span>
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
		</div>
		<div class="maincont">
			{short-story}
			<div class="clr"></div>
			[edit-date]<p class="editdate"><br /><i>Новость отредактировал: <b>{editor}</b> - {edit-date}
			<br />[edit-reason]Причина: {edit-reason}[/edit-reason]</i></p>[/edit-date]
		</div>
	</div>
	<div class="mlink">
		<span class="argmore">[full-link]<b>Подробнее</b>[/full-link]</span>
		<span class="argviews"><span title="Просмотров: {views}"><b>{views}</b></span></span>
		<span class="argcoms">[com-link]<span title="Комментариев: {comments-num}"><b>{comments-num}</b></span>[/com-link]</span>
		<div class="mlarrow">&nbsp;</div>
		<p class="lcol argcat">Категория: {link-category}</p>
	</div>
</div>