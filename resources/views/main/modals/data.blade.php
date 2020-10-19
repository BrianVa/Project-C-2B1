<!-- Modal -->
<div class="modal fade" id="data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mijn Gegevens</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-group">
                        <label for="">Voornaam:</label>
                        <input type="text" class="form-control" id="" aria-describedby="emailHelp" placeholder="{{ Auth::user()->firstname }}">
                    </div>
                    <div class="form-group">
                        <label for="">Achternaam:</label>
                        <input type="text" class="form-control" id="" placeholder="{{ Auth::user()->lastname }}">
                    </div>
                    <div class="form-group">
                        <label for="">Email:</label>
                        <input type="email" class="form-control" id="" placeholder="{{ Auth::user()->email }}">
                    </div>
                    <div class="form-group ">
                        <label for="">Geboorte Datum:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            <input disabled type="text" class="form-control" id="inlineFormInputGroupUsername" placeholder="{{ Auth::user()->dateofbirth }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Dieetwensen:</label>
                        <textarea class="form-control" id="" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Nieuw wachtwoord:</label>
                        <input type="password" class="form-control" id="" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="">Herhaal nieuw wachtwoord:</label>
                        <input type="password" class="form-control" id="" placeholder="">
                    </div>
                    <button type="submit" class="float-right btn btn-primary">Aanpassen</button>
                    <button type="submit" data-dismiss="modal" class="float-left btn btn-secondary">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>


