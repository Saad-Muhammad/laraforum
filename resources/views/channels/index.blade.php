@extends('layouts.app')

@section('content')
            <div class="card">
                <div class="card-header">Channels</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                    <th>Name</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </thead>

                                <tbody>
                                    @foreach($channels as $channel)
                                        <tr>
                                            <td>
                                               {{ $channel->title}}
                                            </td>
                                            <td>
                                            <a href="{{route('channels.edit', ['channel' => $channel->id ])}}" class="btn btn-info btn-sm">Edit</a>
                                            </td>

                                            <td>
                                                <form action="{{route('channels.destroy', ['channel' => $channel->id ])}}" method="POST">
                                                    @csrf
                                                    {{ method_field('DELETE') }}

                                                    <button type="submit" class="btn btn-danger btn-sm"> Delete</button>


                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


@endsection
