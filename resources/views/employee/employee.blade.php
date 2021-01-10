@extends('main/layout')
@section('title', "Overzicht Gebruiker")
@section('page_title', "Overzicht Gebruiker")
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
                <h3 class="card-title">{{$employee->firstname}} {{$employee->lastname}}</h3>

                {{--<div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>--}}
            </div>
            <div class="card-body">
                <form method="post" action="{{ url('/updategebruiker') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Voornaam:</label>
                        <input type="text" class="form-control" name="firstname" id="" aria-describedby="emailHelp" value="{{ $employee->firstname }}">
                        @error('firstname') {{ $message }} @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Achternaam:</label>
                        <input type="text" name="lastname" class="form-control" id="" value="{{ $employee->lastname }}">
                        @error('lastname') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Geslacht:</label>
                        <input disabled type="text" name="sex" class="form-control" id="" value="{{ $employee->gender }}">
                    </div>
                    <div class="form-group">
                        <label for="">Email:</label>
                        <input type="email" name="email" class="form-control" id="" value="{{ $employee->email }}">
                        @error('email') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Functie:</label>
                        <select name="role" class="form-control">
                            @foreach($roles as $role)
                                <option @if($employee->role_id == $role->id) selected @endif value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group ">
                        <label for="">Geboortedatum:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            <input disabled name="date" type="text" class="form-control" id="inlineFormInputGroupUsername" value="{{ date_format(new Datetime($employee->dateofbirth),'d-F-Y') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Dieetwensen:</label>
                        <textarea class="form-control" name="diet" id=""  rows="3">{{ $employee->dietary }}</textarea>
                        @error('diet') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <input hidden name="userid" type="text" class="form-control" value="{{$employee->user_id}}">
                        <input hidden name="oldemail" type="text" class="form-control" value="{{$employee->email}}">
                        <label for="">Nieuw wachtwoord:</label>
                        <input name="password" type="password" class="form-control" id="" placeholder="">
                        @error('password') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Herhaal nieuw wachtwoord:</label>
                        <input name="h_password" type="password" class="form-control" id="" placeholder="">
                        @error('h_password') {{ $message }} @enderror
                    </div>
                    <button type="submit" class="float-right btn btn-primary">Aanpassen</button>
                    <button type="submit" data-dismiss="modal" class="float-left btn btn-secondary">Cancel</button>
                </form>
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
