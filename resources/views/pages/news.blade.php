@extends("master.layout")

@section('container')

    <h1>THIS IS NEWS</h1>

    <nav>

        @foreach($rubrics as $rubric)
            <a href="/news/rubrics/{{ $rubric->heading }}">{{ $rubric->heading_name }}</a>
        @endforeach

        <div class="animation start-home"></div>
    </nav>

@endsection
