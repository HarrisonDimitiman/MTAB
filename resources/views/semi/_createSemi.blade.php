<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="{{ URL::to('/storeSemi') }}" method="post">
          @csrf 
              <div class="modal-header">
              <h4><i class="bi bi-justify"></i>{{ __(' Create Semi Criteria') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <label for="program">Semi Criteria Name:</label>
                <input type="text" required class="form-control" name="name">
                <label for="program">Semi Criteria Percentage:</label>
                <input type="number" required class="form-control" name="semi_percentage">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
        </form>         
      </div>
    </div>
  </div>