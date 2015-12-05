<?php

namespace App\PostProcessor;

use cebe\markdown\GithubMarkdown;

class FilterMarkdown implements Filter
{
    public function getName()
    {
        return 'Markdown';
    }

    public function preProcess($post)
    {
        //
    }

    public function postProcess($post)
    {
        $parser = new GithubMarkdown();
        $parser->html5 = true;
        $parser->enableNewlines = true;
        $parser->keepListStartNumber = true;

        return $parser->parse($post);
    }
}