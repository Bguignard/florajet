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
        $language = LanguageEnum::from($rss->channel->language);

        foreach ($rss->channel->item as $item) {
            if(count($articles) >= $maxArticlesToCrawl) {
                break;
            }
            $article = new Article(
                SourceTypeEnum::RSS_FEED,
                $url,
                $language,
                \DateTime::createFromFormat(\DateTimeInterface::RSS, $item->pubDate),
                $item->title,
                $item->description,
                $item?->guid,
                permalink: $item->link,
            );
            $articles[] = $article;
        }

        return $articles;
    }
}