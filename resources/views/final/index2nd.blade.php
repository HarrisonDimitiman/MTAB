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
                             {{ __('FINALE') }}
                        </h4> 
                        @role('admin') 
                        <a  target="_blank"  href="{{ URL::to('/ResultbyEventFinal') }}" class="ml-5"><button class="btn btn-info "> <i class="cil-print"></i> Print</button></a>	
                           	
                        <a href="{{ URL::to('/generateFinal') }}" class="ml-auto"><button class="btn btn-primary ml-auto" style="float:right;">Generate Final</button></a>	
                        @endrole
                        </div>
                        <div class="card-body">
                        <div class="fade-in">
              <div class="row">
                            @foreach ($getContestantOverAllTotalJudge as $getContestantOverAllTotalJudge)                                
                                    <div class="col-4">
                                        <div class="card">
                                            <div class="card-header">
                                            <a style="font-size:20px;font-weight:bold;">Contestant # {{$getContestantOverAllTotalJudge->number}}</a>
                                               <span class="badge badge-success float-right"> 
                                                    @if ($loop->index+1 == 1)
                                                        First Runner Up
                                                    @elseif ($loop->index+1 == 2)
                                                        Second Runner Up
                                                    @elseif ($loop->index+1 == 3)
                                                        Third Runner Up
                                                    @endif
                                                </span>
                                            </div>
    
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-3">
                                                    <img src="{{asset('public/'.$getContestantOverAllTotalJudge->image) }}" width="70" height="70"alt="image"  align="left">
                                                    </div>
                                                    <div class="col-9">
                                                        <h5 class="card-title ml-2" style="font-size:12px;">{{$getContestantOverAllTotalJudge->name}}</h5>
                                                        <p class="card-text ml-2" style="font-size:12px;">{{$getContestantOverAllTotalJudge->location}}</p>
                                                        <p class="card-text float-right" style="font-size:25px;">{{ $getContestantOverAllTotalJudge->overAllTotalJudge }}%</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach
                            </div>
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