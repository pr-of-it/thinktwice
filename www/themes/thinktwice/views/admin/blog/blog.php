<?php $this->pageTitle=Yii::app()->name . ' - Blog';
?>

<h1>Страница блога</h1>

<?php foreach ( $dataProvider->getData() as $post ) : ?>
    <?php $this->renderPartial('_post', array('post'=>$post)); ?>
<?php endforeach; ?>
<?php $this->widget('CLinkPager', array(
    'pages' => $dataProvider->pagination,
))?>