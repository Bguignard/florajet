<?php

namespace App\Service;

use App\Entity\Article;
use App\Entity\Enum\LanguageEnum;
use App\Entity\Enum\SourceTypeEnum;

class RSSFeedArticleCrawler implements ArticleCrawlerInterface
{

    public function getArticles(int $maxArticlesToCrawl, string $url): array
    {
        $articles = [];
        $rss = simplexml_load_file($url);

        foreach ($rss->channel->item as $item) {
            $article = new Article(
                SourceTypeEnum::RSS_FEED->value,
                $item->link,
                LanguageEnum::FR->value,
                new \DateTime($item->pubDate),
                $item->title,
                $item->description,
                $item?->guid,
            );
            $articles[] = $article;
        }

        return $articles;
    }
}