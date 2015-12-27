<?php

namespace app\Themes;

/**
 * Theme not found exception
 *
 * @package app\Themes
 */
class ThemeNotFoundException extends \Exception {
    public function __construct($message = 'The selected theme does not exist', $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
} 