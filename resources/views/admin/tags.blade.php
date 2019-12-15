@extends("master.layout")

@section("container")

    <h1>ДОБАВИТЬ ТЕГИ</h1>

    <hr>

    <div class="row">
        <div class="col-6 offset-2">
            <form action="/admin/tags" method="post">

                <div class="form-group">
                    <label for="tag">Tag (eng.) :</label>
                    <input type="text" class="form-control" id="tag" name="tag">
                </div>

                <div class="form-group">
                    <label for="tag_name">Тег(руск.) :</label>
                    <input type="text" class="form-control" id="tag_name" name="tag_name">
                </div>

                <input type="submit" value="Send" class="btn btn-primary">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

            </form>
        </div>
    </div>

@endsection

