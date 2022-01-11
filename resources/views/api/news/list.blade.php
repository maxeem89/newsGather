@extends('layouts.mobile')

@section('content')
    <style>

        .resource-title{
            color: white;
            background: darksalmon;
            border: 1px solid #573b8a;
            text-align: center;


        }
        .category-title{
            color: #eeeeee;
            background-color: #596fe5;
            border: 1px solid #596fe5;
            text-align: center;
        }
        .news-title{
            border: 1px solid #eeeeee;
        }
        .resource-title h2, .category-title h3, .news-title h6 {
            padding-left: 10px;
            padding-right: 10px;

        }
        .news-title p{
            padding-left: 13px;
            padding-right: 13px;
            color: #6c757d;
        }
        .news-title{
            background-color: white;
            color: #1a1e21;
        }
        .resource-title a{
            color: white;
        }

    </style>
    <div class="bg-light p-4 rounded" style="padding-top: 0px !important; padding-bottom: 0px !important; background: transparent;">

        @foreach($resources as $resource)
            @if(count($resource->categories))
                <div class="row">
                    <div class="resource-title">
                        <h2><a href="{{route('resources.show.out', ['resource' => $resource->id])}}">{{$resource->name}}</h2>
                    </div>
                    @foreach($resource->categories as $category)
                        <div class="news-title ">
                            <h2 style="direction: @if($resource->lng == 'en') ltr @else rtl @endif"><a href="{{route('categories.show.out', ['category' => $category->id])}}">{{$category->name}}</h2>
                        </div>
                        @foreach(collect($category->news)->sortByDesc('id')->take(3) as $news)
                            <div class="news-title">
                                <h6 style="direction: @if($resource->lng == 'en') ltr @else rtl @endif" ><a href="{{route('news.show.out', ['news' => $news->id])}}">{!!  $news->title !!}</a></h6>
                                <p style="direction: @if($resource->lng == 'en') ltr @else rtl @endif"> {!! substr(strip_tags($news->body), 0, 50) !!}... </p>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            @endif
        @endforeach
    </div>
@endsection
