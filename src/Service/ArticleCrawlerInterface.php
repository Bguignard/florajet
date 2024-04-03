<?php

namespace App\Service;

interface ArticleCrawlerInterface
{
    public function getArticles(int $maxArticlesToCrawl, string $url): array;
}