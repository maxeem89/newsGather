@extends('layouts.app-master')
@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Show News</h1>
        <hr>
        <div class="lead">

        </div>
        <div>
            <div class="row">
                <label><h6>News Information</h6></label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <tr>
                        <th>News ID</th>
                        <th>Resource Name</th>
                        <th>Category Name</th>
                        <th>title</th>
                    </tr>
                    <tr>
                        <td>
                            <h6>{{$news->id}}</h6>
                        </td>
                        <td>
                            <h6> {{$news->category->resources->name}}</h6>
                        </td>
                        <td>
                            <h6>{{$news->category->name}}</h6>
                        </td>
                        <td>
                            <h6 style="letter-spacing: 1px;">{!!  $news->title!!}</h6>
                        </td>
                    </tr>
                </table>
                <div id="body" style="border-radius: 5px; border: #1a1e21 solid 1px; padding: 20px;">
                    {!!$news->body!!}
                </div>
            </div>
        </div>
    </div>
@endsection
