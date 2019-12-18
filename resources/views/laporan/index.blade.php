@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Laporan KPK</h1>
<a href = "{{route('print')}}" class="btn btn-flat btn-primary">Cetak </a>
@stop

@section('content')
@if(session('status'))
<div class="alert alert-success">{{ session('status')}}</div>
@endif
<div class="box">
	<div class="box-header">
	</div>
	<div class="box-body">

              <div class="form-group col-md-4">
                <label>Cetak berdasarkan tanggal :</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="reservation">
                </div>
                <!-- /.input group -->
            </br>
				<a href = "#" class="btn btn-flat btn-primary" id="lap" name="lap">Cetak Laporan</a>
              </div>
	</div>
</div>
<div class="box">
	<div class="box-header">
		<h3 class="box-title">item yang telah disetujui</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<table id="item" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Name</th>
					<th>Total</th>
					<th>Tanggal</th>
				</tr>
			</thead>
			<tbody>
				@for($i=0; $i <= count($data)-1;$i++)
				<tr>
					<td>
						{{ $data[$i]->name}}
					</td>
					<td>
						{{ $data[$i]->total}}
					</td>
					<td>
						{{ $data[$i]->updated_at}}
					</td>
				</tr>
				@endfor
			</tbody>
			
		</table>
	</div>
	<!-- /.box-body -->
</div>
<!-- /.box -->
@stop



@section('css')
<link rel="stylesheet" href="{{ URL::asset('css/daterangepicker.css') }}" />

@stop

@section('js')
<script src="{{ URL::asset('js/moment.min.js') }}"></script>
<script src="{{ URL::asset('js/daterangepicker.js') }}"></script>

<script>
	$(function () {
		// $('#item').dataTable();
    //Date range picker
    var start;
    var end;
    $('#reservation').daterangepicker({
    	opens : 'center',
    	locale : {format : 'DD/MM/YYYY'} 
    })
    $('#reservation').on('apply.daterangepicker', function(ev, picker) {
    	start = picker.startDate.format('YYYY-MM-DD');
    	end = picker.endDate.format('YYYY-MM-DD');
  console.log('awal date',start,'akhir',end);
	});


		$('#lap').click(function(){
			var $input1 = $('#reservation').val();

			console.log($input1,'awal date->',start,'akhir date->',end);
			$.ajax({
				url:"/laporan/"+start+"/"+end
			});

		});																	
	});
</script>
@stop