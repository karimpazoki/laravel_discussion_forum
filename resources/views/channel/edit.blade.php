@extends('layouts.app')

@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Update {{ $channel->title }} Channel</div>

            <div class="card-body">
                <form action="{{ route("channels.update",['channels' => $channel->id]) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field("PUT") }}
                    <div class="form-group">
                        <label for="title">Channel name</label>
                        <input type="text" name="title" class="form-control" id="title" value="{{ $channel->title }}">
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
