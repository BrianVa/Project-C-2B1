@extends('main/layout')
@section('title', "Profiel")
@section('page_title', "Profiel")
@section('includes_css')
    <link rel="stylesheet" href="{{ url('/css/datetimepicker/date.css') }}">
    <link rel="stylesheet" href="{{ url('/css/datatables/datatable.css') }}">
@endsection
@section('includes_js')
    <script src="{{ url('/js/datetimepicker/moment.js') }}"></script>
    <script src="{{ url('/js/datetimepicker/date.js') }}"></script>
    <script src="{{ url('/js/datatables/datatable.js') }}"></script>
@endsection
@section('jqcode')
    <script>
        $(document).ready( function () {
            $('.SessionOverview').DataTable();
        } );
    </script>
    <script>
        function setsession($firstname, $lastname, $begin_date, $end_date, $id) {
            $("#trainer").text($firstname+' '+$lastname);
            document.getElementById("session-id").value=$id;
            let begin_date = new Date($begin_date);
            const months = ["JAN", "FEB", "MAR","APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];
            let formatted_begin = begin_date.getDate() + "-" + months[begin_date.getMonth()] + "-" + begin_date.getFullYear();
            let end_date = new Date($end_date);
            let formatted_end = end_date.getDate() + "-" + months[end_date.getMonth()] + "-" + end_date.getFullYear();
            $("#date").text(formatted_begin+ ' tot ' + formatted_end);


        }
    </script>
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->

                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img style="width: 160px!important;height: 160px!important;" class="profile-user-img img-fluid img-circle"
                                     src="{{ url('/img/profile/images') }}/{{Auth::user()->avatar}}"
                                     alt="User profile picture">

                            </div>
                            <h3 class="profile-username text-center">{{ Auth::user()->firstname  }} {{ Auth::user()->lastname  }}</h3>
                            <a href="#" data-toggle="modal" data-target="#data" class="btn btn-primary btn-block"><b>Gegevens wijzigen</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Sessies deze maand</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @foreach($sessionsdone as $session)
                                <strong><i class="fa fa-book mr-1"></i> {{ $session->title }}</strong>
                                <p class="text-muted">
                                    {{ \Illuminate\Support\Str::limit($session->desc, 100, $end = '...') }}
                                </p>
                                <hr>
                            @endforeach
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#done" data-toggle="tab">Voltooid</a></li>
                                <li class="nav-item"><a class="nav-link" href="#soon" data-toggle="tab">Binnenkort</a></li>
                                <li class="nav-item"><a class="nav-link" href="#todo" data-toggle="tab">Geannuleerd</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="done">
                                    <table id="" class="display SessionOverview">
                                        <thead>
                                        <tr>
                                            <th>Sessie</th>
                                            <th>Begin tijd</th>
                                            <th>Eind tijd</th>
                                            <th>Sessie leider</th>
                                            <th>Aangemeld</th>
                                            <th>Annuleren</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($sessionsdone as $session)

                                            <tr>
                                                <td>{{ $session->title }}</td>
                                                <td>{{ date_format(new Datetime($session->begin_date),'D j F G:i Y') }}</td>
                                                <td>{{ date_format(new Datetime($session->end_date),'D j F G:i Y') }}</td>
                                                <td>{{ $session ->firstname }} {{$session->lastname }}</td>
                                                <td>{{ date_format(new Datetime($session->sign_up_at),'D j F G:i Y') }}</td>
                                                <td><button onclick="setsession('{{$session->firstname}}', '{{$session->lastname}}', '{{$session->begin_date}}', '{{$session->end_date}}', '{{$session->id}}')" data-toggle="modal" data-target="#evaluation" type="button"  class="btn btn-info ">Evalueer</button></td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="soon">
                                    <table id="" class="display SessionOverview">
                                        <thead>
                                        <tr>
                                            <th>Sessie</th>
                                            <th>Begin tijd</th>
                                            <th>Eind tijd</th>
                                            <th>Sessie leider</th>
                                            <th>Aangemeld</th>
                                            <th>Annuleren</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($sessionsnow as $session)
                                            <tr>
                                                <td>{{ $session->title }}</td>
                                                <td>{{ date_format(new Datetime($session->begin_date),'D j F G:i Y') }}</td>
                                                <td>{{ date_format(new Datetime($session->end_date),'D j F G:i Y') }}</td>
                                                <td>{{ $session ->firstname }} {{$session->lastname }}</td>
                                                <td>{{ date_format(new Datetime($session->sign_up_at),'D j F G:i Y') }}</td>
                                                <td> <a href="{{url('/annuleer')}}/{{ $session->s_id }}"  class="btn btn-danger btn-block"><b>Annuleren</b></a></td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="todo">
                                    <table id="" class="display SessionOverview">
                                        <thead>
                                        <tr>
                                            <th>Sessie</th>
                                            <th>Begin tijd</th>
                                            <th>Eind tijd</th>
                                            <th>Sessie leider</th>
                                            <th>Aangemeld</th>
                                            <th>Annuleren</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($sessionscan as $session)
                                            <tr>
                                                <td>{{ $session->title }}</td>
                                                <td>{{ date_format(new Datetime($session->begin_date),'D j F G:i Y') }}</td>
                                                <td>{{ date_format(new Datetime($session->end_date),'D j F G:i Y') }}</td>
                                                <td>{{ $session ->firstname }} {{$session->lastname }}</td>
                                                <td>{{ date_format(new Datetime($session->sign_up_at),'D j F G:i Y') }}</td>
                                                <td><button disabled type="button" class="btn btn-danger">Annuleren</button></td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@extends('main/modals/data')
@extends('main/modals/evaluation')




