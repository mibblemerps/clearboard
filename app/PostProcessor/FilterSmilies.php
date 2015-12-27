<?php

namespace App\PostProcessor;

use App\PostProcessor\Filter;

class FilterSmilies implements Filter
{
    /**
     * Translation table for converting smiley notation into actual smilies.
     *
     * @var string[]
     */
    public $smiliesTable = [
        ':)' => 'smile.svg',
        '-_-' => 'straight.svg',
        '._.' => 'straight.svg',
        ':P' => 'tounge.svg',
        '8)' => 'sunnies.svg',
    ];

    public function getName()
    {
        return 'Smilies';
    }

    public function preProcess($post)
    {
        //
    }

    public function postProcess($post)
    {
        foreach ($this->smiliesTable as $notation => $smiley) {
            $smileyUrl = asset('smilies/' . $smiley);
            $post = str_replace($notation, "<img src='$smileyUrl' class='emoji' alt='$notation'>", $post);
        }
        return $post;
    }
}