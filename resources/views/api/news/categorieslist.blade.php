@extends('layouts.mobile')
<style>
    .resource-title {
        color: #ffffff;
        background: linear-gradient(to bottom,  #424B5C, #A6AEBB);
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
    .second-news-title{
        padding: 5px;
        padding-left: 10px;
        padding-right: 10px;
        font-size: 18px;
    }
    .resource-title h2, .category-title h3, .second-news-title h6 {
        padding-left: 10px;
        padding-right: 10px;
    }
    .second-news-title p {
        padding-left: 13px;
        padding-right: 13px;
    }
    .resource-title a {
        color: #544a32;
    }
</style>
@section('content')
    <div class="">
      @php
      $var=0
          @endphp
        <h2 class="category-title">{!! $categories->name !!}</h2>
        @foreach(collect($categories->news)->sortByDesc('created_at') as $news)
            <div class ="second-news-title @if($var%2==0) news-title @endif">
                <h4  ><a href="{{route('news.show.out', ['news' => $news->id])}}">{!!  $news->title !!}</a></h4>
                <p style="direction: @if($categories->resources->lng == 'en') ltr @else rtl @endif"> {!! substr(strip_tags($news->body), 0, 50) !!}..  </p>
                <h6 style="direction: @if($categories->resources->lng == 'en') rtl @else ltr @endif">{{$categories->resources->name}} &nbsp<span class="badge bg-primary">{{ $news->created_at}}</span> </h6>
            </div>
            @php
            $var++
            @endphp
        @endforeach

    </div>

@endsection
