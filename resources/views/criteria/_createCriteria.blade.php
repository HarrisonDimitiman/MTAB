<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="{{ URL::to('/addCriteria') }}" method="post">
          @csrf 
              <div class="modal-header">
                <h4><i class="bi bi-justify"></i>{{ __(' Create Criteria') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <label for="program">Criteria Name:</label>
                {{-- <input type="hidden" name="programs_id" value="{{ $prgms_id }}"> --}}
                <input type="text" required class="form-control" name="crt_name">
                <label for="program">Criteria Score:</label>
                {{-- <input type="hidden" name="programs_id" value="{{ $prgms_id }}"> --}}
                <input type="number" required class="form-control" name="crt_score" max="100">
                <input type="hidden" required class="form-control" name="event_id" value="{{ $event->id }}">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
        </form>         
      </div>
    </div>
  </div>