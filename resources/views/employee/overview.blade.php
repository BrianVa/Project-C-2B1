@extends('main/layout')
@section('title', "Overview")
@section('page_title', "Overview")
@section('includes_css')
    <link rel="stylesheet" href="{{ url('/css/datatables/datatable.css') }}">
@endsection
@section('includes_js')
    <script src="{{ url('/js/datatables/datatable.js') }}"></script>
@endsection
@section('jqcode')
    <script>
        $(document).ready( function () {
            $('#EmployeeOverview').DataTable();
        } );
    </script>
@endsection
@section('content')
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Gebruikers Overzicht</h3>

                {{--<div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>--}}
            </div>
            <div class="card-body">
                <table id="EmployeeOverview" class="display">
                    <thead>
                    <tr>
                        <th>Naam</th>
                        <th>Email</th>
                        <th>Geboorte Datum</th>
                        <th>Geslacht</th>
                        <th>Role</th>
                        <th>Aangemeld op</th>
                        <th>Actief</th>
                        <th>Meer info</th>
                        <th>Aanpassen</th>
                        <th>Verwijderen</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->firstname }}  {{ $user->lastname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ date_format(new Datetime($user->dateofbirth),'d/m/Y') }}</td>
                        <td>{{ $user->gender }}</td>
                        <td>{{ $user->function }}</td>
                        <td>{{ date_format(new Datetime($user->created_at),'d-F-Y h:m:s') }}</td>
                        <td>{{ $user->active ? 'Actief' : 'Inactief' }}</td>
                        <td><button type="button" class="btn btn-primary">Meer info</button></td>
                        <td><button type="button" class="btn btn-success">Aanpassen</button></td>
                        <td><button type="button" class="btn btn-danger">Verwijderen</button></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            {{--<div class="card-footer">
                Footer
            </div>--}}
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
    </section>
@endsection
