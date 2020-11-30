<!-- Modal -->
<div id="data" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mijn Gegevens</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ url('/updatedata') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col">
                                <label for="">Voornaam:</label>
                                <input type="text" class="form-control" name="firstname" id="" aria-describedby="emailHelp" value="{{ $data->firstname }}">
                                @error('firstname') {{ $message }} @enderror
                            </div>
                            <div class="col">
                                <label for="">Achternaam:</label>
                                <input type="text" name="lastname" class="form-control" id="" value="{{ $data->lastname }}">
                                @error('lastname') {{ $message }} @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Geslacht:</label>
                        <input disabled type="text" name="sex" class="form-control" id="" value="{{ $data->gender }}">
                    </div>
                    <div class="form-group">
                        <label for="">Email:</label>
                        <input type="email" name="email" class="form-control" id="" value="{{ $data->email }}">
                        @error('email') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Functie:</label>
                        <input type="text" disabled name="role" class="form-control" id="" value="{{ $data->function }}">
                    </div>
                    <div class="form-group ">
                        <label for="">Geboorte Datum:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            <input disabled name="date" type="text" class="form-control" id="inlineFormInputGroupUsername" value="{{ date_format(new Datetime($data->dateofbirth),'d-F-Y') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Dieetwensen:</label>
                        <textarea class="form-control" name="diet" id=""  rows="3">{{ $data->dietary }}</textarea>
                        @error('diet') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Nieuw wachtwoord:</label>
                        <input name="password" type="password" class="form-control" id="" placeholder="">
                        @error('password') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Herhaal nieuw wachtwoord:</label>
                        <input name="h_password" type="password" class="form-control" id="" placeholder="">
                        @error('h_password') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Profielfoto wijzigen:</label>
                        <input type="file" name="image"/>

                    </div>
                    <button type="submit" class="float-right btn btn-primary">Aanpassen</button>
                    <button type="submit" data-dismiss="modal" class="float-left btn btn-secondary">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>


