<div class="modal fade" id="edit_judges" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-primary" role="document">
      <div class="modal-content">
        <form action="{{ route('judges.update', $getJudge->id) }}" method="post">
          @csrf  
          @method('PATCH')  
          <div class="modal-header">
            <h4 class="modal-title">Edit Judges</h4>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
            <label for="program">Judges Name:</label>
            <input type="text" name="judges_name" class="form-control mb-3" placeholder="{{ $getJudge->judges_name }}" value="{{ $getJudge->judges_name }}">
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
            <button class="btn btn-primary" type="submit">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  