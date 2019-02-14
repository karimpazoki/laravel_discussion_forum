@extends('layouts.app')

@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Channels</div>

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
                    @foreach($channels as $channel)
                        <tr>
                            <td>{{ $channel->title }}</td>
                            <td>
                                <a href="{{ route('channels.edit',['channels'=>$channel->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('channels.destroy', ['channels' => $channel->id]) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if(count($channels)<1)
                        </tr>
                            <td colspan="3" class="text-center">
                                There isn't any channel yet.<br>
                                <p>Create new one.</p>
                                <a href="{{ route("channels.create") }}" class="btn btn-primary">Create new Channel</a>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
