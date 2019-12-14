@extends("master.layout")

@section('container')

    <h1>INDEX POST</h1>

    @if(\App\Helpers\Helper::isEditor()) <button class="btn btn-info" onclick="javascript:window.location.href='/post/create';"> Create </button>  @endif

    <hr>

    @if(count($posts) > 0)
        <table class="table table-bordered">

            <thead>

            <th>ID</th>
            <th>Автор</th>
            <th>Заголовок</th>
            <th>Подзаголовок</th>
            <th>IMG</th>
            <th>Новость</th>
            <th>Рубрика</th>
            <th>Важность</th>
            <th>Одобрено</th>

            </thead>

            <tbody>

            @foreach($posts as $post)
                <tr>

                    <td>{{ $post->id }}</td>
                    <td>{{ $post->User->name }}</td>
                    <td>{{ $post->headline }}</td>
                    <td>{{ $post->subheadline }}</td>
                    <td><img src="{{ $post->image }}" width="150" height="70"></td>
                    <td>{{ $post->post }}</td>
                    <td>{{ $post->Higs->heading_name }}</td>
                    <td>{{ $post->Imps->import_name }}</td>
                    <td>{{ ($post->approved == "yes") ? "Да" : "Нет" }}</td>

                </tr>
            @endforeach

            </tbody>


        </table>
    @else
        <h1>Нет записей</h1>
    @endif

@endsection
