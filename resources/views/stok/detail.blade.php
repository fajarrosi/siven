@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
		<h3 class="box-title">Detail Barang</h3>

@stop

@section('content')


<div class="box">
	<div class="box-header">
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<table id="stok" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>kode inventarisasi</th>
					<th>Name</th>
					<th>Kondisi</th>
				</tr>
			</thead>			
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
		$('#stok').DataTable({
			processing: true,
			serverSide: true,
			ajax:{
				url: "{{ route('stok.show',session('show_id')) }}",
			},
			columns:[
			{
				data: 'kode_item',
				name: 'kode_item'
			},
			{
				data: 'itemname',
				name: 'itemname'
			},
			{
				data: 'kondisi',
				name: 'kondisi'
			}
			]
		});

		
	});
</script>
@stop