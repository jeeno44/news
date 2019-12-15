@extends("master.layout")

@section('container')
<div class="app">


    <h1>INDEX POST</h1>

    @if(\App\Helpers\Helper::isEditor()) <button class="btn btn-info" onclick="javascript:window.location.href='/post/create';"> Create </button>  @endif

    <hr>

    @if(count($posts) > 0)
        <table class="table table-bordered">

            <thead>

            <th>@sortablelink('id', 'ID')</th>
            <th>@sortablelink('user_id', 'Автор')</th>
            <th>@sortablelink('headline', 'Заголовок')</th>
            <th>@sortablelink('subheadline', 'Подзаголовок')</th>
            <th>IMG</th>
            <th>@sortablelink('post', 'Новость')</th>
            <th>@sortablelink('headings_id', 'Рубрика')</th>
            <th>@sortablelink('import_id', 'Важность')</th>
            <th>Теги</th>
            <th width="50px">@sortablelink('approved', 'Одобрено')</th>
            <th title="Редактировать">Edit</th>
            <th title="Удалить">Del</th>

            </thead>

            <tbody>

            @foreach($posts as $post)
                <tr>

                    <td><a href="/post/{{ $post->id }}" title="Подробнее">{{ $post->id }}</a></td>
                    <td>{{ $post->User->name }}</td>
                    <td>{{ $post->headline }}</td>
                    <td>{{ $post->subheadline }}</td>
                    <td><img src="{{ $post->image }}" width="150" height="70"></td>
                    <td>{{ $post->post }}</td>
                    <td>{{ $post->Higs->heading_name }}</td>
                    <td>{{ $post->Imps->import_name }}</td>
                    <td>
                        @foreach($post->Tids as $tags)
                            {{ $tags->Tags->tag }}<br>
                        @endforeach
                    </td>
                    <td>
                        @if($post->approved == "yes")
                            <label class="toggle round">
                                <input type="checkbox" @click="changeApproved('{{ $post->id }}','no')" checked><i class="slider"></i>
                            </label>
                        @else
                            <label class="toggle round">
                                <input type="checkbox" @click="changeApproved('{{ $post->id }}','yes')"><i class="slider"></i>
                            </label>
                        @endif
                    </td>
                    <td><a href="/post/{{ $post->id }}/edit"><img src="/source/images/edit2.ico" width="16" height="16"></a></td>
                    <td><a href="/post/{{ $post->id }}/psevdoremove"><img src="/source/images/remove.png" width="16" height="16"></a></td>

                </tr>
            @endforeach

            </tbody>

        </table>
        {!! $posts->appends(\Request::except('page'))->render() !!}
    @else
        <h1>Нет записей</h1>
    @endif


</div>
@endsection

@section("scv")

    <script type="text/javascript">

        new Vue({
            el:'.app',
            data:{
                param:'Hello'
            },
            methods:{
                changeApproved(val,status){
                    axios.post('/post/updateApproved/' + val,{status:status}).then(response => {
                        if(response.data == "OK"){
                            window.location.reload();
                        }
                    });
                }
            }
        });

    </script>

@endsection
