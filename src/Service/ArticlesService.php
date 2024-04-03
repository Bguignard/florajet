<?php

namespace App\Service;

use App\Entity\Article;
use App\Repository\ArticleRepositoryInterface;

readonly class ArticlesService implements ArticlesServiceInterface
{

    public function __construct(
        private ArticleRepositoryInterface $articleRepository,
    )
    {
    }

    public function crawlArticles(ArticleCrawlerInterface $articleCrawler, string $url, int $maxArticlesToCrawl): array
    {
        return $articleCrawler->getArticles($maxArticlesToCrawl, $url);
    }

    /**
     * @param Article[] $articles
     */
    public function saveArticlesToDataBase(array $articles): int
    {
        $savedArticles = 0;
        foreach ($articles as $article) {
            if(!$this->articleRepository->existsByGuid($article->getGuid())) {
                $this->articleRepository->save($article);
                $savedArticles++;
            }
        }
        return $savedArticles;
    }
}