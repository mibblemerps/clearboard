<?php

namespace App\Http\Controllers;

use App\Post;
use App\Thread;
use App\Facades\PostProcessor;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Create a new post.
     *
     * @param Request $request
     * @return array
     * @throws \Exception
     * @throws \Throwable
     */
    public function apiCreate(Request $request)
    {
        // Validate input
        $this->validate($request, [
            'thread' => 'numeric|exists:threads,id',
            'body' => 'string|min:1|max:2000'
        ]);

        // Collect input
        $threadid = $request->input('thread', 0);
        $thread = Thread::find($threadid);
        $content = $request->input('body', '');

        // Check for authorization.
        if (!$request->user()->hasPermissionNode('cb.post.create')) {
            abort(403); // 403 Forbidden
        }

        // Run post through filters
        $content = PostProcessor::preProcess($content);

        // Create new post
        $post = Post::newPost($content, $threadid);

        // Response
        return [
            'status' => true,
            'html' => $post->getPostView()->render() // return html of post so it can be embedded into page
        ];
    }
}
