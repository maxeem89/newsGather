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

    .table-borderless tbody tr td {
        border: 0 !important;
    }

</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
@section('content')
    @if($errors->has('category_id'))
        <span class="text-danger text-left">{{ $errors->first('category_id') }}</span>
    @endif
    <div class="offset-md-3 col-md-6">
        <form method="POST" action="{{route('out.storeSetting')}}">
            @csrf
            <table class="table table-borderless" style="border: 0 !important;">
                @foreach($resources as $resource)
                    <tr style="background: #424B5C; color: #A6AEBB;">
                        <td colspan="2">
                            <input id="checkedAll" checked onchange="changeResource(this)"
                                   class="{{"resource".$resource->id}} resource" type="checkbox"
                                   value="{{$resource->id}}">{{$resource->name}}</td>
                    </tr>
                    <tr>
                        @foreach($resource->categories as $category)
                            <td><input type="checkbox" name="category_id[]" onchange="changeCategory(this)" @if($all) checked @elseif(isset($categoryList[$category->id])) checked @endif
                                class="{{"resource".$resource->id}}" value="{{$category->id}}">{{$category->name}}</td>
                        @endforeach
                    </tr>
                @endforeach
            </table>
            <button type="submit" class="btn btn-primary">Save Setting</button>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $("input[name='category_id[]']").each(function( index, value ) {
                changeCategory(this)
            });
        });
        function changeResource(element) {
            if (element.checked) {
                $("." + element.classList[0]).prop('checked', 'checked');

            } else {
                $("." + element.classList[0]).prop('checked', false);
            }
        }

        function changeCategory(element){
            if (!element.checked) {
                $("." + $(element).attr("class") +".resource").prop('checked', false);
            }
            var flag = true;
            $( "." + $(element).attr("class") ).each(function( index, value ) {
               if(value.classList.length == 1) {
                   if(!value.checked){
                       flag = false;
                   }
               }
            });
            if(flag){
                $("." + $(element).attr("class") +".resource").prop('checked', true);
            }
        }



    </script>
@endsection
