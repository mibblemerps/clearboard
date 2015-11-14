
@section('head')
    Test
@endsection

<h2>Post Reply</h2>
<div class="post">
    <div class="post-left">
        <img src="{{ $post->poster()->first()->avatarUrl() }}" alt="" class="post-avatar">
    </div>
    <div class="post-right">
        <div class="post-content">
            <div id="postreply-wrapper">
                <textarea id="postreply"></textarea>
            </div>
        </div>
    </div>
    <br class="clear">
</div>