<div class="modal fade" id="edit_contestant" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-primary" role="document">
      <div class="modal-content">
        <form action="{{ route('contestant.update', $contestant->id) }}" method="post">
          @csrf  
          @method('PATCH')  
          <div class="modal-header">
            <h4 class="modal-title">Edit Contestant</h4>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">  
          <div class="row">
                  <div class="col-2">
                    <img src="{{asset('public/'.$contestant->image) }}" alt="" id="imageShow" height="120" width="120"style=" border: 1px solid #555;align:left;">
                  </div>
                  <div class="col-10">
                    <label for="program">Name:</label>
                    <input type="text" required class="form-control" value="{{$contestant->name}}" placeholder="{{$contestant->name}}" name="name">
                    <label for="program">Location:</label>
                    <input type="text" required class="form-control" value="{{$contestant->location}}" placeholder="{{$contestant->location}}" name="location">
                  </div>
                </div>
                <div class="row">
                  <div class="col-3">
                    <label for="program">Age:</label>
                    <input type="number" required class="form-control" value="{{$contestant->age}}" placeholder="{{$contestant->age}}" name="age">
                  </div>
                  <div class="col-3">
                    <label for="program">Body Vital Statistic:</label>
                    <input type="text" required class="form-control" value="{{$contestant->vital_stat}}" placeholder="{{$contestant->vital_stat}}" name="vital_stat">
                  </div>
                  <div class="col-3">
                    <label for="program">Height:</label>
                    <input type="text" required class="form-control" value="{{$contestant->height}}" placeholder="{{$contestant->height}}" name="height">
                  </div>
                  <div class="col-3">
                    <label for="program">Weight:</label>
                    <input type="text" required class="form-control" value="{{$contestant->weight}}" placeholder="{{$contestant->weight}}" name="weight">
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <label for="program">Educational Attainment:</label>
                    <input type="text" required class="form-control" placeholder="{{$contestant->educational}}" value="{{$contestant->educational}}" name="educational">
                  </div>
                  <div class="col-6">
                    <label for="program">Contestant Number:</label>
                    <input type="number"  class="form-control text-center" placeholder="{{$contestant->number}}" value="{{$contestant->number}}" name="number">
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <label for="program">Birthdate:</label>
                    <input type="date" required class="form-control" value="{{$contestant->birthdate}}" placeholder="{{$contestant->birthdate}}" name="birthdate">
                  </div>
                  <div class="col-6">
                    <label for="program">Image:</label>
                    <input type="file"  class="form-control" name="image"  id="image">
                  </div>
                </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
            <button class="btn btn-primary" type="submit">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  