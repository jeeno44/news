@extends("master.layout")

@section("container")

    <ul>
        <li><a href="/profile/edit">Edit Profile</a></li>
        <li><a href="/post">Posts</a></li>
    </ul>

    <h1>EDIT PROFILE</h1>

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

    <hr>

    <div class="row">
        <div class="col-6 offset-2">

            <form action="/profile/edit" method="post">

                <div class="form-group">
                    <label for="name">Name :</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                </div>

                @if($errors->has('name'))
                    <div class="alert alert-danger" role="alert">
                        <strong>{{$errors->first('name')}}</strong>
                    </div>
                @endif

                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                </div>

                @if($errors->has('email'))
                    <div class="alert alert-danger" role="alert">
                        <strong>{{$errors->first('email')}}</strong>
                    </div>
                @endif

                <div class="form-group">
                    <label for="password">Password :</label>
                    <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
                </div>

                @if($errors->has('password'))
                    <div class="alert alert-danger" role="alert">
                        <strong>{{$errors->first('password')}}</strong>
                    </div>
                @endif

                <div class="form-group">
                    <label for="repassword">Re-password :</label>
                    <input type="password" class="form-control" id="reassword" name="repassword" value="{{ old('repassword') }}">
                </div>

                @if($errors->has('repassword'))
                    <div class="alert alert-danger" role="alert">
                        <strong>{{$errors->first('repassword')}}</strong>
                    </div>
                @endif

                <input type="submit" value="Send" class="btn btn-primary">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

            </form>

        </div>
    </div>

@endsection
