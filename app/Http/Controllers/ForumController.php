<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
Use App\Forum;

class ForumController extends Controller
{
    /**
     * Get forum page (a listing of containing threads)
     * @param integer $fid Forum ID
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function getForum($fid)
    {
        $forum = Forum::where('id', $fid)->first();

        if ($forum->type == 0) {
            // Viewing standard forum
            return view('clearboard.pages.forum', ['forum' => $forum]);

        } elseif ($forum->type == 1) {
            // Viewing category
            // @TODO implement viewing of categories
            abort(501); // Not Implemented

        } elseif ($forum->type == 2) {
            // Viewing redirect
            $redirect = $forum->meta;
            return redirect($redirect);

        }
    }
}
