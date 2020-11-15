@extends('main/layout')
@section('title', "Cimsolutions Kennissessie aanmelden")
@section('page_title', "Kennissessies aanmelden")
@section('jqcode')
    <script>
        $(document).ready(function(){
            //$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
        });
    </script>
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
               <p>{{$data->title}}  </p>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="button" class="btn btn-primary float-right">Aanmelden</button>

            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
    </section>
@endsection
