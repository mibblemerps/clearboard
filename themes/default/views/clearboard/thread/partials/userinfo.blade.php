<img src="{{ $post->poster()->first()->getAvatarUrl() }}" alt="" class="post-avatar">
<div class="post-username">{!! $post->poster()->first()->getStyledUsername() !!}</div>
@if($post->poster()->first()->hasBadge())
    <img class="post-badge" src="{!! $post->poster()->first()->getBadge() !!}" alt="{{ $post->poster()->first()->group->name }}">
@endif