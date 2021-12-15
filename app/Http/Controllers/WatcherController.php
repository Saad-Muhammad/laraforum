<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Discussion;
use App\Watcher;
use Illuminate\Http\Request;

class WatcherController extends Controller
{

    public function watch($id)
    {
        Watcher::create([
            'discussion_id' => $id ,
            'user_id' => Auth::id()
        ]);

        Session::flash('info' , 'You Marked This Discuusion in your Watchers List.');

        return redirect()->back();
    }


    public function unwatch($id)
    {
        $watcher = Watcher::where(['discussion_id' => $id , 'user_id' => Auth::id()]);

        $watcher->delete();

        Session::flash('info' , 'You Unmarked this from your watchers list.');

        return redirect()->back();
    }

}
