<div class="card text-dark bg-white mb-3" id="semi-card" >
    <div class="card-header">Contestant #
        <button class="btn btn-sm btn-info close-card float-right">Close</button>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-3">
                <img src="" alt="" height="150" width="150"style=" border: 1px solid #555;align:left;">
            </div>
            <div class="col-9">
                <div class="row mb-3">
                    <div class="col-8"> <b>Name:</b> </div>
                    <div class="col-4"> <b>Birthdate:</b> </div>
                </div>
                <div class="row mb-3">
                    <div class="col-8"> <b>Location:</b></div>
                    <div class="col-4"> <b>Age:</b> </div>
                </div>
                <div class="row mb-3">
                    
                    <div class="col-8"> <b>Weight:</b> </div>
                    <div class="col-4"> <b>Height:</b></div>
                </div>
                <div class="row mb-3">
                    <div class="col"> <b>Educational Attainment:</b> </div>
                    
                </div>
            </div>
        </div>
        <hr>
        <div class="">
            <label for="criteria">Criteria</label>
            <select class="form-control" style="width:300px;" id="eventCrits">
                <option selected disabled>Select Criteria to judge</option>
               
                    <option value="" ></option>
               
                
            </select>
            
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
            $("#semi-card").hide();
        });
        
</script>