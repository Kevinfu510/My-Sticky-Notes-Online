@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"> {{ $data->title}} </div>
                <div class="panel-body">

                <label for="content" class="col-md-4 control-label">Content</label>
                <div class="col-md-6">
                    <textarea id="content" class="form-control" name=content cols="60" rows="5" required="" readonly>{{ $data->content}}</textarea>
                </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
