<form action="{{ URL::to('/saveScore/'.Auth::user()->id.'/'.$event_id.'/'.$contestant->id) }}" method="POST" enctype="multipart/form-data">
    <div class="col-10" id="critShowScoring">
        <label class=""for="score">Sub Criteria</label>
        <label class=""for="score" style="margin-left:57%;">Score</label>
        
            @csrf
            @if ($value == 0)
                @foreach ($criteria as $criteria)
                    <div class="input-group mb-1" style="width:900px;">
                        <div class="input-group-text">{{ $criteria->id }}</div>
                        <input type="text" class="form-control font-weight-bold" placeholder="{{ $criteria->crt_name }} ({{ $criteria->crt_score }}%)" disabled>
                        <input type="hidden" name="crit_id[]" value="{{ $criteria->id }}">
                        <input type="number" class="form-control font-weight-bold text-center" name="score[]" max="{{ $criteria->crt_score }}" style="margin-left: 10%; width: 50px;">
                    </div>
                @endforeach
            @elseif ($value == 1)
                @foreach ($criteria2nd as $criteria)
                    <div class="input-group mb-1" style="width:900px;">
                        <div class="input-group-text">{{ $criteria->crit_id }}</div>
                        <input type="text" class="form-control font-weight-bold" placeholder="{{ $criteria->crt_name }}" disabled>
                        <input type="hidden" name="crit_id[]" value="{{ $criteria->crit_id }}">
                        <input type="number" class="form-control font-weight-bold text-center" name="score[]" value="{{ $criteria->score }}" disabled style="margin-left: 10%; width: 50px;">
                    </div>
                @endforeach
            @endif
        
    </div>
    <div class="col-2" style="width:2px;">
        {{-- <label class=""for="score">Score</label>
        <input type="number" class="form-control font-weight-bold text-center" > --}}
    </div>
    <button class="btn btn-primary btn-sm ml-auto p-2 mt-3 btn-submit" type="submit">Submit</button>
</form>