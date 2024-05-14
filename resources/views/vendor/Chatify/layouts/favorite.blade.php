<div class="favorite-list-item">
    {{--  @php  
    $id=Crypt::encryptString($user->id);
    @endphp  --}}
    <div data-id="{{ $user->id }}" data-action="0" class="avatar av-m"
        style="background-image: url('{{ Chatify::getUserWithAvatar($user)->avatar }}');">
    </div>
    <p>{{ strlen($user->name) > 5 ? substr($user->name,0,6).'..' : $user->name }}</p>
</div>
