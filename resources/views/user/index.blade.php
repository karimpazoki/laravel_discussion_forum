@extends('layouts.app')

@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Users</div>

            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>Mail</th>
                        <th>isAdmin</th>
                        <th>Edit</th>
                        <th>Destroy</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td><img src="{{ asset($user->avatar) }}" alt="{{ $user->name }}" width="40px" height="40px"></td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->admin }}</td>
                            <td>
                                <a href="{{ route('user.edit',['user'=>$user->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('user.destroy', ['user' => $user->id]) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    <tr>
                        <td colspan="6" class="text-center">
                            {{ $users->links() }}
                        </td>

                    </tr>

                    </tbody>
                </table>


            </div>
        </div>
    </div>
@endsection
