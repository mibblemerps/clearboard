<div class="forumlisting-forum">
    <img src="{{ theme_asset('img/unread.png') }}" alt="" class="forumlisting-forum-hasread">
    <div>
        <div class="forumlisting-forum-name">
            <a href="{{ url('forum/' . $forum->id . '-' . urlencode(str_replace(' ', '_', $forum->name))) }}">{{ $forum->name }}</a>
        </div>
        <br>
        <div class="forumlisting-forum-desc">
            {{ $forum->description }}
        </div>
    </div>
</div>