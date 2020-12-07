<!-- Modal -->
<div id="evaluation" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Evaluatie Formulier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ url('/Evaluatie') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-4">
                                <p>Student: </p>
                            </div>
                            <div class="col-md-4">
                                <p>Trainer: </p>
                            </div>
                            <div class="col-md-4">
                                <p>Date: </p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Quality of training material:</label>
                        <input id="ex5" type="text" data-slider-min="-5" data-slider-max="20" data-slider-step="1" data-slider-value="0"/>
                    </div>
                    <div class="form-group">

                    </div>
                    <div class="form-group ">

                    </div>
                    <div class="form-group">

                    </div>
                    <div class="form-group">

                    </div>
                    <div class="form-group">

                    </div>
                    <button type="submit" class="float-right btn btn-primary">Verzenden</button>
                    <button type="submit" data-dismiss="modal" class="float-left btn btn-secondary">Anuleer</button>
                </form>
            </div>
        </div>
    </div>
</div>


