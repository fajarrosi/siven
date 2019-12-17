@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1> <a href = "{{route('pngjuan.create')}}" class="btn btn-flat btn-primary">tambah pengajuan</a></h1>

@stop

@section('content')
@if(session('status'))
<div class="alert alert-success">{{ session('status')}}</div>
@endif

<div class="box">
	<div class="box-header">
		<h3 class="box-title">Pengajuan</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<table id="pngs" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>User</th>
					<th>Barang</th>
					<th>Jumlah</th>
					<th>Status</th>
					<th>Actions</th>
					@if(Auth::user()->hasRole('kpk'))
					<th>Accept</th>
					@endif
				</tr>
			
			</thead>
			<tbody>
				@for($i=0; $i <= count($data)-1;$i++)
				<tr>
					<td>
						{{$data[$i]->username}}
					</td>
					<td>
						{{ $data[$i]->item_name}}
					</td>
					<td>
						{{ $data[$i]->total}}
					</td>
					<td>
						{{ $data[$i]->st_name}}
					</td>
					<td >
						<form action="{{ route('pngjuan.destroy', $data[$i]->id) }}" method="post">
							<!-- kpk yang bisa edit punyanya sendiri yang belum di setujui oleh wks -->
							@if(Auth::user()->hasRole('kpk') && $data[$i]->st_id == 2 )
							<a href = "{{route('pngjuan.edit', $data[$i]->id)}}" class="btn btn-flat btn-warning" >edit</a>
							@CSRF
							@method('DELETE')

							<a href = "#" class="btn btn-flat btn-danger" 
							onclick="confirm('Apakah anda yakin akan menghapus {{$data[$i]->item_name}} ini ?') ? this.parentElement.submit() : ''"> delete</a>
							<!-- kpk tidak bisa edit dan delete dari pengajuan yang belum disetujui -->
							@elseif(Auth::user()->hasRole('kpk') && $data[$i]->st_id == 1 && $data[$i]->username == Auth::user()->name)
							
							<!-- yang bukan kpk yang belum disetujui kpk masih bisa di edit 
								, bisa edit  yang dia input sendiri bukan yang lain yang input-->
							@elseif($data[$i]->st_id == 1 && $data[$i]->username == Auth::user()->name)

							<a href = "{{route('pngjuan.edit', $data[$i]->id)}}" class="btn btn-flat btn-warning" >edit</a>
							@CSRF
							@method('DELETE')

							<a href = "#" class="btn btn-flat btn-danger" 
							onclick="confirm('Apakah anda yakin akan menghapus {{$data[$i]->item_name}} ini ?') ? this.parentElement.submit() : ''"> delete</a>

							@endif

						</form>
					</td>
					@if(Auth::user()->hasRole('kpk') && $data[$i]->st_id == 1)
					<td>
						<a href = "{{route('pngjuan.show',$data[$i]->id)}}" class="btn btn-flat btn-success" >Setujui</a>
					</td>
					@else

					@endif
						

					

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
		$('#pngs').dataTable();
	});
</script>
@stop