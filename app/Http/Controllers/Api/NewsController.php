<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\UserSettingRequest;
use App\Models\Category;
use App\Models\News;
use App\Models\Resource;
use App\Models\UserSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Element;

class NewsController extends Controller
{
    public function showPublicNews($id)
    {
        $news = News::where('id', $id)->first();
        if ($news->category->resources->has_full_links == 0 && $news->path_url != null) {
            $news_path = $this->str_replace_first('/', '', $news->path_url);
        }
        $resources = $this->Resources();
        return view('api.news.show', get_defined_vars());
    }

    public function showResourcesList($id)
    {
        $resourcesCustom = Resource::where('id', $id)->first();
        $resources = $this->Resources();
        return view('api.news.resourceslist', get_defined_vars());
    }

    public function showCategoryList($id)
    {
        $categories = Category::where('id', $id)->first();
        $resources = $this->Resources();
        return view('api.news.categorieslist', get_defined_vars());
    }

    public function showNewsList()
    {
        $resources = $this->Resources();
        if (Auth::user()) {
            $count = UserSetting::where('user_id', Auth::user()->id)->count();
            if ($count != 0) {
                $categoryList = UserSetting::where('user_id', Auth::user()->id)->pluck('category_id')->toArray();
                $resources = $this->resourcesHas($categoryList);
            }
            return view('api.news.list', get_defined_vars());
        } else {
            return view('api.news.list', get_defined_vars());
        }
    }

    public function showCustomList()
    {
        $resources = $this->Resources();
        $count = UserSetting::where('user_id', Auth::user()->id)->count();
        $all = false;
        $categoryList = [];
        if (!$count) {
            $all = true;
        } else {
            $categoryList = UserSetting::where('user_id', Auth::user()->id)->pluck('user_id', 'category_id')->toArray();
        }
        return view('api.news.listCustom', get_defined_vars());
    }

    public function storeCustomList(UserSettingRequest $request)
    {
        $resources = $this->Resources();
        $categories = Category::whereIn('id', $request->category_id)->get();
        UserSetting::where('user_id', Auth::user()->id)->delete();
        $countCategories = Category::count();
        if ($countCategories != $categories->count()) {
            foreach ($categories as $category) {
                UserSetting::updateOrCreate(['user_id' => Auth::user()->id, 'category_id' => $category->id],
                    [
                        'user_id' => Auth::user()->id,
                        'category_id' => $category->id,
                        'resource_id' => $category->resources->id,
                    ]);
            }
        }
        return redirect()->back()->with(compact('resources'));

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

    function Resources()
    {
        $resources = Resource::get();
        return $resources;
    }

    function resourcesHas($categories)
    {
        $resources = Resource::whereHas('categories', function ($query) use ($categories) {
            $query->whereIn('id', $categories);
        })->get();
        foreach ($resources as $key => $resource) {
            foreach ($resource->categories as $key1 => $value) {
                if (!in_array($value['id'], $categories)) {
                    unset($resources[$key]->categories[$key1]);
                }
            }
        }
        return $resources;
    }
}
