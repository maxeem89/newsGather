@extends('layouts.mobile')

@section('content')
    <style>

        .category-title {
            color: #ffffff;
            background: linear-gradient(to bottom, #d3e1f3, #899bbe);
            text-align: center;
            margin-bottom: 5px;
            margin-top: 5px;
        }

        .category-title h2 a {
            color: #ffffff;
        }

        .news-title {
            background: #d7dfec;
            color: #23211c;

        }

        .second-news-title {
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

    </style>
    <div class=" p-4 rounded"
         style="padding-top: 0px !important; padding-bottom: 0px !important; background: transparent;">

        @foreach($resources as $resource)
            @if(count($resource->categories))
                <div class="row">

                    @php
                        $var=0;
                    @endphp
                    @foreach($resource->categories as $category)
                        <div class="category-title ">
                            <h2 style="direction: @if($resource->lng == 'en') ltr;  @else rtl @endif"><a
                                    href="{{route('categories.show.out', ['category' => $category->id])}}">{{$category->name}}
                            </h2>
                        </div>
                        @foreach(collect($category->news)->sortByDesc('id')->take(3) as $news)
                            <div class="second-news-title @if($var%2==0) news-title @endif">
                                <h4 style="direction: @if($resource->lng == 'en') ltr @else rtl @endif"><a
                                        href="{{route('news.show.out', ['news' => $news->id])}}">{!!  $news->title !!}</a>
                                </h4>
                                <p style="direction: @if($resource->lng == 'en') ltr @else rtl @endif;"> {!! substr(strip_tags($news->body), 0, 50) !!}
                                    ... </p>
                                <h6 style="direction: @if($resource->lng == 'en') rtl @else ltr @endif">{{$resource->name}}</h6>
                            </div>
                            @php
                                $var++;
                            @endphp
                        @endforeach
                    @endforeach
                </div>
            @endif
        @endforeach
    </div>
@endsection
