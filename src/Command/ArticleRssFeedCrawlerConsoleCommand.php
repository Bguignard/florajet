<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use App\Service\ArticlesServiceInterface;
use App\Service\RSSFeedArticleCrawler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


#[AsCommand(
    name: 'app:crawl-rss-feed',
    description: 'Crawl RSS feed on given URL to extract Articles and save them to database.',
    aliases: ['app:crawl-rss-feed'],
    hidden: false,
)]
// for example, run bin/console app:crawl-rss-feed https://www.lemonde.fr/rss/une.xml 5
class ArticleRssFeedCrawlerConsoleCommand extends Command
{

    public function __construct(
        private readonly ArticlesServiceInterface $articlesService,
        private readonly RSSFeedArticleCrawler $articleCrawler,
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
        $this->articlesService->saveArticlesToDataBase($articles);
        $output->writeln([
            'Done !',
        ]);
        return Command::SUCCESS;
    }
}