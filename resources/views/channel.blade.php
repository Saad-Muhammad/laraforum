@extends('layouts.app')

@section('content')

@foreach($discussions as $d)
    <div class="card">

            <div class="card-header">
                <img src="{{ asset($d->users->avatar) }}" alt="{{ $d->users->name }}" width="40px" height="40px">&nbsp;&nbsp;
            <apan> {{ $d->users->name }} , <b>{{ $d->created_at->diffForHumans()}}</b> </span>

                @if($d->hasBestAnswer())
                    <span class="btn btn-outline-success btn-sm float-right ml-1">Closed</span>
                @else
                     <span class="btn btn-outline-danger btn-sm float-right ml-1">Open</span>
                @endif

                <a href="{{ route('discussion' , ['slug' => $d->slug, 'id' => $d->id])}}" class="btn btn-outline-dark btn-sm float-right">
                    View
                </a>


            </div>

            <div class="card-body">
            <h4 class="card-title text-center"><b> {{ $d->title}}</b></h4>
             <hr>
            <p class="card-text text-center">{{ str_limit($d->content , 150) }}</p>
            </div>

            <div class="card-footer">
                <span class="badge badge-dark">{{ $d->replies->count()}}</span> Replies
                <a href="{{ route('channel' , ['slug' => $d->channel->slug])}}" class="btn btn-dark btn-sm float-right">{{ $d->channel->title}}</a>
            </div>
    </div>
    <br>
@endforeach

    <div class="row justify-content-center">
        <div class="col-4">
            {{ $discussions->links()}}
        </div>
    </div>


@endsection
