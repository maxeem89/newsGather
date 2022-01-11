@extends('layouts.app-master')

@section('content')
    <span class="bg-light p-4 rounded">
        <h1>Resources
        </h1>
        <div class="lead">
            <a href="{{ route('resources.create') }}" class="btn btn-primary btn-sm float-right">Add new Resources</a>
        </div>
        <div class="mt-2">
            @include('layouts.partials.messages')
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Link</th>
                <th>Language</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

            @foreach($items as $key => $item)
                <tr>
                    <td>{{$item['id']}}</td>
                    <td>{{$item['name']}}</td>
                    <td>{{$item['link']}}</td>
                    <td>{{strtoupper($item['lng'])}}</td>
                    <td class="sub">
                        @can('resources.edit')
                            <a href="{{route('resources.edit', ['resource' => $item->id])}}"
                               class="btn btn-info btn-sm">Edit</a>
                        @endcan
                        @can('resources.show')
                            <a href="{{route('resources.show', ['resource' => $item->id])}}"
                               class="btn btn-info btn-sm">Show</a>
                        @endcan
                        @can('resources.destroy')
                            <button onclick="deleteElement('{{route('resources.destroy', $item->id)}}')" class="btn btn-danger btn-sm" value="Delete">Delete</button>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <span>
            <ul class="pagination">
                <li>  {{$items->links()}}</li>
            </ul>
        </span>
    </span>
@endsection
