@if (Auth::check())
    <div id="postreply">
        <img src="{{ Auth::user()->avatarUrl() }}" id="postreply-icon">
        <h2 id="postreply-header">Post Reply</h2>
        <div class="post">
            <div id="postreply-wrapper">
                <textarea id="postreply-box"></textarea>
            </div><br>
            <span id="postreply-submit" class="button button-dark">Post Reply</span>
        </div>
    </div>
@endif