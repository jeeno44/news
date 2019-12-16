@extends("master.layout")

@section('container')

    @if(count($posts) > 0)
        <table class="table table-bordered">

            <thead>

            <th>@sortablelink('id', 'ID')</th>
            <th>@sortablelink('user_id', 'Author')</th>
            <th>@sortablelink('headline', 'Headline')</th>
            <th>@sortablelink('subheadline', 'Subheadline')</th>
            <th>@sortablelink('post', 'Post')</th>
            <th>Img</th>
            <th>@sortablelink('created_at', 'Date')</th>
            <th>Tags</th>

            </thead>

            <tbody>
            @foreach($posts as $post)

                <tr>
                    <td><a href="/news/show/{{ $post->id }}" title="Подробнее">{{ $post->id }}</a></td>
                    <td>{{ $post->User->name }}</td>
                    <td>{{ $post->headline }}</td>
                    <td>{{ $post->subheadline }}</td>
                    <td>{{ $post->post }}</td>
                    <td><a href="/news/show/{{ $post->id }}" title="Подробнее"><img src="{{ $post->image }}" width="150" height="70"></a></td>
                    <td>{{ \App\Helpers\Helper::getDate($post->created_at) }}</td>
                    <td>
                        @foreach($post->Tids as $tags)
                            {{ $tags->Tags->tag_name }}<br>
                        @endforeach
                    </td>
                </tr>


            @endforeach
            </tbody>


        </table>
    @else

        <h1>Нет Записей</h1>

    @endif

@endsection
