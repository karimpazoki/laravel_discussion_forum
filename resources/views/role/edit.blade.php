@extends('layouts.app')

@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Update {{ $role->role }} Role</div>

            <div class="card-body">
                <form action="{{ route("roles.update",['roles' => $role->id]) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field("PUT") }}
                    <div class="form-group">
                        <label for="title">Channel name</label>
                        <input type="text" name="role" class="form-control" id="role" value="{{ $role->role }}">
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
