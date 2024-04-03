<?php

namespace App\Service;

class RSSFeedArticleCrawler implements ArticleCrawlerInterface
{

    public function getArticles(int $maxArticlesToCrawl, string $url): array
    {
        $rss = simplexml_load_file($url);
        $nodes = $rss->channel->item;

        // todo : get articles from nodes
        return [];
    }
}