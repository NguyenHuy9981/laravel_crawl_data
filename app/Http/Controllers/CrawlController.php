<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Weidner\Goutte\GoutteFacade;

class CrawlController extends Controller
{
    public function crawlForm()
    {
        return view('clone');
    }

    public function crawl(Request $request)
    {
        $crawler = GoutteFacade::request('GET', $request['name']);
        $linkPost = $crawler->filter('h2.title-news a')->each(function ($node) {
            return $node->attr("href");
        });

        foreach ($linkPost as $link) {
            $this->scrapeData($link);
        }

        return redirect(route('index'));
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
}
