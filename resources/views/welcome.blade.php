<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
       
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
            <div class="content">
            @if($errors->any())
                @foreach($errors->all() as $error)
                <div>{{$error}}</div>
                @endforeach
            @endif
            <form action="@isset($crud)
                            {{route('cruds.update',$crud)}}
                        @else
                            {{route('cruds.store')}}
                        @endisset" method="post">
                @csrf
                @isset($crud)
                @method('put')
                @endisset
                <div>
                    <input  type="text" placeholder="feild1" name="feild1" value="{{old('feild1',isset($crud->feild1))}}">
                </div>
                <div>
                    <input type="text" placeholder="feild2" name="feild2" value="{{old('feild2',isset($crud->feild2))}}">
                </div>
                <input type="submit">
            </form>

            <table style="margin:auto;">
                <thead>
                    <th>feild1</th>
                    <th>feild2</th>
                    <th>actions</th>
                </thead>
                <tbody>
                    @foreach($cruds as $crud)
                        <tr>
                            <td>{{$crud->feild1}}</td>
                            <td>{{$crud->feild2}}</td>
                            <td><a href="{{route('cruds.edit',$crud)}}">edit</a></td>
                            <td><button id="delete" data-id="{{ $crud->id }}" data-token="{{ csrf_token() }}" >delete</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            <script>
                $("#delete").click(function(){
                    var id = $(this).data("id");
                    var token = $(this).data("token");
                    $.ajax(
                    {
                        url: "/cruds/"+id,
                        type: 'POST',
                        dataType: "JSON",
                        data: {
                            "_method": 'DELETE',
                            "_token": token,
                        },
                        success: function ()
                        {
                            location.replace("{{route('welcome')}}");
                        }
                    });

                    console.log("error");
                });
            </script>
        
    </body>
</html>
