<!DOCTYPE html>
<html>

<head>
    <title>CRUD Admin</title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

    <!-- custom css -->
    <style>
        .m-r-1em {
            margin-right: 1em;
        }

        .m-b-1em {
            margin-bottom: 1em;
        }

        .m-l-1em {
            margin-left: 1em;
        }

        .mt0 {
            margin-top: 0;
        }
    </style>

</head>

<body>

    <!-- container -->
    <div class="container">


        <div class="page-header">
            <h1>{{ trans('labels.r_std') }} </h1>
            <br>
            {{ trans('labels.welcome') . ' , ' . auth()->user()->name }}

            <p>

                {{ session()->get('Message') }}
                <br>
            </p>

        </div>

        <a href="{{ url('/Admin/Create') }}">+ Account</a> || <a href="{{ url('/Task') }}">LIST Tasks</a> || <a
            href="{{ url('/Logout') }}">LogOut</a>
        <br>

        <a href="{{ url('Lang/en') }}">EN</a> | <a href="{{ url('Lang/ar') }}">ع</a>
        <table class='table table-hover table-responsive table-bordered'>
            <!-- creating our table heading -->
            <tr>
                <th>{{ trans('labels.id') }}</th>
                <th>{{ trans('labels.name') }}</th>
                <th>{{ trans('labels.email') }}</th>
                <th>{{ trans('labels.image') }}</th>
                <th>{{ trans('labels.action') }}</th>
            </tr>


            @foreach ($data as $key => $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->email }}</td>

                    @php

                        //   (cond)? true : false      if(){ }else{  }
                        $image = empty($value->image) ? '03.jpg' : $value->image;

                    @endphp


                    <td> <img src=" {{ url('/Images/' . $image) }}" alt="" width="70px" height="70px">
                    </td>


                    <td>
                        <a href='{{ url('/Admin/delete/' . $value->id) }}'
                            class='btn btn-danger m-r-1em'>{{ trans('labels.delete') }}</a>



                        <a href="{{ url('/Admin/edit/' . $value->id) }}"
                            class='btn btn-primary m-r-1em'>{{ trans('labels.edit') }}</a>
                    </td>
                </tr>
            @endforeach
            <!-- end table -->
        </table>

    </div>
    <!-- end .container -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Latest compiled and minified Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- confirm delete record will be here -->

</body>

</html>
