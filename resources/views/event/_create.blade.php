<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="{{ route('event.store') }}" method="post">
          @csrf 
              <div class="modal-header">
                <h4><i class="bi bi-justify"></i>{{ __(' Create Event') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <label for="program">Event Name:</label>
                <input type="hidden" name="programs_id" value="{{ $programs_id }}">
                <input type="text" required class="form-control" name="event_name">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
        </form>         
      </div>
    </div>
</div>