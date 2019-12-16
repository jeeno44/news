@extends("master.layout")

@section("container")

    @if(isset($logs))

        <table class="table table-bordered">

              <thead>

                 <th>@sortablelink('datetime', 'Время')</th>
                 <th>@sortablelink('author_id', 'Автор')</th>
                 <th>@sortablelink('event', 'Событие')</th>
                 <th>@sortablelink('post_id', 'Статья')</th>

              </thead>

              <tbody>

                 @foreach($logs as $log)
                     <tr>

                         <td>{{ \App\Helpers\Helper::getTime($log->datetime) }}</td>
                         <td>{{ \App\User::find($log->author_id)->name }}</td>
                         <td>{{ \App\Helpers\Helper::rusEvent($log->event) }}</td>
                         <td><a href="/news/show/{{ \App\Models\Post::find($log->post_id)->id ?? null }}">{{ \App\Models\Post::find($log->post_id)->headline ?? "ЗАПИСЬ УДАЛЕНА" }}</a></td>

                     </tr>
                 @endforeach

              </tbody>


        </table>

        {!! $logs->appends(\Request::except('page'))->render() !!}

    @else

    @endif

@endsection

