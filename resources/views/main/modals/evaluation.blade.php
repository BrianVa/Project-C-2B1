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
                <form method="post" action="{{ url('/evalueer') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col">
                               <p>Student: </p><p>{{Auth::user()->firstname}} {{Auth::user()->lastname}}</p>
                            </div>
                            <div class="col">
                                <p>Trainer: </p><p id="trainer"></p>
                            </div>
                            <div class="col">
                                <p>Date: </p><p id="date"></p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Quality of training material:</label>
                        <input type="text" name="training" class="form-control" id="" value="">
                        @error('training') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <label class="radio-label-vertical">
                            <input type="radio" name="training_radio" value="0" required>--</label>
                        <label class="radio-label-vertical">
                            <input type="radio" name="training_radio" value="1" required>-</label>
                        <label class="radio-label-vertical">
                            <input type="radio" name="training_radio" value="2" required>-/+</label>
                        <label class="radio-label-vertical">
                            <input type="radio" name="training_radio" value="3" required>+</label>
                        <label class="radio-label-vertical">
                            <input type="radio" name="training_radio" value="4" required>++</label>
                        @error('training_radio') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Speed of training:</label>
                        <input type="text" name="speed" class="form-control" id="" value="">
                        @error('speed') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <label class="radio-label-vertical">
                            <input type="radio" name="speed_radio" value="0" required>--</label>
                        <label class="radio-label-vertical">
                            <input type="radio" name="speed_radio" value="1" required>-</label>
                        <label class="radio-label-vertical">
                            <input type="radio" name="speed_radio" value="2" required>-/+</label>
                        <label class="radio-label-vertical">
                            <input type="radio" name="speed_radio" value="3" required>+</label>
                        <label class="radio-label-vertical">
                            <input type="radio" name="speed_radio" value="4" required>++</label>
                        @error('speed_radio') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Trainer's performance:</label>
                        <input type="text" name="performance" class="form-control" id="" value="">
                        @error('performance') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <label class="radio-label-vertical">
                            <input type="radio" name="performance_radio" value="0" required>--</label>
                        <label class="radio-label-vertical">
                            <input type="radio" name="performance_radio" value="1" required>-</label>
                        <label class="radio-label-vertical">
                            <input type="radio" name="performance_radio" value="2" required>-/+</label>
                        <label class="radio-label-vertical">
                            <input type="radio" name="performance_radio" value="3" required>+</label>
                        <label class="radio-label-vertical">
                            <input type="radio" name="performance_radio" value="4" required>++</label>
                        @error('performance_radio') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Quality of cases:</label>
                        <input type="text" name="cases" class="form-control" id="" value="">
                        @error('cases') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <label class="radio-label-vertical">
                            <input type="radio" name="cases_radio" value="0" required>--</label>
                        <label class="radio-label-vertical">
                            <input type="radio" name="cases_radio" value="1" required>-</label>
                        <label class="radio-label-vertical">
                            <input type="radio" name="cases_radio" value="2" required>-/+</label>
                        <label class="radio-label-vertical">
                            <input type="radio" name="cases_radio" value="3" required>+</label>
                        <label class="radio-label-vertical">
                            <input type="radio" name="cases_radio" value="4" required>++</label>
                        @error('cases_radio') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Time to perform cases:</label>
                        <input type="text" name="time" class="form-control" id="" value="">
                        @error('time') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <label class="radio-label-vertical">
                            <input type="radio" name="time_radio" value="0" required>--</label>
                        <label class="radio-label-vertical">
                            <input type="radio" name="time_radio" value="1" required>-</label>
                        <label class="radio-label-vertical">
                            <input type="radio" name="time_radio" value="2" required>-/+</label>
                        <label class="radio-label-vertical">
                            <input type="radio" name="time_radio" value="3" required>+</label>
                        <label class="radio-label-vertical">
                            <input type="radio" name="time_radio" value="4" required>++</label>
                        @error('time_radio') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <label for="">How much did you learn?</label>
                        <input type="text" name="learn" class="form-control" id="" value="">
                        @error('learn') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <label class="radio-label-vertical">
                            <input type="radio" name="learn_radio" value="0" required>--</label>
                        <label class="radio-label-vertical">
                            <input type="radio" name="learn_radio" value="1" required>-</label>
                        <label class="radio-label-vertical">
                            <input type="radio" name="learn_radio" value="2" required>-/+</label>
                        <label class="radio-label-vertical">
                            <input type="radio" name="learn_radio" value="3" required>+</label>
                        <label class="radio-label-vertical">
                            <input type="radio" name="learn_radio" value="4" required>++</label>
                        @error('learn_radio') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Trainer's knowledge on subject:</label>
                        <input type="text" name="knowledge" class="form-control" id="" value="">
                        @error('knowledge') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <label class="radio-label-vertical">
                            <input type="radio" name="knowledge_radio" value="0" required>--</label>
                        <label class="radio-label-vertical">
                            <input type="radio" name="knowledge_radio" value="1" required>-</label>
                        <label class="radio-label-vertical">
                            <input type="radio" name="knowledge_radio" value="2" required>-/+</label>
                        <label class="radio-label-vertical">
                            <input type="radio" name="knowledge_radio" value="3" required>+</label>
                        <label class="radio-label-vertical">
                            <input type="radio" name="knowledge_radio" value="4" required>++</label>
                        @error('knowledge_radio') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Name three things that you've learned:</label>
                        <input type="text" name="learned" class="form-control" id="" value="">
                        @error('learned') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Name three things that you've missed:</label>
                        <input type="text" name="missed" class="form-control" id="" value="">
                        @error('missed') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Name three strong points of the course:</label>
                        <input type="text" name="strong" class="form-control" id="" value="">
                        @error('strong') {{ $message }} @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Name three weak points of the course:</label>
                        <input type="text" name="weak" class="form-control" id="" value="">
                        @error('weak') {{ $message }} @enderror
                    </div>
                    <div class="form-group"><input hidden type="text" name="session_id" id="session-id" value=""></div>
                    <button type="submit" class="float-right btn btn-primary">Verzenden</button>
                    <button type="submit" data-dismiss="modal" class="float-left btn btn-secondary">Cancel</button>

                </form>
            </div>
        </div>
    </div>
</div>


