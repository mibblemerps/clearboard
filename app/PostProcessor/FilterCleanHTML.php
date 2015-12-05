<?php

namespace App\PostProcessor;


class FilterCleanHTML implements Filter
{
    public function getName()
    {
        return 'XSS Protection';
    }

    public function preProcess($post)
    {
        return htmlentities($post);
    }

    public function postProcess($post)
    {
        //
    }
}