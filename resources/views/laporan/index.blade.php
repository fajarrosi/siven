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
        <div class="form-group">
            <label>Periode Tanggal </label>
            <div class="input-group">
                <input type="text" class="form-control startdate datetimepicker-input" data-toggle="datetimepicker" data-target=".startdate" id="test1" />
                    <span class="input-group-text">s/d</span>
                <input type="text" class="form-control enddate datetimepicker-input" data-toggle="datetimepicker" data-target=".enddate" id="test2" />
            </div>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.min.css" />

@stop

@section('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/js/tempusdominus-bootstrap-4.min.js"></script>
<script>
	$(function () {
		$('#item').dataTable();
		setDateRangePicker(".startdate", ".enddate");
		function setDateRangePicker(input1, input2){
			  $(input1).datetimepicker({
			    format: "DD-MM-YYYY",
			    useCurrent: false
			  })
			  $(input1).on("change.datetimepicker", function (e) {
			    $(input2).val("")
			        $(input2).datetimepicker('minDate', e.date);
			    })
			  $(input2).datetimepicker({
			    format: "DD-MM-YYYY",
			    useCurrent: false
			  })
			}

		$('#lap').click(function(){
			var $input1 = $('#test1').val();
			var $input2 = $('#test2').val();
			$.ajax({
				url:"/laporan/"+$input1+"/"+$input2,
			});
			console.log($input1,$input2);

		});																	
	});
</script>
@stop