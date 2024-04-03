<?php

namespace App\Service;

interface ArticlesServiceInterface
{
    public function crawlArticles(ArticleCrawlerInterface $articleCrawler, string $url, int $maxArticlesToCrawl): array;
    public function saveArticlesToDataBase(array $articles): void;
}