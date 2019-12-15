@extends("master.layout")

@section('container')
<div class="app">


    <h1>CREATE POST</h1>

    <hr>

    <div class="row">
        <div class="col-6 offset-2">

            <form method="post" action="{{ route('post.store') }}" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="user_id">Author</label>

                    <input v-show="hide" class="form-control" type="text" readonly name="user_id"
                               value="{{ \Illuminate\Support\Facades\Auth::user()->id }}">
                    <input v-show="!hide" class="form-control" type="text" readonly
                               value="{{ \Illuminate\Support\Facades\Auth::user()->name }}">

                </div>

                <div class="form-group">
                    <label for="headingsId">Рубрика <span style="color: red">*</span> :</label>
                    <select class="form-control" id="status" name="headings_id">
                        @foreach($higs as $hig)
                            <option value="{{ $hig->id }}">{{ $hig->heading_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="headline">Заголовок <span style="color: red">*</span> :</label>
                    <input type="text" class="form-control" id="headline" name="headline" value="{{ old('headline') }}">
                </div>

                @if($errors->has('headline'))
                    <div class="alert alert-danger" role="alert">
                        <strong>{{$errors->first('headline')}}</strong>
                    </div>
                @endif

                <div class="form-group">
                    <label for="subheadline">Подзаголовок :</label>
                    <input type="text" class="form-control" id="subheadline" name="subheadline" value="{{ old('subheadline') }}">
                </div>

                <div class="form-group">
                    <label for="image">Input Image</label><br>
                    <input type="file" class="file" id="image" name="image">
                </div>

                @if($errors->has('image'))
                    <div class="alert alert-danger" role="alert">
                        <strong>{{$errors->first('image')}}</strong>
                    </div>
                @endif

                <div class="form-group">
                    <label for="post">Статья <span style="color: red">*</span> :</label>
                    <textarea class="form-control" id="post" rows="3" name="post">{{ old('post') }}</textarea>
                </div>

                @if($errors->has('post'))
                    <div class="alert alert-danger" role="alert">
                        <strong>{{$errors->first('post')}}</strong>
                    </div>
                @endif

                <div class="form-group">
                    <label for="tag_id">Теги <span style="color: red">*</span> :</label><br>
                    <select class="form-control" id="tag_id" name="tag_id[]" v-for="i in tag">
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                        @endforeach
                    </select>
                    <br>
                    <img src="/source/images/plus1.jpeg" width="16" height="16" @click="appendFormTag()">
                </div>

                <div class="form-group">
                    <label for="headingsId">Важность <span style="color: red">*</span> :</label>
                    <select class="form-control" id="headingsId" name="import_id">
                        @foreach($imps as $imp)
                            <option value="{{ $imp->id }}">{{ $imp->import_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="post">Approved : <span style="color: red">*</span> :</label>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="approved" value="yes" checked="checked"> Yes
                        </label><br>
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="approved" value="no"> No
                        </label>
                    </div>
                </div>

                <input type="submit" value="Send" class="btn btn-primary">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

            </form>

        </div>
    </div>


</div>
@endsection

@section("scv")
    <script type="text/javascript">

        console.log("CREATE POST");

        new Vue({
            el:'.app',
            data:{
                param:'weclomes',
                hide:false,
                tag:1
            },
            methods:{
                appendFormTag(){
                    this.tag += 1;
                    console.log(this.tag);
                }
            },
            components:{

            }
        });

    </script>
@endsection
