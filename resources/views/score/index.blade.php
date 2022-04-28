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
                             {{ __('Score Management') }}</h4>      		
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="row" >
                                        @foreach ($contestant as $contestant)
                                            <div class="input-group mb-1 contestant" data-url="{{ route('contestant.show',$contestant->id) }}">
                                                <div class="input-group-text">
                                                    {{ $contestant->number }}
                                                </div>
                                                    <input type="text" class="form-control font-weight-bold"  placeholder="{{ $contestant->name }}" disabled >
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="append-contestant-score"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
    <div class="append-contestant"></div>

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
            var div = $('.append-contestant-score');
			div.empty();
            
            // console.log(div);
            var url = $(this).data('url');
            $.ajax({
			    url: url,
			    success:function(data){
			        div.append(data);
			        $('#contestant-card').show();
			    }
			});
        });
    </script>
@endsection