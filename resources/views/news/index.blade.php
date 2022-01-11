@extends('layouts.app-master')

<style>

    /* CSS */
    .button-1 {
        background-color: #74b1da;
        border-radius: 8px;
        border-style: none;
        box-sizing: border-box;
        color: #FFFFFF;
        cursor: pointer;
        display: inline-block;
        font-family: "Haas Grot Text R Web", "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 14px;
        font-weight: 500;
        height: 40px;
        line-height: 20px;
        list-style: none;
        margin: 0;
        outline: none;
        padding: 10px 16px;
        position: relative;
        text-align: center;
        text-decoration: none;
        transition: color 100ms;
        vertical-align: baseline;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
    }

    .button-1:hover,
    .button-1:focus {
        background-color: #6745a6;
    }
</style>
@section('content')

    <div class="bg-light p-4 rounded">
        <h1>News
        </h1>
        <form action="" method="GET">
            <input  value="{{optional($request)->search}}" autocomplete="off" type="text" name="search" required/>
            <button class="button-1" type="submit">Search</button>
        </form>
        <div class="lead">
            <a href="{{ route('news.create') }}" class="btn btn-primary btn-sm float-right">Add new News</a>
        </div>
        <div class="mt-2">
            @include('layouts.partials.messages')
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Resources</th>
                <th>Category</th>
                <th>Title</th>
                <th>Date</th>
                <th>Path</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

            @foreach($items as $key => $item)
                <tr>
                    <td>{{$item['id']}}</td>
                    <td>{{$item->category->resources->name}}</td>
                    <td>{{$item->category->name}}</td>
                    <td>{!! $item['title'] !!}</td>
                    <td>{{$item['created_at']}}</td>
                    <td>{{$item['path_url']}}</td>
                    <td>
                        @can('news.edit')

                            <a href="{{route('news.edit', ['news' => $item->id])}}" class="btn btn-info btn-sm">Edit</a>
                        @endcan
                        @can('news.show')

                            <a href="{{route('news.show', ['news' => $item->id])}}" class="btn btn-info btn-sm">show</a>
                        @endcan
                        @can('news.destroy')
                            <button onclick="deleteElement('{{route('news.destroy',$item->id)}}')"
                                    class="btn btn-danger btn-sm" value="Delete">Delete
                            </button>
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
    </div>
@endsection

