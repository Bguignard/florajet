<?php

namespace App\Service;

use App\Entity\Article;
use App\Entity\Enum\LanguageEnum;
use App\Entity\Enum\SourceTypeEnum;

class APIArticleCrawler implements ArticleCrawlerInterface
{

    public function getArticles(int $maxArticlesToCrawl, string $url): array
    {
        $articles = [];
        $language = LanguageEnum::EN;

        foreach (json_decode(file_get_contents($url)) as $item) {
            if(count($articles) >= $maxArticlesToCrawl) {
                break;
            }
            $article = new Article(
                SourceTypeEnum::EXTERNAL_API,
                $item->newsSite,
                $url,
                $language,
                new \DateTime($item->publishedAt), //2024-03-15T11:00:22.000Z
                $item->title,
                $item->summary,
                $item->id?? null,
                permalink: $item->url,
                mediaUrl: $item->imageUrl,
            );
            $articles[] = $article;
        }
        return $articles;
    }
}