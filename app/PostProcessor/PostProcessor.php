<?php


namespace App\PostProcessor;


class PostProcessor
{
    /**
     * Array of filter class names to be loaded
     * @var string[]
     */
    protected $filters = [];

    /**
     * Array of filters which have been initiated.
     * @var \app\PostProcessor\Filter[]
     */
    protected $filterInstances = [];

    /**
     * Register a new filter.
     * @param string $filter Fully qualified path to class (eg. \App\Foo\Bar\FilterBaz::class)
     * @param boolean $alreadyListed Is the class name already listed in the internal filters array. Almost always leave this as default.
     */
    public function registerFilter($filter, $alreadyListed = false)
    {
        if (!$alreadyListed) {
            $this->filters[] = $filter;
        }

        $this->filterInstances[] = new $filter();
    }

    /**
     * Run the input through the preprocess filters.
     * @param string $post Text to be processed
     * @return string Result
     */
    public function preProcess($post)
    {
        foreach ($this->filterInstances as $filter) {
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
    public function postProcess($post)
    {
        foreach ($this->filterInstances as $filter) {
            $process = $filter->postProcess($post);
            if ($process !== null) { // only modify post if the processor actually returned something
                $post = $process;
            }
        }
        return $post;
    }

    /**
     * Create new post processor
     * @param string $filters Filters to be used
     */
    public function __construct($filters)
    {
        $this->filters = array_merge($this->filters, $filters);

        // Load filters
        foreach ($this->filters as $filter) {
            $this->registerFilter($filter);
        }
    }
}