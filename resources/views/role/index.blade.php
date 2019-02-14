@extends('layouts.app')

@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Roles</div>

            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>channel</th>
                        <th>Edit</th>
                        <th>Destroy</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->role }}</td>
                            <td>
                                <a href="{{ route('roles.edit',['roles'=>$role->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('roles.destroy', ['roles' => $role->id]) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if(count($roles)<1)
                        </tr>
                            <td colspan="3" class="text-center">
                                There isn't any Role yet.<br>
                                <p>Create new one.</p>
                                <a href="{{ route("roles.create") }}" class="btn btn-primary">Create new Role</a>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
