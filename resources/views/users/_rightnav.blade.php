<ul class="nav nav-tabs nav-justified">
    <li role="presentation" class="{{ classActiveSegment(3, null) }}"><a href="/user/{{ $user->id }}">Home</a></li>
    <li role="presentation" class="{{ classActiveSegment(3, 'articles') }}"><a href="/user/{{ $user->id }}/articles">article</a></li>
    <li role="presentation" class="{{ classActiveSegment(3, 'collects') }}"><a href="/user/{{ $user->id }}/collects">Collection</a></li>
    <li role="presentation" class="{{ classActiveSegment(3, 'follows') }}"><a href="/user/{{ $user->id }}/follows">attention</a></li>
    <li role="presentation" class="{{ classActiveSegment(3, 'fans') }}"><a href="/user/{{ $user->id }}/fans">Fan</a></li>
    @if($currentUser && $user->id == $currentUser->id)
        <li role="presentation" class="{{ classActiveSegment(3, 'trash') }}"><a href="/user/{{ $user->id }}/trash">Recycle bin</a></li>
        <li role="presentation" class="{{ classActiveSegment(3, 'notifications') }}"><a href="/user/{{ $user->id }}/notifications">Notifications <span class="badge @if(App\User::noticeCount())grow bg-danger @endif">{{App\User::noticeCount()}}</span></a></li>
    @endif
</ul>