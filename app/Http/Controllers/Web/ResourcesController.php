<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\ResourcesRequest;
use App\Models\Category;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use RealRashid\SweetAlert\Facades\Alert;

class ResourcesController extends BaseController
{

    public function index(Request $request)
    {
        $items = Resource::paginate(10);
        return view("resources.index", compact('items'));
    }

    public function create()
    {

        return view("resources.create", get_defined_vars());
    }

    public function delete()
    {
        return view("resources.index", get_defined_vars());
    }

    public function store(ResourcesRequest $request)
    {
        Resource::create($request->only('name', 'link','api', 'lng', 'has_full_links'));
        Alert::success('Resources created successfully.');
        return redirect()->route('resources.index');


    }

    public function edit(Resource $resource)
    {
        return view('resources.edit', compact('resource'));
    }

    function update(Resource $resource, ResourcesRequest $request)
    {
        $resource->update(['name' => $request->name, 'link' => $request->link, 'lng' => $request->lng, 'has_full_links' => $request->has_full_links]);

        Alert::success('Resources edited successfully.');
        return redirect()->route('resources.index');
    }

    public function destroy(Resource $resource)
    {
        $resource->delete();
        Alert::success('Resources deleted successfully.');
        return redirect()->route('resources.index');
    }

    public function show(Resource $resource)
    {
        return view('resources.show', compact('resource'));

    }

    public function getProperties($id){
        return Resource::where('id', $id)->first();
    }
}
