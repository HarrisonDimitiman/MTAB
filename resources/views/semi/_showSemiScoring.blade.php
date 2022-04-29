<div class="card text-dark bg-white mb-3" id="contestant-card" >
    <div class="card-header">Contestant # {{ $firstContestant->number }}
        <button class="btn btn-sm btn-info close-card float-right">Close</button>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-3">
                <img src="{{ asset('/public/'.$firstContestant->image) }}" alt="" height="150" width="150"style=" border: 1px solid #555;align:left;">
            </div>
            <div class="col-9">
                <div class="row mb-3">
                    <div class="col-8"> <b>Name:</b> {{ $firstContestant->name }}</div>
                    <div class="col-4"> <b>Birthdate:</b> {{ $firstContestant->birthdate }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-8"> <b>Location:</b> {{ $firstContestant->location }}</div>
                    <div class="col-4"> <b>Age:</b> {{ $firstContestant->age }}</div>
                </div>
                <div class="row mb-3">
                    
                    <div class="col-8"> <b>Weight:</b> {{ $firstContestant->weight }}</div>
                    <div class="col-4"> <b>Height:</b> {{ $firstContestant->height }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col"> <b>Educational Attainment:</b> {{ $firstContestant->educational }}</div>
                    
                </div>
            </div>
        </div>
        <hr>
        <div class="">
            {{-- <label for="criteria">Criteria</label> --}}
            {{-- <select class="form-control" style="width:300px;" id="eventCrits">
                <option selected disabled>Select Criteria to judge</option>
                @foreach ($getSemiCrits as $getSemiCrits)
                    <option value="{{ URL::to('/getCritsEvent/'.$getSemiCrits->id.'/'.$firstContestant->id) }}" >{{ $event->event_name }}</option>
                @endforeach
                
            </select> --}}
            <form action="{{ URL::to('/addScoreContestantSemi/'.$firstContestant->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @foreach ($getSemiCrits as $getSemiCrits)
                    <label for="criteria">{{ $getSemiCrits->name }} ({{ $getSemiCrits->semi_percentage }}%)</label>
                    <input type="hidden" value="{{ $getSemiCrits->id }}" required name="semi_crits_id[]"><br><br>
                    <input type="number" value="" required name="score[]"><br><br>
                @endforeach
                <button class="btn btn-primary btn-sm float-right mt-2 btn-submit" type="submit">Submit</button>
            </form>
           
            
            <div class=" mt-2 criteriaSelect"></div>
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
        
</script>