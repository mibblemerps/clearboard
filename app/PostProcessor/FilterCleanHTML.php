<?php

namespace App\PostProcessor;

/**
 * Converts any dangerous HTML into HTML entities to prevent XSS or unwanted HTML content.
 *
 * @package App\PostProcessor
 */
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