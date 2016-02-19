<?php

namespace App\PostProcessor;

/**
 * Post filter. Allows things such as converting YouTube links into embedded videos.
 * Each filter gets a chance to modify a post as it's leaving or entering the database.
 *
 * @package app\PostProcessor
 */
interface Filter
{
    /**
     * Get human readable name of filter.
     *
     * @return string
     */
    public function getName();

    /**
     * Process the post before it's inserted into the database.
     * Good for: filtering unwanted markdown
     *
     * @param string $post Post content
     * @return string
     */
    public function preProcess($post);

    /**
     * Process the post as it's leaving the database to be rendered on the browser.
     * Good for: YouTube embedding
     *
     * @param string $post Post content
     * @return string
     */
    public function postProcess($post);
}