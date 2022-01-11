<?php

namespace App\Http\Controllers\Web;
use App\Http\Requests\CategoriesRequest;
use App\Models\Category;
use App\Models\Resource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{

    public function index(Request $request)
    {
        $items = Category::paginate(10);
       return view("categories.index", compact('items'));

    }

    public function create()
    {
        $resources = Resource::get()->pluck('name', 'id');

        return view("categories.create", get_defined_vars());
    }

    public function delete()
    {
        return view("categories.index", get_defined_vars());
    }

    public function store(CategoriesRequest $request)
    {

        Category::create($request->except('_token', 'api'));

        return redirect()->route('categories.index')
            ->withSuccess(__('categories created successfully.'));

    }
    public function edit(Category $category)
    {
        $resources = Resource::get()->pluck('name', 'id');
        return view('categories.edit', get_defined_vars());
    }

    function update(Category $category, CategoriesRequest $request)
    {
        $category->update($request->except('api', 'id', '_token'));
        return redirect()->route('categories.index');
    }

    public function destroy(category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')
            ->withSuccess(__('categories deleted successfully.'));
    }
    public function show(Category $category)
    {

        return view("categories.show", compact('category'));
    }

}

