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
    <div class="bg-light p-4" style="border: 1px solid #c5d7f2">
        <h2 class="resource-title">{!! $categories->name !!}</h2>
        @foreach(collect($categories->news)->sortByDesc('created_at') as $news)
            <div class="news-title">
                <h6 style="direction: @if($categories->resources->lng == 'en') ltr @else rtl @endif" ><a href="{{route('news.show.out', ['news' => $news->id])}}">{!!  $news->title !!}</a></h6>
                <p style="direction: @if($categories->resources->lng == 'en') ltr @else rtl @endif"> {!! substr(strip_tags($news->body), 0, 50) !!}... </p>
            </div>
    <hr>
    @endforeach

    </div>

@endsection
