@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1><a href = "{{route('user.create')}}" class="btn btn-flat btn-primary">tambah user</a></h1>
@stop

@section('content')
@if(session('status'))
<div class="alert alert-{{ session('status.color') }} alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>


	{{ session('status.message')}}
</div>
@endif
<div class="box">
	<div class="box-header">
		<h3 class="box-title">User</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<table id="user" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Nama</th>
					<th>Email</th>
					<th>Role</th>
					<th>Departement</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@for($i=0; $i <= count($users)-1;$i++)
				<tr>
					<td>
						{{ $users[$i]->name}}
					</td>
					<td> 
						{{$users[$i]->email}}
					</td>

					<td> 
						{{$users[$i]->role}}
					</td>
					<td> 
						{{$users[$i]->dname}}
					</td>
					<td>
						<form action="{{ route('user.destroy', $users[$i]->id) }}" method="post">
							<a href = "{{route('user.edit', $users[$i]->id)}}" class="btn btn-flat btn-warning">edit</a>
							@csrf
							@method('DELETE')
							<a href = "#" class="btn btn-flat btn-danger" 
							onclick="confirm('Apakah anda yakin akan menghapus {{$users[$i]->name}} user ini ?') ? this.parentElement.submit() : ''"> delete</a>


						</form>
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
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
	$(function () {
		$('#user').dataTable();
	});
</script>
@stop