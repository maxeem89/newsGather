@extends('layouts.app-master')

@section('content')

    <span class="bg-light p-4 rounded">
        <h1>Categories
        </h1>
        <div class="lead">
            <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm float-right">Add new Categories</a>
        </div>
        <div class="mt-2">
            @include('layouts.partials.messages')
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Resources</th>
                <th>Name</th>
                <th>Sub_Link</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

            @foreach($items as $key => $item)
                <tr>
                    <td>{{$item['id']}}</td>
                    <td>{{$item->resources->name}}</td>
                    <td>{{$item['name']}}</td>
                    <td>{{$item['sub_link']}}</td>
                    <td class="sub">
                        @can('categories.edit')

                            <a href="{{route('categories.edit', ['category' => $item->id])}}" class="btn btn-info btn-sm">Edit</a>
                        @endcan
                            @can('categories.show')

                                <a href="{{route('categories.show', ['category' => $item->id])}}" class="btn btn-info btn-sm">show</a>
                            @endcan
                            @can('categories.destroy')
                                <button onclick="deleteElement('{{route('categories.destroy', $item->id)}}')" class="btn btn-danger btn-sm" value="Delete">Delete</button>
                            @endcan
                    </td>

                </tr>
            @endforeach
        </table>
        <div>
            <ul class="pagination">
                <li>  {{$items->links()}}</li>
            </ul>
        </div>
    </span>
@endsection

