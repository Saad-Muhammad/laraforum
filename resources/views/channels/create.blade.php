@extends('layouts.app')

@section('content')

            <div class="card">
                <div class="card-header">Create A New Channel</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{route('channels.store')}}" method="POST">
                            @csrf
                        <div class="form-group">

                            <input type="text" name="channel" class="form-control">
                        </div>

                        <div class="form-group">
                            <div class="text-center">
                                 <input type="submit" class="btn btn-success" value="Save Channel">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
@endsection
