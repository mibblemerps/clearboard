@if (config('app.debug'))
    <p id="debuginfo">
        <?php
            // Git HEAD
            if (function_exists('exec')) {
                $githead = exec('git rev-parse --short=7 HEAD');
                echo "<span><strong>Git HEAD: </strong> <em>$githead</em> </span>";
            }

            // Script execution time
            $executiontime = round(microtime(true) - SCRIPT_START, 4);
            echo "<span><strong>Generated in: </strong> <em>{$executiontime}s</em> </span>";
        ?>
    </p>
@endif
