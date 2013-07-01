<div>
    <h4><?php echo $post->title ;?></h4>
</div>
<div>
    <?php echo $post->text;?>
</div>
<div>
    <?php echo strstr($post->time,'.',true)?>
</div>
<br>
