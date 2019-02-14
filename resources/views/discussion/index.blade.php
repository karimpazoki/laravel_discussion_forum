@extends('layouts.app')

@section('content')
    <div class="col-md-8">
        @if(count($discussions) > 0)
            @foreach($discussions as $discussion)
                <div class="card">
                    <div class="card-header">
                        <h6><a href="{{ route('profile.show', ['profile' => $discussion->user_id]) }}"><img src="{{ asset($discussion->user->avatar) }}" alt="{{ $discussion->user->name }}" class="img-circle" width="50px" height="50px" > {{ $discussion->user->name }} </a><span class="text-muted">{{ $discussion->created_at->diffForHumans() }}</span></h6>
                    </div>

                    <div class="card-body">
                        <a href="{{ route('discussion.show',['discussion' => $discussion->slug]) }}" class="btn btn-default btn-sm pull-right">
                            <h4 class="text-center">{{ $discussion->title }}</h4>
                        </a>
                        <hr>
                        <div class="text-justify">{{ str_limit($discussion->content,150) }}</div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('channels.show',['channel' => $discussion->channel->slug]) }}" class="btn btn-outline-info btn-sm pull-right">{{ $discussion->channel->title }}</a>
                        @if(Auth::user()->id == $discussion->user_id or Auth::user()->admin == 1)
                            <a href="{{ route('discussion.edit',['discussion' => $discussion->slug]) }}" class="btn btn-outline-secondary btn-sm pull-right">Edit</a>
                            <form action="{{ route('discussion.destroy',['discussion' => $discussion->id]) }}" method="post" class="d-inline">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="btn btn-outline-danger btn-sm pull-right">Delete</button>
                            </form>
                        @endif
                    </div>
                </div>
                <br>
            @endforeach
        @endif


        <div class="text-center">
            {{ $discussions->links() }}
        </div>
    </div>
@endsection
