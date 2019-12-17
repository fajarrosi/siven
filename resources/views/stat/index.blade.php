@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1><a href = "{{route('stat.create')}}" class="btn btn-flat btn-primary">tambah status</a></h1>
@stop

@section('content')
@if(session('status'))
<div class="alert alert-success">{{ session('status')}}</div>
@endif

<div class="box">
	<div class="box-header">
		<h3 class="box-title">Stat</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<table id="stat" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>status</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($stats as $stat )
				<tr>
					<td>
						{{ $stat->name}}
					</td>
					<td>
						<form action="{{ route('stat.destroy', $stat->id) }}" method="post">
							<a href = "{{route('stat.edit', $stat)}}" class="btn btn-flat btn-warning">edit</a>
							@csrf
							@method('DELETE')
							<a href = "#" class="btn btn-flat btn-danger" 
							onclick="confirm('Apakah anda yakin akan menghapus {{$stat->name}} stat ini ?') ? this.parentElement.submit() : ''"> delete</a>


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
<script>
	$(function () {
		$('#stat').dataTable();
	});
</script>
@stop