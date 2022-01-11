@extends('layouts.app-master')
@section('content')
    <div class="bg-light p-4 rounded">

        <h1>Show Resources</h1>
       <hr>
        <div class="lead">

        </div>
        <div>
            <div class="row">
                <label><h6>Resource Information</h6></label>
            </div>
            <div class="row">
                <div class="row">
                    <div class="col-md-1">
                        <label class="form-label fw-bold">ID</label>
                    </div>
                    <div class="col-md-1">
                        <label>{{$resource->id}}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1">
                        <label class="form-label fw-bold">Name</label>
                    </div>
                    <div class="col-md-1">
                        <label>{{$resource->name}}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1">
                        <label class="form-label fw-bold">Link</label>
                    </div>
                    <div class="col-md-6">
                        <label>{{$resource->link}}</label>
                    </div>
                </div>
            </div>
        </div>
        <div >
            <table class="table table-striped">
                <tr>
                    <th>Category ID</th>
                    <th>Category Name</th>
                    <th>Category link</th>
                </tr>
        @foreach($resource->categories as $key => $value)
                       <tr>
                           <td>
                               <h6>{{$value->id}}</h6>
                           </td>
                           <td>
                              <h6>{{$value->name}}</h6>
                           </td>
                           <td>
                              <h6>{{$value->sub_link}}</h6>
                           </td>
                       </tr>
                    </thead>
        @endforeach
            </table>
        </div>

    </div>

@endsection
