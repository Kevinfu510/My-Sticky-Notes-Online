@extends('layouts.app')

@section('content')
@guest
    <div class="container">
        <p>Welcome to . . .  </p>
    </div>
@else
    <div class="container">
        <div class="row">
            <div class="col-md-8" style="width: 90%">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <div class="form-group">
                            You are logged in!
                            <a href="{{ route('notes.create') }}" class="btn btn-default" style="margin-left: 50px">Create New Note</a>
                        </div>

                        <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 b-r padding_bottom_70" >
                        <h2>My Sticky Notes</h2>
                            @if (isset($records))
                                @if (count($records) > 0)
                                @foreach ($records as $rec)
                                    <div style="display: inline-block;">
                                        <div style="display: inline-block;margin-right: 50px">
                                            <h4>
                                                <a href="{{ route('notes.show',['id' => $rec->id]) }}">
                                                    {{ $rec->title }}
                                                </a>
                                            </h4>
                                            <p><b style="margin-right: 20px">Last modified</b>{{$rec->date_modified}}</p>
                                        </div>
                                        <div style="display: inline-block;">
                                            <a href="{{ route('notes.edit',['id' => $rec->id]) }}" class="btn btn-default">
                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                            </a>
                                            <form action="{{ route('notes.delete',['id' => $rec->id]) }}" method="POST">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button class="btn btn-danger" type="submit"><i class="fa fa-trash-o"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                                @else
                                    <h2>NO NOTES</h2>
                                @endif
                            @endif
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 b-r padding_bottom_70">
                        <h2>Shared with Me</h2>
                        @if (isset($shared_records))
                            @if (count($shared_records) > 0)
                            @foreach ($shared_records as $rec)
                                <div style="display: inline-block;">
                                    <div style="display: inline-block;margin-right: 50px">
                                        <h4>
                                            <a href="{{ route('notes.show',['id' => $rec->id]) }}">
                                                {{ $rec->title }}
                                            </a>
                                        </h4>
                                        <p><b style="margin-right: 20px">Last modified</b>{{$rec->date_modified}}</p>
                                    </div>
                                </div>
                            @endforeach
                            @else
                                <h2>NO NOTES</h2>
                            @endif
                        @endif
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endguest

@endsection
