<div class="news-box">
    <div class="news-tag">Новости</div>
    <!-- Если картинка задана через CSS то она будет автоматически маштабироваться -->
    <div style="background-image: url(<?php echo Yii::app()->easyImage->thumbSrcOf($post->image, array('resize'=>array('width'=>560), 'crop'=>array('width'=>560, 'height'=>245))); ?>);" class="image-gallery-min-full"></div>
    <div class="news-body">
        <!--
        <ul class="image-gallery-min">
            <li><a href=""><img src="img/tmp/gallery-image.png" alt=""/></a></li>
            <li><a href=""><img src="img/tmp/gallery-image.png" alt=""/></a></li>
            <li><a href=""><img src="img/tmp/gallery-image.png" alt=""/></a></li>
            <li><a href=""><img src="img/tmp/gallery-image.png" alt=""/></a></li>
        </ul>
        -->
        <div class="time-create"><?php echo date("H:i", strtotime($post->time)); ?></div>
        <header class="news-author"><?php echo $post->blog->title; ?></header>
        <h6><?php echo $post->title; ?></h6>
        <p><?php echo $post->text; ?></p>
        <span class="text-hide"></span>
    </div>
    <div class="news-like">5</div>
    <a href="" class="icon-category"></a>
</div>
<div class="time-dott"></div>
