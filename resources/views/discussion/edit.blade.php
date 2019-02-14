@extends('layouts.app')

@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Update: {{ $discussion->title }}</div>

            <div class="card-body">
                <form action="{{ route("discussion.update", ['discussion' => $discussion->id]) }}" method="post">

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="form-group">
                        <label for="content">content</label>
                        <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{ $discussion->content }}</textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
