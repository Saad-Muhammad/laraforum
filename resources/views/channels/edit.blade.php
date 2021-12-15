@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">Edit Channel: {{ $channel->title}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{route('channels.update', ['channel' => $channel->id ])}}" method="POST">
                                    @csrf
                            {{ method_field('PUT') }}

                        <div class="form-group">

                            <input type="text" name="channel" class="form-control" value="{{ $channel->title}}">
                        </div>

                        <div class="form-group">
                            <div class="text-center">
                                 <input type="submit" class="btn btn-success" value="Update Channel">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
