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
                             {{ __('Selection of Top 3 Management') }}
                        </h4>      	
                        @role('admin')
                        <a  target="_blank" href="{{ URL::to('/ResultbyEventTop3') }}" class="ml-5"><button class="btn btn-info "> <i class="cil-print"></i> Print</button></a>	
                        <a href="{{ URL::to('/generateTop3') }}" class="ml-auto"><button class="btn btn-primary ml-auto" style="float:right;">Generate Top 3</button></a>	
                        @endrole
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="row" >
                                        @foreach ($getContestantOverAllTotalJudge as $getContestantOverAllTotalJudge)
                                            <div class="input-group mb-1 contestant" data-url="{{ URL::to('/showFinalContestant',$getContestantOverAllTotalJudge->contestant_id) }}">
                                                <div class="input-group-text">
                                                    {{ $getContestantOverAllTotalJudge->number }}
                                                </div>
                                                    <input type="text" class="form-control font-weight-bold"  placeholder="{{ $getContestantOverAllTotalJudge->name }} ({{ $getContestantOverAllTotalJudge->overAllTotalJudge }}%)" disabled >
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="append-final-score"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
    <div class="append-final"></div>

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
            var div = $('.append-final-score');
			div.empty();
            
            // console.log(div);
            var url = $(this).data('url');
            $.ajax({
			    url: url,
			    success:function(data){
			        div.append(data);
			        $('#final-card').show();
			    }
			});
        });
    </script>
@endsection