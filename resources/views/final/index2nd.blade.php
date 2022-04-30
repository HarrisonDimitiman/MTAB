@extends('dashboard.base')

@section('content')
<div class="container-fluid">
   
        <div class="fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex">
                        <h4>
                            <i class="fa fa-align-justify"></i>
                             {{ __('Final Round Management') }}
                        </h4>      	
                        <a href="{{ URL::to('/generateFinal') }}" class="ml-auto"><button class="btn btn-primary ml-auto" style="float:right;">Generate Final</button></a>	
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="row" >
                                        @foreach ($getContestantOverAllTotalJudge as $getContestantOverAllTotalJudge)
                                            <div class="input-group mb-1 contestant" data-url="{{ URL::to('/showContestant',$getContestantOverAllTotalJudge->contestant_id) }}">
                                                <div class="input-group-text">
                                                    {{ $getContestantOverAllTotalJudge->overAllTotalJudge }}%
                                                </div>
                                                    <input type="text" class="form-control font-weight-bold"  placeholder="{{ $getContestantOverAllTotalJudge->contestant_id }} {{ $getContestantOverAllTotalJudge->name }}" disabled >
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="append-semi-score"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
    <div class="append-semi"></div>

@endsection
@section('javascript')

    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
@endsection
@section('script')
    <script>
       
        // $("#contestant").click(function(){
        //     $("#contestant-card").show();
        // });

        $(".contestant").click(function(){
            var div = $('.append-semi-score');
			div.empty();
            
            // console.log(div);
            var url = $(this).data('url');
            $.ajax({
			    url: url,
			    success:function(data){
			        div.append(data);
			        $('#semi-card').show();
			    }
			});
        });
    </script>
@endsection