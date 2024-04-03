<?php

namespace App\Command;

use App\Service\APIArticleCrawler;
use Symfony\Component\Console\Attribute\AsCommand;
use App\Service\ArticlesServiceInterface;
use App\Service\RSSFeedArticleCrawler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


#[AsCommand(
    name: 'app:crawl-api',
    description: 'Crawl API on given URL to extract Articles and save them to database.',
    aliases: ['app:crawl-api'],
    hidden: false,
)]
// for example, run bin/console app:crawl-api https://api.spaceflightnewsapi.net/v3/articles 5
class ArticleAPICrawlerConsoleCommand extends Command
{

    public function __construct(
        private readonly ArticlesServiceInterface $articlesService,
        private readonly APIArticleCrawler $articleCrawler,
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('url', InputArgument::REQUIRED, 'Url to crawl.')
            ->addArgument('max', InputArgument::REQUIRED, 'Maximum of articles to crawl.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'Getting articles from RSS feed crawler ...',
        ]);
        $articles = $this->articlesService->crawlArticles($this->articleCrawler, $input->getArgument('url'), $input->getArgument('max'));

        $output->writeln([
            strval(count($articles)) . ' articles found !',
            'Saving into database ...',
        ]);
        $savedArticles = $this->articlesService->saveArticlesToDataBase($articles);
        $output->writeln([
            strval($savedArticles) . ' New articles saved !',
        ]);
        $output->writeln([
            'Done !',
        ]);
        return Command::SUCCESS;
    }
}