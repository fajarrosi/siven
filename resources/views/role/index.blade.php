@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1> <a href = "{{route('role.create')}}" class="btn btn-flat btn-primary">tambah Role</a></h1>
@stop

@section('content')
@if(session('status'))
<div class="alert alert-success">{{ session('status')}}</div>
@endif

<div class="box">
	<div class="box-header">
		<h3 class="box-title">Role</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<table id="role" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Role</th>
					<th>Display_name</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
			 	@foreach ($roles as $role )
			 		<tr>
			 			<td>
			 				{{ $role->name}}
			 			</td>
			 			<td> 
			 				{{$role-> display_name}}
			 			</td>
			 							
			 			<td>
			 				<form action="{{ route('role.destroy', $role->id) }}" method="post">
			 					<a href="{{route('role.show',$role)}}" class="btn btn-flat btn-primary">Detail</a>
			 					<a href = "{{route('role.edit', $role)}}" class="btn btn-flat btn-warning">edit</a>
			 					@csrf
			 					@method('DELETE')

			 					<a href = "#" class="btn btn-flat btn-danger" 
			 					onclick="confirm('Apakah anda yakin akan menghapus {{$role->name}} role ini ?') ? this.parentElement.submit() : ''"> delete</a>


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
@stop

@section('js')
<script> console.log('Hi!'); </script>
<script>
	$(function () {
		$('#role').dataTable();
	});
</script>
@stop