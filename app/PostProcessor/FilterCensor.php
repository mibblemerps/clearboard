<?php

namespace app\PostProcessor;

/**
 * Censors particular words.
 * @TODO this thing sucks. Needs to be redone.
 *
 * @package app\PostProcessor
 */
class FilterCensor implements Filter
{
    public function getName()
    {
        return 'Word Censor';
    }

    /**
     * List of words to be filtered
     *
     * @var string[]
     */
    public $words = [
        'test'
    ];

    public function preProcess($post)
    {
        //
    }

    public function postProcess($post)
    {
        // Censor any curse words.
        foreach ($this->words as $word) {
            $replaceWith = str_repeat('*', strlen($word));
            return str_replace($word, $replaceWith, $post);
        }

        return $post;
    }
}