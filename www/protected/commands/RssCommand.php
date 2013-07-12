<?php
class RssCommand extends CConsoleCommand {

    protected $_config;

    public function init() {
        $this->_config = include(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'rss.rules.php');
    }

    public function actionImport() {

        $rssStreams = BlogRss::model()->findAll();
        foreach ( $rssStreams as $stream ) {

            if ( !$stream->active )
                continue;

            // Получаем ленту в виде текста
            echo "RSS stream {$stream->title} (#{$stream->id}) processing start\n";
            $rssXML = file_get_contents($stream->url);

            // Применяем обработчик, если он есть
            if ( isset($this->_config['rules'][$stream->url]) ) {
                $rule = $this->_config['rules'][$stream->url];
                $rssXML = $rule($rssXML);
            }

            // Превращаем в SimpleXML
            $rss = simplexml_load_string($rssXML);

            $title = isset($rss->channel) && isset($rss->channel->title) ? $rss->channel->title : $rss->title;
            echo "RSS recieved. Title is {$title}\n";

            $rssItems = ( isset($rss->channel) && isset($rss->channel->item) ? $rss->channel->item : $rss->item );

            $items = array();
            foreach ( $rssItems as $item ) {
                $items[] = $item;
            }
            uasort($items, function($a, $b) {
                if ( $a->pubDate == $b->pubDate )
                    return 0;
                if ( strtotime($a->pubDate) < strtotime($b->pubDate) )
                    return 1;
                return -1;
            });

            $processedCount = 0;
            foreach ( $items as $item ) {

                if ( $this->proceedRssItem($stream->blog->id, $stream->id, $item) ) {
                    $processedCount++;
                };

            }
            echo "{$processedCount} items added\n";

            $rss = null;unset($rss);
            $items = null; unset($items);
            echo "RSS stream {$stream->title} (#{$stream->id}) processing finish\n";

        }
    }

    protected  function proceedRssItem($blog_id, $rss_id, $item) {

        // Ищем такую же запись в базе. Если есть - возврат

        $guid = isset($item->guid) ? $item->guid : md5($item->pubDate);

        $rssPost = BlogPost::model()->findByAttributes(array(
            'blog_id' => $blog_id,
            'rss_id' => $rss_id,
            'rss_guid' => $guid,
        ));

        if ( null !== $rssPost ) {
            return false;
        }

        // Создаем новую запись
        $post = new BlogPost();
        $post->blog_id = $blog_id;
        $post->title = $item->title;

        if (  strip_tags($item->description) == '' ) {
            $text = strip_tags($item->title);
        } else {
            $text = strip_tags($item->description, "<br><b><strong><i><quote>");
            if ( isset($item->text) ) {
                $text .= '<br />' . $item->text;
            }
        }
        $post->text = $text;

        $post->rss_id = $rss_id;
        $post->rss_guid = $guid;

        // Обработка главного изображения поста. Ожидаем его в теге <image>
        if ( isset($item->image) ) {

            $imageUrl = $item->image['url'];

            $imageExtension = pathinfo( parse_url($imageUrl, PHP_URL_PATH), PATHINFO_EXTENSION );
            $imageFileName = md5($imageUrl) . '_' . time();
            $imageFileDirBase = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..') . DIRECTORY_SEPARATOR;
            $imageFileDir = 'upload' . DIRECTORY_SEPARATOR . 'rss' . DIRECTORY_SEPARATOR . substr($imageFileName, 0, 2);

            if ( false !== ($imageStr = @file_get_contents($imageUrl))  ) {

                @mkdir($imageFileDirBase . $imageFileDir, 0777, true);
                $file = fopen( $imageFileDirBase . $imageFileDir . DIRECTORY_SEPARATOR . $imageFileName . '.' . $imageExtension, 'w' );
                fwrite($file, $imageStr);
                fclose($file);

                $post->image = str_replace('\\', '/', $imageFileDir) . '/' . $imageFileName . '.' . $imageExtension;

            }

        }

        if ( !$post->save() )
            return false;

        $post->time = date('Y-m-d H:i:s',strtotime($item->pubDate));
        return $post->saveAttributes(array('time'));

    }

}
