<p>
    &copy; Copyright {{ date('Y') }} {{ config('clearboard.sitename') }}. All rights reserved.<br>
    Powered by <a href="https://github.com/clearboard">Clearboard</a>.
</p>
<p>
    <a href="{{ config('clearboard.rules_url') }}"><strong>Board Rules</strong></a> |
    <a href="{{ config('clearboard.tos_url') }}"><strong>Terms of Service</strong></a> |
    <a href="{{ config('clearboard.privacy_url') }}"><strong>Privacy Policy</strong></a>
</p>

@if (config('app.debug'))
    <p id="debuginfo">
        <?php
            // Git HEAD
            if (function_exists('exec')) {
                $githead = exec('git rev-parse --short=7 HEAD');
                echo "<span><strong>Git HEAD: </strong> <em>$githead</em> </span>";
            }
        ?>
    </p>
@endif
