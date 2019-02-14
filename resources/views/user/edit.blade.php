@extends('layouts.app')

@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Edit user: {{ $user->name }}</div>

            <div class="card-body">
                <form action="{{ route("user.update",['user' => $user->id]) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="name">User name</label>
                        <input value="{{ $user->name }}" type="text" name="name" class="form-control" id="name" placeholder="Name">
                    </div>

                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input value="{{ $user->email }}" type="email" name="email" class="form-control" id="email" placeholder="jondo@example.com">
                    </div>

                    <div class="form-group">
                        <label for="avatar">Avatar</label>
                        <input type="file" name="avatar" class="form-control" id="avatar">
                    </div>

                    <div class="checkbox">
                        <label><input
                                    @if($user->admin)
                                    checked
                                    @endif
                                    type="checkbox" name="admin" > Admin</label>
                    </div>


                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
