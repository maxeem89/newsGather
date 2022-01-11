<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Models\Resource;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function showPublicNews($id){
        $news = News::where('id', $id)->first();

        return view('api.news.show',get_defined_vars());
    }
    public function showResourcesList($id){
        $resources = Resource::where('id',$id)->first();
        return view('api.news.resourceslist',get_defined_vars());
    }
    public function showCategoryList($id){
        $categories = Category::where('id',$id)->first();

        return view('api.news.categorieslist',get_defined_vars());
    }

    public function showNewsList(){
        $resources = Resource::get();

        return view('api.news.list',get_defined_vars());
    }
    public  function login(){
        return view('api.auth.login');
    }

}
