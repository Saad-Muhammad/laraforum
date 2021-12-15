@extends('layouts.app')

@section('content')

<div class="card">
<div class="card-header text-center">Update : {{ $discussion->title }}</div>

    <div class="card-body">
        <form action="{{ route('discussion.update' , ['id' => $discussion->id ])}}" method="POST">
            @csrf

            <div class="form-group">
                <label for="content">Ask A Question</label>
                <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{ $discussion->content }}</textarea>
            </div>

            <div class="form-group">
                <button class="btn btn-success float-right" type="submit"> Update Discussion </button>
            </div>

        </form>
    </div>
</div>

@endsection
