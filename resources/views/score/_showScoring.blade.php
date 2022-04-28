<div class="card text-dark bg-light mb-3" id="contestant-card">
    <div class="card-header">Contestant # {{ $contestant->number }}
        <button class="btn btn-sm btn-info close-card float-right">Close</button>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-3">
                <img src="{{ asset('/public/'.$contestant->image) }}" alt="" height="150" width="150"style=" border: 1px solid #555;align:left;">
            </div>
            <div class="col-9">
                <div class="row mb-3">
                    <div class="col-8"> <b>Name:</b> {{ $contestant->name }}</div>
                    <div class="col-4"> <b>Birthdate:</b> {{ $contestant->birthdate }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-8"> <b>Location:</b> {{ $contestant->location }}</div>
                    <div class="col-4"> <b>Age:</b> {{ $contestant->age }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-6"> <b>Vital Statistic:</b> {{ $contestant->vital_stat }}</div>
                    <div class="col-3"> <b>Weight:</b> {{ $contestant->weight }}</div>
                    <div class="col-3"> <b>Height:</b> {{ $contestant->height }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col"> <b>Educational Attainment:</b> {{ $contestant->educational }}</div>
                    
                </div>
            </div>
        </div>
        <hr>
        <div class="">
            <label for="criteria">Criteria</label>
            <select class="form-control" style="width:300px;" id="eventCrits">
                <option selected disabled>Select Criteria to judge</option>
                @foreach ($event as $event)
                    <option value="{{ URL::to('/getCritsEvent/'.$event->id.'/'.$contestant->id) }}" >{{ $event->event_name }}</option>
                @endforeach
                
            </select>
            
            <div class="row mt-2 criteriaSelect"></div>
        </div>
    </div>
</div>

<script>
        // $(".criteriaSelect").hide();
        $("#eventCrits").on('change', function (){
            var div = $('.criteriaSelect');
			div.empty();
            var url = $(this).val();
            $.ajax({
			    url: url,
			    success:function(data){
			        div.append(data);
                    // $('#critShowScoring').show();
			    }
			});
        });
        $(".close-card").click(function(){
            $("#contestant-card").hide();
        });
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
</script>