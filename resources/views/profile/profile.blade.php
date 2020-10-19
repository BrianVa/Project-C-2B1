@extends('main/layout')
@section('title', "Profiel")
@section('page_title', "Profiel")
@section('includes_css')
    <link rel="stylesheet" href="{{ url('/css/datetimepicker/date.css') }}">
@endsection
@section('includes_js')
    <script src="{{ url('/js/datetimepicker/moment.js') }}"></script>
    <script src="{{ url('/js/datetimepicker/date.js') }}"></script>
@endsection
@section('jqcode')
<script>
    $(document).ready(function(){
        $('.date').datetimepicker();
    });
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
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{ url('/img/user2-160x160.jpg') }}"
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
                            <h3 class="card-title">Recentelijke Sessies</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fa fa-book mr-1"></i> Sessie 1</strong>

                            <p class="text-muted">
                                Lorem ipsum dolor sit amet, consectetur.
                            </p>

                            <hr>

                            <strong><i class="fa fa-book mr-1"></i> Sessie 2</strong>

                            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur.</p>

                            <hr>

                            <strong><i class="fa fa-book mr-1"></i> Sessie 3</strong>

                            <p class="text-muted">
                                Lorem ipsum dolor sit amet, consectetur.
                            </p>

                            <hr>

                            <strong><i class="fa fa-book mr-1"></i> Sessie 4</strong>

                            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur.</p>
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
                                <li class="nav-item"><a class="nav-link" href="#todo" data-toggle="tab">Niet Behaald</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="done">
                                    <p>Voltooid</p>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="soon">
                                    <p>Binnenkort</p>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="todo">
                                <p>Niet behaald</p>
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




