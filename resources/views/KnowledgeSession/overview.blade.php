@extends('main/layout')
@section('title', "Cimsolutions Kennissessie Overzicht")
@section('page_title', "Kennissessies Overzicht")
@section('jqcode')
    <script>
        $(document).ready( function () {
            $('#SessionOverview').DataTable();
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
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Kennissessies Overzicht</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table id="SessionOverview" class="display">
                <thead>
                <tr>
                    <th>Sessie</th>
                    <th>Begin tijd</th>
                    <th>Eind tijd</th>
                    <th>Meer info</th>
                    <th>Aanpassen</th>
                    <th>Verwijderen</th>
                </tr>
                </thead>

                <tbody>
                @foreach($data as $session)
                <tr>
                    <td>{{$session->title}}</td>
                    <td>{{ date_format(new Datetime($session->begin_date),'D j F G:i Y') }}</td>
                    <td>{{ date_format(new Datetime($session->end_date),'D j F G:i Y') }}</td>
                    
                    <td><button type="button" class="btn btn-primary">Meer info</button></td>
                    <td><button type="button" class="btn btn-success">Aanpassen</button></td>
                    <td><button type="button" class="btn btn-danger">Verwijderen</button></td>
                </tr>
                @endforeach


                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
             ----   Hoooii voor Ingrid ----
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
    </section>
@endsection
