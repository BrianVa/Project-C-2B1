@extends('main/layout')
@section('title', "Cimsolutions Kennissessie Toevoegen")
@section('page_title', "Kennissessies Toevoegen")
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
                <h3 class="card-title">Kennissessies Toevoegen</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="{{ url('/addingsession') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Titel van de kennissessie:</label>
                        <input type="text" class="form-control" name="title">
                        @error('title') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <label>Beschrijving van de kennissessie:</label>
                        <textarea class="form-control" name="desc" rows="3"></textarea>
                        @error('desc') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col">
                                <label>Minimale aantal deelnemers:</label>
                                <input type="text" name="min_aten" class="form-control">
                                @error('min_aten') {{ $message }} @enderror
                            </div>
                            <div class="col">
                                <label>Maximale aantal deelnemers:</label>
                                <input type="text" name="max_aten" class="form-control">
                                @error('max_aten') {{ $message }} @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col">
                                <label>Begintijd:</label>
                                <input id="datemask" type="datetime-local" name="begin_time" class="form-control">
                                @error('begin_time') {{ $message }} @enderror
                            </div>
                            <div class="col">
                                <label>Eindtijd:</label>
                                <input type="datetime-local" name="end_time" class="form-control">
                                @error('end_time') {{ $message }} @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-3">
                                @if(Auth::user()->role_id == 4)
                                    <label>Sessieleider:</label>
                                    <select name="Sessionleader" class="form-control">
                                        <option selected></option>
                                        @foreach($gebruikers as $gebruiker)
                                        <option value="{{$gebruiker->id}}">{{$gebruiker->firstname}} {{$gebruiker->lastname}}</option>
                                            @endforeach
                                    </select>
                                @endif
                            </div>
                            <div class="col-3"></div>
                            <div class="col-3"></div>
                            <div class="col-3">
                                <button type="submit" class="float-right btn btn-primary">Toevoegen</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
    </section>
@endsection
