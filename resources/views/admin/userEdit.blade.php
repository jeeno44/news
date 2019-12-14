@extends('admin.adminLayout')

@section("container")

    <h1>USER EDIT</h1>

    <ul>
        <li>Статус - <b>{{ $user->Role->role_name }}</b></li>
        <li>Имя - <b>{{ $user->name }}</b></li>
        <li>Email - <b>{{ $user->email }}</b></li>
        <li>Постов - <b>{{ count($user->Posts) }}</b></li>
    </ul>

    <hr>

    <form action="/admin/user/{{$user->id}}" method="post">

        <div class="form-group">
            <label for="status">Изменить статус пользователя</label>
            <select class="form-control" id="status" name="status">
                <option value="1">Администратор</option>
                <option value="2">Редактор</option>
                <option value="3">Пользователь</option>
            </select>
        </div>

        <input type="submit" value="Send" class="btn btn-primary">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

    </form>

@endsection
