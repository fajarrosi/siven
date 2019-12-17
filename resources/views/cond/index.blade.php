@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1><a href = "{{route('cond.create')}}" class="btn btn-flat btn-primary">tambah kondisi</a></h1>
@stop

@section('content')
@if(session('status'))
<div class="alert alert-success">{{ session('status')}}</div>
@endif

<div class="box">
	<div class="box-header">
		<h3 class="box-title">Kondisi</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<table id="cond" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Kondisi</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($conds as $cond )
				<tr>
					<td>
						{{ $cond->name}}
					</td>
					<td>
						<form action="{{ route('cond.destroy', $cond->id) }}" method="post">
							<a href = "{{route('cond.edit', $cond)}}" class="btn btn-flat btn-warning">edit</a>
							@csrf
							@method('DELETE')
							<a href = "#" class="btn btn-flat btn-danger" 
							onclick="confirm('Apakah anda yakin akan menghapus {{$cond->name}} cond ini ?') ? this.parentElement.submit() : ''"> delete</a>


						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
			
		</table>
	</div>
	<!-- /.box-body -->
</div>
<!-- /.box -->
@stop



@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script> console.log('Hi!'); </script>
<script>
	$(function () {
		$('#cond').dataTable();
	});
</script>
@stop