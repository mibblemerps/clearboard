<?php

/*
 * Global helper functions for formatting time.
 */

/**
 * Minutes within a particular number of seconds.
 *
 * @param $timestamp
 * @return float
 */
function minutes_ago($timestamp)
{
    return floor($timestamp / 60);
}

/**
 * Hours within a particular number of seconds.
 *
 * @param $timestamp
 * @return float
 */
function hours_ago($timestamp)
{
    return floor(minutes_ago($timestamp) / 60);
}

/**
 * Days ago within a particular number of seconds.
 *
 * @param $timestamp
 * @return float
 */
function days_ago($timestamp)
{
    return floor(hours_ago($timestamp) / 24);
}

/**
 * Format a timestamp into a human-readable form.
 * Example: "3 minutes ago", "8 hours ago", "15 days ago", "27 December 2015 3:22 am"
 *
 * @param integer $time Input timestamp
 * @param integer|null $now Reference point for calculating 'time ago'. Defaults to current time.
 * @return string Human readable string representation of time ago.
 */
function format_time($time, $now = null)
{
    $now = is_null($now) ? time() : $now;

    $diff = $now - $time;

    if ($diff < 60) {
        // Less than a minute ago
        return 'moments ago';
    } elseif (minutes_ago($diff) == 1) {
        // A minute ago
        return 'a minute ago';
    } elseif (minutes_ago($diff) < 60) {
        // A few minutes ago
        return minutes_ago($diff) . ' minutes ago';
    } elseif (hours_ago($diff) == 1) {
        return 'an hour ago';
    } elseif (hours_ago($diff) < 24) {
        return hours_ago($diff) . ' hours ago';
    } elseif (days_ago($diff) == 1) {
        // A day ago
        return 'a day ago';
    } elseif (days_ago($diff) < 31) {
        // A few days ago
        return days_ago($diff) . ' days ago';
    } else {
        // Over a week old
        return date(config('clearboard.date_format'), $time);
    }

}
