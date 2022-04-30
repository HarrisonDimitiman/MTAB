<style>
    .wd{
        margin-left: 2%; width: 100px !important;
    }
</style>
<div class="card text-dark bg-white mb-3" id="final-card" >
    <div class="card-header">
    <a style="font-size:25px;font-weight:bold;">Contestant #{{ $firstContestant->number }} ({{ $getContestantOverAllTotalJudge->overAllTotalJudge }})</a>
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
            <form action="{{ URL::to('/addScoreContestantFinal/'.$firstContestant->id) }}" method="POST" enctype="multipart/form-data" id="form">
                @csrf
                  <label for="criteria">Final Criteria:</label>
                <label class=""for="score" style="margin-left:72%;">Score</label>
               
                @if($value == 0)
                    @foreach ($getFinalCrits as $i => $getFinalCrits)
                        <div class="row">
                            <div class="div col-9">
                                <div class="input-group mb-1" style="width:500px;">
                                        <div class="input-group-text">{{++$i}}</div>
                                        <input type="text" class="form-control font-weight-bold" placeholder="{{ $getFinalCrits->name }} ({{ $getFinalCrits->term_percentage }}%)" disabled>
                                        <input type="hidden"  value="{{ $getFinalCrits->id }}" required name="final_crits_id[]">
                                        
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="col-3">
                                    <input type="number" class="form-control font-weight-bold text-center wd" name="score[]" value="" required>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @elseif($value == 1)
                    @foreach ($getFinalCrits2nd as $i => $getFinalCrits2nd)
                        <div class="row">
                            <div class="div col-9">
                                <div class="input-group mb-1" style="width:500px;">
                                        <div class="input-group-text">{{++$i}}</div>
                                        <input type="text" class="form-control font-weight-bold" placeholder="{{ $getFinalCrits2nd->name }} ({{ $getFinalCrits2nd->term_percentage }}%)" disabled>
                                        
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="col-3">
                                    <input type="number" class="form-control font-weight-bold text-center wd" disabled name="score[]" value="{{ $getFinalCrits2nd->score }}" required>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                
                @if($value == 0)
                    <button class="btn btn-primary btn-sm float-right mt-2 btn-submit" type="submit">Submit</button>
                @elseif($value == 1)
                    <button class="btn btn-primary btn-sm float-right mt-2" disabled type="submit">Done Scoring</button>
                @endif
                
                
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
            $("#final-card").hide();
        });

        $(document).ready(function() {
        $("form").submit(function() {
            $(this).submit(function() {
                return false;
            });
            return true;
        });     
    }); 
        
</script>