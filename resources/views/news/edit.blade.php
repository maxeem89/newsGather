@extends('layouts.app-master')

@section('content')

    <div class="bg-light p-4 rounded">
        <h1>Update categories</h1>
        <div class="lead">

        </div>
        <form id="form-news" method="post" action="{{ route('news.update', $news->id) }}">
            @method('patch')
            @csrf
            <input name ="id" type="hidden" value="{{$news->id}}">
            <div class="mb-3">
                {!! Form::select('resources_id', $resource, $news->resources_id, ['class' => 'form-control', 'id' => 'getCategory']) !!}
                @if ($errors->has('resources_id'))
                    <span class="text-danger text-left">{{ $errors->first('resources_id') }}</span>
                @endif
            </div>
            <div class="mb-3">
                {!! Form::select('categories_id', $category, $news->categories_id, ['class' => 'form-control', 'id' => 'categories']) !!}
                @if ($errors->has('categories_id'))
                    <span class="text-danger text-left">{{ $errors->first('categories_id') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">title</label>
                <input value="{{ $news->title }}"
                       type="text"
                       class="form-control"
                       name="title"
                       placeholder="title" required>

                @if ($errors->has('title'))
                    <span class="text-danger text-left">{{ $errors->first('title') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="body" class="form-label">Body</label>
                <div id="bodyText">
                    <div class="ql-editor">
                        {!! $news->body !!}
                    </div>
                </div>
                <input type="hidden" id="bodyHiddenText" name="body" value="">
                @if ($errors->has('body'))

                    <span class="text-danger text-left">{{ $errors->first('body') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Update News</button>
            <button><a href="{{ route('news.index') }}" class="btn btn-default">Cancel</a></button>
        </form>
    </div>

    </div>


@endsection

@section("scripts")
    <script type="text/javascript">
        var toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
            ['blockquote', 'code-block'],

            [{ 'header': 1 }, { 'header': 2 }],               // custom button values
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
            [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
            [{ 'direction': 'rtl' }],                         // text direction

            [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

            [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
            [{ 'font': [] }],
            [{ 'align': [] }],
            ['image', 'code-block', 'link', 'video'],
            ['clean']                                         // remove formatting button
        ];

        var quill = new Quill('#bodyText', {
            modules: {
                toolbar: toolbarOptions
            },
            theme: 'snow'
        });

        $("#form-news").one('submit', function (e){
            e.preventDefault();
            $("#bodyHiddenText").val($(".ql-editor").html());
            $(this).submit();
        });
        $("#getCategory").on('change', function() {
            var id=$(this).val();
            $.ajax({
                type: "GET",
                url: "{{route('news.getCategories')}}/"+id,
                success: function(data)
                {
                    $("#categories").empty();
                    $.each(data, function (i, item) {
                        console.log(item);
                        $('#categories').append($('<option>', {
                            value: item.id,
                            text : item.name
                        }));
                    });
                }
            });

        });
    </script>
@endsection
