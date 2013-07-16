<div id="container">

    <?php if ( Yii::app()->user->isGuest ) : ?>
    <div id="rails" class="page-lenta quick-start">
        <div class="quick-start-box">
            <header>Что такое Лента?</header>
            <div class="video-box">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/video.jpg" alt=""/>
                <div class="close"></div>
            </div>
        </div>
    <?php else: ?>
    <div id="rails" class="page-lenta">
        <?php endif; ?>

        <script id="lenta-template" type="text/html">
            <li class="news-item{{extraClass}}">
                <div class="news-box">
                    <div class="news-tag">{{tag}}</div>
                    {{#image}}
                    <div style="background-image: url(/{{image}});" class="image-gallery-min-full">
                    </div>
                    {{/image}}
                    <div class="news-body">
                        {{#preview}}<img src="{{preview}}" width="180" height="110" alt="{{title}}"/>{{/preview}}
                        {{#media}}<ul class="image-gallery-min">{{/media}}
                        {{#media}}
                            <li><a href=""><img src="{{ url }}" width="21" height="60" alt=""></a></li>
                        {{/media}}
                        {{#media}}</ul>{{/media}}
                        <header class="news-author">{{author}}</header>
                        <h6>{{{title}}}</h6>
                        <div>{{{text}}}</div>
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
        </script>

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

    </div> <!-- /rails -->
</div> <!-- /container -->

<!-- Вывод формы добавления поста -->
<?php if ( !Yii::app()->user->isGuest) : ?>
    <?php $this->renderPartial('//layouts/win8/_post', array(
        'model' => $post,
        'user' => $user,
    )); ?>
<?php endif;?>