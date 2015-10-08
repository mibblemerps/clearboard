<?php

namespace app\Themes;

class Theme {
    /**
     * @var string Human readable name of theme
     */
    public $themename;

    /**
     * @var string Version number
     */
    public $version;

    /**
     * @var string Vendor or author of the theme
     */
    public $vendor;

    /**
     * @var string Description of the theme
     */
    public $description;

    /**
     * @var string Theme license (eg. MIT, GPLv3, BSD, etc..)
     */
    public $license;

    /**
     * Generate Theme object from a theme metadata file.
     * @param $json
     * @return Theme
     */
    public static function fromJSON($json)
    {
        $metadata = json_decode($json);

        // Create theme object with populated metadata
        $theme = new Theme();
        $theme->themename = isset($json->themename) ? $json->themename : null;
        $theme->version = isset($json->version) ? $json->version : null;
        $theme->vendor = isset($json->vendor) ? $json->vendor : null;
        $theme->description = isset($json->description) ? $json->description : '';
        $theme->license = isset($json->license) ? $json->license : 'All rights reserved';

        return $theme;
    }
} 