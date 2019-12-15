@extends('admin.adminLayout')

@section("container")

    <h1>USERS</h1>

    <table class="table table-bordered" id="app">

          <thead>

             <th>@sortablelink('id', 'ID')</th>
             <th>@sortablelink('name', 'Name')</th>
             <th>@sortablelink('email', 'Email')</th>
             <th>@sortablelink('role_id', 'Satatus')</th>
             <th width="20px" title="Редактировать">Edit</th>
             <th width="20px" title="Приглашение в редакторы">Inv</th>

          </thead>

          <tbody>

             @foreach($users as $user)

                 <tr>

                     <td>{{ $user->id }}</td>
                     <td>{{ $user->name }}</td>
                     <td>{{ $user->email }}</td>
                     <td>{{ $user->Role->role_name }}</td>
                     <td><a href="/admin/user/{{ $user->id }}" title="Редактировать"><img src="/source/images/edit.png" width="16" height="16"></a></td>
                     @if($user->role_id == 3 && $user->invite != "no" && $user->invite == null)
                         <td><img src="/source/images/invite.svg" width="16" height="16"
                                  @click="sendInvite('{{ $user->id }}')" title="Приглашение в редакторы">
                         </td>
                     @elseif($user->invite == "Хочешь в редакторы ?")
                         <td><img src="/source/images/waite.png" width="16" height="16" title="Приглашение в ожидании"></td>
                     @else
                         <td><img src="/source/images/block.png" width="16" height="16"></td>
                     @endif

                 </tr>

             @endforeach

          </tbody>


    </table>

    <hr>

@endsection


@section("scv")

    <script type="text/javascript">

        new Vue({
            el:'#app',
            data:{
                invite:0,
            },
            methods:{
                sendInvite(val){
                    if(this.invite == 0){
                        axios.post('/ajax/sendinvite',{id:val}).then(response => {
                            console.log(response.data);
                            if(response.data == "200"){
                                console.log("ВСЁ ОК");
                                alert("Приглашение успешно отправлено");
                                this.invite = 1;
                            }
                        });
                    }
                }
            },
            components:{

            }
        });

    </script>

@endsection


