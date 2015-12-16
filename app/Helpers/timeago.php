<?php

/*
 * Global helper functions for formatting time.
 */

/**
 * @param $timestamp
 * @return float
 */
function minutes_ago($timestamp)
{
    return floor($timestamp / 60);
}

function hours_ago($timestamp)
{
    return floor(minutes_ago($timestamp) / 60);
}

function days_ago($timestamp)
{
    return floor(hours_ago($timestamp) / 24);
}



function format_time($time, $now = null)
{
    $now = is_null($now) ? time() : $now;

    $diff = $now - $time;

    if ($diff < 60) {
        // Less than a minute ago
        return 'Moments ago';
    } elseif (minutes_ago($diff) == 1) {
        // A minute ago
        return 'A minute ago';
    } elseif (minutes_ago($diff) < 60) {
        // A few minutes ago
        return minutes_ago($diff) . ' minutes ago';
    } elseif (hours_ago($diff) == 1) {
        return 'An hour ago';
    } elseif (hours_ago($diff) < 24) {
        return hours_ago($diff) . ' hours ago';
    } elseif (days_ago($diff) == 1) {
        // A day ago
        return 'A day ago';
    } elseif (days_ago($diff) < 31) {
        // A few days ago
        return days_ago($diff) . ' days ago';
    } else {
        // Over a week old
        return date(config('clearboard.date_format'), $time);
    }

}
