<?php
class RssCommand extends CConsoleCommand {

    public function actionImport() {

        $rssStreams = BlogRss::model()->findAll();
        foreach ( $rssStreams as $stream ) {

            echo "RSS stream {$stream->title} (#{$stream->id}) processing start\n";
            $rss = simplexml_load_file($stream->url);

            $title = isset($rss->channel) && isset($rss->channel->title) ? $rss->channel->title : $rss->title;
            echo "RSS recieved. Title is {$title}\n";

            $items = isset($rss->channel) && isset($rss->channel->item) ? $rss->channel->item : $rss->item;
            foreach ( $items as $item ) {
                $this->proceedRssItem($stream->blog->id, $stream->id, $item);
            }

            $rss = null;unset($rss);
            echo "RSS stream {$stream->title} (#{$stream->id}) processing finish\n";

        }
    }

    protected  function proceedRssItem($blog_id, $rss_id, $item) {

        $guid = isset($item->guid) ? $item->guid : md5($item->pubDate);

        $rssPost = BlogPost::model()->findByAttributes(array(
            'blog_id' => $blog_id,
            'rss_id' => $rss_id,
            'rss_guid' => $guid,
        ));

        if ( null !== $rssPost ) {
            return false;
        }

        $post = new BlogPost();
        $post->blog_id = $blog_id;
        $post->title = $item->title;

        if (  strip_tags($item->description) == '' ) {
            $text = strip_tags($item->title);
        } else {
            $text = strip_tags($item->description, "<br><b><strong><i><quote>");
        }
        $post->text = $text;

        $post->rss_id = $rss_id;
        $post->rss_guid = $guid;

        return true;

    }

}
