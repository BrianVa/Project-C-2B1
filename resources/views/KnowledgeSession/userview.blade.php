@extends('main/layout')
@section('title', "Cimsolutions Kennissessie aanmelden")
@section('page_title', "Kennissessies aanmelden")
@section('jqcode')
    <script>
        $(document).ready( function () {
            $('#SessionUsersOverview').DataTable();
        } );
    </script>
@endsection
@section('includes_css')
    <link rel="stylesheet" href="{{ url('/css/datatables/datatable.css') }}">
@endsection
@section('includes_js')
    <script src="{{ url('/js/datatables/datatable.js') }}"></script>
@endsection
@section('content')

    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h2>{{$data->title}}</h2>
                <h3 class="card-title">{{$data->firstname}} {{$data->lastname}}</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
               <p>{{$data->desc}}  </p>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{{url('/signup')}}/{{$data->know_id}}"  class="btn btn-primary float-right"><b>Aanmelden</b></a>
            </div>
            <!-- /.card-footer-->
        </div>
        @if(Auth::user()->role_id > 2)
        <div class="card">
            <div class="card-header">
                <h2>Deelneemers</h2>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table id="SessionUsersOverview" class="display">
                    <thead>
                    <tr>
                        <th>Naam</th>
                        <th>Aangemeld op:</th>
                        <th>Status</th>
                        <th>dieetwensen</th>
                        <th>Afwijzen</th>
                        <th>Verwijderen</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                            <td>{{ $user->sign_up_at }}</td>
                            <td>{{ $user->cancelled ? 'Geannuleerd' : 'Aangemeld' }}</td>
                            <td><button type="button" class="btn btn-info">Bekijken</button></td>
                            <td><button type="button" class="btn btn-warning">Afwijzen</button></td>
                            <td><button type="button" class="btn btn-danger">Verwijderen</button></td>
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
        <!-- /.card -->
    </section>
@endsection
