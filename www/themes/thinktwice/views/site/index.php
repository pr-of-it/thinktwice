<?php $counter = 0; ?>
<?php foreach ( $dataProvider->getData() as $post ) : ?>

    <?php if ( $counter == 0 && !empty($post->image) ): ?>
        <ul class="news-list full-item">
    <?php elseif ($counter == 0) : ?>
        <ul class="news-list">
    <?php endif; ?>

    <li class="news-item">
        <?php if ( $counter == 0 && !empty($post->image) ): ?>
            <?php
            $this->renderPartial('_index_post_full', array('post' => $post));
            $counter = 1;
            ?>
        <?php else: ?>
            <?php
            $this->renderPartial('_index_post', array('post' => $post));
            ?>
        <?php endif; ?>
    </li>

    <?php if ( $counter == 1 ): ?></ul><?php endif; ?>

    <?php $counter = ++$counter % 2 ; ?>

<?php endforeach; ?>

<ul class="news-list empty"></ul>
