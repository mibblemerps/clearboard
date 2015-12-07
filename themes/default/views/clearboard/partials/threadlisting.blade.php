<div class="listing-entry">
    <img src="{{ theme_asset('img/unread.png') }}" alt="" class="listing-forum-hasread">
    <div>
        <div class="listing-entry-name">
            <a href="{{ $thread->getUserFriendlyURL() }}">{{ $thread->name }}</a>
        </div>
        <br>
        <div class="listing-entry-desc">
            Started by <strong>{{ $thread->getPoster()->name }} </strong>
        </div>
    </div>
</div>