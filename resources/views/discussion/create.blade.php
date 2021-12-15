@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header text-center">Create A New Discussion</div>

    <div class="card-body">
        <form action="{{ route('discussion.store')}}" method="POST">
            @csrf

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title')}}" placeholder="Enter Your Title">
            </div>

            <div class="form-group">
                <label for="channel_id"> Pick A Channel</label>

                <select name="channel_id" id="channel_id" class="form-control">

                    @foreach($channels as $channel)
                    <option value="{{ $channel->id }}">{{ $channel->title }}</option>
                    @endforeach

                </select>
            </div>

            <div class="form-group">
                <label for="content">Ask A Question</label>
                <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{ old('content')}}</textarea>
            </div>

            <div class="form-group">
                <button class="btn btn-success float-right" type="submit"> Create A Discussion </button>
            </div>

        </form>
    </div>
</div>

@endsection
