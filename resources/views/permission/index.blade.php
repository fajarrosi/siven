@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1> <a href = "{{route('permission.create')}}" class="btn btn-flat btn-primary">tambah permission</a></h1>
@stop

@section('content')
@if(session('status'))
<div class="alert alert-success">{{ session('status')}}</div>
@endif
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Permission</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<table id="permission" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Permission</th>
					<th>Display_name</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			 	@foreach ($permissions as $permission )
			 		<tr>
			 			<td>
			 				{{ $permission->name}}
			 			</td>
			 			<td> 
			 				{{$permission-> display_name}}
			 			</td>
			 			<td>
			 				<form action="{{ route('permission.destroy', $permission->id) }}" method="post">
			 					<a href = "{{route('permission.edit', $permission)}}" class="btn btn-flat btn-warning">edit</a>
			 					@CSRF
			 					@method('DELETE')

			 					<a href = "#" class="btn btn-flat btn-danger" 
			 					onclick="confirm('Apakah anda yakin akan menghapus {{$permission->name}} ini ?') ? this.parentElement.submit() : ''"> delete</a>


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
		$('#permission').dataTable();
	});
</script>
@stop