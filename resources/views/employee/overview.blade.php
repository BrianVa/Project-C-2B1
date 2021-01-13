@extends('main/layout')
@section('title', "Gebruikersoverzicht")
@section('page_title', "Gebruikersoverzicht")
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
                <h3 class="card-title">Gebruikersoverzicht</h3>

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
                        <th>Geboortedatum</th>
                        <th>Geslacht</th>
                        <th>Rol</th>
                        <th>Aangemeld op</th>
                        <th>Actief</th>
                        <th>Bekijken</th>
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
                        <td>{{ date_format(new Datetime($user->created_at),'d-m-Y') }}</td>
                        <td>{{ $user->active ? 'Actief' : 'Inactief' }}</td>
                        <td> <a href="{{url('/gebruiker')}}/{{$user->id}}"  class="btn btn-primary btn-block"><b>Bekijken</b></a></td>
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
