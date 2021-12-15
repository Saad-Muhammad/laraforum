<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Notification;
use App\User;
use App\Reply;
use App\Watcher;
use App\Discussion;
use Illuminate\Http\Request;

class DiscussionsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('discussion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'channel_id' => 'required',
            'content' => 'required'
        ]);

        $discussion = Discussion::create([
            'title' => $request->title ,
            'channel_id' => $request->channel_id ,
            'content' => $request->content,
            'user_id' => Auth::id(),
            'slug' => str_slug($request->title)
        ]);

        Session::flash('success' , 'Discussion Created');

        return redirect()->route('discussion', ['slug' => $discussion->slug , 'id' => $discussion->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug , $id)
    {
        $discussion = Discussion::find($id);

        $bestAns = $discussion->replies()->where('best_answer' , 1)->first();

        return view('discussion.show')->with('d', $discussion)
                                      ->with('best_ans' , $bestAns);


    }

    public function reply($id)
    {
        $d = Discussion::find($id);

        $reply = Reply::create([
            'user_id' => Auth::id(),
            'discussion_id' => $id,
            'reply' => request()->reply
        ]);

        $reply->user->points += 25;
        $reply->user->save();


        Watcher::create([
            'discussion_id' => $id ,
            'user_id' => Auth::id()
        ]);

        //Notifications Mail Functionality

                // $watchers = [];

                // foreach($d->watchers as $watcher){
                //     array_push($watchers, User::find($watcher->user_id));
                // }

                // Notification::send($watchers, new \App\Notifications\NewReplyAdded($d));

        //Notifications Mail


        Session::flash('success' , 'Replied');

        return redirect()->back();
    }

    public function edit($id){

        return view('discussion.edit')->with('discussion', Discussion::find($id));
    }

    public function update(Request $request, $id){

        $this->validate($request, [
            'content' => 'required'
        ]);

        $d = Discussion::find($id);

        $d->content = $request->content;

        $d->save();

        Session::flash('success' , 'Discussion Updated');

        return redirect()->route('discussion', ['slug' => $d->slug , 'id' => $d->id]);

    }
}
