@extends('layouts.app-master')
@section('content')
    <div class="bg-light p-4 rounded">

        <h1>Show Resources</h1>
        <hr>
        <div class="lead">

        </div>
        <div>
            <div class="row">
                <label><h6>Category Information</h6></label>
            </div>
        </div>
        <div>
            <table class="table table-striped">
                <tr>
                    <th>Category ID</th>
                    <th>Resource Name</th>
                    <th>Category Name</th>
                    <th>Category link</th>
                </tr>
                    <tr>
                        <td>
                            <h6>{{$category->id}}</h6>
                        </td>
                        <td>
                       <h6> {{$category->resources->name}}</h6>
                        </td>
                        <td>
                            <h6>{{$category->name}}</h6>
                        </td>
                        <td>
                            <h6>{{$category->sub_link}}</h6>
                        </td>
                    </tr>
                    </thead>

            </table>
        </div>

    </div>

@endsection
