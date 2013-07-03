<?php
return array(
    'guest' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Guest',
        'bizRule' => null,
        'data' => null
    ),
    'user' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'User',
        'children' => array(
            'guest', // унаследуемся от гостя
        ),
        'bizRule' => null,
        'data' => null
    ),
    'rss' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Rss',
        'children' => array(
            'user', // унаследуемся от пользователя
        ),
        'bizRule' => null,
        'data' => null
    ),
    'operator' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Operator',
        'children' => array(
            'user',          // позволим оператору всё, что позволено пользователю
        ),
        'bizRule' => null,
        'data' => null
    ),
    'moderator' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Moderator',
        'children' => array(
            'user',          // позволим модератору всё, что позволено пользователю
        ),
        'bizRule' => null,
        'data' => null
    ),
    'expert' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Expert',
        'children' => array(
            'user',          // позволим эксперту всё, что позволено пользователю
        ),
        'bizRule' => null,
        'data' => null
    ),
    'lector' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Lector',
        'children' => array(
            'user',          // позволим лектору всё, что позволено пользователю
        ),
        'bizRule' => null,
        'data' => null
    ),
    'admin' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Administrator',
        'children' => array(
            'operator', 'moderator', 'expert', 'lector',
        ),
        'bizRule' => null,
        'data' => null
    ),
);
