<ul class="news-list">
<?php foreach ( $dataProvider->getData() as $post ) : ?>
    <?php $this->renderPartial( '_blog', array('post'=>$post) ); ?>
<?php endforeach; ?>
</ul>