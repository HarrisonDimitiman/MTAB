<div class="card text-dark bg-light mb-3" id="contestant-card">
    <div class="card-header">Contestant #
        <button class="btn btn-sm btn-info close-card float-right">Close</button>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-3">
                <img src="{{ asset('/public/'.$contestant->image) }}" alt="" height="150" width="150"style=" border: 1px solid #555;align:left;">
            </div>
            <div class="col-9">
                <div class="row mb-3">
                    <div class="col-8">Name: {{ $contestant->name }}</div>
                    <div class="col-4">Birthdate: {{ $contestant->birthdate }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-8">Location: {{ $contestant->location }}</div>
                    <div class="col-4">Age: {{ $contestant->age }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">Vital Statistic: {{ $contestant->vital_stat }}</div>
                    <div class="col-3">Weight: {{ $contestant->weight }}</div>
                    <div class="col-3">Height: {{ $contestant->height }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col">Educational Attainment: {{ $contestant->educational }}</div>
                    
                </div>
            </div>
        </div>
        <hr>
        <div class="">
            <label for="criteria">Criteria</label>
            <select class="form-control" style="width:300px;" id="criteria">
                <option selected disabled>Select Criteria to judge</option>
                @foreach ($event as $event)
                    <option value="{{ $event->id }}" >{{ $event->event_name }}</option>
                @endforeach
                
            </select>
            
            <div class="row mt-2" id="criteriaSelect">
               <div class="col-10">
               <label class=""for="score">Sub Criteria</label>
                    <div class="input-group mb-1" style="width:600px;">
                        <div class="input-group-text">1</div>
                            <input type="text" class="form-control font-weight-bold" placeholder="Relevance to the theme - 30%" disabled >
                    </div>
                </div>
                <div class="col-2" style="width:2px;">
                <label class=""for="score">Score</label>
                    <input type="number" class="form-control font-weight-bold text-center" >
               </div>
               <button class="btn btn-primary btn-sm ml-auto p-2 mt-3 btn-submit">Submit</button>
            </div>
            
        </div>
    </div>
</div>