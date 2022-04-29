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
                             {{ __('Selection of Top 6 Management') }}</h4>      		
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <div class="row" >
                                       
                                            <div class="input-group mb-1 semi" data-url="">
                                                <div class="input-group-text">
                                                    
                                                </div>
                                                    <input type="text" class="form-control font-weight-bold"  placeholder="" disabled >
                                            </div>
                                       
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

        $(".semi").click(function(){
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