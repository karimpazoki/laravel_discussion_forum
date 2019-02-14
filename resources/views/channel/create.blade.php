@extends('layouts.app')

@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Create New Channel</div>

            <div class="card-body">
                <form action="{{ route("channels.store") }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="title">Channel name</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Enter channel name">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
