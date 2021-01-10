@extends('main/layout')
@section('title', "Cimsolutions Kennissessie aanmelden")
@section('page_title', "Kennissessies aanmelden")
@section('jqcode')
    <script>
        $(document).ready( function () {
            $('#SessionUsersOverview').DataTable( {
                "order": [[ 2, "asc" ]]
            });
        });
    </script>
    <script>
        function setdiet($param) {
            $("#diet_textfield").text($param);
        }
    </script>
    <script>
        $(document).ready( function () {
            $('#EmployeeOverview').DataTable();
        } );
    </script>
    <script>
        $(document).ready( function () {
            $('#Attendoverview').DataTable();
        } );
    </script>
    <script>
        function setsession($firstname, $lastname, $begin_date, $end_date, $data) {
            $("#trainer").text($firstname+' '+$lastname);
            let begin_date = new Date($begin_date);
            const months = ["JAN", "FEB", "MAR","APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];
            let formatted_begin = begin_date.getDate() + "-" + months[begin_date.getMonth()] + "-" + begin_date.getFullYear();
            let end_date = new Date($end_date);
            let formatted_end = end_date.getDate() + "-" + months[end_date.getMonth()] + "-" + end_date.getFullYear();
            $("#date").text(formatted_begin+ ' tot ' + formatted_end);
            test = JSON.parse($data);
            $("input[name=speed_radio][value=" + test.speed_radio + "]").attr('checked', 'checked');
            $("input[name=training_radio][value=" + test.training_radio + "]").attr('checked', 'checked');
            $("input[name=performance_radio][value=" + test.performance_radio + "]").attr('checked', 'checked');
            $("input[name=cases_radio][value=" + test.cases_radio + "]").attr('checked', 'checked');
            $("input[name=time_radio][value=" + test.time_radio + "]").attr('checked', 'checked');
            $("input[name=learn_radio][value=" + test.learn_radio + "]").attr('checked', 'checked');
            $("input[name=knowledge_radio][value=" + test.knowledge_radio + "]").attr('checked', 'checked');
            document.getElementById("speed").value = test.speed;
            document.getElementById("training").value = test.training;
            document.getElementById("performance").value = test.performance;
            document.getElementById("cases").value = test.cases;
            document.getElementById("time").value = test.time;
            document.getElementById("learn").value = test.learn;
            document.getElementById("knowledge").value = test.knowledge;
            document.getElementById("learned").value = test.learned;
            document.getElementById("missed").value = test.missed;
            document.getElementById("strong").value = test.strong;
            document.getElementById("weak").value = test.weak;
            document.getElementById("send_feedback").hidden = true;
            $("#feedback_form input").prop("disabled", true);

        }
    </script>
@endsection
@section('includes_css')
    <link rel="stylesheet" href="{{ url('/css/datatables/datatable.css') }}">
    <style>
        .radio-label-vertical-wrapper {
            padding-bottom: 13px;
            position: relative;
            display: inline-block;
            margin-bottom: 20px;
        }
        .radio-label-vertical-wrapper:before {
            content: ' ';
            display: block;
            width: 100%;
            height: 30px;
            background: #efefef;
            position: absolute;
            bottom: 0;
        }
        .radio-label-vertical-wrapper label:not(.radio-label-vertical) {
            display: block;
            width: 100%;
        }
        .radio-label-vertical {
            position: relative;
            display: inline-block;
            vertical-align: middle;
            padding: 0 20px;
            text-align: center;
        }
        .radio-label-vertical input {
            position: absolute;
            top: 28px;
            left: 50%;
            margin-left: -6px;
            display: block;
            cursor: pointer;
        }
    </style>
@endsection
@section('includes_js')
    <script src="{{ url('/js/datatables/datatable.js') }}"></script>
@endsection
@section('content')

    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h2>{{  $data->title }}</h2>
                <h3 class="card-title">{{ $data->firstname }} {{ $data->lastname }}</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
               <p>{{ $data->desc }}</p>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{{url('/signup')}}/{{ $data->know_id }}" class="@if(\Carbon\Carbon::parse($data->begin_date)->isPast()) disabled @endif btn btn-primary @if($data->checked) disabled @endif float-right"><b>Aanmelden</b></a>
            </div>
            <!-- /.card-footer-->
        </div>
        @if(Auth::user()->role_id > 1)
        <div class="card">
            <div class="card-header">
                <h2>Aanmeldingen</h2>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table id="SessionUsersOverview" class="display dt-body-center dt-head-center">
                    <thead>
                    <tr>
                        <th>Naam</th>
                        <th>Aangemeld op</th>
                        <th>Status</th>
                        <th>Dieetwensen</th>
                        <th>Afwijzen</th>
                        <th>Aanwezig zetten</th>
                        <th>Verwijderen</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                            <td>{{ $user->sign_up_at }}</td>
                            <td>{{ $user->cancelled ? 'Geannuleerd' : 'Aangemeld' }}</td>
                            <td><button @if($user->dietary != "") onclick="setdiet('{{$user->dietary}}')" data-toggle="modal" data-target="#diet" @endif type="button"  class="btn btn-info @if($user->dietary == '') disabled @endif">Bekijken</button></td>
                            <td><a href="{{url('/annuleer/kennissesie')}}/{{$data->know_id}}/gebruiker/{{$user->id}}"  class="btn btn-warning btn-block @if($user->cancelled == 1) disabled @endif @if(\Carbon\Carbon::parse($data->begin_date)->isPast()) disabled @endif">Afwijzen</a></td>
                            <td><a href="{{url('/attend/user')}}/{{$user->ses_id}}"  class="btn btn-info btn-block @if(!\Carbon\Carbon::parse($data->begin_date)->isPast()) disabled @endif @if($user->attended == 1) disabled @endif">Aanwezig</a></td>
                            <td><a href="{{url('/verwijder/kennissesie')}}/{{$data->know_id}}/gebruiker/{{$user->id}}" class="btn btn-danger btn-block @if($user->cancelled == 0) disabled @endif">Verwijderen</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>
            <!-- /.card-footer-->
        </div>
            <div class="card">
                <div class="card-header">
                    <h2>Deelnemers toevoegen</h2>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="EmployeeOverview" class="display dt-body-center dt-head-center">
                        <thead>
                        <tr>
                            <th>Naam</th>
                            <th>Email</th>
                            <th>Geboortedatum</th>
                            <th>Geslacht</th>
                            <th>Rol</th>
                            <th>Toevoegen</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($applicants as $applicant)
                            <tr>
                                <td>{{ $applicant->firstname }}  {{ $applicant->lastname }}</td>
                                <td>{{ $applicant->email }}</td>
                                <td>{{ date_format(new Datetime($applicant->dateofbirth),'d/m/Y') }}</td>
                                <td>{{ $applicant->gender }}</td>
                                <td>{{ $applicant->function }}</td>
                                <td> <a href="{{url('/addattendee/kennissesie')}}/{{$data->know_id}}/gebruiker/{{$applicant->id}}" class="btn btn-success btn-block"><b>Toevoegen</b></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">

                </div>
                <!-- /.card-footer-->
            </div>
            @if(Auth::user()->role_id > 1)
                <div class="card">
                    <div class="card-header">
                        <h2>Aanmeldingen</h2>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="Attendoverview" class="display dt-body-center dt-head-center">
                            <thead>
                            <tr>
                                <th>Naam</th>
                                <th>Bekijk feedback</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($feedback as $feed)
                                <tr>
                                    <td>{{ $feed->firstname }} {{ $feed->lastname }}</td>
                                    <td><button onclick="setsession('{{$feed->firstname}}', '{{$feed->lastname}}', '{{$feed->begin_date}}', '{{$feed->end_date}}', '{{$feed->data}}')"  data-toggle="modal" data-target="#evaluation" type="button"  class="btn btn-info ">Bekijken</button></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">

                    </div>
                    <!-- /.card-footer-->
                </div>
                @endif
        @endif
        @extends('main/modals/diet')
        @extends('main/modals/evaluation')
        <!-- /.card -->
    </section>
@endsection
