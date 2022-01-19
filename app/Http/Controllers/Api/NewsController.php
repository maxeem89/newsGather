<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Models\Resource;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function showPublicNews($id)
    {
        $news = News::where('id', $id)->first();
        if ($news->category->resources->has_full_links == 0 && $news->path_url != null) {
            $news_path = $this->str_replace_first('/', '', $news->path_url);
        }
        $resources= $this->Resources();
        return view('api.news.show', get_defined_vars());
    }

    public function showResourcesList($id)
    {
        $resourcesCustom = Resource::where('id', $id)->first();
        $resources=$this->Resources();
        return view('api.news.resourceslist', get_defined_vars());
    }

    public function showCategoryList($id)
    {
        $categories = Category::where('id', $id)->first();
        $resources=$this->Resources();
        return view('api.news.categorieslist', get_defined_vars());
    }

    public function showNewsList()
    {
       $resources= $this->Resources();
        return view('api.news.list', get_defined_vars());
    }

    public function login()
    {

        return view('api.auth.login');
    }

    function str_replace_first($search, $replace, $subject)
    {
        $search = '/' . preg_quote($search, '/') . '/';
        return preg_replace($search, $replace, $subject, 1);
    }
    function Resources(){
        $resources=Resource::get();
        return $resources;
    }
}
