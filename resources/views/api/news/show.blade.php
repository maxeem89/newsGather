@extends('layouts.mobile')

@section('content')
    <div class="bg-light p-4"style="border: 1px solid #c5d7f2">
        <h2 style="direction: @if($news->category->resources->lng == 'en') ltr @else rtl @endif">{!! $news->title !!}</h2>
        <div >
            {!! $news->body !!}
        </div>


    </div>

@endsection
