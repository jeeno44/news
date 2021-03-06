@extends("master.layout")

@section("container")

    <h1>ДОБАВИТЬ РУБРИКУ</h1>

    <hr>

    <div class="row">
        <div class="col-6 offset-2">
            <form action="/admin/rubrics" method="post">

                <div class="form-group">
                    <label for="heading">Heading (eng.) :</label>
                    <input type="text" class="form-control" id="heading" name="heading" value="{{ old('heading') }}">
                </div>

                @if($errors->has('heading'))
                    <div class="alert alert-danger" role="alert">
                        <strong>{{$errors->first('heading')}}</strong>
                    </div>
                @endif

                <div class="form-group">
                    <label for="heading_name">Рубрика (руск.) :</label>
                    <input type="text" class="form-control" id="heading_name" name="heading_name">
                </div>
                
                @if($errors->has('heading_name'))
                    <div class="alert alert-danger" role="alert">
                        <strong>{{$errors->first('heading_name')}}</strong>
                    </div>
                @endif

                <input type="submit" value="Send" class="btn btn-primary">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

            </form>
        </div>
    </div>

@endsection

