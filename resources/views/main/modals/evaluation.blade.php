<!-- Modal -->
<div id="evaluation" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Evaluatie</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ url('/evaluation') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="form-row">
                            <div>
                               <p>Student: </p><p>{{Auth::user()->firstname}} {{Auth::user()->lastname}}</p>
                            </div>
                            <div>
                                <p>Student: </p><p>1</p>
                            </div>
                            <div>
                                <p>Student: </p><p>{{Auth::user()->firstname}} {{Auth::user()->lastname}}</p>
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="">Geslacht:</label>
                        <input type="email" name="email" class="form-control" id="" value="">
                        @error('email') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Email:</label>
                        <input type="email" name="email" class="form-control" id="" value="">
                        @error('email') {{ $message }} @enderror
                    </div>
                    <div class="form-group ">
                        <label for="">Geboorte Datum:</label>
                        <input id="dateofbirth" type="datetime-local" name="dateofbirth" class="form-control">
                        @error('dateofbirth') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Dieetwensen:</label>
                        <textarea class="form-control" name="diet" id=""  rows="3"></textarea>
                        @error('diet') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <label for="">wachtwoord:</label>
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


