@extends('dashboard.base')
@section('content')
@include('criteria._createCriteria')

<div class="container-fluid">
    <nav aria-label="breadcrumb" role="navigation">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ URL::to('/program/') }}">Program</a></li>
        <li class="breadcrumb-item"><a href="{{ URL::to('/event/'.$programs_id) }}">Criterea</a></li>
        <li class="breadcrumb-item active" aria-current="page">Sub-Criteria</li>
    </ol>
    </nav>
    <div class="fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex">
                    <h4>
                        <i class="fa fa-align-justify"></i>
                        Sub-Criterea for {{ $event->event_name }}</h4>
                        <button class="btn btn-primary ml-auto" type="button" data-toggle="modal" data-target="#eventModal">
                            <i class="cil-plus"></i>
                            Create
                        </button>          		
                    </div>											
                    <div class="card-body">
                        @if (session('message'))
                        <div class="row mb-2">
                            <div class="col-lg-12">
                                <div class="alert alert-success" role="alert">
                                      {!! session('message') !!}
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>
                            </div>
                        </div>
                      @endif
                        <table class="table table-responsive-sm">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Sub-Criteria</th>
                                    <th width="15%" style="text-align:center;">Percentage</th>
                                    <th width="9%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allCrits as $i => $allCrits)   
                                    <tr>
                                        <td width="5%">{{++$i}}</td>
                                        <td>{{ $allCrits->crt_name ?? '' }}</td>
                                        <td width="15%" style="text-align:center;">{{ $allCrits->crt_score ?? '' }}%</td>
                                        <td style="width: 9%;">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="cil-cog"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <button type="button" class="dropdown-item btn btn-edit" data-url="{{ URL::to('/crtEdit/'.$allCrits->id) }}">
                                                        <i class="cil-pencil"></i>
                                                        &nbsp;Edit
                                                    </button>
                                                    <form action="{{ URL::to('/destroyCrt/'.$allCrits->id.'/'.$programs_id.'/'.$event->id) }}" method="post">
                                                        @csrf
                                                        <button type="button" class="dropdown-item btn btn-danger float-right btn-delete">
                                                            <i class="cil-trash"></i>
                                                            &nbsp;Delete
                                                        </button>
                                                    </form>	
                                                </div>
                                            </div>    
                                        </td>
                                    </tr>
                                @endforeach 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

<div class="append-criteria"></div>
@endsection
@section('script')
	<script type="text/javascript">
        $('.btn-edit').click(function(){
			var div = $('.append-criteria');
			div.empty();

			var url = $(this).data('url');

			$.ajax({
			    url: url,
			    success:function(data){
			        div.append(data);
			        $('#edit_crt').modal('show');
			    }
			});
		});
        $('.btn-delete').click(function(e){
			swal ({
			    title: "Are you sure?",
			      text: "Are you sure you want to delete this criteria?",
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

