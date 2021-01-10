<!-- Modal -->
<div id="register" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Aanmelden</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ url('/register') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col">
                                <label for="">Voornaam:</label>
                                <input type="text" class="form-control" name="firstname" id="" aria-describedby="emailHelp" value="">
                                @error('firstname') {{ $message }} @enderror
                            </div>
                            <div class="col">
                                <label for="">Achternaam:</label>
                                <input type="text" name="lastname" class="form-control" id="" value="">
                                @error('lastname') {{ $message }} @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Geslacht:</label>
                        <select name="sex" class="form-control">
                            <option selected></option>
                            @foreach($sexes as $sex)
                            <option value="{{$sex->id}}">{{$sex->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Email:</label>
                        <input type="email" name="email" class="form-control" id="" value="">
                        @error('email') {{ $message }} @enderror
                    </div>
                    <div class="form-group ">
                        <label for="">Geboortedatum:</label>
                        <input id="dateofbirth" type="datetime-local" name="dateofbirth" class="form-control">
                        @error('dateofbirth') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Dieetwensen:</label>
                        <textarea class="form-control" name="diet" id=""  rows="3"></textarea>
                        @error('diet') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Wachtwoord:</label>
                        <input name="password" type="password" class="form-control" id="" placeholder="">
                        @error('password') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Herhaal wachtwoord:</label>
                        <input name="h_password" type="password" class="form-control" id="" placeholder="">
                        @error('h_password') {{ $message }} @enderror
                    </div>
                    <button type="submit" class="float-right btn btn-primary">Aanmelden</button>
                    <button type="submit" data-dismiss="modal" class="float-left btn btn-secondary">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>


