@extends('layouts.mobile')

@section('content')
    <div class="bg-light p-4" style="border: 1px solid #c5d7f2">
        <h2 style="direction: @if($news->category->resources->lng == 'en') ltr @else rtl @endif">{!! $news->title !!}</h2>
        <div>
            {!! $news->body !!}
            @if($news->path_url!=null)
                @if($news->category->resources->has_full_links)
                    <a href="{{$news->path_url}}" target="_blank">read more...</a>
                @else
                    <a href="{{$news->category->resources->link.''.  $news_path}}" target="_blank">read more...</a>
                @endif
            @endif
        </div>


    </div>
@endsection
