<div class="listing-entry">
    <img src="{{ theme_asset('img/unread.png') }}" alt="" class="listing-forum-hasread">
    <div>
        <div class="listing-entry-name">
            <a href="{{ url('thread/' . $thread->id . '-' . urlencode(str_replace(' ', '_', $thread->name))) }}">{{ $thread->name }}</a>
        </div>
        <br>
        <div class="listing-entry-desc">
            Started by <strong>{{ $thread->getPoster()->name }} </strong>
        </div>
    </div>
</div>