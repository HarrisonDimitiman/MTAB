
<style>
    .wd{
        margin-left: 2%; width: 100px !important;
    }
</style>
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
            <form action="{{ URL::to('/addScoreContestantSemi/'.$firstContestant->id) }}" method="POST" enctype="multipart/form-data" id="form">
                @csrf
                <label for="criteria">Final Criteria:</label>
                <label class=""for="score" style="margin-left:72%;">Score</label>
                
                @foreach ($getSemiCrits as $i => $getSemiCrits)
                    <!-- <label for="criteria">{{ $getSemiCrits->name }} ({{ $getSemiCrits->semi_percentage }}%)</label>
                    <input type="hidden" value="{{ $getSemiCrits->id }}" required name="semi_crits_id[]"><br><br>
                    <input type="number" value="" required name="score[]"><br><br> -->
                   
                    <div class="row">
                        <div class="div col-9">
                            <div class="input-group mb-1" style="width:500px;">
                                    <div class="input-group-text">{{++$i}}</div>
                                    <input type="text" class="form-control font-weight-bold" placeholder="{{ $getSemiCrits->name }} ({{ $getSemiCrits->semi_percentage }}%)" disabled>
                                    <input type="hidden" name="crit_id[]" value="{{ $getSemiCrits->id }}" required name="semi_crits_id[]">
                                    
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="col-3">
                                <input type="number" class="form-control font-weight-bold text-center wd" name="score[]" value="" required>
                            </div>
                        </div>
                    </div>
                           
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
        //sa
        $(document).ready(function() {
        $("#form").submit(function() {
            $(this).submit(function() {
                return false;
            });
            return true;
        });     
    }); 
</script>