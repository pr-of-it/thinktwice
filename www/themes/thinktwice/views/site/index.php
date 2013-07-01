<h3>Последние записи в блогах</h3>
<?php foreach ( $dataProvider->getData() as $post ) : ?>
    <?php $this->renderPartial( '_blog', array('post'=>$post) ); ?>
<?php endforeach; ?>