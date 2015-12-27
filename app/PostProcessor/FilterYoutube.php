<?php

namespace App\PostProcessor;

/**
 * Adds YouTube embed capabilities.
 *
 * @package App\PostProcessor
 */
class FilterYoutube implements Filter
{
    public function getName()
    {
        return 'YouTube';
    }

    /**
     * Replaces Youtube links with videos.
     * Full credit for the function goes to http://stackoverflow.com/a/6649855/3764348
     * @param $text
     * @return mixed
     */
    protected function embedYoutube($text)
    {
        $search = '~
        # Match non-linked youtube URL in the wild. (Rev:20130823)
        (?:https?://)?    # Optional scheme.
        (?:[0-9A-Z-]+\.)? # Optional subdomain.
        (?:               # Group host alternatives.
          youtu\.be/      # Either youtu.be,
        | youtube         # or youtube.com or
          (?:-nocookie)?  # youtube-nocookie.com
          \.com           # followed by
          \S*             # Allow anything up to VIDEO_ID,
          [^\w\s-]        # but char before ID is non-ID char.
        )                 # End host alternatives.
        ([\w-]{11})       # $1: VIDEO_ID is exactly 11 chars.
        (?=[^\w-]|$)      # Assert next char is non-ID or EOS.
        (?!               # Assert URL is not pre-linked.
          [?=&+%\w.-]*    # Allow URL (query) remainder.
          (?:             # Group pre-linked alternatives.
            [\'"][^<>]*>  # Either inside a start tag,
          | </a>          # or inside <a> element text contents.
          )               # End recognized pre-linked alts.
        )                 # End negative lookahead assertion.
        [?=&+%\w.-]*      # Consume any URL (query) remainder.
        ~ix';

        /*$replace = '<object width="425" height="344">
        <param name="movie" value="http://www.youtube.com/v/$1?fs=1"</param>
        <param name="allowFullScreen" value="true"></param>
        <param name="allowScriptAccess" value="always"></param>
        <embed src="http://www.youtube.com/v/$1?fs=1"
            type="application/x-shockwave-flash" allowscriptaccess="always" width="425" height="344">
        </embed>
        </object>';*/

        $replace = '<iframe src="https://www.youtube.com/embed/$1" style="border:none;" width="480" height="320"></iframe>';

        return preg_replace($search, $replace, $text);
    }

    public function preProcess($post)
    {
        //
    }

    public function postProcess($post)
    {
        // Convert YouTube links to embed videos.
        return $this->embedYoutube($post);
    }
}