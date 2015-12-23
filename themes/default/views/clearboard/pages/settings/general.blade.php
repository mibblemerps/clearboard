<h2>Profile Picture</h2>
<div class="vertically-aligned">
    <img src="{{ Auth::user()->getAvatarUrl(64) }}" alt="{{ Auth::user()->name }}">
    <span>
        Profile pictures are currently handled through <a href="https://gravatar.com/">Gravatar</a>.
    </span>
</div>