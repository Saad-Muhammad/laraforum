@extends('layouts.app')

@section('content')

<div class="card">
<div class="card-header text-center">Update Your Reply</div>

    <div class="card-body">
        <form action="{{ route('reply.update' , ['id' => $reply->id ])}}" method="POST">
            @csrf

            <div class="form-group">
                <label for="content">Reply</label>
                <textarea name="reply" id="reply" cols="30" rows="10" class="form-control">{{ $reply->reply }}</textarea>
            </div>

            <div class="form-group">
                <button class="btn btn-success float-right" type="submit">Update Reply</button>
            </div>

        </form>
    </div>
</div>

@endsection
