<img src="{{ $post->poster()->first()->getAvatarUrl() }}" alt="" class="post-avatar">
<div class="post-username">{!! $post->poster()->first()->getStyledUsername() !!}</div>