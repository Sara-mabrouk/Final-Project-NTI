<!DOCTYPE html>
<html>

<head>
    <title>Lebda Crud Operation</title>

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
    <div class="container-fluid">
        <div class="page-header">
            <h1>Task</h1>
            <br>
            {{ trans('labels.welcome') . ', ' . auth()->user()->name }}

            <p>

                {{ session()->get('Message') }}

            </p>

        </div>

        <a href="{{ url('Task/create') }}">+ Task</a> || <a href="{{ url('/Logout') }}">LogOut</a>
        <br>
        <a href="{{ url('Lang/en') }}">EN</a> | <a href="{{ url('Lang/ar') }}">ع</a>
        <table class='table table-hover table-responsive table-bordered'>
            <!-- creating our table heading -->
            <tr>
                <th>#</th>
                <th>{{ trans('labels.id') }}</th>
                <th>{{ trans('labels.title') }}</th>
                <th>{{ trans('labels.content') }}</th>
                <th>{{ trans('labels.startdate') }}</th>
                <th>{{ trans('labels.enddate') }}</th>
                <th>{{ trans('labels.image') }}</th>
                <th>{{ trans('labels.addedBy') }}</th>
                <th>{{ trans('labels.action') }} </th>

            </tr>

            @foreach ($data as $key => $value)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->title }}</td>
                    <td>{{ substr($value->content, 0, 45) }}</td>
                    <td>{{ $value->start_date }}</td>
                    <td>{{ $value->end_date }}</td>
                    @php
                        $image = empty($value->image) ? '03.jpg' : $value->image;
                    @endphp

                    <td> <img src=" {{ url('/Tasks/' . $image) }}" alt="" width="70px" height="70px"> </td>

                    <td>{{ $value->AdminName }}</td>
                    <td>
                        <a href='' data-toggle="modal" data-target="#modal_single_del{{ $value->id }}"
                            class='btn btn-danger m-r-1em'>{{ trans('labels.delete') }} </a>
                    </td>
                </tr>
                <div class="modal" id="modal_single_del{{ $value->id }}" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">delete confirmation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                Remove {{ $value->title }} !!!!
                            </div>
                            <div class="modal-footer">
                                <form action="{{ url('Task/' . $value->id) }}" method="post">

                                    @method('delete')
                                    @csrf

                                    <div class="not-empty-record">
                                        <button type="submit" class="btn btn-primary">Delete</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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
