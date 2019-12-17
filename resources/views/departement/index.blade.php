@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1><a href = "{{route('departement.create')}}" class="btn btn-flat btn-primary">tambah departement</a></h1>
@stop

@section('content')
@if(session('status'))
<div class="alert alert-success">{{ session('status')}}</div>
@endif

<div class="box">
	<div class="box-header">
		<h3 class="box-title">Departement</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<table id="departement" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Departement</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($departements as $departement )
				<tr>
					<td>
						{{ $departement->name}}
					</td>
					<td>
						<form action="{{ route('departement.destroy', $departement->id) }}" method="post">
							<a href = "{{route('departement.edit', $departement)}}" class="btn btn-flat btn-warning">edit</a>
							@csrf
							@method('DELETE')
							<a href = "#" class="btn btn-flat btn-danger" 
							onclick="confirm('Apakah anda yakin akan menghapus {{$departement->name}} departement ini ?') ? this.parentElement.submit() : ''"> delete</a>


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
		$('#departement').dataTable();
	});
</script>
@stop