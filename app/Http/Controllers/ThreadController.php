<?php

namespace App\Http\Controllers;

use App\Forum;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Thread;
use App\Post;
use Illuminate\Http\Response;

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

    /**
     * New thread (not the create thread page)
     * @param Request $request
     * @return string
     */
    public function newThread(Request $request)
    {
        // Validate input
        $this->validate($request, [
            'title' => 'required|max:255',
            'forum' => 'required|numeric',
            'body' => 'required|max:30000'
        ]);

        // Verify forum is a valid forum that can be posted in
        $forum = null;
        try {
            $forum = Forum::findOrFail($request->input('forum'));
        } catch (ModelNotFoundException $e) {
            abort(400); // 400 Bad Request - invalid forum id
        }
        if ($forum->type != 0) {
            abort(400); // 400 Bad Request - not correct forum type
        }

        // Create thread
        $thread = Thread::newThread(
            $request->input('title'),
            $request->input('forum')
        );

        // Create opening post
        $post = post::newPost($request->input('body'), $thread->id);

        // Generate response
        $resp = new Response(
            json_encode([
                'status' => true,
                'link' => $thread->getUserFriendlyURL()
            ]),
            200 // 200 OK
        );
        $resp->header('Content-Type', 'application/json');

        return $resp;
    }

    /**
     * Create thread page
     * @param integer $forumid Forum ID
     * @return \Illuminate\View\View
     */
    public function createThread($forumid)
    {
        $forum = Forum::findOrFail($forumid);
        return view('clearboard.pages.newthread', ['forum' => Forum::find($forumid)]);
    }
}
