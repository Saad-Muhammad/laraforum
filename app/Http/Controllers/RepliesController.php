<?php

namespace App\Http\Controllers;


use Session;
use Auth;
use App\LIke;
use App\Reply;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    // Like And Unlike Functionality

    public function like($id)
    {
        Like::create([
            'reply_id' => $id,
            'user_id' => Auth::id()
        ]);

        Session::flash('success' , 'Liked');

        return redirect()->back();
    }


    public function unlike($id)
    {
        $like = Like::where(['reply_id' => $id , 'user_id' => Auth::id()])->first();

        $like->delete();

        Session::flash('success' , 'Unliked');

        return redirect()->back();
    }

    public function bestAnswer($id){
        $reply = Reply::find($id);

        $reply->best_answer = 1 ;
        $reply->user->points += 100;
        $reply->user->save();
        $reply->save();

        Session::flash('success' , 'Marked As The Best Answer.');

        return redirect()->back();
    }


    public function edit($id){

        return view('replies.edit')->with('reply' , Reply::find($id));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request , [
            'reply' => 'required'
        ]);

        $reply = Reply::find($id);

        $reply->reply = $request->reply;

        $reply->save();

        Session::flash('success' , 'Reply Updated');

        return redirect()->route('discussion', ['slug' => $reply->discussion->slug , 'id' => $reply->discussion->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
