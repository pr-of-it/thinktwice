<li class="news-item">

    <div class="news-box">
        <div class="news-tag">#GAZP</div>
        <div class="news-body">
            <header class="news-author"><?php echo $post->blog->title; ?></header>
            <h6><?php echo $post->title; ?></h6>

            <p><?php echo $post->text; ?></p>
            <span class="text-hide"></span>
        </div>
        <div class="news-like">5</div>
        <a href="" class="icon-category"></a>

        <div class="time-slider"></div>
    </div>
    <div style="left:10%" class="time-dott">
        <span><?php echo date("H:i", strtotime($post->time)); ?></span>
    </div>
</li>