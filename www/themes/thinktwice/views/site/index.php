<h1>Будущая главная страница</h1>

<h3>Список всех пользователей сайта</h3>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'user-grid',
    'dataProvider'=>User::model()->search(),
    'filter'=>$user,
    'columns'=>array(
        'id',
        array(
            'name' => 'Роль',
            'value' => '$data->role->desc',
        ),
        'email',
        'name',
        'phone',
        'active',
        'can_consult',
        'consult_price',
        'avatar',
    ),
)); ?>