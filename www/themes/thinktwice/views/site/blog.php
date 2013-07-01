<?php $this->pageTitle=Yii::app()->name . ' - Blog';
?>

<h1>Страница блога</h1>
<?php foreach ( $blog->posts as $post ) : ?>
<?php $this->renderPartial('_post', array('post'=>$post)); ?>
<?php endforeach; ?>



