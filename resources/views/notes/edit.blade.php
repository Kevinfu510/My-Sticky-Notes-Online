@extends('layouts.app')

@section('content')
<!-- <script type="text/javascript">
     function shareNote() {
        username = document.getElementById("username").value;
        if (username.length > 0) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("POST", "gethint.php?q=" + str, true);
            xmlhttp.send();
        }

     }
</script> -->

<div class="container">
    <div class="row">
        <div class="col-md-8" style="width: 100%">
            <div class="panel panel-default">
                @if (isset($data))
                    <div class="panel-heading">Edit Sticky Note</div>
                    @if($errors->any())
                        <h4 style="color: #FF0000;padding-left: 20px">ERROR!</h4>
                    @endif
                    <div class="panel-body">
                        <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6" >
                            <form class="form-horizontal" method="POST" action="{{ route('notes.update',['id' => $data->id]) }}">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">Sticky Note Title</label>
                                    <div class="col-md-6">
                                        <input id="name" type="name" class="form-control" name="name" value="{{ $data->title }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                    <label for="content" class="col-md-4 control-label">Content</label>

                                    <div class="col-md-6">
                                        <textarea id="content" class="form-control" name=content cols="60" rows="5" required>{{ $data->content }}</textarea>
                                        @if ($errors->has('content'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('content') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Update
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">                            
                            <label class="col-md-4 control-label">Share With</label>
                            <div>
                                <form class="form-horizontal" method="POST" action="{{ route('notes.share',['id' => $data->id]) }}">
                                    {{ csrf_field() }}
                                    <input type="text" id="username" name="username" placeholder="username" required>
                                    <input id= "share_btn" type="submit" value="Share">
                                    @if (isset($error))
                                        <span class="help-block">
                                            <strong style="color: red">{{ $error }}</strong>
                                        </span>
                                    @endif
                                </form>
                            </div>
                            <div>
                                <ul id="user-list" style="width: 40%">
                                    @if (isset($share_data))
                                        @foreach ($share_data as $user)
                                        <li>
                                            <b>{{ $user->name }}</b>

                                            <form action="{{ route('notes.remove',['id' => $data->id, 'user_id' => $user->id]) }}"
                                            method="POST" style="display: inline-block;float: right;" id="remove_form">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <a onclick="document.getElementById('remove_form').submit();" style="float: right;">remove</a>
                                            </form>
                                        </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                        </div>

                    </div>
                @else
                    <h1>503 Server Error</h1>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
