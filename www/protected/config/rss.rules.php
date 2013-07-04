<?php
return array(

    'rules' => array(

        // Ведомости. Финансы.
        'http://www.vedomosti.ru/rss/themes/finance.xml' => function ($xml) {
            $xml = str_replace("media:content", "image", $xml);
            $xml = str_replace("_news_pic_top_80.jpg", "_news_bigpic.jpg", $xml);
            return $xml;
        },

    )
);