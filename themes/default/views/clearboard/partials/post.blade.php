<div class="post">
    <div class="post-left">
        @include('clearboard.partials.thread-userpane')
    </div>
    <div class="post-right">
        <div class="post-timestamp">Posted {{ format_time($post->created_at->timestamp) }}</div>
        <div class="post-content">{{ $post->body }}</div>
    </div>
    <br class="clear">
</div>