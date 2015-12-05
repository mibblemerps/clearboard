<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Thread;

class ThreadController extends Controller
{
    /**
     * Get thread page
     * @param integer $tid Thread ID
     * @return \Illuminate\View\View
     */
    public function getThread($tid)
    {
        $thread = Thread::where('id', $tid)->firstOrFail();

        if ($thread->hidden) {
            // Thread hidden, abort request
            abort(403);
        }

        return view('clearboard.pages.thread', ['thread' => $thread]);
    }
}
