<?php

namespace App\Console\Commands;

use App\Post;
use App\Scraper\TGDD;
use Illuminate\Console\Command;
use Weidner\Goutte\GoutteFacade;

class ScrapeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $crawler = GoutteFacade::request('GET', 'https://vnexpress.net/suc-khoe/dinh-duong');
        $linkPost = $crawler->filter('h2.title-news a')->each(function ($node) {
            return $node->attr("href");
        });

        foreach ($linkPost as $link) {
            $this->scrapeData($link);
        }
    }

    public function scrapeData($url)
    {
        $crawler = GoutteFacade::request('GET', $url);

        $title = $this->crawlData('h1.title-detail', $crawler);

        $description = $this->crawlData('article.fck_detail', $crawler);

        $content = $this->crawlData('p.description', $crawler);

        $image = $this->crawlImage('div.fig-picture img', $crawler);

        $dataPost = [
            'title' => $title,
            'content' => $content,
            'description' => $description,
            'image' => $image
        ];

        Post::create($dataPost);
    }

    protected function crawlData(string $type, $crawler)
    {
        $result = $crawler->filter($type)->each(function ($node) {
            return $node->text();
        });

        if (!empty($result)) {
            return $result[0];
        }

        return '';
    }

    public function crawlImage(string $type, $crawler)
    {
        $result = $crawler->filter($type)->each(function ($node) {
            return $node->attr('data-src');
        });

        if (!empty($result)) {
            return $result[0];
        }
        return '';
    }
}
