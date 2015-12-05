<?php


namespace App\PostProcessor;


class PostProcessor
{
    /**
     * Array of filter classes to be applied to posts
     * @var array
     */
    public static $filters = [
        \App\PostProcessor\FilterYoutube::class,
        //\App\PostProcessor\FilterCensor::class,
        \App\PostProcessor\FilterCleanHTML::class,
        \App\PostProcessor\FilterMarkdown::class
    ];

    /**
     * Array of filters which have been initiated.
     * @var \app\PostProcessor\Filter[]
     */
    public static $filterInstances = [];

    /**
     * Register a new filter.
     * @param string $filter Fully qualified path to class (eg. \App\Foo\Bar\FilterBaz::class)
     * @param boolean $alreadyListed Is the class name already listed in the internal filters array. Almost always leave this as default.
     */
    public static function registerFilter($filter, $alreadyListed = false)
    {
        if (!$alreadyListed) {
            self::$filters[] = $filter;
        }

        self::$filterInstances[] = new $filter();
    }

    /**
     * Run the input through the preprocess filters.
     * @param string $post Text to be processed
     * @return string Result
     */
    public static function preProcess($post)
    {
        foreach (self::$filterInstances as $filter) {
            $process = $filter->preProcess($post);
            if ($process !== null) { // only modify post if the processor actually returned something
                $post = $process;
            }
        }
        return $post;
    }

    /**
     * Run the input through the postprocess filters.
     * @param string $post Text to be processed
     * @return string Result
     */
    public static function postProcess($post)
    {
        foreach (self::$filterInstances as $filter) {
            $process = $filter->postProcess($post);
            if ($process !== null) { // only modify post if the processor actually returned something
                $post = $process;
            }
        }
        return $post;
    }

    /**
     * Perform init process, load filters.
     */
    public static function init()
    {
        // Register currently listed filters
        foreach (self::$filters as $filter) {
            self::registerFilter($filter);
        }
    }
}