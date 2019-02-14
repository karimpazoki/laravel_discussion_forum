@extends('layouts.app')

@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Edit your Reply</div>

            <div class="card-body">
                @if(Auth::check())
                    <form action="{{ route("reply.update",['id' => $reply->id]) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="content">content</label>
                            <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{ $reply->content }}</textarea>
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
        </div>
    </div>
@endsection