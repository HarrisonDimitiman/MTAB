@extends('dashboard.base')

@section('content')
@include('program._create')


<div class="container-fluid">
    <nav aria-label="breadcrumb" role="navigation">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Program</li>
      </ol>
    </nav>
        <div class="fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex">
                        <h4>
                            <i class="fa fa-align-justify"></i>
                             {{ __('Program Management') }}</h4>
                            <button class="btn btn-primary ml-auto" type="button" data-toggle="modal" data-target="#exampleModal">
                                <i class="cil-plus"></i>
                                Create
                            </button>          		
                        </div>
                        {{-- <form method="get" class="d-flex p-4">
                           
                            <input type="text" name="search_name" class="form-control" placeholder="Search Name" value="">
                            <button type="submit" class="btn btn-outline-primary">
                                Search
                            </button>
                            <a href="" class="btn btn-outline-danger mr-auto">
                                Clear
                            </a>
                        </form>													 --}}
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
                                        <th>#</th>
                                        <th>Program</th>
                                        <th>Date</th>
                                        <th width="10%">Report</th>
                                        <th width="9%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($prgm as $prgms)
                                        <tr>
                                            <td>{{ $prgms->id ?? '' }}</td>
                                            <td>{{ $prgms->name ?? '' }}</td>
                                            <td>{{ $prgms->date ?? '' }}</td>
                                            <td><button class="btn btn-info"> <i class="cil-print"></i> Print</button></td>
                                            <td style="width: 9%;">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="cil-cog"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <button type="button" class="dropdown-item btn btn-edit" data-url="{{ route('program.edit',$prgms->id) }}">
                                                            <i class="cil-pencil"></i>
                                                            &nbsp;Edit
                                                        </button>
                                                        <a type="button" href="{{ URL::to('/event/'.$prgms->id) }}"class="dropdown-item btn" data-url="">
                                                            <i class="cil-magnifying-glass"></i>
                                                            &nbsp;View Event
                                                        </a>
                                                        <form action="{{ route('program.destroy',$prgms->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
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
    
    <div class="append-program"></div>

@endsection
@section('javascript')

    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
@endsection
@section('script')
    <script type="text/javascript">       
        $('.btn-edit').click(function(){
			var div = $('.append-program');
			div.empty();

			var url = $(this).data('url');

			$.ajax({
			    url: url,
			    success:function(data){
			        div.append(data);
			        $('#edit_program').modal('show');
			    }
			});
		});

        $('.btn-delete').click(function(e){
			swal ({
			    title: "Are you sure?",
			      text: "Are you sure you want to delete this program?",
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