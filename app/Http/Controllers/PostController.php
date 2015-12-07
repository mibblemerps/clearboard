<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostProcessor\PostProcessor;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function newPost(Request $request)
    {
        // Collect input
        $threadid = $request->input('thread', 0);
        $content = $request->input('body', '');
        if (($content == '') || ($threadid == 0)) {
            abort(400); // 400 Bad Request
        }

        // Run post through filters
        $content = PostProcessor::preProcess($content);

        // Create new post
        $post = Post::newPost($threadid, $content);

        // Generate response
        $resp = new Response(
            json_encode([
                'status' => true,
                'html' => $post->getPostView()->render() // return html of post so it can be embeded into page
            ]),
            200 // 200 OK
        );
        $resp->header('Content-Type', 'application/json');

        return $resp;
    }
}
