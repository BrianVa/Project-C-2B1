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
                    <th>Begintijd</th>
                    <th>Eindtijd</th>
                    <th>Plekken vrij</th>
                    <th>Meer info</th>
                </tr>
                </thead>

                <tbody>
                @foreach($data as $session)
                    <tr>
                        <td>{{ $session->title }}</td>
                        <td>{{ date_format(new Datetime($session->begin_date),'D j F G:i Y') }}</td>
                        <td>{{ date_format(new Datetime($session->end_date),'D j F G:i Y') }}</td>
                        <td>({{ $session->max_atendees - $session->orders }}/{{ $session->max_atendees }})</td>
                        <td> <a href="{{url('/kennissessie')}}/{{ $session->k_id }}"  class="btn btn-primary btn-block"><b>Bekijken</b></a></td>
                    </tr>
                @endforeach
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">

        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
    </section>
@endsection
