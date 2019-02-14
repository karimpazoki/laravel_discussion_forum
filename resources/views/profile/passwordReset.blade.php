@extends('layouts.app')

@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Change password</div>

            <div class="card-body">
                <form action="{{ route("profile.resetPassword") }}" method="post">
                    {{ csrf_field() }}
                    {{--{{ method_field('PUT') }}--}}
                    <div class="form-group">
                        <label for="old">Old password</label>
                        <input value="" type="password" name="old" class="form-control" id="old">
                    </div>

                    <div class="form-group">
                        <label for="new">New password</label>
                        <input value="" type="password" name="new" class="form-control" id="new">
                    </div>

                    <div class="form-group">
                        <label for="rep">Repeat new password</label>
                        <input value="" type="password" name="rep" class="form-control" id="rep">
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
