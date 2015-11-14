<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use cebe\markdown\GithubMarkdown;

class MarkdownController extends Controller
{
    /**
     * Parser instance
     * @var GithubMarkdown
     */
    protected $parser;

    public function __construct()
    {
        // Init the parser
        $this->parser = new GithubMarkdown();
        $this->parser->html5 = true;
        $this->parser->enableNewlines = true;
    }

    /**
     * Parse markdown into HTML.
     * @param Request $request
     * @return string Generated HTML
     */
    public function postParse(Request $request)
    {
        $markdown = htmlentities($request->input('markdown'));
        return $this->parser->parse($markdown);
    }

    /**
     * Parse markdown to HTML, similar to postParse, except online inline elements are accepted. This is good for
     * one-line descriptions and such, but bad for bodies of text, i.e. posts.
     * @param Request $request
     * @return string
     */
    public function postInlineParse(Request $request)
    {
        $markdown = htmlentities($request->input('markdown'));
        return $this->parser->parseParagraph($markdown);
    }
}
