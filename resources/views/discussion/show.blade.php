@extends('layouts.app')

@section('content')

    <div class="card">

        <div class="card-header">
            <img src="{{ asset($d->users->avatar) }}" alt="{{ $d->users->name }}" width="40px" height="40px">&nbsp;&nbsp;
            <apan> <b>{{ $d->users->name }}</b> </span>
            <span><i>( {{ $d->users->points}} points)</i></span>

            @if(!$d->hasBestAnswer())
                @if(Auth::id() == $d->users->id)
                    <a href="{{ route('discussion.edit' , ['id' => $d->id ])}}" class="btn btn-outline-primary btn-sm float-right ml-1">
                    Edit
                    </a>
                @endif
            @endif

            @if($d->hasBestAnswer())
                    <span class="btn btn-outline-success btn-sm float-right ml-1">Closed</span>
                @else
                     <span class="btn btn-outline-danger btn-sm float-right ml-1">Open</span>
            @endif

            @if($d->is_being_watched_by_auth_user())
                <a href="{{ route('discussion.unwatch' , ['id' => $d->id])}}" class="btn btn-outline-dark btn-sm float-right">
                    Unwatch
                </a>
            @else
                <a href="{{ route('discussion.watch' , ['id' => $d->id])}}" class="btn btn-outline-dark btn-sm float-right">
                    Watch
                </a>
            @endif
        </div>

        <div class="card-body">
        <h4 class="card-title text-center"><b> {{ $d->title}}</b></h4>
            <hr>

        <p class="card-text text-center">{{ $d->content }}</p>
        </div>

        <hr>

        @if($best_ans)
            <div class="row  d-flex justify-content-center">
                <h4 class="">Best Answer!</h4>
                <div class="col-12 d-flex justify-content-center">
                    <div class="card border-success mb-3" style="width: 70%;">
                        <div class="card-header text-center text-white bg-success"><img src="{{ asset($best_ans->user->avatar) }}" alt="{{ $d->users->name }}" width="40px" height="40px">&nbsp;&nbsp;
                            <apan> <b>{{ $best_ans->user->name }}</b>, <i>( {{ $best_ans->user->points}} points)</i> </span>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-text text-center">{{$best_ans->reply}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        @endif


        <div class="card-footer">
            <span class="badge badge-dark">{{ $d->replies->count()}}</span> Replies
            <a href="{{ route('channel' , ['slug' => $d->channel->slug])}}" class="btn btn-dark btn-sm float-right">{{ $d->channel->title}}</a>
        </div>
    </div>
<br>
<hr>
<br>
    @foreach($d->replies as $r)
        <div class="card">

            <div class="card-header">
                <img src="{{ asset($r->user->avatar) }}" alt="{{ $r->user->name }}" width="40px" height="40px">&nbsp;&nbsp;

                <apan> <b>{{ $r->user->name }}</b> </span>

                <span ><i>( {{ $r->user->points}} points)</i></span>

                @if(!$r->best_answer)
                    @if(Auth::id() == $r->user->id)
                        <a href="{{ route('reply.edit' , ['id' => $r->id ])}}" class="float-right btn btn-sm btn-primary ml-1">Edit</a>
                    @endif
                @endif

                @if(!$best_ans)
                    @if(Auth::id() == $d->users->id)
                        <a href="{{ route('reply.best' , ['id' => $r->id ])}}" class="float-right btn btn-sm btn-success">Mark as Best Answer</a>
                    @endif
                @endif

            </div>

            <div class="card-body">
            <h4 class="card-title text-center"><b> {{ $r->title}}</b></h4>

            <p class="card-text">{{ $r->reply }}</p>
            </div>

            <div class="card-footer">
              @if(Auth::check())
                @if($r->is_liked_by_auth_user())
                    <a href="{{ route('reply.unlike' , ['id' => $r->id ])}}" class="btn btn-danger btn-sm">Unlike <span class="badge badge-light">{{$r->likes->count()}}</span></a>
                @else
                <a href="{{ route('reply.like' , ['id' => $r->id ])}}" class="btn btn-primary btn-sm">Like <span class="badge badge-light">{{$r->likes->count()}}</span></a>
                @endif
              @endif

            </div>
        </div>
        <br>
    @endforeach
<br>
    <div class="card">
        <div class="card-body">
            @if(Auth::check())
            <form action="{{ route('discussion.reply' , ['id' => $d->id ])}}" method="post">
                @csrf

                <div class="form-group">
                    <textarea name="reply" id="reply" class="form-control" placeholder="Type Your Reply.........."></textarea>
                </div>

                <div class="form-group text-center">
                    <button class="btn btn-success" type="submit">Leave A Reply</button>
                </div>
            </form>
            @else

                <a href="{{route('login')}}" class=" form-control btn btn-primary" type="submit">Sign In To Leave A Reply</a>

            @endif
        </div>
    </div>
@endsection
