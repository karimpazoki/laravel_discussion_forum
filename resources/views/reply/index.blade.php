@foreach($replies as $reply)
    <div class="card" id="{{ $reply->id }}">
         <div class="card-header
        @isset($reply->discussion->best_reply)
            @if($reply->discussion->best_reply == $reply->id)
             bg-success text-white
           @endif
        @endisset
                ">
            <h6><img src="{{ asset($reply->user->avatar) }}" alt="{{ $reply->user->name }}" class="img-circle" width="50px" height="50px" > {{ $reply->user->name }} <span class="text-muted">{{ $reply->created_at->diffForHumans() }}</span></h6>
        </div>
        <div class="card-body">
            <div class="text-justify">{{ $reply->content }}</div>
        </div>
        <div class="card-footer">

            @auth
                @if(!$reply->hasLiked())
                <form action="{{ route('like', ['id' => $reply->id]) }}" method="post" class="d-inline">
                    {{ csrf_field() }}
                    <button class="btn btn-success btn-sm pull-right">Like</button>
                </form>
                @else
                    <form action="{{ route('dislike', ['id' => $reply->id]) }}" method="post" class="d-inline">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger btn-sm pull-right">Dislike</button>
                    </form>
                @endif

                @if(Auth::user()->id == $reply->user_id or Auth::user()->admin == 1)

                    <a href="{{ route('reply.edit',['id' => $reply->id]) }}" class="btn btn-outline-secondary btn-sm pull-right">Edit</a>
                    <form action="{{ route('reply.destroy',['id' => $reply->id]) }}" method="post" class="d-inline">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-outline-danger btn-sm pull-right">Delete</button>
                    </form>

                @endif

                @if(Auth::id() == $reply->discussion->user_id)
                    @isset($reply->discussion->best_reply)
                        @if($reply->discussion->best_reply == $reply->id)
                            <form action="{{ route('remove_best_reply',['did' => $reply->discussion_id]) }}" method="post" class="d-inline">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="btn btn-warning btn-sm pull-right">NotBest</button>
                            </form>
                        @endif
                    @else
                        <a href="{{ route('best_reply',['did' => $reply->discussion_id, 'rid' => $reply->id]) }}" class="btn btn-outline-success btn-sm pull-right">Best</a>
                    @endisset
                @endif
            @endauth


        </div>
    </div>
    <br>
@endforeach
