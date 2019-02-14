@extends('layouts.app')

@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Create New User</div>

            <div class="card-body">
                <form action="{{ route("user.store") }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">User name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                    </div>

                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="jondo@example.com">
                    </div>

                    <div class="form-group">
                        <label for="avatar">Avatar</label>
                        <input type="file" name="avatar" class="form-control" id="avatar">
                    </div>

                    <div class="checkbox">
                        <label><input type="checkbox" name="admin" value=""> Admin</label>
                    </div>


                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
