<?php

namespace App\Service;

readonly class ArticlesService implements ArticlesServiceInterface
{

    public function crawlArticles(ArticleCrawlerInterface $articleCrawler, string $url, int $maxArticlesToCrawl): array
    {
        return $articleCrawler->getArticles($maxArticlesToCrawl, $url);
    }

    public function saveArticlesToDataBase(array $articles): void
    {
        // todo : check if articles already exist in the database
        // todo : if not, save them
    }
}