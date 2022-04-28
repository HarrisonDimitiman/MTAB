<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <form action="{{ route('contestant.store') }}" method="post"  enctype="multipart/form-data">
          @csrf 
              <div class="modal-header">
              <h4><i class="bi bi-justify"></i>{{ __(' Create Contestant') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <div class="row">
                  <div class="col-2">
                    <img src="" alt="" id="imageShow" height="120" width="120"style=" border: 1px solid #555;align:left;">
                  </div>
                  <div class="col-10">
                    <label for="program">Name:</label>
                    <input type="text" required class="form-control" name="name">
                    <label for="program">Location:</label>
                    <input type="text" required class="form-control" name="location">
                  </div>
                </div>
                <div class="row">
                  <div class="col-3">
                    <label for="program">Age:</label>
                    <input type="number" required class="form-control" name="age">
                  </div>
                 
                  <div class="col-3">
                    <label for="program">Height:</label>
                    <input type="text" required class="form-control" name="height">
                  </div>
                  <div class="col-3">
                    <label for="program">Weight:</label>
                    <input type="text" required class="form-control" name="weight">
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <label for="program">Educational Attainment:</label>
                    <input type="text" required class="form-control" name="educational">
                  </div>
                  <div class="col-6">
                    <label for="program">Contestant Number:</label>
                    <input type="number"  required class="form-control" name="number">
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <label for="program">Birthdate:</label>
                    <input type="date" required class="form-control" name="birthdate">
                  </div>
                  <div class="col-6">
                    <label for="program">Image:</label>
                    <input type="file"  class="form-control" name="image"  id="image">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
        </form>         
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">
  $('document').ready(function () {
    $("#image").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imageShow').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
});
</script>