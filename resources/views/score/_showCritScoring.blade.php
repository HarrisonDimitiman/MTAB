<style>
    .wd{
        margin-left: 2%; width: 100px !important;
    }
</style>
<form action="{{ URL::to('/saveScore/'.Auth::user()->id.'/'.$event_id.'/'.$contestant->id) }}" method="POST" enctype="multipart/form-data">
    <div class="" id="critShowScoring">
        <label class=""for="score">Sub Criteria</label>
        <label class=""for="score" style="margin-left:72%;">Score</label>
        
            @csrf
            @if ($value == 0)
                @foreach ($criteria as $i => $criteria)
                    <div class="row">
                        <div class="col-9">
                            <div class="input-group mb-1" style="width:500px;">
                                <div class="input-group-text">{{ ++$i }}</div>
                                <input type="text" class="form-control font-weight-bold" placeholder="{{ $criteria->crt_name }} ({{ $criteria->crt_score }}%)" disabled>
                                <input type="hidden" name="crit_id[]" value="{{ $criteria->id }}">
                                
                            </div>
                        </div>
                        <div class="col-3">
                               <input type="number" class="form-control font-weight-bold text-center wd" name="score[]" max="{{ $criteria->crt_score }}" required>
                        </div>
                    </div>
                    
                @endforeach
            @elseif ($value == 1)
                @foreach ($criteria2nd as $criteria)
                    <div class="row">
                        <div class="col-9">
                            <div class="input-group mb-1" style="width:500px;">
                                <div class="input-group-text">{{ $criteria->crit_id }}</div>
                                <input type="text" class="form-control font-weight-bold" placeholder="{{ $criteria->crt_name }} ({{ $criteria->crt_score }}%)" disabled>
                                <input type="hidden" name="crit_id[]" value="{{ $criteria->crit_id }}">
                                
                            </div>
                        </div>
                        <div class="col-3">
                            <input type="number" class="form-control font-weight-bold text-center wd" name="score[]" value="{{ $criteria->score }}" disabled>
                        </div>
                    </div>   
                @endforeach
            @endif
        
    </div>
    @if($value == 0)
        <button class="btn btn-primary btn-sm float-right mt-2" type="submit">Submit</button>
    @elseif ($value == 1)
        <button class="btn btn-primary btn-sm float-right mt-2" disabled>Done Scoring</button>
    @endif
    
</form>
{{-- <script>
    $('.btn-submit').click(function(e){
			swal ({
			    title: "Are you sure?",
			      text: "Are you sure you want to submit this ?!",
			      icon: "warning",
			      buttons: true,
			      dangerMode: true,
			}).then((result) => {
				if (result) {
					$(this).closest('form').submit();
				}
			})
		});
</script> --}}