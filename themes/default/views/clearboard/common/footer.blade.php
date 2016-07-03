<footer class="container">
    <p>
        &copy; Copyright {{ date('Y') }} {{ config('clearboard.sitename') }}. All rights reserved.<br>
        Powered by <a href="https://github.com/clearboard">Clearboard</a>.
    </p>
    <p>
        <a href="{{ config('clearboard.rules_url') }}"><strong>Board Rules</strong></a> |
        <a href="{{ config('clearboard.tos_url') }}"><strong>Terms of Service</strong></a> |
        <a href="{{ config('clearboard.privacy_url') }}"><strong>Privacy Policy</strong></a>
    </p>

    @include('clearboard.debug')
</footer>