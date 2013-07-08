<div id="lenta-template" style="display:none">
	<li class="news-item{{extraClass}}">
		<div class="news-box">
			<div class="news-tag">{{tag}}</div>
			{{#image}}
			<div style="background-image: url(/{{image}});" class="image-gallery-min-full">
			</div>
			{{/image}}
			<div class="news-body">
				{{#preview}}<img src="{{preview}}" alt="{{title}}"/>{{/preview}}
				<header class="news-author">{{author}}</header>
				<h6>{{title}}</h6>
				<p>{{text}}</p>
				<span class="text-hide"></span>
			</div>
			<div class="news-like">{{likes}}</div>
			<a href="" class="icon-users"></a>
			<div class="time-slider"></div>
		</div>
		<div class="time-dott">
			<span>{{time}}</span>
		</div>
	</li>
</div>
<div class="step-day ajax-loader">
    <ul class="news-list full-item">
        <li class="ajax-loader-wrap">
            <div>
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/ajax-loader-lenta.gif" alt=""/>
                <span>Возобновить загрузку</span>
            </div>
        </li>
    </ul>
</div>
