<?php

namespace App\Repository;

use App\Entity\Article;

interface ArticleRepositoryInterface
{
    public function existsByGuid(string $guid): bool;

    public function save(Article $article): void;
}
