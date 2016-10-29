<?php

if (!function_exists('joinPath')) {
    /**
     * Combines filesystem paths.
     * Accepts unlimited number of arguments in the form of strings.
     *
     * @return string
     */
    function joinPath() { // Credit - http://stackoverflow.com/a/1091219/3764348
        $args = func_get_args();
        $paths = array();
        foreach ($args as $arg) {
            $paths = array_merge($paths, (array)$arg);
        }

        $paths = array_map(create_function('$p', 'return trim($p, "/");'), $paths);
        $paths = array_filter($paths);
        return join('/', $paths);
    }
}

if (!function_exists('theme_path')) {
    /**
     * Returns the base path of the theme's personal asset directory.
     * Similar to Laravel's *_path() functions, a path argument can be supplied to produce a full path.
     * WARNING! Does not return URL! Use theme_asset() for getting theme asset urls.
     *
     * @param string $path Optional. Path to resource.
     * @param string|null $theme Name of theme. If left null, will use current theme.
     * @return string
     */
    function theme_path($path = '', $theme = null)
    {
        if ($theme == null) {
            $theme = config('clearboard.theme');
        }

        return app_path() . "/assets/$theme/" . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (!function_exists('theme_asset')) {
    /**
     * Identical behaviour to Laravel's inbuilt asset() helper function, except returns assets from a theme's personal
     * asset directory.
     *
     * @param $path
     * @param null $secure
     * @param null $theme
     * @return string
     */
    function theme_asset($path, $secure = null, $theme = null)
    {
        if ($theme == null) {
            $theme = config('clearboard.theme');
        }

        return asset("assets/$theme/" . $path, $secure);
    }
}