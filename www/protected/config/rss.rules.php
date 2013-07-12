<?php
return array(

    'rules' => array(

        // Ведомости. Финансы.
        'http://www.vedomosti.ru/rss/themes/finance.xml' => function ($xml) {
            $xml = str_replace("media:content", "image", $xml);
            $xml = str_replace("_news_pic_top_80.jpg", "_news_bigpic.jpg", $xml);
            return $xml;
        },

        // Ведомости. Компании.
        'http://www.vedomosti.ru/rss/themes/companies.xml' => function ($xml) {
            $xml = str_replace("media:content", "image", $xml);
            $xml = str_replace("_news_pic_top_80.jpg", "_news_bigpic.jpg", $xml);
            return $xml;
        },

        'http://www.2stocks.ru/main/rss.xml' => function ($xml) {
            $xml = str_replace("enclosure", "image", $xml);
            $xml = str_replace("yandex:full-text", "text", $xml);
            return $xml;
        },

        'http://static.feed.rbc.ru/rbc/internal/rss.rbc.ru/rbc.ru/economics.rss' => function ($xml) {
            $xml = str_replace("enclosure", "image", $xml);
            return $xml;
        },

        'http://static.feed.rbc.ru/rbc/internal/rss.rbc.ru/rbcdaily.ru/finance_news.rss' => function ($xml) {
            $xml = str_replace("enclosure", "image", $xml);
            return $xml;
        },

        'http://static.feed.rbc.ru/rbc/internal/rss.rbc.ru/rbcdaily.ru/industry_news.rss' => function ($xml) {
            $xml = str_replace("enclosure", "image", $xml);
            return $xml;
        },

    )
);