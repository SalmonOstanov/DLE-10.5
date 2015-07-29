[searchposts]
[fullresult]
<div class="base shortstory">
		<script type="text/javascript">//<![CDATA[
		$(function(){ $("#infb{news-id}").Button("#infc{news-id}"); });
		//]]></script>
		<div class="infbtn">
			<span id="infb{news-id}" class="thide" title="Информация к новости">Информация к новости</span>
			<div id="infc{news-id}" class="infcont">
				<ul>
					<li><i>Просмотров: {views}</i></li>
					<li><i>Автор: {author}</i></li>
					<li><i>Дата: {date}</i></li>
				</ul>
				[edit-date]<div class="editdate"><i>Изменил: <b>{editor}</b>[edit-reason]<br />Причина: {edit-reason}[/edit-reason]</i></div>[/edit-date]
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
		</div>
		<span class="argbox">[day-news]<i>{date}</i>[/day-news]</span>

	<h3 class="btl">[full-link]{title}[/full-link]</h3>
	<p class="argcat"><i>Категория: {link-category}</i></p>
	<div class="maincont">
		{short-story}
		<div class="clr"></div>
		[tags]<p class="basetags"><i>Метки к статье: {tags}</i></p>[/tags]
	</div>
	<div class="mlink">
		<span class="argmore">[full-link]<b>Подробнее</b>[/full-link]</span>
		[not-group=5]<span class="argedit">[edit]<i>Редактировать</i>[/edit]</span>[/not-group]
		<span class="argcoms"><i>Комментариев: [com-link]{comments-num}[/com-link]</i></span>
	</div>
</div>
[/fullresult]
[shortresult]
<div class="searchitem">
	<h3>[full-link]{title}[/full-link]</h3>
	<b>[day-news]{date}[/day-news]</b> | {link-category} | Автор: {author}
</div>
[/shortresult]
[/searchposts]
[searchcomments]
[fullresult]
<div class="basecont">
	<div class="bcomment">
		<div class="lcol">
			<span class="thide arcom">&lt;</span>
			<div class="avatar"><img src="{foto}" alt=""/></div>
			<h5>{author}</h5>
			<p>{date}</p>
		</div>
		<div class="rcol">
			<div class="combox">
				<script type="text/javascript">//<![CDATA[
				$(function(){ $("#cinfb{comment-id}").Button("#cinfc{comment-id}"); });
				//]]></script>
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
					<span class="argreply">[fast]<b>Цитировать</b>[/fast]</span>
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
[/fullresult]
[shortresult]
<div class="searchitem">
	<h3 style="margin-bottom: 0.4em;">{news_title}</h3>
	<b>{date}</b> | Автор: {author}
</div>
[/shortresult]
[/searchcomments]