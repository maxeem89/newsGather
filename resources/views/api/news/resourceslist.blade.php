@extends('layouts.mobile')
<style>

    .resource-title{
        color: white;
        background: #573b8a;
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
@section('content')
    <div class="bg-light p-4 rounded" style="padding-top: 0px !important; padding-bottom: 0px !important; background: transparent;">
        <h2 class="resource-title">{!! $resources->name !!}</h2>
        @foreach($resources->categories as $category)
            <h3 class="box-shadow">{{$category->name}}</h3>
            @foreach(collect($category->news)->sortByDesc('created_at') as $news)
                <div>
                    <div class="news-title">
                        <h6 style="direction: @if($category->resources->lng == 'en') ltr @else rtl @endif" ><a href="{{route('news.show.out', ['news' => $news->id])}}">{!!  $news->title !!}</a></h6>
                        <p style="direction: @if($category->resources->lng == 'en') ltr @else rtl @endif"> {!! substr(strip_tags($news->body), 0, 50) !!}... </p>
                    </div>
                </div>
                <hr>
                @endforeach
        @endforeach

    </div>

@endsection
