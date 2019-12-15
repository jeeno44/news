@extends("master.layout")

@section('container')

    <h1>SHOW POST</h1>

    <hr>

    @if(isset($post))

        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-secondary"
                    onclick="javascript:window.location.href='/post/create';">Create New
            </button>
            <button type="button" class="btn btn-secondary"
                    onclick="javascript:window.location.href='/post/{{ $post->id }}/edit';">Edit Post
            </button>
            <form action="/post/{{ $post->id }}" method="post">
                <input type="submit" value="Remove Post" class="btn btn-secondary">
                <input type="hidden" name="_method" value="delete" />
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
        </div>

        <div class="row">
            <div class="col-12">&nbsp;</div>
        </div>

        <div class="row">
            <div class="col-6 offset-2">
                Автор статьи - <b> {{ $post->User->name }} </b>
            </div>
        </div>

        <div class="row">
            <div class="col-6 offset-2">
                Рубрика - <b> {{ $post->Higs->heading_name }} </b>
            </div>
        </div>

        <div class="row">
            <div class="col-6 offset-2">
               Заголовок -  <b>{{ $post->headline }} </b>
            </div>
        </div>

        <div class="row">
            <div class="col-6 offset-2">
               Подзаголовок -  <b>{{ $post->subheadline }} </b>
            </div>
        </div>

        <div class="row">
            <div class="col-6 offset-2">
               Статья -  <b>{{ $post->post }} </b>
            </div>
        </div>

        <div class="row">
            <div class="col-6 offset-2">
                Важность -  <b>{{ $post->Imps->import_name }} </b>
            </div>
        </div>

        <div class="row">
            <div class="col-6 offset-2">
                Теги :<br>
                @foreach($post->Tids as $tags)
                   <b> {{ $tags->Tags->tag }}</b><br>
                @endforeach
            </div>
        </div>



        <br>
        <hr>
        <br>


        <div class="row">
            <div class="col-6 offset-2">
                <img src="{{ $post->image }}" alt="">
            </div>
        </div>

    @endif

@endsection
