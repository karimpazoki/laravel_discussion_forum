<div class="card">
    @if($discussion->close)
        <div class="card-header text-center h5 bg-info text-white">The discussion is closed.</div>
    @else
        <div class="card-header">Reply to this discussion</div>

        <div class="card-body">
            @if(Auth::check())
                <form action="{{ route("reply.store",['id' => $discussion->id]) }}" method="post">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="content">content</label>
                        <textarea class="form-control" name="content" id="content" cols="30" rows="10"></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Reply</button>
                    </div>
                </form>
            @else
                <div class="text-center">
                    <a href="{{ route('login')}}" class="btn btn-primary">Login to reply</a>
                </div>
            @endif

        </div>
    @endif
</div>