@extends('layouts.app-master')

@section('content')

    <div class="bg-light p-4 rounded">
        <h1>Update Resource</h1>
        <div class="lead">

        </div>
        <form method="post" action="{{ route('resources.update', $resource->id) }}">
            @method('patch')
            @csrf
            <input name ="id" type="hidden" value="{{$resource->id}}">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input value="{{ $resource->name }}"
                       type="text"
                       class="form-control"
                       name="name"
                       placeholder="Name" required>

                @if ($errors->has('name'))
                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Link</label>
                <input value="{{ $resource->link }}"
                       type="text"
                       class="form-control"
                       name="link"
                       placeholder="Link" required>
                @if ($errors->has('link'))
                    <span class="text-danger text-left">{{ $errors->first('link') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Is API</label>
                <input value="1"
                       type="checkbox"
                       name="api"
                       class="form-check-input"
                       placeholder="api"
                       id="api" @if($resource->api == 1) checked @endif>
                @if ($errors->has('api'))
                    <span class="text-danger text-left">{{ $errors->first('api') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Is Full URL</label>
                <input value="1"
                       type="checkbox"
                       name="has_full_links"
                       class="form-check-input" @if($resource->has_full_links == 1) checked @endif>
                @if ($errors->has('has_full_links'))
                    <span class="text-danger text-left">{{ $errors->first('has_full_links') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">language</label>
                {!! Form::select('lng', config('defines.languages'), $resource->lng, ['class' => 'form-control']) !!}
                @if ($errors->has('lng'))
                    <span class="text-danger text-left">{{ $errors->first('lng') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Update Resource</button>
            <button><a href="{{ route('resources.index') }}" class="btn btn-default">Cancel></a></button>
        </form>
    </div>

    </div>


@endsection
