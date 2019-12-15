@extends("master.layout")

@section("container")

    <ul>
        <li><a href="/profile/edit">Edit Profile</a></li>
        @if(\App\Helpers\Helper::isEditor() or \App\Helpers\Helper::isAdmin())
            <li><a href="/post">Posts</a></li>
        @endif
    </ul>

    <h1>VIEW PROFILE</h1>

    <hr>

    <ul>
        <li>Id -        <b>{{ $user->id }}</b></li>
        <li>Статус -    <b>{{ $user->Role->role_name }}</b></li>
        <li>Имя -       <b>{{ $user->name }}</b></li>
        <li>Email -     <b>{{ $user->email }}</b></li>
        <li>Постов -    <b>{{ count($user->Posts) }}</b></li>
    </ul>

    @if($user->invite != null && $user->invite != "no")

        <h1>Вас приглашают в редакторы</h1>
        <hr>
        <button class="btn btn-success" onclick="javascript:window.location.href='/profile/invite/yes';"> Принять  </button>
        <button class="btn btn-danger" onclick="javascript:window.location.href='/profile/invite/no';"> Отклонить  </button>

    @endif

@endsection
