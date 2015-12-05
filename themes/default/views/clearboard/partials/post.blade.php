<div class="post">
    <div class="post-left">
        @include('clearboard.partials.thread-userpane')
    </div>
    <div class="post-right">
        <div class="post-content">
            <div class="post-timestamp">Posted {{ format_time($post->created_at->timestamp) }}</div>
            {!! $post->getBody() !!}
        </div>
    </div>
    <br class="clear">
</div>