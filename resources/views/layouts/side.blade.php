<div class="col-md-4">
    <a href="{{ route('discussion.create') }}" class="btn btn-primary btn-block">Create a new discussion</a>
    <br>

    <ul class="list-group">
        <li class="list-group-item"><a href="{{ route('home') }}">Home</a></li>
        @if(Auth::check())
            <li class="list-group-item"><a href="{{ route('profile.show',['profile' => Auth::user()->id]) }}">Profile</a></li>
            @if(Auth::user()->admin)
                <li class="list-group-item"><a href="{{ route('channels.index') }}">Channels</a></li>
                <li class="list-group-item"><a href="{{ route('channels.create') }}">Create new channel</a></li>

                <li class="list-group-item"><a href="{{ route('user.index') }}">Users</a></li>
                <li class="list-group-item"><a href="{{ route('user.create') }}">Create new user</a></li>
            @endif
        @endif
    </ul>


    <br>
    <div class="card">
        <div class="card-header">
            Channels
        </div>
        <div class="card-body">
            <ul class="list-group">
                @foreach($channels as $ch)
                    <li class="list-group-item">
                        <a href="{{ route('channels.show',['channel' => $ch->slug]) }}">{{ $ch->title }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>





</div>