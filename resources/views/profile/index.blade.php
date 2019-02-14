@extends('layouts.app')

@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ $user->name }}</div>
            <div class="card-body">

                <div class="d-inline-block">
                    <h5>Name:</h5>
                </div>
                <div class="d-inline-block">
                    <h6>{{ $user->name }}</h6>
                </div>

                <div class="clearfix"></div>

                <div class="d-inline-block">
                    <h5>Email:</h5>
                </div>
                <div class="d-inline-block">
                    <h6>{{ $user->email }}</h6>
                </div>

                <div class="clearfix"></div>

                <div class="d-inline-block">
                    <h5>Role:</h5>
                </div>
                <div class="d-inline-block">
                    <h6>{{ $user->Role }}</h6>
                </div>

                <div class="clearfix"></div>

                @if(Auth::check())
                    @if($user->id == Auth::user()->id)
                        <a href="{{ route("profile.edit", ['profile'=> $user->id]) }}" class="btn btn-primary">Edit Profile</a>
                        <a href="{{ route("profile.changePassword" ) }}" class="btn btn-primary">Edit Password</a>
                    @endif
                @endif
                <br>
                @if(count($discussions) > 0)
                    <div class="card">
                        <div class="card-header">
                            <h6>Discussions</h6>
                        </div>
                        @foreach($discussions as $discussion)
                            <div class="card-body">
                                <a href="{{ route('discussion.show',['discussion' => $discussion->slug]) }}" class="btn btn-default btn-sm pull-right">
                                    <h6 class="text-center">{{ $discussion->title }}</h6>
                                </a>
                                <span class="text-muted">{{ $discussion->created_at->diffForHumans() }}</span>
                                <a href="{{ route('channels.show',['channel' => $discussion->channel->slug]) }}" class="btn btn-info btn-sm pull-right">{{ $discussion->channel->title }}</a>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                @endif

                @if(count($replies) > 0)
                    <div class="card">
                        <div class="card-header">
                            <h6>Replies</h6>
                        </div>
                        @foreach($replies as $reply)
                            <div class="card-body">
                                Replied to: <a href="{{ route('discussion.show',['discussion' => $reply->discussion->slug]) }}#{{ $reply->id }} " class="btn btn-default btn-sm pull-right">
                                    <h6 class="text-center">{{ $reply->discussion->title }}</h6>
                                </a>
                                <span class="text-muted">{{ $reply->created_at->diffForHumans() }}</span>
                                {{--<a href="{{ route('channels.show',['channel' => $reply->channel->slug]) }}" class="btn btn-info btn-sm pull-right">{{ $discussion->channel->title }}</a>--}}
                            </div>
                        @endforeach
                    </div>
                    <hr>
                @endif
            </div>
        </div>
    </div>
@endsection
