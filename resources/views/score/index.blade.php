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
                                    <div class="row" id="contestant">
                                        <div class="input-group mb-1">
                                            <div class="input-group-text">
                                                1
                                            </div>
                                                <input type="text" class="form-control" placeholder="Sheena Mae A. Escala" disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-group mb-1">
                                                <div class="input-group-text">
                                                    2
                                                </div>
                                                    <input type="text" class="form-control" placeholder="Precious Jewel A. Lamson" disabled>
                                            </div>
                                        </div>
                                    <div class="row">
                                        <div class="input-group mb-1">
                                                <div class="input-group-text">
                                                    3
                                                </div>
                                                        <input type="text" class="form-control" placeholder="Jethryl P. Pagara" disabled>
                                                </div>
                                    </div>
 
                                </div>
                                <div class="col-9">
                                   <div class="card text-dark bg-light mb-3" id="contestant-card">
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
                                                        <div class="col-8">Name:</div>
                                                        <div class="col-4">Birthdate:</div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-8">Location:</div>
                                                        <div class="col-4">Age:</div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-6">Vital Statistic:</div>
                                                        <div class="col-3">Weight:</div>
                                                        <div class="col-3">Height:</div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col">Educational Attainment:</div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="">
                                                <label for="criteria">Criteria</label>
                                                <select class="form-control" style="width:300px;" id="criteria">
                                                    <option selected disabled>Select Criteria to judge</option>
                                                    <option value="1" >Goddess</option>
                                                    <option value="2">Swim Wear</option>
                                                    <option value="3">Cocktail</option>
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
        $("#criteriaSelect").hide();
        $("#contestant").click(function(){
            $("#contestant-card").show();
        });
        $("#criteria").click(function(){
            $("#criteriaSelect").show();
        });
        $(".close-card").click(function(){
            $("#contestant-card").hide();
        });
        $('.btn-submit').click(function(e){
			swal ({
			    title: "Are you sure?",
			      text: "Are you sure you want to submit this ?!",
			      icon: "warning",
			      buttons: true,
			      dangerMode: true,
			}).then((result) => {
				if (result) {
					$(this).closest('form').submit();
				}
			})
		});
    </script>
@endsection