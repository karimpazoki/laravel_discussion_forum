@extends('layouts.app')

@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Create New Role</div>

            <div class="card-body">
                <form action="{{ route("roles.store") }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        {{--<label for="title"></label>--}}
                        <input type="text" name="role" class="form-control" id="role" placeholder="Enter new role">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
