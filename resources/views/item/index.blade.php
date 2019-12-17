@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1><a href = "{{route('item.create')}}" class="btn btn-flat btn-primary">tambah item</a></h1>
@stop

@section('content')
@if(session('status'))
<div class="alert alert-success">{{ session('status')}}</div>
@endif

<div class="box">
	<div class="box-header">
		<h3 class="box-title">item</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<table id="item" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>item</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@for($i=0; $i <= count($items)-1;$i++)
				<tr>
					<td>
						{{ $items[$i]->name}}
					</td>
					<td>
						<form action="{{ route('item.destroy', $items[$i]->id) }}" method="post">
							<a href = "{{route('item.edit', $items[$i]->id)}}" class="btn btn-flat btn-warning">edit</a>
							@csrf
							@method('DELETE')
							<a href = "#" class="btn btn-flat btn-danger" 
							onclick="confirm('Apakah anda yakin akan menghapus {{$items[$i]->name}} item ini ?') ? this.parentElement.submit() : ''"> delete</a>


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
<script> console.log('Hi!'); </script>
<script>
	$(function () {
		$('#item').dataTable();
	});
</script>
@stop