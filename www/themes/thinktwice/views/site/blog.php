<?php $this->pageTitle=Yii::app()->name . ' - Blog';
?>

<h1>Страница блога</h1>
<?php foreach (array_slice($blog->posts,-10,10) as $b ): ?>
    <tr>
        <td><?php echo $b->id; ?></td>
            <td><?php echo $b->title; ?></td>
            <td><?php echo $b->text; ?></td>
            <td><?php echo $b->time; ?></td>
    </tr>

<?php endforeach; ?>


