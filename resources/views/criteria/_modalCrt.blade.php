<div class="modal fade" id="edit_crt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-primary" role="document">
      <div class="modal-content">
        <form action="{{ URL::to('/crt/update/'.$getCrt->id) }}" method="post">
          @csrf  
          {{-- @method('PATCH') --}}
          <div class="modal-header">
            <h4 class="modal-title">Edit Criteria</h4>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
            <label for="program">Criteria Name:</label>
            <input type="text" name="crt_name" class="form-control mb-3" required placeholder="{{ $getCrt->crt_name }}" value="{{ $getCrt->crt_name }}">
            <label for="program">Criteria Score:</label>
            <input type="number" name="crt_score" class="form-control mb-3" required placeholder="{{ $getCrt->crt_score }}" value="{{ $getCrt->crt_score }}" max="100">
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
            <button class="btn btn-primary" type="submit">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  