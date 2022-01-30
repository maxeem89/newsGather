@extends('layouts.mobile')
<style>

    .resource-title {
        color: #ffffff;
        background: linear-gradient(to bottom, #424B5C, #A6AEBB);
        text-align: center;
    }

    .category-title {
        color: #ffffff;
        background: linear-gradient(to bottom, #d3e1f3, #899bbe);
        text-align: center;
    }

    .news-title {
        background: #d7dfec;
        color: #23211c;

    }

    .second-news-title {
        padding: 5px;
        padding-left: 10px;
        padding-right: 10px;
    }

    .resource-title h2, .category-title h3, .news-title h6 {
        padding-left: 10px;
        padding-right: 10px;

    }

    .news-title p {
        padding-left: 13px;
        padding-right: 13px;

    }


    .resource-title a {
        color: #544a32;
    }
</style>
@section('content')
    <div class=""
         style="padding-top: 0px !important; padding-bottom: 0px !important; ;">
        @php
            $var=0;
        @endphp
        <h1 class="resource-title">{!! $resourcesCustom->name !!}</h1>
        @foreach($resourcesCustom->categories as $category)
            <h2 class="category-title"
                style="direction: @if($category->resources->lng == 'en') ltr @else rtl @endif ;text-align: center">{{$category->name}}</h2>
            @foreach(collect($category->news)->sortByDesc('created_at') as $news)
                <div>
                    <div class="second-news-title @if($var%2==0) news-title @endif">
                        <h4 style="direction: @if($category->resources->lng == 'en') ltr @else rtl @endif"><a
                                href="{{route('news.show.out', ['news' => $news->id])}}">{!!  $news->title !!}</a></h4>
                        <p style="direction: @if($category->resources->lng == 'en') ltr @else rtl @endif"> {!! substr(strip_tags($news->body), 0, ($category->resources->lng == 'en' ? 50 : 100)) !!}
                            ... </p>
                        <h6 style=" padding: 5px; direction: @if($category->resources->lng=='en') rtl @else ltr @endif ">
                            <span class="badge bg-primary">{{$news->created_at}}</span></h6>
                    </div>
                </div>
                @php
                    $var++;
                @endphp
            @endforeach
        @endforeach
    </div>
@endsection

