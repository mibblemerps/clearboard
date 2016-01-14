<img src="{{ $post->poster->getAvatarUrl() }}" alt="" class="post-avatar">
<div class="post-username">{!! $post->poster->getStyledUsername() !!}</div>
@if($post->poster->hasBadge())
    <img class="post-badge" src="{!! $post->poster->getBadge() !!}" alt="{{ $post->poster->group->name }}">
@endif