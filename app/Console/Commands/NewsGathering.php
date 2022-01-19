<?php

namespace App\Console\Commands;

use App\Http\Requests\NewsRequest;
use App\Models\Resource;
use App\Repositories\NewsRepository;
use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\Stream;
use function PHPUnit\Framework\isNull;

include('simple_html_dom.php');

class NewsGathering extends Command
{
    private $repo, $request /*$client*/
    ;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:gathering {resource_id?}';

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
        $this->repo = new NewsRepository();
        $this->request = new NewsRequest();
        $this->client = new Client();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if($this->argument("resource_id")) {
            $resources = Resource::where('id', $this->argument("resource_id"))->get();
        }else {
            $resources = Resource::get();
        }
        $tempLinks = [];
        foreach ($resources as $resource) {
            if ($resource->api == 0) {
                foreach ($resource->categories as $category) {
                    $html = file_get_html($resource['link'] . $category['sub_link']);
                    $regex = $category['regex'];
                    foreach ($html->find($category['target_element']) as $element) {
                        if (preg_match($regex, $element->href)) {
                            $tempLinks[] = $element->href;
                        }
                    }
                    foreach ($tempLinks as $element) {
                        $titleText = '0';
                        $bodyText = '<div class="row">';
                        if($resource->has_full_links == 0) {
                            $html_news = file_get_html($resource['link'] . $this->str_replace_first('/', '', $element));

                        }else {
                            $html_news = file_get_html($element);

                        }
                        foreach ($html_news->find($category['target_news_title']) as $title) {
                            $titleText = $title->text();
                        }
                        foreach ($html_news->find($category['target_news_body']) as $body) {
                            if($resource->lng == 'ar') {
                                $bodyText .= "<p style='direction: rtl;'>" . $body->text() . '</p>';
                            } else{
                                $bodyText .= "<p>" . $body->text() . '</p>';
                            }

                        }
                        $bodyText .= "</div>";
                        if ($bodyText != null && $titleText != 0) {
                            if (!$this->repo->ValidateExist(['url' => $element, 'title' => $titleText])) {
                                $this->request->method('POST');
                                $this->request['path_url'] = $element;
                                $this->request['title'] = $titleText;
                                $this->request['body'] = $bodyText;
                                $this->request['categories_id'] = $category['id'];
                                $this->request['resources_id'] = $resource['id'];
                                $this->repo->store($this->request->all());
                            }
                        }
                    }
                }
            }
            else {
                foreach ($resource->categories as $category) {
                    try {
                        $response = $this->client->request('get', 'https://newsapi.org/v2/everything?q=' . $category['name'] . '&apiKey='.env('NEWS_API_KEY').'&sources=' . $resource->name);
                        if ($response->getStatusCode() == 200) {
                            $all_articles = json_decode($response->getBody()->getContents());
                            if ($all_articles->status == 'ok') {
                                foreach ($all_articles->articles as $key => $article) {
                                    $this->info("Before Validation Check ...");
                                    if (!$this->repo->ValidateApiExist(['resource_id' => $resource['id'], 'category_id' => $category['id'], 'title' => $article->title])) {

                                        $this->request->method('POST');
                                        $this->request['title'] = $article->title;
                                        $this->request['body'] = $article->content;
                                        $this->request['categories_id'] = $category['id'];
                                        $this->request['resources_id'] = $resource['id'];
                                        $this->repo->store($this->request->all());
                                    }
                                }
                            }
                        }
                    } catch (\Exception $ex) {
                        $this->warn("Error -- ".$ex->getMessage());
                    }
                }
            }
        }
    }

    function str_replace_first($search, $replace, $subject)
    {
        $search = '/' . preg_quote($search, '/') . '/';
        return preg_replace($search, $replace, $subject, 1);
    }
}
