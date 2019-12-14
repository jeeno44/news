@extends("master.layout")

@section('container')

    <h1>CREATE POST</h1>

    <hr>

    <div class="row">
        <div class="col-6 offset-2">

            <form method="post" action="{{ route('post.store') }}">

                <div class="form-group">
                    <label for="status">Рубрика <span style="color: red">*</span> :</label>
                    <select class="form-control" id="status" name="status">
                        @foreach($higs as $hig)
                            <option value="{{ $hig->heading }}">{{ $hig->heading_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="head">Заголовок <span style="color: red">*</span> :</label>
                    <input type="text" class="form-control" id="head" name="head">
                </div>

                <div class="form-group">
                    <label for="subhead">Подзаголовок :</label>
                    <input type="text" class="form-control" id="subhead" name="subhead">
                </div>

                <div class="form-group">
                    <label for="post">Текст <span style="color: red">*</span> :</label>
                    <textarea class="form-control" id="post" rows="3" name="post"></textarea>
                </div>

                <input type="submit" value="Send" class="btn btn-primary">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

            </form>

        </div>
    </div>

@endsection
