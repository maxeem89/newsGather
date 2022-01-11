@extends('layouts.app-master')

@section('content')

    <div class="bg-light p-4 rounded">
        <h1>Update categories</h1>
        <form method="post" action="{{ route('categories.update', $category->id) }}">
            @method('patch')
            @csrf
            <input name ="id" type="hidden" value="{{$category->id}}">
            <div class="mb-3">
                {!! Form::select('resources_id', $resources, $category->resources_id, ['class' => 'form-control', "onchange" => "getResourceProperties(this)", 'id' => "resourcePicker"]) !!}
                @if ($errors->has('resources_id'))
                    <span class="text-danger text-left">{{ $errors->first('resources_id') }}</span>
                @endif
                <input type="hidden" name="api" id ="api">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input value="{{ $category->name }}"
                       type="text"
                       class="form-control"
                       name="name"
                       placeholder="Name" required>

                @if ($errors->has('name'))
                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Sub_Link</label>
                <input value="{{ $category->sub_link }}"
                       type="text"
                       class="form-control"
                       name="sub_link"
                       placeholder="Sub_Link" required>
                @if ($errors->has('sub_link'))

                    <span class="text-danger text-left">{{ $errors->first('sub_link') }}</span>
                @endif
            </div>
            <div class="mb-3 TargetElement">
                <label for="name" class="form-label">Target Element</label>
                <input value="{{ $category->target_element }}"
                       type="text"
                       class="form-control"
                       name="target_element"
                       placeholder="Target Element">
                @if ($errors->has('target_element'))

                    <span class="text-danger text-left">{{ $errors->first('target_element') }}</span>
                @endif
            </div>
            <div class="mb-3 TargetElement">
                <label for="name" class="form-label">Regex</label>
                <input value="{{ $category->regex }}"
                       type="text"
                       class="form-control"
                       name="regex"
                       placeholder="Regex">
                @if ($errors->has('regex'))

                    <span class="text-danger text-left">{{ $errors->first('regex') }}</span>
                @endif
            </div>

            <div class="mb-3 TargetElement">
                <label for="name" class="form-label">Target News Title</label>
                <input value="{{ $category->target_news_title }}"
                       type="text"
                       class="form-control"
                       name="target_news_title"
                       placeholder="Target News Title">
                @if ($errors->has('target_news_title'))
                    <span class="text-danger text-left">{{ $errors->first('target_news_title') }}</span>
                @endif
            </div>
            <div class="mb-3 TargetElement">
                <label for="name" class="form-label">Target News Body</label>
                <input value="{{$category->target_news_body }}"
                       type="text"
                       class="form-control"
                       name="target_news_body"
                       placeholder="Target News Body">
                @if ($errors->has('target_news_body'))
                    <span class="text-danger text-left">{{ $errors->first('target_news_body') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Update categories</button>
            <button><a href="{{ route('categories.index') }}" class="btn btn-default">Cancel></a></button>
        </form>
    </div>

    </div>


@endsection
@section("scripts")
    <script>
        $(document).ready(function (){
            getResourceProperties($("#resourcePicker"))
        })
        function getResourceProperties(element){
            $.ajax({
                type: "GET",
                url: "{{route('resources.properties')}}/" + $(element).val(),
                success: function (data) {
                    $("#api").val(data.api);
                    if(data.api == 0){
                        $(".TargetElement").css("display", '');
                    }else {
                        $(".TargetElement").css("display", 'none');
                    }
                }
            });
        }
    </script>
@endsection
