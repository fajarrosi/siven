@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
		<h3 class="box-title">Stok Barang</h3>

@stop

@section('content')
@if(session('status'))
<div class="alert alert-success">{{ session('status')}}</div>
@endif
<div class="box">
	<div class="box-header">
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<table id="stok" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Barang</th>
					<th>Total</th>
					<th>Detail</th>
				</tr>
			</thead>
			<tbody>
			 	@for($i=0; $i <= count($s)-1;$i++)
			 		<tr>
			 			<td>
			 				{{ $s[$i]->item_name}}
			 			</td>
			 			<td> 
			 				{{$s[$i]-> total}}
			 			</td>
			 			<td>
			 					@if($s[$i]->total == 0)

			 					@else
			 					<a href = "{{route('stok.show', $s[$i]->id)}}" class="btn btn-flat btn-primary">Detail</a>
			 					@endif
			 					
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
@stop

@section('js')
<script> console.log('Hi!'); </script>
<script>
	$(function () {
		$('#stok').dataTable();
	});
</script>
@stop