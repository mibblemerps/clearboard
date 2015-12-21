<div class="listing-entry">
    <img src="{{ theme_asset('img/unread.png') }}" alt="" class="listing-forum-icon">
    <div>
        <div class="listing-entry-name">
            <a href="{{ $thread->getUserFriendlyURL() }}">{{ $thread->name }}</a>
        </div>
        <br>
        <div class="listing-entry-desc">
            <div class="listing-entry-left">
                Started by <strong>{{ $thread->getPoster()->name }} </strong>
            </div>
        </div>
    </div>
    <div class="listing-entry-right">
        <div class="thread-stat">
            <span>{{ count($thread->posts) }}</span><br>
            Replies
        </div>

        <div class="thread-lastpost">
            <img src="{{ $thread->getLatestPost()->poster->getAvatarUrl() }}">
            <div class="thread-lastpost-info">
                <span class="thread-lastpost-name">{{ $thread->getLatestPost()->poster->name }}</span><br>
                <span class="thread-lastpost-when">Posted {{ format_time($thread->getLatestPost()->created_at->timestamp) }}</span>
            </div>
        </div>
    </div>
</div>