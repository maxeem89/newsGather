<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\NewsRequest;
use App\Models\Category;
use App\Models\News;
use App\Models\Resource;
use Illuminate\Config\Repository;
use Illuminate\Http\Request;
use App\Repositories\NewsRepository;
use Illuminate\View\View;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    protected $repo;
    function __construct()
    {
        $this->client = new Client();
           $this->repo = new NewsRepository();
    }

    public function index(Request $request)
    {
        $items = News::where(function ($query) use($request){
            $query->where('title', 'LIKE', "%{$request->search}%");
        })->orderBy('created_at', 'desc')->orderBy('id', 'desc')->paginate(10);

        return view("news.index", compact('items', 'request'));
    }

    public function create()
    {

        //dd( $all_articles);
        $items = News::get()->pluck('title', 'id');
        $resources = Resource::select('name', 'id')->get()->pluck('name', 'id')->toArray();

        return view("news.create", get_defined_vars());
    }

    public function getCategories(Resource $resource){

           return  $resource->categories->toArray();
    }


    public function delete()
    {
        return view("news.index", get_defined_vars());
    }

    public function store(NewsRequest  $request)
    {

        $this->repo->store($request);

        return redirect()->route('news.index')
            ->withSuccess(__('news created successfully.'));

    }
    public function edit(News $news)
    {
       $resource =  Resource::select('name', 'id')->get()->pluck( 'name', 'id');
       $category = Category::select('name', 'id')->where('resources_id', $news->resources_id)->get()->pluck('name', 'id');

        return view('news.edit', get_defined_vars());
    }

    function update(News $news, NewsRequest $request)
    {
        $news->update(['title' => $request->title, 'body' => $request->body , 'resources_id' => $request->resources_id , 'category_id'=> $request->categories_id]);
        return redirect()->route('news.index');
    }

    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('news.index')
            ->withSuccess(__('news deleted successfully.'));
    }
    public function show(News $news)
    {

        return view("news.show", compact('news'));
    }



}

